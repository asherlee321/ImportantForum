<?php
        session_start();
        $server = "localhost";
        $username = "asher";
        $password = "2302";
        $database = "ForumDB";


        $conn = new mysqli($server, $username, $password, $database);
        
        $user = $_SESSION['username'];
        $getID = "SELECT UserID FROM Users WHERE username='$user'";
        $ID = $conn->query($getID)->fetch_assoc()["UserID"];

        $getData = "SELECT userData FROM TextData";
        $userData = $conn->query($getData);
  

        if(!empty($_POST)){
            $inputData = $_POST["UserInput"];
            $insertData = "INSERT INTO TextData (userData, userID) VALUES ( '$inputData', $ID)";
            $conn->query($insertData);
        }
        
       
       


        header("Location: userPage.php");
        
        
    ?>