<?php
session_start();
include('../superadmin/config.php');


$id = $_SESSION['id'];
$name = $_SESSION['name'];
$mentor_id = $_SESSION['mentor_id'];

$team_id = base64_decode($_GET['team_id']);
$grade_query = mysqli_query($conn, "select * from student where student_id='$id'");
$grade_row = mysqli_fetch_assoc($grade_query);
$grade = $grade_row['student_grade'];
if ($grade > 2 && $grade < 6) {
    $category = '3-5';
} elseif ($grade > 5 && $grade < 9) {
    $category = '6-8';
} elseif ($grade > 8 && $grade < 13) {
    $category = '9-12';
} else {
    $category = 'K-2';
}
$q_vt = mysqli_query($conn, "select distinct tt.id as team_id,tt.project_team_name as project_name,tt.project_description,tu.first_name, tu.last_name,tt.video_pitch, tt.log_book,tu.email 
from tbl_team tt, tbl_team_mentor ttm, tbl_user tu
											where tt.id = $team_id
											and tt.id = ttm.team_id
											and ttm.user_id = tu.id");

$d_vt = mysqli_fetch_assoc($q_vt);

$url = $d_vt['video_pitch'];
preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $url, $match);
if (!empty($match) && isset($match[1])) {
    $youtube_id = $match[1];
} else {
    // Handle the case when the YouTube ID is not found or URL is not present.
    $youtube_id = null; // You can set a default value or take appropriate action.
}

