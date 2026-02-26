<?php
include "../db.php";
 
$sql = "
SELECT p.*, b.booking_date, c.full_name
FROM payments p
JOIN bookings b ON p.booking_id = b.booking_id
JOIN clients c ON b.client_id = c.client_id
ORDER BY p.payment_id DESC
";
$result = mysqli_query($conn, $sql);
?>
<!doctype html>
<html>
<head><meta charset="utf-8"><title>Payments</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>

<body>
<?php include "../nav.php"; ?>
 
<div class="container p-5 card" style="max-width: 1000px; margin-top: 100px; max-height: 640px;">
    <h2 class="mb-4">Payments</h2>
    <table border="1" cellpadding="8" class="table table-striped">
    <tr>
        <th>ID</th><th>Client</th><th>Booking ID</th><th>Amount</th><th>Method</th><th>Date</th>
    </tr>
    <?php while($p = mysqli_fetch_assoc($result)) { ?>
        <tr>
        <td><?php echo $p['payment_id']; ?></td>
        <td><?php echo $p['full_name']; ?></td>
        <td><?php echo $p['booking_id']; ?></td>
        <td>₱<?php echo number_format($p['amount_paid'],2); ?></td>
        <td><?php echo $p['method']; ?></td>
        <td><?php echo $p['payment_date']; ?></td>
        </tr>
    <?php } ?>
    </table>
</div>
</body>
</html>