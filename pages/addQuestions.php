<?php
    include '../partials/dbConnect.php';

    session_start();
    $userId = $_SESSION['userId'];
    $quizId = $_SESSION['quizId'];

    $sql = "SELECT * FROM user WHERE user_id='$userId'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $name = $row['user_fname'].' '.$row['user_lname'];

    $sql = "SELECT * FROM questions WHERE quiz_id = '$quizId'";
    $result = mysqli_query($conn, $sql);
    $totQues = mysqli_num_rows($result);

    $sql = "SELECT * FROM quiz_details WHERE quiz_id = '$quizId'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);

    $quizName = $row['quiz_subject'];

    if($_SERVER['REQUEST_METHOD'] == 'POST'){

        $question = $_POST['ques'];
        $optA = $_POST['optA'];
        $optB = $_POST['optB'];
        $optC = $_POST['optC'];
        $optD = $_POST['optD'];
        $ans = $_POST['ans'];

        $sql = "INSERT INTO questions (question, opt_a, opt_b, opt_c, opt_d, answer, quiz_id) VALUES ('$question','$optA','$optB','$optC','$optD','$ans','$quizId')";
        $result = mysqli_query($conn, $sql);

        if($result){
            echo 'Success! Question successfully added to the quiz';
            header('location: ./addQuestions.php');
        }
        else{
            echo 'Error! Please fill the form very carefully';
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Questions | Online Quiz</title>
    <link rel="icon" href="../img/quiz-ico.png" type="image/x-icon">
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    <main>
        <div class="navbar">
            <div class="nav-logo"><h3>Online Quiz</h3></div>
            <div class="nav-btns">
                <a href="./addQuiz.php" class="btn btn-purple">BACK</a>
                <button class="btn btn-pink pink-disabled" disabled><?php echo $name ?></button>
                <a href="../partials/logout.php" class="btn btn-pink">LOGOUT</a>
            </div>
        </div>
        <section>
            <form class="container md-col cont-lg" action="./addQuestions.php" method="post">
                <h2>Add Question</h2>
                <div class="row">
                    <label class="text-primary" for="quesNo">Question Number: </label>
                    <input type="text" name="quesNo" id="quesNo" value="<?php echo $totQues+1 ?>" disabled>
                </div>
                <div class="row">
                    <label class="text-primary" for="quizId">Quiz Id: </label>
                    <input type="text" name="quizId" id="quizId" value="<?php echo $quizId ?>" disabled>
                </div>
                <div class="row">
                    <label class="text-primary" for="quizName">Quiz Name: </label>
                    <input type="text" name="quizName" id="quizName" value="<?php echo $quizName ?>" disabled>
                </div>
                <div class="row">
                    <label class="text-primary" for="ques">Question: </label>
                    <textarea name="ques" id="ques" cols="80" rows="2" required></textarea>
                </div>
                <div class="row">
                    <label class="text-primary" for="optA">Option A: </label>
                    <input type="text" name="optA" id="optA" required>
                </div>
                <div class="row">
                    <label class="text-primary" for="optB">Option B: </label>
                    <input type="text" name="optB" id="optB" required>
                </div>
                <div class="row">
                    <label class="text-primary" for="optC">Option C: </label>
                    <input type="text" name="optC" id="optC" required>
                </div>
                <div class="row">
                    <label class="text-primary" for="optD">Option D: </label>
                    <input type="text" name="optD" id="optD" required>
                </div>
                <div class="row">
                    <label class="text-primary" for="ans">Answer: </label>
                    <input type="text" name="ans" id="ans" required>
                </div>
                <div class="row-cen">
                    <button class="btn btn-purple" type="submit">SUBMIT</button>
                </div>
            </form>
        </section>
    </main>
</body>
</html>