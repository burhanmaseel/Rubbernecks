<?php
/**
 * Created by PhpStorm.
 * User: burhan
 * Date: 6/20/2018
 * Time: 11:03 PM
 */
include 'config.php';


$surveyid=$_GET['surveyid'];
$select_cid_bid_query="SELECT surveys.cid, surveys.bid FROM `surveys` WHERE surveys.survey_id=$surveyid";
$rs=$mysqli->query($select_cid_bid_query);
while ($r=$rs->fetch_assoc()){
    $cid=$r['cid'];
    $bid=$r['bid'];
}


$query_cat="SELECT categories.cat_id,categories.cat_name FROM categories,branch_surverys WHERE categories.cat_id=branch_surverys.cat_id AND branch_surverys.c_id=$cid AND branch_surverys.b_id=$bid";


if ($result=$mysqli->query($query_cat)){


    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $cat_id=$row['cat_id'];
            $cat_name=$row['cat_name'];

            $query_answer="SELECT answers.qid,answers.answer FROM answers,questions WHERE questions.cat_id=$cat_id AND answers.qid=questions.q_id AND  answers.survey_id=$surveyid GROUP BY answers.qid";
            $total_count=0;
            $yes_count=0;
            if ($result_answer=$mysqli->query($query_answer)){

                while ($answer_row= $result_answer->fetch_assoc()){
                    $total_count++;
                    $answerr=$answer_row['answer'];
                    if ($answerr=="Yes"){
                        $yes_count++;

                    }
                }
            }
                $query_update_score="UPDATE `score` SET `achieved`='$yes_count' WHERE score.survey_id=$surveyid AND score.cat_id=$cat_id";

            if($mysqli->query($query_update_score)){

            }else{
                echo $mysqli->error;
            }
        }
    }

}
else{
    echo $mysqli->error;
}

header("Location: {$_SERVER['HTTP_REFERER']}");