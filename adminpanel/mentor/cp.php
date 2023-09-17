<!-- home mentor  -->

<?php
include('../database/config.php');
include('control.php');

$id = $_SESSION['id'];
$name = $_SESSION['name'];
if (isset($_GET['year'])) {
	$year = $_GET['year'];
} else {
	$year = date("Y");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
	<title>Team Lists</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="css/style.css" type="text/css">
</head>

<style>
	html,
	body {
		height: 100%;
		width: 100%;
		padding: 0;
		margin: 0;
	}

	table {
		table-layout: fixed;
	}

	th {
		overflow: auto;
		max-width: 100%;
		white-space: nowrap;
	}

	td {
		overflow: auto;
		max-width: 100%;
		white-space: nowrap;
	}

	@media only screen and (max-width: 480px) {

		/* horizontal scrollbar for tables if mobile screen */
		.tablemobile {
			overflow-x: auto;
			display: block;
		}
	}
</style>
<?php include('../header.php'); ?>
<div id="wrapper" style="margin-top:20px;width:100%;">

	<body>



		<nav class="navbar navbar-expand bg-dark navbar-dark" style="margin-top:20px;width:100%;">
			<!-- Links -->
			<ul class="navbar-nav">

				<li class="nav-item" style="font-weight: bold;">
					<a class="nav-link" href="home.php">Home</a>
				</li>

				<li class="nav-item dropdown" style="font-weight: bold;">
					<a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
						Add
					</a>
					<div class="dropdown-menu" id="mainNavbar">
						<a class="dropdown-item" href="teams.php">Teams</a>

					</div>
				</li>

				<li class="nav-item dropdown" style="font-weight: bold;">
					<a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
						Previous year
					</a>
					<div class="dropdown-menu" id="mainNavbar">
						<?php
						$current = date("Y");
						$q_y = mysqli_query($con, "select distinct year
				from tbl_team tt, tbl_team_mentor ttm
				where ttm.team_id = tt.id
				and tt.deleted = 0
				and year <> $current");

						while ($q_y_d = mysqli_fetch_assoc($q_y)) {
							$y = $q_y_d['year'];
						?>

							<a class="dropdown-item" href="home.php?year=<?php echo $y; ?>"><?php echo $y; ?></a>
						<?php } ?>
					</div>

				</li>

				<li class="nav-item dropdown" style="font-weight: bold;">
					<a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
						Last Year Events
					</a>
					<div class="dropdown-menu" id="mainNavbar">
						<?php

						$current = date("Y");
						$q_y = mysqli_query($con, "select distinct year
				from tbl_team tt, tbl_team_mentor ttm
				where ttm.team_id = tt.id
				and tt.deleted = 0
				and year <> $current");

						while ($q_y_d = mysqli_fetch_assoc($q_y)) {
							$y = $q_y_d['year'];
						?>

							<a class="dropdown-item" href="home_previous.php?year=<?php echo $y; ?>"><?php echo $y; ?></a>
						<?php } ?>
					</div>

				</li>


				<li class="nav-item dropdown" style="font-weight: bold;">
					<a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
						<?php echo $name ?>
					</a>
					<div class="dropdown-menu" id="mainNavbar">
						<a class="dropdown-item" href="mentor.php">Profile</a>
						<a class="dropdown-item" href="logout.php">Logout</a>

					</div>
				</li>

				<!--<li class="nav-item">
					<a class="nav-link" href="addStudent.html">Add Student</a>
				</li>

				<li class="nav-item" id="addAccount">
					<a class="nav-link" href="addUser.html">Add Account</a>
				</li>-->
			</ul>
		</nav>
		<br>
		<div style="width:100%">
			<div class="col-12">
				<table class="table" style="margin-block-start: -20px">
					<thead class="thead-dark" id="table">
						<tr>
							<th>Team Name</th>
							<th>Team Description</th>
							<th>Category</th>
							<th>Team Members</th>
							<th>Video Pitch</th>
							<th>LogBook</th>
							<th>Status</th>
							<?php if (($year) == date("Y")) { ?>
								<th>Actions</th>
							<?php } ?>
						</tr>
					</thead>
					<tbody>

						<?php
						$q_team = mysqli_query($con, "select distinct tt.id as team_id,tt.project_team_name as project_name,tt.project_description,tt.category,tt.video_pitch, tt.log_book
				from tbl_team tt, tbl_team_mentor ttm
				where ttm.user_id = $id 
				and ttm.team_id = tt.id
				and year = '$year'
				and tt.deleted = 0");

						while ($r_team = mysqli_fetch_assoc($q_team)) {
							$team_id = $r_team['team_id'];
							$team_m_q = mysqli_query($con, "select GROUP_CONCAT(student_first_name) as members from tbl_team_member where team_id = $team_id");
							$team_m_r = mysqli_fetch_assoc($team_m_q);




						?>

							<tr>
								<td><a href="viewteams.php?team_id=<?php echo $r_team['team_id'] ?>"><?php echo $r_team['project_name'] ?></a></td>
								<td><a href="viewteams.php?team_id=<?php echo $r_team['team_id'] ?>"><?php echo $r_team['project_description'] ?></a></td>
								<td><a href="viewteams.php?team_id=<?php echo $r_team['team_id'] ?>"><?php echo $r_team['category'] ?></a></td>
								<td><?php echo $team_m_r['members'] ?></td>
								<?php if ($r_team['video_pitch']) { ?>
									<td><a href="<?php echo $r_team['video_pitch'] ?>" target="_blank">Video Pitch</a></td>
								<?php } else { ?>
									<td></td>
								<?php }
								if ($r_team['log_book']) {  ?>
									<td><a href="http://grading.emuem.org/Team/<?php echo $r_team['log_book'] ?>">LogBook</a></td>
								<?php } else { ?>
									<td></td>
								<?php }
								if (isset($r_team['log_book']) && isset($r_team['video_pitch'])) { ?>
									<td><?php echo 'Complete'; ?></td>
								<?php } else {
									if (empty($r_team['log_book'])) {
										$text = 'No LogBook';
									}
									if (empty($r_team['video_pitch'])) {
										$text = $text . ' No Video Pitch';
									}
								?>
									<td title="<?php echo $text; ?>"><?php echo 'Incomplete'; ?></td>
								<?php } ?>
								<?php if (($year) == date("Y")) { ?>
									<td>
										<a href="edit_team.php?team_id=<?php echo $team_id ?>"><button type="button" style="margin:0px;" class="btn-success btn-sm" onclick="edit(this)">Update Details</button></a>
										<a onClick="return confirm('Are you sure you want to delete?')" href="set_delete.php?id=<?php echo $team_id ?>&table=tbl_team&return=home" class="btn mini purple"> Delete</a>
									</td>
								<?php } ?>
								</td>
							</tr>
						<?php } ?>

					</tbody>
				</table>
			</div>

		</div>

		<!-- <div class="container d-flex justify-content-center col-md-8">
        <p class="dbtn">
            <button type="button" id="signout-btn" onclick="signOutUser()" class="btn btn-danger"> SignOut </button>
        </p>
    </div> -->

	</body>
	<div>

</html>


<!-- registeration  -->
<?php
session_start();
include('database/config.php');
#include('control.php'); 
$general = 0;
extract($_POST);
if (isset($_POST['submit'])) {
	$l_q = mysqli_query($con, "select * from tbl_user where email = '$email'");
	$num_rows_1 = mysqli_num_rows($l_q);
	if ($num_rows_1 < 1) {
		$query = "insert into tbl_user (first_name,last_name,phone,email,password,user_type,address) values ('$first_name','$last_name','$phone','$email','$password','$user_type','$address')";
		$result = mysqli_query($con, $query);

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
			//We are excited to welcome your team(s) for participation in the EMUiNVENT competition. Please login using  :Username: $username, Password: $password @ http://grading.emuem.org/login.php to provide all details of the participating teams. Closer to the video submission deadline, you will receive another email with details of submission.EMUiNVENT 2021 will be entirely online. So please make sure you visit the submission system and provide all the information and materials in a timely manner.After the submission of videos is completed, a panel of professionals will judge all student projects. We will announce awards and winners in a broadcasted awards ceremony on March 12. You will receive more details about the ceremony and how to access it in the coming weeks.For more information and all deadlines, visit the https://emich.edu/emuinvent website. If you have questions, please email emu_invent@emich.edu.
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
				//We are excited to welcome your team(s) for participation in the EMUiNVENT competition. Please login using  :Username: $username, Password: $password @ http://grading.emuem.org/login.php to provide all details of the participating teams. Closer to the video submission deadline, you will receive another email with details of submission.EMUiNVENT 2021 will be entirely online. So please make sure you visit the submission system and provide all the information and materials in a timely manner.After the submission of videos is completed, a panel of professionals will judge all student projects. We will announce awards and winners in a broadcasted awards ceremony on March 12. You will receive more details about the ceremony and how to access it in the coming weeks.For more information and all deadlines, visit the https://emich.edu/emuinvent website. If you have questions, please email emu_invent@emich.edu.
				//EMUiNVENT Team";
			} else {
				echo 'Unable to send email. Please try again.';
			}
		} else {
			#echo "user already exists";
			echo '<script>alert("User account with this email ID already exists, please click on Login or forgot password")</script>';
		}
	}
}

?>





<?php
include('../database/config.php'); 
include('control.php'); 

$id = $_SESSION['id'];
$name = $_SESSION['name'];
$q = mysqli_query($con,"select * from tbl_user where id = $id");
$r = mysqli_fetch_assoc($q);
extract($_POST);
if(isset($_POST['submit']))
{
	echo 'inside if';
	$q = ("update tbl_user set first_name = '$first_name', 
												last_name = '$last_name',
												phone = '$phone',
												email = '$email',
												password = '$password',
												category = '$category' where id = $id");
	$q_u=mysqli_query($con,$q);
	if($q_u)												
	{
		header("location:JudgeDetails.php");
		
	}
	else 
	{
		echo("Update failed".$q);
	}
	
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Edit Profile</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="css/style.css" type="text/css">
</head>

<style>
html, body {
    top:0;
    bottom:0;
    left:0;
    right:0;
    
   
}
</style>
<body>
<div id="wrapper">
   <div class="jumbotron col-md-12" style="font-size: 16px;
    height: 10em;margin-block-start: -55px;">
       <img class="card-img-top" src="images/emulogo.png" alt="logo image" style="width:99%;height: 226px;">
    </div>

	<nav class="navbar navbar-expand bg-dark navbar-dark" style="    margin-top: 140px;
    width: 1289px;
    left: 2.3%;">
        <!-- Links -->
        <ul class="navbar-nav">

            <li class="nav-item" style="font-weight: bold;">
                <a class="nav-link" href="home.php">Home</a>
            </li>
			
			
			<li class="nav-item dropdown" style="font-weight: bold;">
                <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                    Add
                </a>
                <div class="dropdown-menu"  id="mainNavbar">
                    <!--<a class="dropdown-item" href="teams.php">Teams</a>-->
                    <a class="dropdown-item" href="add_judges.php">Judges</a>
                </div>
            </li>
			
			
			<li class="nav-item dropdown" style="font-weight: bold;">
                <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                    View
                </a>
                <div class="dropdown-menu"  id="mainNavbar">
                    <a class="dropdown-item" href="teams.php">Teams</a>
                    <a class="dropdown-item" href="judges.php">Judges</a>
                </div>
            </li>
			
			
			<li class="nav-item dropdown" style="font-weight: bold;">
                <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                    Assign Teams vs Judges
                </a>
                <div class="dropdown-menu"  id="mainNavbar">
                    <a class="dropdown-item" href="assign_judge_team.php">Assign Teams vs Judges</a>
                    <a class="dropdown-item" href="view_judge_team.php">View Assigned Teams vs Judges</a>
                </div>
            </li>
			
			<li class="nav-item" style="font-weight: bold;">
                <a class="nav-link" href="evaluation_results.php">Evaluation Details</a>
            </li>
			
			 <li class="nav-item dropdown" style="font-weight: bold;">
                <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                    <?php echo $name?>
                </a>
                <div class="dropdown-menu"  id="mainNavbar">
					<a class="dropdown-item" href="profile.php">Profile</a>
                    <a class="dropdown-item" href="logout.php">Logout</a>
                    
                </div>
            </li>

            <!--<li class="nav-item">
                <a class="nav-link" href="addStudent.html">Add Student</a>
            </li>

            <li class="nav-item" id="addAccount">
				<a class="nav-link" href="addUser.html">Add Account</a>
            </li>-->
        </ul>
    </nav>





    <div class="container d-flex justify-content-left col-md-10">
        <div class="col-9">
		<form method="post" enctype="multipart/form-data" >
            <br>
            <h3> Profile:</h3>
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
                            <label for="email"> <b> First Name: </b> </label>
                            <input type="text" class="form-control" name="first_name" id="first_name" value="<?php echo $r['first_name']?>">
                        </div>
                    </td>
					
				</tr>	
				<tr>

                    <td>
                        <div class="form-group">
                            <label for="email"><b> Last Name:</b></label>
                            <input type="text" class="form-control" name="last_name" id="last_name" value="<?php echo $r['last_name']?>">
                        </div>
                    </td>
				</tr>
				<tr>	
                    <td>
                        <div class="form-group">
                            <label for="email"><b> Email:</b></label>
                           <input type="text" class="form-control" name="email" id="email" value="<?php echo $r['email']?>">
                        </div>
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <div class="form-group">
                            <label for="email"><b>Password:</b></label>
                           <input type="text" class="form-control" name="password" id="password" value="<?php echo $r['password']?>">
                        </div>
                    </td>
                </tr>

                <tr>

                    <td>
                        <div class="form-group">
                            <label for="pwd"><b>Contact No:</b></label>
                            <input type="text" class="form-control" name="phone" id="phone" value="<?php echo $r['phone']?>">
                        </div>
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <div class="form-group">
                            <label for="studentType"><b>Category:</b></label>
                            <select class="form-control" id="SelectDepartment" name="category">
							<option selected value="<?php echo $r['category']?>"><?php echo $r['category']?></option>
                                <option value="Professional">Professional/Engineers</option>
                                <option value="Faculty">Faculty </option>
								<option value="K-12 Teachers">K-12 Teachers </option>
                                <option value="Student">Student</option>
                                <option value="Pre-Service Students">Pre-Service Students</option>
								<option value="Others">Others</option>
                            </select>
                        </div>

                    </td>
                </tr>

               

            </table>

            <div id="alertBox"> </div>
            <button type="submit" class="btn btn-primary" name="submit">Submit</button>
			</form>
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
</body>
</html>