<?php

include('db.php');

if(isset($_GET['delete'])){

  $car_no = $_GET['delete'];

  $query= "select * FROM images where car_no= '".$car_no."' ";
  $query_result = mysqli_query ($conn, $query);
  while ($row = mysqli_fetch_assoc($query_result)){
    $imagep = $row['img_name'];
    unlink("uploads/".$imagep);
  }

  
   $sql = "select * from new_car_info where car_no = '".$car_no."'  ";

  $result = mysqli_query($conn, $sql);
  if(mysqli_num_rows($result) > 0){
    $row = mysqli_fetch_assoc($result);
    $image = $row['car_photo'];


    $queries = ["delete from new_car_info where car_no = '".$car_no."'",

        "delete from images where car_no = '".$car_no."'",

            "drop table ".$car_no." "
      ];
      foreach ($queries as $query) {
                  $stmt = $conn->prepare($query);
                  $stmt->execute();
              }


    if($stmt)
    {
      unlink("uploads/".$image);

      header('Location: new_car_list.php');
    }
    else {

      header('Location: new_car_list.php');
    }


  }
}
 ?>
