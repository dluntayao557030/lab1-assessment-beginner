<?php
include "../db.php";
$id = $_GET['id'];
 
$get = mysqli_query($conn, "SELECT * FROM services WHERE service_id = $id");
$service = mysqli_fetch_assoc($get);
 
if (isset($_POST['update'])) {
  $name = $_POST['service_name'];
  $desc = $_POST['description'];
  $rate = $_POST['hourly_rate'];
  $active = $_POST['is_active'];
 
  mysqli_query($conn, "UPDATE services
    SET service_name='$name', description='$desc', hourly_rate='$rate', is_active='$active'
    WHERE service_id=$id");
 
  header("Location: services_list.php");
  exit;
}
?>
<!doctype html>
<html>
<head><meta charset="utf-8"><title>Edit Service</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
<body>
<?php include "../nav.php"; ?>
<div class="container p-5  mb-5 card" style="max-width: 600px; margin-top: 100px; max-height: 700px;">
    <h2 class="text-center">Edit Service</h2>
    <form method="post">
    <div class="mb-4">
        <label>Service Name</label><br>
        <input type="text" name="service_name" value="<?php echo $service['service_name']; ?>" class="form-control"><br><br>
        
        <label>Description</label><br>
        <textarea name="description" rows="4" cols="40" class="form-control"><?php echo $service['description']; ?></textarea><br><br>
        
        <label>Hourly Rate</label><br>
        <input type="text" name="hourly_rate" value="<?php echo $service['hourly_rate']; ?>" class="form-control"><br><br>
        
        <label>Active</label><br>
        <select name="is_active" class="form-control">
            <option value="1" <?php if($service['is_active']==1) echo "selected"; ?>>Yes</option>
            <option value="0" <?php if($service['is_active']==0) echo "selected"; ?>>No</option>
        </select><br><br>
        
        <button type="submit" name="update" class="btn btn-primary" style="width: 100%;">Update</button>
    </div>
    </form>
</div>
</body>
</html>