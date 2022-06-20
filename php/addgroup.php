<?php
session_start();
include '../../private/connection.php';

$name = $_POST['name'];
$description = $_POST['description'];
$user_ID = $_SESSION['user_ID'];






$natan = "picture/" . basename($_FILES["picture"]["name"]);

$target_dir = "../picture/";
$target_file = $target_dir . basename($_FILES["picture"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
// Check if image file is a actual image or fake image



if(isset($_POST["submit"])) {
    echo $natan . '<br>';
    $check = getimagesize($_FILES["picture"]["tmp_name"]);
    if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }



    if ($_FILES["picture"]["size"] > 500000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }



    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
        // if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["picture"]["tmp_name"], $target_file)) {
            echo "The file ". htmlspecialchars( basename( $_FILES["picture"]["name"])). " has been uploaded.";




                    $stmt = $conn->prepare("INSERT INTO groups  (name, description,picture, useradmin_ID)
                        VALUES(:name, :description,:picture, :useradmin_ID)");
                    $stmt->bindParam(':picture', $natan);
                    $stmt->bindParam(':name', $name);
                    $stmt->bindParam(':description', $description);
                    $stmt->bindParam(':useradmin_ID', $user_ID);
                    $stmt->execute();


            $group_ID2 = $conn->lastInsertId();

            $stmt2 = $conn->prepare("INSERT INTO member (user_ID, group_ID)
                    VALUES(:user_ID, :group_ID)");
            $stmt2->bindParam(':user_ID', $user_ID);
            $stmt2->bindParam(':group_ID', $group_ID2);
            $stmt2->execute();





            header('location: ../index.php?page=groupoverview');

        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
}
?>