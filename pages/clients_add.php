<?php
include "../db.php";
 
$message = "";
 
if (isset($_POST['save'])) {
  $full_name = $_POST['full_name'];
  $email = $_POST['email'];
  $phone = $_POST['phone'];
  $address = $_POST['address'];
 
  if ($full_name == "" || $email == "") {
    $message = "Name and Email are required!";
  } else {
    $sql = "INSERT INTO clients (full_name, email, phone, address)
            VALUES ('$full_name', '$email', '$phone', '$address')";
    mysqli_query($conn, $sql);
    header("Location: clients_list.php");
    exit;
  }
}
?>

<!doctype html>
<html>
<head><meta charset="utf-8"><title>Add Client</title>
 <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
<body>
<?php include "../nav.php"; ?>

<div class="container p-5 mb-5 card" style="max-width: 600px; margin-top: 100px; max-height: 640px;"> 
    <h2 class="text-center">Add Client</h2>
    <p class="text-danger text-center"><?php echo $message; ?></p>
    <form method="post">
        <div class="mb-4">
            <label>Full Name*</label><br>
            <input type="text" name="full_name" class="form-control"><br><br>
            
            <label>Email*</label><br>
            <input type="text" name="email" class="form-control"><br><br>
            
            <label>Phone</label><br>
            <input type="text" name="phone" class="form-control"><br><br>
            
            <label>Address</label><br>
            <input type="text" name="address" class="form-control"><br><br>
            <button class="btn btn-primary" type="submit" name="save" style="width: 100%;">Save</button>
        </div>
    </form>
</div>
</body>
</html>