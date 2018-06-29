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


</head>
<body>

<?php
session_start();

include 'connection.php';
$question = array();

$flash_data = "";
if (isset($_SESSION['post'])) {
    $flash_data = $_SESSION['post'];
    unset ($_SESSION["post"]);

}

if ($_SERVER['REQUEST_METHOD'] == 'GET') {

    if (isset($_GET['cid'])) {
        $cid = $_GET['cid'];

    }

    if (isset($_GET['bid'])) {
        $bid = $_GET['bid'];

    }
}


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
    <div class="container-fluid">
        <div class="col-lg-8 form-group">

            <div class="well">
                <label for="">Select Cleint</label>
                <select id="clientoptions" onchange="myFunction()">
                    <option value="">-------</option>

                    <?php
                    $sql = "SELECT * FROM clients";
                    $clients = $conn->query($sql);

                    if ($clients->num_rows > 0) {

                        while ($row = $clients->fetch_assoc()) {
                            if ((int)$row["c_id"] == $cid) {
                                echo "<option  value='" . $row["c_id"] . "'selected >" . $row["c_name"] . "</option>";
                            } else
                                echo "<option value='" . $row["c_id"] . "'>" . $row["c_name"] . "</option>";
                        }
                    }

                    ?>

                </select>

            </div>

            <div class="well">
                <label for="">Select Branch</label>

                <select id="branchoptions" onchange="myFunction()">
                    <option value="">-------</option>

                    <?php

                    $sql1 = "SELECT * FROM branch where client_id='$cid'";
                    $branches = $conn->query($sql1);

                    if ($branches->num_rows > 0) {

                        while ($row = $branches->fetch_assoc()) {

                            if ((int)$row["b_id"] == $bid)
                                echo "<option value='" . $row["b_id"] . "'selected>" . $row["b_name"] . "</option>";
                            else
                                echo "<option value='" . $row["b_id"] . "'>" . $row["b_name"] . "</option>";
                        }

                    }
                    ?>


                </select>

            </div>

            <label for="">Category Name</label>

            <input type="text" id="cat_name" value="" placeholder="Category name here" class="form-control">


            <div class="well">

                <h3 class="h3">Add questions</h3>

                <div class="well" id="questions">
                    <label for="">your questions</label>


                </div>


                <div class="well">
                    <label for="">please add your Question here</label>
                    <input type="text" class="form-control" id="addedqustion" placeholder="your question here" value="">
                    <button class="btn-dark" id="qbtn">Add Question</button>
                </div>

            </div>


        </div>

        <button id="submitall" class="btn-block">Submit all</button>

        <?php
        echo $flash_data;
        ?>

    </div>
</div>
</div>
    <script>

        var questions = new Array();
        $(document).ready(function () {


                var temp = <?php array_push($question, "<") ?>
                    $("#questions").append("<br />");


                $("#qbtn").click(function () {
                    questions.push(document.getElementById('addedqustion').value);
                    $("#questions").append(
                        document.getElementById('addedqustion').value + "<br>"
                    )

                });

                $("#submitall").click(do_submit_all)
            }
        );


        function myFunction() {

            window.location = '?cid=' + $("#clientoptions").val() + '&bid=' + $("#branchoptions").val();


        }

        function do_submit_all() {


            // if php 7.0 or greater use followings

            $.ajax({
                type: "POST",
                url: "execute.php",
                data: {
                    questions_php: {
                        q: JSON.stringify(questions),
                        c_id: $("#clientoptions").val(),
                        b_id: $("#branchoptions").val(),
                        cat_name: document.getElementById('cat_name').value,
                    }
                },
                success: function (data) {

                    // var json = $.parseJSON(data); // create an object with the key of the array
                    // alert(json.html); // where html is the key of array that you want, $response['html'] = "<a>something..</a>";

                    //alert(data);
                    location.reload();
                },
                error: function (data) {
                    // var json = $.parseJSON(data);
                    //alert(json.error);

                    //location.reload();

                }
            });
        }


    </script>


</body>
</html>