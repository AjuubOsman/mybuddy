<?php
include '../../private/connection.php';
$payment_ID = $_GET['payment_ID'];
$group_ID = $_GET['group_ID'];

$stmt = $conn->prepare("DELETE FROM userpayment  where payment_ID = :payment_ID");
$stmt->bindParam(':payment_ID' ,$payment_ID);
$stmt->execute();

$stmt = $conn->prepare("DELETE FROM payment  where payment_ID = :payment_ID");
$stmt->bindParam(':payment_ID' ,$payment_ID);
$stmt->execute();
header('location: ../index.php?page=viewpayment&group_ID=' . $group_ID);
?>
