<?php
    $username = $_POST['email'];
    $password = $_POST['password'];

    if($username === "admin@lampros.ml" && $password === "3nE=f:QGLLu7"){
        session_start();
        $_SESSION['logged_in'] = 1;
        header("location: dashboard.php");
        // If credential matches with hard coded then set session and redirect to deep web
    }
    else{
        header("location: index.php");
        // If credential don't match then redict to login again
    }
?>