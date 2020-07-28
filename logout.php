<?php
    session_start();
    session_unset();
    header('location: index.php');
    // Redirect to index page with resetting all sessions and destroying all sessions for specific client 
?>