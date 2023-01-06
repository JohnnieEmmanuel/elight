<?php
    include "connect.php";
    
    /* Avoid multiple sessions warning
    Check if session is set before starting a new one. */
    if(!isset($_SESSION)) {
        session_start();
    }

    $email = mysqli_real_escape_string($conn, $_POST["email"]);
    $password = mysqli_real_escape_string($conn, $_POST["password"]);

    $sql0 =  "SELECT * FROM admin_data WHERE email='".$email."' AND password='".$password."'";
    $result = $conn->query($sql0);
    $row = $result->fetch_assoc();

    if (($result->num_rows) > 0) {
        $_SESSION['loggedIn_admin_id'] = $row["id"];
        $_SESSION['loggedIn_email'] = $row["email"];

        $_SESSION['isCustValid'] = true;
        $_SESSION['LAST_ACTIVITY'] = time();
        header("location:../dashboard/admin.php");
    }
    else {
        session_destroy();
        die(header("location:../auth/admin_login.php?loginFailed=true"));
    }
?>
