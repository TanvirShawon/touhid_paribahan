<?php

// Create connection
require_once('db.php');
$upload_dir = 'uploads/';
$sql = "SELECT * FROM new_car_info WHERE status='sold'AND car_no LIKE '%".$_POST['name']."%'";
$result = mysqli_query($conn, $sql);
if(mysqli_num_rows($result)>0){
	while ($row=mysqli_fetch_assoc($result)) {
    ?>
    <tr>
      <td><?php echo $row['id'] ?></td>
      <td><img src="<?php echo $upload_dir.$row['car_photo'] ?>" height="40"></td>
      <td><?php echo $row['car_name'] ?></td>
      <td><?php echo $row['car_no'] ?></td>
      <td><?php echo $row['price'] ?></td>

      <td><a href="<?php echo $statusLink; ?>" title="<?php echo $statusTooltip; ?>">
        <span class="badge <?php echo ($row['status'] == 'sold')?'badge-success':'badge-danger'; ?>">
          <?php echo ($row['status'] == 'sold')?'sold':'unsold'; ?></span></a></td>


      <td class="text-center">
        <a href="show.php?id=<?php echo $row['id'] ?>" class="btn btn-success"><i class="fa fa-eye"></i></a>
        <!-- <a href="edit.php?id=<?php echo $row['id'] ?>" class="btn btn-info"><i class="fa fa-user-edit"></i></a> -->
        <a href="new_car_list.php?delete=<?php echo $row['id'] ?>" class="btn btn-danger" onclick="return confirm('Are you sure to delete this record?')"><i class="fa fa-trash-alt"></i></a>
        <a href="sell_details.php?id=<?php echo $row['id'] ?>" class="badge text-dark 'badge-danger'">Mark Sold</a >
      </td>
    </tr>
    <?php
        }
      }
    ?>


?>
