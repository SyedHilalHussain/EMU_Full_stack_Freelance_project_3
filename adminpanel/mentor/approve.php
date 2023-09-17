<?php
session_start();
#$tab = $_GET['table'];
$id = $_GET['id'];
#$return = $_GET['return'];
$flag = $_GET['flag'];
##echo $return;
include('../superadmin/config.php'); 

ob_start();

 
if(mysqli_query($conn,"update tbl_student_mentor set approve = $flag where student_id = $id"))
{
   
	$query = mysqli_query($conn, "select * from tbl_user where id = $id");
	$row = mysqli_fetch_assoc($query);
	
		  $to = 'syedhilalkhan64@gmail.com';
		  $username = $row['email'];
		  $password = $row['password'];
		  $name = $row['first_name'];
		  $user_type = $row['user_type'];
		  $first_name = $row['first_name'];
		  $last_name = $row['last_name'];
		  $email = $row['email'];
		  $phone = $row['phone'];
		  $address = $row['address'];
		  
		  
		  
		  if($flag == 1)
		  {
	
	      	
		
         $subject = "EMUiNVENT Student Registration - Mentor Approved";
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
		$message .= '<p style="color:#080;font-size:18px;">User Type: '.$user_type.'</p>';
		$message .= '<p style="color:#080;font-size:18px;">User first name: '.$first_name.'</p>';
		$message .= '<p style="color:#080;font-size:18px;">User last name: '.$last_name.'</p>';
		$message .= '<p style="color:#080;font-size:18px;">User email: '.$email.'</p>';
		$message .= '<p style="color:#080;font-size:18px;">User phone: '.$phone.'</p>';
		$message .= '<p style="color:#080;font-size:18px;">User address: '.$address.'</p>';
		$message .= '<p style="color:#080;font-size:18px;">Mentor Name: '.$_SESSION['name'].'</p>';
		$message .= '<p style="color:#080;font-size:18px;">Mentor email: '.$_SESSION['email'].'</p>';
		$message.= '<p style="color:#080;font-size:18px;">To approve/disapprove user, please click <a href="https://emuinvent.emuem.org/login.php">here</a> with Super Admin credentials and click on View>Users</p>';
		$message .= '<br><p style="color:#080;font-size:18px;">EMUiNVENT</p>';	
		$message .= '</body></html>';	
		
		
        if (mail($to, $subject, $message, $headers)) {
		
		  ##echo 'Your mail has been sent successfully.';
				
			
        //$message ="Dear $name,
		//We are excited to welcome your team(s) for participation in the EMUiNVENT competition. Please login using  :Username: $username, Password: $password @ http://emuinvent.emuem.org/login.php to provide all details of the participating teams. Closer to the video submission deadline, you will receive another email with details of submission.EMUiNVENT 2021 will be entirely online. So please make sure you visit the submission system and provide all the information and materials in a timely manner.After the submission of videos is completed, a panel of professionals will judge all student projects. We will announce awards and winners in a broadcasted awards ceremony on March 12. You will receive more details about the ceremony and how to access it in the coming weeks.For more information and all deadlines, visit the https://emich.edu/emuinvent website. If you have questions, please email emu_invent@emich.edu.
		//EMUiNVENT Team";
         } else {
             echo 'Unable to send email. Please try again.';
         }
		
	}
	else 
	{
		 $subject = "EMUiNVENT Student Registration - Mentor Disapproved";
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
		$message .= '<p style="color:#080;font-size:18px;">User Type: '.$user_type.'</p>';
		$message .= '<p style="color:#080;font-size:18px;">User first name: '.$first_name.'</p>';
		$message .= '<p style="color:#080;font-size:18px;">User last name: '.$last_name.'</p>';
		$message .= '<p style="color:#080;font-size:18px;">User email: '.$email.'</p>';
		$message .= '<p style="color:#080;font-size:18px;">User phone: '.$phone.'</p>';
		$message .= '<p style="color:#080;font-size:18px;">User address: '.$address.'</p>';
		$message .= '<p style="color:#080;font-size:18px;">Mentor Name: '.$_SESSION['name'].'</p>';
		$message .= '<p style="color:#080;font-size:18px;">Mentor email: '.$_SESSION['email'].'</p>';
		$message.= '<p style="color:#080;font-size:18px;">To approve/disapprove user, please click <a href="https://emuinvent.emuem.org/login.php">here</a> with Super Admin credentials and click on View>Users</p>';
		$message .= '<br><p style="color:#080;font-size:18px;">EMUiNVENT</p>';	
		$message .= '</body></html>';	
		
		
        if (mail($to, $subject, $message, $headers)) {
		
		  ##echo 'Your mail has been sent successfully.';
				
			
        //$message ="Dear $name,
		//We are excited to welcome your team(s) for participation in the EMUiNVENT competition. Please login using  :Username: $username, Password: $password @ http://emuinvent.emuem.org/login.php to provide all details of the participating teams. Closer to the video submission deadline, you will receive another email with details of submission.EMUiNVENT 2021 will be entirely online. So please make sure you visit the submission system and provide all the information and materials in a timely manner.After the submission of videos is completed, a panel of professionals will judge all student projects. We will announce awards and winners in a broadcasted awards ceremony on March 12. You will receive more details about the ceremony and how to access it in the coming weeks.For more information and all deadlines, visit the https://emich.edu/emuinvent website. If you have questions, please email emu_invent@emich.edu.
		//EMUiNVENT Team";
         } else {
				echo 'Unable to send email. Please try again.';
         }
		 
	#echo "<script>alert('Updated Sucessfully')</script>";
	#header("location:students.php"); 
	
	}
	 			
		
}

echo "<script type='text/javascript'>window.location.href = 'students.php';</script>";
        exit();	
?>