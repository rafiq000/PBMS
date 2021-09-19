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
          <a class="nav-link" href="cashin.php">Cash In</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="transaction.php">New Transaction</a>
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
<div class="container">
  <br>
  <div>
  <?php
       if (isset($_POST['submit'])) {
        $moba = $_POST['moba'];
        $goods_name = $_POST['goods_name'];
        $wight = $_POST['wight'];
        $ty = $_POST['select'];
        $price1 = $_POST['price'];

        $price2 = $price1/$ty; //33.33
        $amount = $price2*$wight;

        $sql = "SELECT * FROM customer where mobile = '$moba';";
        $row = mysqli_query($connection,$sql);

        if(mysqli_num_rows($row)>0){
          $query = "INSERT INTO `transaction` (`mobile`, `goods_name`, `wight`, `price`, `total_amount`)
           VALUES ('$moba', '$goods_name', '$wight', '$price1', '$amount') ;";

          if (mysqli_query($connection, $query)) {
            echo "<p style='color:crimson;'>Transaction Successfull</p>";
             header("location: paid.php?amount=".$amount."&moba=".$moba);
          } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
          }
        }else{
          header("location: register.php?moba=".$moba);
        }
      }

?>
  </div>
<h2 style="text-align: center;">New Transaction</h2>
<form action="" method="POST">
  <div class="row mb-3">
    <label for="inputEmail3" class="col-sm-2 col-form-label">Mobile</label>
    <div class="col-sm-10">
      <input type="text" name="moba" placeholder="Customer Mobile No" class="form-control" id="inputEmail3" onkeypress="return onlyNumberKey(event)" required>
    </div>
  </div>
  <div class="row mb-3">
    <label for="inputEmail3" class="col-sm-2 col-form-label">Goods Name</label>
    <div class="col-sm-10">
      <input type="text" name="goods_name" placeholder="Customer Goods Name" class="form-control" id="inputEmail3"  required>
    </div>
  </div>
  <div class="row mb-3">
    <label for="inputPassword3" class="col-sm-2 col-form-label">Wight</label>
    <div class="col-sm-10">
      <input type="text" name="wight" placeholder="Total Wight" class="form-control" id="inputPassword3" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" required>
    </div>
  </div>

  <div class="row mb-3">
    <label for="inputPassword3" class="col-sm-2 col-form-label">Price Type</label>
    <div class="col-sm-10">
      <select name="select" class="form-select" id="specificSizeSelect">
        <option value="40">In Kg 40 kg = 1 mon</option>
        <option value="37.5">In Bangla 37.5kg = 1 mon</option>
      </select>
    </div>
  </div>

  <div class="row mb-3">
    <label for="inputPassword3" class="col-sm-2 col-form-label">Price</label>
    <div class="col-sm-10">
      <input type="text" name="price" placeholder="Price Per Mon" class="form-control" id="inputPassword3"  oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" required>
    </div>
  </div>
  <button type="submit" name="submit" class="btn btn-primary">Transact</button>
</form>
</div>
</div><h1></h1>
<!-- JS -->
<script src="js/scripts.js"></script>
<script src="js/bootstrap.bundle.min.js"></script>
</body>
</html>