<?php
include "../db.php";
 
 
/* ============================
   SOFT DELETE (Deactivate)
   ============================ */
if (isset($_GET['delete_id'])) {
  $delete_id = $_GET['delete_id'];
 
 
  // Soft delete (set is_active to 0)
  mysqli_query($conn, "UPDATE services SET is_active=0 WHERE service_id=$delete_id");
 
 
  header("Location: services_list.php");
  exit;
}
 
 
/* ============================
   FETCH ALL SERVICES
   ============================ */
$result = mysqli_query($conn, "SELECT * FROM services ORDER BY service_id DESC");
?>
 
<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title>Services</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>

<body>
<?php include "../nav.php"; ?>
 
<div class="container p-5 card" style="max-width: 1000px; margin-top: 100px; max-height: 640px;">
<h2 class="mb-4">Services</h2>

<table border="1" cellpadding="8" class="table table-striped">
  <tr>
    <th>ID</th>
    <th>Name</th>
    <th>Rate</th>
    <th>Status</th>
    <th>Action</th>
  </tr>
 
  <?php while($row = mysqli_fetch_assoc($result)) { ?>
    <tr>
      <td><?php echo $row['service_id']; ?></td>
      <td><?php echo $row['service_name']; ?></td>
      <td>₱<?php echo number_format($row['hourly_rate'],2); ?></td>
 
      <td>
        <?php
          if ($row['is_active'] == 1) {
            echo "Active";
          } else {
            echo "Inactive";
          }
        ?>
      </td>
      <td class = "text-center">
        <a class="btn btn-secondary"href="services_edit.php?id=<?php echo $row['service_id']; ?>">Edit</a>
 
        <?php if ($row['is_active'] == 1) { ?>
          <a class ="btn btn-danger"href="services_list.php?delete_id=<?php echo $row['service_id']; ?>"
             onclick="return confirm('Deactivate this service?')">
             Deactivate
          </a>
        <?php } ?>
        
      </td>
    </tr>
  <?php } ?>
    
</table>
        <p class="text-end pt-4">
            <a class="btn btn-primary" href="services_add.php">+ Add Service</a>
        </p>
 </div>
</body>
</html>