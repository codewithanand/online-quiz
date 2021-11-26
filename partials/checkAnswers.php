<?php

    include './dbConnect.php';

    $quesId = $_GET['quesId'];
    $i = $_GET['i'];
    $ans = $_POST['ques_opt'];

    $sql = "SELECT * FROM user_current_ques WHERE user_id = 1111";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $corrAns = (int)$row['corr_ans'];

    $sql = "SELECT * FROM questions WHERE ques_id = '$quesId'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $answer = $row['answer'];


    if($answer == $ans){
        $corrAns = (int)$corrAns + 1;
        $sql = "UPDATE user_current_ques SET corr_ans = '$corrAns' WHERE user_id=1111";
        mysqli_query($conn, $sql);
    }

    header('location: ./fetchQuestions.php?i='.$i);
    
?>