<?php
    include './dbConnect.php';

    session_start();
    $userId = $_SESSION['userId'];

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $quizName = $_POST['searchQuizName'];
        
        $sql = "SELECT * FROM quiz_details WHERE quiz_subject = '$quizName'";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        $quizId = $row['quiz_id'];
        $_SESSION['quizId'] = $row['quiz_id'];
        $numOfRows = mysqli_num_rows($result);
    
        if($numOfRows > 0){
            header('location: ../pages/removeQuestions.php');
        }
        else{
            echo 'Error! quiz not found';
            header('location: ../pages/removeQuiz.php');
        }
    }
?>