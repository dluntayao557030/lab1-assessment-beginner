<?php
include "../db.php";
 
$sql = "
SELECT b.*, c.full_name AS client_name, s.service_name
FROM bookings b
JOIN clients c ON b.client_id = c.client_id
JOIN services s ON b.service_id = s.service_id
ORDER BY b.booking_id DESC
";
$result = mysqli_query($conn, $sql);
?>
<!doctype html>
<html>
<head><meta charset="utf-8"><title>Bookings</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
<body>
<?php include "../nav.php"; ?>
<div class="container p-5 card" style="max-width: 1000px; margin-top: 100px; max-height: 640px;">
    <h2 class="pb-4">Bookings</h2>
    <table border="1" cellpadding="8" class="table table-striped">
    <tr>
        <th>ID</th><th>Client</th><th>Service</th><th>Date</th><th>Hours</th><th>Total</th><th>Status</th><th>Action</th>
    </tr>
    <?php while($b = mysqli_fetch_assoc($result)) { ?>
        <tr>
        <td><?php echo $b['booking_id']; ?></td>
        <td><?php echo $b['client_name']; ?></td>
        <td><?php echo $b['service_name']; ?></td>
        <td><?php echo $b['booking_date']; ?></td>
        <td><?php echo $b['hours']; ?></td>
        <td>₱<?php echo number_format($b['total_cost'],2); ?></td>
        <td><?php echo $b['status']; ?></td>
        <td class="text-center">
            <a href="payment_process.php?booking_id=<?php echo $b['booking_id']; ?>" class="btn btn-sm btn-success">Process Payment</a>
        </td>
        </tr>
    <?php } ?>
    </table>
    <div class="text-end pt-4">
        <button class="btn btn-primary" onclick="window.location.href='bookings_create.php'">Create Booking</button>
    </div>
</div>
</body>
</html>