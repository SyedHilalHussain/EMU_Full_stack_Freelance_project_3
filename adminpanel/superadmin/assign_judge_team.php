<?php
include 'config.php';
// $id = $_GET['id'];

// $q = mysqli_query($conn, "select * from tbl_user where id = $id");
// $r = mysqli_fetch_assoc($q);

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
    <link rel="stylesheet" href="./../assets/css/style2.css">
    <!-- End layout styles -->
    <link rel="shortcut icon" href="../assets/images/favicon.ico" />

    <style>
        @media(max-width:400px) {


            .form-control,
            .form-select {
                display: block;
                width: 100%;
                padding: 0.3rem .5rem !important;
                font-size: .7rem !important;
                font-weight: 400;
                line-height: 1;


            }

            .form-select option {

                width: 50% !important;
                padding: 0.3rem .5rem !important;
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
                    <h2>Assign Judges</h2>

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


                <div class="row justify-content-center">
                    <div class="col-md-6 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Profile</h4>
                                <p class="card-description"> Basic Information</p>
                                <form class="forms-sample" id="assign_judge_team">
                                    <!-- <input type="hidden" name="userid" value="<?php echo $id ?>"> -->
                                    <div class="form-group">
                                        <label for="studentType">Select Judge:</label>
                                        <select class="form-select" id="judge_id" name="judge_id">
                                            <option>Select Judge type</option>
                                            <?php
                                            $q_j = mysqli_query($conn, "select * from tbl_user where user_type='Judge' and judge_confirm = 'Y' order by first_name asc");
                                            while ($d_j = mysqli_fetch_assoc($q_j)) {
                                                $jid  = $d_j['id'];
                                                $s_c = mysqli_query($conn, "select count(*) as count from tbl_judge_team where user_id = $jid");
                                                $d_c = mysqli_fetch_assoc($s_c);

                                            ?>
                                                <option value="<?php echo $d_j['id'] ?>"><?php echo $d_j['first_name'] . ' ' . $d_j['last_name'] . '-' . $d_j['category'] . ' (' . $d_c['count'] . ')' ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="studentType">Select Team Category:</label>
                                        <select class="form-select" id="team_category" name="team_category">
                                            <option value="">Select Team Category</option>
                                            <option value="">Select Team Category</option>
                                            <?php
                                            $q_t = mysqli_query($conn, "select distinct category from tbl_team where category !=' '");
                                            while ($d_t = mysqli_fetch_assoc($q_t)) {

                                            ?>
                                                <option value="<?php echo $d_t['category'] ?>"><?php echo $d_t['category'] ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="studentType">Select Team-1:</label>
                                        <select class="form-select team-select" id="team_id_1" name="team_id_1">
                                            <option value="0" selected>Select Team-1</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="studentType">Select Team-2:</label>
                                        <select class="form-select" id="team_id_2" name="team_id_2">
                                            <option value="0" selected>Select Team-2</option>

                                        </select>
                                    </div>

                                    <div class="form-group ">
                                        <label for="studentType">Select Team-3:</label>
                                        <select class="form-select" id="team_id_3" name="team_id_3">
                                            <option value="0" selected>Select Team-3</option>

                                        </select>
                                    </div>
                                    <div class="form-group">
                                     
                                        <label for="studentType">Select Team-4:</label>
                                        <select class="form-select" id="team_id_4" name="team_id_4">
                                            <option value="0" selected>Select Team-4</option>

                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="studentType">Select Team-5:</label>
                                        <select class="form-select" id="team_id_5" name="team_id_5">
                                            <option value="0" selected>Select Team-5</option>

                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="studentType">Select Team-6:</label>
                                        <select class="form-select" id="team_id_6" name="team_id_6">
                                            <option value="0" selected>Select Team-6</option>

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