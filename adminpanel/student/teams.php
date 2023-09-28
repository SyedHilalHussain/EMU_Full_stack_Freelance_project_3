<?php
include '../superadmin/config.php';
session_start();
$url = $_SERVER['REQUEST_URI'];
$id = $_SESSION['id'];
$name = $_SESSION['name'];
$mentor_id = $_SESSION['mentor_id'];
$year = date("Y");
$timezone = date_default_timezone_set('America/New_York');
$date = date('Y-m-d H:i:s');
$today_at_midnight = strtotime('midnight');
$terms= 0;
$date_check = '2023-10-27 00:00:00';
echo $date;
if (($year) == date("Y")) {
    if ($date <= $date_check) {
        echo 'isnide';
        $student = 0;
        $upload = 0;
        $team_id = -1;
        $team_select = 0;
        if (!isset($team)) {
            $team = 0;
        }




        if (isset($_GET['submit_check'])) {
            $terms = $_GET['terms'];

            if (isset($terms)) {
                $_SESSION['team'] = 1;
            }
        }

        if (isset($_POST['submit_team_select'])) {
            $team_select = 1;
            if ($team_id > 0) {
                header("location:viewteams.php?team_id=$team_id");
            }
        }

        if (isset($_POST['submit_team'])) {
            $year = date("Y");
            $project_description = mysqli_real_escape_string($con, $_POST['project_description']);
            #echo 'tesitng'.$year;
            $sql = mysqli_query($con, "insert into tbl_team (project_team_name,project_description,category,year) values ('$team_name', '$project_description','$category','$year')");
            if ($sql) {
                $team_id = mysqli_insert_id($con);
                $team_q = mysqli_query($con, "insert into tbl_team_mentor values (NULL,$team_id,$mentor_id,'','','')");
                if ($team_q) {
                    $student = 1;
                    $team_submit = 1;
                    foreach ($_POST['student_id'] as $p) {
                        //$q_u = mysqli_query($con, "select * from tbl_user where id= $p");
                        //$r_u = mysqli_fetch_assoc($q_u);
                        mysqli_query($con, "update tbl_team_member set team_id = $team_id where student_id = $p");
                    }
                }
            } else {
                echo "<script>alert('Database error. Please report to admin!')</script>";
            }
            echo "<script type='text/javascript'>window.location.href = 'home.php';</script>";
        }
        #echo 'outside the script';

        if (isset($_POST['submit_update'])) {
            $team_id = $_POST['team_id'];
            $year = date("Y");
            $project_description = mysqli_real_escape_string($con, $_POST['project_description']);

            #echo 'inside the script';

            $sql = mysqli_query($con, "update tbl_team set project_team_name ='$team_name' ,
                                            ,project_description = '$project_description',
											category = '$category' where id = $team_id");


            foreach ($_POST['student_id'] as $p) {
                //$q_u = mysqli_query($con, "select * from tbl_user where id= $p");
                //$r_u = mysqli_fetch_assoc($q_u);
                mysqli_query($con, "update tbl_team_member set team_id = $team_id where student_id = $p");
                #echo "update tbl_team_member set team_id = $team_id where student_id = $p";
            }
            echo "<script type='text/javascript'>window.location.href = 'home.php';</script>";
        }
    } else {
        echo "<script>alert('Submission deadline is 02/26/2021 12:00:00')</script>";
        echo "<script type='text/javascript'>window.location.href = 'home.php';</script>";
    }
}
#echo "<script type='text/javascript'>window.location.href = 'home.php';</script>";  


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
            /* width: 420px!important; */
            height: 120px;
            border-radius: 8px !important;
        }



        @media (max-width:1200px) {
            /* textarea {
                width: 400px;

                font-size: small;
            } */

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
            .table-responsive table tbody tr {
                display: flex;
                flex-direction: row;
                flex-wrap: wrap;
                justify-content: flex-start;
                align-items: center;


            }
        }

        @media (max-width:400px) {
            .table-responsive table tbody tr {
                display: flex;
                flex-direction: row;
                flex-wrap: wrap;
                justify-content: flex-start;
                align-items: center;


            }

            .table-responsive table tbody td .form-group input {
                padding: 0.6rem 1.375rem;
                width: 100%;
                font-size: 14px !important;
                border-radius: 8px;

            }

            .content-wrapper {
                padding: 2.75rem 1rem !important;
            }

            .form-group iframe {
                width: 220px;
                height: 250px;
            }

            .page-header .page-title {
                font-size: 14px;

            }

        }

        /* Style the tab */
        .tab {
            overflow: hidden;
            border: 1px solid #ccc;
            background-color: #f1f1f1;
        }

        /* Style the buttons inside the tab */
        .tab button {
            background-color: inherit;
            float: left;
            border: none;
            outline: none;
            cursor: pointer;
            padding: 14px 16px;
            transition: 0.3s;
            font-size: 17px;
        }

        /* Change background color of buttons on hover */
        .tab button:hover {
            background-color: #ddd;
        }

        /* Create an active/current tablink class */
        .tab button.active {
            background-color: #ccc;
        }
    </style>
