<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>$Title$</title>
    <link rel="stylesheet" href="css/bootstrap.css">
    <!--    <script src="js/bootstrap.js"></script>-->
    <script src="js/jquery-3.3.1.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.js"></script>

</head>
<body>

<?php
session_start();


include 'connection.php';
$question = array();
$super = array();


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

<div class="jumbotron">
    <div class="container-fluid">
        <div class="col-lg-4 form-group">

            <div class="well">
                <label for="">Select Cleint</label>
                <select id="clientoptions" onchange="myFunction()">
                    <option value="">-------</option>

                    <?php
                    $temp =array();
                    $sql = "SELECT * FROM clients";
                    $clients = $conn->query($sql);



                    if ($clients->num_rows > 0) {

                        while ($row = $clients->fetch_assoc()) {
                          array_push($temp,$row);
                            if ((int)$row["c_id"] == $cid) {
                                echo "<option  value='" . $row["c_id"] . "'selected >" . $row["c_name"] . "</option>";
                            } else
                                echo "<option value='" . $row["c_id"] . "'>" . $row["c_name"] . "</option>";
                        }
                    }


                    $super = json_encode($temp);
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

            <label for="">Category Type</label>

            <input type="text" id="cat_type" value="" placeholder=" Category type here" class="form-control">

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

    <script>

        var questions = new Array();
        $(document).ready(function () {

          <?php

          $js_array = json_encode($super);
          echo "charts = ". $js_array . ";\n";
          ?>

//alert(charts);
var prep1 = [];
var prep = JSON.parse(charts)

for(j=0;j<prep.length;j++)
{

prep1.push(

  {


label:String(prep[j].c_name),
y:parseInt((prep[j].c_id))

  }
)


}



var x = {
  theme: "light1", // "light2", "dark1", "dark2"
  	animationEnabled: false, // change to true
  	title:{
  		text: "Basic Column Chart"
  	},
  	data:prep1

};

alert(x.theme);






//alert(prep[1].c_id);
//alert(prep[1].c_name);



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
                        cat_type: document.getElementById('cat_type').value
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
