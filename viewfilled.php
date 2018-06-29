<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>rubbernecks</title>
    <link rel="stylesheet" href="css/bootstrap.css">
    <!--    <script src="js/bootstrap.js"></script>-->
    <script src="js/jquery-3.3.1.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.js"></script>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="/resources/demos/style.css">

    <link rel="stylesheet" href="css/foundation.css" />
    <script src="js/vendor/modernizr.js"></script>
    <link rel="stylesheet" href="style.css" type="text/css">
    <link rel="stylesheet" href="bootstrap.css" type="text/css">
    <link rel="shortcut icon" href="favicon.ico" />

</head>
<body>
<nav class="top-bar" data-topbar role="navigation">
    <ul class="title-area">
        <li class="name">
            <h1><a href="schedules.php">rubbernecks</a></h1>
        </li>
        <li class="toggle-topbar menu-icon"><a href="#"><span></span></a></li>
    </ul>

    <section class="top-bar-section">
        <!-- Right Nav Section -->
        <ul class="right">
            <li><a href="logout.php" style="background-color: firebrick">Log Out</a></li>
        </ul>
    </section>
</nav>


<?php

include 'connection.php';
$cid = -1;
$bid = -1;
$uid = -1;
$survey_id=$_GET['survey'];

$query="SELECT * FROM surveys WHERE survey_id=$survey_id";
$rs= $conn->query($query);
while ($r=$rs->fetch_assoc()){
    $cid=$r['cid'];
    $bid=$r['bid'];
    $uid=$r['user_id'];
    $location=$r['location'];
    $date=$r['visit_date'];
    $profile=$r['profile'];
    $time=$r['visit_time'];
    $total_members=$r['total_members'];
    $member_name=$r['member_name'];
    $cashier_name=$r['cashier_name'];
    $bill_no=$r['bill_no'];
    $total_paid=$r['total_paid'];
    $items_ordered=$r['items_ordered'];
    $addcomments=$r['addcom'];
}

?>

<div class="well" style="position: relative;height: auto; top: 20px">
    <section>

        <label for=""><b>Service And Cashier Assessment Report</b></label>

        <div class="form-group">
            <label for="location">Store Location:</label><p style="font-weight: bolder;color: red"><?php echo $location;?></p>
        </div>
        <div class="form-group">
            <label for="datepicker">Date of Visit:</label><p style="font-weight: bolder;color: red"><?php echo $date;?></p>
        </div>
        <div class="form-group">
            <label for="profile">Profile of Shopper:</label><p style="font-weight: bolder;color: red"><?php echo $profile;?></p>
        </div>
        <div class="form-group">
            <label for="time">Time of Visit:</label><p style="font-weight: bolder;color: red"><?php echo $time;?></p>
        </div>
        <div class="form-group">
            <label for="total_members">Total Team Members in Store:</label><p style="font-weight: bolder;color: red"><?php echo $total_members;?></p>
        </div>
        <div class="form-group">
            <label for="member_name">Name of Member attended you:</label><p style="font-weight: bolder;color: red"><?php echo $member_name;?></p>
        </div>
        <div class="form-group">
            <label for="cashier_name">Name of Cashier attended you:</label><p style="font-weight: bolder;color: red"><?php echo $cashier_name;?></p>
        </div>
        <div class="form-group">
            <label for="bill_no">Bill/Receipt No:</label><p style="font-weight: bolder;color: red"><?php echo $bill_no;?></p>
        </div>
        <div class="form-group">
            <label for="total_paid">Total Paid:</label><p style="font-weight: bolder;color: red"><?php echo $total_paid;?></p>
        </div>
        <div class="form-group">
            <label for="items_ordered">Items Ordered:</label><p style="font-weight: bolder;color: red"><?php echo $items_ordered;?></p>
        </div>



    </section>
</div>

<div class="well">
    <label for=""><b>Key Areas of Interest</b></label>

    <?php
$comments="";
    $quer1 = "select branch_surverys.*,categories.cat_name from branch_surverys left join categories on branch_surverys.cat_id=categories.cat_id where branch_surverys.c_id ='$cid'and branch_surverys.b_id='$bid'";
    $result = $conn->query($quer1);
    $q_no=0;
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {

            $cat_temp = $row['cat_id'];
            echo "<div class='well'><label>" . $row['cat_name'] . "</label>";
            $query2 = "select * from questions WHERE cat_id='$cat_temp'";
            $result1 = $conn->query($query2);
            if ($result1->num_rows > 0) {
                $counter = 0;
                while ($row1 = $result1->fetch_assoc()) {

                    echo "<div><section>";
                    $counter++;
                    $q_no++;
                    $q_id=$row1['q_id'];
                    echo "Q." . $counter . "  <span>" . $row1['q_statement'] . "</span>";

                    $query_getanswer="SELECT answer,aid,comments FROM answers where qid=$q_id AND survey_id=$survey_id";
                    $answer = $conn->query($query_getanswer);
                    $ans="";
                    $aid=-1;
                    while ($a=$answer->fetch_assoc()){
                        $ans=$a['answer'];
                        $aid=$a['aid'];
                        $comments=$a['comments'];
                    }


                    echo "<span style='position:relative;left: 150px' >
                                Answer = <b style='color: red'>$ans</b>&nbsp;&nbsp;
                                Comments = <b>$comments</b><br>
                                <form method='post' action='changevalue.php'>
                                <label class='radio-inline'><input type='radio' name=\"answer\" value='Yes'>Yes</label>
                                <label class='radio-inline'><input type='radio' name=\"answer\" value='No'>No</label>
                                <label class='radio-inline'><input type='radio' name=\"answer\" value='N/A'>N/A</label>
                                <input type='hidden' name='answer_id' value='$aid'>                                
                                <button type='submit' class='btn btn-sm btn-primary'>Change</button></form>
                           </span></section>";
                    echo "</div>";

                }


            }

            echo "</div>";

        }
    }


    ?>
    <div class="form-group">
        <label for="addcom">Additional Comments(Optional):</label><p style="font-weight: bolder;color: red"><?php echo $addcomments;?></p>
    </div>
    <a href="savereviewed.php?surveyid=<?php echo $survey_id;?>" class="btn btn-block btn-success">SAVE</a>
</div>



<script>

    function myFunction() {

        window.location = '?cid=' + $("#clientoptions").val() + '&bid=' + $("#branchoptions").val();


    }


</script>

</body>
</html>