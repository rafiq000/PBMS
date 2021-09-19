<?php
include "connect.php";
if(isset($_GET['moba'])){
  $moba_get=$_GET['moba'];
}
 ?>

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
          <a class="nav-link" href="cashin.php">Cash In</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="transaction.php">New Transaction</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="paid.php">Paid</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="register.php">Register New Customer</a>
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

<div class="container">
  <br>
  <div>
  <?php
       if(isset($_POST['submit'])) {
        $moba = $_POST['moba'];
        $name = $_POST['name'];
        $addr = $_POST['addr'];
        $sql = "SELECT * FROM customer where mobile = '$moba';";
        $row = mysqli_query($connection,$sql);
        if (mysqli_num_rows($row)==0) {
            $query = "INSERT INTO `customer` (`name`, `mobile`, `address`)
                  VALUES ('$name', '$moba', '$addr');";
            if (mysqli_query($connection, $query)) {
                 echo "<p style='color:crimson;'>New Customer created Successfully</p>";
              } else {
                  echo "Error: " . $sql . "<br>" . mysqli_error($conn);
              }
        }else{
            echo "<h4 style='color:crimson;'>Customer Alreday Exist!</h4>";
        }
      }
        ?>
  </div>
<h2 style="text-align: center;">Register A New Customer</h2>
<form action="" method="POST">
  <div class="row mb-3">
    <label for="inputEmail3" class="col-sm-2 col-form-label">Name</label>
    <div class="col-sm-10">
      <input type="text" name="name" placeholder="Customer Name" class="form-control" id="inputEmail3" required>
    </div>
  </div>
  <div class="row mb-3">
    <label for="inputEmail3" class="col-sm-2 col-form-label">Mobile</label>
    <div class="col-sm-10">
      <input type="text" name="moba" value="<?php if(isset($moba_get)){ echo $moba_get;} ;?>" placeholder="Customer Mobile Number" class="form-control" id="inputEmail3" onkeypress="return onlyNumberKey(event)" required>
    </div>
  </div>
  <div class="row mb-3">
    <label for="inputPassword3" class="col-sm-2 col-form-label">Address</label>
    <div class="col-sm-10">
      <input type="text" name="addr" placeholder="Customer Address" class="form-control" id="inputPassword3"  required>
    </div>
  </div>
  <button type="submit" name="submit" class="btn btn-primary">Register</button>
</form>
</div>
</div>
<!-- JS -->
<script src="js/scripts.js"></script>


<script src="js/bootstrap.bundle.min.js"></script>
</body>
</html>