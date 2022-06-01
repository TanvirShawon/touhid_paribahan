<?php
  require_once('db.php');


  if (isset($_POST['Submit'])) {
    $car = 'c';
    $car_no1 = $_POST['car_no'];
    $car_no = $car.$car_no1 ;
    $expense = $_POST['expense'];
    $earn = $_POST['earn'];
    $date = $_POST['date'];
    $remark = $_POST['remark'];
    $profit = $earn - $expense;


    $dt = strtotime($date);
    $month= date("M", ($dt));

    $year= date("Y", ($dt));

    $sqls = "select car_no from new_car_info where car_no= '".$car_no."' ";
    $results = mysqli_query($conn, $sqls);
    if (mysqli_num_rows($results) > 0) {
      $row = mysqli_fetch_assoc($results);
    }else {
      header("Location: daily_expense.php?message=No record found!");
    }

    $query_total_profit= "select SUM(profit) AS sum FROM ".$car_no." WHERE status='unsold'";
    $query_result = mysqli_query ($conn, $query_total_profit);

    while ($row = mysqli_fetch_assoc($query_result)){
      $total_profit = $row['sum'] + $profit;
    }



    $query = "INSERT INTO ".$car_no."( expense, earn, profit, total_profit, date, month, year, remark, status)
    values('$expense','$earn','$profit','$total_profit' ,'$date','$month','$year','$remark','unsold')";

    $query_run = mysqli_query($conn, $query);




    if($query_run)
    {

      header('Location: index.php');
    }
    else {

      header('Location: index.php');
    }

  }
?>
