<?php

include "config.php";
$query="SELECT clients.c_name,clients.c_id,branch.b_id, branch.b_name FROM clients, branch, branch_surverys WHERE clients.c_id=branch_surverys.c_id AND branch.b_id=branch_surverys.b_id GROUP BY branch_surverys.b_id";
$select_all_survey= $mysqli->query($query);


?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>rubbernecks</title>
    <link rel="stylesheet" href="css/foundation.css" />
    <script src="js/vendor/modernizr.js"></script>
    <link rel="stylesheet" href="style.css" type="text/css">
    <link rel="shortcut icon" href="favicon.ico" />

    <link rel="stylesheet" href="bootstrap.css" type="text/css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css">
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

        <div class="">
            <h4>All Generated Forms</h4>
            <table class="table table-striped table-bordered">
                <thead>
                <tr>
                    <th>Client Name</th>
                    <th>Branch Name</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                <?php
                while ($row=mysqli_fetch_assoc($select_all_survey)){
                    $client=$row['c_name'];
                    $branch=$row['b_name'];
                    $cid=$row['c_id'];
                    $bid=$row['b_id'];

                    echo "<tr>";

                    echo "<td>".$client."</td>";
                    echo "<td>".$branch."</td>";
                    echo "<td>";
                    echo '<a class="btn btn-primary" href="viewforms.php?client='.$cid.'&branch='.$bid.'">Read</a>';
                    echo "</td>";



                    echo "</tr>";

} ?>
                    </tbody>
            </table>
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