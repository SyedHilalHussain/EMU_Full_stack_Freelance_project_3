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

<div class="page-header mb-5">
  <h3 class="page-title">
    <span class="page-title-icon text-white me-2">
      <i class="mdi mdi-view-dashboard"></i>
    </span> Dashboard ->
    <span class="subtitle">Judges</span>
  </h3>
  <div class="my-3 my-3" style="
                 
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
                     <i id="popup-close-btn" class="mdi mdi-close close" ></i>

                     <!-- Remove 'active' class, this is just to show in Codepen thumbnail -->
                     <div id="progress1" class="progress1 "></div>
                 </div>

               
                 
             </div>
 
</div>
<div class="row ">
  <div class="col-12 grid-margin">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">Recent Tickets</h4>
        <div class="table-responsive">
          <table class="table user-table">
            <thead>
              <tr>
                <th scope="col">First Name</th>
                <th scope="col">Last Name</th>
                <th scope="col">Email</th>
                <th scope="col">Phone</th>
                <th scope="col">Address</th>
                <th scope="col">UserType</th>
                <th scope="col">Actions</th>
              </tr>
            </thead>
            <tbody>

            <?php
            $q_team = mysqli_query($conn, "select * from tbl_user where user_type='SuperUser' order by is_approved asc,id desc");

            while ($r_team = mysqli_fetch_assoc($q_team)) {

            ?>

              <tr>
                <td><?php echo $r_team["first_name"]; ?></td>
                <td><?php echo $r_team["last_name"]; ?></td>
                <td><?php echo $r_team["email"]; ?></td>
                <td><?php echo $r_team["phone"]; ?></td>
                <td><?php echo $r_team["address"]; ?></td>
                <td><?php echo $r_team["user_type"]; ?></td>
                <!--<td><?php echo $r_team["judge_confirm"]; ?></a></td>-->
                <td>
                  <div class="btn-container">
                    <?php
                    if ($r_team["is_approved"] == 0) {
                      echo '
                        <a onClick="return confirm(\'Do you want to approve the user?\')" href="#" class="btn mini purple approve-btn" data-id="'.$r_team['id'].'" data-table="tbl_user" data-returns="users" data-flag="1"  >
                          <button type="button" style="margin:0px;" class="btn-gradient-success btn-sm" >Approve</button>
                        </a>
                        <a onClick="return confirm(\'Do you want to disapprove the user?\')" href="#" class="btn mini purple approve-btn" data-id="'.$r_team['id'].'" data-table="tbl_user" data-returns="users" data-flag="0"  >
                          <button type="button" style="margin:0px;" class="btn-gradient-success btn-sm" onclick="edit(this)">Disapprove</button>
                        </a>
                      ';
                    } else {
                      echo '
                        <a onClick="return confirm(\'Do you want to disapprove the user?\')" href="#" class="btn mini purple approve-btn" data-id="'.$r_team['id'].'" data-table="tbl_user" data-returns="users" data-flag="0"  >
                          <button type="button" style="margin:0px;" class="btn-gradient-success btn-sm" onclick="edit(this)">Disapprove</button>
                        </a>
                      ';
                    }
                    ?>
                    <a onClick="return confirm('Are you sure you want to delete?')"  href="#" class="btn mini purple delete-user-btn" data-id="<?php echo $r_team['id']; ?>" data-table="tbl_user" data-returns="users" >
                      <button type="button" style="margin:0px;" class="btn-gradient-danger btn-danger btn-sm" >Delete</button>
                    </a>
                  </div>
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
<!-- End plugin js for this page -->
<!-- inject:js -->
<script src="../assets/js/off-canvas.js"></script>
<script src="../assets/js/hoverable-collapse.js"></script>
<script src="../assets/js/misc.js"></script>
<!-- endinject -->
<!-- Custom js for this page -->
<script src="../assets/js/dashboard.js"></script>
<script src="../assets/js/todolist.js"></script>
<script src="../assets/js/ajaxscript.js" type = "text/javascript"></script>
<!-- End custom js for this page -->
</body>

</html>

