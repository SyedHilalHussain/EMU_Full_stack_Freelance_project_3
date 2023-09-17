<?php
ini_set('display_errors', 1); 
error_reporting(E_ALL);
require_once('./adminpanel/superadmin/database.php');
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
  function registration()
    {
extract($_POST);
       $first_name = $this->conn->real_escape_string($_POST['fname']);
    $last_name = $this->conn->real_escape_string($_POST['lname']);
    $phone = $this->conn->real_escape_string($_POST['contact']);
    $address = $this->conn->real_escape_string($_POST['address']);
    $email = $this->conn->real_escape_string($_POST['email']);
    $password = $this->conn->real_escape_string($_POST['password']);
    $user_type = $this->conn->real_escape_string($_POST['category']);
    $year = date('Y');
     
        $existing_email_query = "SELECT * FROM tbl_user WHERE email = '$email'";
        $existing_email_result =$this->conn->query($existing_email_query);

        if ($existing_email_result->num_rows > 0) {
            $resp['status'] = 'Failed';
            $resp['msg'] = 'Email already exists';
        } else {
            $to = $email;
            $subject = "EMUiNVENT Sign Up Confirmation";


         
            $headers  = 'MIME-Version: 1.0' . "\r\n";
            $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";


           
            $message = '<html><body>';
            $message .= '<p style="color:#080;font-size:18px;">Dear ' . $first_name . ',</p>';
            $message .= '<p style="color:#080;font-size:18px;">Thank you for signing up for EMUiNVENT! The EMUiNVENT team will now review your registration. You will receive an email as soon as the review is complete.  </p>';
            $message .= '<p style="color:#080;font-size:18px;">For more information and all deadlines, visit the 
<a href="https://emich.edu/emuinvent">EMUiNVENT website</a>. If you have questions, please email emu_invent@emich.edu.</p>';
            $message .= '<br><p style="color:#080;font-size:18px;">EMUiNVENT</p>';
            $message .= '</body></html>';

            // $email content to admin
            $subject1 = "EMUiNVENT New User Registration - User type - $user_type ";
            // $body = "Dear $name,
            //We are excited to welcome your team(s) for participation in the EMUiNVENT competition. Please login using  :Username: $username, Password: $password @ http://emuinvent.emuem.org/login.php to provide all details of the participating teams. Closer to the video submission deadline, you will receive another email with details of submission.EMUiNVENT 2021 will be entirely online. So please make sure you visit the submission system and provide all the information and materials in a timely manner.After the submission of videos is completed, a panel of professionals will judge all student projects. We will announce awards and winners in a broadcasted awards ceremony on March 12. You will receive more details about the ceremony and how to access it in the coming weeks.For more information and all deadlines, visit the https://emich.edu/emuinvent website. If you have questions, please email emu_invent@emich.edu.
            //EMUiNVENT Team";
            // To send HTML mail, the Content-type header must be set
          

            // $to1 = 'emu_invent@emich.edu,mahmed6@emich.edu,pchundur@emich.edu';
            $to1 = 'syedhilalkhan64@gmail.com';
            // Compose a simple HTML email message
            $message1 = '<html><body>';
            $message1 .= '<p style="color:#080;font-size:18px;">Dear admin,</p>';
            $message1 .= '<p style="color:#080;font-size:18px;">There is a new user registration on emuinvent.emuem.org website. Please find the details below:</p>';
            $message1 .= '<p style="color:#080;font-size:18px;">User Type: ' . $user_type . '</p>';
            $message1 .= '<p style="color:#080;font-size:18px;">User first name: ' . $first_name . '</p>';
            $message1 .= '<p style="color:#080;font-size:18px;">User last name: ' . $last_name . '</p>';
            $message1 .= '<p style="color:#080;font-size:18px;">User email: ' . $email . '</p>';
            $message1 .= '<p style="color:#080;font-size:18px;">User phone: ' . $phone . '</p>';
            $message1 .= '<p style="color:#080;font-size:18px;">User address: ' . $address . '</p>';
            $message1 .= '<p style="color:#080;font-size:18px;">To approve/disapprove user, please click <a href="https://emuinvent.emuem.org/login.php">here</a> with Super Admin credentials and click on View>Users</p>';
            $message1 .= '<br><p style="color:#080;font-size:18px;">EMUiNVENT</p>';
            $message1 .= '</body></html>';

            $query = "INSERT INTO tbl_user (first_name, last_name, phone, email, password, user_type, address,Year) VALUES ('$first_name', '$last_name', '$phone', '$email', '$password', '$user_type', '$address','$year')";

            if ($this->conn->query($query)) {
                if ($user_type == 'Student') {
                    $id = $this->conn->insert_id;
                    $mentor_id = $_POST['mentor_id'];
                    $q_m = $this->conn->query("select * from tbl_user where id = $mentor_id");
                    $r_m = $q_m->fetch_assoc();
    
                    $query_m = "insert into tbl_student_mentor (student_id,mentor_id) values ('$id','$mentor_id')";
                    $result = $this->conn->query($query_m);
    
    
                    $mentor_email = $r_m['email'];
                    $mentor_name = $r_m['first_name'];
                  
                    //$to = 'emu_invent@emich.edu';
                    $to = $mentor_email;
                    //$cc = 'mahmed6@emich.edu';
                  
    
                    $subject3 = "EMUiNVENT New Student";
                    // $body = "Dear $name,
                    //We are excited to welcome your team(s) for participation in the EMUiNVENT competition. Please login using  :Username: $username, Password: $password @ http://emuinvent.emuem.org/login.php to provide all details of the participating teams. Closer to the video submission deadline, you will receive another email with details of submission.EMUiNVENT 2021 will be entirely online. So please make sure you visit the submission system and provide all the information and materials in a timely manner.After the submission of videos is completed, a panel of professionals will judge all student projects. We will announce awards and winners in a broadcasted awards ceremony on March 12. You will receive more details about the ceremony and how to access it in the coming weeks.For more information and all deadlines, visit the https://emich.edu/emuinvent website. If you have questions, please email emu_invent@emich.edu.
                    //EMUiNVENT Team";
                    // To send HTML mail, the Content-type header must be set
                  
    
    
                    // Compose a simple HTML email message
                    $message3 = '<html><body>';
                    $message3 .= '<p style="color:#080;font-size:18px;">Dear ' . $mentor_name . ',</p>';
                    $message3 .= '<p style="color:#080;font-size:18px;">The following student requested to register for the EMUiNVENT and have selected you as a teacher/Mentor	. Please find the details below:</p>';
                    $message3 .= '<p style="color:#080;font-size:18px;">User Type: ' . $user_type . '</p>';
                    $message3 .= '<p style="color:#080;font-size:18px;">User first name: ' . $first_name . '</p>';
                    $message3 .= '<p style="color:#080;font-size:18px;">User last name: ' . $last_name . '</p>';
                    $message3 .= '<p style="color:#080;font-size:18px;">User email: ' . $email . '</p>';
                    $message3 .= '<p style="color:#080;font-size:18px;">User phone: ' . $phone . '</p>';
                    $message3 .= '<p style="color:#080;font-size:18px;">User address: ' . $address . '</p>';
                    $message3 .= '<p style="color:#080;font-size:18px;"> Please approve or disapprove the team/student(s) using the following <a href="https://emuinvent.emuem.org/login.php">link</a> and login with your credentials and click on <b>Approve/Disapprove student registration</b>, without which student will not be able to upload their details for the EMUiNVENT competition.</p>';
                    $message3 .= '<br><p style="color:#080;font-size:18px;">EMUiNVENT</p>';
                    $message3 .= '</body></html>';
                    mail($to, $subject3, $message3, $headers);
                }  
            if (mail($to, $subject, $message, $headers) && mail($to1, $subject1, $message1, $headers)) {
              
                   
                    $resp['status'] = 'Success';
                    $resp['msg'] = "Sign up confirmation has been sent to your email address!";
                } else {
                    $resp['status'] = 'Failed';
                    $resp['msg'] = 'Unable to send email. Please try again.';
                }
            } else {
                $resp['status'] = 'Failed';
                $resp['msg'] = 'Unable to Register. Please try again.';
            }
        }

        return json_encode($resp);
    }





  
  
}

$action = isset($_GET['action']) ? $_GET['action'] : '';
$api = new API();
switch ($action) {

  
    case ('registration'):
        echo $api->registration();
        break;
  
    default:
        echo json_encode(array('status' => 'failed', 'error' => 'unknown action'));
        break;
}
?>      