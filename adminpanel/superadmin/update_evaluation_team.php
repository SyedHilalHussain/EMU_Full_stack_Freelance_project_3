<?php
session_start();
include 'config.php';



$id=base64_decode($_GET['judge_id']);

$team_id = base64_decode($_GET['team_id']);

// if($type=='SuperUser'){
$v_q = mysqli_query($conn, "select * from tbl_team where id = $team_id");
$v_d = mysqli_fetch_assoc($v_q);
$q_e = mysqli_query($conn,"select * from tbl_judge_assessment where user_id = $id and team_id = $team_id");
$d_e = mysqli_fetch_assoc($q_e);
$e_id = $d_e['id'];
$video_pitch = $v_d['video_pitch'];
$url = $video_pitch;
preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $url, $match);
if (!empty($match) && isset($match[1])) {
    $youtube_id = $match[1];
} else {
    // Handle the case when the YouTube ID is not found or URL is not present.
    $youtube_id = null; // You can set a default value or take appropriate action.
}
// }elseif($type=='Judge'){
//     // $id = $_SESSION['id'];
//     $e_id = $_GET['team_id'];
//     // $name=$_SESSION['name'];
//     $q_e = mysqli_query($conn,"select * from tbl_judge_assessment where user_id = $e_id");
//     $d_e = mysqli_fetch_assoc($q_e);
   
//     $v_q = mysqli_query($conn,"select * from tbl_team where id = $e_id");
//     $v_d = mysqli_fetch_assoc($v_q);
    
//     $video_pitch = $v_d['video_pitch'];
//                     $url = $video_pitch;
//                     preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $url, $match);
//                     $youtube_id = $match[1];

