<?php
    include './dbConnect.php';
    session_start();
    $userId = $_SESSION['userId'];

    $sql = "UPDATE user_current_ques SET ques_num = 0 , corr_ans = 0 WHERE user_id='$userId'";
    mysqli_query($conn, $sql);

    header('location: ../pages/userDashboard.php');
?>