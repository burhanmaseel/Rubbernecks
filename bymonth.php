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

$query="SELECT * FROM clients";
$select_all_clients_query= $mysqli->query($query);

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

<h2 style="text-align: center; padding: 10px" class="title badge-danger"><a href="schedules.php" style="color: white">Schedules</a></h2>


<div class="row">
    <div class="col-md-4" style="margin: 100px">
        <form action="getbymonth.php" method="post">
            <div class="well">
                <label for="">Select Cleint</label>
                <label for="clients">Select Client:</label>
                <select name="clients" id="clients" onchange="getbranch(this.value)">
                    <option value="">-------</option>
                    <?php
                    while ($row = mysqli_fetch_assoc($select_all_clients_query)){
                        $client_name=$row['c_name'];
                        $client_id=$row['c_id'];
                        echo "<option value='".$client_id."'>".$client_name."</option>";
                    }
                    ?>
                </select>

            </div>

            <div class="well">
                <div class="form-group">
                    <label for="month">Select Month:</label>
                    <select name="month" id="month">
                        <option value="01">January</option>
                        <option value="02">February</option>
                        <option value="03">March</option>
                        <option value="04">April</option>
                        <option value="05">May</option>
                        <option value="06">June</option>
                        <option value="07">July</option>
                        <option value="08">August</option>
                        <option value="09">September</option>
                        <option value="10">October</option>
                        <option value="11">November</option>
                        <option value="12">December</option>
                    </select>
                    <label for="year">Select Year:</label>
                    <select name="year" id="year">
                        <option value="2018">2018</option>
                        <option value="2019">2019</option>
                        <option value="2020">2020</option>
                        <option value="2021">2021</option>
                        <option value="2022">2022</option>
                        <option value="2023">2023</option>
                        <option value="2024">2024</option>
                        <option value="2025">2025</option>
                        <option value="2026">2026</option>
                        <option value="2027">2027</option>
                        <option value="2028">2028</option>
                        <option value="2029">2029</option>
                        <option value="2030">2030</option>
                    </select>
                </div>

            </div>

            <button id="submitall" class="btn-block" type="submit">Get By Month</button>

        </form>
    </div>
</div>



<script src="js/vendor/jquery.js"></script>
<script src="js/foundation.min.js"></script>
<script>
    $(document).foundation();
</script>

</body>
</html>

