<?php
/**
 * Created by PhpStorm.
 * User: burhan
 * Date: 6/12/2018
 * Time: 3:39 PM
 */

$qid=$_GET['qid'];

echo $qid;

include 'config.php';
$query="DELETE FROM `questions` WHERE q_id=$qid";
if ($mysqli->query($query)){

        header("Location: {$_SERVER['HTTP_REFERER']}");

}else{
    echo $mysqli->error;
}