<html>
<head>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

<link rel="stylesheet" href="index.css"/>
</head>
<body>

<div class="container">
    <div class="header text-center">
        <h1 class="Display-4 ">
            Signup or Login
        </h1> 
    </div>
    <div class="text-center">
        <button id="showLogin" class="btn btn-primary col-6" type="button" data-toggle="collapse" data-target="#LoginForm" aria-expanded="false" aria-controls="LoginForm">
            Login
        </button>
    </div> 
    <br>

    <div class="collapse in col-15" id="LoginForm">
        <form method="post" class="">
            <div class="form-group">
                <label for="username" class="offset-3">Username:</label>
                <input class="form-control col-6 offset-3" name="username"/>
            </div>
            <div class="form-group ">
                <label for="password" class="offset-3">Password:</label>
                <input class="form-control col-6 offset-3" name="password" type="password"/>
            </div>
        
            <div class="form-group" id="button">
                <input class="btn btn-success col-6 offset-3" type="submit" value="Login" name="loginButton"/>
            </div>
        </form>
    </div>
    <div class="text-center">
    <button id="showSignup" class="btn btn-primary col-6" type="button" data-toggle="collapse" data-target="#SignUpForm" aria-expanded="false" aria-controls="SignUpForm">
        Sign Up
    </button>
    </div> 
    <br>
    <div class="collapse col-15" id="SignUpForm">
        <form method="post">
            <div class="form-group">
                <label for="username" class="offset-3">Username:</label>
                <input class="form-control col-6 offset-3" name="usernameSignUp"/>
            </div>
            <div class="form-group ">
                <label for="password" class="offset-3">Password:</label>
                <input class="form-control col-6 offset-3" name="passwordSignUp" type="password"/>
            </div>
            <div class="form-group ">
                <label for="password" class="offset-3">Confirm Password:</label>
                <input class="form-control col-6 offset-3" name="passwordSignUpConfirm" type="password"/>
            </div>
            <div class="form-group" id="button">
                <input class="btn btn-success col-6 offset-3" type="submit" name="signupButton" value="Create Account"/>
            </div>
        </form>
    </div>
</div>
<?php
    session_start();
    if(isset($_SESSION['username'])){
        header("Location: userPage.php");
    }
    $server = "localhost";
    $username = "asher";
    $password = "2302";
    $database = "ForumDB";
    function login(){
        
        global $server, $username, $password, $database;
        $conn = new mysqli($server, $username, $password, $database);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        $user = $_POST["username"];
        $pass = $_POST["password"];
        
        $getID = "SELECT UserID FROM Users WHERE username='$user'";
        $ID = $conn->query($getID)->fetch_assoc()["UserID"];
        
        $checkAccount = "SELECT COUNT(UserName) as c FROM Users WHERE UserName='$user'";
        $result = $conn->query($checkAccount);
        
        if($result->fetch_assoc()["c"] > 0){    
            //SQL code
            $displayData = "SELECT UserInfo FROM UserData WHERE UserID=$ID";
            $displayPassword = "SELECT UserPassword FROM Users WHERE UserID=$ID";

            //Run SQL code
            $UserPassword = $conn->query($displayPassword)->fetch_assoc()["UserPassword"];

            //Login test
            if($pass == $UserPassword){
                echo "test";
                $_SESSION['username'] = $user;
               
                header('Location: userPage.php');
            }
            else {
                echo "
                <div class='alert alert-warning' role='alert'>
                    <center>
                        
                        <strong>
                            Password is incorrect
                        </strong>
                    </center>
                </div>
                
                ";
            }
        }
        else {
            echo "
            <div class='alert alert-warning' role='alert'>
                <center>
                    
                    <strong>
                        Account doesn't exist
                    </strong>
                </center>
            </div>
            
            ";
        }

        $conn->close();
    }
    function signUp(){
        global $server, $username, $password, $database;

        $conn = new mysqli($server, $username, $password, $database);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        $user = $_POST["usernameSignUp"];
        $pass = $_POST["passwordSignUp"];
        $passConfirm = $_POST["passwordSignUpConfirm"];
        $sql = "INSERT INTO Users (UserName, UserPassword) VALUES ('$user', '$pass')";
        $getID = "SELECT UserID FROM Users WHERE username='$user'";
        $ID = $conn->query($getID)->fetch_assoc()["UserID"];
        
        $checkAccount = "SELECT COUNT(UserName) as c FROM Users WHERE UserName='$user'";
        $result = $conn->query($checkAccount);
        
        if($result->fetch_assoc()["c"] == 0){
            if($passConfirm == $pass && $pass != null){
                $conn->query($sql) or die($conn->error);
                echo "
                <div class='alert alert-success' role='alert'>
                    <center>
                        
                        <strong>
                            Account created successfully
                        </strong>
                    </center>
                </div>
                ";
            }
            else if($passConfirm != $pass) {
                echo "
                <div class='alert alert-warning' role='alert'>
                    <center>
                        
                        <strong>
                            Both passwords are different
                        </strong>
                    </center>
                </div>
                ";
            }
        }
        else {
            echo "
            <div class='alert alert-warning' role='alert'>
                <center>
                    
                    <strong>
                        Account Already Exists
                    </strong>
                </center>
            </div>
            ";
        }
        $conn->close();
    }
    if(!empty($_POST)){
        if(isset($_POST["loginButton"]))
            login();
        if(isset($_POST["signupButton"]))
            signup();

    }
    
?>
</form>

</body>
</html>
