<?php
/**
 * Created by PhpStorm.
 * User: burhan
 * Date: 6/13/2018
 * Time: 6:18 PM
 */
include 'config.php';

$client="";
$branch="";

$super = array();//added
$tempp=array();//added
$surveyss =array();
$categoreiss=array();
$cats =array();
$survs = array();



if($_SERVER['REQUEST_METHOD']=='POST'){
$client=$_POST['clients'];
$branch=$_POST['branch'];

}
//getting unique $surveyss
$uni_survery="SELECT survey_id FROM `score` group by survey_id";
$rs=$mysqli->query($uni_survery);

if($rs->num_rows>0){
    while ($row=$rs->fetch_assoc()){
        $survey_id=$row['survey_id'];
        array_push($surveyss,$survey_id);


    }

}





//getting unique $categoreiss
$uni_cat="SELECT cat_name FROM `score` group by cat_name";
$rs=$mysqli->query($uni_cat);

if($rs->num_rows>0){
    while ($row=$rs->fetch_assoc()){
        $survey_cat=$row['cat_name'];
        array_push($categoreiss,$survey_cat);


    }

}







//---------------------------------------------------------------------------------------

$query="SELECT survey_id FROM `surveys` WHERE surveys.cid=$client AND surveys.bid=$branch";
$rs=$mysqli->query($query);
$arr=array();

if($rs->num_rows>0){
    while ($row=$rs->fetch_assoc()){
        $survey_id=$row['survey_id'];
        array_push($arr,$survey_id);


    }

}

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>rubbernecks</title>
    <link rel="shortcut icon" href="favicon.ico" />
    <script src="js/jquery-3.3.1.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.js"></script>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <link rel="stylesheet" href="css/foundation.css" />
    <script src="js/vendor/modernizr.js"></script>
    <link rel="stylesheet" href="style.css" type="text/css">
    <link rel="stylesheet" href="bootstrap.css" type="text/css">
    <script src="canvasjs.min.js"></script>


</head>
<body>


<div class="row">

<div class="col-md-12" style="margin: 100px;align-content: center">
    <h4 style="align: center"><b>Trend Summary</b></h4>
<table class="table table-striped table-bordered table-sm table-danger">
    <thead>
    <th>Variables</th>
    <?php

        $sid = $arr[0];
        $query1 = "SELECT * FROM `score` WHERE score.survey_id=$sid";
        $result = $mysqli->query($query1);
        while ($rs = $result->fetch_assoc()) {
          //array_push($tempp,$rs);
            $cat_name = $rs['cat_name'];
            echo "<th>";
            echo $cat_name;
            echo "</th>";

        }






    ?>
    <th>Total</th>
    </thead>
    <tbody>
    <?php
    $temp=array();
    for ($i=0;$i<count($arr);$i++){
        $sid = $arr[$i];
        $query1 = "SELECT * FROM `score` WHERE score.survey_id=$sid";
        $result = $mysqli->query($query1);
        echo "<tr><td>";

        $varcount=$i+1;
        echo "<b>Visit-".$varcount."</b>";
        echo "</td>";
        $temp_count=0;
        $temp_total=0;
        while ($rs=$result->fetch_assoc()) {
          array_push($tempp,$rs);
            array_push($temp,$rs);
            $cat_name = $rs['cat_name'];
            $total=$rs['max'];
            $scored=$rs['achieved'];
            $percent=($scored/$total)*100;
            $temp_total=$temp_total+$percent;
            $temp_count++;
            if ($percent<50){
                echo "<td style='color: red'><b>".round($percent,2)."</b></td>";


            }else{
                echo "<td style='color: mediumblue'><b>".round($percent,2)."</b></td>";
            }

        }
        $temp_total=$temp_total/$temp_count;
        if ($temp_total<50){
            echo "<td style='color: red'><b>".round($temp_total,2)."</b></td>";


        }else{
            echo "<td style='color: mediumblue'><b>".round($temp_total,2)."</b></td>";
        }
        echo "</tr>";
    }

$super = json_encode($tempp);//added
$cats = json_encode($categoreiss);//added
$survs = json_encode($surveyss);//added

    ?>

    </tbody>

</table>
    <div id="chartContainer" style="height: 370px; max-width: 920px; margin: 0px auto;"></div>


<script>
$(document).ready(function(){

  <?php

//  $scoress = json_encode($super);
  echo "scores = ". json_encode($super) . ";\n";
  echo "categories = ". json_encode($cats) . ";\n";
  echo "surveys = ". json_encode($survs) . ";\n";
  ?>

  //alert(charts);

//  var prep = JSON.parse(charts)
 var scores= JSON.parse(scores);
 var categories= JSON.parse(categories);
 var surveys = JSON.parse(surveys);

//console.log(scores);
//console.log(categories);
//console.log(surveys);


var temp ={};
dataa =[];


for( var i=0;i<categories.length;i++)
{
pointsdata1=[];
        for(var k=0;k<scores.length;k++)
        {

            if(scores[k].cat_name==categories[i])
            {
              var point={

                y:parseInt((scores[k].achieved)/parseInt(scores[k].max)*100),
                label:"Survey "


              };
                pointsdata1.push(point);
            }

        }

  var tempdata={
    type: "column",
		name: categories[i],
		showInLegend: true,
		dataPoints:pointsdata1

  };
dataa.push(tempdata);
}


//console.log(pointsdata1);

//console.log(dataa);

var myobj = {
	animationEnabled: true,
	exportEnabled: true,
	title:{
		text: "surveys comparison"
	},
  legend: {
		cursor: "pointer",
		itemclick: toggleDataSeries
	},
	toolTip: {
		shared: true
	},
	data:dataa
}
var chart = new CanvasJS.Chart("chartContainer", myobj);
chart.render();







//console.log(myobj);



function toggleDataSeries(e) {
	if (typeof (e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
		e.dataSeries.visible = false;
	} else {
		e.dataSeries.visible = true;
	}
	e.chart.render();
}














});

</script>


</body>
</html>
