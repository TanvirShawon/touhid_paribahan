<?php
include 'db.php'
$output='';

if (isset($_POST['query'])) {
	$search= $_POST['query'];
	$stmt= $conn->prepare ("SELECT * FROM new_car_info where car_no like CONCAT('%',?,'%') or car_name like CONCAT('%',?,'%') ");
	$stmt->bind_param("ss",$search,$search);
}

else {
	$stmt= $conn->prepare ("SELECT * from new_car_info");
}

$stmt-> execute();
$result= $stmt->get_result();
if($result-> num_rows>0){
	$output= "
	<thead>
		<th>ID</th>
		<th>Image</th>
		<th>Car Name</th>
		<th>Car No.</th>
		<th>Price</th>
		<th>Status</th>
		<th>Actions</th>
	</thead>
	<tfoot>
		<tr>
			<th>ID</th>
			<th>Image</th>
			<th>Car Name</th>
			<th>Car No.</th>
			<th>Price</th>
			<th>Status</th>
			<th>Actions</th>
		</tr>
	</tfoot>
	<tbody>";
$sl=0;
	while($row = $result->fetch_assoc()){
		$output.=""
		$sl++;

		<tr>
			<td>".$row['car_no']" </td>
		</tr>;

}

$output .="</tbody>";
echo $output;
else{
	<?php echo "<h3>No records found! </h3>" ?>
}
 ?>
