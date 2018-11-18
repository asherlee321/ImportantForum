<?php
 $server = "localhost";
 $username = "asher";
 $password = "2302";
 $database = "ForumDB";


 $conn = new mysqli($server, $username, $password, $database);
 
 $user = $_SESSION['username'];
 $ID = $_SESSION['userID'];

 $getProfileLink = "SELECT profileImage FROM Users WHERE UserID=$ID";
 $profileLinkDB = $conn->query($getProfileLink);


 $getTrueUser = "SELECT UserName FROM Users WHERE UserID=$ID";
 $trueUser = $conn->query($getTrueUser) ;

 $getPostCount = "SELECT COUNT(userData) as c FROM TextData";
 $postCount = $conn->query($getPostCount)->fetch_assoc()["c"];

 $getData = "SELECT userData, id FROM TextData";
 $userData = $conn->query($getData);
 

?> 