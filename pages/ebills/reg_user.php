<?php
    include "connect.php";

      /* Avoid multiple sessions warning
    Check if session is set before starting a new one. */
     
     $fname= mysqli_real_escape_string($conn, $_POST["firstname"]);
     $lname= mysqli_real_escape_string($conn, $_POST["lastname"]);
     $password = mysqli_real_escape_string($conn, $_POST["password"]);
     $passwordtwo = mysqli_real_escape_string($conn, $_POST["confirmpassword"]);
     $email= mysqli_real_escape_string($conn, $_POST["email"]);
     $phone_number= mysqli_real_escape_string($conn, $_POST["phone_number"]);
     $address= mysqli_real_escape_string($conn, $_POST["address"]);
     $email= mysqli_real_escape_string($conn, $_POST["email"]);
     $meter_number= mysqli_real_escape_string($conn, $_POST["meter_number"]);



     
     $sql_u = "SELECT * FROM users WHERE  email='$email' ";       
     $res_u = mysqli_query($conn, $sql_u);

     $sql_m = "SELECT * FROM meters WHERE  meter='$meter_number'";       
     $res_m = mysqli_query($conn, $sql_m);

         if ($password != $passwordtwo){
            echo '<script>console.log("Passwords do no match");</script>';
            
        $messagee = "Passwords do not match";
        echo "<script type='text/javascript'>alert('$messagee');</script>";
        echo '<script> window.location.replace("../auth/register.php?sign-up=failed"); </script>';

        }
       

     else{
 
         if(mysqli_num_rows($res_u) > 0){
            echo '<script>console.log("The email dey inside the db already!!!");</script>';
         
        $messagee = "Email exists already!! Sign in or use another email";
        echo "<script type='text/javascript'>alert('$messagee');</script>";
        echo '<script> window.location.replace("../auth/register.php?sign-up=failed"); </script>';
     
        }
        else{

            if(mysqli_num_rows($res_m) > 0){
                echo '<script>console.log("valid meter");</script>';
           
                $cust_insert_query= " INSERT INTO `users`(`id`,`meter_number`, `first_name`,`last_name`, `email`, `phone_number`,`address`, `password`,`verified_user`,`date_reg`)
                VALUES (NULL,'$meter_number', '$fname', '$lname', '$email','$phone_number','$address',  '$password',0,NULL);"; 
               $cust_result = $conn->query($cust_insert_query);
      
             
                    if($cust_result){
                        echo '<script>console.log("user registration was successfull");</script>';
//update the assigned column in the meter table 
$meter_assigned="UPDATE `meters` SET `assigned`='YES' WHERE meter='$meter_number'";
$m_a = mysqli_query($conn,$meter_assigned);

                        $success_message = "Sign-up successfully";
                        echo "<script type='text/javascript'>alert('$success_message');</script>";
                        echo '<script> window.location.replace("../auth/login.php?sign-up=success"); </script>';
            
                    }
                    else{
                        echo '<script>console.log("registration was not successfull");</script>';
                        echo '<script> window.location.replace("../auth/register.php?sign-up=failed"); </script>';
            
                    }
            } 
            else{
                echo '<script>console.log("Invalid meter number");</script>';
             
                $invalid_meter = "The Meter number provided is invalid.Check your meter for the number!";
                echo "<script type='text/javascript'>alert('$invalid_meter');</script>";
                echo '<script> window.location.replace("../auth/register.php?sign-up=failed"); </script>';
             
            }




        

        }

        }

 
    
    // end line
    

    
?>


