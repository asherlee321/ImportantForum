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


        if(!empty($_POST)){
            $inputData = $_POST["UserInput"];
            $postedTime = $_POST["CurrentTime"];
            $insertData = "INSERT INTO TextData (userData, userID, postedTime) VALUES ( '$inputData', $ID, '$postedTime')";
            $conn->query($insertData);
        }
        
       
       


        header("Location: userPage.php");
        
        
    ?>