<?php
/**
 * Created by PhpStorm.
 * User: burhan
 * Date: 5/27/2018
 * Time: 1:33 PM
 */

include 'config.php';

if (!isset($_POST["clients"]) && !isset($_POST["branch"])){
    header ("location:errorregister.php");
}


$client_id = $_POST["clients"];
$branch = $_POST["branch"];

if($mysqli->query("INSERT INTO branch (b_name,client_id) VALUES('$branch','$client_id')")){
    echo 'Data inserted';
    echo '<br/>';
}

header ("location:addclients.php");

?>