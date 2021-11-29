<?php
    include '../partials/dbConnect.php';

    session_start();
    $userId = $_SESSION['userId'];
    $quizId = $_SESSION['quizId'];

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
</head>
<body>
    <?php
        
    ?>
    <form action="./addQuestions.php" method="post">
        <div>
            <label for="quizId">Quiz Id: </label>
            <input type="text" name="quizId" id="quizId" value="<?php echo $quizId ?>" disabled>
        </div>
        <div>
            <label for="quizName">Quiz Name: </label>
            <input type="text" name="quizName" id="quizName" value="<?php echo $quizName ?>" disabled>
        </div>
        <div>
            <label for="ques">Question: </label>
            <textarea name="ques" id="ques" cols="80" rows="2"></textarea>
        </div>
        <div>
            <label for="optA">Option A: </label>
            <input type="text" name="optA" id="optA">
        </div>
        <div>
            <label for="optB">Option B: </label>
            <input type="text" name="optB" id="optB">
        </div>
        <div>
            <label for="optC">Option C: </label>
            <input type="text" name="optC" id="optC">
        </div>
        <div>
            <label for="optD">Option D: </label>
            <input type="text" name="optD" id="optD">
        </div>
        <div>
            <label for="ans">Answer: </label>
            <input type="text" name="ans" id="ans">
        </div>
        <div>
            <button type="submit">SUBMIT</button>
        </div>
    </form>
</body>
</html>