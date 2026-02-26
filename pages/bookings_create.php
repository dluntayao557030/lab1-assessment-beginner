<?php
include "../db.php";
 
$clients = mysqli_query($conn, "SELECT * FROM clients ORDER BY full_name ASC");
$services = mysqli_query($conn, "SELECT * FROM services WHERE is_active=1 ORDER BY service_name ASC");
 
if (isset($_POST['create'])) {
  $client_id = $_POST['client_id'];
  $service_id = $_POST['service_id'];
  $booking_date = $_POST['booking_date'];
  $hours = $_POST['hours'];
 
  // get service hourly rate
  $s = mysqli_fetch_assoc(mysqli_query($conn, "SELECT hourly_rate FROM services WHERE service_id=$service_id"));
  $rate = $s['hourly_rate'];
 
  $total = $rate * $hours;
 
  mysqli_query($conn, "INSERT INTO bookings (client_id, service_id, booking_date, hours, hourly_rate_snapshot, total_cost, status)
    VALUES ($client_id, $service_id, '$booking_date', $hours, $rate, $total, 'PENDING')");
 
  header("Location: bookings_list.php");
  exit;
}
?>

<!doctype html>
<html>
<head><meta charset="utf-8"><title>Create Booking</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
<body>
<?php include "../nav.php"; ?>
 
<div class="container p-5 mb-5 card" style="max-width: 600px; margin-top: 100px; max-height: 640px;"> 
    <h2 class="text-center">Create Booking</h2>
    <form method="post">
    <div class="mb-4">
        <label>Client</label><br>
        <select name="client_id" class="form-select">
            <?php while($c = mysqli_fetch_assoc($clients)) { ?>
            <option value="<?php echo $c['client_id']; ?>"><?php echo $c['full_name']; ?></option>
            <?php } ?>
        </select><br><br>
        
        <label>Service</label><br>
        <select name="service_id" class="form-select">
            <?php while($s = mysqli_fetch_assoc($services)) { ?>
            <option value="<?php echo $s['service_id']; ?>">
                <?php echo $s['service_name']; ?> (₱<?php echo number_format($s['hourly_rate'],2); ?>/hr)
            </option>
            <?php } ?>
        </select><br><br>
        
        <label>Date</label><br>
        <input type="date" name="booking_date" class="form-control"><br><br>
        
        <label>Hours</label><br>
        <input type="number" name="hours" min="1" value="1" class="form-control"><br><br>
        
        <button type="submit" name="create" class="btn btn-primary" style="width: 100%;">Create Booking</button>
    </div>
    </form>
</div>
</body>
</html>