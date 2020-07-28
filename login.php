<?php
    $username = $_POST['email'];
    $password = $_POST['password'];

    if($username === "admin@lampros.ml" && $password === "3nE=f:QGLLu7"){
        session_start();
        $_SESSION['logged_in'] = 1;
        header("location: dashboard.php");
    }
    else{
        header("location: index.php");
    }
?>