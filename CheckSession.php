<?php
    session_start();
    $user = $_SESSION['username'];
    echo $user;

?>