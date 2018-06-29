<?php
/**
 * Created by PhpStorm.
 * User: burhan
 * Date: 6/11/2018
 * Time: 12:56 PM
 */

session_start();
include 'config.php';


    $cid = $_POST['clients'];
    $b_id = $_POST['branch'];
    $id = $_POST['uname'];
    $date = $_POST['assigndate'];





$query1 = "INSERT INTO `assigned`(`cid`, b_id, `uid`, `assigndate`) VALUES ('$cid','$b_id','$id','$date')";
if ($mysqli->query($query1)) {

    header("location:assignforms.php");
}else{
    echo $mysqli->error;
}