<?php
    include '../partials/dbConnect.php';

    session_start();
    $userId = $_SESSION['userId'];
    $sql = "SELECT * FROM user WHERE user_id='$userId'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $name = $row['user_fname'].' '.$row['user_lname'];

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $quizName = $_POST['quizName'];

        $sql = "SELECT * FROM quiz_details WHERE quiz_subject='$quizName'";
        $result = mysqli_query($conn, $sql);
        $numOfRows = mysqli_num_rows($result);

        if($numOfRows > 0){
            echo 'Error! quiz already exists.';
        }
        else{
            $sql = "INSERT INTO quiz_details (quiz_subject) VALUES ('$quizName')";
            mysqli_query($conn, $sql);
    
            $sql = "SELECT * FROM quiz_details where quiz_subject='$quizName'";
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_assoc($result);

            $_SESSION['quizId'] = $row['quiz_id'];
            
            header('location: ./addQuestions.php');
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Quiz | Online Quiz</title>
    <link rel="icon" href="../img/quiz-ico.png" type="image/x-icon">
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    <main>
        <div class="navbar">
            <div class="nav-logo"><h3>Online Quiz</h3></div>
            <div class="nav-btns">
                <a href="./admin.php" class="btn btn-purple">BACK</a>
                <button class="btn btn-pink pink-disabled" disabled><?php echo $name ?></button>
                <a href="../partials/logout.php" class="btn btn-pink">LOGOUT</a>
            </div>
        </div>
        <section>
            <div class="container row cont-lg">
                <form class="container md-col" action="./addQuiz.php" method="post">
                    <h2>Add Subject</h2>
                    <div class="row">
                        <label class="text-primary" for="quizName">Quiz Name: </label>
                        <input type="text" name="quizName" id="quizName">
                    </div>
                    <div class="row-cen">
                        <button type="submit" class="btn btn-pink">CREATE</button>
                    </div>
                </form>
                <form class="container md-col" action="../partials/getQuizQuestions.php" method="post">
                    <h2>Add Questions</h2>
                    <div class="row">
                        <label class="text-primary" for="searchQuizName">Quiz Name: </label>
                        <input type="text" name="searchQuizName" id="searchQuizName">
                    </div>
                    <div class="row-cen">
                        <button type="submit" class="btn btn-pink">SEARCH</button>
                    </div>
                </form>
            </div>
        </section>
    </main>
    
</body>
</html>