<?php
require_once('database.php');



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

    function update_consent()
    {



        $student_id = $_POST['student_id'];
        $photo_consent = $_POST['photo_consent'];

        if ($photo_consent == 'Yes') {
            $photo_consent = 1;
        }
        if ($photo_consent == 'No') {
            $photo_consent = 0;
        }


        $query = "update student set photo_consent = $photo_consent where student_id = $student_id";
        if ($this->conn->query($query)) {
            $resp['status'] = 'Success';
            $resp['msg'] = 'Updated Successfully!';
        } else {
            $resp['status'] = 'Failed';
            $resp['msg'] = 'Process Failed';
        }



        return json_encode($resp);
    }
    function photo_consent_form()
    {
        extract($_POST);

        $id = $_POST['student_id'];
        $target_dir_1 = "test_upload/";
        $tmp_name = $_FILES["photo_form"]["tmp_name"];
        $name = $_FILES["photo_form"]["name"];
        $filenewname = rand(99999, 1000000) . "-" . $name;
        $path = "$target_dir_1/$filenewname";
        if (move_uploaded_file($tmp_name, "$path")) {
            #$_SESSION["uploaded_file"] =  "$dir/$name";
            //$_SESSION["image_name"] = "$name";

            $q = "update student set photo_consent_form='$path' where student_id = $id";
            if ($this->conn->query($q)) {
                $resp['status'] = 'Success';
                $resp['msg'] = 'Updated Successfully!';
            } else {
                $resp['status'] = 'Failed';
                $resp['msg'] = 'Process Failed';
            }

            /*$type = pathinfo($path, PATHINFO_EXTENSION);
            $data = file_get_contents($path);
            $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
            $_SESSION["uploaded_file"] = $base64; */
        }



        return json_encode($resp);
    }
    function edit_team()
    {

        extract($_POST);
        $team_id = $_POST['team_id'];
        $video_pitch_link = $_POST['video_pitch_link'];
        if ($video_pitch_link != '') {
            $q = "UPDATE tbl_team set video_pitch  = '$video_pitch_link' where id = $team_id";

            if ($this->conn->query($q)) {
                $resp['status'] = 'Success';
                $resp['msg'] = "Pitch Url Updated Successfully!\n";
            } else {
                $resp['status'] = 'Failed';
                $resp['msg'] = "Url Update Process Failed\n";
            }
        }
        #echo "<script>alert('out if')</script>";
        if ($_FILES['fileToUpload']['size'] > 0) {
            $maxsize = 5242880; // 5MB
            $name = $_FILES['fileToUpload']['name'];
            $filenewname = rand(99999, 1000000) . "-" . $name;
            $target_dir = "test_upload/";
            $target_file_video = $target_dir . $filenewname;
            $extension = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
            $extensions_arr = array("mp4", "avi", "3gp", "mov", "mpeg");
            if (in_array($extension, $extensions_arr)) {
                if ($_FILES['fileToUpload']['size'] < $maxsize && $_FILES["fileToUpload"]["size"] != 0) {

                    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file_video)) {
                        $this->conn->query("update tbl_team set video_pitch  = '$target_file_video' where id = $team_id");
                        $resp['status'] = 'Success';
                        $resp['msg'] .= "File Uploaded Successfully!\n";
                    } else {
                        $resp['status'] = 'Failed';
                        $resp['msg'] .= "Failed To Upload Video File\n";
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
            #echo "<script>alert('inside if')</script>";
            $target_dir = "test_upload/";
            $name = $_FILES["log_book"]["name"];
            $filenewname = rand(99999, 1000000) . "-" . $name;
            $target_file = $target_dir . $filenewname;


            if (move_uploaded_file($_FILES["log_book"]["tmp_name"], $target_file)) {
                if ($this->conn->query("update tbl_team set log_book='$target_file' where id = $team_id")) {
                    $resp['status'] = 'Success';
                    $message .= "logbook Uploaded Successfully\n";
                }
            } else {
                $resp['status'] = 'Failed';
                $message .= "Failed to Upload a logbook\n";
            }
        }


        // if ($_FILES['photo_form']['size'] > 0) {
        //     #echo "<script>alert('inside if')</script>";
        //     $target_dir_1 = "test_upload/";
        //     $target_file_1 = $target_dir_1 . basename($_FILES["photo_form"]["name"]);
        //     $doc_path_1 = $_FILES['photo_form']['name'];
        //     $this->conn->query( "update tbl_team set photo_consent_form='test_upload/$doc_path_1' where id = $team_id");
        // }


        // move_uploaded_file($_FILES["photo_form"]["tmp_name"], $target_file_1);

        // echo "<script type='text/javascript'> document.location = 'home.php'; </script>";

        $resp['status'] = 'Success';
        $resp['msg'] = 'Updated Successfully!';

        $resp['status'] = 'Failed';
        $resp['msg'] = 'Process Failed';
        $resp['error'] = $this->conn->error;

        /*$type = pathinfo($path, PATHINFO_EXTENSION);
            $data = file_get_contents($path);
            $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
            $_SESSION["uploaded_file"] = $base64; */
        return json_encode($resp);
    }
    function admin_edit_member()
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





    function profile_updated()
    {
        extract($_POST);

        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $phone = $_POST['phone'];
        $password = $_POST['password'];
        $category = $_POST['category'];
        $user_type = $_POST['user_type'];
        $id = $_POST['user_id'];
        $year = date('Y');
        if (isset($_FILES['dp']) && $_FILES['dp']['size'] > 0) {



            $filesize = $_FILES['dp']['size'];
            $filetmpname = $_FILES["dp"]["tmp_name"];
            $filename = $_FILES["dp"]["name"];

            $fileext = explode('.', $filename);
            $filenewname = rand(99999, 1000000) . "-" . $filename;
            $filedestination = '../profilepic/' . $filenewname;
            $fileactualext = strtolower(end($fileext));
            $allow = array('jpg', 'jpeg', 'pdf', 'png', 'gif', 'docx');
            if (in_array($fileactualext, $allow)) {
                if ($filesize < 1000000) {
                    if (move_uploaded_file($filetmpname, $filedestination)) {

                        $q = ("update tbl_user set first_name = '$first_name', 
                                                    last_name = '$last_name',
                                                    phone = '$phone',
                                                    email = '$email',
                                                    password = '$password',
                                                    category = '$category',
                                                    user_type = '$user_type',
                                                    profile_pic='$filenewname',
                                                    Year='$year'
                                                    where id = $id");
                        if ($this->conn->query($q)) {
                            $resp['status'] = 'Success';
                            $resp['msg'] = 'Profile updated successfully';
                        } else {
                            $resp['status'] = 'Failed';
                            $resp['msg'] = 'Unexpected Error Try Again!';
                        }
                    } else {
                        $resp['status'] = 'Failed';
                        $resp['msg'] = 'Unexpected Error Try Again!';
                    }
                } else {
                    $resp['status'] = 'Failed';
                    $resp['msg'] = 'Too Big File For profile';
                }
            } else {
                $resp['status'] = 'Failed';
                $resp['msg'] = 'Invalid Picture For profile';
            }
        } else {

            $q = ("update tbl_user set first_name = '$first_name', 
                                                    last_name = '$last_name',
                                                    phone = '$phone',
                                                    email = '$email',
                                                    user_type = '$user_type',
                                                    category = '$category',
                                                    password = '$password',
                                                    
                                                    Year='$year'
                                                    where id = $id");
            if ($this->conn->query($q)) {
                $resp['status'] = 'Success';
                $resp['msg'] = 'Profile updated successfully';
            } else {
                $resp['status'] = 'Failed';
                $resp['msg'] = 'Unexpected Error Try Again!';
            }
        }
        return json_encode($resp);
    }

    function judge_detail_update()
    {
        extract($_POST);

        if (isset($_POST['userid']) && isset($_POST['fname']) && isset($_POST['lname']) && isset($_POST['email']) && isset($_POST['contact']) && isset($_POST['password']) && isset($_POST['category']) && isset($_POST['judge_confirm'])) {
            $id = $_POST['userid'];
            $first_name = $_POST['fname'];
            $last_name = $_POST['lname'];
            $phone = $_POST['contact'];
            $email = $_POST['email'];
            $password = $_POST['password'];

            $category = $_POST['category'];
            $judge_confirm = $_POST['judge_confirm'];


            $q = ("update tbl_user set first_name = '$first_name', 
            last_name = '$last_name',
            phone = '$phone',
            email = '$email',
            password = '$password',
            category = '$category', judge_confirm = '$judge_confirm' where id = $id");

            if ($this->conn->query($q)) {
                $resp['status'] = 'Success';
                $resp['msg'] = 'Record Updated Successfully!';
            } else {
                $resp['status'] = 'Failed';
                $resp['msg'] = 'Process Failed';
            }
        } else {
            $resp['status'] = 'Required';
            $resp['msg'] = 'All Field are Required!';
            $resp['error'] = $this->conn->error;
        }
        return json_encode($resp);
    }
    function evaluation_team_update()
    {

        extract($_POST);

        $user_id = $_POST['userid'];
        $team_id = $_POST['teamid'];
        $identifying_understanding = $_POST['identifying_understanding'];
        $ideating = $_POST['ideating'];
        $designing_building = $_POST['designing_building'];
        $testing_refinging = $_POST['testing_refinging'];
        $value_propoition = $_POST['value_propoition'];
        $market_potential = $_POST['market_potential'];
        $social_value = $_POST['social_value'];
        $originality = $_POST['originality'];
        $logbook = $_POST['logbook'];
        $display_board = $_POST['display_board'];
        $prototype = $_POST['prototype'];
        $online_pitch = $_POST['online_pitch'];
        $question_asked = $_POST['question_asked'];

        $fieldsToUpdate = [
            'identifying_understanding',
            'ideating',
            'designing_building',
            'testing_refinging',
            'value_propoition',
            'market_potential',
            'social_value',
            'originality',
            'logbook',
            'display_board',
            'prototype',
            'online_pitch'
        ];
        // array to store the field assignments
        $fieldAssignments = [];

        // Iterate through the fields and check if they are empty
        foreach ($fieldsToUpdate as $field) {
            if (isset($_POST[$field])) {
                $fieldValue = mysqli_real_escape_string($this->conn, $_POST[$field]);
                $fieldAssignments[] = "$field = '$fieldValue'";
            }
        }
        // foreach ($fields as $field) {
        //     if ($field == '') {
        //         $field = 'NULL';
        //     }
        // }
        // Construct the SET clause of the SQL query
        $setClause = implode(', ', $fieldAssignments);

        // Escape and handle the 'question_asked' field
        $question_asked = mysqli_real_escape_string($this->conn, $question_asked);
        $setClause .= ", question_asked = '$question_asked'";
        $q_e1 = ("select * from tbl_judge_assessment where user_id = $user_id and team_id = $team_id");
        $q_e = $this->conn->query($q_e1);
        $d_e = $q_e->fetch_assoc();
        $e_id = $d_e['id'];


        $r = "UPDATE tbl_judge_assessment SET $setClause WHERE id = $e_id";






        if ($this->conn->query($r)) {
            $resp['status'] = 'Success';
            $resp['msg'] = 'Evaluation Detail Updated Successfully!';
        } else {
            $resp['status'] = 'Failed';
            $resp['msg'] = 'Process Failed';
        }


        return json_encode($resp);
    }

    function edit_team_liveqa()
    {

        extract($_POST);
        $team_id = $_POST['teamid'];
        $live_qa = $_POST['live_qa'];
        $r = "update tbl_judge_assessment set
            live_qa = '$live_qa' where team_id = $team_id";






        if ($this->conn->query($r)) {
            $resp['status'] = 'Success';
            $resp['msg'] = 'Live QA Updated Successfully!';
        } else {
            $resp['status'] = 'Failed';
            $resp['msg'] = 'Process Failed';
        }


        return json_encode($resp);
    }





    function approve_user()
    {


        $table = $_POST['table'];
        $id = $_POST['id'];
        $returns = $_POST['returns'];
        $flag = $_POST['flag'];




        $q1 = "update tbl_user set is_approved = $flag where id = $id";

        if ($this->conn->query($q1)) {
            $query = $this->conn->query(" select * from tbl_user where id = $id");
            $row = mysqli_fetch_assoc($query);

            $to = $row['email'];
            $to = 'syedkhan64@gmail.com';
            $username = $row['email'];
            $password = $row['password'];
            $name = $row['first_name'];
            $user_type = $row['user_type'];
            if ($flag == 1) {



                $subject = "EMUiNVENT User Registration-Acceptance";

                // To send HTML mail, the Content-type header must be set
                $headers  = 'MIME-Version: 1.0' . "\r\n";
                $headers = 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

                if (($user_type) == 'Mentor') {
                    // Compose a simple HTML email message
                    $message = '<html><body>';
                    $message .= '<p style="color:#080;font-size:18px;">Dear ' . $name . ',</p>';
                    $message .= '<p style="color:#080;font-size:18px;">We are excited to welcome your team(s) for participation in the EMUiNVENT competition.</p>';
                    $message .= '<p style="color:#080;font-size:18px;">Please login using the following credentials @ <a href="http://grading.emuem.org/login.php">EMUiNVENT Login</a>:';
                    $message .= '<p style="color:#080;font-size:18px;">Username: ' . $username . ', Password: ' . $password . ' to provide all details of the participating teams.</p>';
                    $message .= ' <p style="color:#080;font-size:18px;">Closer to the video submission deadline, you will receive another email with details of submission.</p>
                <p style="color:#080;font-size:18px;">EMUiNVENT 2021 will be entirely online. So please make sure you visit the submission system and provide all the information and materials in a timely manner.</p>
                <p style="color:#080;font-size:18px;">After the submission of videos is completed, a panel of professionals will judge all student projects. We will announce awards and winners in a broadcasted awards ceremony on March 12. </p>
                <p style="color:#080;font-size:18px;">You will receive more details about the ceremony and how to access it in the coming weeks.For more information and all deadlines, visit the <a href="https://emich.edu/emuinvent">EMUiNVENT website</a>. If you have questions, please email emu_invent@emich.edu.</p>';
                    $message .= '<br><p style="color:#080;font-size:18px;">EMUiNVENT</p>';
                    $message .= '</body></html>';
                } else {
                    $message = '<html><body>';
                    $message .= '<p style="color:#080;font-size:18px;">Dear ' . $name . ',</p>';
                    $message .= '<p style="color:#080;font-size:18px;">We are excited to welcome you to EMUiNVENT website. You should be able to view student presentation from this year & previous year.</p>';
                    $message .= '<p style="color:#080;font-size:18px;">Please login using the following credentials @ <a href="http://grading.emuem.org/login.php">EMUiNVENT Login</a>:';
                    $message .= '<p style="color:#080;font-size:18px;">Username: ' . $username . ', Password: ' . $password . '.</p>';
                    $message .= '<p style="color:#080;font-size:18px;"> If you have questions, please email emu_invent@emich.edu.</p>';
                    $message .= '<br><p style="color:#080;font-size:18px;">EMUiNVENT</p>';
                    $message .= '</body></html>';
                }
                if (mail($to, $subject, $message, $headers)) {

                    $resp['status'] = 'Success';
                    $resp['msg'] = 'Mail Has Been Sent Successfully!';


                    //$message ="Dear $name,
                    //We are excited to welcome your team(s) for participation in the EMUiNVENT competition. Please login using  :Username: $username, Password: $password @ http://grading.emuem.org/login.php to provide all details of the participating teams. Closer to the video submission deadline, you will receive another email with details of submission.EMUiNVENT 2021 will be entirely online. So please make sure you visit the submission system and provide all the information and materials in a timely manner.After the submission of videos is completed, a panel of professionals will judge all student projects. We will announce awards and winners in a broadcasted awards ceremony on March 12. You will receive more details about the ceremony and how to access it in the coming weeks.For more information and all deadlines, visit the https://emich.edu/emuinvent website. If you have questions, please email emu_invent@emich.edu.
                    //EMUiNVENT Team";
                } else {
                    $resp['status'] = 'Failed';
                    $resp['msg'] = 'Unable to send email. Please try again.';
                }
            } else {
                $subject = "EMUiNVENT User Registration-Rejection";
                $headers  = 'MIME-Version: 1.0' . "\r\n";
                $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

                if (($user_type) == 'Mentor') {
                    // Compose a simple HTML email message
                    $message = '<html><body>';
                    $message .= '<p style="color:#080;font-size:18px;">Dear ' . $name . ',</p>';
                    $message .= '<p style="color:#080;font-size:18px;">Thank you for signing up to participate in EMUiNVENT. We reviewed the information you provided. Unfortunately, at this time you do not meet the requirements for participation in EMUiNVENT.  </p>';
                    $message .= ' <p style="color:#080;font-size:18px;">If you think this is in error or if you can provide more information about your eligibility, please email us at emu_invent@emich.edu</p>
                <p style="color:#080;font-size:18px;">EMUiNVENT 2021 will be entirely online.</p>
                <p style="color:#080;font-size:18px;">For more information and all deadlines, visit the <a href="https://emich.edu/emuinvent">EMUiNVENT website</a>. If you have questions, please email emu_invent@emich.edu.</p>';
                    $message .= '<br><p style="color:#080;font-size:18px;">EMUiNVENT</p>';
                    $message .= '</body></html>';
                } else {
                    $message = '<html><body>';
                    $message .= '<p style="color:#080;font-size:18px;">Dear ' . $name . ',</p>';
                    $message .= '<p style="color:#080;font-size:18px;">Thank you for your interest in the EMUiNVENT. Unfortunately we will not be able to approve your registration request.</p>';
                    $message .= '<p style="color:#080;font-size:18px;">If you have questions, please email emu_invent@emich.edu.</p>';
                    $message .= '<br><p style="color:#080;font-size:18px;">EMUiNVENT</p>';
                    $message .= '</body></html>';
                }
                if (mail($to, $name, $subject, $message)) {

                    $resp['status'] = 'Success';
                    $resp['msg'] = 'Mail Has Been Sent Successfully!';


                    //$message ="Dear $name,
                    //We are excited to welcome your team(s) for participation in the EMUiNVENT competition. Please login using  :Username: $username, Password: $password @ http://grading.emuem.org/login.php to provide all details of the participating teams. Closer to the video submission deadline, you will receive another email with details of submission.EMUiNVENT 2021 will be entirely online. So please make sure you visit the submission system and provide all the information and materials in a timely manner.After the submission of videos is completed, a panel of professionals will judge all student projects. We will announce awards and winners in a broadcasted awards ceremony on March 12. You will receive more details about the ceremony and how to access it in the coming weeks.For more information and all deadlines, visit the https://emich.edu/emuinvent website. If you have questions, please email emu_invent@emich.edu.
                    //EMUiNVENT Team";
                } else {
                    $resp['status'] = 'Failed';
                    $resp['msg'] = 'Unable to send email. Please try again.';
                }
            }
        }





        return json_encode($resp);
    }


    function registration()
    {
        // Extract the POST data
        extract($_POST);

        // Validate and sanitize input
        $first_name = mysqli_real_escape_string($this->conn, $_POST['fname']);
        $last_name = mysqli_real_escape_string($this->conn, $_POST['lname']);
        $phone = mysqli_real_escape_string($this->conn, $_POST['contact']);
        $address = mysqli_real_escape_string($this->conn, $_POST['address']);
        $email = mysqli_real_escape_string($this->conn, $_POST['email']);
        $password = mysqli_real_escape_string($this->conn, $_POST['password']);
        $user_type = mysqli_real_escape_string($this->conn, $_POST['category']);

        // Check if the email already exists
        $existing_email_query = "SELECT * FROM tbl_user WHERE email = '$email'";
        $existing_email_result = $this->conn->query($existing_email_query);

        if ($existing_email_result->num_rows > 0) {
            $resp['status'] = 'Failed';
            $resp['msg'] = 'Email already exists';
        } else {
            $to = $email;
            $subject = "EMUiNVENT Sign Up Confirmation";


            // To send HTML mail, the Content-type header must be set
            $headers  = 'MIME-Version: 1.0' . "\r\n";
            $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";


            // Compose a simple HTML email message
            $message = '<html><body>';
            $message .= '<p style="color:#080;font-size:18px;">Dear ' . $first_name . ',</p>';
            $message .= '<p style="color:#080;font-size:18px;">Thank you for signing up for EMUiNVENT! The EMUiNVENT team will now review your registration. You will receive an email as soon as the review is complete.  </p>';
            $message .= '<p style="color:#080;font-size:18px;">For more information and all deadlines, visit the <a href="https://emich.edu/emuinvent">EMUiNVENT website</a>. If you have questions, please email emu_invent@emich.edu.</p>';
            $message .= '<br><p style="color:#080;font-size:18px;">EMUiNVENT</p>';
            $message .= '</body></html>';

            // Insert user data into the database
            $query = "INSERT INTO tbl_user (first_name, last_name, phone, email, password, user_type, address) VALUES ('$first_name', '$last_name', '$phone', '$email', '$password', '$user_type', '$address')";

            // Attempt to send email and execute query if email is sent
            if (mail($to, $subject, $message, $headers)) {
                if ($this->conn->query($query)) {
                    $resp['status'] = 'Success';
                    $resp['msg'] = "Sign up confirmation has been sent to your email address!";
                } else {
                    $resp['status'] = 'Failed';
                    $resp['msg'] = 'Unable to register. Please try again.';
                }
            } else {
                $resp['status'] = 'Failed';
                $resp['msg'] = 'Unable to send email. Please try again.';
            }
        }

        return json_encode($resp);
    }





    function delete_member()
    {

        $tab = $_POST['table'];
        $id = $_POST['id'];
        // $returns = $_POST['returns'];


        if ($this->conn->query("DELETE FROM $tab WHERE id = $id LIMIT 1")) {

            $resp['status'] = 'Success';
            $resp['msg'] = 'Delete User  Successfully!';
            $resp['loaddata'] = '
            <table class="table user-table">
              <thead>
                <tr>
                  <th scope="col">First Name</th>
                  <th scope="col">Last Name</th>
                  <th scope="col">Email</th>
                  <th scope="col">Phone</th>
                  <th scope="col">Address</th>
                  <th scope="col">UserType</th>
                  <th scope="col">Actions</th>
                </tr>
              </thead>
              <tbody>';

            $q_team = $this->conn->query("select * from tbl_user order by is_approved asc,id desc");

            while ($r_team = $q_team->fetch_assoc()) {
                $resp['loaddata'] .= '
                <tr>
                  <td>' . $r_team["first_name"] . '</td>
                  <td>' . $r_team["last_name"] . '</td>
                  <td>' . $r_team["email"] . '</td>
                  <td>' . $r_team["phone"] . '</td>
                  <td>' . $r_team["address"] . '</td>
                  <td>' . $r_team["user_type"] . '</td>
                  <td>
                    <div class="btn-container">';

                if ($r_team["is_approved"] == 0) {
                    $resp['loaddata'] .= '
                      <a onClick="return confirm(\'Do you want to approve the user?\')" href="#" class="btn mini purple approve-btn" data-id="' . $r_team['id'] . '" data-table="tbl_user" data-returns="users" data-flag="1">
                        <button type="button" style="margin:0px;" class="btn-gradient-success btn-sm">Approve</button>
                      </a>
                      <a onClick="return confirm(\'Do you want to disapprove the user?\')" href="#" class="btn mini purple approve-btn" data-id="' . $r_team['id'] . '" data-table="tbl_user" data-returns="users" data-flag="0">
                        <button type="button" style="margin:0px;" class="btn-gradient-success btn-sm" onclick="edit(this)">Disapprove</button>
                      </a>';
                } else {
                    $resp['loaddata'] .= '
                      <a onClick="return confirm(\'Do you want to disapprove the user?\')" href="#" class="btn mini purple approve-btn" data-id="' . $r_team['id'] . '" data-table="tbl_user" data-returns="users" data-flag="0">
                        <button type="button" style="margin:0px;" class="btn-gradient-success btn-sm" onclick="edit(this)">Disapprove</button>
                      </a>';
                }

                $resp['loaddata'] .= '
                      <a onClick="return confirm(\'Are you sure you want to delete?\')" href="#" class="btn mini purple delete-user-btn" data-id="' . $r_team['id'] . '" data-table="tbl_user" data-returns="users">
                        <button type="button" style="margin:0px;" class="btn-gradient-danger btn-danger btn-sm">Delete</button>
                      </a>
                    </div>
                  </td>
                </tr>';
            }

            $resp['loaddata'] .= '
              </tbody>
            </table>';
        } else {
            $resp['status'] = 'Failed';
            $resp['msg'] = 'Process Failed';
        }

        return json_encode($resp);
    }
    function delete_judge()
    {


        $jid = $_POST['id'];



        if ($this->conn->query("DELETE from tbl_judge_team where id = $jid")) {

            $resp['status'] = 'Success';
            $resp['msg'] = 'Delete Judge  Successfully!';
            $resp['loaddata'] = '
        <table class="table judge-table table1">
        <thead class="bg-dark text-light">
        <tr>
        
        <th scope="col">Judge</th>
        <th scope="col">Team Name</th>
        <th scope="col">Category</th>
        <th>Delete Record</th>
        
     
          
        </tr>
      </thead>
          <tbody>';

            $q_team = $this->conn->query("select distinct tj.id, first_name, last_name , project_team_name, tt.category 
            from `tbl_judge_team` tj, tbl_user tu, tbl_team tt
            WHERE tj.user_id=tu.id
            and tu.id = tj.user_id
            and tj.team_id = tt.id");


            while ($r_team = $q_team->fetch_assoc()) {
                $resp['loaddata'] .= '
            <tr> 
              <td>' . $r_team['first_name'] . ' ' . $r_team['last_name'] . '</td> 
              <td>' . $r_team['project_team_name'] . '</a></td> 
              <td>' . $r_team['category'] . '</a></td> 
              <td><a href="#" class="delete_judge" data-id="' . $r_team['id'] . '"><button type="button" style="margin:0px;"  class="btn-success btn-gradient-success btn-sm"  >Delete</button></a></td> 
          </tr>';
            }

            $resp['loaddata'] .= '
          </tbody>
        </table>';
        } else {
            $resp['status'] = 'Failed';
            $resp['msg'] = 'Process Failed';
        }

        return json_encode($resp);
    }

    function assign_judge_team()
    {
        $judge_id = $_POST['judge_id'];
        $team_ids = [
            $_POST['team_id_1'],
            $_POST['team_id_2'],
            $_POST['team_id_3'],
            $_POST['team_id_4'],
            $_POST['team_id_5'],
            $_POST['team_id_6']
        ];

        $success = true;

        foreach ($team_ids as $team_id) {
            if (!empty($team_id) && $team_id != 0) {
                $sql = "INSERT INTO `tbl_judge_team` (`team_id`, `user_id`) VALUES ('$team_id', '$judge_id')";
                if (!$this->conn->query($sql)) {
                    $success = false;
                    break;
                }
            }
        }

        if ($success) {
            $resp = array(
                'status' => 'Success',
                'msg' => 'Judge Assigned to Teams Successfully!'
            );
        } else {
            $resp = array(
                'status' => 'Failed',
                'msg' => 'Process Failed.'
            );
        }

        return json_encode($resp);
    }
    function year_change()
    {





        if (isset($_POST['selectedyear'])) {
            $selected_year = $_POST['selectedyear'];

            $content = '';
            $q_team = $this->conn->query("SELECT ts.*
        FROM (
            SELECT DISTINCT ttm.student_id
            FROM tbl_team_member AS ttm
            JOIN tbl_team AS t ON t.id = ttm.team_id
            WHERE t.year = $selected_year
        ) AS unique_students
        JOIN student AS ts ON unique_students.student_id = ts.student_id;
        ");
            $i = 1;
            $no_rows = mysqli_num_rows($q_team);
            while ($row = $q_team->fetch_assoc()) {

                $content .= '                                                           
        
        <tr>
        <td>' . $i . '</td>
        <td>' . $row['student_first_name'] . '</td>
        <td>' . $row['student_last_name'] . '</td>
        <td>' . $row['student_grade'] . '</td>
        <td>' . $row['t_shirt_size'] . '</td>
        <td>' . $row['student_school_name'] . '</td>
        <td>' . $row['student_school_district'] . '</td>
        <td>
            <a href="../student/edit_member.php?student_id=' . $row['student_id'] . '">
                <button type="button" class="btn btn-small btn-success px-3 py-2" name="submit">Edit</button>
            </a>
        </td>
        </tr>';




                $i++;
            }
            $response = array('content' => $content, 'selected_year' => $selected_year, 'no_rows' => $no_rows);
            echo json_encode($response);
        }
    }
}

$action = isset($_GET['action']) ? $_GET['action'] : '';
$api = new API();
switch ($action) {

    case ('edit_team_liveqa'):
        echo $api->edit_team_liveqa();
        break;
    case ('evaluation_team_update'):
        echo $api->evaluation_team_update();
        break;
    case ('judge_details_update'):
        echo $api->judge_detail_update();
        break;
    case ('approve_user'):
        echo $api->approve_user();
        break;
    case ('delete_member');
        echo $api->delete_member();
        break;
    case ('assign_judge_team');
        echo $api->assign_judge_team();
        break;

    case ('delete_judge');
        echo $api->delete_judge();
        break;
    case ('update_consent'):
        echo $api->update_consent();
        break;
    case ('photo_consent_form'):
        echo $api->photo_consent_form();
        break;
    case ('registration'):
        echo $api->registration();
        break;
    case ('edit_team'):
        echo $api->edit_team();
        break;
    case ('admin_edit_member'):
        echo $api->admin_edit_member();
        break;
    case ('year_change'):
        echo $api->year_change();
        break;
    case ('profile_updated'):
        echo $api->profile_updated();
        break;
    default:
        echo json_encode(array('status' => 'failed', 'error' => 'unknown action'));
        break;
}
