<?php
session_start();
include 'connection.php';


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $questions = $_POST['questions_php'];
    $cid = $questions['c_id'];
    $b_id = $questions['b_id'];
    $q = $questions['q'];
    $cat_name = $questions['cat_name'];
    $cat_type = $questions['cat_type'];
    $q_array = json_decode($q, true);


    $query1 = "INSERT INTO `categories` (`cat_id`, `cat_name`, `cat_type`, `cat_discp`) VALUES ('', '$cat_name', '$cat_type', '');";
    $query2 = "SELECT MAX(cat_id) FROM categories";


    if ($conn->query($query1)) {

        $result = $conn->query($query2);
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $cat_num = $row['MAX(cat_id)'];


            foreach ($q_array as $que) {
                $query3 = "INSERT INTO `questions` (`q_id`, `q_statement`, `cat_id`) VALUES ('', '$que', '$cat_num');";
                $conn->query($query3);


            }

            $query4 = "INSERT INTO `branch_surverys` (`c_id`, `b_id`, `cat_id`) VALUES ('$cid', '$b_id', '$cat_num');";
            $conn->query($query4);
            $_SESSION['post'] = "insertion Successful";


        }


    }

} else
    echo "invalid request method : improper path";


?>