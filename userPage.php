<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
<link rel="stylesheet" href="userPage.css"/>

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
        $getID = "SELECT UserID FROM Users WHERE username='$user'";
        $ID = $conn->query($getID)->fetch_assoc()["UserID"];

        $getData = "SELECT userData, id FROM TextData";
        $userData = $conn->query($getData);
        

        if(isset($_GET["logout"])){
            session_destroy();
            header('Location: '. $_GET["logout"]);
        }
        if(!isset($user)){
            header('Location: index.php');
        }


        function displayUserData(){
            global $userData, $ID, $conn;

            if ($userData->num_rows > 0){
                while($row = $userData->fetch_assoc()){
                    $currID = $row["id"];
                    
                    $getCurrentID = "SELECT userID FROM TextData WHERE id=$currID";
                    $userID = $conn->query($getCurrentID)->fetch_assoc()["userID"]; 
                    
                    
                    $getCurrentUser = "SELECT UserName FROM Users WHERE UserID=$userID";
                    $currUser = $conn->query($getCurrentUser)->fetch_assoc()["UserName"];
                    
                    echo "
                     <span id='divider'>|</span><b> $currUser: </b>" . 
                     htmlspecialchars($row["userData"]) . 
                    "<br>";
                }
            }
        }
    
        
    ?>
    <script> 

    </script>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark ">
    <a class="navbar-brand" href="#">Important Forum</a>
    <ul class="navbar-nav ml-auto">
      <li class="nav-item" id="itemOne">
        <img id="userIcon" width="20" height="20" src="userIcon.jpg"/>
        <a class="navbar-link" > 
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
<div class="centerElements"> 
<div class="form-group row">
    <form method="post" class="col-4" action="userPageSubmit.php">
        <h5> Post Whatever You Want Here! </h5>
        <textarea class="form-control" name="UserInput" rows="5" ></textarea>
        
        <input type="submit" value="Post" class="btn btn-dark col-10 offset-1" name="submitBtn"/>
    </form>
</div>
<div class="row">
    <p class="col-5 forumPost"> 
    <?php
     displayUserData();
    ?>
    </p>
</div>
</div>
</body>
</html>