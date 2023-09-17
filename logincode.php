<?php
include './adminpanel/superadmin/config.php';


if(isset($_POST['login'])) {

	$userEmail = $_POST['email'];
	$userPassword = $_POST['password'];
	$login_q = mysqli_query($conn,"select * from tbl_user where email = '$userEmail' and password = '$userPassword'");

	$login_d = mysqli_fetch_assoc($login_q);
	session_start();
	$_SESSION['id'] = $login_d['id'];
	$_SESSION['name'] = $login_d['first_name'];
	$_SESSION['user_type'] = $login_d['user_type'];
	$_SESSION['email'] = $login_d['email'];

	if(mysqli_num_rows($login_q)>0){
	if($_SESSION['user_type'] == 'SuperUser')
	{
		$userid = $_SESSION['id'];
        $username=$_SESSION['name'];
        $usertype=$_SESSION['user_type'];
      header("Location:././adminpanel/superAdmin/grading.php");
     
      
		
	}
	elseif ($_SESSION['user_type'] == 'Organizer')
	{
		$userid = $_SESSION['id'];
        
        $username=$_SESSION['name'];
        $usertype=$_SESSION['user_type'];
 
      
		header("Location:admin/admin_home.php");
		
	
		
	}
	elseif ($_SESSION['user_type'] == 'Judge')
	{

		$userid = $_SESSION['id'];
        
        $username=$_SESSION['name'];
        $usertype=$_SESSION['user_type'];
    
		header("Location:././adminpanel/judges/home.php");
		
		
	
		
	}
	elseif ($_SESSION['user_type'] == 'Mentor')
	{
      
        $username=$_SESSION['name'];
        $usertype=$_SESSION['user_type'];
		$userid = $_SESSION['id'];
      
		header("Location:././adminpanel/mentor/home.php");
		
		#echo "<script>alert('Submissions were closed on Feb 22nd. 2020. Independent Inventors can email their submission to svivek@emich.edu by the 5:00PM Feb 24, 2020')</script>";
		
	}
	elseif ($_SESSION['user_type'] == 'General User')
	{
   
        $username=$_SESSION['name'];
        $usertype=$_SESSION['user_type'];
		$userid = $_SESSION['id'];
   
		header("Location:././adminpanel/generaluser/home.php");
		#echo "<script>alert('Submissions were closed on Feb 22nd. 2020. Independent Inventors can email their submission to svivek@emich.edu by the 5:00PM Feb 24, 2020')</script>";
		
	}
	elseif ($_SESSION['user_type'] == 'Student')
	{
		$userid = $_SESSION['id'];
		$usertype=$_SESSION['user_type'];
		$login_q_s = mysqli_query($conn,"select * from tbl_student_mentor where student_id = $userid and approve = 1");
		$c_rows = mysqli_num_rows($login_q_s);
		if($c_rows > 0)
		{
			$row = mysqli_fetch_assoc($login_q_s);
			$_SESSION['mentor_id'] = $row['mentor_id'];
			header("Location:././adminpanel/student/home.php");
		}
		else {
			echo "<script>alert('User not approved');</script>";
		}
		#echo "<script>alert('Submissions were closed on Feb 22nd. 2030. Independent Inventors can email their submission to svivek@emich.edu by the 5:00PM Feb 24, 2030')</script>";
		
	}
   
	
	else
	{
    echo "<script>alert('Invalid LogIn')</script>";
		
	}
}else{
    echo "<script>alert('Invalid LogIn')</script>";
	}


}


?>