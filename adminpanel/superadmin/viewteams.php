<?php
include 'config.php';
session_start();



$team_id = $_GET['team_id'];

$q_vt = mysqli_query($conn, "select distinct tt.id as team_id,tt.project_team_name as project_name,tt.project_description,tu.first_name, tu.last_name,tt.video_pitch, tt.log_book,tu.email 
from tbl_team tt, tbl_team_mentor ttm, tbl_user tu
											where tt.id = $team_id
											and tt.id = ttm.team_id
											and ttm.user_id = tu.id");

$d_vt = mysqli_fetch_assoc($q_vt);
$c_vt = mysqli_num_rows($q_vt);
if ($c_vt > 0) {

$url = $d_vt['video_pitch'];
preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $url, $match);
    if (!empty($match) && isset($match[1])) {
        $youtube_id = $match[1];
    } else {
        // Handle the case when the YouTube ID is not found or URL is not present.
        $youtube_id = null; // You can set a default value or take appropriate action.
    }


}
else 
{
	echo "<script>alert('No Such Team Available')</script>
    <script>window.location.href='grading.php';</script>
    ";
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
    <link rel="shortcut icon" href="../assets/images/favicon.ico" />
    <style>
        .update_table th {
            font-size: 15px !important;
            border-radius: 10px;

        }

        .update_table td {
            font-size: 12px !important;

        }

        .thead-light {

            margin: 10px;
            background-color: #adb5bd;
            padding: 20px;
            padding: .5rem;
         
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            color: #333333;
            opacity: 0.9;
            border-radius: 10px;
            margin: 20px 5px;
            font-size: 1.5rem;
        }


        .thead-dark {

            background: -webkit-gradient(linear, left top, right top, from(#ACE1AF), to(#98FF98)) !important;
            background: linear-gradient(to right, #ACE1AF, #98FF98) !important;
            padding: .5rem;
            display: block;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            color: #333333;
            /* opacity: 0.9; */
            border-radius: 10px;
            margin: 20px 5px;
            font-size: 1.5rem;


        }

        .forms-sample .form-group {
            display: flex;

            justify-content: space-between !important;
        }

        .form-control[readonly] {
            background-color: #dee2e6;
            opacity: 1;
        }

        .form-group iframe {
            width: 300px;
            height: 300px;
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
            width: 220px!important;
            height: 120px;
            border-radius: 8px!important;
        }



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
                width: 280px;
                height: 300px;
            }

        }

        @media (max-width:750px) {
            .table-responsive table tbody tr{
                display: flex;
                flex-direction:row;
                flex-wrap: wrap;
                justify-content:flex-start;
                align-items: center;


            }
        }  
        @media (max-width:400px) {
            .table-responsive table tbody tr{
                display: flex;
                flex-direction:row;
                flex-wrap: wrap;
                justify-content:flex-start;
                align-items: center;


            }
            .table-responsive table tbody td .form-group input{
                padding: 0.6rem 1.375rem;
                width: 100%;
                font-size: 14px!important;
                border-radius: 8px;

            }
            .content-wrapper{
                padding: 2.75rem 1rem!important;
            }
            
        .form-group iframe {
            width: 220px;
            height: 250px;
        }
        .page-header .page-title{
            font-size: 14px;

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
                        <span class="subtitle">Team Submission</span>
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
                            <i class="mdi mdi-alert-circle-outline check"></i>

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
              
                    <div class="table-responsive">
                        <table class="table table-borderless">

                            <thead class="thead-dark">
                                <tr>
                                    <th colspan="3"> Basic Information </th>
                                </tr>
                            </thead>
<tbody>
                            <tr>
                                <td>
                                    <div class="form-group">
                                        <label for="email"> <b> Mentor Name: </b> </label>
                                        <input type="text" readonly class="form-control" id="studentName" value="<?php echo $d_vt['first_name'] . ' ' . $d_vt['last_name'] ?>" placeholder="Enter your name">
                                    </div>
                                </td>

                                <td>
                                    <div class="form-group">
                                        <label for="email"><b> Mentor Email:</b></label>
                                        <input type="text" readonly class="form-control" id="studentFN" value="<?php echo $d_vt['email'] ?>" placeholder="Enter your Father's name">
                                    </div>
                                </td>

                                <td>
                                    <div class="form-group">
                                        <label for="email"><b> Project Title:</b></label>
                                        <input type="text" readonly class="form-control" id="studentRegNo" value="<?php echo $d_vt['project_name'] ?>" placeholder="Enter student registration number">
                                    </div>
                                </td>
                            </tr>

                            <tr>
                                <td colspan="2">
                                    <div class="form-group">
                                        <label for="email"><b>Project Description:</b></label>
                                        <textarea class="form-control" readonly><?php echo $d_vt['project_description'] ?></textarea>
                                    </div>
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <!--<div class="form-group">
       <video width="624" height="352" controls>
        <source src="https://www.youtube.com/watch?v=sA9DwvbQ-hI" type="video/mp4">
        Your browser does not support the video tag.
        </video>
    </div>-->
                                    <?php if ($youtube_id == '') { ?>
                                        <div class="form-group">
                                            <video controls>
                                                <source src="http://grading.emuem.org/Team/<?php echo $d_vt['video_pitch'] ?>" type="video/mp4">
                                                <source src="http://grading.emuem.org/Team/<?php echo $d_vt['video_pitch'] ?>" type="video/ogg">
                                            </video>
                                        </div>
                                    <?php } else { ?>
                                        <div class="form-group">
                                            <iframe src="https://www.youtube.com/embed/<?php echo $youtube_id ?>" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                        </div>
                                    <?php } ?>

                                    <!--<div >
            <label for="pwd"><b>Video Pitch:</b></label>
            <input type="text" class="form-control" id="studentEmail" placeholder="Enter your email">
        </div>-->
                                </td>

                                <td>
                                    <div class="form-group">
                                        <label for="pwd"><b>LogBook:</b></label>
                                        <a href="http://grading.emuem.org/Team/<?php echo $d_vt['log_book'] ?>" target="_blank">LogBook</a>
                                    </div>
                                </td>
                            </tr>
                            </tbody>


                        </table>
                    </div>

                    <!-- Basic Requirments for students ends here -->




                    <!-- Requirments for current students -->
                    <div class="table-responsive">
                        <table class="table table currentShow">

                            <thead class="thead-dark ">
                                <tr>
                                    <th colspan="3"> Team Members. </th>
                                </tr>
                            </thead>

                            <br>
                            <?php
                            $t_q = mysqli_query($conn, "SELECT *
                            FROM tbl_team_member tm
                            JOIN student s ON tm.student_id = s.student_id
                            WHERE tm.team_id = $team_id ");
                            $i = 1;
                            while ($row = mysqli_fetch_assoc($t_q)) {

                            ?>
                                <thead class="thead-light ">
                                    <tr>
                                        <th class="py-3" colspan="3"> Student - <?php echo $i ?></th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <tr>
                                        <td>
                                            <div class="form-group currentShow">
                                                <label for="email"><b>Student First Name:</b></label>
                                                <input type="text" readonly class="form-control" id="yearOfAdmissionInNed" value="<?php echo $row['student_first_name'] ?>" placeholder="Year of Admission In NED">
                                            </div>



                                        </td>

                                        <td>
                                            <div class="form-group currentShow">
                                                <label for="email"><b>Student Last Name:</b></label>
                                                <input type="text" readonly class="form-control" id="yearOfAdmissionInNed" value="<?php echo $row['student_last_name'] ?>" placeholder="Year of Admission In NED">
                                            </div>



                                        </td>

                                        <td>


                                            <div class="form-group currentShow">
                                                <label for="email"><b>Grade:</b></label>
                                                <input type="text" readonly class="form-control" id="studentRoll" value="<?php echo $row['student_grade'] ?> Grade" placeholder="Enter your Roll No">
                                            </div>
                                        </td>

                                    </tr>

                                    <tr>


                                        <td>
                                            <div class="form-group currentShow">
                                                <label for="email"><b>Student School District:</b></label>
                                                <input type="text" readonly class="form-control" id="noOfSiblings" value="<?php echo $row['student_school_district'] ?>" placeholder="">
                                            </div>
                                        </td>

                                        <td>
                                            <div class="form-group currentShow">
                                                <label for="pwd"><b>Student School Name:</b></label>
                                                <input type="text" readonly class="form-control" id="monthlyIncomeParents" value="<?php echo $row['student_school_name'] ?>" placeholder="Enter your parent's monthly income.">
                                            </div>
                                        </td>

                                        <td>
                                            <div class="form-group currentShow">
                                                <label for="pwd"><b>Student School County:</b></label>
                                                <input type="text" class="form-control" id="monthlyIncomeParents" value="<?php echo $row['student_school_county'] ?>" readonly placeholder="Enter your parent's monthly income.">
                                            </div>
                                        </td>


                                    </tr>

                                    <tr>
                                        <td>
                                            <div class="form-group" id="mRent">
                                                <label for="pwd"><b>T-shirt Size:</b></label>
                                                <input type="text" readonly class="form-control" id="monthlyRent" placeholder="Enter your monthly house rent" value="<?php echo $row['t_shirt_size'] ?>">
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                                <br>
                                <!-- S1 Starts Here -->

                            <?php $i++;
                            } ?>

                        </table>
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
    <script src="../assets/js/misc.js"></script>
    <!-- endinject -->
    <!-- Custom js for this page -->
    <script src="../assets/js/dashboard.js"></script>
    <script src="../assets/js/todolist.js"></script>
    <script src="../assets/js/ajaxscript.js" type="text/javascript"></script>
    <!-- End custom js for this page -->
</body>

</html>