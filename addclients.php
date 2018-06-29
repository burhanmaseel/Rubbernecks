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


$clientquery="SELECT * FROM clients";
$find_count= mysqli_query($mysqli, $clientquery);
$count=mysqli_num_rows($find_count);

$count=ceil($count/10);
$query="SELECT * FROM clients";
$select_all_clients_query= mysqli_query($mysqli, $query);
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
    <link rel="shortcut icon" href="favicon.ico" />

    <title>rubbernecks</title>
</head>
<body>

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

    <div class="col-md-9 col-lg-9 col-sm-9">
        <div class="row">
            <div class="col-md-4 col-lg-4 col-sm-4 right-align" style=" margin: 10px">
                <button class="btn btn-block btn-toolbar"><a href="allclients.php" style="color: white">View All Clients</a></button>
            </div>
        </div>
        <div class="row">
            <div class="col-md-9 col-lg-9 col-sm-9" style="background-color: #6c757d; border: solid 2px black">
                <form action="insertclient.php" method="post">
                    <div class="form-group">
                        <label for="client" style="color: white">Client Name:</label>
                        <input type="text" class="form-control" id="client" name="client" required>
                    </div>
                    <div class="form-group">
                        <label for="startdate" style="color: white">Contract Start Date:</label>
                        <input type="date" class="form-control" name="startdate" required>
                    </div>
                    <div class="form-group">
                        <label for="enddate" style="color: white">Contract End Date:</label>
                        <input type="date" class="form-control" name="enddate" required>
                    </div>
                    <div class="form-group">
                        <label for="clienttype" style="color: white">Client Type:</label>
                        <select name="clienttype" id="clienttype">
                            <option value="retail">Retail</option>
                            <option value="salon">Salon</option>
                            <option value="restaurant">Restaurant</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-block btn-primary">Add Client</button>
                </form>
            </div>
        </div>
        <div class="row">
            <div class="col-md-9 col-lg-9 col-sm-9" style="background-color: #5a6268; border: solid 2px black;border-top: 0px">
                <form action="insertbranch.php" method="post">
                    <div class="form-group">
                        <label for="clients" style="color: white">Select Client:</label>
                        <select name="clients">
                            <?php
                                while ($row = mysqli_fetch_assoc($select_all_clients_query)){
                                        $client_id=$row['c_id'];
                                        $client_name=$row['c_name'];
                                        echo "<option value='".$client_id."'>".$client_name."</option>";
                                }
                             ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="branch" style="color: white">Branch Name:</label>
                        <input type="text" class="form-control" id="branch" name="branch" required>
                    </div>
                    <button type="submit" class="btn btn-block btn-primary">Add Branch</button>
                </form>
            </div>
        </div>
    </div>
</div>



<script src="js/vendor/jquery.js"></script>
<script src="js/foundation.min.js"></script>
<script>
    $(document).foundation();
</script>

</body>
</html>

