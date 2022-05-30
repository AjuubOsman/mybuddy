<?php
include '../../private/connection.php';
session_start();
$password = $_POST['password'];
$passwordrepeat = $_POST['passwordrepeat'];


if ($password == $passwordrepeat)
{

    $email = $_POST['email'];
    $firstname = $_POST['firstname'];
    $middlename = $_POST['middlename'];
    $lastname = $_POST['lastname'];

    $role = "user";

    $stmt = $conn->prepare("INSERT INTO users (email,firstname, middlename, lastname,password,role)
                                                   values(:email,:firstname, :middlename, :lastname,:password,:role)");


    $stmt->bindParam(':email' , $email);
    $stmt->bindParam(':firstname' , $firstname);
    $stmt->bindParam(':middlename' , $middlename);
    $stmt->bindParam(':lastname' , $lastname);
    $stmt->bindParam(':password' , $password);
    $stmt->bindParam(':role' , $role);



    $stmt->execute();
    header('location: ../index.php?page=login');



}
else{
    $_SESSION['melding'] = 'Wachtwoorden komen niet overeen';
    header('location: ../index.php?page=register');
}




?>
