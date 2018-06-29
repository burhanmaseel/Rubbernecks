<?php
/**
 * Created by PhpStorm.
 * User: burhan
 * Date: 5/27/2018
 * Time: 1:33 PM
 */

include 'config.php';

if (!isset($_POST["fname"]) && !isset($_POST["lname"]) && !isset($_POST["email"]) && !isset($_POST["password"]) && !isset($_POST["usertype"])){
    header ("location:errorregister.php");
}


$fname = $_POST["fname"];
$lname = $_POST["lname"];
$email = $_POST["email"];
$pwd = $_POST["password"];
$user_type= $_POST['usertype'];

if($mysqli->query("INSERT INTO users (fname, lname, email, password, usertype) VALUES('$fname', '$lname', '$email', '$pwd', '$user_type')")){
    echo 'Data inserted';
    echo '<br/>';
}

header ("location:allusers.php");

?>