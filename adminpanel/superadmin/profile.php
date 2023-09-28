<?php
include 'config.php';
$id = $_GET['id'];

$q = mysqli_query($conn, "select * from tbl_user where id = $id");
$r = mysqli_fetch_assoc($q);

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

    <style>
        @media(max-width:400px) {
            
        
        .form-control ,.form-select{
    display: block;
    width: 100%;
    padding: 0.3rem .5rem!important;
    font-size: .7rem!important;
    font-weight: 400;
    line-height: 1;
 
   
   }
   .form-select option {
  
    width: 50%!important;
    padding: 0.3rem .5rem!important;
    font-size: xx-small;
    font-weight: 400;
    line-height: 1;
    background-color: yellow;
 
   
   }
}
    </style>
   
</head>

<body>
    <div class="container-scroller">

        <?php include '../dashboardheader.php'; ?>
        <!-- partial -->
        <div class="main-panel">
            <div class="content-wrapper updated">
                <div class="page-header">
                    <h2>Profile</h2>
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
                     <i id="popup-close-btn" class="mdi mdi-close close" ></i>

                     <!-- Remove 'active' class, this is just to show in Codepen thumbnail -->
                     <div id="progress1" class="progress1 "></div>
                 </div>

               
                 
             </div>
              

                <div class="row justify-content-center">
                    <div class="col-md-6 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Profile</h4>
                                <p class="card-description"> Basic Information</p>
                                <form class="forms-sample" id="judge_detail_update">
                                    <input type="hidden" name="userid" value="<?php echo $id ?>">
                                    <div class="form-group">
                                        <label for="exampleInputUsername1">First Name</label>
                                        <input type="text" class="form-control" id="exampleInputfname" name="fname" placeholder="First Name" value="<?php echo $r['first_name'] ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputUsername2">Last Name</label>
                                        <input type="text" class="form-control" id="exampleInputlname" name="lname" placeholder="Last Name" value="<?php echo $r['last_name'] ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Email</label>
                                        <input type="email" class="form-control" id="exampleInputemail" name="email" placeholder="Email" value="<?php echo $r['email'] ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputConfirmPassword1">Password</label>
                                        <input type="password" class="form-control" id="exampleInputConfirmPassword" name="password" placeholder="Password" value="<?php echo $r['password'] ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputConfirmPassword1">Contact No</label>
                                        <input type="text" class="form-control" id="exampleInputContactNo" placeholder="Contact" name="contact" value="<?php echo $r['phone'] ?>">
                                    </div>
                                    <div class="form-group ">
                                        <label for="studentType">Category</label>
                                        <select class="form-select" id="SelectDepartment" name="category">
                                            <option selected value="<?php echo $r['category'] ?>"><?php echo $r['category'] ?></option>

                                            <option value="Professional">Professional/Engineers</option>
                                            <option value="Faculty">Faculty </option>
                                            <option value="K-12 Teachers">K-12 Teachers </option>
                                            <option value="Student">Student</option>
                                            <option value="Pre-Service teacher">Pre-Service Teacher</option>
                                            <option value="Others">Others</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="studentType">Judge Confirm</label>
                                        <select class="form-select" id="SelectDepartment" name="judge_confirm">
                                            <?php
                                            if ($r['judge_confirm'] == 'Y') {
                                                $val = 'Yes';
                                            } else {
                                                $val = 'No';
                                            }
                                            ?>
                                            <option selected value="<?php echo $r['judge_confirm'] ?>"><?php echo $val ?></option>
                                            <option value="Y">Yes</option>
                                            <option value="N">No</option>
                                        </select>
                                    </div>

                                    <button type="submit" name="submit" class="btn btn-gradient-success me-2">Submit</button>

                                </form>
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
    <script src="../assets/js/ajaxscript.js" type = "text/javascript"></script>
    <!-- End custom js for this page -->
</body>

</html>