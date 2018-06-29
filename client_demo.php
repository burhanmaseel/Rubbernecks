<?php



if(session_id() == '' || !isset($_SESSION)){session_start();}

if(!isset($_SESSION["username"])) {
    header("location:login.php");
}

if($_SESSION["type"]!="User") {
    header("location:login.html");
}

?>

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
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <link rel="stylesheet" href="css/foundation.css" />
    <script src="js/vendor/modernizr.js"></script>
    <link rel="stylesheet" href="style.css" type="text/css">
    <link rel="stylesheet" href="bootstrap.css" type="text/css">
    <script>
        $( function() {
            $( "#datepicker" ).datepicker();
        } );
    </script>
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
<?php

include 'connection.php';
$cid = -1;
$bid = -1;
if ($_SERVER['REQUEST_METHOD'] == 'GET') {

    if (isset($_GET['cid'])) {
        $cid = $_GET['cid'];

    }

    if (isset($_GET['bid'])) {
        $bid = $_GET['bid'];

    }
}

?>


<div class="well">
    <label for="">Select Cleint</label>
    <select id="clientoptions" onchange="myFunction()">

        <option value="">-------</option>
        <?php
        $sql = "SELECT clients.* FROM clients, assigned WHERE clients.c_id=assigned.cid AND assigned.uid=".$_SESSION['id']." GROUP BY clients.c_id";
        $clients = $conn->query($sql);
        global $cid;

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

        <option value="" selected>-------</option>
        <?php

        $sql1 = "SELECT branch.* FROM branch, assigned,clients WHERE branch.b_id=assigned.b_id AND branch.client_id='$cid' AND assigned.uid=".$_SESSION['id']." GROUP BY branch.b_id";
        $branches = $conn->query($sql1);

        global $bid;
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
<div>
    <form action="answers.php" method="post">
<div class="well" style="position: relative;height: auto; top: 20px">
    <section>

    <label for=""><b>Service And Cashier Assessment Report</b></label>

        <div class="form-group">
            <label for="location">Store Location:</label>
            <input type="text" id="location" name="location" required>
        </div>
        <div class="form-group">
            <label for="datepicker">Date of Visit:</label>
            <input type="text" id="datepicker" name="date" required>
        </div>
        <div class="form-group">
            <label for="profile">Profile of Shopper:</label>
            <input type="text" id="profile" name="profile" required>
        </div>
        <div class="form-group">
            <label for="time">Time of Visit:</label>
            <input type="text" id="time" name="time" required>
        </div>
        <div class="form-group">
            <label for="timeout">Time Out:</label>
            <input type="text" id="timeout" name="timeout">
        </div>
        <div class="form-group">
            <label for="total_members">Total Team Members in Store:</label>
            <input type="text" id="total_members" name="total_members" required>
        </div>
        <div class="form-group">
            <label for="member_name">Name of Member attended you:</label>
            <input type="text" id="member_name" name="member_name" required>
        </div>
        <div class="form-group">
            <label for="cashier_name">Name of Cashier attended you:</label>
            <input type="text" id="cashier_name" name="cashier_name" required>
        </div>
        <div class="form-group">
            <label for="bill_no">Bill/Receipt No:</label>
            <input type="text" id="bill_no" name="bill_no" required>
        </div>
        <div class="form-group">
            <label for="total_paid">Total Paid:</label>
            <input type="text" id="total_paid" name="total_paid" required>
        </div>
        <div class="form-group">
            <label for="items_ordered">Items Ordered:</label>
            <input type="text" id="items_ordered" name="items_ordered" required>
        </div>


        
    </section>
</div>

<div class="well">
    <label for=""><b>Key Areas of Interest</b></label>

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
                    $user_id=$_SESSION['id'];
                    $q_id=$row1['q_id'];
                    echo "Q." . $counter . "  <span>" . $row1['q_statement'] . "</span>";
                    echo "<span style='position:relative;left: 150px;' >
                                <label class='radio-inline'><input type='radio' name=\"answer_$q_no\" value='Yes' checked='checked'>Yes</label>
                                <label class='radio-inline'><input type=\"radio\" name=\"answer_$q_no\" value='No'>No</label>
                                <label class='radio-inline'><input type=\"radio\" name=\"answer_$q_no\" value='N/A'>N/A</label>                                
                                <label class=''><input type='text' name='comment_$q_no' placeholder='Enter Comments Here'></label>
                                <input type='hidden' value='$q_id' name='q_$q_no'>
                                <input type='hidden' value='$cid' name='clientid'>                                
                                <input type='hidden' value='$bid' name='branchid'>
                                <input type='hidden' value='$q_no' name='q_count'>
                                <input type='hidden' value='$user_id' name='user_id'>                                
                           </span>
                           </section>";
                    echo "</div>";

                }


            }

            echo "</div>";

        }
    }


    ?>
    <div class="form-group">
        <label for="addcom">Additional Comments(Optional):</label>
        <input type="text" id="addcom" name="addcom">
    </div>
    <button type="submit" class="btn-block btn-primary">Submit</button>
</div>
    </form>
</div>


<script>

    function myFunction() {

        window.location = '?cid=' + $("#clientoptions").val() + '&bid=' + $("#branchoptions").val();


    }


</script>

</body>
</html>