<?php
    include './dbConnect.php';

    $i = $_GET['i'];
    $i = (int)$i + 1;

    $sql = "UPDATE user_current_ques SET ques_num = '$i' WHERE user_id=1111";
    mysqli_query($conn, $sql);

    header('location: ../pages/quests.php');
?>