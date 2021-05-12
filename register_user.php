<?php

$first_name = $_POST['first_name'];
$last_name = $_POST['last_name'];
$email_id = $_POST['email_id'];
$contact_number = $_POST['contact_number'];
$password = $_POST['password'];

require 'init.php';

if($con)
{
	$sql = "select * from user_details where email_id = '$email_id'";
 	$result = mysqli_query($con,$sql);
	if(mysqli_num_rows($result) > 0)
		{
			$status = "ok";
			$result_code = 0;
			echo json_encode(array('status' => $status,'result_code' => $result_code));
		}
	else
		{		
			$sql = "INSERT INTO user_details (first_name,last_name,email_id,contact_number,password) 
			VALUES('$first_name','$last_name','$email_id','$contact_number','$password');";
			if(mysqli_query($con,$sql))
				{
					$status = "ok";
					$result_code = 1;
					echo json_encode(array('status' => $status,'result_code' => $result_code));
				}
			else
				{

					$status = "Failed";
					echo json_encode(array('status' => $status),JSON_FORCE_OBJECT);
				}
		}
}
else
{
	$status = "Failed";
    echo json_encode(array('status' => $status),JSON_FORCE_OBJECT);
}

mysqli_close($con)
?>