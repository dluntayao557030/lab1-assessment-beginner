<?php
include "../db.php";
$result = mysqli_query($conn, "SELECT * FROM services ORDER BY service_id DESC");
?>
<!doctype html>
<html>
<head><meta charset="utf-8"><title>Services</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>

<body>
<?php include "../nav.php"; ?>
<div class="container p-5 card" style="max-width: 1000px; margin-top: 100px; max-height: 640px;">
    <h2 class="pb-4">Services</h2>
    <table border="1" cellpadding="8" class ="table table-striped">
    <tr>
        <th>ID</th><th>Name</th><th>Rate</th><th>Active</th><th>Action</th>
    </tr>
    <?php while($row = mysqli_fetch_assoc($result)) { ?>
        <tr>
        <td><?php echo $row['service_id']; ?></td>
        <td><?php echo $row['service_name']; ?></td>
        <td>₱<?php echo number_format($row['hourly_rate'],2); ?></td>
        <td><?php echo $row['is_active'] ? "Yes" : "No"; ?></td>
        <td><button class="btn btn-secondary" onclick="window.location.href='services_edit.php?id=<?php echo $row['service_id']; ?>'">Edit</button></td>
        </tr>
    <?php } ?>
    </table>
</div>
</body>
</html>