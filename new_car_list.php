<?php
include('db.php');
$upload_dir = 'uploads/';
session_start();

if(isset($_POST['search']))
{
    $valueToSearch = $_POST['valueToSearch'];

    $query = "SELECT * FROM new_car_info WHERE status='unsold' AND CONCAT(`id`, `car_name`, `car_no`, `price`) LIKE '%".$valueToSearch."%'";
    $search_result = filterTable($query);

}
 else {
    $query = "SELECT * FROM new_car_info WHERE status='unsold' ";
    $search_result = filterTable($query);
}


function filterTable($query)
{
    include('db.php');
    $filter_Result = mysqli_query($conn, $query);
    return $filter_Result;
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
                <a href="new_car_list.php" class="list-group-item list-group-item-action bg-transparent second-text active"><i
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






            <div class="container">

              <div class="row justify-content-center">
                <div class="col-sm-10 col-sm-offset-2">
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
                    <form action="" method="post">



                      <div class="input-group mb-3 d-flex justify-content-end">
                        <input class="form-control col-md-3" type="text" name="valueToSearch" placeholder="Value To Search">
                        <div class="input-group-append">
                          <button type="submit" name="search" class="btn btn-primary">Search</button>
                        </div>
                      </div>







                                <!-- <input  type="submit" name="search" value="Search"><br><br> -->

                                <table class="table table-bordered table-striped mt-3">
                                  <thead>
                                    <th>ID</th>
                                    <th>Image</th>
                                    <th>Car Name</th>
                                    <th>Car No.</th>
                                    <th>Price</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                  </thead>
                                  <tfoot>
                                    <tr>
                                      <th>ID</th>
                                      <th>Image</th>
                                      <th>Car Name</th>
                                      <th>Car No.</th>
                                      <th>Price</th>
                                      <th>Status</th>
                                      <th>Actions</th>
                                    </tr>
                                  </tfoot>

                          <!-- populate table from mysql database -->
                                    <?php

                                    while($row = mysqli_fetch_array($search_result)):

                                      ?>
                                      <tr>
                                        <td><?php echo $row['id'] ?></td>
                                        <td><img src="<?php echo $upload_dir.$row['car_photo'] ?>" height="40"></td>
                                        <td><?php echo $row['car_name'] ?></td>
                                        <td><?php echo $row['car_no'] ?></td>
                                        <td><?php echo $row['price'] ?></td>

                                        <td><a href="<?php echo $statusLink; ?>" title="<?php echo $statusTooltip; ?>">
                                          <span class="badge <?php echo ($row['status'] == 'sold')?'badge-success':'badge-danger'; ?>">
                                            <?php echo ($row['status'] == 'sold')?'sold':'unsold'; ?></span></a></td>


                                        <td class="text-center">
                                          <a href="show.php?id=<?php echo $row['id'] ?>" class="btn btn-success"><i class="fa fa-eye"></i></a>
                                          <a href="edit.php?car_no=<?php echo $row['car_no'] ?>" class="btn btn-info"><i class="fa fa-user-edit"></i></a>
                                          <a href="delete_new_car_list.php?delete=<?php echo $row['car_no'] ?>" class="btn btn-danger" onclick="return confirm('Are you sure to delete this record?')"><i class="fa fa-trash-alt"></i></a>
                                          <a href="sell_details.php?id=<?php echo $row['id'] ?>" class="badge text-dark 'badge-danger'">Mark Sold</a >
                                        </td>
                                      </tr>
                                    <?php endwhile;?>
                                </table>
                            </form>


                  </div>
                </div>
              </div>
            </div>


                </div>

                </div>


            </div>

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
