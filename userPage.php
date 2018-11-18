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
        require 'Variables.php';
        $profileLinkDB = $profileLinkDB->fetch_assoc()["profileImage"];

        if(isset($_GET["logout"])){
            session_destroy();
            header('Location: '. $_GET["logout"]);
        }
        if(!isset($user)){
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
            if($profileLinkDB != NULL)
                echo $profileLinkDB; 
            else {
                echo "userIcon.jpg";
            }
            
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

<script>
    let oldPostCount = 0;
    let time;
    setInterval(
        function(){
            
            $.ajax({
                type: "POST",
                url: "getPostCount.php",
                dataType: "text",
                data: {},
                success: function(result){
                    if(result > oldPostCount){
                        document.getElementById("forumPost").contentWindow.location.reload(true);
                        oldPostCount = result;

                    }
                },
            });
        },
        1000
        
    );

   $.ajax({
        type: "POST",
        url: "getPostCount.php",
        dataType: "text",
        data: {},
        success: function(result){
            oldPostCount = result;
        },
        error: function(){alert("error")}
    });

    $("#submitBtn").click(function(){
        
        let data = $("#UserInput").val();
       
        data = evalString(data);

        $.ajax({
            type: "POST",
            url: "userPageSubmit.php",
            dataType: "text",
            data: {
                UserInput: data,
                CurrentTime: time
            },
            success: function(){
              
                $("#UserInput").val("");
                
            }
        });
        
    })
    
   


    function getTime(){
        let date = new Date();
        let currtime = (date.getHours()+":"+date.getMinutes()+":"+date.getSeconds());
        time = currtime;
        setTimeout(getTime, 1000);
        
    }

    getTime();

    function evalString(data){
        let temp = data;
        for(let i = -1; i < data.length; i++){
            if(data[i] == "'") {
                temp = data.substring(0,i)+"'"+data.substring(i,data.length);
            }
                
        }
        return temp;
    }
</script>
</body>
</html>
