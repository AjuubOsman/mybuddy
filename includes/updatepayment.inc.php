<?php
include '../Private/connection.php';

$group_ID = $_GET['group_ID'];
$user_ID = $_SESSION['user_ID'];
$payment_ID = $_GET['payment_ID'];


$sql = "SELECT * FROM groups  where group_ID  = :group_ID ";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':group_ID' ,$group_ID);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);

$sql = "SELECT * FROM payment  where group_ID  = :group_ID AND user_ID = :user_ID AND payment_ID = :payment_ID  ";
$stmt2 = $conn->prepare($sql);
$stmt2->bindParam(':group_ID' ,$group_ID);
$stmt2->bindParam(':user_ID' ,$user_ID);
$stmt2->bindParam(':payment_ID' ,$payment_ID);
$stmt2->execute();
$row2 = $stmt2->fetch(PDO::FETCH_ASSOC);
?>
<div class="container mt-3">
    <h2>Update payment</h2>
    <form action="php/updatepayment.php" method="POST" enctype="multipart/form-data">
        <div class="mb-3 mt-3">
            <label>Bedrag:</label>
            <input type="text" class="form-control" placeholder="Bedrag" name="amount" value="<?=$row2['amount']?>">
        </div>
        <div class="mb-3 mt-3">
            <label>Description:</label>
            <input type="text" class="form-control" placeholder="Enter description" name="description" value="<?=$row2['description']?>">
        </div>
        <div class="mb-3 mt-3">
            <label>Description:</label>
            <input type="date" class="form-control" name="date" value="<?=$row2['date']?>">
        </div>

        <input type="hidden" name="group_ID"   value="<?=$row['group_ID']?>">
        <input type="hidden" name="payment_ID"   value="<?=$row2['payment_ID']?>">
        <button name="submit" type="submit" class="btn btn-success">Aanpassen</button>
    </form>
</div>
