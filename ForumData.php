<link rel="stylesheet" href="userPage.css"/>

<?php 
    require 'Variables.php';
    function displayUserData(){
        global $userData, $ID, $conn;

        if ($userData->num_rows > 0){
            while($row = $userData->fetch_assoc()){
                $currID = $row["id"];
                
                $getCurrentID = "SELECT userID FROM TextData WHERE id=$currID";
                $userID = $conn->query($getCurrentID)->fetch_assoc()["userID"]; 
                
                
                $getCurrentUser = "SELECT UserName FROM Users WHERE UserID=$userID";
                $currUser = $conn->query($getCurrentUser)->fetch_assoc()["UserName"];

                $getCurrentPostedTime = "SELECT postedTime FROM TextData WHERE id=$currID";
                $postedTime = $conn->query($getCurrentPostedTime)->fetch_assoc()["postedTime"]; 
                
                echo "
               <b> $currUser: </b>" . 
                 htmlspecialchars($row["userData"]) . 
                "<br><br><div id='postedTime'> Posted at: $postedTime </div> <hr>";
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
