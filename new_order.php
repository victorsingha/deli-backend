<?php

$pick_location = $_POST['pick_location'];
$drop_location = $_POST['drop_location'];
$pick_date = $_POST['pick_date'];
$vehicle = $_POST['vehicle'];
$amount = $_POST['amount'];
$full_name = $_POST['full_name'];
$email_id = $_POST['email_id'];
$contact_number = $_POST['contact_number'];
$parcel = $_POST['parcel'];

require 'init.php';

if($con)
{
    $sql = "INSERT INTO order_details 
    (pick_location,drop_location,pick_date,vehicle,amount,full_name,email_id,contact_number,parcel) 
    VALUES
    ('$pick_location','$drop_location','$pick_date','$vehicle','$amount','$full_name','$email_id','$contact_number','$parcel');";
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
else
{
    $status = "Failed";
    echo json_encode(array('status' => $status),JSON_FORCE_OBJECT);
}

mysqli_close($con)
?>