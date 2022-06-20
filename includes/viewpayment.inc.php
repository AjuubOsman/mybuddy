<?php
include '../Private/connection.php';

$group_ID = $_GET['group_ID'];
$user_ID = $_SESSION['user_ID'];

$sql = "SELECT *
        FROM payment
        WHERE group_ID = :group_ID";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':group_ID', $group_ID);
$stmt->execute();


?>


<div class="container mt-3">
    <h2>Betalingen</h2>
    <?php
    if (isset($_SESSION['melding'])) {
        echo $_SESSION['melding'];
        unset($_SESSION['melding']);
    }

    ?>
    <table class="table table-striped">
        <thead>
        <tr>
            <th>Bedrag</th>
            <th>Betaald door</th>
            <th>Datum</th>
            <th>Description</th>
            <div class="betaling">
                <button  class="btn btn-success" onclick="window.location.href='index.php?page=addpayment&group_ID=<?=$group_ID?>'">Betaling toevoegen</button>
            </div>
            <th></th>
            <th>Machtigingen</th>
        </tr>
        </thead>
        <tbody>

        <?php if ($stmt->rowCount() > 0){?>

            <?php while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $sql = "SELECT firstname
                        FROM users
                        WHERE user_ID = :user_ID";
                $stmt2 = $conn->prepare($sql);
                $stmt2->bindParam(':user_ID', $row['user_ID']);
                $stmt2->execute();
                $row2 = $stmt2->fetch(PDO::FETCH_ASSOC)
                ?>
                <tr>
                    <td><?= $row["amount"] ?> $</td>
                    <td><?= $row2["firstname"] ?></td>
                    <td><?= $row["date"] ?></td>
                    <td><?= $row["description"]?></td>
                <td>

                    <button class="btn btn-info" onclick="window.location.href='index.php?page=groupbalans&payment_ID=<?= $row["payment_ID"] ?>&group_ID=<?= $row["group_ID"] ?>'">Betaling openen</button>

                </td>
                    <?php if ($row['user_ID'] == $user_ID){ ?>
                    <td>

                        <button class="btn btn-primary" onclick="window.location.href='index.php?page=payment&payment_ID=<?= $row["payment_ID"] ?>&group_ID=<?= $row["group_ID"] ?>'">Betaling Koppelen</button>

                    </td>
                <td>
                    <button  class="btn btn-warning" onclick="window.location.href='index.php?page=updatepayment&payment_ID=<?= $row["payment_ID"] ?>&group_ID=<?= $row["group_ID"] ?>'">Betaling Aanpassen</button>

                </td>
                    <td>

                        <button class="btn btn-danger" name="group_ID" onclick=" if(confirm('Weet u zeker dat u dit record wilt verwijderen?'))window.location.href='php/deletepayment.php?payment_ID=<?= $row["payment_ID"] ?>&group_ID=<?= $row["group_ID"] ?>'">verwijderen</button>

                    </td>




                </tr>
            <?php  }}} ?>
        </tbody>
    </table>
