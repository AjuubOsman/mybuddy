<?php
include '../../private/connection.php';

$group_ID = $_GET['group_ID'];
$sql = 'SELECT * FROM member';
$stmt = $conn->prepare($sql);

$stmt->execute();

if($stmt->rowCount() > 0);{

    $group_ID = $_GET['group_ID'];

    $stmt = $conn->prepare("DELETE FROM member  where group_ID = :group_ID");
    $stmt->bindParam(':group_ID' ,$group_ID);
    $stmt->execute();
    header('location: ../index.php?page=groupoverview');


    $stmt = $conn->prepare("DELETE FROM groups  where group_ID = :group_ID");
    $stmt->bindParam(':group_ID' ,$group_ID);
    $stmt->execute();
    header('location: ../index.php?page=groupoverview');
}






