<?php
    include '../partials/dbConnect.php';

    session_start();
    $userId = $_SESSION['userId'];
    $quizId = $_SESSION['quizId'];

    $totalQues = $_GET['tot'];
    $corrAns = $_GET['corr'];

    $sql = "SELECT * FROM user WHERE user_id='$userId'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);

    $totalScore = $row['total_score'];
    $newScore = $totalScore + $corrAns;

    $sql = "UPDATE user SET total_score='$newScore' WHERE user_id='$userId'";
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
</head>
<body>
    <form action="../partials/resetQuestionSession.php" method="post">
        <h1><?php echo $corrAns.'/'.$totalQues ?></h1>
        <div>
            <button type="submit">OK</button>
        </div>
    </form>
</body>
</html>