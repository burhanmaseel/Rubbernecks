<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>rubbernecks</title>
    <link rel="stylesheet" href="css/bootstrap.css">
    <!--    <script src="js/bootstrap.js"></script>-->
    <script src="js/jquery-3.3.1.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.js"></script>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="/resources/demos/style.css">

    <link rel="stylesheet" href="css/foundation.css" />
    <script src="js/vendor/modernizr.js"></script>
    <link rel="stylesheet" href="style.css" type="text/css">
    <link rel="stylesheet" href="bootstrap.css" type="text/css">

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

<?php

include 'connection.php';
$cid = -1;
$bid = -1;
$cid=($_GET['client']);
$bid=$_GET['branch'];

?>



<div class="col-md-8">
    <form action="" method="">

        <div class="well">
            <label for="">Key Areas of Interest</label>

            <?php

            $quer1 = "select branch_surverys.*,categories.cat_name from branch_surverys left join categories on branch_surverys.cat_id=categories.cat_id where branch_surverys.c_id ='$cid'and branch_surverys.b_id='$bid'";
            $result = $conn->query($quer1);
            $q_no=0;
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {

                    $cat_temp = $row['cat_id'];
                    echo "<div class='well'><label>" . $row['cat_name'] . "</label>";
                    $query2 = "select * from questions WHERE cat_id='$cat_temp'";
                    $result1 = $conn->query($query2);
                    if ($result1->num_rows > 0) {
                        $counter = 0;
                        while ($row1 = $result1->fetch_assoc()) {

                            echo "<div><section>";
                            $counter++;
                            $q_no++;
                            $q_id=$row1['q_id'];
                            echo "Q." . $counter . "  <span>" . $row1['q_statement'] . "</span>";
                            echo "<span style='position:relative;left: 150px' >
                                <a class=\"btn btn-danger\" href=\"deletequestion.php?qid=$q_id\">Delete</a>
                           </span></section>";
                            echo "</div>";

                        }


                    }

                    echo "</div>";

                }
            }


            ?>
        </div>
    </form>
</div>

</div>
<script>

    function myFunction() {

        window.location = '?cid=' + $("#clientoptions").val() + '&bid=' + $("#branchoptions").val();


    }


</script>

</body>
</html>