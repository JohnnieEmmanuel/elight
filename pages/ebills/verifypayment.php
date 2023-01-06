<?php
 /* Avoid multiple sessions warning
    Check if session is set before starting a new one. */
    if(!isset($_SESSION)) {
        session_start();
    }

    include "../ebills/validate-user.php";
    include "../ebills/connect.php";


if (isset($_GET['reference']) && isset($_SESSION['loggedIn_user_id'])) {
    $id = $_SESSION['loggedIn_user_id'];
    $email = $_SESSION['loggedIn_user_email'];
    $reference = $_GET['reference'];

    $sql1 = "SELECT * FROM users WHERE id=".$id  ;
    $result1 = $conn->query($sql1);
    $row1 = $result1->fetch_assoc();

    // echo "<script type='text/javascript'>console.log('$reference');</script>";

    $curl = curl_init();

    curl_setopt_array($curl, array(
    CURLOPT_URL => "https://api.paystack.co/transaction/verify/$reference",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "GET",
    CURLOPT_HTTPHEADER => array(
            "Authorization: Bearer sk_test_b1ee029a2f523b06db9de88bc82fa34887660626",
            "Cache-Control: no-cache",
        ),
    )
    );

    $response = curl_exec($curl);
    $err = curl_error($curl);
    $res= json_decode($response);
    curl_close($curl);

    if ($err) {
        echo "cURL Error #:" . $err;
    } else {

        $status= $res->data->status;
        $currentDate = new DateTime();
//Get the year by using the format method.
$year = $currentDate->format("Y");
        $month = $currentDate->format("M");
//Printing that out
echo $month;
        $up = ($res->data->amount) / 100;
        $paidat = $res->data->paidAt;
        $meter_number = $row1['meter_number'];
        $charge = $res->data->metadata->custom_fields[0]->value;
        $unit_purchased = $res->data->metadata->custom_fields[1]->value;
        $activation_code = $res->data->metadata->custom_fields[3]->value;



        if($res->data->status === 'success' ){
            echo "<script>console.log($response)</script>";
            $newhistory = "INSERT INTO `history`(`id`, `users_id`, `reference`, `activation_code`, `meter_no`, `user_email`, `unit_purchased`,`charge`, `unit_amount`, `date_purchased`, `status`, `year`, `month`) 
            VALUES 
            (NULL,'$id','$reference','$activation_code','$meter_number','$email','$unit_purchased', '$charge','$up','$paidat','$status','$year','$month')";
            $trignewhistory = $conn->query($newhistory);


            if ($trignewhistory) {
                echo "<script>console.log('history has been inserted')</script>";
                header("Location:../bill/activation.php?txref=".$reference."&activate=".$activation_code);
                
            }
            else{
                echo "<script>console.error('couldnt insert the history')</script>";
                echo '<script> window.location.replace("../dashboard/home.php"); </script>';

            }
        }
      
}
    }

?>