<?php

$driver_id = $_POST['driver_id'];

require 'init.php';

header('Content-Type: application/json');
if($con)
{
  $sql = "select * from order_details where is_accepted = 1 and is_completed = 0 and driver_id = $driver_id";
  	$result = mysqli_query($con,$sql);
    $num_of_rows = mysqli_num_rows($result); 
    $temp_array = array();

  	if(mysqli_num_rows($result) > 0)
  		{	
  			while($row = mysqli_fetch_assoc($result))
            {   
                $temp_array[]=$row;
          	}
          	echo json_encode($temp_array);
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