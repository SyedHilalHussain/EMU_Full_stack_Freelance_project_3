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
            $year = date("Y");
            $content = '';


            $content .= '<h3>Project And Team Details</h3>';
            $content .= '<form id="teamselect" action="#"  >';
            $content .= '<tr><td colspan="6"><br><div>';
            $content .= '<h6>Please check if your team(s) is already been created! If not, please select "Add a team" to proceed further</h6>';
            $content .= '<div><label for="studentType">Created Teams List:</label>';
            $content .= '<input type="hidden" name="mentorid" value="' . $mentor_id . '">';
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
                                <select name="category" class="form-control" required>
                                    <option>Select Student Grade</option>
                                    <option value="K-2" ';
                
                                if ($row['category'] == 'K-2') {
                                    $content .= 'selected';
                                }
                                $content .=  '>K-2</option><option value="3-5" ';
                                if ($row['category'] == '3-5') {
                                    $content .= 'selected';
                                }
                                $content .=  '>3-5</option><option value="6-8"';
                            
                                if ($row['category'] == '6-8') {
                                    $content .= 'selected';
                                }
                                $content .= '>6-8</option>
                                    <option value="9-12"';
                                if ($row['category'] == '9-12') {
                                    $content .= 'selected';
                                }
                                $content .= ' >9-12</option>
                            
                                </select>
                            </div>
                            
                        </td>
                    </tr>
                    <br>
                    <tr>
                        <div>
                            <label for="studentType">Students List:</label>';
                                $q_m_s = $this->conn->query("select * from tbl_team_member where team_id = $team_id and deleted = 0");
                                $count = $q_m_s->num_rows;
                                if ($count > 0) {
                                
                                    $content .= '<select class="form-control" multiple readonly>';
                                    $q_m_s = $this->conn->query("select * from tbl_team_member where team_id = $team_id and deleted = 0");
                                    while ($r_m_s = $q_m_s->fetch_assoc()) {
                                        $content .= '<option value=" ' . $r_m_s['id'] . '" selected>' . $r_m_s['student_first_name'] . ' ' . $r_m_s['student_last_name'] . '</option>';
                                    }
                                    $content .= ' </select>';
                                }
                            
                                $content .= '<select name="student_id[]" class="form-control" multiple="multiple"><option value="">Select the Team Members</option>';
                            
                                $q_m = $this->conn->query("select tbl_student_mentor.student_id as id, tbl_user.first_name, tbl_user.last_name from tbl_user, tbl_student_mentor, tbl_team_member
                        where tbl_user.id = tbl_student_mentor.student_id
                        and tbl_student_mentor.mentor_id = $mentor_id
                        and tbl_student_mentor.student_id = tbl_team_member.student_id
                        and (tbl_team_member.team_id is null  
                        or tbl_team_member.team_id in (select id from tbl_team where deleted = 1))");
                                while ($r_m = $q_m->fetch_assoc()) {
                                
                                    $content .= '<option value="' . $r_m['id'] . '">' . $r_m['first_name'] . ' ' . $r_m['last_name'] . '</option>';
                                
                                    $content .= '</select></div></tr><br>  <tr align="center">
                        <td><div class="form-group">';
                                
                                        $content .= '<input type="hidden" class="form-control"  name="team_id" placeholder="Team Name" value="' . $team_id . '" />
                                        </div></td></tr>';
                                
                                    $content .= ' <tr align="center">
                                
                                    <td><div class="form-group"> <input type="submit" class="btn btn-success" name="submit_update" value="submit" />';
                                    $content .= '</form>';
                                }
                            
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
                        <select name="category" class="form-control" required>
                            <option>Select Student Grade</option>
                            <option value="K-2" 
                
                
                    >K-2</option><option value="3-5" 
                
                   >3-5</option><option value="6-8"
                
                
                   >6-8</option>
                            <option value="9-12"
                
                     >9-12</option>
                
                        </select>
                    </div>
                
                </td>
            </tr>
            <br>
            <tr>
                <div>
                    <label for="studentType">Students List:</label>';
                
                
            $content .= '<select name="student_id[]" class="form-control" multiple="multiple"><option disabled>Select the Team Members</option>';
if(isset($_SESSION['name']) && isset($_SESSION['id'])){
    $content .= '<option value='.$_SESSION['id'].' selected>'.$_SESSION['name'].'</option>';

}
            $q_m = $this->conn->query("select tbl_student_mentor.student_id as id, tbl_user.first_name, tbl_user.last_name from tbl_user, tbl_student_mentor, tbl_team_member
        where tbl_user.id = tbl_student_mentor.student_id
        and tbl_student_mentor.mentor_id = $mentor_id
        and tbl_student_mentor.student_id = tbl_team_member.student_id
        and (tbl_team_member.team_id is null  
        or tbl_team_member.team_id in (select id from tbl_team where deleted = 1))
        ");
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
    function edit_member(){


        extract($_POST);
        $first_name=$_POST['first_name'];
        $last_name=$_POST['last_name'];
        $student_grade=$_POST['student_grade'];
        $student_school_name=$_POST['student_school_name'];
        $student_school_district=$_POST['student_school_district'];
        $student_tshirt=$_POST['student_tshirt'];
        $photo_consent=$_POST['photo_consent'];
        $video_exp_link=$_POST['video_exp_link'];
        $student_id=$_POST['student_id'];
       
            $q = "UPDATE tbl_team_member SET
                    student_first_name = '$first_name',
                    student_last_name = '$last_name',
                    student_grade = '$student_grade',
                    student_school_name = '$student_school_name',
                    student_school_district = '$student_school_district',
                    t_shirt_size = '$student_tshirt',
                    photo_consent = '$photo_consent',
                    video_exp_link = '$video_exp_link'
                WHERE id = $student_id";
            
            if($this->conn->query($q)){
                $resp['status'] = 'Success';
                $message = "Profile Updated Successfully!\n";
            }else{
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
                            $query = "UPDATE tbl_team_member SET video_exp_link = '$target_file' WHERE id = $student_id";
                            $this->conn->query($query);
                            $resp['status'] = 'Success';
                            $message .= "File Uploaded Successfully!\n"; }
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
               if( $this->conn->query("UPDATE tbl_team_member SET photo_consent_form='$filenewname' WHERE id = $student_id")           ){
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



    default:
        echo json_encode(array('status' => 'failed', 'error' => 'unknown action'));
        break;
}
