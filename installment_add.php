<?php
  require_once('db.php');

  if (isset($_POST['Submit'])) {

    $cash_received = $_POST['cash_received'];
    $date_inst = $_POST['date_inst'];

    $car_no = $_POST['car_no'];
  
    $remark= $_POST['remark'];


    $query_total_due= "select iprice FROM ".$car_no." ORDER BY id DESC LIMIT 1";
    $query_result = mysqli_query ($conn, $query_total_due);

    while ($row = mysqli_fetch_assoc($query_result)){
      $iprice = $row['iprice'];
    }



    $query_sprice= "select sprice FROM ".$car_no."";
    $query_result = mysqli_query ($conn, $query_sprice);

    while ($row = mysqli_fetch_assoc($query_result)){
      $sprice = $row['sprice'];
    }


    $query_sprice= "select fprice FROM ".$car_no."";
    $query_result = mysqli_query ($conn, $query_sprice);

    while ($row = mysqli_fetch_assoc($query_result)){
      $fprice = $row['fprice'];
    }




     $due=  $iprice - $cash_received;

    $query_due_sum= "select SUM(due) AS sum FROM ".$car_no."";
    $query_result = mysqli_query ($conn, $query_due_sum);

    while ($row = mysqli_fetch_assoc($query_result)){
      $due_sum = $row['sum'] + $due;
    }


    $query_total_due= "select total_due FROM ".$car_no." ORDER BY id DESC LIMIT 1";
    $query_result = mysqli_query ($conn, $query_total_due);

    while ($row = mysqli_fetch_assoc($query_result)){
      $total_due = $row['total_due'];
    }



    $query_total_due= "select next_date FROM ".$car_no." ORDER BY id DESC LIMIT 1";
    $query_result = mysqli_query ($conn, $query_total_due);

    while ($row = mysqli_fetch_assoc($query_result)){
      $date = $row['next_date'];
    }

    // echo $date;



     $total_due1 = $total_due - $cash_received;

     $dt = strtotime($date);


     $next_date= date("Y-m-d", strtotime("+1 month", $dt));


     $dtt = strtotime($date_inst);
     $month= date("M", ($dtt));

     $year= date("Y", ($dtt));





    $query = "INSERT INTO ".$car_no."( status, sprice, iprice, fprice, date_inst, imonth, iyear, cash_received, due, due_sum, total_due, next_date, iremark)
    values('sold','$sprice','$iprice','$fprice','$date_inst','$month','$year','$cash_received','$due','$due_sum' ,'$total_due1','$next_date','$remark')";

    $query_run = mysqli_query($conn, $query);

    $queryd = "INSERT INTO installment_date( car_no, date ) values('$car_no','$next_date')";

    $query_rund = mysqli_query($conn, $queryd);




    if($query_run)
    {

      header("Location: installment.php? car_no=".$car_no."  ");
    }
    else {

      header("Location: installment.php? car_no=".$car_no."  ");
    }

  }
?>
