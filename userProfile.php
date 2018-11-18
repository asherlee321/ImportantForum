    <html>
    <head> 
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="userPage.css"/>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <title> Profile Page </title>
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
           
           
            $getTrueUser = "SELECT UserName FROM Users WHERE UserID=$ID";
            $trueUser = $conn->query($getTrueUser) ;
           
            $getPostCount = "SELECT COUNT(userData) as c FROM TextData";
            $postCount = $conn->query($getPostCount)->fetch_assoc()["c"];
           
            $getData = "SELECT userData, id FROM TextData";
            $userData = $conn->query($getData);
            
           

            $profileLink = $_POST["profileLink"];

            $profileLinkDB = $profileLinkDB->fetch_assoc()["profileImage"];
            if(isset($profileLink)){
                $insertProfile = "UPDATE Users SET profileImage='$profileLink' WHERE UserID=$ID";
                $conn->query($insertProfile);
            }
            else {
                
            }
       

            

            
        ?>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark ">
            <a class="navbar-brand" href="userPage.php">Important Forum</a>
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
        
        
        <br>
        <div class="row">
            <form class="col-8" method="POST"> 
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Link your profile picture image here" name="profileLink">
                    <input type="submit" class="btn btn-primary" value="Save"/>
                </div>
            </form>
        </div>
        <h4> This is your profile picture </h4>
        <img src=" 
        <?php 
            if(isset($profileLink)){
                echo $profileLink;
            }
            else {
                echo "$profileLinkDB";
            }

        ?>
        "
        />

      
    </body>

</html>