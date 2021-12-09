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
    <link rel="icon" href="../img/quiz-ico.png" type="image/x-icon">
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    <main>
        <div class="navbar">
            <div class="nav-logo"><h3>Online Quiz</h3></div>
            <div class="nav-btns"></div>
        </div>
        <section>
            <form class="container md-col cont-sm" action="./signup.php" method="post">
                <h2>Register</h2>
                <div class="container md-row">
                    <label class="text-primary" for="fname">First Name: </label>
                    <input type="text" name="fname" id="fname" required>
                </div>
                <div class="container md-row">
                    <label class="text-primary" for="lname">Last Name: </label>
                    <input type="text" name="lname" id="lname" required>
                </div>
                <div class="container md-row">
                    <label class="text-primary" for="email">Email Address: </label>
                    <input type="text" name="email" id="email" oninput="ValidateEmail()" required>
                </div>
                <div style="display:none" id="msgCont" class="container md-row">
                    <span id="emailMsg"></span>
                </div>
                <div class="container md-row">
                    <label class="text-primary" for="password">Password: </label>
                    <input type="password" name="password" id="password" required>
                </div>
                <div class="container md-row">
                    <label class="text-primary" for="cpassword">Confirm Password: </label>
                    <input type="password" name="cpassword" id="cpassword" required>
                </div>
                <div class="container md-row">
                    <label class="text-primary" for="contact">Contact: </label>
                    <input type="text" name="contact" id="contact">
                </div>
                <div class="row-cen">
                    <a href="./login.php" class="btn btn-purple">LOG IN</a>
                    <button type="submit" class="btn btn-pink">SIGN UP</button>
                </div>
            </form>
        </section>
        
    </main>

    <script>
        function ValidateEmail(){
            var myEmail = document.getElementById('email');
            var mailformat = /^\w+([\.-]?\w+)@\w+([\.-]?\w+)(\.\w{2,3})+$/;
            if(myEmail.value.match(mailformat)){
                document.getElementById('msgCont').style.display = 'none';
                document.getElementById('emailMsg').innerHTML = '';
            }
            else{
                document.getElementById('msgCont').style.display = 'block';
                document.getElementById('emailMsg').innerHTML = 'Invalid Email Address';
            }
        }
    </script>
</body>
</html>