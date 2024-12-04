<?php
include 'functions.php'; 


$row = getTicketFromRequest($conn); 

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Ticket</title>
    <link rel="stylesheet" href="styles.css">

</head>
<body>

<div class="container">
    <div class="card">
        <div class="card-header">
            <h2>Edit Ticket</h2>
        </div>
        <div class="card-body">
            <form action="process.php" method="POST">
                <input type="hidden" name="id" value="<?php echo $row['id']; ?>">

                <div class="form-group">
                    <label for="namakonser">Nama Konser</label>
                    <input type="text" name="namakonser" value="<?php echo htmlspecialchars($row['namakonser']); ?>" required>
                </div>
                <div class="form-group">
                    <label for="price">Harga</label>
                    <input type="number" name="price" value="<?php echo htmlspecialchars($row['price']); ?>" required>
                </div>

                <button type="submit" name="update">Update Ticket</button>
            </form>
        </div>
    </div>
</div>

</body>
</html>