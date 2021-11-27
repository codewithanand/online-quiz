<?php
    include '../partials/dbConnect.php';

    if($_SERVER['REQUEST_METHOD'] == 'POST'){

        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $cpassword = $_POST['cpassword'];
        $contact = $_POST['contact'];

        $sql = "SELECT * FROM user WHERE email='$email'";
        $result = mysqli_query($conn, $sql);
        $numOfRows = mysqli_num_rows($result);

        if($numOfRows > 0){
            echo 'Error! Email already exists. Please login';
        }
        else{
            if($password == $cpassword){
                $hash = password_hash($password, PASSWORD_DEFAULT);
                $sql = "INSERT INTO user (user_fname, user_lname, email, password, contact_no) VALUES ('$fname','$lname','$email','$hash','$contact')";
                $result = mysqli_query($conn, $sql);

                if($result){
                    $sql = "SELECT * FROM user WHERE email = '$email'";
                    $result = mysqli_query($conn, $sql);
                    $row = mysqli_fetch_assoc($result);
                    $userId = $row['user_id'];
                    
                    $sql = "INSERT INTO user_current_ques (user_id, ques_num, corr_ans) VALUES ('$userId', 0, 0)";
                    mysqli_query($conn, $sql);
                    header('location: ./login.php');
                }
                else{
                    echo 'Error! Fill the credentials carefully. '.mysqli_error();
                }
            }
            else{
                echo 'Error! Passwords must be same';
            }
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign up | Online Quiz</title>
</head>
<body>
    <form action="./signup.php" method="post">
        <div>
            <label for="fname">First Name: </label>
            <input type="text" name="fname" id="fname" required>
        </div>
        <div>
            <label for="lname">Last Name: </label>
            <input type="text" name="lname" id="lname" required>
        </div>
        <div>
            <label for="email">Email Address: </label>
            <input type="text" name="email" id="email" required>
        </div>
        <div>
            <label for="password">Password: </label>
            <input type="password" name="password" id="password" required>
        </div>
        <div>
            <label for="cpassword">Confirm Password: </label>
            <input type="password" name="cpassword" id="cpassword" required>
        </div>
        <div>
            <label for="contact">Contact: </label>
            <input type="text" name="contact" id="contact">
        </div>
        <div>
            <button type="submit">SIGN UP</button>
        </div>
    </form>
</body>
</html>