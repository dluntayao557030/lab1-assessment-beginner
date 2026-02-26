<?php
include "../db.php";
 
$message = "";
 
// ASSIGN TOOL
if (isset($_POST['assign'])) {
  $booking_id = $_POST['booking_id'];
  $tool_id = $_POST['tool_id'];
  $qty = $_POST['qty_used'];
 
  $toolRow = mysqli_fetch_assoc(mysqli_query($conn, "SELECT quantity_available FROM tools WHERE tool_id=$tool_id"));
 
  if ($qty > $toolRow['quantity_available']) {
    $message = "Not enough available tools!";
  } else {
    mysqli_query($conn, "INSERT INTO booking_tools (booking_id, tool_id, qty_used)
      VALUES ($booking_id, $tool_id, $qty)");
 
    mysqli_query($conn, "UPDATE tools SET quantity_available = quantity_available - $qty WHERE tool_id=$tool_id");
 
    $message = "Tool assigned successfully!";
  }
}
 
$tools = mysqli_query($conn, "SELECT * FROM tools ORDER BY tool_name ASC");
$bookings = mysqli_query($conn, "SELECT booking_id FROM bookings ORDER BY booking_id DESC");
?>

<!doctype html>
<html>
<head><meta charset="utf-8"><title>Tools</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>

<body>
<?php include "../nav.php"; ?>
 
<div class="container p-5 mb-5 card" style="max-width: 1000px; margin-top: 100px; max-height: 1000px;">
    <h2 class="mb-4">Tools / Inventory</h2>
    <p style="color:green;"><?php echo $message; ?></p>
    
    <h5 class="mb-4">Available Tools</h5>
    <table border="1" cellpadding="8" class="table table-striped">
    <tr><th>Name</th><th>Total</th><th>Available</th></tr>
    <?php while($t = mysqli_fetch_assoc($tools)) { ?>
        <tr>
        <td><?php echo $t['tool_name']; ?></td>
        <td><?php echo $t['quantity_total']; ?></td>
        <td><?php echo $t['quantity_available']; ?></td>
        </tr>
    <?php } ?>
    </table>
    
    <hr>
    
    <div class="container mt-4 card border-0" style="max-width: 500px; max-height: 640px;"> 
        <h4 class="mb-4 text-center">Assign Tool to Booking</h4>
        <form method="post">
        <label>Booking ID</label><br>
        <select name="booking_id" class="form-select">
            <?php while($b = mysqli_fetch_assoc($bookings)) { ?>
            <option value="<?php echo $b['booking_id']; ?>">#<?php echo $b['booking_id']; ?></option>
            <?php } ?>
        </select><br><br>
        
        <label>Tool</label><br>
        <select name="tool_id"class="form-select">
            <?php
            $tools2 = mysqli_query($conn, "SELECT * FROM tools ORDER BY tool_name ASC");
            while($t2 = mysqli_fetch_assoc($tools2)) {
            ?>
            <option value="<?php echo $t2['tool_id']; ?>">
                <?php echo $t2['tool_name']; ?> (Avail: <?php echo $t2['quantity_available']; ?>)
            </option>
            <?php } ?>
        </select><br><br>
        
        <label>Qty Used</label><br>
        <input type="number" name="qty_used" min="1" value="1" class="form-control"><br><br>
        
        <button type="submit" name="assign" class="btn btn-primary form-control">Assign</button>
        </form>
    </div>
</div>
</body>
</html>