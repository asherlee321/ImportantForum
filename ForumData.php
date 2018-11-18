<link rel="stylesheet" href="userPage.css"/>

<?php 
    require 'Variables.php';

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
    <div id="footer"></div>
    </p>
</div>
