<?php

$driver_id = $_POST['driver_id'];
$order_id = $_POST['order_id'];

require 'init.php';

if($con)
{
	$sql = "update order_details set is_accepted = 1,driver_id = $driver_id where order_id = $order_id";
  	if(mysqli_query($con,$sql))
  		{	
  			$status = "ok";
  			$result_code = 1;
  			echo json_encode(array('status' => $status,'result_code' => $result_code));
 		}
 	else
 		{
 			$status = "ok";
  			$result_code = 0;
  			echo json_encode(array('status' => $status,'result_code' => $result_code));
 		}
}
else
{
    $status = "Failed";
    echo json_encode(array('status' => $status),JSON_FORCE_OBJECT);
}
mysqli_close($con)

?>