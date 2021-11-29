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
                    header('location: ./userDashboard.php');
                }
                else{
                    header('location: ./admin.php');
                }
            }
            else{
                echo 'Error! Incorrect password.';
            }
        }
        else{
            echo 'Error! Incorrect email address';
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
</head>
<body>
    <form action="./login.php" method="post">
        <div>
            <label for="email">Email Address: </label>
            <input type="text" name="email" id="email" required>
        </div>
        <div>
            <label for="password">Password: </label>
            <input type="password" name="password" id="password" required>
        </div>
        <div>
            <a href="./signup.php" class="btn">NEW USER</a>
            <button type="submit">LOGIN</button>
        </div>
    </form>
</body>
</html>