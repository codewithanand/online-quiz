<?php
    include '../partials/dbConnect.php';

    session_start();
    $userId = $_SESSION['userId'];
    $sql = "SELECT * FROM user WHERE user_id='$userId'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $name = $row['user_fname'].' '.$row['user_lname'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin | Online Quiz</title>
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
            <div class="container md-col">
                <div><a href="./addQuiz.php" class="btn btn-purple">Add Quiz</a></div>
                <div><a href="./removeQuiz.php" class="btn btn-purple">Remove Quiz</a></div>

                <div><a href="./users.php" class="btn btn-purple">Registered Users</a></div>
                <div><a href="./scoreboard.php" class="btn btn-purple">Scoreboard</a></div>
            </div>
        </section>
    </main>
    
</body>
</html>