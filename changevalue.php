<?php
/**
 * Created by PhpStorm.
 * User: burhan
 * Date: 6/12/2018
 * Time: 8:35 PM
 */

include 'config.php';

$a_id=$_POST['answer_id'];
$answer=$_POST['answer'];

$query="UPDATE `answers` SET `answer`='$answer' WHERE aid=$a_id";

if ($mysqli->query($query)){
    header("Location: {$_SERVER['HTTP_REFERER']}");
}else{
    $mysqli->error;
}