<?php
session_start();
include '../../private/connection.php';

$email = $_POST['email'];
$group_ID = $_POST['group_ID'];



$sql = 'SELECT user_ID FROM users where email = :email ';
$stmt = $conn->prepare($sql);
$stmt->bindParam(':email', $email);
$stmt->execute();

$row = $stmt->fetch(PDO::FETCH_ASSOC);

if ($stmt->rowCount() > 0) {

    $sql = 'SELECT user_ID FROM member where user_ID = :userid AND group_ID = :group_ID ';
    $stmt2 = $conn->prepare($sql);
    $stmt2->bindParam(':userid', $row['user_ID']);
    $stmt2->bindParam(':group_ID', $group_ID);
    $stmt2->execute();
    if ($stmt2->rowCount() == 0) {
        $stmt3 = $conn->prepare("INSERT INTO member (user_ID, group_ID)
                    VALUES(:user_ID, :group_ID)");
        $stmt3->bindParam(':user_ID', $row['user_ID']);
        $stmt3->bindParam(':group_ID', $group_ID);
        $stmt3->execute();
        $_SESSION['melding'] = 'Gebruiker is toegevoegd aan de groep.';
    } else {
        $_SESSION['melding'] = 'Gebruiker is al toegevoegd aan de groep.';
    }
}
else {
    $_SESSION['melding'] = 'Email bestaat niet.';
}

header('location: ../index.php?page=group&group_ID=' . $group_ID);