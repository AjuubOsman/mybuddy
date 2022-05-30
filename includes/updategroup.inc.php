<?php
include '../Private/connection.php';

$group_ID = $_GET['group_ID'];

$sql = "SELECT * FROM groups WHERE group_ID = :group_ID";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':group_ID' ,$group_ID);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
?>
<div class="container mt-3">
    <h2>Producten aanpassen</h2>
    <form action="php/updategroup.php" method="POST"  enctype="multipart/form-data">
        <div class="mb-3 mt-3">
            <label>Afbeelding:</label>
            <input type="file" class="form-control" placeholder="Enter name" name="picture" value="<?= $row['picture'] ?>" required>
        </div>
        <div class="mb-3 mt-3">
            <label>Naam:</label>
            <input type="text" class="form-control" placeholder="Naam" name="name" value="<?= $row['name'] ?>">
        </div>
        <div class="mb-3 mt-3">
            <label>Beschrijving:</label>
            <input type="text" class="form-control" placeholder="Beschrijving" name="description" value="<?= $row['description'] ?>">
        </div>
        <input type="hidden" name="group_ID" value="<?= $group_ID ?>">
        <button type="submit" name="submit" class="btn btn-success">Opslaan</button>
    </form>
</div>
