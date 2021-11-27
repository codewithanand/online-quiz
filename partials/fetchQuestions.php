<?php
    include './dbConnect.php';
    session_start();
    $userId = $_SESSION['userId'];

    $i = $_GET['i'];
    $i = (int)$i + 1;

    $sql = "UPDATE user_current_ques SET ques_num = '$i' WHERE user_id='$userId'";
    mysqli_query($conn, $sql);

    header('location: ../pages/quests.php');
?>