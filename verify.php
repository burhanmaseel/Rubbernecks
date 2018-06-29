
<?php

//if (session_status() !== PHP_SESSION_ACTIVE) {session_start();}
if(session_id() == '' || !isset($_SESSION)){session_start();}

include 'config.php';

$username = $_POST["username"];
$password = $_POST["password"];
$flag = 'true';

$result = $mysqli->query('SELECT id,email,password,usertype from users order by id asc');

if($result === FALSE){
  die(mysqli_error($mysqli));
}

if($result){
  while($obj = $result->fetch_object()){
    if($obj->email === $username && $obj->password === $password && $obj->usertype === "Super Admin") {

      $_SESSION['username'] = $username;
      $_SESSION['type'] = $obj->usertype;
      $_SESSION['id'] = $obj->id;

      header("location:schedules.php");
    } elseif ($obj->email === $username && $obj->password === $password && $obj->usertype === "Admin"){
        $_SESSION['username'] = $username;
        $_SESSION['type'] = $obj->usertype;
        $_SESSION['id'] = $obj->id;

        header("location:adminforms.php");
    }elseif ($obj->email === $username && $obj->password === $password && $obj->usertype === "User"){
        $_SESSION['username'] = $username;
        $_SESSION['type'] = $obj->usertype;
        $_SESSION['id'] = $obj->id;

        header("location:client_demo.php");
    }


    else {

        if($flag === 'true'){
          redirect();
          $flag = 'false';
        }
    }
  }
}

function redirect() {
  echo '<h5>Invalid Login! Redirecting...</h5>';
  header("Refresh: 3; url=login.html");
}


?>
