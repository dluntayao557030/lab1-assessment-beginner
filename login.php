<?php
session_start();
 
// If already logged in, redirect to index
if (isset($_SESSION['username'])) {
    header("Location: index.php");
    exit();
}
 
$error = "";
 
if ($_SERVER["REQUEST_METHOD"] == "POST") {
 
    $username = $_POST['username'];
    $password = $_POST['password'];
 
    // Static admin login
    if ($username === "admin" && $password === "admin") {
 
        $_SESSION['username'] = "ADMIN";
        header("Location: index.php");
        exit();
 
    } else {
        $error = "Invalid username or password!";
    }
}
?>
 
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Login</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
<body>
 
<div class="container p-5 card" style="max-width: 600px; margin-top: 180px; max-height: 640px;"> 
<h2 class="text-center mb-5">Login Form</h2>
 
<?php if ($error != ""): ?>
    <p class="text-danger text-center"><?php echo $error; ?></p>
<?php endif; ?>
 
<form method="POST">
    <div class="mb-4">
    <label>Username:</label><br>
    <input type="text" name="username" required class="form-control"><br><br>
 
    <label>Password:</label><br>
    <input type="password" name="password" required class="form-control"><br><br>
 
    <button type="submit" class="btn btn-primary" style="width:100%;">Login</button>
    </div>
</form>
</div>
</body>
</html>