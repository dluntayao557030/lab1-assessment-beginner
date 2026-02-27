<?php
include "../db.php";
 
$message = "";
 
if (isset($_POST['save'])) {
  $service_name = $_POST['service_name'];
  $description = $_POST['description'];
  $hourly_rate = $_POST['hourly_rate'];
  $is_active = $_POST['is_active'];
 
  // simple validation
  if ($service_name == "" || $hourly_rate == "") {
    $message = "Service name and hourly rate are required!";
  } else if (!is_numeric($hourly_rate) || $hourly_rate <= 0) {
    $message = "Hourly rate must be a number greater than 0.";
  } else {
    $sql = "INSERT INTO services (service_name, description, hourly_rate, is_active)
            VALUES ('$service_name', '$description', '$hourly_rate', '$is_active')";
    mysqli_query($conn, $sql);
 
    header("Location: services_list.php");
    exit;
  }
}
?>
<!doctype html>
<html>
<head><meta charset="utf-8"><title>Add Service</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
<body>
<?php include "../nav.php"; ?>
 
<div class="container p-5 mb-5 card" style="max-width: 600px; margin-top: 100px; max-height: 700px;"> 
    <h2 class="text-center">Add Service</h2>
    <p class="text-danger text-center"><?php echo $message; ?></p>
    
    <form method="post">
    <div>
        <label>Service Name*</label><br>
        <input type="text" name="service_name" class="form-control"><br><br>
        
        <label>Description</label><br>
        <textarea name="description" rows="4" cols="40" class="form-control"></textarea><br><br>
        
        <label>Hourly Rate (₱)*</label><br>
        <input type="text" name="hourly_rate" class="form-control"><br><br>
        
        <label>Active?</label><br>
        <select name="is_active" class="form-select">
            <option value="1">Yes</option>
            <option value="0">No</option>
        </select><br><br>
        
        <button type="submit" name="save" class="btn btn-primary" style="width: 100%;">Save Service</button>
    </div>
    </form>
</div>
</body>
</html>