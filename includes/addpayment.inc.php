<?php
include '../Private/connection.php';

$group_ID = $_GET['group_ID'];

$sql = "SELECT * FROM groups  where group_ID = group_ID = :group_ID ";
$stmt4 = $conn->prepare($sql);
$stmt4->bindParam(':group_ID' ,$group_ID);
$stmt4->execute();
$row4 = $stmt4->fetch(PDO::FETCH_ASSOC);
?>
<div class="container mt-3">
    <h2>Make a group</h2>
    <form action="php/addpayment.php" method="POST" enctype="multipart/form-data">
        <div class="mb-3 mt-3">
            <label>Bedrag:</label>
            <input type="text" class="form-control" placeholder="Bedrag" name="amount">
        </div>
        <div class="mb-3 mt-3">
            <label>Description:</label>
            <input type="text" class="form-control" placeholder="Enter description" name="description">
        </div>


        <input type="hidden" name="group_ID"   value="<?=$group_ID?>">
        <button name="submit" type="submit" class="btn btn-success">Toevoegen</button>
    </form>
</div>
