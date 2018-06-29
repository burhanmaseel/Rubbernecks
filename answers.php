<?php
/**
 * Created by PhpStorm.
 * User: burhan
 * Date: 6/10/2018
 * Time: 1:46 AM
 */
include 'connection.php';
include 'config.php';

$cid=$_POST['clientid'];
$bid=$_POST['branchid'];

$location=$_POST['location'];
$date=$_POST['date'];
$profile=$_POST['profile'];
$time=$_POST['time'];
$timeout=$_POST['timeout'];
$total_members=$_POST['total_members'];
$member_name=$_POST['member_name'];
$cashier_name=$_POST['cashier_name'];
$bill_no=$_POST['bill_no'];
$total_paid=$_POST['total_paid'];
$items_ordered=$_POST['items_ordered'];
$addcomments=$_POST['addcom'];

$date=date("d-m-Y");


$user_id=$_POST['user_id'];
$q_count=$_POST['q_count'];

$survey=-1;

$query1 = "INSERT INTO `surveys`(`survey_id`, `cid`, `bid`, `user_id`, `location`, `visit_date`, `profile`, `visit_time`, `total_members`, `member_name`, `cashier_name`, `bill_no`, `total_paid`, `items_ordered`, `addcom`,`survey_fill_date`,`time_out`) VALUES ('', '$cid','$bid','$user_id','$location','$date','$profile','$time','$total_members','$member_name','$cashier_name','$bill_no','$total_paid','$items_ordered','$addcomments','$date','$timeout')";
$query2 = "SELECT MAX(survey_id) FROM surveys";

if ($mysqli->query($query1)) {

    $result = $mysqli->query($query2);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $survey_num = $row['MAX(survey_id)'];
        $survey=$survey_num;


        for ($qno=1; $qno<=$q_count;$qno++) {
            $q_id=$_POST["q_$qno"];
            $answer=$_POST["answer_$qno"];
            $comments=$_POST["comment_$qno"];

            $query3 = "INSERT INTO `answers`(`aid`, `qid`, `answer`, `user_id`, `survey_id`, `comments`) VALUES ('', '$q_id', '$answer','$user_id','$survey_num','$comments')";

            $mysqli->query($query3);

        }

        $query_cat="SELECT categories.cat_id,categories.cat_name FROM categories,branch_surverys WHERE categories.cat_id=branch_surverys.cat_id AND branch_surverys.c_id=$cid AND branch_surverys.b_id=$bid";


        if ($result=$mysqli->query($query_cat)){


            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $cat_id=$row['cat_id'];
                    $cat_name=$row['cat_name'];

                    $query_answer="SELECT answers.qid,answers.answer FROM answers,questions WHERE questions.cat_id=$cat_id AND answers.qid=questions.q_id AND  answers.survey_id=$survey_num GROUP BY answers.qid";
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
                    $query_insert_score="INSERT INTO `score`(`survey_id`, `cat_id`, `cat_name`, `max`, `achieved`, `cid`, `bid`) VALUES ('$survey_num','$cat_id','$cat_name','$total_count','$yes_count','$cid','$bid')";

                    if($mysqli->query($query_insert_score)){

                    }else{
                        echo $mysqli->error;
                    }
                }
            }

        }
        else{
            echo $mysqli->error;
        }
        $delete_assigned_query="DELETE FROM `assigned` WHERE cid=$cid AND b_id=$bid AND uid=$user_id";
        $mysqli->query($delete_assigned_query);

        $date=date('d-m-Y');
        $insert_to_filled_query="INSERT INTO `filled_surveys`(`filled_id`, `survey_id`, `filled_date`) VALUES ('',$survey,$date)";
        $mysqli->query($insert_to_filled_query);

        header("Location: {$_SERVER['HTTP_REFERER']}");


    }


}else{
    $mysqli->error;
}

?>

