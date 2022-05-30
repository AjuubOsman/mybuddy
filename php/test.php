<?php
include '../../private/connection.php';

$name = $_POST['name'];
$description = $_POST['description'];
$group_ID = $_POST['group_ID'];

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



    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
        // if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["picture"]["tmp_name"], $target_file)) {
            echo "The file ". htmlspecialchars( basename( $_FILES["picture"]["name"])). " has been uploaded.";
            $stmt = $conn->prepare("UPDATE groups SET name = :name, description = :description, picture = :picture WHERE group_ID = :group_ID ");

            $stmt->bindParam(':name', $name, PDO::PARAM_STR);
            $stmt->bindParam(':description', $description, PDO::PARAM_STR);
            $stmt->bindParam(':picture' ,$natan);
            $stmt->bindParam(':group_ID' ,$group_ID);



            $stmt->execute();

        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
}
?>