<?php
 $server = "localhost";
 $username = "asher";
 $password = "2302";
 $database = "ForumDB";


 $conn = new mysqli($server, $username, $password, $database);
 
 $user = $_SESSION['username'];
 $getID = "SELECT UserID FROM Users WHERE username='$user'";
 $ID = $conn->query($getID)->fetch_assoc()["UserID"];

$getPostCount = "SELECT COUNT(userData) as c FROM TextData";
$postCount = $conn->query($getPostCount)->fetch_assoc()["c"];

 $getData = "SELECT userData, id FROM TextData";
 $userData = $conn->query($getData);
 

?> 