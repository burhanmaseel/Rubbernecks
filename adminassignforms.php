<?php
/**
 * Created by PhpStorm.
 * User: burhan
 * Date: 6/11/2018
 * Time: 4:04 PM
 */
if(session_id() == '' || !isset($_SESSION)){session_start();}

if(!isset($_SESSION["username"])) {
    header("location:adminforms.php");
}

if($_SESSION["type"]!="Admin") {
    header("location:login.html");
}


include 'config.php';

$sql = "SELECT clients.c_id,clients.c_name,branch.b_id, branch.b_name FROM clients,branch,branch_surverys WHERE clients.c_id=branch_surverys.c_id AND branch_surverys.b_id=branch.b_id GROUP BY clients.c_name";
$select_all_clients_query= mysqli_query($mysqli, $sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>rubbernecks</title>
    <link rel="stylesheet" href="bootstrap.css">
    <!--    <script src="js/bootstrap.js"></script>-->
    <script src="js/jquery-3.3.1.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.js"></script>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <link rel="stylesheet" href="css/foundation.css" />
    <script src="js/vendor/modernizr.js"></script>
    <link rel="stylesheet" href="style.css" type="text/css">
    <link rel="stylesheet" href="bootstrap.css" type="text/css">
    <link rel="shortcut icon" href="favicon.ico" />

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

</head>
<body>

<?php

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
            <a href="adminforms.php">Generate Forms</a>
            <a href="adminassignforms.php">Assign Forms</a>

        </div>
    </div>

    <div class="jumbotron">
        <h4> Assign Forms</h4>
        <div class="container-fluid">
            <div class="col-lg-12 form-group">
                <form action="insertassignform.php" method="post">
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
                            <label for="branch">Select Branch:</label>
                            <select name="branch" id="branch-list">
                            </select>
                        </div>

                    </div>

                    <div class="well">
                        <label for="">Select User</label>

                        <select id="useroption" name='uname'">
                        <option value="">-------</option>

                        <?php

                        $sql1 = "SELECT * FROM `users` WHERE `usertype`='User'";
                        $users = $conn->query($sql1);

                        if ($users->num_rows > 0) {

                            while ($row = $users->fetch_assoc()) {
                                if ((int)$row["id"] == $id) {
                                    echo "<option value='" . $row["id"] . "'selected >" . $row["fname"] ." " .$row["lname"]. "</option>";
                                } else
                                    echo "<option value='" . $row["id"] . "'>" . $row["fname"] ." " .$row["lname"] . "</option>";
                            }
                        }
                        ?>


                        </select>

                    </div>

                    <div class="well">

                        <label for="assigndate">Assign Date:</label>
                        <input type="date" class="form-control" name="assigndate" required>

                    </div>



                    <button id="submitall" class="btn-block" type="submit">Assign</button>

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