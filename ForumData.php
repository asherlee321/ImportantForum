<link rel="stylesheet" href="userPage.css"/>
<body>
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
    
     $getData = "SELECT userData, id FROM TextData";
     $userData = $conn->query($getData);
     
    

    function displayUserData(){
        global $userData, $ID, $conn;

        if ($userData->num_rows > 0){
            while($row = $userData->fetch_assoc()){
                $currID = $row["id"];
                 
                //Get the id of the current user in array
                $getCurrentID = "SELECT userID FROM TextData WHERE id=$currID";
                $userID = $conn->query($getCurrentID)->fetch_assoc()["userID"]; 
                
                //Get the username of the current user in array
                $getCurrentUser = "SELECT UserName FROM Users WHERE UserID=$userID";
                $currUser = $conn->query($getCurrentUser)->fetch_assoc()["UserName"];
                
                //Get the time the current post was sent
                $getCurrentPostedTime = "SELECT postedTime FROM TextData WHERE id=$currID";
                $postedTime = $conn->query($getCurrentPostedTime)->fetch_assoc()["postedTime"];
                
                //Get the profile picture of the current user in array
                $getProfileImage = "SELECT profileImage FROM Users WHERE UserID=$userID";
                $profileImage = $conn->query($getProfileImage)->fetch_assoc()["profileImage"];
                
                if($profileImage == NULL){
                    $profileImage = "userIcon.jpg";
                }
               
                //Display Username, Profile picture, Post and Posted Time of the currently accessed user.
                echo 
                "<img src='$profileImage' width='40' height='40' id='profileImage'/>"
                .
                "
                <b> $currUser: </b>" .
                 htmlspecialchars($row["userData"]) . 
                "
                <br>
                <br>
                <div id='postedTime'> 
                    Posted at: $postedTime 
                </div> 
                <hr>";
            }
        }
    }
?>

<div class="row" id="forum" style="margin-left:50px">
    <p class="col-5 forumPost" id="forumPost"> 
    <?php
     displayUserData();
     
    ?>
    </p>
    <div id='footer'></div>

</div>

<script> 


if(navigator.userAgent.indexOf("Chrome") != -1){
    let scrollEventHandler = function(){
        window.scroll(0, window.pageYOffset)
        window.scroll(0, document.body.scrollHeight);
    }
window.addEventListener("scroll", scrollEventHandler, false);

}


</script>
</body>