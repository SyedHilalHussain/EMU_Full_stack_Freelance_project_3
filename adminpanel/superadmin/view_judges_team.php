<?php 
include 'config.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Purple Admin</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="../assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="../assets/vendors/css/vendor.bundle.base.css">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="../assets/css/style2.css">
    <!-- End layout styles -->
    <link rel="shortcut icon" href="../assets/images/favicon.ico" />

   

</head>

<body>
    <div class="container-scroller">

        <?php include '../dashboardheader.php'; ?>
        <!-- partial -->
        <div class="main-panel">
            <div class="content-wrapper updated">

            

<div class="page-header">
  <h3 class="page-title">
    <span class="page-title-icon text-white me-2">
      <i class="mdi mdi-view-dashboard"></i>
    </span> 
    <span class="subtitle">View Assigned Teams To Judge</span>
  </h3>
  <nav aria-label="breadcrumb">
    <ul class="breadcrumb">
      <li class="breadcrumb-item active" aria-current="page">
      <button id="reloadButton" class="btn page-title-icon btn-sm text-white" onclick="window.history.back() ">Back</button>
      </li>
    </ul>
  </nav>
  </div>
  <div class="my-3 mt-5" style="
                 
                 display: flex;
                 align-items: center;
                 justify-content: center;
                 background-color: #f4f7ff;
                 overflow: hidden;">
                    <div class="toast1 mt-5 ">

                        <div class="toast1-content">
                            <i class="mdi mdi-alert-circle-outline check"></i>

                            <div class="message1">
                                <span class="text text-1"></span>
                                <span class="text text-2"></span>
                            </div>
                        </div>
                        <i id="popup-close-btn" class="mdi mdi-close close"></i>

                        <!-- Remove 'active' class, this is just to show in Codepen thumbnail -->
                        <div id="progress1" class="progress1 "></div>
                    </div>



                </div>


<div class="row">
  <div class="col-12 grid-margin">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">Recent Tickets</h4>
        <div class="table-responsive">
          <table class="table judge-table table1">
            <thead class="table-dark">
              <tr>
                <th scope="col">Judge</th>
                <th scope="col">Team Name</th>
                <th scope="col">Category</th>
                <th scope="col" style="white-space: nowrap;">Delete Record</th>
              </tr>
            </thead>
            <tbody>

            <?php
            $q_team = mysqli_query($conn, "select distinct tj.id, first_name, last_name, project_team_name, tt.category 
              from `tbl_judge_team` tj, tbl_user tu, tbl_team tt
              WHERE tj.user_id=tu.id
              and tu.id = tj.user_id
              and tj.team_id = tt.id");

            while ($r_team = mysqli_fetch_assoc($q_team)) {
              ?>
              <tr>
                <td><?php echo $r_team['first_name'] . ' ' . $r_team['last_name']; ?></td>
                <td><?php echo $r_team['project_team_name']; ?></td>
                <td><?php echo $r_team['category']; ?></td>
                <td>
                  <a href="#" class="delete_judge" data-id="<?php echo $r_team['id']; ?>">
                    <button type="button" style="margin:0px;" class="btn-success btn-gradient-success btn-sm">Delete</button>
                  </a>
                </td>
              </tr>
            <?php
            }
            ?>
            
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>




        

                <!-- content-wrapper ends -->
                <!-- partial:partials/_footer.html -->
                <footer class="footer">

                </footer>
                <!-- partial -->
            </div>
            <!-- main-panel ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="../assets/vendors/js/vendor.bundle.base.js"></script>
    <!-- <script src="./../assets/js/main.js"></script> -->
    <!-- endinject -->
    <!-- Plugin js for this page -->

    <script src="../assets/js/jquery.cookie.js" type="text/javascript"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="../assets/js/off-canvas.js"></script>
    <script src="../assets/js/hoverable-collapse.js"></script>
    <script src="../assets/js/misc.js"></script>
    <!-- endinject -->
    <!-- Custom js for this page -->
    <script src="../assets/js/dashboard.js"></script>
    <script src="../assets/js/todolist.js"></script>
    <script src="../assets/js/ajaxscript.js" type="text/javascript"></script>
    <!-- End custom js for this page -->
</body>

</html>