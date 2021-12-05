<?php
    include '../partials/dbConnect.php';

    session_start();
    $userId = $_SESSION['userId'];
    $quizId = $_SESSION['quizId'];

    $sql = "SELECT * FROM user WHERE user_id='$userId'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $name = $row['user_fname'].' '.$row['user_lname'];

    $totalQues = $_GET['tot'];
    $corrAns = $_GET['corr'];

    $sql = "SELECT * FROM user WHERE user_id='$userId'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);

    $totalScore = $row['total_score'];
    $newScore = $totalScore + $corrAns;

    $sql = "UPDATE user SET total_score='$newScore' WHERE user_id='$userId'";
    mysqli_query($conn, $sql);

    $sql = "UPDATE global_scoreboard SET total_score='$newScore' WHERE user_id='$userId'";
    mysqli_query($conn, $sql);

    $sql = "INSERT INTO user_recent_quizes (user_id, quiz_id, quiz_score, total_ques) VALUES ('$userId', '$quizId', '$corrAns', '$totalQues')";
    mysqli_query($conn, $sql);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Result | Online Quiz</title>
    <link rel="icon" href="../img/quiz-ico.png" type="image/x-icon">
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    <main>
        <div class="navbar">
            <div class="nav-logo"><h3>Online Quiz</h3></div>
            <div class="nav-btns">
                <button class="btn btn-pink pink-disabled" disabled><?php echo $name ?></button>
                <a href="../partials/logout.php" class="btn btn-pink">LOGOUT</a>
            </div>
        </div>
        <section>
            <form action="../partials/resetQuestionSession.php" method="post">
                <div class="row-cen">
                    <img src="../img/quiz-ico.png" alt="" width="200px" height="200px">
                </div>
                <h1><?php echo $corrAns.'/'.$totalQues ?></h1>
                <div>
                    <button class="btn btn-blue" type="submit">OK</button>
                </div>
            </form>
        </section>
    </main>
</body>
</html>