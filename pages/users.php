<?php
    include '../partials/dbConnect.php';

    session_start();
    $userId = $_SESSION['userId'];

    $getUserId='';
    $userName='';
    $userEmail='';
    $userTotalScore='';
    $userGlobalRank='';

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $getUserId = $_POST['user_opt'];

        $sql = "SELECT * FROM user WHERE user_id='$getUserId'";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);

        $userName = $row['user_fname'].' '.$row['user_lname'];
        $userEmail = $row['email'];

        $sql = "SELECT * FROM global_scoreboard WHERE user_id='$getUserId'";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);

        $userTotalScore = $row['total_score'];
        $userGlobalRank = $row['user_rank'];
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registered Users | Online Quiz</title>
</head>
<body>
    <form method="post" action="./users.php">
        <?php
            // $sql = "SELECT * FROM user WHERE is_admin='no'";
            $sql = "SELECT * FROM user";
            $result = mysqli_query($conn, $sql);
            while($row = mysqli_fetch_assoc($result)){
                echo '
                    <div><input type="radio" name="user_opt" value="'.$row['user_id'].'"><label for="user_opt">'.$row['user_id'].'</label></div>
                ';
            }
        ?>
        <button type="submit">SEARCH</button>
    </form>
    <div>
        <div>
            <h3><?php echo $userName ?></h3>
            <h3><?php echo $userEmail ?></h3>
        </div>
        <div>
            <div>
                <div>
                    <span><?php echo $userGlobalRank ?></span>
                    <span>RANK</span>
                    <span><?php echo $userTotalScore ?></span>
                </div>
            </div>
            <div>
                <h2>RECENT QUIZES</h2>
                <div>
                    <?php
                        $sql = "SELECT * FROM user_recent_quizes WHERE user_id='$getUserId'";
                        $result = mysqli_query($conn, $sql);
                        while ($row = mysqli_fetch_assoc($result)){
                            echo '
                            <div><span>'.$row['quiz_id'].'</span><span>'.$row['quiz_score'].'/'.$row['total_ques'].'</span></div>
                            ';
                        }
                    ?>
                </div>
            </div>
        </div>
    </div>
    
</body>
</html>