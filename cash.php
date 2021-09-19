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
          <a class="nav-link active" aria-current="page" href="index.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="cashin.php">Cash In</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="transaction.php">New Transaction</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="paid.php"> Paid </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="register.php">Register New Customer</a>
        </li>

        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle active" aria-current="page"  href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
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
<!-- Last Transaction -->
<div class="container">
    <div class="row align-items-start">
        <div class="col">
        <h1 style="text-align: center;">All Cash In List</h1>
        <div style="overflow-x:auto;">
            <table class="table table-hover">
            <tr>
                    <th>Serial</th>
                    <th>Discription</th>
                    <th>Amount</th>
                    <th>Time</th>
                </tr>
                <?php
                    $sql ="SELECT * FROM `cashin` ORDER BY sl";
                    $query =mysqli_query($connection, $sql);
                    while ($row=mysqli_fetch_array($query)) {
                        echo "<tr>
                                <td>".$row["sl"]."</td>
                                <td>".$row["disp"]."</td>
                                <td>".$row["amount"]."</td>
                                <td>".$row["time"]."</td>
                            </tr>";
                    }
                ?>
            </table>
        </div>
        </div>
        <div class="col">
        <div class="summary">
        <h1 style="text-align: center;">Summery</h1><br>
            <?php
            $sql = "SELECT SUM(`amount`) as total FROM cashin ";
            $query = mysqli_query($connection, $sql);
            $row = mysqli_fetch_array($query);
            $totalCash = $row['total'];
            echo "<div style='text-align: center;'>";
            echo " <h4> Total Cash In :  " . $totalCash."</h4>";
            ?>
        </div>
        </div>

    </div>
</div>

<script src="js/bootstrap.bundle.min.js"></script>
</body>
</html>