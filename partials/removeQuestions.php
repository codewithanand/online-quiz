<?php
    include './dbConnect.php';

    session_start();
    $userId = $_SESSION['userId'];

    $quesId = $_GET['quesId'];

    $sql = "DELETE FROM questions WHERE ques_id = '$quesId'";
    $result = mysqli_query($conn, $sql);
    if($result){
        echo 'Success! Question deleted';
        header('location: ../pages/removeQuestions.php');
    }
    else{
        echo 'Error! Something went wrong';
    }
?>