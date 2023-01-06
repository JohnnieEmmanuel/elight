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
    

        $sql0 = "SELECT * FROM history WHERE users_id ='$id' and user_email='$email' ORDER BY id DESC LIMIT 3";
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
                    <li class="nav-item dropdown me-1">
                        <a class="nav-link count-indicator dropdown-toggle d-flex justify-content-center align-items-center"
                            id="messageDropdown" href="#" data-bs-toggle="dropdown">
                            <i class="mdi mdi-message-text mx-0"></i>
                            <span class="count"></span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right navbar-dropdown"
                            aria-labelledby="messageDropdown">
                            <p class="mb-0 font-weight-normal float-left dropdown-header">Messages</p>
                            <a class="dropdown-item">
                                <div class="item-thumbnail">
                                    <img src="../../images/faces/face4.jpg" alt="image" class="profile-pic">
                                </div>
                                <div class="item-content flex-grow">
                                    <h6 class="ellipsis font-weight-normal">David Grey
                                    </h6>
                                    <p class="font-weight-light small-text text-muted mb-0">
                                        The meeting is cancelled
                                    </p>
                                </div>
                            </a>
                            <a class="dropdown-item">
                                <div class="item-thumbnail">
                                    <img src="../../images/faces/face2.jpg" alt="image" class="profile-pic">
                                </div>
                                <div class="item-content flex-grow">
                                    <h6 class="ellipsis font-weight-normal">Tim Cook
                                    </h6>
                                    <p class="font-weight-light small-text text-muted mb-0">
                                        New product launch
                                    </p>
                                </div>
                            </a>
                            <a class="dropdown-item">
                                <div class="item-thumbnail">
                                    <img src="../../images/faces/face3.jpg" alt="image" class="profile-pic">
                                </div>
                                <div class="item-content flex-grow">
                                    <h6 class="ellipsis font-weight-normal"> Johnson
                                    </h6>
                                    <p class="font-weight-light small-text text-muted mb-0">
                                        Upcoming board meeting
                                    </p>
                                </div>
                            </a>
                        </div>
                    </li>
                    <li class="nav-item dropdown me-4">
                        <a class="nav-link count-indicator dropdown-toggle d-flex align-items-center justify-content-center notification-dropdown"
                            id="notificationDropdown" href="#" data-bs-toggle="dropdown">
                            <i class="mdi mdi-bell mx-0"></i>
                            <span class="count"></span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right navbar-dropdown"
                            aria-labelledby="notificationDropdown">
                            <p class="mb-0 font-weight-normal float-left dropdown-header">Notifications</p>
                           
                            <a class="dropdown-item">
                                <div class="item-thumbnail">
                                    <div class="item-icon bg-info">
                                        <i class="mdi mdi-account-box mx-0"></i>
                                    </div>
                                </div>
                                <div class="item-content">
                                    <h6 class="font-weight-normal">Welcome, kindly Confirm your account</h6>
                                    <p class="font-weight-light small-text mb-0 text-muted">
                                        2 days ago
                                    </p>
                                </div>
                            </a>
                        </div>
                    </li>
                    <li class="nav-item nav-profile dropdown">
                        <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown" id="profileDropdown">
                            <img src="../../images/faces/face5.jpg" alt="profile" />
                            <span class="nav-profile-name"> <?php echo $row1["email"] ?></span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right navbar-dropdown"
                            aria-labelledby="profileDropdown">
                            <a class="dropdown-item">
                                <i class="mdi mdi-settings text-primary"></i>
                                Settings
                            </a>
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
                        <a class="nav-link" href="home.php">
                            <i class="mdi mdi-home menu-icon"></i>
                            <span class="menu-title">Dashboard</span>
                        </a>
                    </li>
                    <!-- <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="collapse" href="#ui-basic" aria-expanded="false"
                            aria-controls="ui-basic">
                            <i class="mdi mdi-circle-outline menu-icon"></i>
                            <span class="menu-title">UI Elements</span>
                            <i class="menu-arrow"></i>
                        </a>
                        <div class="collapse" id="ui-basic">
                            <ul class="nav flex-column sub-menu">
                                <li class="nav-item"> <a class="nav-link" href="../ui-features/buttons.html">Buttons</a>
                                </li>
                                <li class="nav-item"> <a class="nav-link"
                                        href="../ui-features/typography.html">Typography</a></li>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../forms/basic_elements.html">
                            <i class="mdi mdi-view-headline menu-icon"></i>
                            <span class="menu-title">Form elements</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../charts/chartjs.html">
                            <i class="mdi mdi-chart-pie menu-icon"></i>
                            <span class="menu-title">Charts</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../tables/basic-table.html">
                            <i class="mdi mdi-grid-large menu-icon"></i>
                            <span class="menu-title">Tables</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../icons/mdi.html">
                            <i class="mdi mdi-emoticon menu-icon"></i>
                            <span class="menu-title">Icons</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="collapse" href="#auth" aria-expanded="false"
                            aria-controls="auth">
                            <i class="mdi mdi-account menu-icon"></i>
                            <span class="menu-title">User Pages</span>
                            <i class="menu-arrow"></i>
                        </a>
                        <div class="collapse" id="auth">
                            <ul class="nav flex-column sub-menu">
                                <li class="nav-item"> <a class="nav-link" href="../samples/login.html"> Login </a></li>
                                <li class="nav-item"> <a class="nav-link" href="../samples/login-2.html"> Login 2 </a>
                                </li>
                                <li class="nav-item"> <a class="nav-link" href="../samples/register.html"> Register </a>
                                </li>
                                <li class="nav-item"> <a class="nav-link" href="../samples/register-2.html"> Register 2
                                    </a></li>
                                <li class="nav-item"> <a class="nav-link" href="../samples/lock-screen.html"> Lockscreen
                                    </a></li>
                            </ul>
                        </div>
                    </li>
                    
                     -->
                    <li class="nav-item">
                        <a class="nav-link" href="history.php">
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
                        <div class="col-md-12 grid-margin">
                            <div class="d-flex justify-content-between flex-wrap">
                                <div class="d-flex align-items-end flex-wrap">
                                    <div class="me-md-3 me-xl-5">
                                        <h2>Welcome, <?php echo $row1["first_name"]." ".$row1["last_name"]  ?> </h2>
                                    </div>
                                   
                                </div>
                              
                            </div>
                        </div>
                    </div>
                    <div class="row">
            <div class="col-md-12 grid-margin">
              <div class="d-flex justify-content-between flex-wrap">
                <div class="d-flex align-items-end flex-wrap">
                  <div class="me-md-3 me-xl-5">
                    <h5>Meter Number: <?php echo $row1["meter_number"] ?></h5>
                  </div>
                
                </div>
               
              </div>
            </div>
          </div>
                    <div class="row">
                        <div class="col-md-12 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body dashboard-tabs p-0">
                                    <ul class="nav nav-tabs px-4" role="tablist">
                                      
                                        <li class="nav-item">
                                            <a class="nav-link active" id="sales-tab" data-bs-toggle="tab" href="#sales"
                                                role="tab" aria-controls="sales" aria-selected="true"></a>
                                        </li>
                                    </ul>
                                    <div class="tab-content py-0 px-0">
                                       <div class="tab-pane fade show active" id="sales" role="tabpanel"
                                            aria-labelledby="sales-tab">
                                            <div class="d-flex flex-wrap justify-content-xl-between">
                                             
                                                <div
                                                    class="d-flex border-md-right flex-grow-1 align-items-center justify-content-center p-3 item">
                                                   
                                    <button class="btn btn-primary text-light mt-2 mt-xl-0" type="button" data-bs-toggle="modal" data-bs-target="#powerCalculator">
                                        <i class="mdi mdi-calculator text-light"></i>Power Calculator</button>

                                        <!-- Modal -->
