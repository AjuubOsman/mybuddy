<?php
session_start();
include '../../private/connection.php';

$user = $_POST['user'];
$payment_ID = $_POST['payment_ID'];
$group_ID = $_POST['group_ID'];
$user_ID = $_SESSION['user_ID'];

echo '<pre>'; print_r($_POST); echo '</pre>';



//
//$sql = 'SELECT user_ID FROM users where user_ID = :user_ID';
//$stmt = $conn->prepare($sql);
//$stmt->bindParam(':user_ID', $user_ID['user_ID']);
//$stmt->execute();
//
//$row = $stmt->fetchall(PDO::FETCH_ASSOC);



$sql2 = 'SELECT * FROM userpayment where payment_ID = :payment_ID and user_ID = :user_ID';
$stmt2 = $conn->prepare($sql2);
$stmt2->bindParam(':payment_ID', $payment_ID);
$stmt2->bindParam(':user_ID', $user_ID);

$stmt2->execute();



if ($stmt2->rowCount() == 0) {


    //echo '<pre>'; print_r($row); echo '</pre>';

    foreach($user as $person){

        $stmt3 = $conn->prepare("INSERT INTO userpayment (user_ID, payment_ID)
                    VALUES(:user_ID, :payment_ID)");
        $stmt3->bindParam(':user_ID', $person);
        $stmt3->bindParam(':payment_ID', $payment_ID);
        $stmt3->execute();

        $_SESSION['melding'] = 'Betaling is gekoppeld.';
    }










}else{
    $_SESSION['melding'] = 'Deelnemer al gekoppeld aan deze betaling.';
}


//header('location: ../index.php?page=viewpayment&group_ID=' . $group_ID);