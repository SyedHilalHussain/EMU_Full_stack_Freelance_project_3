<?php
session_start();
require_once('../superadmin/database.php');
$student = 0;
$upload = 0;
$team_id = -1;
$team_select = 0;


class API extends DBConnection
{
    public function __construct()
    {
        parent::__construct();
    }
    public function __destruct()
    {
        parent::__destruct();
    }

    function checkupdate()
    {
        if (isset($_POST['terms'])) {
            $mentor_id = $_POST['mentorid'];
            $student_id = $_POST['studentid'];
            $year = date("Y");
            $content = '';


            $content .= '<h3>Project And Team Details</h3>';
            $content .= '<form id="teamselect" action="#"  >';
            $content .= '<tr><td colspan="6"><br><div>';
            $content .= '<h6>Please check if your team(s) is already been created! If not, please select "Add a team" to proceed further</h6>';
            $content .= '<div><label for="studentType">Created Teams List:</label>';
            $content .= '<input type="hidden" name="mentorid" value="' . $mentor_id . '">';
            $content .= '<input type="hidden" name="studentid" value="' . $student_id . '">';
            $content .= '<select name="team_id" class="form-control" required>';

            $q_t = $this->conn->query("select * from tbl_team where id in (select team_id from tbl_team_mentor where user_id ='$mentor_id') and deleted = 0 and year = '$year'");
            while ($r_t = $q_t->fetch_assoc()) {
                $content .= '<option value="' . $r_t['id'] . '"> ' . $r_t['project_team_name'] . ' </option>';
            }

            $content .= '<option value="0">Add a team</option>';
            $content .= '</select></div></div></td></tr>';
            $content .= '<br><tr align="center"><td><div class="form-group">';
            $content .= '<input type="submit" class="btn btn-success" value="Submit">';
            $content .= '</div></td></tr></form>';

            return $content;
        }
    }
    function teamselect()
    {


        $year = date("Y");
        $team_id = $_POST['team_id'];
        $content = '';
        $mentor_id = $_POST['mentorid'];
        $student_id = $_POST['studentid'];
        $grade_query = $this->conn->query("select * from student where student_id='$student_id'");
        $grade_row = $grade_query->fetch_assoc();
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
        $team_q = $this->conn->query("select * from tbl_team where id = $team_id");
        $no_of_rows = $team_q->num_rows;
        if ($no_of_rows > 0) {
            $row = $team_q->fetch_assoc();
            $content .= '<h3>Project Details</h3>';
            $content .= ' <form method="post" enctype="multipart/form-data">';

            $content .= ' <tr>
                        <td colspan="6">
                
                            <div>
                                <label for="pwd"><b>Project Title:</b></label>
                                <input type="text" class="form-control" id="studentEmail" name="project_title" required placeholder="Project Title" value="' . $row['project_team_name'] . '" required>
                            </div>
                
                        </td>
                    </tr>
                
                    <br>
                    <tr>
                        <td colspan="6">
                
                            <div>
                                <label for="pwd"><b>Project Description:</b></label>
                                <textarea class="form-control" name="project_description" required placeholder="Project Description">' . $row['project_description'] . '</textarea>
                            </div>
                
                        </td>
                    </tr>
                    <br>
                    <tr>
                        <td colspan="6">
                
                            <div>
                                <label for="pwd"><b>Team Name:</b></label>
                                <input type="text" class="form-control" name="team_name" required placeholder="Team Name" value="' . $row['project_team_name'] . '" required>
                            </div>
                
                        </td>
                    </tr>
                
                    <br>
                    <tr>
                        <td colspan="6">
                
                            <div>
                                <label for="studentType">Team Category:</label>
                                <input type="text" class="form-control" name="category" required placeholder="Team Name" value="' . $category . '" required>
                            
                            </div>
                            
                        </td>
                    </tr>
                    <br>
                    <tr>
                        <div>
                            <label for="studentType">Students List:</label>';


            $content .= '<select name="student_id[]" class="form-select" multiple="multiple"><option disabled>Select the Team Members</option>';
            // if(isset($_SESSION['name']) && isset($_SESSION['id'])){
            //     $content .= '<option value='.$_SESSION['id'].' selected>'.$_SESSION['name'].'</option>';
            // $id=$_SESSION['id'];
            // }
            $q_m = $this->conn->query("SELECT tbl_student_mentor.student_id as id, tbl_user.first_name, tbl_user.last_name
                                            FROM tbl_user
                                            JOIN tbl_student_mentor ON tbl_user.id = tbl_student_mentor.student_id
                                            
                                            JOIN student ON tbl_student_mentor.student_id = student.student_id
                                            WHERE tbl_student_mentor.mentor_id = $mentor_id
                                             AND student.student_id NOT IN ( SELECT student_id FROM tbl_team_member WHERE team_id = '$team_id') 
                                              AND
                                              (
                                        (CASE 
                                          WHEN student.student_grade >= 3 AND student.student_grade <= 5 THEN '3-5'
                                          WHEN student.student_grade >= 6 AND student.student_grade <= 8 THEN '6-8'
                                          WHEN student.student_grade >= 9 AND student.student_grade <= 12 THEN '9-12'
                                          ELSE 'K-2'
                                        END) = '$category'
                                      );  ");
            while ($r_m = $q_m->fetch_assoc()) {

                $content .= '<option value="' . $r_m['id'] . '">' . $r_m['first_name'] . ' ' . $r_m['last_name'] . '</option>';
            }
            $content .= '</select></div></tr><div style="color:red; ">Hold down the Ctrl (windows) or Command (Mac) button to select multiple options.</div> 
                                    <br> 
                                    <div>
                                    <label for="studentType">Current Team members:</label> ';


            $q_m_s = $this->conn->query("SELECT *
                                    FROM tbl_team_member tm
                                    JOIN student s ON tm.student_id = s.student_id
                                    WHERE tm.team_id = $team_id AND s.deleted = 0;");
            $count = $q_m_s->num_rows;
            if ($count > 0) {

                $content .=  '<select class="form-select" multiple readonly>';

                while ($r_m_s = $q_m_s->fetch_assoc()) {

                    $content .= '<option value="' . $r_m_s['id'] . '" disabled>' . $r_m_s['student_first_name'] . ' ' . $r_m_s['student_last_name'] . '</option>';
                }
                $content .=  '</select>';
            }
            $content .= '</div>';

            $content .= '<div class="form-group"><input type="hidden" class="form-control"  name="team_id" placeholder="Team Name" value="' . $team_id . '" />
                                        </div></td></tr>';

            $content .= ' <tr align="center">
                                
                                    <td><div class="form-group"> <input type="submit" class="btn btn-success" name="submit_update" value="submit" />';
            $content .= '</form>';


            return $content;
        } else {

            $content .= '<h3>Project Details</h3>';
            $content .= ' <form method="post" enctype="multipart/form-data">';


            $content .= ' <tr>
                <td colspan="6">
                
                    <div>
                        <label for="pwd"><b>Project Title:</b></label>
                        <input type="text" class="form-control" id="studentEmail" name="project_title" required placeholder="Project Title" value="" required>
                    </div>
                
                </td>
                    </tr>
                
             <br>
                <tr>
                <td colspan="6">
                
                    <div>
                        <label for="pwd"><b>Project Description:</b></label>
                        <textarea class="form-control" name="project_description" required placeholder="Project Description"></textarea>
                    </div>
                
                </td>
            </tr>
            <br>
            <tr>
                <td colspan="6">
                
                    <div>
                        <label for="pwd"><b>Team Name:</b></label>
                        <input type="text" class="form-control" name="team_name" required placeholder="Team Name" value="" required>
                    </div>
                
                </td>
            </tr>
                
            <br>
            <tr>


                <td colspan="6">
                
                    <div>
                        <label for="studentType">Team Category:</label>
                        <input type="text" class="form-control" name="category" required placeholder="Category" value="' . $category . '" required>
                    
                    </div>
                
                </td>
            </tr>
            <br>
            <tr>
                <div>
                    <label for="studentType">Students List:</label>';


            $content .= '<select name="student_id[]" class="form-control" multiple="multiple"><option disabled>Select the Team Members</option>';
            if (isset($_SESSION['name']) && isset($_SESSION['id'])) {
                $content .= '<option value=' . $_SESSION['id'] . ' selected>' . $_SESSION['name'] . '</option>';
                $id = $_SESSION['id'];
            }
            $q_m = $this->conn->query("SELECT tbl_student_mentor.student_id as id, tbl_user.first_name, tbl_user.last_name
            FROM tbl_user
            JOIN tbl_student_mentor ON tbl_user.id = tbl_student_mentor.student_id
            
            JOIN student ON tbl_student_mentor.student_id = student.student_id
            WHERE tbl_student_mentor.mentor_id = $mentor_id
              AND student.student_id != $id
              AND
              (
                (CASE 
                  WHEN student.student_grade >= 3 AND student.student_grade <= 5 THEN '3-5'
                  WHEN student.student_grade >= 6 AND student.student_grade <= 8 THEN '6-8'
                  WHEN student.student_grade >= 9 AND student.student_grade <= 12 THEN '9-12'
                  ELSE 'K-2'
                END) = '$category'
              );  ");
            while ($r_m = $q_m->fetch_assoc()) {

                $content .= '<option value="' . $r_m['id'] . '">' . $r_m['first_name'] . ' ' . $r_m['last_name'] . '</option>';
            }
            $content .= '</select></div> 
                 <div style="color:red; ">Hold down the Ctrl (windows) or Command (Mac) button to select multiple options.</div> 
                 <br><div class="form-group">';


            $content .= ' <button type="submit" class="btn btn-success" name="submit_team">Create</button>
                </div>
                </form>';
        }

        return $content;
    }
    function edit_member()
    {


        extract($_POST);
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $student_grade = $_POST['student_grade'];
        $student_school_name = $_POST['student_school_name'];
        $student_school_district = $_POST['student_school_district'];
        $student_tshirt = $_POST['student_tshirt'];
        $photo_consent = $_POST['photo_consent'];
        $video_exp_link = $_POST['video_exp_link'];
        $student_id = $_POST['student_id'];


        $q = "UPDATE student SET
                    student_first_name = '$first_name',
                    student_last_name = '$last_name',
                    student_grade = '$student_grade',
                    student_school_name = '$student_school_name',
                    student_school_district = '$student_school_district',
                    t_shirt_size = '$student_tshirt',
                    photo_consent = '$photo_consent',
                    video_exp_link = '$video_exp_link'
                WHERE student_id = $student_id";

        if ($this->conn->query($q)) {
            $resp['status'] = 'Success';
            $message = "Profile Updated Successfully!\n";
        } else {
            $resp['status'] = 'Failed';
            $message = "Failed to Updated Profile !\n";
        }

        if ($_FILES['fileToUpload']['size'] > 0) {
            $maxsize = 5242880; // 5MB
            $name = $_FILES['fileToUpload']['name'];
            $filenewname = rand(99999, 1000000) . "-" . $name;
            $target_dir = "./test_upload/";
            $target_file = $target_dir . $filenewname;
            $extension = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
            $extensions_arr = array("mp4", "avi", "3gp", "mov", "mpeg");

            if (in_array($extension, $extensions_arr)) {
                if ($_FILES['fileToUpload']['size'] < $maxsize && $_FILES["fileToUpload"]["size"] != 0) {
                    if (move_uploaded_file($_FILES['fileToUpload']['tmp_name'], $target_file)) {
                        $query = "UPDATE student SET video_exp_link = '$target_file' WHERE student_id = $student_id";
                        $this->conn->query($query);
                        $resp['status'] = 'Success';
                        $message .= "File Uploaded Successfully!\n";
                    }
                } else {
                    $resp['status'] = 'Failed';
                    $message .= "File too large. File must be less than 5MB.\n";
                }
            } else {
                $resp['status'] = 'Failed';
                $message .= "Invalid file extension.\n";
            }
        }


        if ($_FILES['log_book']['size'] > 0) {
            $target_dir = "test_upload/";
            $name = $_FILES["log_book"]["name"];
            $filenewname = rand(99999, 1000000) . "-" . $name;
            $target_file = $target_dir . $filenewname;
            $doc_path = $_FILES['log_book']['name'];

            if (move_uploaded_file($_FILES['log_book']['tmp_name'], $target_file)) {
                if ($this->conn->query("UPDATE student SET photo_consent_form='$target_file' WHERE student_id = $student_id")) {
                    $message .= "Consent Form Uploaded Successfully\n";
                }
            } else {
                $resp['status'] = 'Failed';
                $message .= "Failed to Upload a consent Form\n";
            }
        }

        $resp['msg'] = $message;
        $resp['error'] = $this->conn->error;

        return json_encode($resp);
    }
    function create_member()
    {


        extract($_POST);
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $student_grade = $_POST['student_grade'];
        $student_school_name = $_POST['student_school_name'];
        $student_school_district = $_POST['student_school_district'];
        $student_tshirt = $_POST['student_tshirt'];
        $photo_consent = $_POST['photo_consent'];
        $video_exp_link = $_POST['video_exp_link'];
        $student_id = $_POST['student_id'];


        $q = "INSERT into  student 
                    (student_id, student_first_name  ,student_last_name ,student_grade  ,student_school_name  ,student_school_district  ,t_shirt_size  ,photo_consent  ,video_exp_link )
                    VALUES('$student_id','$first_name','$last_name','$student_grade','$student_school_name','$student_school_district','$student_tshirt','$photo_consent','$video_exp_link') ";


        if ($this->conn->query($q)) {
            $resp['status'] = 'Success';
            $message = "Profile Created Successfully!\n";
        } else {
            $resp['status'] = 'Failed';
            $message = "Failed to Create Profile !\n";
        }

        if ($_FILES['fileToUpload']['size'] > 0) {
            $maxsize = 5242880; // 5MB
            $name = $_FILES['fileToUpload']['name'];
            $filenewname = rand(99999, 1000000) . "-" . $name;
            $target_dir = "./test_upload/";
            $target_file = $target_dir . $filenewname;
            $extension = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
            $extensions_arr = array("mp4", "avi", "3gp", "mov", "mpeg");

            if (in_array($extension, $extensions_arr)) {
                if ($_FILES['fileToUpload']['size'] < $maxsize && $_FILES["fileToUpload"]["size"] != 0) {
                    if (move_uploaded_file($_FILES['fileToUpload']['tmp_name'], $target_file)) {
                        $query = "INSERT INTO student (video_exp_link) VALUES('$target_file') ";
                        $this->conn->query($query);
                        $resp['status'] = 'Success';
                        $message .= "File Uploaded Successfully!\n";
                    }
                } else {
                    $resp['status'] = 'Failed';
                    $message .= "File too large. File must be less than 5MB.\n";
                }
            } else {
                $resp['status'] = 'Failed';
                $message .= "Invalid file extension.\n";
            }
        }


        if ($_FILES['log_book']['size'] > 0) {
            $target_dir = "../superadmin/test_upload/";
            $name = $_FILES["log_book"]["name"];
            $filenewname = rand(99999, 1000000) . "-" . $name;
            $target_file = $target_dir . $filenewname;
            $doc_path = $_FILES['log_book']['name'];

            if (move_uploaded_file($_FILES['log_book']['tmp_name'], $target_file)) {
                if ($this->conn->query("INSERT INTO student (photo_consent_form) VALUES('$filenewname')")) {
                    $message .= "Consent Form Uploaded Successfully\n";
                }
            } else {
                $resp['status'] = 'Failed';
                $message .= "Failed to Upload a consent Form\n";
            }
        }

        $resp['msg'] = $message;
        $resp['error'] = $this->conn->error;

        return json_encode($resp);
    }
    
}








$action = isset($_GET['action']) ? $_GET['action'] : '';
$api = new API();
switch ($action) {

    case ('checkupdate'):
        echo $api->checkupdate();
        break;
    case ('teamselect'):
        echo $api->teamselect();
        break;
    case ('edit_member'):
        echo $api->edit_member();
        break;
    case ('create_member'):
        echo $api->create_member();
        break;
    default:
        echo json_encode(array('status' => 'failed', 'error' => 'unknown action'));
        break;
}
