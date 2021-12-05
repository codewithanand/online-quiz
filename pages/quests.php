<?php
    include '../partials/dbConnect.php';

    session_start();
    $userId = $_SESSION['userId'];
    $quizId = $_SESSION['quizId'];

    $sql = "SELECT * FROM user WHERE user_id='$userId'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $name = $row['user_fname'].' '.$row['user_lname'];
    
    //Fetch num of questions attempted by the user
    $sql = "SELECT * FROM user_current_ques WHERE user_id='$userId'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $i = (int)$row['ques_num'];
    $quesNum = $i+1;
    $corrAns = $row['corr_ans'];

    //Collect current question from the database
    $quesIdList = array();
    $sql = "SELECT ques_id FROM questions WHERE quiz_id='$quizId'";
    $result = mysqli_query($conn, $sql);
    while($row = mysqli_fetch_assoc($result)){
        array_push($quesIdList, $row['ques_id']);
    }
    $numOfQues = count($quesIdList);
    $quesId = $quesIdList[$i];

    if($i < $numOfQues){
        //Populate question section in the UI
        $sql = "SELECT * FROM questions WHERE ques_id='$quesId' AND quiz_id='$quizId'";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);

        $question = $row['question'];
        $opt_a = $row['opt_a'];
        $opt_b = $row['opt_b'];
        $opt_c = $row['opt_c'];
        $opt_d = $row['opt_d'];
    }
    else{
        header('location: ./result.php?tot='.$numOfQues.'&corr='.$corrAns);
    }
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online Quiz</title>
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
            <div class="container cont-bor-wh">
                <h1 class="questionText">Q</h1>
                <?php
                    echo '<form class="container md-col" action="../partials/checkAnswers.php?quesId='.$quesId.'&i='.$i.'" method="post">';
                    
                    echo '<div class="container md-row"><p class="question text-primary">'.$question.'</p></div>';
                    echo '<div class="container md-row">
                            <div>
                                <label for="ques_opt" class="inp-radio">'.$opt_a.'
                                    <input name="ques_opt" type="radio" value="'.$opt_a.'">
                                    <span class="checkmark"></span>
                                </label>
                            </div>
                            <div>
                                <label for="ques_opt" class="inp-radio">'.$opt_b.'
                                    <input name="ques_opt" type="radio" value="'.$opt_b.'">
                                    <span class="checkmark"></span>
                                </label>
                            </div>
                            <div>
                                <label for="ques_opt" class="inp-radio">'.$opt_c.'
                                    <input name="ques_opt" type="radio" value="'.$opt_c.'">
                                    <span class="checkmark"></span>
                                </label>
                            </div>
                            <div>
                                <label for="ques_opt" class="inp-radio">'.$opt_d.'
                                    <input name="ques_opt" type="radio" value="'.$opt_d.'">
                                    <span class="checkmark"></span>
                                </label>
                            </div>
                        </div>';
                    echo '<div class="container md-row row-end">
                    <button type="submit" class="btn btn-blue">NEXT</button>
                    <a href="./result.php?tot='.$numOfQues.'&corr='.$corrAns.'" class="btn btn-purple">FINISH</a>
                    <p class="quesCounter">'.$quesNum.'/'.$numOfQues.'</p>
                        </div>';
                    echo '</form>';
                ?>
                
            </div>
        </section>
    </main>
</body>
</html>