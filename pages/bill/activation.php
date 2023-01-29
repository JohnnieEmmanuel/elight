<?php
    /* Avoid multiple sessions warning
    Check if session is set before starting a new one. */
    if(!isset($_SESSION)) {
        session_start();
    }

    include "../ebills/validate-user.php";
    include "../ebills/connect.php";

	
   

    if (isset($_SESSION['loggedIn_user_id'])) {
        $id = $_SESSION['loggedIn_user_id'];
		$email = $_SESSION['loggedIn_user_email'];
        global $invalid;
        $sql1 = "SELECT * FROM users WHERE id=".$id;
        $result1 = $conn->query($sql1);
        $row1 = $result1->fetch_assoc();

        if(isset($_GET['activate']) && isset($_GET['txref'])){
            $code = $_GET['activate'];
            $ref = $_GET['txref'];
            $sql0 = "SELECT * FROM history WHERE users_id ='$id' and reference='$ref' ";
        $result0 = $conn->query($sql0);
        $row0 = $result0->fetch_assoc();

        if($row0['activation_code'] ==  $code && $code != '' && $ref != ''){
            echo '<script >console.log("valid activation key")</script>';
                   }
                   else{
            echo '<script >console.log("invalid activation key")</script>';
            echo '<script >alert ("Invalid reference or activation key:(");  </script>';
           
            $invalid = "true";
            
                   }
                }
                else{
            echo '<script >console.log("ref and code not found")</script>';
            echo '<script >alert ("Invalid reference or activation key:(");  </script>';
            $invalid = "true";
            
                }
        }
        
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>E-light</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="../../vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="../../vendors/base/vendor.bundle.base.css">
    <!-- endinject -->
    <!-- plugin css for this page -->
    <link rel="stylesheet" href="../../vendors/datatables.net-bs4/dataTables.bootstrap4.css">
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="../../css/style.css">

    <!-- endinject -->
    <link rel="shortcut icon" href="../../images/logo2.png" />
    <style type="text/css">
        .text-bold{
            font-weight: bolder;
            text-align: center;
        }
        .m-top{
            margin-top: 10%;
        }
    </style>
</head>

<body>
    <div class="container-scroller">
     
        <!-- partial:partials/_navbar.html -->
        <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
            <div class="navbar-brand-wrapper d-flex justify-content-center">
                <div class="navbar-brand-inner-wrapper d-flex justify-content-between align-items-center w-100">
                    <a class="navbar-brand brand-logo" href="index.html"><img src="../../images/logo1.png"
                            alt="logo" /></a>
                    <a class="navbar-brand brand-logo-mini" href="index.html"><img src="../../images/logo2.png"
                            alt="logo" /></a>
                    <button class="navbar-toggler navbar-toggler align-self-center" type="button"
                        data-toggle="minimize">
                        <span class="mdi mdi-sort-variant"></span>
                    </button>
                </div>
            </div>
            <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
                
                <ul class="navbar-nav navbar-nav-right">
                
                    <li class="nav-item nav-profile dropdown">
                        <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown" id="profileDropdown">
                            <img src="../../images/faces/face5.jpg" alt="profile" />
                            <span class="nav-profile-name"> <?php echo $row1["email"] ?></span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right navbar-dropdown"
                            aria-labelledby="profileDropdown">
                            
                            <a href="../ebills/logout.php" class="dropdown-item">
                                <i class="mdi mdi-logout text-primary"></i>
                                Logout
                            </a>
                        </div>
                    </li>
                </ul>
                <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button"
                    data-toggle="offcanvas">
                    <span class="mdi mdi-menu"></span>
                </button>
            </div>
        </nav>
        <!-- partial -->
        <div class="container-fluid page-body-wrapper">
            <!-- partial:partials/_sidebar.html -->
            <nav class="sidebar sidebar-offcanvas" id="sidebar">
                <ul class="nav">
                    <li class="nav-item">
                        <a class="nav-link" href="../dashboard/home.php">
                            <i class="mdi mdi-home menu-icon"></i>
                            <span class="menu-title">Dashboard</span>
                        </a>
                    </li>
                    
                    <li class="nav-item">
                        <a class="nav-link" href="../dashboard/history.php">
                            <i class="mdi mdi-file-document-box-outline menu-icon"></i>
                            <span class="menu-title">History</span>
                        </a>
                    </li>
                </ul>
            </nav>
            <!-- partial -->
            <div class="main-panel">
                <div class="content-wrapper">

                    <div class="row">
                    <i class="mdi mdi-checkbox-marked-circle-outline " style="font-size:10rem; text-align: center; color: chartreuse;"></i>
      <small class="text-bold">Your receipt has been sent to your email address</small>
                                        
      <h5 class="text-bold m-top">METER ACTIVATION CODE: </br><span class="m-top"><?php
                       if($invalid === "true"){
         echo '<script> window.location.replace("../ebills/logout.php"); </script>';

                       }else{
                        echo $code;

                       }
                       ?></span></h5  >
                       
                    </div>
                    
                <!-- content-wrapper ends -->
               
            </div>
            <!-- main-panel ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->

    <script src="../../js/script.js"></script>

    <!-- End custom js for this page-->

    <script src="../../js/jquery.cookie.js" type="text/javascript"></script>

    

</body>

</html>