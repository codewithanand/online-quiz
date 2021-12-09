<?php
    include '../partials/dbConnect.php';

    session_start();
    $userId = $_SESSION['userId'];

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        // If upload button is clicked ...
        if (isset($_POST['upload']) && isset($_FILES['uploadfile'])) {

            $img_name = $_FILES['uploadfile']['name'];
            $img_size = $_FILES['uploadfile']['size'];
            $tmp_name = $_FILES['uploadfile']['tmp_name'];
            $error = $_FILES['uploadfile']['error'];

            if($error == 0){
                if($img_size > 1250000){
                    $em = 'Sorry! Your file is too large';
                    header('location: ../pages/userDashboard.php?error=$em');
                }
                else{
                    $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
                    $img_ex_lc = strtolower($img_ex);

                    $allowed_ext = array('jpg', 'jpeg', 'png');

                    if(in_array($img_ex_lc, $allowed_ext)){
                        $new_img_name = uniqid('IMG-', true).'.'.$img_ex_lc;
                        $img_upload_path = '../img/profile/'.$new_img_name;
                        move_uploaded_file($tmp_name, $img_upload_path);

                        //INSERT INTO DATABASE TABLE
                        $sql = "UPDATE profile_picture SET img_name = '$new_img_name' WHERE user_id = '$userId'";
                        mysqli_query($conn, $sql);
                        
                        header('location: ../pages/userDashboard.php');
                    }
                    else{
                        $em = 'You cannot upload files of this type';
                        header('location: ../pages/userDashboard.php?error=$em');
                    }
                }
            }else{
                $em = 'Unknown error occured!';
                header('location: ../pages/userDashboard.php?error=$em');
            }

        }
        else{
            header('location: ../pages/userDashboard.php');
        }
    }

?>