<?php
    include '../partials/dbConnect.php';

    session_start();
    $userId = $_SESSION['userId'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registered Users | Online Quiz</title>
</head>
<body>
    <div>
        <?php
            $sql = "SELECT * FROM user";
            $result = mysqli_query($conn, $sql);
            while($row = mysqli_fetch_assoc($result)){
                echo '
                    <div><button>'.$row['user_id'].'</button></div>
                ';
            }
        ?>
    </div>
    <div>
        <div>
            <h3>USER NAME</h3>
            <h3>username@domain.com</h3>
        </div>
        <div>
            <div>
                <div>
                    <span>00</span>
                    <span>RANK</span>
                    <span>123</span>
                </div>
            </div>
            <div>
                <h2>RECENT QUIZES</h2>
                <div>
                    <div>
                        <span>HTML</span>
                        <span>11/20</span>
                    </div>
                    <div>
                        <span>HTML</span>
                        <span>11/20</span>
                    </div>
                    <div>
                        <span>HTML</span>
                        <span>11/20</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>