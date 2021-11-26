<?php
    include '../partials/dbConnect.php';

    $totalQues = $_GET['tot'];
    $corrAns = $_GET['corr'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Result | Online Quiz</title>
</head>
<body>
    <form action="../partials/resetQuestionSession.php" method="post">
        <h1><?php echo $corrAns.'/'.$totalQues ?></h1>
        <div>
            <button type="submit">OK</button>
        </div>
    </form>
</body>
</html>