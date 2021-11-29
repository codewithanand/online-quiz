<?php

    include './dbConnect.php';
    session_start();
    $userId = $_SESSION['userId'];
    $quizId = $_SESSION['quizId'];

    $quesId = $_GET['quesId'];
    $i = $_GET['i'];
    $ans = $_POST['ques_opt'];

    $sql = "SELECT * FROM user_current_ques WHERE user_id = '$userId'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $corrAns = (int)$row['corr_ans'];
 
    $sql = "SELECT * FROM questions WHERE ques_id = '$quesId' AND quiz_id='$quizId'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $answer = $row['answer'];


    if($answer == $ans){
        $corrAns = (int)$corrAns + 1;
        $sql = "UPDATE user_current_ques SET corr_ans = '$corrAns' WHERE user_id='$userId'";
        mysqli_query($conn, $sql);
    }

    header('location: ./fetchQuestions.php?i='.$i);
    
?>