<div class="modal fade" id="powerCalculator" tabindex="-1" aria-labelledby="powerCalculatorLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="powerCalculatorLabel">Modal title</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
     </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>
                                                </div>
                                                <div
                                                    class="d-flex border-md-right flex-grow-1 align-items-center justify-content-center p-3 item">
                                                   
                                  <a href="../bill/payment.php">  <button  class="btn btn-primary text-light mt-2 mt-xl-0">
                                        <i class="mdi mdi-cart-plus text-light"></i>Buy Unit</button></a>
                                                </div>
                                                <div
                                                    class="d-flex border-md-right flex-grow-1 align-items-center justify-content-center p-3 item">
                                                  
                                                    <button class="btn btn-primary text-light mt-2 mt-xl-0">
                                        <i class="mdi mdi-download text-light"></i>Download report</button>
                                                  
                                                </div>
                                            
                                              
                                            </div>
                                        </div>
                                       
                                </div>
                            </div>
                        </div>
                    </div>
                   
                  <div class="row">
                        <div class="col-md-12 stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <p class="card-title">Recent Bill Payments</p>
                                    <div class="table-responsive">
                                        <table id="recent-purchases-listing" class="table">
                                        <?php
            $result = $conn->query($sql0);
			

            if ($result->num_rows > 0) {?>	  
                                        <thead>
                                                <tr>
                                                <th>Date</th>
                                                <th>Unit</th>
                                                <th>Amount</th>
                                                <th>Status</th>
                                                    
                                                </tr>
                                            </thead>
                                            <?php
            // output data of each row
            while($row = $result->fetch_assoc()) {
               
                ?>
                                            <tbody>
                                                <tr >
                                                    <td><?php echo $row["date_purchased"]?></td>
                                                     <td><?php echo $row["unit_purchased"]." Kwh"?></td>
                                                     <td><?php echo "NGN ".$row["unit_amount"]?></td>
                                                     <td id="status"><?php 
                                                    echo $row["status"]
                                                   
                                                    ?>
                                                    
                                                </td>
                                                </tr>
                                             </tbody>
                                        
                                    <?php } ?>
                                    </table>
                                    <?php
            } else {  ?>
                <h3 class="text-muted">No Electricity bill payment yet</h3>
            <?php }
            $conn->close(); ?>	</table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                  
                <!-- content-wrapper ends -->
               
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
    <script src="../../js/script.js"></script>

    <!-- End custom js for this page-->

    <script src="../../js/jquery.cookie.js" type="text/javascript"></script>

    

</body>

</html>