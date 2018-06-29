<?php

//if (session_status() !== PHP_SESSION_ACTIVE) {session_start();}
if(session_id() == '' || !isset($_SESSION)){session_start();}

if(!isset($_SESSION["username"])) {
    header("location:generateform.php");
}

if($_SESSION["type"]!="Super Admin") {
    header("location:login.html");
}

include 'config.php';

$query="SELECT clients.c_name, branch.b_name, users.fname,users.lname, assigned.assigndate,clients.edate FROM clients, users, branch,assigned WHERE clients.c_id= assigned.cid AND branch.b_id=assigned.b_id AND users.id=assigned.uid";
$select_all_assigned= $mysqli->query($query);

$query1="SELECT clients.c_name, branch.b_name, users.fname, users.lname, surveys.survey_id, filled_surveys.filled_date FROM clients, branch, users, surveys, filled_surveys WHERE clients.c_id=surveys.cid AND branch.b_id=surveys.bid AND users.id=surveys.user_id AND surveys.survey_id=filled_surveys.survey_id";
$select_all_done= $mysqli->query($query1);

$query2="SELECT clients.c_name, branch.b_name, users.fname, users.lname, done_surveys.done_date, done_surveys.survey_id,surveys.total_paid FROM clients,branch,users,surveys,done_surveys WHERE users.id=surveys.user_id AND clients.c_id=surveys.cid AND branch.b_id=surveys.bid AND done_surveys.survey_id=surveys.survey_id";
$select_all_checked= $mysqli->query($query2);
?>



<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/foundation.css" />
    <script src="js/vendor/modernizr.js"></script>
    <link rel="stylesheet" href="style.css" type="text/css">
    <link rel="stylesheet" href="bootstrap.css" type="text/css">

    <title>rubbernecks</title>
</head>
<body>

<nav class="top-bar" data-topbar role="navigation">
    <ul class="title-area">
        <li class="name">
            <h1><a href="allgenforms.php">rubbernecks</a></h1>
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

<h2 style="text-align: center; padding: 10px" class="title badge-danger">Schedules</h2>
<button class="btn btn-success" style="margin-left: 50px">
    <a href="bymonth.php" style="color: whitesmoke" class="btn">Schedules By Month</a>
</button>

<div class="row">
    <div class="col-md-4">
        <h4>Assigned</h4>
        <table class="table table-striped table-bordered table-sm table-danger">
            <thead>
            <tr>
                <th>Client Name</th>
                <th>Branch Name</th>
                <th>User Name</th>
                <th>Assign Date</th>
                <th>Contract End Date</th>
            </tr>
            </thead>
            <tbody>
            <?php
            while ($row=mysqli_fetch_assoc($select_all_assigned)){
                $client=$row['c_name'];
                $branch=$row['b_name'];
                $name=$row['fname']." ".$row['lname'];
                $assigndate=$row['assigndate'];
                $edate=$row['edate'];

                echo "<tr class='table-danger'>";

                echo "<td>".$client."</td>";
                echo "<td>".$branch."</td>";
                echo "<td>".$name."</td>";
                echo "<td>".$assigndate."</td>";
                echo "<td><b style='font-weight: bolder;color: red'>".$edate."</b></td>";





                echo "</tr>";

            } ?>
            </tbody>
        </table>
    </div>
    <div class="col-md-4">
        <h4>Checking</h4>
        <table class="table table-striped table-bordered table-sm">
            <thead>
            <tr>
                <th>Client Name</th>
                <th>Branch Name</th>
                <th>User Name</th>
                <th>Survey Date</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            <?php
            while ($row=mysqli_fetch_assoc($select_all_done)){
                $client=$row['c_name'];
                $branch=$row['b_name'];
                $name=$row['fname']." ".$row['lname'];
                $filleddate=$row['filled_date'];
                $surveyid=$row['survey_id'];

                echo "<tr>";

                echo "<td>".$client."</td>";
                echo "<td>".$branch."</td>";
                echo "<td>".$name."</td>";
                echo "<td>".$filleddate."</td>";
                echo "<td>";
                echo '<button class="btn btn-sm btn-primary"><a href="viewfilled.php?survey='.$surveyid.'" style="color: white">Review</a></button>';
                echo "</td>";


                echo "</tr>";

            } ?>
            </tbody>
        </table>
    </div>
    <div class="col-md-4">
        <h4>Done</h4>
        <table class="table table-striped table-bordered table-sm">
            <thead>
            <tr>
                <th>Client Name</th>
                <th>Branch Name</th>
                <th>User Name</th>
                <th>Total Amount</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            <?php
            while ($row=mysqli_fetch_assoc($select_all_checked)){
                $client=$row['c_name'];
                $branch=$row['b_name'];
                $name=$row['fname']." ".$row['lname'];
                $date=$row['done_date'];
                $sid=$row['survey_id'];
                $amountpaid=$row['total_paid'];
                echo "<tr>";

                echo "<td>".$client."</td>";
                echo "<td>".$branch."</td>";
                echo "<td>".$name."</td>";
                echo "<td>Rs.".$amountpaid."</td>";
                echo "<td>";
                echo '<button class="btn btn-sm btn-primary"><a href="viewdone.php?survey='.$sid.'" style="color: white">Edit</a></button>';
                echo '<button class="btn btn-sm btn-success"><a href="newpdf.php?survey_id='.$sid.'" style="color: white">PDF</a></button>';
                echo "</td>";


                echo "</tr>";

            } ?>
            </tbody>
        </table>
    </div>

</div>



<script src="js/vendor/jquery.js"></script>
<script src="js/foundation.min.js"></script>
<script>
    $(document).foundation();
</script>

</body>
</html>

