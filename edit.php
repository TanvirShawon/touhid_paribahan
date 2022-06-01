<?php
  require_once('db.php');
  $upload_dir = 'uploads/';

  if (isset($_GET['car_no'])) {

    $car_no = $_GET['car_no'];

    $sql = "select * from new_car_info where car_no= '".$car_no."' ";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
      $row = mysqli_fetch_assoc($result);
    }else {
      $errorMsg = 'Could not Find Any Record';
    }
  }

  if(isset($_POST['Submit'])){
    $car_name = $_POST['car_name'];
    $car_no = $_POST['car_no'];
    $price = $_POST['price'];
    $date = $_POST['date'];


    $imgName = $_FILES['car_photo']['name'];
		$imgTmp = $_FILES['car_photo']['tmp_name'];
		$imgSize = $_FILES['car_photo']['size'];

		if($imgName){

			$imgExt = strtolower(pathinfo($imgName, PATHINFO_EXTENSION));

			$allowExt  = array('jpeg', 'jpg', 'png', 'gif');

			$userPic = time().'_'.rand(1000,9999).'.'.$imgExt;

			if(in_array($imgExt, $allowExt)){

				if($imgSize < 5000000){
					unlink($upload_dir.$row['car_photo']);
					move_uploaded_file($imgTmp ,$upload_dir.$userPic);
				}else{
					$errorMsg = 'Image too large';
				}
			}else{
				$errorMsg = 'Please select a valid image';
			}
		}else{

			$userPic = $row['image'];
		}

		if(!isset($errorMsg)){
			$sql = "update new_car_info set car_name = '".$car_name."',	car_no = '".$car_no."',  price = '".$price."', date = '".$date."',	car_photo = '".$userPic."'
					where car_no= '".$car_no."'";
			$result = mysqli_query($conn, $sql);
			if($result){
				$successMsg = 'New record updated successfully';
				header('Location:new_car_list.php');
			}else{
				$errorMsg = 'Error '.mysqli_error($conn);
			}
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

            <h2><?php
            if(!empty($_GET['message'])) {
            $message = $_GET['message'];
             echo '<p class="message"> '.$message.'</p>';
            }
             ?></h2>
              <div class="container mt-4">
                <div class="row justify-content-center">
                  <div class="col-md-6">
                    <div class="card">

                      <div class="card-body">
                        <form class="" action="" method="post" enctype="multipart/form-data">
                            <div class="form-group">
                              <label for="name">Car Name</label>
                              <input type="text" class="form-control" name="car_name"  value="<?php echo $row['car_name'] ?>">
                            </div>
                            <div class="form-group">
                              <label for="number">Car No:</label>
                              <input type="text" class="form-control" name="car_no" placeholder="Enter Car Number" readonly value="<?php echo $car_no; ?>">
                            </div>
                            <div class="form-group">
                              <label for="price">Price</label>
                              <input type="text" class="form-control" name="price" placeholder="Price" value="<?php echo $row['price'] ?>">
                            </div>
                            <div class="form-group">
                              <label for="date">Buying Date</label>
                              <input type="Date" class="form-control" name="date" placeholder="Buying Date" value="<?php echo $row['date'] ?>">
                            </div>
                            <div class="form-group">
                              <label for="image">Choose Car Image</label>
                              <input type="file" class="form-control" name="car_photo" value="" required>
                            </div>


                            <div class="form-group">
                              <button type="submit" name="Submit" class="btn btn-primary waves">Submit</button>
                            </div>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>



        </div>
        <!-- /#page-content-wrapper -->
        </div>




















        <!-- /#sidebar-wrapper -->

        <!-- Page Content -->







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
