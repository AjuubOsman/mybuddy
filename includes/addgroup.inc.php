<div class="container mt-3">
    <h2>Make a group</h2>
    <form action="php/addgroup.php" method="POST" enctype="multipart/form-data">
        <div class="mb-3 mt-3">
            <label>Naam:</label>
            <input type="text" class="form-control" placeholder="Enter name" name="name">
        </div>
        <div class="mb-3 mt-3">
            <label>Description:</label>
            <input type="text" class="form-control" placeholder="Enter description" name="description">
        </div>

        <div class="mb-3 mt-3">
            <label>Afbeelding:</label>
            <input type="file" class="form-control" name="picture" >
        </div>
        <button name="submit" type="submit" class="btn btn-success">Toevoegen</button>
    </form>
</div>
