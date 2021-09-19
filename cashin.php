<?php include "connect.php"?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <title>Paddy App</title>
</head>
<body>
    <!-- navvar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="index.php">Padday App</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link" href="index.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" " href="cashin.php">Cash In</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="transaction.php">New Transaction</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="paid.php">Paid</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="register.php">Register New Customer</a>
        </li>

        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Report
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item" href="cash.php">Cash In List</a></li>
            <li><a class="dropdown-item" href="customer.php">All Customer List</a></li>
          </ul>
        </li>
      </ul>
      <form action="search.php" method="POST" class="d-flex">
        <input class="form-control me-2" type="text" name="moba" placeholder="Mobile..">
        <button class="btn btn-outline-success" name="submit" type="submit">Search</button>
      </form>
    </div>
  </div>
</nav>
<!-- Page content -->
<br>
<div class="container">
<div class="">
      <?php
      if (isset($_POST['submit'])) {
        $dis = $_POST['disp'];
        $amount = $_POST['amount'];

        $query = "INSERT INTO `cashin` (`disp`, `amount`) VALUES ('$dis', '$amount');";

      if (mysqli_query($connection, $query)) {
        echo "<p style='color:crimson;'>Inserted Successfully</p><br>";
      } else {
        echo "Error: " . $query . "<br>" . mysqli_error($connection);
      }
      }

      ?>
    </div>
  <h2 style="text-align: center;">New Cash In Information</h2>
<form action="" method="POST">
  <div class="row mb-3">
    <label for="inputEmail3" class="col-sm-2 col-form-label">Discription</label>
    <div class="col-sm-10">
      <input type="text" name="disp" placeholder="About Cash.." class="form-control" id="inputEmail3" required>
    </div>
  </div>
  <div class="row mb-3">
    <label for="inputPassword3" class="col-sm-2 col-form-label">Amount</label>
    <div class="col-sm-10">
      <input type="text" name="amount" placeholder="Cash In Amount.." class="form-control" id="inputPassword3" onkeypress="return onlyNumberKey(event)" required>
    </div>
  </div>
  <button type="submit" name="submit" class="btn btn-primary">Cash In</button>
</form>
</div>


<script src="js/bootstrap.bundle.min.js"></script>
<script src="js/scripts.js"></script>
</body>
</html>