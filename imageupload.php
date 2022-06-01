
<?php

 include ('db.conn.php');
session_start();
if (isset($_GET['car_no'])) {
  $car_no = $_GET['car_no'];

}
else if($_GET) {
  $car_no= $_GET['car_no'];

}

 $sql  = "SELECT * FROM images where car_no= '".$car_no."'  ORDER BY id DESC ";

 $stmt = $conn->prepare($sql);
 $stmt->execute();

 $images = $stmt->fetchAll();

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


                 .gallery img{
                          width: 250px;
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

                     <div class="container mt-3 mb-3 ">
                       <div class="row justify-content-center ">
                         <div class="col-md-10  justify-content-center">

                                              <div class="col-md-4 mb-5">
                                                <form class="text-left text-light" method="post" action="upload.php" enctype="multipart/form-data">

                                                    <?php
                                                           if (isset($_GET['error'])) {
                                                            echo "<p class='error'>";
                                                                echo htmlspecialchars($_GET['error']);
                                                            echo "</p>";
                                                           }
                                                    ?>
                                                   <input type="hidden" name="car_no" value="<?php echo $car_no; ?>">

                                                   <div class="form-group">
                                                     <input class="form-control" type="file" name="images[]" multiple>
                                                   </div>
                                                   <div class="form-group">
                                                     <button class="btn btn-info" type="submit" name="upload"> Upload </button>
                                                   </div>



                                                </form>
                                              </div>
                                                   <?php if ($stmt->rowCount() > 0) { ?>
                                                <div class="gallery  mt-6">
                                                  <h4><u>All Images</u></h4>
                                                  <?php foreach ($images as $image) { ?>
                                                     <img class="shadow-1-strong rounded mb-4" src="uploads/<?=$image['img_name']?>">
                                                  <?php } ?>
                                                </div>
                                                <?php } ?>

                              </div>

                              </div>
                              <a class="btn btn-outline-danger" href="show.php?car_no=<?php echo $car_no ?>"<i class="fa fa-sign-out-alt"></i><span>Back</span></a>

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
