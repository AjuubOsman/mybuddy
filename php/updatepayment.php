<?php
session_start();
include '../../Private/connection.php';

$amount = $_POST['amount'];
$description = $_POST['description'];
$group_ID = $_POST['group_ID'];
$date = $_POST['date'];
$user_ID = $_SESSION['user_ID'];
$payment_ID = $_POST['payment_ID'];


$stmt = $conn->prepare("UPDATE payment SET description = :description, date = :date, amount = :amount WHERE payment_ID = :payment_ID and user_ID = :user_ID ");


$stmt->bindParam(':description', $description );
$stmt->bindParam(':user_ID', $user_ID );
$stmt->bindParam(':date', $date );
$stmt->bindParam(':amount', $amount);
$stmt->bindParam(':payment_ID', $payment_ID);


$stmt->execute();

$sql = "SELECT user_ID FROM payment WHERE user_ID = :user_ID";

$stmt2 = $conn->prepare($sql);
$stmt2->bindParam(':user_ID', $user_ID );
$stmt2->execute();

$row2 = $stmt2->fetch(PDO::FETCH_ASSOC);


$stmt3 = $conn->prepare("UPDATE userpayment SET debt = :amount WHERE payment_ID = :payment_ID and user_ID = :user_ID ");
$stmt3->bindParam(':amount', $amount);
$stmt3->bindParam(':payment_ID', $payment_ID);
$stmt3->bindParam(':user_ID', $row2['user_ID']);
$stmt3->execute();

$sql = "SELECT  COUNT(*) from  userpayment  where payment_ID  = :payment_ID";
$stmt4 = $conn->prepare($sql);
$stmt4->bindParam(':payment_ID', $payment_ID);

$stmt4->execute();

$row4 = $stmt4->fetch(PDO::FETCH_ASSOC);


$sql = "SELECT  COUNT(*) from  userpayment  where payment_ID  = :payment_ID and user_ID != :user_ID ";
$stmt5 = $conn->prepare($sql);
$stmt5->bindParam(':payment_ID', $payment_ID);
$stmt5->bindParam(':user_ID', $user_ID);

$stmt5->execute();
$row5 = $stmt5->fetch(PDO::FETCH_ASSOC);
$groupdebt = $amount / (int)$row4['COUNT(*)'];
$ownerdebt = $groupdebt * (int)$row5['COUNT(*)'];

$stmt6 = $conn->prepare("UPDATE userpayment SET debt = -$groupdebt  where payment_ID = :payment_ID and user_ID != :user_ID");
$stmt6->bindParam(':payment_ID', $payment_ID);
$stmt6->bindParam(':user_ID', $user_ID);
$stmt6->execute();

$stmt7 = $conn->prepare("UPDATE userpayment SET debt = $ownerdebt  where payment_ID = :payment_ID and user_ID = :user_ID ");
$stmt7->bindParam(':user_ID', $user_ID);
$stmt7->bindParam(':payment_ID', $payment_ID);
$stmt7->execute();

header('location: ../index.php?page=viewpayment&group_ID=' . $group_ID);

?>