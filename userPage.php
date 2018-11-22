<!DOCTYPE html>
<html>
<head>
<title> Important Forum </title>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
<link rel="stylesheet" href="userPage.css"/>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
</head>
<body>
    <?php
        session_start();
        $server = "localhost";
        $username = "asher";
        $password = "2302";
        $database = "ForumDB";
       
       
        $conn = new mysqli($server, $username, $password, $database);
        
        $user = $_SESSION['username'];
        $ID = $_SESSION['userID'];
       
        $getProfileLink = "SELECT profileImage FROM Users WHERE UserID=$ID";
        $profileLinkDB = $conn->query($getProfileLink);
        
        $profileLinkDB = $profileLinkDB->fetch_assoc()["profileImage"];
        if(isset($_GET["logout"])){
            header('Location: '. $_GET["logout"]);
            session_destroy();
            
        }

        if(!isset($_SESSION['username'])    ){
            header('Location: index.php');
        
        }

        
        
 
    ?>
    <script> 

    </script>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark ">
    <a class="navbar-brand" href="userPage.php">Important Forum</a>
    <ul class="navbar-nav ml-auto">
      <li class="nav-item" id="itemOne">
        <img id="userIcon" width="20" height="20" src="<?php 
            echo  $profileLinkDB;
            
            ?>"/>
        <a class="navbar-link" href="userProfile.php"> 
            <?php echo $user ?> 
        </a>
      </li>
      <li class="nav-item">
      </li>
      <li class="nav-item" id="itemTwo">
        <a class="navbar-link" href="userPage.php?logout=index.php">
            Logout
        </a>
      </li>
     
    </ul>
</nav>
<br>
<div class="container row"> 
    <div class="form-group col" id="postForm">
        <form method="post" action="" onclick="return false;">
            <h5> Post Whatever You Want Here! </h5>
            <textarea class="form-control col-10" id="UserInput" name="UserInput" rows="7" cols="100" ></textarea>
            
            <input type="submit" value="Post" class="btn btn-dark col-10" name="submitBtn" id="submitBtn"/>
        </form>
    </div>
    <div class="col-5">
        <iframe src="ForumData.php#footer"  class="" width="600" height="500" id="forumPost" style="background-color:lightgrey">
        </iframe>
    </div>
</div>

<script src="userPage.js"></script>
</body>
</html>
