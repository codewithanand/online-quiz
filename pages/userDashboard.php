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

    $sql = "SELECT * FROM global_scoreboard WHERE user_id='$userId'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);

    $rank = $row['user_rank'];
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User | Online Quiz</title>
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
                <button class="btn btn-pink pink-disabled" disabled>
                    <?php echo $name ?>
                </button>
                <a href="../partials/logout.php" class="btn btn-pink">LOGOUT</a>
            </div>
        </div>
        <div class="container md-row">
            <div class="container md-col cont-cen cont-sp-col">
                <?php
                    $sql = "SELECT * FROM profile_picture WHERE user_id='$userId'";
                    $result = mysqli_query($conn, $sql);
                    $row = mysqli_fetch_assoc($result);

                    $img_file_path = '../img/profile/'.$row['img_name'];
                ?>
                <img src="<?php echo $img_file_path; ?>" alt="" class="user-profile" width="200px" height="200px">
                <form action="../partials/uploadPicture.php" method="post" enctype="multipart/form-data">
                    <input type="file" class="btn btn-purple" name="uploadfile" id="uploadfile">
                    <button type="submit" class="btn btn-blue" name="upload">Upload</button>
                </form>
                <p class="heading text-secondary">
                    <?php echo $name ?>
                </p>
                <p class="sub-heading text-secondary">
                    <?php echo $email ?>
                </p>
            </div>
            <div class="container md-col cont-special">
                <div>
                    <p class="heading text-purple">DASHBOARD</p>
                    <div class="global-scorebar">
                        <div class="rank-box">
                            <span class="circle" id="user-level">
                                <!-- <?php echo $rank ?> -->
                            </span>
                            <span>LEVEL</span>
                        </div>
                        <div id="gPrgCont" class="progress-bar">
                            <span id="gPrgBar" class="progress"></span>
                        </div>
                        <div>
                            <span id="user-tot-score">
                                <?php echo $totScore ?>
                            </span>
                        </div>
                    </div>
                </div>
                <div>
                    <p class="heading2 text-pink">RECENT QUIZES</p>
                    <div>
                        <?php
                            $sql = "SELECT * FROM user_recent_quizes WHERE user_id='$userId' ORDER BY quiz_time DESC LIMIT 4";
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
                                        <div class="recent-score">
                                            <span id="prgPoint">'.$score.'</span>/<span id="prgTotPoint">'.$totQues.'</span>
                                        </div>
                                    </div>
                                ';
                            }
                        ?>
                    </div>
                </div>
            </div>
        <a href="./quizes.php" class="btn btn-pink btn-float">Take a Quiz</a>
    </main>

    <script>

        // =============== RECENT QUIZES PROGRESS BAR ==============
        
        let prgPoint = document.querySelectorAll('#prgPoint');
        let prgTotPoint = document.querySelectorAll('#prgTotPoint');
        let prgBar = document.querySelectorAll('#prgBar');

        for(var i=0; i<prgBar.length; i++){
            perGain = prgPoint[i].innerHTML / prgTotPoint[i].innerHTML * 100;
            prgBar[i].style.width = perGain + '%';
        }

        // =============== USER GLOBAL PROGRESS BAR ==================

        let userTotalScore = document.getElementById('user-tot-score');
        let userPrgBar = document.getElementById('gPrgBar');
        let userLevelTxt = document.getElementById('user-level');

        userLevel = Math.floor(userTotalScore.innerHTML/100);
        userCurrentPoints = Math.floor(userTotalScore.innerHTML%100);

        userPerGain = userCurrentPoints / 100 * 100;
        userPrgBar.style.width = userPerGain + '%';

        userLevelTxt.innerHTML = userLevel;
    </script>
</body>
</html>