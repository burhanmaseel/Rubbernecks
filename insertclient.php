<?php
/**
 * Created by PhpStorm.
 * User: burhan
 * Date: 5/27/2018
 * Time: 1:33 PM
 */

include 'config.php';

if (!isset($_POST["client"])){
    header ("location:errorregister.php");
}


$client = $_POST["client"];
$sdate = $_POST ["startdate"];
$edate = $_POST ["enddate"];
$clientType= $_POST["clienttype"];

if($mysqli->query("INSERT INTO clients (c_name,sdate,edate,c_disc) VALUES('$client','$sdate','$edate','$clientType')")){
    echo 'Data inserted';
    echo '<br/>';
}else{
    echo $mysqli->error;
}

header ("location:addclients.php");

?>