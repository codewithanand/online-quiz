<?php
    include '../partials/dbConnect.php';

    session_start();
    $userId = $_SESSION['userId'];

    $sql = "SELECT * FROM user WHERE user_id='$userId'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);

    $name = $row['user_fname'].' '.$row['user_lname'];
    $email = $row['email'];
    $totScore = $row['total_score'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User | Online Quiz</title>
</head>
<body>
    <div>
        <h1><?php echo $name ?></h1>
        <h3>Name: <?php echo $name ?> </h3>
        <h3>Email: <?php echo $email ?></h3>
    </div>
    <div>
        <div>
            <h1>DASHBOARD</h1>
            <div>
                <span>11</span>
                <span>RANK</span>
                <span><?php echo $totScore ?></span>
            </div>
            <div>
    
            </div>
        </div>
        <div>
            <h2>RECENT QUIZES</h2>
            <div>
                <?php
                    $sql = "SELECT * FROM user_recent_quizes WHERE user_id='$userId'";
                    $result = mysqli_query($conn, $sql);

                    while($row = mysqli_fetch_assoc($result)){
                        echo '<div>
                                <span>'.$row['quiz_id'].'</span>
                                <span>'.$row['quiz_score'].'/'.$row['total_ques'].'</span>
                            </div>
                        ';
                    }
                ?>
            </div>
        </div>
    </div>
    <a href="./pages.php" class="btn">Take a Quiz</a>
</body>
</html>