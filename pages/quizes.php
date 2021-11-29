<?php
    include '../partials/dbConnect.php';

    session_start();

    if($_SERVER['REQUEST_METHOD'] == 'POST'){

        $quizId = $_POST['quizName'];

        $_SESSION['quizId'] = $quizId;
        header('location: ./quests.php?quizId='.$quizId);
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
    <form action="./quizes.php" method="post">
        <?php
            $sql = "SELECT * FROM quiz_details";
            $result = mysqli_query($conn, $sql);

            while($row = mysqli_fetch_assoc($result)){
                echo '
                    <div>
                        <input type="radio" name="quizName" id="quizName" value="'.$row['quiz_id'].'">
                        <label for="quizName">'.$row['quiz_subject'].'</label>
                    </div>
                ';
            }
        ?>
        <div>
            <button type="submit">START</button>
        </div>
    </form>
</body>
</html>