// }



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

        }

        .update_table td {
            font-size: 12px !important;

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
        .form-group iframe{
            width: 500px;
            height: 500px;
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
            .form-group iframe{
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
                        <span class="subtitle">Team Evaluation</span>
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
                <div class="content-wrapper-inside">
                    <div class="row">
                        <div class="col-md-6 col-sm-12 grid-margin align-item-center justify-content-center">
                            <div class="card">
                                <div class="card-body">
                                    <h3>Team Information</h3>
                                    <div class="table-responsive">
                                        <table class="table team_table update_table">
                                            <thead>
                                                <tr>
                                                    <th scope="col">Team Name</th>
                                                    <th scope="col">Project Description</th>
                                                    <th scope="col">Team Category</th>
                                                    <th scope="col">LogBook</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $team_id = $d_e['team_id'];
                                                $q_team = mysqli_query($conn, "
                                                                         SELECT DISTINCT
                                                tt.id AS team_id,
                                                tt.project_team_name AS project_name,
                                                tt.category,
                                                tt.project_description,
                                                tu.first_name,
                                                tu.last_name,
                                                tt.video_pitch,
                                                tt.log_book
                                            FROM
                                                tbl_team tt
                                                INNER JOIN tbl_team_mentor ttm ON tt.id = ttm.team_id
                                                INNER JOIN tbl_user tu ON ttm.user_id = tu.id
                                            WHERE
                                                tt.id = $team_id
                                        ");

                                                while ($r_team = mysqli_fetch_assoc($q_team)) {
                                                    $team_id = $r_team['team_id'];
                                                    $team_m_q = mysqli_query($conn, "SELECT GROUP_CONCAT(s.student_first_name) AS members
                                                    FROM tbl_team_member tm
                                                    JOIN student s ON tm.student_id = s.student_id
                                                    WHERE tm.team_id = $team_id");
                                                    $team_m_r = mysqli_fetch_assoc($team_m_q);
                                                ?>

                                                    <tr>
                                                        <td><?php echo $r_team['project_name']; ?></td>
                                                        <td><?php echo $r_team['project_description']; ?></td>
                                                        <td><?php echo $r_team['category']; ?></td>
                                                        <?php
                                                        if ($r_team['log_book'] != '') {
                                                        ?>
                                                            <td><a href="http://grading.emuem.org/Team/<?php echo $r_team['log_book']; ?>" target="_blank">LogBook</a></td>
                                                        <?php
                                                        } else {
                                                        ?>
                                                            <td>LogBook</td>
                                                        <?php
                                                        }
                                                        ?>
                                                    </tr>
                                                <?php
                                                }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                    <div class="row">
                        <div class="col-md-6 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <h1> <b> Evaluation:</b></h1>
                                    <h4 class="form-heading">Invention Process (45) </h4>
                                    <form class="" id="evaluation_team_update">
                                        <input type="hidden" name="userid" value="<?php echo $id ?>">
                                        <input type="hidden" name="teamid" value="<?php echo $team_id ?>">
                                        <div class="form-group">
                                            <label>Identifying & Understanding: </label>
                                            <select name="identifying_understanding">
                                                <option value="<?php echo $d_e['identifying_understanding'] ?>" selected><?php echo $d_e['identifying_understanding'] ?></option>
                                                <?php

                                                for ($i = 0; $i <= 15; $i = $i + 0.5) {

                                                    echo "<option value=" . $i . ">" . $i . "</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="designing & building"> Designing & Building: </label>
                                            <select name="designing_building">
                                                <option value="<?php echo $d_e['designing_building'] ?>" selected><?php echo $d_e['designing_building'] ?></option>
                                                <?php

                                                for ($i = 0; $i <= 10; $i = $i + 0.5) {

                                                    echo "<option value=" . $i . ">" . $i . "</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="form-group">

                                            <label for="email"> Testing & Refining: </label>
                                            <select name="testing_refinging">
                                                <option value="<?php echo $d_e['testing_refinging'] ?>" selected><?php echo $d_e['testing_refinging'] ?></option>
                                                <?php

                                                for ($i = 0; $i <= 10; $i = $i + 0.5) {

                                                    echo "<option value=" . $i . ">" . $i . "</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="form-group">

                                            <label for="email"> Ideating Process: </label>
                                            <select name="ideating">
                                                <option value="<?php echo $d_e['ideating'] ?>" selected><?php echo $d_e['ideating'] ?></option>
                                                <?php

                                                for ($i = 0; $i <= 10; $i = $i + 0.5) {

                                                    echo "<option value=" . $i . ">" . $i . "</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <h4 class="form-heading">Invention Impact (25)</h4>
                                        <div class="form-group">
                                            <label for="email">Value Proposition:</label>
                                            <select name="value_propoition">
                                                <option value="<?php echo $d_e['value_propoition'] ?>" selected><?php echo $d_e['value_propoition'] ?></option>
                                                <?php

                                                for ($i = 0; $i <= 5; $i = $i + 0.5) {

                                                    echo "<option value=" . $i . ">" . $i . "</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="form-group ">
                                            <label for="email">Market Potential:</label>
                                            <select name="market_potential">
                                                <option value="<?php echo $d_e['market_potential'] ?>" selected><?php echo $d_e['market_potential'] ?></option>
                                                <?php

                                                for ($i = 0; $i <= 5; $i = $i + 0.5) {

                                                    echo "<option value=" . $i . ">" . $i . "</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="email">Social Value: </label>
                                            <select name="social_value">
                                                <option value="<?php echo $d_e['social_value'] ?>" selected><?php echo $d_e['social_value'] ?></option>
                                                <?php

                                                for ($i = 0; $i <= 5; $i = $i + 0.5) {

                                                    echo "<option value=" . $i . ">" . $i . "</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="email">Originality: </label>
                                            <select name="originality">
                                                <option value="<?php echo $d_e['originality'] ?>" selected><?php echo $d_e['originality'] ?></option>
                                                <?php

                                                for ($i = 0; $i <= 10; $i = $i + 0.5) {

                                                    echo "<option value=" . $i . ">" . $i . "</option>";
                                                }
                                                ?>
                                            </select>

                                        </div>
                                        <h4 class="form-heading">Inventor Communication (30)</h4>
                                        <div class="form-group">
                                            <label for="email">LogBook: </label>
                                            <select name="logbook">
                                                <option value="<?php echo $d_e['logbook'] ?>" selected><?php echo $d_e['logbook'] ?></option>
                                                <?php

                                                for ($i = 0; $i <= 5; $i = $i + 0.5) {

                                                    echo "<option value=" . $i . ">" . $i . "</option>";
                                                }
                                                ?>

                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="email">Display Board: </label>
                                            <select name="display_board">
                                                <option value="<?php echo $d_e['display_board'] ?>" selected><?php echo $d_e['display_board'] ?></option>
                                                <?php

                                                for ($i = 0; $i <= 5; $i = $i + 0.5) {

                                                    echo "<option value=" . $i . ">" . $i . "</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="email"> Prototype: </label>
                                            <select name="prototype">
                                                <option value="<?php echo $d_e['prototype'] ?>" selected><?php echo $d_e['prototype'] ?></option>
                                                <?php

                                                for ($i = 0; $i <= 5; $i = $i + 0.5) {

                                                    echo "<option value=" . $i . ">" . $i . "</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="form-group ">
                                            <label for="email"> Online Pitch: </label>
                                            <select name="online_pitch">
                                                <option value="<?php echo $d_e['online_pitch'] ?>" selected><?php echo $d_e['online_pitch'] ?></option>
                                                <?php

                                                for ($i = 0; $i <= 5; $i = $i + 0.5) {

                                                    echo "<option value=" . $i . ">" . $i . "</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="form-group ">
                                            <label for="email"> Q&A: </label>

                                            <textarea placeholder="Questions that are to be asked during Live Q & A" name="question_asked">
							        <?php echo $d_e['question_asked'] ?>
							        </textarea>

                                        </div>


                                        <button type="submit" name="submit" class="btn btn-gradient-success me-2">Submit</button>

                                    </form>
                                </div>
                            </div>
                        </div>



                        <div class="col-md-6 col-sm-12">



<br>
<h3>Video Pitch:</h3>


<?php if ($youtube_id == '') { ?>
    <div class="form-group">
        <video width="500" height="400" controls>
            <source src="<?php echo '../Team/' . $video_pitch ?>" type="video/mp4">
            <source src="<?php echo '../Team/' . $video_pitch ?>" type="video/ogg">
        </video>
    </div>
<?php } else { ?>
    <div class="form-group">
        <iframe src="https://www.youtube.com/embed/<?php echo $youtube_id ?>" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
    </div>
<?php } ?>
<p>Don't forget to click on "Submit Evaluation" to record your evaluation.</p>

</div>


                    </div>
                </div>
            </div>

        </div>
    </div>


    <!-- container-scroller -->
    <footer class="footer">
<?php  include('footer.php') ?>
      </footer>
</body>

</html>