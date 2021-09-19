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
          <a class="nav-link active" aria-current="page" href="index.php">Home</a>
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
  <h1 style="text-align: center;">Detail of 0<?php echo $moba_get;?></h1>
  <div style="text-align: center;">
  <button class="btn btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">Summary</button>
  <div class="collapse" id="collapseExample">
  <div class="card card-body">
    <?php
      $sql = "SELECT SUM(`total_amount`) as total FROM transaction where mobile = '$moba_get';";
      $query = mysqli_query($connection, $sql);
      $row = mysqli_fetch_array($query);
      $res = $row['total'];

      $sql = "SELECT SUM(`amount`) as total FROM paid where mobile = '$moba_get';";
      $query = mysqli_query($connection, $sql);
      $row = mysqli_fetch_array($query);
      $sum_of_paid = $row['total'];

      $unpaid = $res-$sum_of_paid;
      echo " <h4> Total Amount :  " . $res."</h4>";
      echo " <h4> Total Paid Amount :  " . $sum_of_paid."</h4>";
      echo " <h4> Total Un-Paid Amount :  " . $unpaid."</h4>";
    ?>
  </div>
  </div>

</div>
    <div class="row align-items-start">
        <div class="col">
        <h4 style="text-align: center;">Transaction</h4>
        <div style="overflow-x:auto;">
            <table class="table table-hover">
                <tr>
                    <th>Time</th>
                    <th>Goods Name</th>
                    <th>Wight(kg)</th>
                    <th>Price</th>
                    <th>Amount</th>

                </tr>
                <?php
                $sql = "SELECT * FROM `transaction` where mobile = '$moba_get' ORDER BY sl DESC";
                $query = mysqli_query($connection, $sql);
                while ($row=mysqli_fetch_array($query)) {
                  echo "<tr>
                          <td>".$row["time"]."</td>
                          <td>".$row["goods_name"]."</td>
                          <td>0".$row["wight"]."</td>
                          <td>".$row["price"]."</td>
                          <td>".$row["total_amount"]."</td>
                      </tr>";
                }
                ?>
                <tr>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td>Total Amount</td>
                  <td><?php
                    $sql = "SELECT SUM(`total_amount`) as total FROM `transaction` where mobile = '$moba_get' ";
                    $query = mysqli_query($connection, $sql);
                    $row = mysqli_fetch_array($query);
                    $totalCash = $row['total']." TK";
                    echo $totalCash;
                  ?></td>

                </tr>
            </table>
        </div>
        </div>
      <div class="col">
        <h4 style="text-align: center;">Paid List</h4>
        <div style="overflow-x:auto;">
            <table class="table table-hover">
                <tr>
                    <th>Time</th>
                    <th>Medium</th>
                    <th>Amount</th>
                </tr>
                <?php
                $sql = "SELECT * FROM `paid` where mobile = '$moba_get' ORDER BY sl DESC";
                $query = mysqli_query($connection, $sql);
                while ($row=mysqli_fetch_array($query)) {
                  echo "<tr>
                          <td>".$row["time"]."</td>
                          <td>".$row["mideaum"]."</td>
                          <td>".$row["amount"]."</td>
                      </tr>";
                }
                ?>
                <tr>
                <td></td>
                  <td>Total Paid</td>
                  <td><?php
                    $sql = "SELECT SUM(`amount`) as total FROM `paid` where mobile = '$moba_get' ";
                    $query = mysqli_query($connection, $sql);
                    $row = mysqli_fetch_array($query);
                    $paid = $row['total']." TK";
                    echo $totalCash;
                  ?></td>

                </tr>
            </table>
        </div>
        </div>
      </div>

    </div>
</div>

<!-- JS -->
<script src="js/bootstrap.bundle.min.js"></script>
</body>
</html>