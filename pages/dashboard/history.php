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
    

        $sql0 = "SELECT * FROM history WHERE users_id ='$id' and user_email='$email' ORDER BY id DESC";
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
    <title>Elight - History</title>
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
    <link rel="shortcut icon" href="../../images/favicon.png" />
</head>

<body>
    <div class="container-scroller">
     
        <!-- partial:partials/_navbar.html -->
        <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
            <div class="navbar-brand-wrapper d-flex justify-content-center">
                <div class="navbar-brand-inner-wrapper d-flex justify-content-between align-items-center w-100">
                    <a class="navbar-brand brand-logo" href="index.html"><img src="../../images/logo.png"
                            alt="logo" /></a>
                    <a class="navbar-brand brand-logo-mini" href="index.html"><img src="../../images/logo-mini.png"
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
                        <a class="nav-link" href="home.php">
                            <i class="mdi mdi-home menu-icon"></i>
                            <span class="menu-title">Dashboard</span>
                        </a>
                    </li>
                   
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
                        <div class="col-md-12 stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <p class="card-title">Electricity purchase history</p>
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
                                                <tr>
                                                    <td><?php echo $row["date_purchased"]?></td>
                                                     <td><?php echo $row["unit_purchased"]." Kwh"?></td>
                                                     <td><?php echo "NGN ".$row["unit_amount"]?></td>
                                                     <td><?php 
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
    <!-- End custom js for this page-->

    <script src="../../js/jquery.cookie.js" type="text/javascript"></script>
</body>

</html>