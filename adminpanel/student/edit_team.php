

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
            if (!empty($match) && isset($match[1])) {
                $youtube_id = $match[1];
            } else {
                // Handle the case when the YouTube ID is not found or URL is not present.
                $youtube_id = null; // You can set a default value or take appropriate action.
            }


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
                        $filesize = $_FILES['fileToUpload']['size'];
                    $filetmpname = $_FILES["fileToUpload"]["tmp_name"];
                    $filename = $_FILES["fileToUpload"]["name"];
        
                    $fileext = explode('.', $filename);
                    $filenewname = rand(99999, 1000000) . "-" . $filename;
                    $filedestination = './test_upload/' . $filenewname;
                    $fileactualext = strtolower(end($fileext));
                
                       

                        // Valid file extensions
                        $extensions_arr = array("mp4", "avi", "3gp", "mov", "mpeg");

                        // Check extension
                        if (in_array($fileactualext, $extensions_arr)) {

                            // Check file size
                            if (($_FILES['fileToUpload']['size'] >= $maxsize) || ($_FILES["fileToUpload"]["size"] == 0)) {
                                echo "<script>alert('File too large. File must be less than 5MB.')</script>";
                                
                            } else {
                                // Upload
                                if (move_uploaded_file($filetmpname, $filedestination)) {
                                    // Insert record
                                    $query = "update tbl_team set video_pitch  = '" . $filenewname . "' where id = $team_id";

                                    mysqli_query($conn, $query);
                                    $_SESSION['message'] = "Upload successfully.";
                                }
                            }
                        } else {
                            echo "<script>alert('Invalid file extension.')</script>";
                           
                        }
                    } else {
                        echo "<script>alert('Please select a file')</script>";
                       
                    }
                }



                if ($_FILES['log_book']['size'] > 0) {
                    #echo "<script>alert('inside if')</script>";
                    $filesize = $_FILES['log_book']['size'];
                    $filetmpname = $_FILES["log_book"]["tmp_name"];
                    $filename = $_FILES["log_book"]["name"];
        
                    $fileext = explode('.', $filename);
                    $filenewname = rand(99999, 1000000) . "-" . $filename;
                    $filedestination = './test_upload/' . $filenewname;
                    $fileactualext = strtolower(end($fileext));
                  if( move_uploaded_file($filetmpname, $filedestination)){
                    mysqli_query($conn, "update tbl_team set log_book='$filenewname' where id = $team_id");}else{
                        echo "<script>alert('process fail')</script>";
                    }
                }
               


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
                        <div class="col-md-12 grid-margin stretch-card">

                            <div class="table-responsive">
                                <table class="table table  ">

                                    <thead class="thead-dark ">
                                        <tr>
                                            <th colspan="3" style="white-space:nowrap;"> Current Team Members. </th>
                                        </tr>
                                    </thead>

                                    <br>
                                    <?php
                                    $t_q = mysqli_query($conn, "select * from tbl_team_member where team_id = $team_id");
                                    $i = 1;
                                    while ($row = mysqli_fetch_assoc($t_q)) {

                                    ?>
                                        <table class="table tablemember">
                                            <thead class="thead">
                                                <tr>
                                                    <th>Student No</th>
                                                    <th>First Name</th>
                                                    <th>Last Name</th>
                                                    <th>Student Grade</th>
                                                    <th>T-Shirt Size</th>
                                                    <th>Student School Name</th>
                                                    <th>School District</th>
                                                    <th>Edit</th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                                <tr>
                                                    <td><?php echo $i; ?></td>
                                                    <td><?php echo $row['student_first_name']; ?></td>
                                                    <td><?php echo $row['student_last_name']; ?></td>
                                                    <td><?php echo $row['student_grade']; ?></td>
                                                    <td><?php echo $row['t_shirt_size']; ?></td>
                                                    <td><?php echo $row['student_school_name']; ?></td>
                                                    <td><?php echo $row['student_school_district']; ?></td>
                                                    <td>
                                                        <a href="edit_member.php?student_id=<?php echo $row['id']; ?>">
                                                            <button type="button" class="btn btn-success" name="submit">Edit</button>
                                                        </a>
                                                    </td>
                                                </tr>
                                                <?php $i++; ?>
                                            <?php } ?>
                                            <tr>
                                                <td colspan="8">
                                                    <a href="add_student.php?team_id=<?php echo $team_id; ?>">
                                                        <button type="button" name="add" class="btn btn-success">Add More Team Members</button>
                                                    </a>
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>

                            </div>

                        </div>







                    </div>
                    <div class="row">
                        <div class="col-md-7 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">

                                    <h4 class="form-heading">Upload Video Pitch , LogBook</h4>
                                    <p>Youtube link is preferred for the Video Pitch</p>
                                    <table class="table table-borderless">



                                    <form method="post" enctype="multipart/form-data">
                     
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






                    </div>
                </div>
            </div>

        </div>
    </div>

    <script>
        function func(SelectedValue, Id, value) {

            if (value == 'photo_consent') {

                $.ajax({
                    type: 'POST',
                    url: './api.php?action=update_consent',
                    dataType: "json",
                    data: 'student_id=' + Id + '&photo_consent=' + SelectedValue,
                    success: function(resp) {
                        console.log(resp.status);

                        if (resp.status == "Success") {

                            alert(resp.msg);

                        } else if (resp.status == "Failed") {

                            alert(resp.msg);

                        }
                    }
                });

            }

            if (value == 'photo_consent_form') {
                //alert(value);

                var input = document.getElementById("photo_form");

                //alert('hi');
                file = input.files[0];
                //alert(file)
                //alert('hi');
                formData = new FormData();
                if (!!file.type.match(/pdf.*/)) {
                    //alert('inside if');
                    formData.append("photo_form", file);
                    formData.append("id", Id);
                    $.ajax({
                        url: "api.php?action=photo_consent_form",
                        type: "POST",
                        dataType: "json",
                        data: formData,
                        processData: false,
                        contentType: false,
                        success: function(resp) {
                            if (resp.status == "Success") {
                                // location.reload();
                                alert(resp.msg);
                            } else if (resp.status == "Failed") {

                                alert(resp.message);
                            }
                        }
                    });
                } else {
                    alert("not a valid image!");

                }

                //}



            }
        }
    </script>
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