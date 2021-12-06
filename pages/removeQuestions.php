<?php
    include '../partials/dbConnect.php';

    session_start();
    $userId = $_SESSION['userId'];
    $quizId = $_SESSION['quizId'];
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
    <title>Remove Question | Online Quiz</title>
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
                <a href="./removeQuiz.php" class="btn btn-purple">BACK</a>
                <button class="btn btn-pink pink-disabled" disabled>
                    <?php echo $name ?>
                </button>
                <a href="../partials/logout.php" class="btn btn-pink">LOGOUT</a>
            </div>
        </div>
        <section>
            <div class="container md-row-start">
                <div class="container col">
                    <?php
                        $sql = "SELECT * FROM quiz_details";
                        $result = mysqli_query($conn, $sql);
                        while($row = mysqli_fetch_assoc($result)){
                            if($quizId == $row['quiz_id']){
                                echo '<button class="btn btn-blue blue-disabled">'.$row['quiz_subject'].'</button>';
                            }
                            else{
                                echo '<button class="btn btn-pink pink-disabled">'.$row['quiz_subject'].'</button>';
                            }
                        }
                    ?>
                </div>
                <div class="container md-col cont-flex-1">
                    <div class="container col">
                    <?php
                        
                        $sql = "SELECT * FROM questions WHERE quiz_id = '$quizId'";
                        $result = mysqli_query($conn, $sql);
                        while($row = mysqli_fetch_assoc($result)){
                            $quesId = $row['ques_id'];
                            $ques = $row['question'];
                            echo '<form class="container md-col  cont-sp-col" method="post" action="../partials/removeQuestions.php?quesId='.$quesId.'">
                                    <div class="row">
                                        <label class="text-secondary" for="quesId">Question Id: </label>
                                        <input type="text" name="quesId" value="'.$quesId.'" disabled>
                                    </div>
                                    <div class="row">
                                        <label class="text-secondary" for="ques">Question: </label>
                                        <textarea name="ques" id="ques" cols="80" rows="2" disabled>'.$ques.'</textarea>
                                    </div>
                                    <div class="row-cen">
                                        <button class="btn btn-purple" type="submit">DELETE</button>
                                    </div>
                                </form>
                                ';
                            }
                            ?>
                            </div>
                </div>
        </section>
    </main>

    <script>

    </script>
</body>
</html>