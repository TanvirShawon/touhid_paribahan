<?php

require_once('db.php');

session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
}

 ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <link rel="stylesheet" href="styles.css" />
    <title>Touhid Paribahan</title>

</head>

<body>
    <div class="d-flex" id="wrapper">
        <!-- Sidebar -->
        <div class="bg-white" id="sidebar-wrapper">
          <a href="index.php" class="text-decoration-none"><div class="sidebar-heading text-center py-4 primary-text fs-4 fw-bold text-uppercase border-bottom"><i
                  class="fas "></i>Touhid Paribahan</div></a>
            <div class="list-group list-group-flush my-3">
                <a href="create.php" class="list-group-item list-group-item-action bg-transparent second-text fw-bold"><i
                        class="fas fa-tachometer-alt me-2"></i>Add New Car</a>
                <a href="new_car_list.php" class="list-group-item list-group-item-action bg-transparent second-text fw-bold"><i
                                class="fas fa-project-diagram me-2"></i>New Car List</a>
                <a href="sold_car_list.php" class="list-group-item list-group-item-action bg-transparent second-text fw-bold"><i
                        class="fas fa-chart-line me-2"></i>Sold Car List</a>
                <a href="daily_expense.php" class="list-group-item list-group-item-action bg-transparent second-text fw-bold"><i
                        class="fas fa-paperclip me-2"></i>Daily Expense</a>
                <a href="installment_index.php" class="list-group-item list-group-item-action bg-transparent second-text fw-bold"><i
                        class="fas fa-shopping-cart me-2"></i>Installemnt</a>
                <a href="installment_date.php" class="list-group-item list-group-item-action bg-transparent second-text fw-bold"><i
                        class="fas fa-gift me-2"></i>Installment Date</a>
                <a href="monthly.php" class="list-group-item list-group-item-action bg-transparent second-text fw-bold"><i
                                class="fas fa-map-marker-alt me-2"></i>Monthly Account</a>
                <a href="yearly.php" class="list-group-item list-group-item-action bg-transparent second-text fw-bold"><i
                        class="fas fa-comment-dots me-2"></i>Yearly Account</a>

                <a href="logout.php" class="list-group-item list-group-item-action bg-transparent text-danger fw-bold"><i
                        class="fas fa-power-off me-2"></i>Logout</a>
            </div>
        </div>
        <!-- /#sidebar-wrapper -->

        <!-- Page Content -->
        <div id="page-content-wrapper">
            <nav class="navbar navbar-expand-lg navbar-light bg-transparent py-4 px-4">
                <div class="d-flex align-items-center">
                    <i class="fas fa-align-left primary-text fs-4 me-3" id="menu-toggle"></i>
                    <h2 class="fs-2 m-0">Dashboard</h2>




                </div>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle second-text fw-bold" href="#" id="navbarDropdown"
                                role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-user me-2"></i>Admin
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">

                                <li><a class="dropdown-item" href="logout.php">Logout</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>

            <div class="container-fluid px-4">
                <div class="row g-3 my-2">
                    <div class="col-md-4">
                        <div class="p-3 bg-white shadow-sm d-flex justify-content-around align-items-center rounded">
                            <div>
                                <h3 class="fs-2"><?php

                                    $sql = "SELECT * FROM new_car_info where status='sold'";
                                    if ($result=mysqli_query($conn,$sql)) {
                                      $rowcount=mysqli_num_rows($result);
                                      echo $rowcount;
                                    }

                                 ?></h3>
                                <p class="fs-5">Sold Products</p>
                            </div>
                            <i class="fas fa-truck fs-1 primary-text border rounded-full secondary-bg p-3"></i>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="p-3 bg-white shadow-sm d-flex justify-content-around align-items-center rounded">
                            <div>
                                <h3 class="fs-2">
                                  <?php
                                  $month= date('M');
                                  $year= date('Y');

                                  $query_due_sum= "select SUM(sprice) AS sum FROM customer_details";
                                  $query_result = mysqli_query ($conn, $query_due_sum);

                                  while ($row = mysqli_fetch_assoc($query_result)){
                                    $due_sum = $row['sum'];
                                  }

                                  echo $due_sum;

                                    ?>
                                  </h3>
                                <p class="fs-5">Sales</p>
                            </div>
                            <i class="fas fa-hand-holding-usd fs-1 primary-text border rounded-full secondary-bg p-3"></i>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="p-3 bg-white shadow-sm d-flex justify-content-around align-items-center rounded">
                            <div>
                                <h3 class="fs-2">

                                  <?php
                                  $total_profit = 0;
                                  $query= "select car_no from new_car_info";
                                  $query_result = mysqli_query ($conn, $query);

                                  while ($row = mysqli_fetch_assoc($query_result)){

                                    $car_no= $row['car_no'];


                                    $query_total_profit= "select SUM(cash_received) AS sum FROM ".$car_no." ";
                                    $query_result1 = mysqli_query ($conn, $query_total_profit);

                                    while ($row = mysqli_fetch_assoc($query_result1)){
                                      $total_profit = $row['sum'] + $total_profit;
                                    }


                                  }
                                  echo $total_profit;

                                   ?>

                                </h3>
                                <p class="fs-5">Received</p>
                            </div>
                            <i class="fas fa-hand-holding-usd fs-1 primary-text border rounded-full secondary-bg p-3"></i>
                        </div>
                    </div>


                </div>

                <div class="row g-3 my-2">
                  <div class="col-md-4">
                      <div class="p-3 bg-white shadow-sm d-flex justify-content-around align-items-center rounded">
                          <div>
                              <h3 class="fs-2"><?php

                                  $sql = "SELECT * FROM new_car_info where status='unsold'";
                                  if ($result=mysqli_query($conn,$sql)) {
                                    $rowcount=mysqli_num_rows($result);
                                    echo $rowcount;
                                  }

                               ?></h3>
                              <p class="fs-5">Unsold Products</p>
                          </div>
                          <i class="fas fa-gift fs-1 primary-text border rounded-full secondary-bg p-3"></i>
                      </div>
                  </div>

                  <div class="col-md-4">
                      <div class="p-3 bg-white shadow-sm d-flex justify-content-around align-items-center rounded">
                          <div>
                              <h3 class="fs-2"><?php


                                  $query= "select SUM(price) AS sum FROM new_car_info where status='unsold'";
                                  $query_result = mysqli_query ($conn, $query);

                                  while ($row = mysqli_fetch_assoc($query_result)){
                                    $dsum = $row['sum'];
                                  }

                                  echo $dsum;

                               ?></h3>
                              <p class="fs-5">Amount</p>
                          </div>
                          <i class="fas fa-hand-holding-usd fs-1 primary-text border rounded-full secondary-bg p-3"></i>
                      </div>
                  </div>

                  <div class="col-md-4">
                      <div class="p-3 bg-white shadow-sm d-flex justify-content-around align-items-center rounded">
                          <div>
                              <h3 class="fs-2"><?php
                              $total_profit = 0;
                              $query= "select car_no from new_car_info";
                              $query_result = mysqli_query ($conn, $query);

                              while ($row = mysqli_fetch_assoc($query_result)){

                                $car_no= $row['car_no'];


                                $query_total_profit= "select SUM(profit) AS sum FROM ".$car_no." ";
                                $query_result1 = mysqli_query ($conn, $query_total_profit);

                                while ($row = mysqli_fetch_assoc($query_result1)){
                                  $total_profit = $row['sum'] + $total_profit;
                                }


                              }
                            echo $total_profit;

                               ?></h3>
                              <p class="fs-5">Profit/Loss</p>
                          </div>
                          <i class="fas fa-chart-line fs-1 primary-text border rounded-full secondary-bg p-3"></i>
                      </div>
                  </div>
                </div>







    </div>
    <!-- /#page-content-wrapper -->
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        var el = document.getElementById("wrapper");
        var toggleButton = document.getElementById("menu-toggle");

        toggleButton.onclick = function () {
            el.classList.toggle("toggled");
        };
    </script>
</body>

</html>
