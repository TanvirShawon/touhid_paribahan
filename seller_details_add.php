<?php
  require_once('db.php');
  $upload_dir = 'uploads/';

  if (isset($_POST['Submit'])) {
    $name = $_POST['cname'];
    $fname = $_POST['fname'];
    $address = $_POST['address'];
    $nid = $_POST['nid'];
    $mobile = $_POST['mobile'];

    $car_no = $_POST['car_no'];

    $sprice = $_POST['sprice'];
    $iprice = $_POST['iprice'];
    $fprice = $_POST['fprice'];
    $date= $_POST['date'];
    $remark= $_POST['remark'];
    $total_due= $sprice - $fprice;


    $dt = strtotime($date);
    $next_date= date("Y-m-d", strtotime("+1 month", $dt));

    $month= date("M", ($dt));

    $year= date("Y", ($dt));


  //  $image = $_FILES['cimage']['name'];
  $image = $_POST['date'];;

    $queries = ["insert into customer_details(name, fname, address, nid, mobile, car_no, sprice, iprice, fprice, date,month, year, image, status)
        values('$name','$fname','$address','$nid','$mobile','$car_no','$sprice','$iprice','$fprice', '$date', '$month', '$year','$image','sold')",

        "insert into ".$car_no."(status, sprice, iprice, fprice, cash_received, date_inst, imonth, iyear, total_due, next_date, iremark)
            values('sold','$sprice','$iprice','$fprice','$fprice', '$date', '$month', '$year' , '$total_due' , '$next_date', '$remark')",

            "insert into installment_date(car_no, date)  values('$car_no' , '$next_date')",

            "UPDATE new_car_info SET status='sold' WHERE car_no= '".$car_no."'"
      ];
      foreach ($queries as $query) {
                  $stmt = $conn->prepare($query);
                  $stmt->execute();
              }


    if($stmt)
    {
  //    move_uploaded_file($_FILES["cimage"]["tmp_name"], "uploads/".$_FILES["cimage"]["name"]);
  //    $_SESSION['status']= "Successful!"
      header('Location: index.php');
    }
    else {
  //    $_SESSION['status']= "Unsuccessful!"
      header('Location: index.php');
    }

  }
?>
