<?php
  require_once('db.php');
  $upload_dir = 'uploads/';

  if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "select * from new_car_info where id=".$id;
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
                           class="fas "></i>Touhid Enterprise</div></a>
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
                         <a href="#" class="list-group-item list-group-item-action bg-transparent second-text fw-bold"><i
                                 class="fas fa-comment-dots me-2"></i>Chat</a>
                         <a href="#" class="list-group-item list-group-item-action bg-transparent second-text fw-bold"><i
                                 class="fas fa-map-marker-alt me-2"></i>Outlet</a>
                         <a href="#" class="list-group-item list-group-item-action bg-transparent text-danger fw-bold"><i
                                 class="fas fa-power-off me-2"></i>Logout</a>
                     </div>
                 </div>
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
                            <form class="text-left text-light" action="seller_details_add.php" method="POST">
                                <div class="form-group">
                                  <label class="text-dark">Name</label>
                                  <input name="cname" type="text" class="form-control" required>
                                </div>

                                <div class="form-group">
                                  <label class="text-dark">Father's Name</label>
                                  <input name="fname" type="text" class="form-control">
                                </div>

                                <div class="form-group">
                                  <label class="text-dark">Address</label>
                                  <input name="address" type="text" class="form-control">
                                </div>

                                <div class="form-group">
                                  <label class="text-dark">National ID</label>
                                  <input name="nid" type="text" class="form-control">
                                </div>

                                <div class="form-group">
                                  <label class="text-dark">Mobile No</label>
                                  <input name="mobile" type="text" class="form-control" required>
                                </div>

                                <div class="form-group">
                                  <label class="text-dark">Total Selling Price</label>
                                  <input name="sprice" type="text" class="form-control" required>
                                </div>

                                <div class="form-group">
                                  <label class="text-dark">Per Installment Amount</label>
                                  <input name="iprice" type="text" class="form-control" required>
                                </div>

                                <div class="form-group">
                                  <label class="text-dark">1st Installment Amount</label>
                                  <input name="fprice" type="text" class="form-control" required>
                                </div>

                                <div class="form-group">
                                  <label class="text-dark">Installment Date</label>
                                  <input name="date" type="date" class="form-control" required>
                                </div>

                                <input type="hidden" name="car_no" value="<?php
                                 echo $row['car_no'];
                                ?>">



                                  <input type="hidden" name="images" value="" placeholder="" class="form-control">

                                  <div class="form-group">
                                    <label class="text-dark">Remark</label>
                                    <input name="remark" type="text" class="form-control">
                                  </div>

                                <div class="form-group">
                                  <button type="submit"  name="Submit" class="btn btn-info">Submit</button>
                                  </div>


                              </form>

                          </div>
                          </div>
                          </div>
                          </div>
                          </div>




             </div>
             <!-- /#page-content-wrapper -->
             </div>

         </body>

         </html>
