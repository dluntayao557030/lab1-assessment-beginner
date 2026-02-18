<?php
include "db.php";
 
$clients = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS c FROM clients"))['c'];
$services = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS c FROM services"))['c'];
$bookings = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS c FROM bookings"))['c'];
 
$revRow = mysqli_fetch_assoc(mysqli_query($conn, "SELECT IFNULL(SUM(amount_paid),0) AS s FROM payments"));
$revenue = $revRow['s'];
?>

<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title>Dashboard</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
<body>
<?php include "nav.php"; ?>

<section id="kpis" class="section-padding">
    <section style="padding: 50px;"></section>
    <div class="container">
        <h2 class="text-center mb-5 ">Dashboard</h2>
        <div class="row text-center ">
            <div class="col-md-3">
                <div class="card p-4">
                    <h4>Total Clients:</h4>
                    <h1><b><?php echo $clients; ?></b></h1>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card p-4">
                    <h4>Total Services</h4>
                    <h1><b><?php echo $services; ?></b></h1>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card p-4">
                    <h4>Total Bookings</h4>
                   <h1><b><?php echo $bookings; ?></b></h1>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card p-4">
                    <h4>Total Revenue</h4>
                   <h1><b>₱<?php echo number_format($revenue,2); ?></b></h1>
                </div>
            </div>
        </div>
    </div>
</section>

<div class = "container mt-4" style="gap: 25px; display: flex; justify-content: center;">
  <button type="button" class="btn btn-primary" onclick="window.location.href='/assessment_beginner/pages/clients_add.php'"> Add Client</button>
  <button type="button" class="btn btn-primary" onclick="window.location.href='/assessment_beginner/pages/bookings_create.php'">Create Booking</button>
</div>
</body>
</html>