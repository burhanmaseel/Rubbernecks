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
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>rubbernecks</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="css/foundation.css" />
    <link rel="stylesheet" href="style.css" type="text/css">
    <link rel="stylesheet" href="bootstrap.css" type="text/css">
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }

        td, th {
            text-align: left;
            padding: 8px;
        }

    </style>
    <link rel="shortcut icon" href="favicon.ico" />

</head>
<body>

<?php
include ('config.php');

$branchesquery="SELECT clients.*,branch.b_name FROM clients, branch WHERE clients.c_id=branch.client_id";
$find_count= mysqli_query($mysqli, $branchesquery);
$count=mysqli_num_rows($find_count);
$select_all_branches_query= $mysqli->query($branchesquery);
?>

<nav class="top-bar" data-topbar role="navigation">
    <ul class="title-area">
        <li class="name">
            <h1><a href="#">rubbernecks</a></h1>
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


<div class="row">
    <div class="col-md-3 col-lg-3 col-sm-3">
        <div class="sidenav">
            <div class="img-fluid align-content-center col-md-12">
                <img src="bar_logo.ico" alt="">
            </div>
            <a href="schedules.php">Schedules</a>
            <a href="addclients.php">Clients</a>
            <a href="addusers.php">Users</a>
            <a href="generateform.php">Generate Forms</a>
            <a href="allgenforms.php">All Generated Forms</a>
            <a href="assignforms.php">Assign Forms</a>
            <a href="reports.php">Reports</a>
        </div>
    </div>



    <div class="table-responsive col-md-9 col-lg-9 table-sm">
        <h4>ALL CLIENTS</h4>
        <table class="table table-striped table-bordered table-light" id="clienttable">
            <tr>
                <th>Client Name</th>
                <th>Branch Name</th>
                <th>Contract Start Date</th>
                <th>Contract End Date</th>
            </tr>
            <?php
            while ($row = mysqli_fetch_assoc($select_all_branches_query)){
                $clientname=$row['c_name'];
                $branchname=$row['b_name'];
                $sdate=$row['sdate'];
                $edate=$row['edate'];





                echo "<tr>";
                echo "<td>".$clientname."</td>";
                echo "<td>".$branchname."</td>";
                echo "<td>".$sdate."</td>";
                echo "<td>".$edate."</td>";
                echo "</tr>";
            }

            ?>



        </table>
    </div>

</div>
</body>
</html>