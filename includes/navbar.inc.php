<?php
if (isset($_SESSION['user_ID'])){

    include '../Private/connection.php';
    $user_ID = $_SESSION['user_ID'];

    $sql = "SELECT g.group_ID, m.user_ID, g.name,g.description, g.date, g.picture 
FROM groups g
LEFT JOIN member m on g.group_ID = m.group_ID
WHERE m.user_ID = $user_ID
";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    $sql = "SELECT *
        FROM payment
        WHERE group_ID = :group_ID";
    $stmt2 = $conn->prepare($sql);
    $stmt2->bindParam(':group_ID', $row['group_ID']);
    $stmt2->execute();
    $row2 = $stmt2->fetch(PDO::FETCH_ASSOC);?>

    <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
        <div class="container-fluid">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link active" href=index.php?page=groupoverview >Overzicht</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href='index.php?page=viewpayment&group_ID=<?= $row2["group_ID"] ?>'">Betalingen</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="php/logout.php">Log uit</a>
                </li>
            </ul>
        </div>
    </nav>

<?php  }?>

