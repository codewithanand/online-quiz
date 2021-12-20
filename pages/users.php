<?php
    include '../partials/dbConnect.php';

    session_start();
    $userId = $_SESSION['userId'];
    $sql = "SELECT * FROM user WHERE user_id='$userId'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $name = $row['user_fname'].' '.$row['user_lname'];

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

        $sql = "SELECT * FROM profile_picture WHERE user_id='$getUserId'";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);

        $imgSrc = $row['img_name'];
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registered Users | Online Quiz</title>
    <link rel="icon" href="../img/quiz-ico.png" type="image/x-icon">
    <link rel="stylesheet" href="../style.css">
</head> 
<body>
    <main>
        <div class="navbar">
            <div class="nav-logo">
                <h3>Online Quiz</h3>
            </div>
            <div class="nav-btns">
                <a href="./admin.php" class="btn btn-purple">BACK</a>
                <button class="btn btn-pink pink-disabled" disabled>
                    <?php echo $name ?>
                </button>
                <a href="../partials/logout.php" class="btn btn-pink">LOGOUT</a>
            </div>
        </div>
        <section>
            <div class="container md-row-start">
                <div class="container col">
                    <form method="post" action="./users.php">
                        <?php
                            $sql = "SELECT * FROM user WHERE is_admin='no'";
                            // $sql = "SELECT * FROM user";
                            $result = mysqli_query($conn, $sql);
                            while($row = mysqli_fetch_assoc($result)){
                                echo '
                                    <div class="row">
                                        <label class="inp-radio" for="user_opt">'.$row['user_id'].'
                                            <input type="radio" name="user_opt" value="'.$row['user_id'].'">
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>
                                ';
                            }
                        ?>
                        <div class="row-cen">
                            <button type="submit" class="btn btn-purple">SEARCH</button>
                        </div>
                    </form>
                </div>
                <div class="container md-col cont-special cont-sm cont-flex-1">
                    <div class="container row">
                        <div>
                            <img src="../img/profile/<?php echo $imgSrc; ?>" alt="" class="user-profile-sm" width="200px" height="200px">
                        </div>
                        <div>
                            <p class="heading2 text-secondary"><?php echo $userName ?></p>
                            <p class="text-secondary"><?php echo $userEmail ?></p>
                        </div>
                    </div>
                    <div>
                        <div class="global-scorebar">
                            <div class="rank-box">
                                <span class="circle">
                                    <?php echo $userGlobalRank ?>
                                </span>
                                <span>RANK</span>
                            </div>
                            <div class="progress-bar">
                                <span class="progress"></span>
                            </div>
                            <div>
                                <span>
                                    <?php echo $userTotalScore ?>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div>
                        <p class="heading2 text-pink">RECENT QUIZES</p>
                        <div>
                            <?php
                                $sql = "SELECT * FROM user_recent_quizes WHERE user_id='$getUserId' ORDER BY quiz_time DESC LIMIT 4";
                                $result = mysqli_query($conn, $sql);
            
                                while($row = mysqli_fetch_assoc($result)){
                                    $quizId = $row['quiz_id'];
                                    $score = $row['quiz_score'];
                                    $totQues = $row['total_ques'];

                                    $qry = "SELECT * FROM quiz_details WHERE quiz_id = '$quizId'";
                                    $res = mysqli_query($conn, $qry);
                                    $rw = mysqli_fetch_assoc($res);
                                    $quizName = $rw['quiz_subject'];
                                    echo '
                                        <div class="recent-box">
                                            <div class="recent-sub">
                                                <span>'.$quizName.'</span>
                                            </div>
                                            <div id="prgCont" class="progress-bar">
                                                <span id="prgBar" class="progress"></span>
                                            </div>
                                            <div>
                                                <span id="prgPoint">'.$score.'</span>/<span id="prgTotPoint">'.$totQues.'</span>
                                            </div>
                                        </div>
                                    ';
                                }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
    
    <script>
        let prgPoint = document.querySelectorAll('#prgPoint');
        let prgTotPoint = document.querySelectorAll('#prgTotPoint');
        let prgBar = document.querySelectorAll('#prgBar');

        for(var i=0; i<prgBar.length; i++){
            perGain = prgPoint[i].innerHTML / prgTotPoint[i].innerHTML * 100;
            prgBar[i].style.width = perGain + '%';
        }

    </script>
</body>
</html>