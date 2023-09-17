<?php
session_start();
include('database/config.php');
#include('control.php'); 
$general = 0;
extract($_POST);
if (isset($_POST['submit'])) {
    $date = date("Y");
    $l_q = mysqli_query($con, "select * from tbl_user where email = '$email'");
    $num_rows_1 = mysqli_num_rows($l_q);
    if ($num_rows_1 < 1) {
        $address = mysqli_real_escape_string($con, $_POST['address']);
        $query = "insert into tbl_user (first_name,last_name,phone,email,password,user_type,address,year) values ('$first_name','$last_name','$phone','$email','$password','$user_type','$addressb','$date')";
        $result = mysqli_query($con, $query);
        //echo $query;
        if ($result) {
            $id = mysqli_insert_id($con);
            $_SESSION['email'] = $_POST['email'];
            $_SESSION['id'] = $id;
            //$_SESSION['name'] = $login_d['first_name'];
            //$_SESSION['user_type'] = $login_d['user_type'];
            //echo '<script type="text/javascript">'; 
            //echo 'var email = "'.$_SESSION['email'].'";';
            //echo 'alert("An email will be sent to your email address " +email +" , once the account is been verified!");'; 
            //echo 'window.location.href = "index.php";';
            //echo '</script>';

            $to = $_SESSION['email'];
            $username = $row['email'];
            //$password = $row['password'];
            $name = $_POST['first_name'];

            $subject = "EMUiNVENT Sign Up Confirmation";
            // $body = "Dear $name,
            //We are excited to welcome your team(s) for participation in the EMUiNVENT competition. Please login using  :Username: $username, Password: $password @ http://emuinvent.emuem.org/login.php to provide all details of the participating teams. Closer to the video submission deadline, you will receive another email with details of submission.EMUiNVENT 2021 will be entirely online. So please make sure you visit the submission system and provide all the information and materials in a timely manner.After the submission of videos is completed, a panel of professionals will judge all student projects. We will announce awards and winners in a broadcasted awards ceremony on March 12. You will receive more details about the ceremony and how to access it in the coming weeks.For more information and all deadlines, visit the https://emich.edu/emuinvent website. If you have questions, please email emu_invent@emich.edu.
            //EMUiNVENT Team";
            // To send HTML mail, the Content-type header must be set
            $headers  = 'MIME-Version: 1.0' . "\r\n";
            $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";


            // Compose a simple HTML email message
            $message = '<html><body>';
            $message .= '<p style="color:#080;font-size:18px;">Dear ' . $name . ',</p>';
            $message .= '<p style="color:#080;font-size:18px;">Thank you for signing up for EMUiNVENT! The EMUiNVENT team will now review your registration. You will receive an email as soon as the review is complete.  </p>';
            $message .= '<p style="color:#080;font-size:18px;">For more information and all deadlines, visit the <a href="https://emich.edu/emuinvent">EMUiNVENT website</a>. If you have questions, please email emu_invent@emich.edu.</p>';
            $message .= '<br><p style="color:#080;font-size:18px;">EMUiNVENT</p>';
            $message .= '</body></html>';
            if (mail($to, $subject, $message, $headers)) {

                #echo 'Your mail has been sent successfully.';

                //echo '<script>alert("Registration Successfull, we will review your registration and let you know shortly");</script>';
                echo '<script type="text/javascript">';
                echo 'alert("Sign up confirmation has been sent to your email address!");';
                echo 'window.location.href = "index.php";';
                echo '</script>';

                //$message ="Dear $name,
                //We are excited to welcome your team(s) for participation in the EMUiNVENT competition. Please login using  :Username: $username, Password: $password @ http://emuinvent.emuem.org/login.php to provide all details of the participating teams. Closer to the video submission deadline, you will receive another email with details of submission.EMUiNVENT 2021 will be entirely online. So please make sure you visit the submission system and provide all the information and materials in a timely manner.After the submission of videos is completed, a panel of professionals will judge all student projects. We will announce awards and winners in a broadcasted awards ceremony on March 12. You will receive more details about the ceremony and how to access it in the coming weeks.For more information and all deadlines, visit the https://emich.edu/emuinvent website. If you have questions, please email emu_invent@emich.edu.
                //EMUiNVENT Team";
            } else {
                echo 'Unable to send email. Please try again.';
            }
            $login_q = mysqli_query($con, "select * from tbl_user where id = $id");
            $login_d = mysqli_fetch_assoc($login_q);
            $first_name = $login_d['first_name'];
            $last_name = $login_d['last_name'];
            $address = $login_d['address'];
            $user_type = $login_d['user_type'];
            $email = $login_d['email'];
            $phone = $login_d['phone'];
            //$to = 'emu_invent@emich.edu';
            $to = 'emu_invent@emich.edu,mahmed6@emich.edu,pchundur@emich.edu';
            //$cc = 'mahmed6@emich.edu';
            $username = $row['email'];
            //$password = $row['password'];
            $name = $_POST['first_name'];

            $subject = "EMUiNVENT New User Registration - User type - $user_type ";
            // $body = "Dear $name,
            //We are excited to welcome your team(s) for participation in the EMUiNVENT competition. Please login using  :Username: $username, Password: $password @ http://emuinvent.emuem.org/login.php to provide all details of the participating teams. Closer to the video submission deadline, you will receive another email with details of submission.EMUiNVENT 2021 will be entirely online. So please make sure you visit the submission system and provide all the information and materials in a timely manner.After the submission of videos is completed, a panel of professionals will judge all student projects. We will announce awards and winners in a broadcasted awards ceremony on March 12. You will receive more details about the ceremony and how to access it in the coming weeks.For more information and all deadlines, visit the https://emich.edu/emuinvent website. If you have questions, please email emu_invent@emich.edu.
            //EMUiNVENT Team";
            // To send HTML mail, the Content-type header must be set
            $headers  = 'MIME-Version: 1.0' . "\r\n";
            $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";


            // Compose a simple HTML email message
            $message = '<html><body>';
            $message .= '<p style="color:#080;font-size:18px;">Dear admin,</p>';
            $message .= '<p style="color:#080;font-size:18px;">There is a new user registration on emuinvent.emuem.org website. Please find the details below:</p>';
            $message .= '<p style="color:#080;font-size:18px;">User Type: ' . $user_type . '</p>';
            $message .= '<p style="color:#080;font-size:18px;">User first name: ' . $first_name . '</p>';
            $message .= '<p style="color:#080;font-size:18px;">User last name: ' . $last_name . '</p>';
            $message .= '<p style="color:#080;font-size:18px;">User email: ' . $email . '</p>';
            $message .= '<p style="color:#080;font-size:18px;">User phone: ' . $phone . '</p>';
            $message .= '<p style="color:#080;font-size:18px;">User address: ' . $address . '</p>';
            $message .= '<p style="color:#080;font-size:18px;">To approve/disapprove user, please click <a href="https://emuinvent.emuem.org/login.php">here</a> with Super Admin credentials and click on View>Users</p>';
            $message .= '<br><p style="color:#080;font-size:18px;">EMUiNVENT</p>';
            $message .= '</body></html>';
            if (mail($to, $subject, $message, $headers)) {

                #echo 'Your mail has been sent successfully.';

                //echo '<script>alert("Registration Successfull, we will review your registration and let you know shortly");</script>';
                //echo '<script type="text/javascript">'; 
                //echo 'alert("Sign up confirmation has been sent to your email address!");'; 
                //echo 'window.location.href = "index.php";';
                //echo '</script>';

                //$message ="Dear $name,
                //We are excited to welcome your team(s) for participation in the EMUiNVENT competition. Please login using  :Username: $username, Password: $password @ http://emuinvent.emuem.org/login.php to provide all details of the participating teams. Closer to the video submission deadline, you will receive another email with details of submission.EMUiNVENT 2021 will be entirely online. So please make sure you visit the submission system and provide all the information and materials in a timely manner.After the submission of videos is completed, a panel of professionals will judge all student projects. We will announce awards and winners in a broadcasted awards ceremony on March 12. You will receive more details about the ceremony and how to access it in the coming weeks.For more information and all deadlines, visit the https://emich.edu/emuinvent website. If you have questions, please email emu_invent@emich.edu.
                //EMUiNVENT Team";
            } else {
                echo 'Unable to send email. Please try again.';
            }
            if ($user_type == 'Student') {
                $mentor_id = $_POST['mentor_id'];
                $q_m = mysqli_query($con, "select * from tbl_user where id = $mentor_id");
                $r_m = mysqli_fetch_assoc($q_m);

                $query_m = "insert into tbl_student_mentor (student_id,mentor_id) values ('$id','$mentor_id')";
                $result = mysqli_query($con, $query_m);


                $mentor_email = $r_m['email'];
                $mentor_name = $r_m['first_name'];
                $login_q = mysqli_query($con, "select * from tbl_user where id = $id");
                $login_d = mysqli_fetch_assoc($login_q);
                $first_name = $login_d['first_name'];
                $last_name = $login_d['last_name'];
                $address = $login_d['address'];
                $user_type = $login_d['user_type'];
                $email = $login_d['email'];
                $phone = $login_d['phone'];
                //$to = 'emu_invent@emich.edu';
                $to = $mentor_email;
                //$cc = 'mahmed6@emich.edu';
                $username = $row['email'];
                //$password = $row['password'];
                $name = $_POST['first_name'];

                $subject = "EMUiNVENT New Student";
                // $body = "Dear $name,
                //We are excited to welcome your team(s) for participation in the EMUiNVENT competition. Please login using  :Username: $username, Password: $password @ http://emuinvent.emuem.org/login.php to provide all details of the participating teams. Closer to the video submission deadline, you will receive another email with details of submission.EMUiNVENT 2021 will be entirely online. So please make sure you visit the submission system and provide all the information and materials in a timely manner.After the submission of videos is completed, a panel of professionals will judge all student projects. We will announce awards and winners in a broadcasted awards ceremony on March 12. You will receive more details about the ceremony and how to access it in the coming weeks.For more information and all deadlines, visit the https://emich.edu/emuinvent website. If you have questions, please email emu_invent@emich.edu.
                //EMUiNVENT Team";
                // To send HTML mail, the Content-type header must be set
                $headers  = 'MIME-Version: 1.0' . "\r\n";
                $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";


                // Compose a simple HTML email message
                $message = '<html><body>';
                $message .= '<p style="color:#080;font-size:18px;">Dear ' . $mentor_name . ',</p>';
                $message .= '<p style="color:#080;font-size:18px;">The following student requested to register for the EMUiNVENT and have selected you as a teacher/Mentor	. Please find the details below:</p>';
                $message .= '<p style="color:#080;font-size:18px;">User Type: ' . $user_type . '</p>';
                $message .= '<p style="color:#080;font-size:18px;">User first name: ' . $first_name . '</p>';
                $message .= '<p style="color:#080;font-size:18px;">User last name: ' . $last_name . '</p>';
                $message .= '<p style="color:#080;font-size:18px;">User email: ' . $email . '</p>';
                $message .= '<p style="color:#080;font-size:18px;">User phone: ' . $phone . '</p>';
                $message .= '<p style="color:#080;font-size:18px;">User address: ' . $address . '</p>';
                $message .= '<p style="color:#080;font-size:18px;"> Please approve or disapprove the team/student(s) using the following <a href="https://emuinvent.emuem.org/login.php">link</a> and login with your credentials and click on <b>Approve/Disapprove student registration</b>, without which student will not be able to upload their details for the EMUiNVENT competition.</p>';
                $message .= '<br><p style="color:#080;font-size:18px;">EMUiNVENT</p>';
                $message .= '</body></html>';
                if (mail($to, $subject, $message, $headers)) {

                    #echo 'Your mail has been sent successfully.';

                    //echo '<script>alert("Registration Successfull, we will review your registration and let you know shortly");</script>';
                    //echo '<script type="text/javascript">'; 
                    //echo 'alert("Sign up confirmation has been sent to your email address!");'; 
                    //echo 'window.location.href = "index.php";';
                    //echo '</script>';

                    //$message ="Dear $name,
                    //We are excited to welcome your team(s) for participation in the EMUiNVENT competition. Please login using  :Username: $username, Password: $password @ http://emuinvent.emuem.org/login.php to provide all details of the participating teams. Closer to the video submission deadline, you will receive another email with details of submission.EMUiNVENT 2021 will be entirely online. So please make sure you visit the submission system and provide all the information and materials in a timely manner.After the submission of videos is completed, a panel of professionals will judge all student projects. We will announce awards and winners in a broadcasted awards ceremony on March 12. You will receive more details about the ceremony and how to access it in the coming weeks.For more information and all deadlines, visit the https://emich.edu/emuinvent website. If you have questions, please email emu_invent@emich.edu.
                    //EMUiNVENT Team";
                } else {
                    echo 'Unable to send email. Please try again.';
                }
            }
        } else {
            #echo "user already exists";
            echo '<script>alert("User registration error");</script>';
        }
    } else {

        echo "<script>alert('User account already exists with this email ID');</script>";
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>EMUiNVENT</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="css/style.css" type="text/css">
    <link rel="shortcut icon" href="http://emuinvent.emuem.org/favicon.png">
</head>
<script>
    function func_reg(Selectedvalue) {
        //alert(Selectedvalue);
        var a = Selectedvalue;
        var b = 'General User';
        var c = 'Student';
        var ans = a.localeCompare(b);
        var stud = a.localeCompare(c);
        if (stud == 0) {
            document.getElementById('mentor').style.display = 'block';
            document.getElementById('mentor_id').required = true;
        } else if (ans == 0) {
            document.getElementById('phone').style.display = 'none';
            document.getElementById('address').style.display = 'none';
            document.getElementById("phone").required = false;
            document.getElementById("address").required = false;
            document.getElementById('mentor').style.display = 'none';
            document.getElementById('mentor_id').required = false;


        } else {
            document.getElementById('phone').style.display = 'block';
            document.getElementById('address').style.display = 'block';
            document.getElementById("phone").required = true;
            document.getElementById("address").required = true;
            document.getElementById('mentor').style.display = 'none';
            document.getElementById('mentor_id').required = false;
        }




        //location.reload();
    }
</script>
<style>
    .btn-success {
        color: #fff;
        background-color: #78CC6F;
        border-color: #78CC6F;
    }
</style>

<?php include('header.php'); ?>
<div id="wrapper">

    <body>

        <?php include('navbar.php'); ?>
        <br>

        <div class="container d-flex justify-content-center col-md-10">
            <div class="col-7">

                <table class="table table-borderless">
                    <h3>User SignUp:</h3>


                    <form method="post" enctype="multipart/form-data">

                        <tr>
                            <td colspan="6">
                                <div>
                                    <label for="pwd"><b>User Type *</b></label>
                                    <div>
                                        <select class="form-control" name="user_type" onchange="func_reg(this.value)" required>
                                            <option value="">Select</option>
                                            <option value="Mentor">Teacher or Mentor (parents/teachers participating in Dare2Design)</option>
                                            <option value="Student">Student</option>
                                            <option value="General User">General User</option>

                                        </select>
                                    </div>
                                </div>
                            </td>
                        </tr>

                        <tr>
                            <td colspan="6">

                                <div>
                                    <label for="pwd"><b>First Name: *</b></label>
                                    <input type="text" class="form-control" id="studentEmail" name="first_name" placeholder="First Name" required>
                                </div>

                            </td>
                        </tr>


                        <tr>
                            <td colspan="6">

                                <div>
                                    <label for="pwd"><b>Last Name: *</b></label>
                                    <input type="text" class="form-control" id="studentEmail" name="last_name" placeholder="Last Name" required>
                                </div>

                            </td>
                        </tr>

                        <tr>
                            <td colspan="6">

                                <div>
                                    <label for="pwd"><b>Email: *</b></label>
                                    <input type="email" class="form-control" id="studentEmail" name="email" placeholder="Email" required>
                                </div>

                            </td>
                        </tr>

                        <tr id="phone">
                            <td colspan="6">

                                <div>
                                    <label for="pwd"><b>Phone: *(Optional for General Users) </b></label>
                                    <input type="telephone" class="form-control" id="phone1" name="phone" placeholder="Phone Number">
                                </div>

                            </td>
                        </tr>

                        <tr id="mentor" style="display:none">
                            <td colspan="6">
                                <div>
                                    <label for="pwd"><b>Select Teacher/Mentor *</b></label>
                                    <div>
                                        <select class="form-control" name="mentor_id" id="mentor_id">
                                            <option value="">Select</option>
                                            <?php $q = mysqli_query($con, "select id, first_name, last_name from tbl_user where user_type = 'Mentor' and is_approved = 1 and year = '2021' order by first_name asc");
                                            while ($r = mysqli_fetch_assoc($q)) {
                                            ?>
                                                <option value="<?php echo $r['id'] ?>"><?php echo $r['first_name'] . ' ' . $r['last_name']; ?></option>
                                            <?php } ?>


                                        </select>
                                    </div>
                                </div>
                            </td>
                        </tr>

                        <tr id="address">
                            <td colspan="6">

                                <div>
                                    <label for="pwd"><b>Address: *(Optional for General Users)</b></label>
                                    <input type="text" class="form-control" id="studentEmail" name="address" placeholder="Address">
                                </div>

                            </td>
                        </tr>

                        <tr>
                            <td colspan="6">
                                <div>
                                    <label for="pwd"><b>Password *</b></label>

                                    <input type="password" class="form-control" name="password" value="" placeholder="Password" id="password" required>

                                </div>
                            </td>
                        </tr>

                        <tr>
                            <td colspan="6">
                                <div>
                                    <label for="pwd"><b>Password Confirm *</b></label>

                                    <input type="password" class="form-control" name="confirm" value="" placeholder="Password Confirm" id="confirm_password" required>
                                    <span id='message'></span>

                                </div>
            </div>
            </td>
            </tr>

            <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
            <script>
                $('#password, #confirm_password').on('change', function() {
                    if ($('#password').val() == $('#confirm_password').val()) {
                        $('#message').html('Matching').css('color', 'green');
                    } else {

                        $('#message').html('Not Matching').css('color', 'red');
                        document.getElementById("confirm_password").value = "";
                    }
                });
            </script>






            <tr align="left">
                <td>
                    <div class="form-group">
                        <button type="submit" class="btn btn-success" name="submit">Register</button>
                        <a href="login.php" style="float:right">Have an account?</a>

                    </div>
                </td>
            </tr>




            <!--</td>
				</tr>-->
            </form>
            </table>







        </div>

</div>

<!-- <div class="container d-flex justify-content-center col-md-8">
        <p class="dbtn">
            <button type="button" id="signout-btn" onclick="signOutUser()" class="btn btn-danger"> SignOut </button>
        </p>
    </div> -->
</body>
</div>
<?php include('footer.php'); ?>

</html>