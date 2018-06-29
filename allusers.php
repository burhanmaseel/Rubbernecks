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
    <link rel="stylesheet" href="bootstrap.css">
    <title>rubbernecks</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.css">
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.js"></script>
    <link rel="stylesheet" href="css/foundation.css" />
    <script src="js/vendor/modernizr.js"></script>
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

$query="SELECT * FROM users WHERE id<>1";
$select_all_users_query= mysqli_query($mysqli, $query);
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



<div class="table-responsive col-md-9 col-lg-9">
    <h4>ALL USERS</h4>
    <table class="table table-striped table-bordered table-light table-sm table-responsive" id="usertable">
        <tr>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Email</th>
            <th>Password</th>
            <th>User Type</th>
            <th>Action</th>
        </tr>
        <?php
        while ($row = mysqli_fetch_assoc($select_all_users_query)){
            $uid=$row['id'];
    $firstname=$row['fname'];
    $lastname=$row['lname'];
    $useremail=$row['email'];
    $usertype=$row['usertype'];
    $password=$row['password'];




        echo "<tr>";
        echo "<td>".$firstname."</td>";
        echo "<td>".$lastname."</td>";
        echo "<td class='well'>".$useremail."</td>";
            echo "<td>".$password."</td>";

            echo "<td>".$usertype."</td>";
            echo "<td><a class=\"btn btn-danger\" href=\"deleteuser.php?uid=$uid\">Delete</a></td>";
        echo "</tr>";
        }

        ?>



    </table>
</div>

</div>
</body>
</html>