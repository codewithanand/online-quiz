<?php
    include './dbConnect.php';

    $sql = "UPDATE user_current_ques SET ques_num = 0 , corr_ans = 0 WHERE user_id=1111";
    mysqli_query($conn, $sql);

    header('location: ../pages/quests.php');
?>