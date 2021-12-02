<?php
    include '../partials/dbConnect.php';

    session_start();
    $userId = $_SESSION['userId'];

    $sql = "SELECT * FROM user WHERE user_id='$userId'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);

    $name = $row['user_fname'].' '.$row['user_lname'];

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
            <form class="container md-col" action="./quizes.php" method="post">
                <?php
                    $sql = "SELECT * FROM quiz_details";
                    $result = mysqli_query($conn, $sql);
        
                    while($row = mysqli_fetch_assoc($result)){
                        echo '
                            <div>
                                <label for="quizName" class="inp-radio">'.$row['quiz_subject'].'
                                    <input type="radio" name="quizName" id="quizName" value="'.$row['quiz_id'].'">
                                    <span class="checkmark"></span>
                                </label>
                            </div>
                        ';
                    }
                ?>
                <div class="row-cen">
                    <button type="submit" class="btn btn-purple">START</button>
                </div>
            </form>
        </section>
    </main>
</body>
</html>