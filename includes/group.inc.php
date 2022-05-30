<?php
include '../Private/connection.php';

$group_ID = $_GET['group_ID'];
$user_ID = $_SESSION['user_ID'];


$sql = "SELECT * FROM groups WHERE group_ID = :group_ID";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':group_ID' ,$group_ID);
$stmt->execute();


$sql = "SELECT u.user_ID, u.firstname
FROM member m 
LEFT JOIN users u on m.user_ID = u.user_ID
WHERE group_ID = :group_ID";
$stmt2 = $conn->prepare($sql);
$stmt2->bindParam(':group_ID' ,$group_ID);
$stmt2->execute();

$sql3 = "SELECT useradmin_ID FROM groups";
$stmt3 = $conn->prepare($sql3);
$stmt3->execute();
$row3 = $stmt3->fetch(PDO::FETCH_ASSOC);



?>
<div class="container mt-3">
    <h2>Groepen</h2>
    <button class="btn btn-success" onclick="window.location.href='index.php?page=groupoverview'">Terug</button>
    <table class="table table-striped">
        <thead>
        <tr>
            <th>Afbeelding</th>
            <th>Naam</th>
            <th>Beschrijving</th>
            <th>Datum</th>
            <th></th>
        </tr>
        </thead>
        <tbody>

        <?php
        if (isset($_SESSION['melding']))
        {
            echo $_SESSION['melding'];
            unset($_SESSION['melding']);
        }

        ?>
        <?php
        if ($stmt->rowCount() > 0){
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) { ?>
                <tr>
                    <td><img  class="picture" src="<?= $row["picture"]?>" ></td>
                    <td><?= $row["name"] ?></td>
                    <td><?= $row["description"] ?></td>
                    <td><?= $row["date"] ?></td>

                    <?php if ($row3['useradmin_ID'] == $user_ID){ ?>
                    <form action="php/addmember.php" method="post">
                        <div class="mb-3 mt-3">
                            <label>Members Email</label>
                            <input type="hidden" name="group_ID" value="<?= $row["group_ID"] ?>">
                            <input type="email" class="form-control" placeholder="Enter Email" name="email">
                        </div>
                    </form>
                    </tr>
                <th>Leden</th>
                    <?php } } }

                    if ($stmt2->rowCount() > 0){
                    while ($row2 = $stmt2->fetch(PDO::FETCH_ASSOC)) { ?>
                        <tr>
                            <td><?= $row2["firstname"] ?></td>
                        </tr>
            <?php } } ?>

