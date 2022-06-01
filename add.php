<?php
  require_once('db.php');
  $upload_dir = 'uploads/';

  if (isset($_POST['Submit'])) {

    $car_name = $_POST['car_name'];
    $car = 'c';
    $car_no1 = $_POST['car_no'];
    $car_no = $car.$car_no1 ;
    $price = $_POST['price'];
    $date = $_POST['date'];

    $sqls = "select car_no from new_car_info where car_no= '".$car_no."' ";
    $results = mysqli_query($conn, $sqls);
    if (mysqli_num_rows($results) > 0) {
      header("Location: create.php?message=Already Exists!");
    }
    else {



          $dt = strtotime($date);

          $month= date("M", ($dt));

          $year= date("Y", ($dt));

          $imgName = $_FILES['car_photo']['name'];
      		$imgTmp = $_FILES['car_photo']['tmp_name'];
      		$imgSize = $_FILES['car_photo']['size'];

          if(empty($car_name)){
      			$errorMsg = 'Please input car_name';
      		}elseif(empty($car_no)){
      			$errorMsg = 'Please input car_no';
      		}elseif(empty($price)){
      			$errorMsg = 'Please input price';
      		}else{

      			$imgExt = strtolower(pathinfo($imgName, PATHINFO_EXTENSION));
      			$allowExt  = array('jpeg', 'jpg', 'png', 'gif');
      			$userPic = time().'_'.rand(1000,9999).'.'.$imgExt;
      			if(in_array($imgExt, $allowExt)){

      				if($imgSize < 5000000){
      					move_uploaded_file($imgTmp ,$upload_dir.$userPic);
      				}else{
      					$errorMsg = 'car_photo too large';
      				}
      			}else{
      				$errorMsg = 'Please select a valid image';
      			}

      		}

      		if(!isset($errorMsg)){
      			$sql = "insert into new_car_info(car_name, car_no, price, date, month, year, car_photo, status)
      					values('".$car_name."', '".$car_no."', '".$price."', '".$date."', '".$month."', '".$year."', '".$userPic."', 'unsold')";
      			$result = mysqli_query($conn, $sql);

            $sql1 = "CREATE TABLE `$car_no` ( `id` INT(12) NOT NULL AUTO_INCREMENT , `img_name` VARCHAR(255) NOT NULL ,
            `expense` INT(10) NOT NULL , `earn` INT(10) NOT NULL , `profit` INT(10) NOT NULL ,`total_profit` INT(10) NOT NULL ,
             `date` VARCHAR(255) NOT NULL  ,`remark` VARCHAR(255) NOT NULL,`status` VARCHAR(255) NOT NULL ,
             `date_inst` VARCHAR(255) NOT NULL,
             `sprice` INT(10) NOT NULL,`iprice` INT(10) NOT NULL,`fprice` INT(10) NOT NULL,`cash_received` INT(10) NOT NULL,
             `due` INT(10) NOT NULL,
             `due_sum` INT(10) NOT NULL
             ,`total_due` INT(10) NOT NULL
             ,`next_date` VARCHAR(255) NOT NULL ,`month` VARCHAR(255) NOT NULL ,`year` INT(10) NOT NULL,
             `imonth` VARCHAR(255) NOT NULL,`iyear` INT(10) NOT NULL, `iremark` VARCHAR(255) NOT NULL, PRIMARY KEY (`id`)) ENGINE = InnoDB;";

      			$result1 = mysqli_query($conn, $sql1);
      			if($result){


      				$successMsg = 'New record added successfully';
      				header("Location: carpapers.php? car_no=".$car_no."  ");
      			}else{
      				$errorMsg = 'Error '.mysqli_error($conn);
      			}
      		}
    }


  }
?>
