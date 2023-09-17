<?php
include('../superadmin/config.php');
session_start();
$url = $_SERVER['REQUEST_URI'];
$id = $_SESSION['id'];
$name = $_SESSION['name'];
$mentor_id = $_SESSION['mentor_id'];

$team_id = $_GET['team_id'];
$name = $_SESSION['name'];
$year = date("Y");
$timezone = date_default_timezone_set('America/New_York');
$date = date('Y-m-d H:i:s');
$today_at_midnight = strtotime('midnight');

$date_check = '2024-02-27 00:00:00';

if (($year) == date("Y")) {
    if ($date <= $date_check) {
        $q_vt = mysqli_query($conn, "select distinct tt.id as team_id,tt.project_team_name as project_name,tt.project_description,tu.first_name, tu.last_name,tt.video_pitch, tt.log_book,tu.email 
    from tbl_team tt, tbl_team_member ttm, tbl_user tu
											where tt.id = $team_id
											and tt.id = ttm.team_id
											and ttm.student_id = $id
											and ttm.student_id = tu.id
                                            and tt.deleted = 0");

        $d_vt = mysqli_fetch_assoc($q_vt);
        $c_vt = mysqli_num_rows($q_vt);
        if ($c_vt > 0) {
            $url = $d_vt['video_pitch'];
            preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $url, $match);
            $youtube_id = $match[1];


            extract($_POST);
            if (isset($_POST['submit'])) {

                if ($video_pitch_link != '') {
                    mysqli_query($conn, "update tbl_team set video_pitch  = '$video_pitch_link' where id = $team_id");
                }
                #echo "<script>alert('out if')</script>";
                if ($_FILES['fileToUpload']['size'] > 0) {
                    #echo "<script>alert('inside if')</script>";
                    $maxsize = 5242880; // 5MB
                    if (isset($_FILES['fileToUpload']['name']) && $_FILES['fileToUpload']['name'] != '') {
                        $name = $_FILES['fileToUpload']['name'];
                        $target_dir = "../test_upload/";
                        $target_file = $target_dir . $_FILES["fileToUpload"]["name"];

                        // Select file type
                        $extension = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

                        // Valid file extensions
                        $extensions_arr = array("mp4", "avi", "3gp", "mov", "mpeg");

                        // Check extension
                        if (in_array($extension, $extensions_arr)) {

                            // Check file size
                            if (($_FILES['fileToUpload']['size'] >= $maxsize) || ($_FILES["fileToUpload"]["size"] == 0)) {
                                $_SESSION['message'] = "File too large. File must be less than 5MB.";
                            } else {
                                // Upload
                                if (move_uploaded_file($_FILES['fileToUpload']['tmp_name'], $target_file)) {
                                    // Insert record
                                    $query = "update tbl_team set video_pitch  = '" . $target_file . "' where id = $team_id";

                                    mysqli_query($conn, $query);
                                    $_SESSION['message'] = "Upload successfully.";
                                }
                            }
                        } else {
                            $_SESSION['message'] = "Invalid file extension.";
                        }
                    } else {
                        $_SESSION['message'] = "Please select a file.";
                    }
                }



                if ($_FILES['log_book']['size'] > 0) {
                    #echo "<script>alert('inside if')</script>";
                    $target_dir = "../test_upload/";
                    $target_file = $target_dir . basename($_FILES["log_book"]["name"]);
                    $doc_path = $_FILES['log_book']['name'];
                    mysqli_query($conn, "update tbl_team set log_book='../test_upload/$doc_path' where id = $team_id");
                }
                move_uploaded_file($_FILES["log_book"]["tmp_name"], $target_file);


                echo "<script type='text/javascript'> document.location = 'home.php'; </script>";
            }
        } else {
            echo "<script>alert('No Such Team Available')</script>";
        }
    } else {
        echo "<script>alert('Submission deadline is 02/26/2021 12:00:00')</script>";
        echo "<script type='text/javascript'>window.location.href = 'home.php';</script>";
    }
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
        .table th {
            font-size: 13px !important;


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

        .form-control {
            width: 100%;
        }

        .form-group iframe {
            width: 300px;
            height: 300px;
        }

        select {

            display: block;
            width: 5%;
            padding: 0.2rem .2rem 0.2rem 0.2rem;
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
    </style>
</head>

<body>



    <?php include '../dashboardheader.php'; ?>
    <!-- partial -->
    <br>

    <div class="container justify-content-center  ">
        <div class="row justify-content-center">
            <div class="col-7">





                <!--<div class="form-group">
                <label for="studentType">Select Account Type:</label>
                <select class="form-control" id="accountType">
                    <option>Select account type</option>
                    <option value="superUser">Super User</option>
                    <option value="administrator">Administrator</option>
                    <option value="student">Student</option>
                </select>
             </div>-
			    <table  class="table table-borderless" style="margin-right: 547px;margin-bottom: -52px;margin-right: -474px;">
				<tr>
				<td colspan="-4">
				<div class="form-group">
					<iframe frameborder="0" height="100" width="100" 
														src="https://www.youtube.com/embed/sA9DwvbQ-hI">
													  </iframe>
                </div>
			    	</td>
			    	</tr>		
			    </table>-->
                <?php $q_team = mysqli_query($conn, "select distinct tt.id as team_id,tt.project_team_name as project_name,tt.category,tt.project_description,tt.video_pitch, tt.log_book
											from tbl_team tt, tbl_team_mentor ttm, tbl_team_member tm 
											where tm.student_id = $id 
											and tt.id = $team_id
											and tt.id = ttm.team_id
											and tt.deleted = 0
											

									");

                $r_team = mysqli_fetch_assoc($q_team);            ?>
                <div class="form-group">
                    <p>Project Name: <a href="viewteams.php?team_id=<?php echo $team_id; ?>"><?php echo $r_team['project_name']; ?></a> </p>
                    <p>Team Category : <?php echo $r_team['category']; ?> </p>
                    <?php if ($r_team['log_book']) { ?>
                        <p>Team Logbook : <a href="http://emuinvent.emuem.org/Team/<?php echo $r_team['log_book'] ?>">LogBook</a> </p>
                    <?php } ?>
                    <?php if ($d_vt['video_pitch']) { ?>
                        <div class="col-9">
                            <table class="table table-borderless">
                                <br>
                                <h3> Video Pitch:</h3>
                                <br>
                                <br>
                                <?php if ($youtube_id == '') { ?>
                                    <div class="form-group">
                                        <video width="300" height="300" controls>
                                            <source src="<?php echo $d_vt['video_pitch'] ?>" type="video/mp4">
                                            <source src="<?php echo $d_vt['video_pitch'] ?>" type="video/ogg">
                                        </video>
                                    </div>
                                <?php } else { ?>
                                    <div class="form-group">
                                        <iframe width="300" height="300" src="https://www.youtube.com/embed/<?php echo $youtube_id ?>" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                    </div>
                                <?php } ?>
                            </table>
                        </div>
                    <?php } ?>
                    <p>IMPORTANT- Don't forget to click the Update button at the button to save changes</p>
                </div>
            </div>
        </div>
        <hr style="margin-left: -100px;width:100%">
        <div class="row justify-content-center">
            <div class="col-6">
                
                <h3 > Upload Photo Consent Forms by editing Team members:</h3>
                <a class="nav-link" href="Photo-video waiver form1.pdf" target="_blank">Download Photo Consent Form</a>
                <?php
                $t_q = mysqli_query($conn, "select * from tbl_team_member where team_id = $team_id and deleted=0");
                $c_r_r = mysqli_num_rows($t_q); ?>
                <table class="table table-borderless" style="margin-left: -275px;
                         width: 192%;
                         margin-top:<?php if (isset($d_vt['video_pitch'])) {
                                        echo '-150px';
                                    } else {
                                        echo '-300px';
                                    }
                                    if ($c_r_r < 1) {
                                        echo '0px';
                                    } ?>">
                    <thead class="thead-dark">
                        <tr>
                            <th colspan="10"> Current Team Members </th>
                        </tr>
                    </thead>


                    <?php
                    $t_q = mysqli_query($conn, "select * from tbl_team_member where team_id = $team_id and deleted=0");
                    $i = 1;
                    while ($row = mysqli_fetch_assoc($t_q)) {

                    ?>






                        <tr>

                            <td>


                                <!--div class="top-row"-->
                                <div>
                                    <label>
                                        First Name
                                    </label>
                                    <input type="text" class="form-control" readonly autocomplete="off" value="<?php echo $row['student_first_name'] ?>" name="student_first_name" />
                                </div>
                            </td>
                            <br>
                            <td>
                                <div>
                                    <label>
                                        Last Name
                                    </label>
                                    <input type="text" readonly class="form-control" autocomplete="off" value="<?php echo $row['student_last_name'] ?>" name="student_last_name" />
                                </div>
                            </td>
                            <br>
                            <td>
                                <div>
                                    <label for="studentType">Student Grade:</label>
                                    <select name="student_grade" class="form-control" readonly>

                                        <option value="<?php echo $row['student_grade'] ?>"><?php echo $row['student_grade'] ?></option>
                                        <option>Select Student Grade</option>
                                        <option value="K">K</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                        <option value="6">6</option>
                                        <option value="7">7</option>
                                        <option value="8">8</option>
                                        <option value="9">9</option>
                                        <option value="10">10</option>
                                        <option value="11">11</option>
                                        <option value="12">12</option>

                                    </select>
                                </div>
                            </td>
                            <br>
                            <td>
                                <div>
                                    <label>
                                        T-Shirt Size
                                    </label>
                                    <select name="student_tshirt" class="form-control" readonly>
                                        <option value="<?php echo $row['t_shirt_size'] ?>"><?php echo $row['t_shirt_size'] ?></option>
                                        <option>Select Student Grade</option>
                                        <option value="Youth Small">Youth Small</option>
                                        <option value="Youth Medium">Youth Medium</option>
                                        <option value="Youth Large">Youth Large</option>
                                        <option value="Adult Small">Adult Small</option>
                                        <option value="Adult Medium">Adult Medium</option>
                                        <option value="Adult Large">Adult Large</option>
                                        <option value="Adult X-Large">Adult X-Large</option>


                                    </select>
                                </div>
                            </td>
                            <br>
                            <td>
                                <div>
                                    <label>
                                        School Name
                                    </label>
                                    <input type="text" readonly autocomplete="off" class="form-control" value="<?php echo $row['student_school_name'] ?>" name="student_school_name" />
                                </div>
                            </td>
                            <br>
                            <td>
                                <div>
                                    <label>
                                        School District
                                    </label>
                                    <input type="text" readonly autocomplete="off" class="form-control" value="<?php echo $row['student_school_district'] ?>" name="student_school_district" />
                                </div>

                            </td>



                            <td>
                                <label>Edit</label>
                                <a href="edit_member_details.php?student_id=<?php echo $row['id']; ?>"><button type="submit" class="btn btn-success" name="submit">Edit</button></a>
                                <!--<a onClick="return confirm('Are you sure you want to delete?')" href="set_delete.php?id=<?php echo $row['id']; ?>&table=tbl_team_member&return=home" class="btn btn-success" style="    margin-bottom: -80px;"> Delete</a>-->

                            </td>

                        </tr>







                    <?php $i++;
                    } ?>
                    <tr>
                        <td><a href="add_more_students.php?team_id=<?php echo $team_id; ?>"><button type="button" name="add" id="add" class="btn btn-success">Add More Team Members</button></a></td>
                    </tr>

                </table>

            </div>
        </div>
        <hr style="margin-left: -100px;width:100%">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <table class="table table-borderless" style="margin-left: -110px;">



                    <form method="post" enctype="multipart/form-data">
                        <h3 style="margin-left:-100px"> Upload Video Pitch , LogBook</h3>
                        <p>Youtube link is preferred for the Video Pitch</p>
                        <tr>
                            <td colspan="6">

                                <div>
                                    <label for="pwd"><b>Upload Video Pitch:</b></label>
                                    <input type="file" class="form-control" name="fileToUpload" placeholder="Upload video">
                                    <p>Video Should be less than 5MB</p>
                                </div>
                                <br>
                                <p><b>-OR-</b></p>

                                <div>
                                    <label for="pwd"><b>Update Video Pitch Youtube Link:</b></label>
                                    <input type="text" class="form-control" id="studentEmail" name="video_pitch_link" placeholder="Upload video">
                                </div>

                            </td>
                        </tr>

                        <br>
                        <tr>
                            <td colspan="6">

                                <div>
                                    <label for="pwd"><b>LogBook:</b></label>
                                    <input type="file" class="form-control" id="studentEmail" name="log_book" placeholder="Upload logbook">
                                </div>

                            </td>
                        </tr>




                        <tr>
                            <td>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-success" name="submit">Update</button>
                                </div>
                            </td>
                        </tr>




                        <!--</td>
				</tr>-->
                    </form>
                </table>




            </div>

        </div>
    </div>

   

    <!-- <div class="container d-flex justify-content-center col-md-8">
        <p class="dbtn">
            <button type="button" id="signout-btn" onclick="signOutUser()" class="btn btn-danger"> SignOut </button>
        </p>
    </div> -->
</body>


</html>