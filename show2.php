<?php
      require_once('db.php');
      session_start();
      if (isset($_GET['car_no'])) {


        $car_no = $_GET['car_no'];

      $upload_dir = 'uploads/';



      $sqls = "select car_no from new_car_info where car_no= '".$car_no."' ";
      $results = mysqli_query($conn, $sqls);
      if (mysqli_num_rows($results) > 0) {
        $row = mysqli_fetch_assoc($results);
      }else {
        header("Location: installment_index.php?message=No record found!");
      }


      $sql = "select * from ".$car_no." where status= 'sold' ";
      $result = mysqli_query($conn, $sql);
      if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
      }else {
        $errorMsg = 'Could not Find Any Record';
      }
    }
    else if (isset($_GET['car_no'])) {
      $car_no = $_GET['car_no'];
      $sql = "select * from ".$car_no." where status= 'sold' ";

      $result = mysqli_query($conn, $sql);
      if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
      }else {
        $errorMsg = 'Could not Find Any Record';
      }
    }

    else if($_GET) {
      $car_no= $_GET['car_no'];
      $sql = "select * from ".$car_no." where status= 'sold' ";

      $result = mysqli_query($conn, $sql);
      if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
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
                             <a href="installment_index.php" class="list-group-item list-group-item-action bg-transparent second-text active"><i
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
                     <!-- /#sidebar-wrapper -->

                     <!-- Page Content -->



                     <div class="container mt-3 mb-3">
                       <div class="row justify-content-center">
                         <div class="col-md-6">
                           <div class="card">
                             <div class="card-header">
                               Enter Details
                             </div>
                             <div class="card-body bg-light">
                                <form class="text-left text-light" action="installment_add.php" method="POST">

                                    <div class="form-group">
                                      <label class="text-dark">Cash Received</label>
                                      <input name="cash_received" type="number" class="form-control">
                                    </div>

                                    <div class="form-group">
                                      <label class="text-dark">Date</label>
                                      <input name="date_inst" type="date" class="form-control">
                                    </div>

                                    <input type="hidden" name="car_no" value="<?php echo $car_no; ?>">

                                    <div class="form-group">
                                      <button type="submit"  name="Submit" class="btn btn-info">Submit</button>
                                      </div>
                                  </form>

                              </div>
                              </div>
                              </div>
                              </div>
    <br>

                              <div class="container mb-3">
                                <div class="row justify-content-center">
                                    <div class="col-md-9">
                                        <div class="card">
                                            <div class="card-header">Details</div>
                                              <div class="card-body">

                              <table id="example" class="table table-striped table-bordered" style="width:100%">

                                <thead>
                                  <th>
                                    Sell Details

                                  </th>
                                  <th>
                                 Customer Details

                                  </th>




                                </thead>


                                <tbody>
                                  <td>
                                    <b>Sold Price: <?php echo $row['sprice'] ?></b>
                                    <br>
                                    <b>Installment Amount: <?php echo $row['iprice'] ?></b>
                                    <br>
                                    <b>First Installment: <?php echo $row['fprice'] ?></b>

                                  </td>

                                  <td>

                                    <?php

                                    $query= "select * FROM customer_details where car_no= '".$car_no."' ";
                                    $query_result = mysqli_query ($conn, $query);

                                    while ($row = mysqli_fetch_assoc($query_result)){

                                    ?>



                                    <b>Name: <?php echo $row['name'] ?></b>
                                    <br>
                                    <b>Father's Name: <?php echo $row['fname'] ?></b>
                                    <br>
                                    <b>Address: <?php echo $row['address'] ?></b>
                                    <br>
                                    <b>NID: <?php echo $row['nid'] ?></b>
                                    <br>
                                    <b>Mobile: <?php echo $row['mobile'] ?></b>
                                    <br>
                                    <b>Car No: <?php echo $row['car_no'] ?></b>
                                    <br>
                                    <b>Sell Date: <?php echo $row['date'] ?></b>




                                    <?php } ?>
                                  </td>
                                </tbody>

                                </table>
                              </div>
                          </div>
                      </div>
                     </div>
                     </div>


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
                                     <th>Installment Date</th>
                                     <th>Cash Received</th>
                                     <th>Previous Due</th>
                                     <th>Total Previous Due</th>
                                     <th>Total due</th>
                                     <th>Next Date</th>

                                   </tr>
                               </thead>
                               <tfoot>
                                 <tr>
                                   <th>ID</th>
                                   <th>Installment Date</th>
                                   <th>Cash Received</th>
                                   <th>Previous Due</th>
                                   <th>Total Previous Due</th>
                                   <th>Total due</th>
                                   <th>Next Date</th>

                                 </tr>
                               </tfoot>
                               <tbody>
                                 <?php
                                   include_once('db.php');
                                   $sql = "select * from ".$car_no." where status= 'sold' ";
                                   $sl=0;
                                   //use for MySQLi-OOP
                                   $query = $conn->query($sql);
                                   while($row = $query->fetch_assoc()){
                                     $sl++;
                                     ?>
                                     <tr>
                                       <td><?php echo $sl; ?></td>
                                       <td><?php echo $row['date_inst'] ?></td>
                                       <td><?php echo $row['cash_received'] ?></td>
                                       <td><?php echo $row['due'] ?></td>
                                       <td><?php echo $row['due_sum'] ?></td>
                                       <td><?php echo $row['total_due'] ?></td>
                                       <td><?php echo $row['next_date'] ?></td>
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


            <div class="col-md-12 text-center mb-4">


      <a href="delete_car.php?delete=<?php echo $car_no ?>"  onclick="return confirm('Are you sure to delete this record?')"><button type="button"  class="btn btn-danger  btn-lg"  name="delete">Delete</button></a>
            </div>


                 <!-- /#page-content-wrapper -->
                 </div>

             </body>

             </html>
