<?php
    include "connect.php";

      /* Avoid multiple sessions warning
    Check if session is set before starting a new one. */
     
     $fname= mysqli_real_escape_string($conn, $_POST["firstname"]);
     $lname= mysqli_real_escape_string($conn, $_POST["lastname"]);
     $password = mysqli_real_escape_string($conn, $_POST["password"]);
     $passwordtwo = mysqli_real_escape_string($conn, $_POST["confirmpassword"]);
     $email= mysqli_real_escape_string($conn, $_POST["email"]);
     
     $sql_u = "SELECT * FROM admin_data WHERE  email='$email' ";       
     $res_u = mysqli_query($conn, $sql_u);

         if ($password != $passwordtwo){
            echo '<script>console.log("Passwords do no match");</script>';
            
        $messagee = "Passwords do not match";
        echo "<script type='text/javascript'>alert('$messagee');</script>";
        echo '<script> window.location.replace("../auth/admin_register.php?sign-up=failed"); </script>';

        }
    
        
     else{
 
         if(mysqli_num_rows($res_u) > 0){
            echo '<script>console.log("The email dey inside the db already!!!");</script>';
         
        $messagee = "Email exists already!! Sign in or use another email";
        echo "<script type='text/javascript'>alert('$messagee');</script>";
        echo '<script> window.location.replace("../auth/admin_register.php?sign-up=failed"); </script>';
     
        }
        else{
         $cust_insert_query= " INSERT INTO `admin_data`(`id`, `first_name`,`last_name`, `email`, `password`,`date_reg`)
          VALUES (NULL, '$fname', '$lname', '$email',  '$password',NULL);"; 
         $cust_result = $conn->query($cust_insert_query);

       
         if($cust_result){
            echo '<script>console.log("registration was successfull");</script>';
            echo '<script> window.location.replace("../auth/admin_register.php?sign-up=success"); </script>';

         }
         else{
            echo '<script>console.log("registration was not successfull");</script>';
            echo '<script> window.location.replace("../auth/admin_register.php?sign-up=failed"); </script>';

         }

        }

        }

 
    
    // end line
    

    
?>


