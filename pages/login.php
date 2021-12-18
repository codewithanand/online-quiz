<?php
    include '../partials/dbConnect.php';

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $email = $_POST['email'];
        $password = $_POST['password'];
    
        $sql = "SELECT * FROM user WHERE email='$email'";
        $result = mysqli_query($conn, $sql);
        $numOfRows = mysqli_num_rows($result);
    
        if($numOfRows == 1){
            $row = mysqli_fetch_assoc($result);
            $hash = password_verify($password, $row['password']);
            if($hash == $password){
                session_start();
                $_SESSION['userId'] = $row['user_id'];
                $_SESSION['userEmail'] = $row['email'];

                if($row['is_admin'] == 'no'){
                    header('location: ../partials/resetQuestionSession.php');
                }
                else{
                    header('location: ./admin.php');
                }
            }
            else{
                echo '<div class="alert alert-danger" id="alert-box" role="alert"> Error! Incorrect password. </div>';
            }
        }
        else{
            echo '<div class="alert alert-danger" id="alert-box" role="alert"> Error! User not registered. </div>';
        }
    }
 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log In | Online Quiz</title>
    <link rel="icon" href="../img/quiz-ico.png" type="image/x-icon">
    <link rel="stylesheet" href="../style.css">
    <script src="../js/emailValid.js"></script>
</head>
<body>
    <main>
        <div class="navbar">
            <div class="nav-logo"><h3>Online Quiz</h3></div>
            <div class="nav-btns"></div>
        </div>
        <section class="container cont-cen">
            <form class="container md-col cont-sm" action="./login.php" method="post">
                <h2>Log In</h2>
                <div class="container md-row">
                    <label class="text-primary" for="email">Email Address</label>
                    <input type="text" name="email" id="email" oninput="ValidateEmail()" required>
                </div>
                <div style="display:none" id="msgCont" class="container md-row">
                    <span class="emailMsg" id="emailMsg"></span>
                </div>
                <div class="container md-row">
                    <label class="text-primary" for="password">Password</label>
                    <input type="password" name="password" id="password" required>
                </div>
                <div class="container md-row">
                    <a href="./signup.php" class="btn btn-purple">NEW USER</a>
                    <button type="submit" class="btn btn-pink" onclick="showAlertBox()">LOGIN</button>
                </div>
            </form>
        </section>
    </main>
</body>
</html>