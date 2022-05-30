<?php
session_start();

include '../../private/connection.php';

$email = $_POST['email'];
$password = $_POST['password'];

$sql = "SELECT role, user_ID FROM users WHERE email= :email AND password = :password";

$query = $conn->prepare($sql);
$query->bindParam(':email', $email);
$query->bindParam(':password', $password);
$query->execute();


if ($query->rowCount() == 1 ) {
    $result = $query->fetch(PDO::FETCH_ASSOC);
    if ($result['role'] == "user") {
        $_SESSION['role'] = "user";
        $_SESSION['user_ID'] = $result['user_ID'];
        header('location: ../index.php?page=groupoverview');
  }


}else{

    $_SESSION['melding'] = 'Combinatie gebruikersnaam en Wachtwoord onjuist.';
   header('location: ../index.php?page=login');
}




?>
