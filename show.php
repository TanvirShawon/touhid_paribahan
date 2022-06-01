<?php
  require_once('db.php');
  session_start();
  $upload_dir = 'uploads/';

  if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "select * from new_car_info where id=".$id;
    $result = mysqli_query($conn, $sql);



    if (mysqli_num_rows($result) > 0) {
      $row = mysqli_fetch_assoc($result);
        $car_no=  $row['car_no'];
    }else {
      $errorMsg = 'Could not Find Any Record';
    }
  }


  if (isset($_GET['car_no'])) {
    $car_no = $_GET['car_no'];
    $sql = "select * from new_car_info where car_no= '".$car_no."'";
    $result = mysqli_query($conn, $sql);



    if (mysqli_num_rows($result) > 0) {
      $row = mysqli_fetch_assoc($result);
        $car_no=  $row['car_no'];
    }else {
      $errorMsg = 'Could not Find Any Record';
    }
  }

?>



<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css">

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" />


  <link rel="stylesheet" type="text/css" href="datatable/dataTable.bootstrap.min.css">
  <style>
    .height10{
      height:10px;
    }
    .mtop10{
      margin-top:10px;
    }
    .modal-label{
      position:relative;
      top:7px
    }
  </style>



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





                </div>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>


            </nav>
        <!-- /#sidebar-wrapper -->

        <!-- Page Content -->




        <div class="container mt-4">
          <div class="row justify-content-center">
            <div class="col-md-6 card">
              <div class="card-header">
                Details
              </div>
              <div class="card-body">
                <div class="row">
                  <div class="col-md">
                      <img src="<?php echo $upload_dir.$row['car_photo'] ?>" height="200">
                  </div>
                  <div class="col-md">
                      <h5 class="form-control"><i class="fa">
                        <span><?php echo $row['car_name'] ?></span>
                      </i></h5>
                      <h5 class="form-control"><i class="fa">
                        <span><?php echo $row['car_no'] ?></span>
                      </i></h5>
                      <h5 class="form-control"><i class="fa">
                        <span><?php echo $row['price'] ?></span>
                      </i></h5>
                      <h5 class="form-control"><i class="fa">
                        <span><?php echo $row['date'] ?></span>
                      </i></h5>

                        <a class="btn btn-outline-danger" href="index.php"><i class="fa fa-sign-out-alt"></i><span>Back</span></a>

                  </div>
                </div>
              </div>

            </div>

            <div class="col-md-2">
                <a href="imageupload.php?car_no=<?php echo $row['car_no'] ?>" class="btn btn-info">Car Papers</a>
            </div>
          </div>




      <br>



      <div class="container">

        <div class="row justify-content-center">
          <div class="col-sm-8 col-sm-offset-2">
            <div class="row">
            <?php
              if(isset($_SESSION['error'])){
                echo
                "
                <div class='alert alert-danger text-center'>
                  <button class='close'>&times;</button>
                  ".$_SESSION['error']."
                </div>
                ";
                unset($_SESSION['error']);
              }
              if(isset($_SESSION['success'])){
                echo
                "
                <div class='alert alert-success text-center'>
                  <button class='close'>&times;</button>
                  ".$_SESSION['success']."
                </div>
                ";
                unset($_SESSION['success']);
              }
            ?>
            </div>

            <div class="height10">
            </div>
            <div class="row">
              <table id="myTable" class="table table-bordered table-striped">
                <thead>
                    <tr>
                      <th>ID</th>
                      <th>Date</th>
                      <th>Expense</th>
                      <th>Earn</th>
                      <th>Profit</th>
                      <th>Total Profit</th>
                      <th>Remark</th>


                    </tr>
                </thead>
                <tfoot>
                  <tr>
                    <th>ID</th>
                    <th>Date</th>
                    <th>Expense</th>
                    <th>Earn</th>
                    <th>Profit</th>
                    <th>Total Profit</th>
                    <th>Remark</th>

                  </tr>
                </tfoot>
                <tbody>
                  <?php
                    include_once('db.php');
                    $sql = "select * from ".$car_no." where status= 'unsold' ";
                    $sl=0;
                    //use for MySQLi-OOP
                    $query = $conn->query($sql);
                    while($row = $query->fetch_assoc()){
                      $sl++;
                      ?>
                      <tr>
                          <td><?php echo $sl; ?></td>
                          <td><?php echo $row['date'] ?></td>
                          <td><?php echo $row['expense'] ?></td>
                          <td><?php echo $row['earn'] ?></td>
                          <td><?php echo $row['profit'] ?></td>
                          <td><?php echo $row['total_profit'] ?></td>
                          <td><?php echo $row['remark'] ?></td>

                      </tr>
                      <?php
                          }

                      ?>



                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>







                </div>
                <!-- /#page-content-wrapper -->
                </div>


            </div>
            <!-- /#page-content-wrapper -->
            </div>
            <script>
                var el = document.getElementById("wrapper");
                var toggleButton = document.getElementById("menu-toggle");

                toggleButton.onclick = function () {
                    el.classList.toggle("toggled");
                };
            </script>
        </body>

        </html>
