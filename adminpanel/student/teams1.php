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
$date_check = '2023-09-27 00:00:00';
echo $date;
if (($year) == date("Y")) {
    if ($date <= $date_check) {
        echo 'isnide';
        $student = 0;
        $upload = 0;
        $team_id = -1;
        $team_select = 0;
    






        if (isset($_POST['submit_team'])) {
            $year = date("Y");
            $project_description = mysqli_real_escape_string($conn, $_POST['project_description']);
            $team_name= mysqli_real_escape_string($conn, $_POST['team_name']);
            $category= mysqli_real_escape_string($conn, $_POST['category']);    
            
            #echo 'tesitng'.$year;
          
            if (mysqli_query($conn, "insert into tbl_team (project_team_name,project_description,category,year) values ('$team_name', '$project_description','$category','$year')")) {
                $team_id = mysqli_insert_id($conn);
                $team_q = mysqli_query($conn, "insert into tbl_team_mentor values (NULL,$team_id,$mentor_id,'','','')");
                if ($team_q) {
                    $student = 1;
                    $team_submit = 1;
                    if(isset($_POST['student_id']) && !empty($_POST['student_id'])) {
                    foreach ($_POST['student_id'] as $p) {
                        //$q_u = mysqli_query($conn, "select * from tbl_user where id= $p");
                        //$r_u = mysqli_fetch_assoc($q_u);
                        mysqli_query($conn, "INSERT INTO tbl_team_member (team_id , student_id) VALUES ($team_id, $p)");
                      

                    // Check if the student's ID exists in tbl_years table
                    $checkQuery = "SELECT COUNT(*) AS count FROM tbl_years WHERE user_id = $p";
                    $checkResult = mysqli_query($conn, $checkQuery);
                    $row = mysqli_fetch_assoc($checkResult);
                    $count = $row['count'];

                    if ($count == 0) {
                       // If student's ID is not in the table, insert a new record for the current year
                       $insertQuery = "INSERT INTO tbl_years (user_id, current_year) VALUES ($p, $year)";
                       mysqli_query($conn, $insertQuery);
                    } else {
                       // Check if the current year is already present for the student
                       $yearCheckQuery = "SELECT COUNT(*) AS yearCount FROM tbl_years WHERE user_id = $p AND current_year = $year";
                       $yearCheckResult = mysqli_query($conn, $yearCheckQuery);
                       $yearRow = mysqli_fetch_assoc($yearCheckResult);
                       $yearCount = $yearRow['yearCount'];
                    
                       if ($yearCount == 0) {
                          // If current year is not present, insert a new record for the current year
                          $insertYearQuery = "INSERT INTO tbl_years (user_id, current_year) VALUES ($p, $year)";
                          mysqli_query($conn, $insertYearQuery);
                       }
                    }

                    }}
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
            $project_description = mysqli_real_escape_string($conn, $_POST['project_description']);
            $team_name= mysqli_real_escape_string($conn, $_POST['team_name']);
            $category= mysqli_real_escape_string($conn, $_POST['category']);  
            #echo 'inside the script';

            $sql = mysqli_query($conn, "update tbl_team set project_team_name ='$team_name' ,
                                            project_description = '$project_description',
											category = '$category' where id = $team_id");


            foreach ($_POST['student_id'] as $p) {
                //$q_u = mysqli_query($conn, "select * from tbl_user where id= $p");
                //$r_u = mysqli_fetch_assoc($q_u);
                mysqli_query($conn, "INSERT INTO tbl_team_member (team_id , student_id) VALUES ($team_id, $p)");
                #echo "update tbl_team_member set team_id = $team_id where student_id = $p";
                $checkQuery = "SELECT COUNT(*) AS count FROM tbl_years WHERE user_id = $p";
                $checkResult = mysqli_query($conn, $checkQuery);
                $row = mysqli_fetch_assoc($checkResult);
                $count = $row['count'];

                if ($count == 0) {
                   // If student's ID is not in the table, insert a new record for the current year
                   $insertQuery = "INSERT INTO tbl_years (user_id, current_year) VALUES ($p, $year)";
                   mysqli_query($conn, $insertQuery);
                } else {
                   // Check if the current year is already present for the student
                   $yearCheckQuery = "SELECT COUNT(*) AS yearCount FROM tbl_years WHERE user_id = $p AND current_year = $year";
                   $yearCheckResult = mysqli_query($conn, $yearCheckQuery);
                   $yearRow = mysqli_fetch_assoc($yearCheckResult);
                   $yearCount = $yearRow['yearCount'];
                
                   if ($yearCount == 0) {
                      // If current year is not present, insert a new record for the current year
                      $insertYearQuery = "INSERT INTO tbl_years (student_id, current_year) VALUES ($p, $year)";
                      mysqli_query($conn, $insertYearQuery);
                   }
                }
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

    <div id="Tokyo" class="tabcontent mx-5 px-4 justify-content-center w-100"  >
        <h3>Project Details</h3>
        <form  id="check_click" enctype="multipart/form-data">

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

                        <input type="checkbox" name="terms" id="terms" required > I Agree to the Terms & Conditions
                        <input type="hidden" name="mentorid" id="mentorid" value="<?php echo $mentor_id ?>" > 


                    </div>

                </td>
            </tr>

            <br>
            <tr align="center">
                <td>
                    <div class="form-group">
                        <button type="submit" class="btn btn-success" name="submit_check" >Submit</button>
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
    <script src="./assets/js/ajax.js?v=1" type="text/javascript"></script>
</body>

</html>