<?php
    include '../partials/dbConnect.php';

    //Fetch num of questions attempted by the user
    $sql = "SELECT * FROM user_current_ques WHERE user_id=1111";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $i = (int)$row['ques_num'];
    $corrAns = $row['corr_ans'];
    echo "<br>".($i+1);

    //Collect current question from the database
    $quesIdList = array();
    $sql = "SELECT ques_id FROM questions";
    $result = mysqli_query($conn, $sql);
    while($row = mysqli_fetch_assoc($result)){
        array_push($quesIdList, $row['ques_id']);
    }
    $numOfQues = count($quesIdList);
    echo "/".$numOfQues;
    $quesId = $quesIdList[$i];

    if($i < $numOfQues){
        //Populate question section in the UI
        $sql = "SELECT * FROM questions WHERE ques_id='$quesId'";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);

        $question = $row['question'];
        $opt_a = $row['opt_a'];
        $opt_b = $row['opt_b'];
        $opt_c = $row['opt_c'];
        $opt_d = $row['opt_d'];
    }
    else{
        header('location: ./result.php?tot='.$numOfQues.'&corr='.$corrAns);
    }
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online Quiz</title>
</head>
<body>
    <?php
        echo '<form action="../partials/checkAnswers.php?quesId='.$quesId.'&i='.$i.'" method="post">';

        echo '<p>'.$quesId.': '.$question.'</p>';
        echo '<div>
                <input name="ques_opt" type="radio" value="'.$opt_a.'">'.$opt_a.'
                <input name="ques_opt" type="radio" value="'.$opt_b.'">'.$opt_b.'
                <input name="ques_opt" type="radio" value="'.$opt_c.'">'.$opt_c.' 
                <input name="ques_opt" type="radio" value="'.$opt_d.'">'.$opt_d.'
            </div>';
        echo '<div>
                <button type="submit">NEXT</button>
            </div>';
        echo '</form>';
    ?>
</body>
</html>