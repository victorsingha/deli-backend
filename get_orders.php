<?php

// $driver_email_id = $_POST['driver_email_id'];
// $password = $_POST['password'];
require 'init.php';

header('Content-Type: application/json');
if($con)
{
	// $sql = "select * from order_details where driver_email_id = '$driver_email_id'";
  $sql = "select * from order_details where is_accepted = 0";
  	$result = mysqli_query($con,$sql);
    $num_of_rows = mysqli_num_rows($result); 
    $temp_array = array();
  	if(mysqli_num_rows($result) > 0)
  		{	
  			while($row = mysqli_fetch_assoc($result))
        {   
       //      $temp_array[]=$row;
  			    // $status = "ok";
  			    // $result_code = 1;

  			   //  $driver_email_id = $row["driver_email_id"];
  		    //   $order_id = $row["order_id"];		
    //         $pick_location = $row["pick_location"];
    //         $drop_location = $row["drop_location"];
    //         $pick_date = $row["pick_date"];
    //         $vehicle = $row["vehicle"];
    //         $amount = $row["amount"];
    //         $full_name = $row["full_name"];
    //         $email_id = $row["email_id"];
    //         $contact_number = $row["contact_number"];
    //         $parcel = $row["parcel"];
    //         $driver_id = $row["driver_id"];
    //         $is_accepted = $row["is_accepted"];
    //         $is_completed = $row["is_completed"];
  	// 		echo json_encode(array( //'status' => $status,
    //                               //  'result_code' => $result_code,
    //                                 'order_id' => $order_id,
    //                                 'pick_location' => $pick_location,
    //                                 'drop_location' => $drop_location,
    //                                 'pick_date' => $pick_date,
    //                                 'vehicle' => $vehicle,
    //                                 'amount' => $amount,
    //                                 'full_name' => $full_name,
    //                                 'email_id' => $email_id,
    //                                 'contact_number' => $contact_number,
    //                                 'parcel' => $parcel,
    //                                 'driver_id' => $driver_id,
    //                                 'is_accepted' => $is_accepted,
  		// 				            'is_completed'=> $is_completed));
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