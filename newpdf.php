<?php
/**
 * Created by PhpStorm.
 * User: burhan
 * Date: 6/13/2018
 * Time: 12:35 AM
 */

include 'config.php';
include 'connection.php';

$sid=$_GET['survey_id'];

$query="SELECT surveys.*, clients.c_name, clients.c_disc, branch.b_name, users.fname, users.lname FROM surveys,clients,branch,users WHERE surveys.cid=clients.c_id AND surveys.bid=branch.b_id AND surveys.user_id=users.id AND survey_id=$sid";

$rs= $conn->query($query);
while ($r=$rs->fetch_assoc()){
    $cid=$r['cid'];
    $bid=$r['bid'];
    $c_type=$r['c_disc'];
    $uid=$r['user_id'];
    $location=$r['location'];
    $date=$r['visit_date'];
    $profile=$r['profile'];
    $time=$r['visit_time'];
    $time_out=$r['time_out'];
    $total_members=$r['total_members'];
    $member_name=$r['member_name'];
    $cashier_name=$r['cashier_name'];
    $bill_no=$r['bill_no'];
    $total_paid=$r['total_paid'];
    $items_ordered=$r['items_ordered'];
    $addcomments=$r['addcom'];
    $client=$r['c_name'];
    $branch=$r['b_name'];
    $user=$r['fname']." ".$r['lname'];
}

?>


<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>rubbernecks</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="pdfstyle.css" type="text/css">
</head>
<body style="font-size: small">
<img src="logo%20(1).jpg" alt="" class="img-fluid" style="height: 200px">
<h4 id="client-title" "><?php echo $client;?></h4>
<h5 id="doc-title">Service & Cashier Assessment Report</h5>
<table class="table table-sm table-bordered" style=" margin-right: 50px">

    <tbody>
    <tr>
        <td>
            <b>Store Location</b>
        </td>
        <td>
            <?php
            echo $location;
            ?>
        </td>
    </tr>
    <tr>
        <td>
            <b>Date of Visit</b>
        </td>
        <td>
            <?php
            echo $date;
            ?>
        </td>
    </tr>
    <tr>
        <td>
            <b>Profile of Shopper</b>
        </td>
        <td>
            <?php
            echo $profile;
            ?>
        </td>
    </tr>
    <tr>
        <td>
            <b>Time of Visit</b>
        </td>
        <td>
            <?php
            echo $time;
            ?>
        </td>
    </tr>
    <?php
    if($c_type!="retail"){
        echo"<tr>
        <td>
        <b>Time Out</b>
        </td>
        <td>$time_out
    </td>
    </tr>";

    }?>
    <tr>
        <td>
            <b>Total Team Members in Store</b>
        </td>
        <td>
            <?php
            echo $total_members;
            ?>
        </td>
    </tr>
    <tr>
        <td>
            <b>Name of Member attended you</b>
        </td>
        <td>
            <?php
            echo $member_name;
            ?>
        </td>
    </tr>
    <tr>
        <td>
            <b>Name of Cashier attended you</b>
        </td>
        <td>
            <?php
            echo $cashier_name;
            ?>
        </td>
    </tr>
    <tr>
        <td>
            <b>Bill/Receipt No</b>
        </td>
        <td>
            <?php
            echo $bill_no;
            ?>
        </td>
    </tr>
    <tr>
        <td>
            <b>Total Paid</b>
        </td>
        <td>
            <?php
            echo $total_paid;
            ?>
        </td>
    </tr>
    <tr>
        <td>
            <b>Bill Items</b>
        </td>
        <td>
            <?php
            echo $items_ordered;
            ?>
        </td>
    </tr>

    </tbody>
</table>

    <h5 style="text-align: center">Key Areas of Assessment</h5>


    <?php
    $comments="";
    $quer1 = "select branch_surverys.*,categories.cat_name from branch_surverys left join categories on branch_surverys.cat_id=categories.cat_id where branch_surverys.c_id ='$cid'and branch_surverys.b_id='$bid'";
    $result = $conn->query($quer1);
    $q_no=0;
    $total=0;
    $achieved=0;
    $percent=0;
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {

            $cat_temp = $row['cat_id'];
            $score_query="SELECT `survey_id`, `cat_id`, `cat_name`, `max`, `achieved` FROM `score` WHERE score.cat_id=$cat_temp";
            $result_score= $conn->query($score_query);
            while ($score_row=$result_score->fetch_assoc()){
                $total=$score_row['max'];
                $achieved=$score_row['achieved'];
                $percent=($achieved/$total)*100;
            }

            echo "<table class='table table-bordered table-sm' >
<thead>
    <th style='color: mediumblue'>
<b>" . $row['cat_name'] . "</b>
    </th>
    <th style='width: 100px;color: mediumblue'>
            Yes
    </th>
    <th style='width: 100px;color: mediumblue'>
            No
    </th>
    <th style='width: 100px;color: mediumblue'>
            N/A
    </th>
    </thead>
    <tbody>";
            $query2 = "select * from questions WHERE cat_id='$cat_temp'";
            $result1 = $conn->query($query2);
            if ($result1->num_rows > 0) {
                $counter = 0;
                while ($row1 = $result1->fetch_assoc()) {

                    $q_no++;
                    $q_id=$row1['q_id'];
                    $query_getanswer="SELECT answer,aid,comments FROM answers where qid=$q_id AND survey_id=$sid";
                    echo "<tr><td>" . $row1['q_statement'] . "</td>";
                    $answer = $conn->query($query_getanswer);
                    $ans="";
                    while ($a=$answer->fetch_assoc()){
                        $ans=$a['answer'];
                        $comments=$a['comments'];
                    }

                    if ($ans=="Yes"){
                        echo "<td>&#10003;</td><td></td><td></td>";
                    }
                    elseif ($ans=="No"){
                        echo "<td></td><td>&#10003;</td><td></td>";
                    }else {
                        echo "<td></td><td></td><td>&#10003;</td>";

                    }
                    if ($comments!=""){
                        echo "<tr style='border: none'> <td style='border: 2px solid black'>";
                        echo "<p style='color: mediumblue'><b>Shopper's Comments</b></p>";
                        echo $comments;
                        echo "</td></tr>";
                    }

                }


            }

            echo "<tr>";

            echo "<table class='table table-sm'><tbody>";
            echo "<tr>";
            echo "<td style='color: blue; border: none;padding-left: 50px'>Points Possible</td>";
            echo "<td style='color: blue; border: 2px solid black; text-align: center;width: 300px'>".$total."</td>";
            echo "</tr>";
            echo "<tr>";
            echo "<td style='color: blue; border: none;padding-left: 50px'>Points Achieved</td>";
            echo "<td style='color: blue; border: 2px solid black; text-align: center;width: 300px'>".$achieved."</td>";
            echo "</tr>";
            echo "<tr>";
            echo "<td style='color: blue; border: none;padding-left: 50px'>Percent Achieved</td>";
            echo "<td style='color: blue; border: 2px solid black; text-align: center;width: 300px'>".round($percent,2)."%</td>";
            echo "</tr>";
            echo "</tbody></table>";

            echo "</tr>";
            echo "</tbody></table>";
        }
    }


    ?>


</body>
</html>