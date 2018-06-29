<?php
/**
 * Created by PhpStorm.
 * User: burhan
 * Date: 6/12/2018
 * Time: 3:39 PM
 */

$uid=$_GET['uid'];

include 'config.php';
$query="DELETE FROM `users` WHERE id=$uid";
if ($mysqli->query($query)){

    header("Location: {$_SERVER['HTTP_REFERER']}");

}else{
    echo "Error: CAN NOT DELETE THIS USER";
    header("Refresh: 2; url=allusers.php");
}