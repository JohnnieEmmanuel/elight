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

        $sql1 = "SELECT * FROM users WHERE id=".$id;
        $result1 = $conn->query($sql1);
        $row1 = $result1->fetch_assoc();
    $meterno=$row1["meter_number"];

        $sql0 = "SELECT * FROM meters WHERE meter=".$meterno;
        $result0 = $conn->query($sql0);
        $row0 = $result0->fetch_assoc();

       
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
                <!-- <ul class="navbar-nav mr-lg-4 w-100">
                    <li class="nav-item nav-search d-none d-lg-block w-100">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="search">
                                    <i class="mdi mdi-magnify"></i>
                                </span>
                            </div>
                            <input type="text" class="form-control" placeholder="Search now" aria-label="search"
                                aria-describedby="search">
                        </div>
                    </li>
                </ul> -->
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
            <div class="col-md-6 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
    <script type="text/javascript" src="https://js.paystack.co/v1/inline.js"></script>
              

                  <form  id="paymentForm">
                  <div class="form-group row">
<label for="meter_number" class="col-sm-3 col-form-label">Meter Number</label>
<div class="col-sm-9">
  <input type="text" class="form-control"  value="<?php echo $row1["meter_number"]?>" id="meter_number" readonly>
</div>
</div>
 <div class="form-group row">
                      <label for="email" class="col-sm-3 col-form-label">Email</label>
                      <div class="col-sm-9">
                        <input type="email" class="form-control" id="email-address" value="<?php echo $row1["email"]?>" placeholder="Email" readonly>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="amount" class="col-sm-3 col-form-label">Amount</label>
                      <div class="col-sm-9">
                        <input type="number"  min="500"  oninput="total()" class="form-control" id="amount" placeholder="NGN" >
                      </div>
                      <span id="warning" class="nn" >Limit is NGN 500</span>
                    </div>
                   
                  
                    <input type="hidden" class="form-control" id="phone" value="<?php echo $row1["phone_number"]?>">
                    <input type="hidden" class="form-control" id="tariff_plan" value="<?php echo$row0["tariff_plan"]?>">
<p  id="fee_warning" class="form-control" >Transaction fee is NGN <span id="fee"></span> </p>

                    
                    <button type="button"   class="btn btn-primary me-2 " onclick="payWithPaystack()">Submit</button>

                  </form>
                  
                </div>
              </div>
            </div>
            <!-- main-panel ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->

    <!-- plugins:js -->
    <script src="../../vendors/base/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page-->
    <script src="../../vendors/chart.js/Chart.min.js"></script>
    <script src="../../vendors/datatables.net/jquery.dataTables.js"></script>
    <script src="../../vendors/datatables.net-bs4/dataTables.bootstrap4.js"></script>
    <!-- End plugin js for this page-->
    <!-- inject:js -->
    <script src="../../js/off-canvas.js"></script>
    <script src="../../js/hoverable-collapse.js"></script>
    <script src="../../js/template.js"></script>
    <!-- endinject -->
    <!-- Custom js for this page-->
    <script src="../../js/dashboard.js"></script>
    <script src="../../js/data-table.js"></script>
    <script src="../../js/jquery.dataTables.js"></script>
    <script src="../../js/dataTables.bootstrap4.js"></script>

    <!-- End custom js for this page-->

    <script src="../../js/jquery.cookie.js" type="text/javascript"></script>
    <script type="text/javascript" src="../../js/script.js"></script>

    <script>
  //end
</script>
</body>

</html>