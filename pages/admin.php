<?php
    include '../partials/dbConnect.php';

    session_start();
    $userId = $_SESSION['userId'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin | Online Quiz</title>
</head>
<body>
    <div>
        <div><a href="./addQuiz.php" class="btn">Add Quiz</a></div>
        <div><a href="./removeQuiz.php" class="btn">Remove Quiz</a></div>

        <div><a href="./users.php" class="btn">Registered Users</a></div>
        <div><a href="./scoreboard.php" class="btn">Scoreboard</a></div>
    </div>
</body>
</html>