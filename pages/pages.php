<?php
    include '../partials/dbConnect.php';

    session_start();

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $quizId = $_POST['quizName'];

        if($quizId == '7000'){
            header('location: ./quests.php?quizId='.$quizId);
        }
        else if($quizId == '7001'){
            header('location: ./quests.php?quizId='.$quizId);
        }
        else if($quizId == '7002'){
            header('location: ./quests.php?quizId='.$quizId);
        }
        else if($quizId == '7003'){
            header('location: ./quests.php?quizId='.$quizId);
        }
        else if($quizId == '7004'){
            header('location: ./quests.php?quizId='.$quizId);
        }
        else{
            header('location: ./pages.php');
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pages | Online Quiz</title>
</head>
<body>
    <form action="./pages.php" method="post">
        <div>
            <input type="radio" name="quizName" id="quizName" value="7000">
            <label for="quizName">Ecosystem</label>
        </div>
        <div>
            <input type="radio" name="quizName" id="quizName" value="7001">
            <label for="quizName">HTML</label>
        </div>
        <div>
            <input type="radio" name="quizName" id="quizName" value="7002">
            <label for="quizName">CSS</label>
        </div>
        <div>
            <input type="radio" name="quizName" id="quizName" value="7003">
            <label for="quizName">Javascript</label>
        </div>
        <div>
            <input type="radio" name="quizName" id="quizName" value="7004">
            <label for="quizName">PHP</label>
        </div>
        <div>
            <button type="submit">START</button>
        </div>
    </form>
</body>
</html>