</head>



<body>

    <?php include '../dashboardheader.php'; ?>
    <br>





    <!--<h2>Team Registration</h2>-->


    <div class="tab">
        <!--<button class="tablinks" onclick="openCity(event, 'London')">Project Details</button>-->
        <!-- <button class="tablinks" onclick="openCity(event, 'Paris')">Student Details</button> -->

    </div>

    <div id="Tokyo" class="tabcontent" style=" <?php if (isset($_SESSION['team']) || $terms > 0) {
                                                    echo 'display:none;';
                                                } else {
                                                    echo 'display:block';
                                                } ?> ">
        <h3>Project Details</h3>
        <form method="get" enctype="multipart/form-data">

            <?php
            $team_q = mysqli_query($conn, "select * from tbl_team where id = $team_id");
            $row = mysqli_fetch_assoc($team_q);

            ?>
            <tr>
                <td colspan="6">
                    <br>
                    <div>
                        <h6>You will need the following for the competition</h6>
                        <ol>
                            <li>
                                <p>Submission of completed Log Book </p>
                            </li>
                            <li>
                                <p>A video pitch</p>
                            </li>
                            <li>
                                <p>Demonstration of working or non-working prototype in the video pitch </p>
                            </li>
                            <li>
                                <p>Display of Trifold board in the video pitch </p>
                            </li>
                            <li>
                                <p>Registration fee $20 per team (Check made to Eastern Michigan University) </p>
                            </li>
                            <li>
                                <p>A one minute video by student(s) talking about their experience with their invention and /or with EMUiNVENT competition (Optional) </p>
                            </li>
                            <li>
                                <p>Photo Consent form (Download below) signed by the parents should be provided </p>
                            </li>
                            <a href="Photo-video waiver form1.pdf">Download Photo Consent Form</a>
                            <br>
                        </ol>

                        <input type="checkbox" name="terms" id="terms" required <?php if (isset($_SESSION['team']) || $terms > 0) {
                                                                                    echo 'checked';
                                                                                } ?>> I Agree to the Terms & Conditions


                    </div>

                </td>
            </tr>

            <br>
            <tr align="center">
                <td>
                    <div class="form-group">
                        <button type="submit" class="btn btn-success" name="submit_check" style=" <?php if (isset($_SESSION['team']) || $terms > 0) {
                                                                                                        echo 'display:none';
                                                                                                    } ?> ">Submit</button>
                    </div>
                </td>
            </tr>




            <!--</td>
				</tr>-->
        </form>
    </div>

    <div id="London" class="tabcontent" style="<?php if (isset($_SESSION['team'])) {
                                                    echo 'display:block';
                                                }
                                                if (($team_id) > -1) {
                                                    echo 'display:none';
                                                }   ?>">
        <h3>Project Details</h3>
        <form method="post" enctype="multipart/form-data">

            <tr>
                <td colspan="6">
                    <br>
                    <div>
                        <h6>Please check if your team is already been created! If not, please select "Add a team" to proceed further</h6>

                        <div>
                            <label for="studentType">Created Teams List:</label>
                            <select name="team_id" class="form-control" required>
                                <?php
                                $q_t = mysqli_query($conn, "select * from tbl_team where id in (select team_id from tbl_team_mentor where user_id = $mentor_id) and deleted = 0 and year = '$year'");
                                while ($r_t = mysqli_fetch_assoc($q_t)) {
                                ?>
                                    <option value="<?php echo $r_t['id']; ?>"><?php echo $r_t['project_team_name'] ?></option>

                                <?php } ?>
                                <option value="0">Add a team</option>
                            </select>
                        </div>



                    </div>

                </td>
            </tr>
            <br>
            <tr align="center">
                <td>
                    <div class="form-group">
                        <button type="submit" class="btn btn-success" name="submit_team_select">Submit</button>
                    </div>
                </td>
            </tr>




            <!--</td>
				</tr>-->
        </form>
    </div>


    <div id="London" class="tabcontent" style="<?php if ($team_select > 0) {
                                                    echo 'display:block';
                                                }
                                                if (($team_submit) > 0) {
                                                    echo 'display:none';
                                                }   ?>">
        <h3>Project Details</h3>
        <form method="post" enctype="multipart/form-data">

            <?php
            $team_q = mysqli_query($conn, "select * from tbl_team where id = $team_id");
            $row = mysqli_fetch_assoc($team_q);

            ?>
            <tr>
                <td colspan="6">

                    <div>
                        <label for="pwd"><b>Project Title:</b></label>
                        <input type="text" class="form-control" id="studentEmail" name="project_title" required placeholder="Project Title" value="<?php echo $row['project_team_name'] ?>" required>
                    </div>

                </td>
            </tr>

            <br>
            <tr>
                <td colspan="6">

                    <div>
                        <label for="pwd"><b>Project Description:</b></label>
                        <textarea class="form-control" name="project_description" required placeholder="Project Description"><?php echo $row['project_description'] ?></textarea>
                    </div>

                </td>
            </tr>
            <br>
            <tr>
                <td colspan="6">

                    <div>
                        <label for="pwd"><b>Team Name:</b></label>
                        <input type="text" class="form-control" name="team_name" required placeholder="Team Name" value="<?php echo $row['project_team_name'] ?>" required>
                    </div>

                </td>
            </tr>

            <br>
            <tr>
                <td colspan="6">

                    <div>
                        <label for="studentType">Team Category:</label>
                        <select name="category" class="form-control" required>
                            <option>Select Student Grade</option>
                            <option value="K-2" <?php if ($row['category'] == 'K-2') {
                                                    echo 'selected';
                                                } ?>>K-2</option>
                            <option value="3-5" <?php if ($row['category'] == '3-5') {
                                                    echo 'selected';
                                                } ?>>3-5</option>
                            <option value="6-8" <?php if ($row['category'] == '6-8') {
                                                    echo 'selected';
                                                } ?>>6-8</option>
                            <option value="9-12" <?php if ($row['category'] == '9-12') {
                                                        echo 'selected';
                                                    } ?>>9-12</option>

                        </select>
                    </div>

                </td>
            </tr>
            <br>
            <tr>
                <div>
                    <label for="studentType">Students List:</label>
                    <?php $q_m_s = mysqli_query($conn, "select * from tbl_team_member where team_id = $team_id and deleted = 0");
                    $count = mysqli_num_rows($q_m_s);
                    if ($count > 0) {
                    ?>
                        <select class="form-control" multiple readonly>
                            <?php
                            $q_m_s = mysqli_query($con, "select * from tbl_team_member where team_id = $team_id and deleted = 0");
                            while ($r_m_s = mysqli_fetch_assoc($q_m_s)) {
                            ?>
                                <option value="<?php echo $r_m_s['id']; ?>" selected><?php echo $r_m_s['student_first_name'] . ' ' . $r_m_s['student_last_name'] ?></option>

                            <?php } ?>
                        </select>
                    <?php } ?>
                    <select name="student_id[]" class="form-control" multiple="multiple">
                        <option selected>Select the Team Members</option>
                        <?php
                        $q_m = mysqli_query($con, "select tbl_student_mentor.student_id as id, tbl_user.first_name, tbl_user.last_name from tbl_user, tbl_student_mentor, tbl_team_member
																where tbl_user.id = tbl_student_mentor.student_id
																and tbl_student_mentor.mentor_id = $mentor_id
																and tbl_student_mentor.student_id = tbl_team_member.student_id
																and (tbl_team_member.team_id is null  
																or tbl_team_member.team_id in (select id from tbl_team where deleted = 1))");
                        while ($r_m = mysqli_fetch_assoc($q_m)) {
                        ?>
                            <option value="<?php echo $r_m['id']; ?>"><?php echo $r_m['first_name'] . ' ' . $r_m['last_name'] ?></option>

                        <?php } ?>
                    </select>
                </div>
            </tr>

            <br>
            <tr align="center">
                <td>
                    <div class="form-group">
                        <?php if ($team_id > 0) { ?>
                            <input type="text" class="form-control" hidden name="team_id" placeholder="Team Name" value="<?php echo $team_id; ?>" />
                        <?php } ?>

                        <button type="submit" class="btn btn-success" name="<?php if ($team_id < 1) {
                                                                                echo 'submit_team';
                                                                            } else {
                                                                                echo 'submit_update';
                                                                            } ?>"><?php if ($team_id < 1) {
                                                                                                                                                                    echo 'Create';
                                                                                                                                                                } else {
                                                                                                                                                                    echo 'Update';
                                                                                                                                                                } ?></button>
                    </div>
                </td>
            </tr>




            <!--</td>
				</tr>-->
        </form>
    </div>



    <script src="../assets/vendors/js/vendor.bundle.base.js"></script>
    <!-- <script src="./../assets/js/main.js"></script> -->
    <!-- endinject -->
    <!-- Plugin js for this page -->

    <script src="../assets/js/jquery.cookie.js" type="text/javascript"></script>
    <script src="./assets/js/ajax.js" type="text/javascript"></script>
</body>

</html>