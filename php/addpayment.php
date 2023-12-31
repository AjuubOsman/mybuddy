<?php
session_start();
include '../../Private/connection.php';

$user_ID = $_SESSION['user_ID'];
$amount = $_POST['amount'];
$description = $_POST['description'];
$group_ID = $_POST['group_ID'];
$date = $_POST['date'];

$stmt = $conn->prepare("INSERT INTO payment (user_ID,date, description,amount, group_ID )
                        VALUES(:user_ID,:date, :description, :amount, :group_ID)");
$stmt->bindParam(':user_ID', $user_ID);
$stmt->bindParam(':date', $date);
$stmt->bindParam(':description', $description );
$stmt->bindParam(':amount', $amount);
$stmt->bindParam(':group_ID', $group_ID);


$stmt->execute();
header('location: ../index.php?page=viewpayment&group_ID=' . $group_ID);

?>