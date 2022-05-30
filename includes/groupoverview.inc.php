<?php
include '../private/connection.php';

//test
$user_ID = $_SESSION['user_ID'];

$sql = "SELECT g.group_ID, m.user_ID, g.name,g.description, g.date, g.picture 
FROM groups g
LEFT JOIN member m on g.group_ID = m.group_ID
WHERE m.user_ID = $user_ID
";
$stmt = $conn->prepare($sql);
$stmt->execute();



?>
<div class="container mt-3">
    <h2>Groepen</h2>


    <button class="btn btn-success" onclick="window.location.href='index.php?page=addgroup'">Toevoegen</button>
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
        if ($stmt->rowCount() > 0){
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) { ?>
                <tr>
                    <td><img  class="picture" src="<?= $row["picture"]?>" ></td>
                    <td><?= $row["name"] ?></td>
                    <td><?= $row["description"] ?></td>
                    <td><?= $row["date"] ?></td>

                    <td>
                        <button class="btn btn-primary" onclick="window.location.href='index.php?page=group&group_ID=<?= $row["group_ID"] ?>'">Openen</button>
                    </td>


                    <?php

                $sql3 = "SELECT useradmin_ID FROM groups where group_ID = :group_ID";
                $stmt3 = $conn->prepare($sql3);
                $stmt3->bindParam(':group_ID', $row['group_ID']);
                $stmt3->execute();
                $row3 = $stmt3->fetch(PDO::FETCH_ASSOC);
                echo $row3['useradmin_ID'] .  $user_ID;

                if ($row3['useradmin_ID'] == $user_ID){{?>
                        <td>
                            <button class="btn btn-warning" onclick="window.location.href='index.php?page=updategroup&group_ID=<?= $row["group_ID"] ?>'">Aanpassen</button>
                        </td>


                        <td>
                            <button class="btn btn-danger" name="group_ID" onclick=" if(confirm('Weet u zeker dat u dit record wilt verwijderen?'))window.location.href='php/deletegroup.php?group_ID=<?= $row["group_ID"] ?>'">verwijderen</button>

                        </td>
                       <?php }?>


                </tr>

            <?php }}}?>