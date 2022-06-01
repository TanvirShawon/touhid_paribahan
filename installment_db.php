<?php
  require_once('db.php');

  if (isset($_POST['Submit'])) {
    $car = 'c';
    $car_no1 = $_POST['car_no'];
    $car_no = $car.$car_no1 ;

  $upload_dir = 'uploads/';


  $sql = "select * from ".$car_no." where status= 'sold' ";
  $result = mysqli_query($conn, $sql);
  if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
  }else {
    $errorMsg = 'Could not Find Any Record';
  }

  if($result)
  {

    header('Location: installment.php');
  }
  else {

    header('Location: installment.php');
  }



}
?>
