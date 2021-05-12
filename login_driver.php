<?php

$email_id = $_POST['email_id'];
$password = $_POST['password'];

require 'init.php';

if($con)
{
	$sql = "select * from driver_details where email_id = '$email_id' and password = '$password'";
  	$result = mysqli_query($con,$sql);	
  	if(mysqli_num_rows($result) > 0)
		{	
			$row = mysqli_fetch_assoc($result);
			$status = "ok";
			$result_code = 1;
    		$driver_id = $row["driver_id"];
			$email_id = $row["email_id"];
			echo json_encode(array('status' => $status,
      		'result_code' => $result_code,
     		'driver_id' => $driver_id,  
			'email_id'=> $email_id));
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