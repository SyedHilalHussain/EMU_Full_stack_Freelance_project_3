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
                        <span class="subtitle">Edit Users</span>
                    </h3>
                    <nav aria-label="breadcrumb">
    <ul class="breadcrumb">
      <li class="breadcrumb-item active" aria-current="page">
      <button id="reloadButton" class="btn page-title-icon btn-sm text-white" onclick="window.history.back() ">Back</button>
      </li>
    </ul>
  </nav>
                    </div>
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
                            <i id="popup-close-btn" class="mdi mdi-close close"></i>

                            <!-- Remove 'active' class, this is just to show in Codepen thumbnail -->
                            <div id="progress1" class="progress1 "></div>
                        </div>



                    </div>

               
                <div class="row ">
                    <div class="col-12 grid-margin">
                        <div class="card">

                            <!-- <div class="card">
                            <?php
                            $query = "SELECT DISTINCT current_year
                                    FROM tbl_years
                                    ORDER BY current_year DESC
                                    LIMIT 4";

                            $result = mysqli_query($conn, $query);

                            ?>
                            <div class="d-flex justify-content-between mx-2 mt-2">
                                <h4 class="card-title mt-1">Student Profiles <span id="year_span">ALL
                                    </span></h4>

                                <div class="d-flex justify-content-between">
                                    <label for="studentType " class="mt-1">Student Grade:</label>
                                    <select name="year_change" id="year_change" class="form-select form-select-sm ms-3" style="width: fit-content;">

                                        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                                            <option value="<?php echo $row['current_year']; ?>"><?php echo $row['current_year']; ?></option>
                                        <?php } ?>

                                    </select>
                                </div>
                            </div> -->
                            <div class="card-body pt-3">

                                <h4 class="card-title mt-1">Edit Users</h4>
                                <div class="table-responsive">

                                    <table class="table ">
                                        <thead class="bg-dark text-light  ">
                                            <tr>
                                                <th style="font-size:medium; white-space:nowrap;">S.No</th>
                                                <th style="font-size:medium; white-space:nowrap;">First Name</th>
                                                <th style="font-size:medium; white-space:nowrap;">Last Name</th>
                                                <th style="font-size:medium; white-space:nowrap;">Email</th>
                                                <th style="font-size:medium; white-space:nowrap;">Phone</th>
                                                <th style="font-size:medium; white-space:nowrap;">Address</th>
                                                <th style="font-size:medium; white-space:nowrap;">UserType</th>
                                                <th style="font-size:medium; white-space:nowrap;">Edit</th>
                                            </tr>
                                        </thead>

                                        <tbody id="tbl_body1">

                                            <?php

                                            $q_team = mysqli_query($conn, "select * from tbl_user  order by is_approved asc,id desc");
                                            $i = 1;
                                            while ($r_team = mysqli_fetch_assoc($q_team)) {

                                            ?>

                                                <tr>
                                                    <td><?php echo $i; ?></td>
                                                    <td><?php echo $r_team["first_name"]; ?></td>
                                                    <td><?php echo $r_team["last_name"]; ?></td>
                                                    <td><?php echo $r_team["email"]; ?></td>
                                                    <td><?php echo $r_team["phone"]; ?></td>
                                                    <td><?php echo $r_team["address"]; ?></td>
                                                    <td><?php echo $r_team["user_type"]; ?></td>
                                                    <td>
                                                        <a href="./profile.php?id=<?php echo $r_team['id']; ?>">
                                                            <button type="button" class="btn btn-small btn-success px-3 py-2" name="submit">Edit</button>
                                                        </a>
                                                    </td>
                                                </tr>
                                                <?php $i++; ?>
                                            <?php } ?>


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
    <script src="../assets/js/ajaxscript.js?v=1" type="text/javascript"></script>
    <!-- End custom js for this page -->
</body>

</html>