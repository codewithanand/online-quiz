<?php
    include '../partials/dbConnect.php';

    session_start();
    $userId = $_SESSION['userId'];

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $quizName = $_POST['quizName'];

        $sql = "SELECT * FROM quiz_details WHERE quiz_subject='$quizName'";
        $result = mysqli_query($conn, $sql);
        $numOfRows = mysqli_num_rows($result);

        if($numOfRows == 1){
            $sql = "SELECT * FROM quiz_details where quiz_subject='$quizName'";
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_assoc($result);

            $_SESSION['quizId'] = $row['quiz_id'];
            
            header('location: ./quizDetails.php');
        }
        else{
            echo 'Error! Wrong quiz name or Quiz does not exists.';
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>REMOVE Quiz | Online Quiz</title>
</head>
<body>
    <form action="./removeQuiz.php" method="post">
        <div>
            <label for="quizName">Quiz Name: </label>
            <input type="text" name="quizName" id="quizName">
        </div>
        <div>
            <button type="submit">REMOVE</button>
        </div>
    </form>
    <form action="../partials/getQuizQuestions.php" method="post">
        <div>
            <label for="searchQuizName">Quiz Name: </label>
            <input type="text" name="searchQuizName" id="searchQuizName">
        </div>
        <div>
            <button type="submit">REMOVE QUESTIONS</button>
        </div>
    </form>
</body>
</html>