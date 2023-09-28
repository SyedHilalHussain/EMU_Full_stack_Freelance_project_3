<?php
include('../superadmin/config.php');
session_start();
$url = $_SERVER['REQUEST_URI'];
$id = $_SESSION['id'];

$year = date("Y");


$timezone = date_default_timezone_set('America/New_York');
$date = date('Y-m-d H:i:s');
$today_at_midnight = strtotime('midnight');

$date_check = '2024-02-27 00:00:00';

if (($year) == date("Y")) {
    if ($date <= $date_check) {
    } else {
        echo "<script>alert('Submission deadline is 02/26/2025 12:00:00')</script>";
        echo "<script type='text/javascript'>window.location.href = 'home.php';</script>";
    }
}




if (isset($_GET['student_id'])) {
    $student_id = $_GET['student_id'];

    $name = $_SESSION['name'];

    $q = mysqli_query($conn, "select * from student where student_id = $student_id");








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

        <div class="container-scroller ">

            <?php include '../dashboardheader.php'; ?>
            <!-- partial -->
            
       

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

            <?php if (mysqli_num_rows($q) > 0) {
                $r = mysqli_fetch_assoc($q);
                $url = $r['video_exp_link'];
                preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $url, $match);
                if (!empty($match) && isset($match[1])) {
                    $youtube_id = $match[1];
                } else {
                    // Handle the case when the YouTube ID is not found or URL is not present.
                    $youtube_id = null; // You can set a default value or take appropriate action.
                }    ?>
                <div class="container d-flex justify-content-center col-md-10 px-5">
               
                    <div class="col-9">
                    <div class=" justify-content-end d-flex ">
          
          <nav aria-label="breadcrumb">
      <ul class="breadcrumb border-0">
      <li class="breadcrumb-item active" aria-current="page">
      <button id="reloadButton" class="btn page-title-icon btn-sm text-white" onclick="window.history.back() ">Back</button>
          </li>
        </ul>
       </nav>
    

        </div>

                        <form id="edit_members" enctype="multipart/form-data">
                        <div style="display: none;">    <input type="hidden" name="student_id" value="<?php echo $student_id ?>"></div>
                            
                            <h3> Student Details:</h3>
                          

                            <table class="table table-borderless">

                                <thead class="thead-dark">
                                    <tr>
                                        <th colspan="3"> Basic Information </th>
                                    </tr>
                                </thead>

                                <tr>
                                    <td>
                                        <div class="form-group">
                                            <label for="email"> <b> Student First Name: </b> </label>
                                            <input type="text" class="form-control" name="first_name" id="student_first_name" value="<?php echo $r['student_first_name'] ?>">
                                        </div>
                                    </td>

                                </tr>
                                <tr>

                                    <td>
                                        <div class="form-group">
                                            <label for="email"><b> Student Last Name:</b></label>
                                            <input type="text" class="form-control" name="last_name" id="student_last_name" value="<?php echo $r['student_last_name'] ?>">
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div>
                                            <label for="studentType" class="mb-2">Student Grade:</label>
                                            <select name="student_grade" class="form-control" required>
                                                <option>Select Student Grade</option>
                                                <option value="K" <?php if ($r['student_grade'] == 'K') {
                                                                        echo 'selected';
                                                                    } ?>>K</option>
                                                <option value="1" <?php if ($r['student_grade'] == '1') {
                                                                        echo 'selected';
                                                                    } ?>>1</option>
                                                <option value="2" <?php if ($r['student_grade'] == '2') {
                                                                        echo 'selected';
                                                                    } ?>>2</option>
                                                <option value="3" <?php if ($r['student_grade'] == '3') {
                                                                        echo 'selected';
                                                                    } ?>>3</option>
                                                <option value="4" <?php if ($r['student_grade'] == '4') {
                                                                        echo 'selected';
                                                                    } ?>>4</option>
                                                <option value="5" <?php if ($r['student_grade'] == '5') {
                                                                        echo 'selected';
                                                                    } ?>>5</option>
                                                <option value="6" <?php if ($r['student_grade'] == '6') {
                                                                        echo 'selected';
                                                                    } ?>>6</option>
                                                <option value="7" <?php if ($r['student_grade'] == '7') {
                                                                        echo 'selected';
                                                                    } ?>>7</option>
                                                <option value="8" <?php if ($r['student_grade'] == '8') {
                                                                        echo 'selected';
                                                                    } ?>>8</option>
                                                <option value="9" <?php if ($r['student_grade'] == '9') {
                                                                        echo 'selected';
                                                                    } ?>>9</option>
                                                <option value="10" <?php if ($r['student_grade'] == '10') {
                                                                        echo 'selected';
                                                                    } ?>>10</option>
                                                <option value="11" <?php if ($r['student_grade'] == '11') {
                                                                        echo 'selected';
                                                                    } ?>>11</option>
                                                <option value="12" <?php if ($r['student_grade'] == '12') {
                                                                        echo 'selected';
                                                                    } ?>>12</option>

                                            </select>
                                        </div>
                                    </td>
                                </tr>

                                <tr>
                                    <td>
                                        <div>
                                            <label class="mb-2">
                                                T-Shirt Size
                                            </label>
                                            <select name="student_tshirt" class="form-control" required>
                                                <option>Select Student Shirt Size</option>
                                                <option value="Youth Small" <?php if ($r['t_shirt_size'] == 'Youth Small') {
                                                                                echo 'selected';
                                                                            } ?>>Youth Small</option>
                                                <option value="Youth Medium" <?php if ($r['t_shirt_size'] == 'Youth Medium') {
                                                                                    echo 'selected';
                                                                                } ?>>Youth Medium</option>
                                                <option value="Youth Large" <?php if ($r['t_shirt_size'] == 'Youth Large') {
                                                                                echo 'selected';
                                                                            } ?>>Youth Large</option>
                                                <option value="Adult Small" <?php if ($r['t_shirt_size'] == 'Adult Small') {
                                                                                echo 'selected';
                                                                            } ?>>Adult Small</option>
                                                <option value="Adult Medium" <?php if ($r['t_shirt_size'] == 'Adult Medium"') {
                                                                                    echo 'selected';
                                                                                } ?>>Adult Medium</option>
                                                <option value="Adult Large" <?php if ($r['t_shirt_size'] == 'Adult Large') {
                                                                                echo 'selected';
                                                                            } ?>>Adult Large</option>
                                                <option value="Adult X-Large" <?php if ($r['t_shirt_size'] == 'Adult X-Large') {
                                                                                    echo 'selected';
                                                                                } ?>>Adult X-Large</option>


                                            </select>
                                        </div>
                                    </td>
                                </tr>

                                <tr>

                                    <td>
                                        <div>
                                            <label class="mb-2">
                                                School Name
                                            </label>
                                            <input type="text" required autocomplete="off" class="form-control" name="student_school_name" value="<?php echo $r['student_school_name'] ?>" />
                                        </div>
                                    </td>
                                </tr>

                                <tr>

                                    <td>
                                        <div>
                                            <label class="mb-2">
                                                School District
                                            </label>
                                            <input type="text" required autocomplete="off" class="form-control" name="student_school_district" value="<?php echo $r['student_school_district'] ?>" />
                                        </div>

                                    </td>
                                </tr>
                                <tr>
                                    <td>

                                        <div>

                                            <label for="pwd">Parent has given consent to photograph the student:</label>
                                            <input type="radio" name="photo_consent" value="1" <?php if (($r['photo_consent']) == 1) {
                                                                                                    echo 'Checked';
                                                                                                } ?> />Yes
                                            <input type="radio" name="photo_consent" value="0" <?php if (($r['photo_consent']) == 0) {
                                                                                                    echo 'Checked';
                                                                                                } ?> /> No
                                        </div>

                                    </td>
                                </tr>
                                <tr>

                                    <td>

                                        <div>
                                            <label for="pwd">Attach your photo consent form:</label>
                                            <p><a class="nav-link" href="Photo-video waiver form1.pdf" target="_blank">Download the original Photo Consent Form to sign and upload</a></p>
                                            <?php if (($r['photo_consent_form']) != '') { ?>
                                                <p><a href="<?php echo $r['photo_consent_form'] ?>" target="_blank">Uploaded Consent Form - <?php echo $r['photo_consent_form'] ?></a></p>
                                            <?php } ?>
                                            <input type="file" class="form-control" id="studentEmail" name="log_book" placeholder="Upload photo consent form">
                                        </div>

                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div>
                                            <label for="pwd" class="my-2">Please record a minute-long video about your experience with the invention process (optional) :</label>
                                            <br>
                                            <div>
                                                <label for="pwd" class="my-2">Upload Recording File :</label>
                                                <input type="file" class="form-control" name="fileToUpload" placeholder="Upload video">
                                                <p>Video Should be less than 5MB</p>
                                            </div>
                                            <br>
                                            <p><b>-OR-</b></p>

                                            <div>
                                                <label for="pwd">Upload Youtube Video link:</label>
                                                <input type="text" class="form-control" id="video_exp_link" name="video_exp_link" placeholder="Youtube video Link" value="<?php echo $r['video_exp_link'] ?>">
                                            </div>
                                        </div>
                                    </td>
                                </tr>



                                <!-- <tr>
                    <td colspan="2">
                        <div class="form-group">
                            <label for="studentType"><b>t_shirt_size:</b></label>
                            <select class="form-control" id="SelectDepartment" name="t_shirt_size">
							<option selected value="<?php echo $r['t_shirt_size'] ?>"><?php echo $r['t_shirt_size'] ?></option>
                                <option value="Professional">Professional/Engineers</option>
                                <option value="Faculty">Faculty </option>
								<option value="K-12 Teachers">K-12 Teachers </option>
                                <option value="Student">Student</option>
                                <option value="Pre-Service Students">Pre-Service Students</option>
								<option value="Others">Others</option>
                            </select>
                        </div>

                    </td>
                </tr>-->



                            </table>

                            <div id="alertBox"> </div>
                            <button type="submit" class="btn btn-primary" name="submit">Submit</button>
                        </form>

                        <?php if ($r['video_exp_link']) { ?>
                            <div class="col-9">
                                <table class="table table-borderless">
                                    <br>
                                    <h3> Optional Video :</h3>
                                    <br>
                                    <br>
                                    <?php if ($youtube_id == '') { ?>
                                        <div class="form-group">
                                            <video width="300" height="300" controls>
                                                <source src="<?php echo $r['video_exp_link'] ?>" type="video/mp4">
                                                <source src="<?php echo $r['video_exp_link'] ?>" type="video/ogg">
                                            </video>
                                        </div>
                                    <?php } else { ?>
                                        <div class="form-group">
                                            <iframe width="300" height="300" src="https://www.youtube.com/embed/<?php echo $youtube_id ?>" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                        </div>
                                    <?php } ?>
                                </table>
                            </div>
                        <?php }
                    } else {

                        ?>
                        <div class="container d-flex justify-content-center col-md-10 px-5">

                            <div class="col-9">
                                <form id="create_members" enctype="multipart/form-data">
                                    <input type="hidden" name="student_id" value="<?php echo $student_id ?>">
                                    <br>
                                    <h3> Student Details:</h3>
                                    <br>

                                    <table class="table table-borderless">

                                        <thead class="thead-dark">
                                            <tr>
                                                <th colspan="3"> Basic Information </th>
                                            </tr>
                                        </thead>

                                        <tr>
                                            <td>
                                                <div class="form-group">
                                                    <label for="email"> <b> Student First Name: </b> </label>
                                                    <input type="text" class="form-control" name="first_name" id="student_first_name" value="" required>
                                                </div>
                                            </td>

                                        </tr>
                                        <tr>

                                            <td>
                                                <div class="form-group">
                                                    <label for="email"><b> Student Last Name:</b></label>
                                                    <input type="text" class="form-control" name="last_name" id="student_last_name" value="" required>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div>
                                                    <label for="studentType" class="mb-2">Student Grade:</label>
                                                    <select name="student_grade" class="form-control" required>
                                                        <option value="">Select Student Grade</option>
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
                                        </tr>

                                        <tr>
                                            <td>
                                                <div>
                                                    <label class="mb-2">
                                                        T-Shirt Size
                                                    </label>
                                                    <select name="student_tshirt" class="form-control" required>
                                                        <option value="">Select Student Shirt Size</option>
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
                                        </tr>

                                        <tr>

                                            <td>
                                                <div>
                                                    <label class="mb-2">
                                                        School Name
                                                    </label>
                                                    <input type="text" required autocomplete="off" class="form-control" name="student_school_name" value=""  />
                                                </div>
                                            </td>
                                        </tr>

                                        <tr>

                                            <td>
                                                <div>
                                                    <label class="mb-2">
                                                        School District
                                                    </label>
                                                    <input type="text" required autocomplete="off" class="form-control" name="student_school_district" value="" />
                                                </div>

                                            </td>
                                        </tr>
                                        <tr>
                                            <td>

                                                <div>

                                                    <label for="pwd">Parent has given consent to photograph the student:</label>
                                                    <input type="radio" name="photo_consent" value="1" required/>Yes
                                                    <input type="radio" name="photo_consent" value="0" required/> No
                                                </div>

                                            </td>
                                        </tr>
                                        <tr>

                                            <td>

                                                <div>
                                                    <label for="pwd">Attach your photo consent form:</label>
                                                    <p><a class="nav-link" href="Photo-video waiver form1.pdf" target="_blank">Download the original Photo Consent Form to sign and upload</a></p>

                                                    <input type="file" class="form-control" id="studentEmail" name="log_book" placeholder="Upload photo consent form">
                                                </div>

                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div>
                                                    <label for="pwd" class="my-2">Please record a minute-long video about your experience with the invention process (optional) :</label>
                                                    <br>
                                                    <div>
                                                        <label for="pwd" class="my-2">Upload Recording File :</label>
                                                        <input type="file" class="form-control" name="fileToUpload" placeholder="Upload video">
                                                        <p>Video Should be less than 5MB</p>
                                                    </div>
                                                    <br>
                                                    <p><b>-OR-</b></p>

                                                    <div>
                                                        <label for="pwd">Upload Youtube Video link:</label>
                                                        <input type="text" class="form-control" id="video_exp_link" name="video_exp_link" placeholder="Youtube video Link" value="">
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>



                                        <!-- <tr>
                                     <td colspan="2">
                                         <div class="form-group">
                                             <label for="studentType"><b>t_shirt_size:</b></label>
                                             <select class="form-control" id="SelectDepartment" name="t_shirt_size">
					                    		<option selected value="<?php echo $r['t_shirt_size'] ?>"><?php echo $r['t_shirt_size'] ?></option>
                                                 <option value="Professional">Professional/Engineers</option>
                                                 <option value="Faculty">Faculty </option>
					                    			<option value="K-12 Teachers">K-12 Teachers </option>
                                                 <option value="Student">Student</option>
                                                 <option value="Pre-Service Students">Pre-Service Students</option>
					                    			<option value="Others">Others</option>
                                             </select>
                                         </div>

                                     </td>
                                    </tr>-->



                                    </table>

                                    <div id="alertBox"> </div>
                                    <button type="submit" class="btn btn-primary" name="submit">Submit</button>
                                </form>
                            </div>
                        </div>
<?php  }  ?>
                    </div>
                </div>

                <!-- <div class="container d-flex justify-content-center col-md-8">
        <p class="dbtn">
            <button type="button" id="signout-btn" onclick="signOutUser()" class="btn btn-danger"> SignOut </button>
        </p>
    </div> -->





                <!-- TODO: Add SDKs for Firebase products that you want to use
     https://firebase.google.com/docs/web/setup#config-web-app -->
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

        <script src="../assets/js/todolist.js"></script>
        <script src="./assets/js/ajax.js?v=2" type="text/javascript"></script>
        <!-- End custom js for this page -->
    </body>

    </html>

<?php  
                } else {
                    echo '<h1 class="text-center" >No Record Found</h1>';
                }    ?>