extract($_POST);
if (isset($_POST['submit_update'])) {
   

    foreach ($_POST['student_id'] as $p) {
        //$q_u = mysqli_query($conn, "select * from tbl_user where id= $p");
        //$r_u = mysqli_fetch_assoc($q_u);
        mysqli_query($conn, "INSERT INTO tbl_team_member  (team_id ,student_id) values('$team_id', '$p')");
        #echo "update tbl_team_member set team_id = $team_id where student_id = $p";
    }
    echo "<script type='text/javascript'>window.location.href = 'home.php';</script>";
}



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

    <style>
        .update_table th {
            font-size: 17px !important;
            white-space: nowrap;


        }

        .update_table td {
            font-size: 15px !important;

        }

        .tablemember .thead th {
            border: .1rem solid white;
            font-size: 14px;
            background-color: #333333;
            color: #fff;
            white-space: nowrap;

        }

        .tablemember .tbody tr td {
            padding: 0 !important;
        }

        .form-heading {

            background: -webkit-gradient(linear, left top, right top, from(#ACE1AF), to(#98FF98)) !important;
            background: linear-gradient(to right, #ACE1AF, #98FF98) !important;
            padding: 1.25rem;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            color: #333333;
            /* opacity: 0.9; */
            border-radius: 5px;
            margin: 20px 5px;
            font-size: 1.5rem;


        }

        .forms-sample .form-group {
            display: flex;

            justify-content: space-between !important;
        }

        .form-group iframe {
            width: 100%;
            height: 400px;

        }

        input {
            padding: .5rem !important;

            margin: 0 !important;
        }

        select {

            display: block;
            width: 20%;
            padding: 0.375rem 1.2rem 0.375rem 0.3rem;
            -moz-padding-start: calc(0.75rem - 3px);
            font-size: .8rem;
            font-weight: 400;
            line-height: 1.5;
            color: black;
            font-family: 'Poppins', sans-serif !important;
            background-color: #fff;
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16'%3e%3cpath fill='none' stroke='%23343a40' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M2 5l6 6 6-6'/%3e%3c/svg%3e");
            background-repeat: no-repeat;
            background-position: right 0.3rem center;
            background-size: 15px 12px;
            border: 1px solid #ced4da;
            border-radius: 2px;
            -webkit-transition: border-color 0.15s ease-in-out, -webkit-box-shadow 0.15s ease-in-out;
            transition: border-color 0.15s ease-in-out, -webkit-box-shadow 0.15s ease-in-out;
            transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
            transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out, -webkit-box-shadow 0.15s ease-in-out;
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;

        }

        textarea {
            -webkit-transition: border-color 0.15s ease-in-out, -webkit-box-shadow 0.15s ease-in-out;
            transition: border-color 0.15s ease-in-out, -webkit-box-shadow 0.15s ease-in-out;
            transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
            transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out, -webkit-box-shadow 0.15s ease-in-out;
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
            border: 1px solid #ced4da;
            width: 350px;
            height: 120px;
        }

        .content-wrapper {}

        @media (max-width:1200px) {
            textarea {
                width: 200px;

                font-size: small;
            }

            .form-heading {
                font-size: 15px;
                padding: .8rem;
            }

            .form-group iframe {
                width: 300px;
                height: 300px;
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
                    <h3 class="page-title">
                        <span class="page-title-icon  text-white me-2">
                            <i class="mdi mdi-view-dashboard"></i>
                        </span> Dashboard ->
                        <span class="subtitle">Team Editing</span>
                    </h3>


                </div>
                <div class="my-3 mt-5" style="
                 
                 display: flex;
                 align-items: center;
                 justify-content: center;
                 background-color: #f4f7ff;
                 overflow: hidden;">
                    <div class="toast1 mt-5 ">

                        <div class="toast1-content">
                            <i class="mdi mdi-alert-circle-outline check" id="check"></i>

                            <div class="message1">
                                <span class="text text-1"></span>
                                <span class="text text-2"></span>
                            </div>
                        </div>
                        <i class="mdi mdi-close close"></i>

                        <!-- Remove 'active' class, this is just to show in Codepen thumbnail -->
                        <div id="progress1" class="progress1 "></div>
                    </div>



                </div>
                <div class="container content-wrapper-inside">
                    <div class="row">
                        <div class="col-md-7 col-sm-12 grid-margin align-item-center justify-content-center">
                            <div class="card">
                                <div class="card-body">
                                    <h3>Team Information</h3>
                                    <div class="table-responsive">
                                        <table class="table team_table update_table">
                                            <thead class="thead-dark text-center" id="table">
                                                <?php
                                                $q_team = mysqli_query($conn, "select distinct tt.id as team_id,tt.project_team_name as project_name,tt.category,tt.project_description,tt.video_pitch, tt.log_book
                                          from tbl_team tt, tbl_team_mentor ttm, tbl_team_member tm 
                                          where tm.student_id = $id 
                                          and tt.id = $team_id
                                                       and tt.id = ttm.team_id
                                                       and tt.deleted = 0


                                        ");

                                                while ($r_team = mysqli_fetch_assoc($q_team)) {
                                                    $team_id = $r_team['team_id'];


                                                ?><tr>
                                                        <!--<th scope="col">Team ID</th>-->
                                                        <th scope="col">Project Name</th>

                                                        <th scope="col">Team Cateogory</th>
                                                        <?php if (isset($r_team['log_book'])) { ?>
                                                            <th>Team Logbook :</th>
                                                        <?php } ?>

                                                    </tr>
                                            </thead>
                                            <tbody>



                                                <tr class="justify-content-center text-center">

                                                    <td><a href="viewteams.php?team_id=<?php echo $team_id; ?>"><?php echo $r_team['project_name'] ?></a></td>
                                                    <td><?php echo $r_team['category'] ?></td>
                                                    <?php if (isset($r_team['log_book'])) { ?>
                                                        <td><a href="./test_upload/<?php echo $r_team['log_book'] ?>" target="blank">LogBook</a> </td>
                                                    <?php } ?>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class=" col-lg-5 col-sm-12">



                            <br>
                            <?php if ($d_vt['video_pitch']) { ?>
                                <h3>Video Pitch:</h3>


                                <?php if ($youtube_id == '') { ?>
                                    <div class="form-group">
                                        <video controls style="width:100%!important; height:100%!important;">
                                            <source src="<?php echo './test_upload/' . $d_vt['video_pitch'] ?>" type="video/mp4">
                                            <source src="<?php echo './test_upload/' . $d_vt['video_pitch'] ?>" type="video/ogg">
                                        </video>
                                    </div>
                                <?php } else { ?>
                                    <div class="form-group">
                                        <iframe src="https://www.youtube.com/embed/<?php echo $youtube_id ?>" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                    </div>
                                <?php } ?>
                            <?php } ?>
                            <p>Don't forget to click on "Submit Evaluation" to record your evaluation.</p>

                        </div>

                    </div>
                    <div class="row">
                        <br>
                        <h3>Add Students from below list</h3>
                        <form method="post" enctype="multipart/form-data">
                            <div>
                                <label for="studentType">Students List:</label>

                                <select name="student_id[]" class="form-control" multiple="multiple">
                                    <option selected>Select the Team Members</option>
                                    <?php
                                    $q_m = mysqli_query($conn, "SELECT tbl_student_mentor.student_id as id, tbl_user.first_name, tbl_user.last_name
                                    FROM tbl_user
                                    JOIN tbl_student_mentor ON tbl_user.id = tbl_student_mentor.student_id
                                    JOIN student ON tbl_student_mentor.student_id = student.student_id
                                    LEFT JOIN tbl_team_member ON tbl_student_mentor.student_id = tbl_team_member.student_id
                                                              AND tbl_team_member.team_id = $team_id
                                    WHERE tbl_student_mentor.mentor_id = 4
                                    AND
                                    (
                                      (CASE 
                                        WHEN student.student_grade >= 3 AND student.student_grade <= 5 THEN '3-5'
                                        WHEN student.student_grade >= 6 AND student.student_grade <= 8 THEN '6-8'
                                        WHEN student.student_grade >= 9 AND student.student_grade <= 12 THEN '9-12'
                                        ELSE 'K-2'
                                      END) = '3-5'
                                    )
                                    AND tbl_team_member.student_id IS NULL;
                                    ");
                                    while ($r_m = mysqli_fetch_assoc($q_m)) {
                                    ?>
                                        <option value="<?php echo $r_m['id']; ?>"><?php echo $r_m['first_name'] . ' ' . $r_m['last_name'] ?></option>

                                    <?php } ?>
                                </select>
                            </div>

                            <br>
                            <div>
                                <label for="studentType">Current Team members:</label>
                                <?php
                                $q_m_s = mysqli_query($conn, "SELECT *
                                FROM tbl_team_member tm
                                JOIN student s ON tm.student_id = s.student_id
                                WHERE tm.team_id = $team_id AND s.deleted = 0;");
                                $count = mysqli_num_rows($q_m_s);
                                if ($count > 0) {
                                ?>
                                    <select class="form-select" multiple readonly>
                                        <?php
                                        while ($r_m_s = mysqli_fetch_assoc($q_m_s)) {
                                        ?>
                                            <option value="<?php echo $r_m_s['id']; ?>" disabled ><?php echo $r_m_s['student_first_name'] . ' ' . $r_m_s['student_last_name'] ?></option>

                                        <?php } ?>
                                    </select>
                                <?php } ?>
                            </div>
                            <br>
                            <div class="form-group">

                                <button type="submit" class="btn btn-success" name="submit_update">Add Students</button>
                            </div>

                        </form>
                        <br>
                    </div>
                    

                </div>
            </div>

        </div>
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
    <!-- <script src="../assets/js/misc.js"></script> -->
    <!-- endinject -->
    <!-- Custom js for this page -->
    <script src="../assets/js/dashboard.js"></script>
    <script src="../assets/js/todolist.js"></script>
    <script src="../assets/js/ajaxscript.js" type="text/javascript"></script>
    <!-- End custom js for this page -->
</body>

</html>