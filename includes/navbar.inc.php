<?php if (isset($_SESSION['user_ID'])){ ?>

    <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
        <div class="container-fluid">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link active" href=index.php?page=groupoverview >Overzicht</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="php/logout.php">Log uit</a>
                </li>
            </ul>
        </div>
    </nav>

<?php  }?>

