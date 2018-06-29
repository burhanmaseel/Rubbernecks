<?php
/**
 * Created by PhpStorm.
 * User: burhan
 * Date: 6/11/2018
 * Time: 4:04 PM
 */

include 'config.php';

$sql = "SELECT clients.c_id,clients.c_name,branch.b_id, branch.b_name FROM clients,branch,branch_surverys WHERE clients.c_id=branch_surverys.c_id AND branch_surverys.b_id=branch.b_id GROUP BY clients.c_name";
$select_all_clients_query= mysqli_query($mysqli, $sql);

?>


<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>rubbernecks</title>
    <script src="js/jquery-3.3.1.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.js"></script>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <link rel="stylesheet" href="css/foundation.css" />
    <script src="js/vendor/modernizr.js"></script>
    <link rel="stylesheet" href="style.css" type="text/css">
    <link rel="stylesheet" href="bootstrap.css" type="text/css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.0.0/jquery.min.js" type="text/javascript"></script>
    <script>
        function getbranch(val) {

            $.ajax({
                type:"POST",
                url:"getbranch.php",
                data:'client_id='+val,
                success: function (data) {
                    $("#branch-list").html(data);
                }
            })

        }

    </script>
    <link rel="shortcut icon" href="favicon.ico" />

</head>
<body>
<?php
session_start();

include 'connection.php';

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

<div class="jumbotron">
    <h4>Get Reports</h4>
    <div class="container-fluid">
        <div class="col-lg-12 form-group">
            <form action="getreport.php" method="post">
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
                  <!---  <a href="interbranch.php?cid=<?php// echo $client_id;?>" class="button btn-success btn-block">Get Inter Branch Report</a> --->

                </div>

                <div class="well">
                    <div class="form-group">
                        <label for="branch">Select Branch:</label>
                        <select name="branch" id="branch-list">
                        </select>
                    </div>

                </div>



                <button id="submitall" class="btn-block" type="submit">Get Reports</button>

            </form>
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
