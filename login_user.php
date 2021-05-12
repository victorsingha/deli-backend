<?php

$email_id = $_POST['email_id'];
$password = $_POST['password'];

require 'init.php';

if($con)
{
	$sql = "select * from user_details where email_id = '$email_id' and password = '$password'";
  	$result = mysqli_query($con,$sql);	
  	if(mysqli_num_rows($result) > 0)
  		{	
  			$row = mysqli_fetch_assoc($result);
  			$status = "ok";
  			$result_code = 1;
  			$first_name = $row["first_name"];
  			$last_name = $row["last_name"];
  			$email_id = $row["email_id"];
  			$contact_number = $row["contact_number"];
  			echo json_encode(array( 'status' => $status,
  			                        'result_code' => $result_code, 
  			                        'first_name' => $first_name, 
  			                        'last_name' => $last_name, 
  			                        'contact_number' => $contact_number, 
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