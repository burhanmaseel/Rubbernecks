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
    <link rel="stylesheet" href="css/foundation.css" />
    <script src="js/vendor/modernizr.js"></script>
    <link rel="stylesheet" href="style.css" type="text/css">
    <link rel="stylesheet" href="bootstrap.css" type="text/css">
    <title>rubbernecks</title>
    <link rel="shortcut icon" href="favicon.ico" />

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
                    <button class="btn btn-block btn-toolbar"><a href="allusers.php" style="color: white">View All Users</a></button>
                </div>
            </div>
        <div class="row">
            <div class="col-md-9 col-lg-9 col-sm-9" style="background-color: #6c757d">
                <form action="insert.php" method="post">
                    <div class="form-group">
                        <label for="fname">First Name:</label>
                        <input type="text" class="form-control" id="fname" name="fname" required>
                    </div>
                    <div class="form-group">
                        <label for="lname">Last Name:</label>
                        <input type="text" class="form-control" id="lname" name="lname" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email address:</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="form-group">
                        <label for="pwd">Password:</label>
                        <input type="password" class="form-control" id="pwd" name="password" required>
                    </div>
                    <div class="form-group">
                        <select class="form-control" id="User Type" name="usertype">
                            <option selected>User</option>
                            <option>Admin</option>
                            <option>Super Admin</option>
                        </select>
                        <label for="User Type">User Type</label>
                    </div>
                    <button type="submit" class="btn btn-block btn-primary">Add User</button>
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
