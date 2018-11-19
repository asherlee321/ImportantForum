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
            
           
            $profileLink = $_POST["profileLink"];
            $profileLinkDB = $profileLinkDB->fetch_assoc()["profileImage"];
            
            if(isset($profileLink) && strpos($profileLink, "image") !== false){   
                $url_to_image = "$profileLink";
                $my_save_dir = 'upload/';
                $filename = basename($ID . ".png");
                $complete_save_loc = $my_save_dir . $filename;
                file_put_contents($complete_save_loc, file_get_contents($url_to_image));

                $insertProfile = "UPDATE Users SET profileImage='upload/$ID.png' WHERE UserID=$ID";
                $conn->query($insertProfile);
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
            if(isset($profileLink)  && strpos($profileLink, "image") !== false){
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