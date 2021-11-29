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
    <title>Scoreboard | Online Quiz</title>
</head>
<body>
    <div>
        <ol>
            <?php
                $sql = "SELECT * FROM global_scoreboard ORDER BY total_score DESC";
                $result = mysqli_query($conn, $sql);
                
                while($row = mysqli_fetch_assoc($result)){
                    echo '
                        <li>'.$row['user_id'].' '.$row['total_score'].'</li>
                    ';
                }
        ?>
        </ol>
    </div>
</body>
</html>