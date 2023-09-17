<?php
include('../database/config.php'); 
include('control.php'); 
$url= $_SERVER['REQUEST_URI'];

$id = $_SESSION['id'];
$team_id = $_GET['team_id'];
$mentor_id = $_SESSION['mentor_id'];

$name = $_SESSION['name'];
$mentor_id = $_SESSION['mentor_id']	;


$q_vt = mysqli_query($con,"select distinct tt.id as team_id,tt.project_team_name as project_name,tt.category,tt.project_team_name,tt.project_description,tu.first_name, tu.last_name,tt.video_pitch, tt.log_book,tu.email 
from tbl_team tt, tbl_team_mentor ttm, tbl_user tu
											where tt.id = $team_id
											and tt.id = ttm.team_id
											and ttm.user_id in (select mentor_id from tbl_student_mentor where student_id = $id)
											and ttm.user_id = tu.id
                                            and tt.deleted = 0");

$d_vt = mysqli_fetch_assoc($q_vt);
$c_vt = mysqli_num_rows($q_vt);
if($c_vt > 0 ) { 

$url = $d_vt['video_pitch'];
preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $url, $match);
$youtube_id = $match[1];


$sql_students = mysqli_query($con,"select * from tbl_team_member where team_id = $team_id and deleted = 0");
$c_students = mysqli_num_rows($sql_students);
}
else 
{
	echo "<script>alert('No Such Team Available')</script>";
}

extract($_POST);
if(isset($_POST['submit'])) {
$sql  = "update tbl_team set project_team_name = '$project_title', project_description = '$project_description',category = '$category' where id = $team_id";
$r = mysqli_query($con,$sql);
$sec = "10";
echo "<script type='text/javascript'>window.location.href = 'home.php';</script>";	
}

if(isset($_POST['submit_student'])) {
	$sql_u = "update tbl_team_member set student_first_name = '$student_first_name', student_last_name = '$student_last_name', student_grade = '$student_grade', student_school_name = '$student_school_name', student_school_district = '$student_school_district', student_school_county = '$student_school_county', 	t_shirt_size = '$student_tshirt' where id = $student_id";
	$u = mysqli_query($con,$sql_u);
}
$timezone = date_default_timezone_set('America/New_York');
$date = date('Y-m-d H:i:s');
$today_at_midnight = strtotime('midnight');

$date_check = '2021-02-27 00:00:00';

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
<link rel="shortcut icon" href="http://emuinvent.emuem.org/favicon.png">
</head>
<?php include('../header.php');?>
<div id="wrapper" style="margin-top:20px;width:100%;">
<body>

    <?php include('navbar.php');?>
    <br>

 <div class="container d-flex justify-content-left col-md-12">
        <div class="col-12" id="editDetails">
            <br>
            <h3>View Team:</h3>
            <br>
			
            <table class="table table-borderless">
			 <form method="post" enctype="multipart/form-data" >
                <thead class="thead-dark">
                    <tr>
                        <th colspan="3"> Basic Information </th>
                     </tr>
                    </thead>

                <tr>
                    <td>
                        <div class="form-group">
                            <label for="email"> <b> Mentor Name: </b> </label>
                            <input type="text" readonly class="form-control" id="studentName" value="<?php echo $d_vt['first_name'].' '.$d_vt['last_name']?>" placeholder="Enter your name">
                        </div>
                    </td>

                    <td>
                        <div class="form-group">
                            <label for="email"><b> Mentor Email:</b></label>
                            <input type="text" readonly class="form-control" id="studentFN" value="<?php echo $d_vt['email']?>"
                                placeholder="Enter your Father's name">
                        </div>
                    </td>

                    
                </tr>

                <tr>
				
					<td>
                        <div class="form-group">
                            <label for="email"><b> Project Title:</b></label>
                            <input type="text" class="form-control" id="studentRegNo" value="<?php echo $d_vt['project_name']?>" name="project_title">
                        </div>
                    </td>
					
					
					<td colspan="6">
                     
						<div>
						<label for="studentType">Team Category:</label>
						<select name="category" class="form-control" required>
							<option>Select Student Grade</option>
							<option value="K-2" <?php if($d_vt['category'] == 'K-2') { echo 'selected';}?>>K-2</option>
							<option value="3-5" <?php if($d_vt['category'] == '3-5') { echo 'selected';}?>>3-5</option>
							<option value="6-8" <?php if($d_vt['category'] == '6-8') { echo 'selected';}?>>6-8</option>
							<option value="9-12" <?php if($d_vt['category'] == '9-12') { echo 'selected';}?>>9-12</option>
							
						</select>
						</div>
						
                    </td>
					
					
					
                    
					
					
					
					
					  
					
                </tr>
				
				<tr>
				
							
				<td colspan="2">
                        <div class="form-group">
                            <label for="email"><b>Project Description:</b></label>
                            <textarea class="form-control" name="project_description"><?php echo $d_vt['project_description']?></textarea>
                        </div>
                    </td>
				</tr>

                <tr>
				<?php if($d_vt['video_pitch']) { ?>
                    <td>
					<?php if ($youtube_id=='') {?>
						<div class="form-group">
							<video width="300" height="300" controls>
							  <source src="<?php echo $d_vt['video_pitch']?>" type="video/mp4">
							  <source src="<?php echo $d_vt['video_pitch']?>" type="video/ogg">
							</video>
								</div>	
						<?php } else {?>		
						<div class="form-group">
							<iframe width="300" height="300" src="https://www.youtube.com/embed/<?php echo $youtube_id?>" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
								</div>	
						<?php }?>
				
                      
                    </td>
					<?php } ?>	
					<?php if($d_vt['log_book']) { ?>
                    <td>
					  <div class="form-group">
                            <label for="pwd"><b>LogBook:</b></label>
                            <a href="../<?php echo $d_vt['log_book']?>">LogBook</a>
                        </div>
                    </td>
					<td>
                
				
				</td>	
					<?php } ?>
				
                </tr>
				
               <?php if (($year) == date("Y")) { 
						if($date <= $date_check)
						{
						?>
                <tr>
				<td>
                 <div class="form-group">
				<button type="submit" class="btn btn-success" name="submit">Submit</button>	
				</div>
				</td>
                </tr>
				<?php } } ?>
			</form>
			<?php if (($year) == date("Y")) { 
						if($date <= $date_check)
						{
						?>
			<tr>
				<td>
				<label>Upload docs</label>
				<!--<a target="_blank" href="edit_team.php?team_id=<?php echo $team_id;?>" ><button type="submit" class="btn btn-success" name="submit">Edit video pitch/logbook</button></a>	-->
				<a href="edit_team.php?team_id=<?php echo $team_id; ?>"><button type="submit" class="btn btn-success" name="submit">Edit video pitch/logbook</button></a>	
								
				</td>
				</tr>
				
			<?php } } ?>	
            </table>

            <!-- Basic Requirments for students ends here -->



			
            <!-- Requirments for current students -->

            <table class="table table-borderless" style="<?php if($c_students > 0) { echo 'margin-top:-175px'; } else { echo 'margin-top:-10px'; }?>">
			
                <thead class="thead-dark">
                    <tr>
                        <th colspan="3"> Current Team Members </th>
                     </tr>
                    </thead>

				
				<?php
				$t_q = mysqli_query($con,"select * from tbl_team_member where team_id = $team_id and deleted=0")	;
				$i=1;
				while ($row = mysqli_fetch_assoc($t_q))
				{
				
				?>
				
				
        
					
					
						
							<tr>
							
								<td>
								
								
									<!--div class="top-row"-->
									<div >
										<label>
											First Name
										</label>
										<input type="text" class="form-control" readonly autocomplete="off" value="<?php echo $row['student_first_name']?>" name="student_first_name"/>
									</div>
								</td>	
									<br>
								<td>	
									<div >
										<label>
											Last Name
										</label>
										<input type="text"readonly class="form-control" autocomplete="off" value="<?php echo $row['student_last_name']?>" name="student_last_name"/>
									</div>
								</td>	
									<br>
								<td>	
									<div>
									<label for="studentType">Student Grade:</label>
									<select name="student_grade" class="form-control" readonly>
										
										<option value="<?php echo $row['student_grade']?>"><?php echo $row['student_grade']?></option>
										<option>Select Student Grade</option>
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
									<br>
								<td>	
									<div >
										<label>
											T-Shirt Size
										</label>
										<select name="student_tshirt" class="form-control" readonly>
										<option value="<?php echo $row['t_shirt_size']?>"><?php echo $row['t_shirt_size']?></option>
										<option>Select Student Grade</option>
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
									<br>
								<td>	
									<div >
										<label>
											School Name
										</label>
										<input type="text"readonly autocomplete="off" class="form-control" value="<?php echo $row['student_school_name']?>" name="student_school_name"/>
									</div>
								</td>	
									<br>
								<td>	
									<div >
										<label>
											School District
										</label>
										<input type="text"readonly autocomplete="off" class="form-control" value="<?php echo $row['student_school_district']?>" name="student_school_district"/>
									</div>
							      	
								</td>
								
								
								
								<td>
								<label>Edit</label>
								<a href="edit_member_details.php?student_id=<?php echo $row['id']; ?>"><button type="submit" class="btn btn-success" name="submit">Edit</button></a>	
								<!--<a onClick="return confirm('Are you sure you want to delete?')" href="set_delete.php?id=<?php echo $row['id'];?>&table=tbl_team_member&return=home" class="btn btn-success" style="    margin-bottom: -80px;"> Delete</a>-->
								
								</td> 
								
							</tr>
							
						
				
				
				
				
				
                <?php $i++; } ?>
			<tr><td><a href="add_more_students.php?team_id=<?php echo $team_id; ?>"><button type="button" name="add" id="add" class="btn btn-success">Add More Team Members</button></a></td></tr>
		
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
</html>	


<!-- add team
 -->

 <?php
include('../database/config.php'); 
include('control.php'); 
$url= $_SERVER['REQUEST_URI'];
$id = $_SESSION['id'];
$name = $_SESSION['name'];
$mentor_id = $_SESSION['mentor_id'];
$year = date("Y");
$timezone = date_default_timezone_set('America/New_York');
$date = date('Y-m-d H:i:s');
$today_at_midnight = strtotime('midnight');

$date_check = '2030-02-27 00:00:00';
echo $date;
if (($year) == date("Y")) { 
if($date <= $date_check)
						{
echo 'isnide'							;
$student = 0;
$upload = 0;
$team_id = -1;
$team_select = 0;
if(!isset($team))
{
	$team = 0;
}

extract($_POST);

if(isset($_POST['submit_check'])) {
	
	if($terms)
	{
		$_SESSION['team'] = 1;
	}
	
}

if(isset($_POST['submit_team_select'])) {
	$team_select = 1;
	if($team_id > 0) 
	{
		header("location:viewteams.php?team_id=$team_id");
	}
	
}

if(isset($_POST['submit_team'])) {
$year = date("Y");
$project_description = mysqli_real_escape_string($con,$_POST['project_description']);
#echo 'tesitng'.$year;
$sql = mysqli_query($con,"insert into tbl_team (project_team_name,project_description,category,year) values ('$team_name', '$project_description','$category','$year')")	;
if($sql)
{
	$team_id = mysqli_insert_id($con);
	$team_q = mysqli_query($con,"insert into tbl_team_mentor values (NULL,$team_id,$mentor_id,'','','')");
	if($team_q)
	{
		$student = 1;
		$team_submit = 1;
		foreach( $_POST[ 'student_id' ] as $p )
		{
        //$q_u = mysqli_query($con, "select * from tbl_user where id= $p");
		//$r_u = mysqli_fetch_assoc($q_u);
		mysqli_query($con,"update tbl_team_member set team_id = $team_id where student_id = $p");
		}
	
	}
	
}
else 
{
	echo "<script>alert('Database error. Please report to admin!')</script>";
}
echo "<script type='text/javascript'>window.location.href = 'home.php';</script>";
}
#echo 'outside the script';

if(isset($_POST['submit_update']))	
{
$team_id = $_POST['team_id'];
$year = date("Y");
$project_description = mysqli_real_escape_string($con,$_POST['project_description']);

#echo 'inside the script';

$sql = mysqli_query($con,"update tbl_team set project_team_name ='$team_name' ,
                                            ,project_description = '$project_description',
											category = '$category' where id = $team_id" );
											
											
foreach($_POST['student_id'] as $p)
		{
        //$q_u = mysqli_query($con, "select * from tbl_user where id= $p");
		//$r_u = mysqli_fetch_assoc($q_u);
		mysqli_query($con,"update tbl_team_member set team_id = $team_id where student_id = $p");
		#echo "update tbl_team_member set team_id = $team_id where student_id = $p";
		}	
echo "<script type='text/javascript'>window.location.href = 'home.php';</script>";	
}



} else { 
	echo "<script>alert('Submission deadline is 02/26/2021 12:00:00')</script>";
	echo "<script type='text/javascript'>window.location.href = 'home.php';</script>";	
	} 
	}
  #echo "<script type='text/javascript'>window.location.href = 'home.php';</script>";  


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Add Team</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="css/style.css" type="text/css">
<link rel="shortcut icon" href="http://emuinvent.emuem.org/favicon.png">
</head>
<style>
.btn-success {
    color: #fff;
    background-color: #78CC6F;
    border-color: #78CC6F;
}
</style>
<?php include('../header.php');?>
<div id="wrapper" style="width:100%;">
<body>

  <?php include('navbar.php');?>
    <br>

  
  <style>
	body {font-family: Arial;}

	/* Style the tab */
	.tab {
	  overflow: hidden;
	  border: 1px solid #ccc;
	  background-color: #f1f1f1;
	}

	/* Style the buttons inside the tab */
	.tab button {
	  background-color: inherit;
	  float: left;
	  border: none;
	  outline: none;
	  cursor: pointer;
	  padding: 14px 16px;
	  transition: 0.3s;
	  font-size: 17px;
	}

	/* Change background color of buttons on hover */
	.tab button:hover {
	  background-color: #ddd;
	}

	/* Create an active/current tablink class */
	.tab button.active {
	  background-color: #ccc;
	}

	/* Style the tab content */
	.tabcontent {
	  display: none;
	  padding: 6px 12px;
	  border: 1px solid #ccc;
	  border-top: none;
	}
</style>
<link rel="shortcut icon" href="http://emuinvent.emuem.org/favicon.png">
</head>
<body>

<!--<h2>Team Registration</h2>-->


<div class="tab">
  <!--<button class="tablinks" onclick="openCity(event, 'London')">Project Details</button>-->
 <!-- <button class="tablinks" onclick="openCity(event, 'Paris')">Student Details</button> -->
  
</div>

<div id="Tokyo" class="tabcontent" style=" <?php if(isset($_SESSION['team']) || $terms > 0) { echo 'display:none'; } else { echo 'display:block';}?> ">
  <h3>Project  Details</h3>
  <form method="post" enctype="multipart/form-data" >
				
                <?php 
				$team_q = mysqli_query($con, "select * from tbl_team where id = $team_id");
				$row = mysqli_fetch_assoc($team_q);
				
				?>
				<tr>
                    <td colspan="6">
                     <br>
						<div >
                        <h6>You will need the following for the competition</h6>    
						<ol>
						<li>
						<p>Submission of completed Log Book  </p>
						</li>
						<li>
						<p>A video pitch</p>
						</li>
						<li>
						<p>Demonstration of working or non-working prototype in the video pitch      </p>
						</li>
						<li>
						<p>Display of Trifold board in the video pitch      </p>
						</li>
<li>
						<p>Registration fee $20 per team (Check made to Eastern Michigan University)     </p>
						</li>
<li>
						<p>A one minute video by student(s) talking about their experience with their invention and /or with EMUiNVENT competition (Optional)       </p>
						</li>
						<li>
						<p>Photo Consent form (Download below) signed by the parents should be provided      </p>
						</li>
						<a href="Photo-video waiver form1.pdf" >Download Photo Consent Form</a>
						<br>
						</ol>
						
						<input type="checkbox" name="terms" id="terms" required <?php if(isset($_SESSION['team']) || $terms > 0) { echo 'checked'; } ?> >  I Agree to the Terms & Conditions
						
						
                        </div>
						
                    </td>
				</tr>	
					
				<br>	
				<tr align="center">
				<td>
				<div class="form-group">
				<button type="submit" class="btn btn-success" name="submit_check" style=" <?php if(isset($_SESSION['team']) || $terms > 0) { echo 'display:none'; } ?> ">Submit</button>	
				</div>
				</td>
				</tr>

				
            
        
				<!--</td>
				</tr>-->
				</form>
</div>

<div id="London" class="tabcontent" style="<?php if(isset($_SESSION['team'])) { echo 'display:block'; } if(($team_id) > -1) { echo 'display:none' ;}   ?>">
  <h3>Project  Details</h3>
  <form method="post" enctype="multipart/form-data">
				
                <tr>
                    <td colspan="6">
                     <br>
						<div >
                        <h6>Please check if your team is already been created! If not, please select "Add a team" to proceed further</h6>    
						
						<div>
									<label for="studentType">Created Teams List:</label>
									<select name="team_id" class="form-control" required>
									<?php 
									$q_t = mysqli_query($con,"select * from tbl_team where id in (select team_id from tbl_team_mentor where user_id = $mentor_id) and deleted = 0 and year = '$year'");
									while($r_t = mysqli_fetch_assoc($q_t))
									{
									?>	
										<option value="<?php echo $r_t['id'];?>"><?php echo $r_t['project_team_name']?></option>
										
									<?php } ?>	
									<option value="0">Add a team</option>
									</select>
						</div>
						
						
						
                        </div>
						
                    </td>
				</tr>	
				<br>	
				<tr align="center">
				<td>
				<div class="form-group">
				<button type="submit" class="btn btn-success" name="submit_team_select">Submit</button>	
				</div>
				</td>
				</tr>

				
            
        
				<!--</td>
				</tr>-->
				</form>
</div>


<div id="London" class="tabcontent" style="<?php if($team_select > 0 ) { echo 'display:block'; } if(($team_submit) > 0) { echo 'display:none' ;}   ?>">
  <h3>Project  Details</h3>
  <form method="post" enctype="multipart/form-data">
				
                <?php 
				$team_q = mysqli_query($con, "select * from tbl_team where id = $team_id");
				$row = mysqli_fetch_assoc($team_q);
				
				?>
				<tr>
                    <td colspan="6">
                     
						<div >
                            <label for="pwd"><b>Project Title:</b></label>
                            <input type="text" class="form-control" id="studentEmail" name="project_title" required placeholder="Project Title" value="<?php echo $row['project_team_name']?>" required>
                        </div>
						
                    </td>
				</tr>	
					
				<br>	
				<tr>
                    <td colspan="6">
                     
						<div >
                            <label for="pwd"><b>Project Description:</b></label>
                            <textarea class="form-control" name="project_description" required placeholder="Project Description"><?php echo $row['project_description']?></textarea>
                        </div>
						
                    </td>
				</tr>
				<br>	
				<tr>
                    <td colspan="6">
                     
						<div >
                            <label for="pwd"><b>Team Name:</b></label>
                            <input type="text" class="form-control" name="team_name" required placeholder="Team Name" value="<?php echo $row['project_team_name']?>"  required>
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
							<option value="K-2" <?php if($row['category'] == 'K-2') { echo 'selected';}?>>K-2</option>
							<option value="3-5" <?php if($row['category'] == '3-5') { echo 'selected';}?>>3-5</option>
							<option value="6-8" <?php if($row['category'] == '6-8') { echo 'selected';}?>>6-8</option>
							<option value="9-12" <?php if($row['category'] == '9-12') { echo 'selected';}?>>9-12</option>
							
						</select>
						</div>
						
                    </td>
				</tr>
				<br>
				<tr>
				<div>
									<label for="studentType">Students List:</label>
									<?php $q_m_s = mysqli_query($con,"select * from tbl_team_member where team_id = $team_id and deleted = 0");
									$count = mysqli_num_rows($q_m_s);
									if($count > 0)
									{
									?>
									<select  class="form-control" multiple readonly>
									<?php 
									$q_m_s = mysqli_query($con,"select * from tbl_team_member where team_id = $team_id and deleted = 0");
									while($r_m_s = mysqli_fetch_assoc($q_m_s))
									{
									?>	
										<option value="<?php echo $r_m_s['id'];?>" selected><?php echo $r_m_s['student_first_name'].' '.$r_m_s['student_last_name']?></option>
										
									<?php } ?>	
									</select>
									<?php } ?>
									<select name="student_id[]" class="form-control" multiple="multiple">
									<option selected>Select the Team Members</option>
									<?php 
									$q_m = mysqli_query($con,"select tbl_student_mentor.student_id as id, tbl_user.first_name, tbl_user.last_name from tbl_user, tbl_student_mentor, tbl_team_member
																where tbl_user.id = tbl_student_mentor.student_id
																and tbl_student_mentor.mentor_id = $mentor_id
																and tbl_student_mentor.student_id = tbl_team_member.student_id
																and (tbl_team_member.team_id is null  
																or tbl_team_member.team_id in (select id from tbl_team where deleted = 1))");
									while($r_m = mysqli_fetch_assoc($q_m))
									{
									?>	
										<option value="<?php echo $r_m['id'];?>"><?php echo $r_m['first_name'].' '.$r_m['last_name']?></option>
										
									<?php } ?>	
									</select>
									</div>
				</tr>
				
				<br>	
				<tr align="center">
				<td>
				<div class="form-group">
				<?php if($team_id > 0 ) { ?>
				<input type="text" class="form-control" hidden name="team_id" placeholder="Team Name" value="<?php echo $team_id; ?>"/>
				<?php } ?>
				
				<button type="submit" class="btn btn-success" name="<?php if($team_id < 1 ) { echo 'submit_team'; } else { echo 'submit_update'; }?>"><?php if($team_id < 1) { echo 'Create'; } else { echo 'Update'; }?></button>	
				</div>
				</td>
				</tr>

				
            
        
				<!--</td>
				</tr>-->
				</form>
</div>

</body>
</div>
</html>	


<!-- edit_member_details  -->
<?php
include('../database/config.php'); 
include('control.php'); 
$url= $_SERVER['REQUEST_URI'];
$id = $_SESSION['id'];

$year = date("Y");


$timezone = date_default_timezone_set('America/New_York');
$date = date('Y-m-d H:i:s');
$today_at_midnight = strtotime('midnight');

$date_check = '2024-02-27 00:00:00';

if (($year) == date("Y")) { 
						if($date <= $date_check)
						{
} else { echo "<script>alert('Submission deadline is 02/26/2025 12:00:00')</script>";
	echo "<script type='text/javascript'>window.location.href = 'home.php';</script>";	    } }




if($_GET['student_log_id'])
{
	$id_s = $_GET['student_log_id'];
	#echo 'isndie'.$id_s;
	
	$q_s = mysqli_query($con,"select * from tbl_team_member where student_id = $id_s");
	$r_s = mysqli_fetch_assoc($q_s);
	$student_id = $r_s['id'];
	#echo 'isndie'.$student_id;
}
else {
$student_id = $_GET['student_id'];
}
$name = $_SESSION['name'];
$mentor_id = $_SESSION['mentor_id'];
$q = mysqli_query($con,"select * from tbl_team_member where id = $student_id");
$r = mysqli_fetch_assoc($q);

$url = $r['video_exp_link'];
preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $url, $match);
$youtube_id = $match[1];



extract($_POST);
if(isset($_POST['submit']))
{
	#echo 'inside if';
	$q = ("update tbl_team_member set student_first_name = '$first_name', 
												student_last_name = '$last_name',
												student_grade = '$student_grade',
												student_school_name = '$student_school_name',
												student_school_district = '$student_school_district',
												t_shirt_size = '$student_tshirt',
												photo_consent = '$photo_consent',
												video_exp_link = '$video_exp_link'
												where id = $student_id");
	$q_u=mysqli_query($con,$q);
	if($_FILES['fileToUpload']['size'] > 0 ){
	#echo "<script>alert('inside if')</script>";
		 $maxsize = 25242880; // 5MB
   if(isset($_FILES['fileToUpload']['name']) && $_FILES['fileToUpload']['name'] != ''){
       $name = $_FILES['fileToUpload']['name'];
       $target_dir = "../test_upload/";
       $target_file = $target_dir . $_FILES["fileToUpload"]["name"];

       // Select file type
       $extension = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

       // Valid file extensions
       $extensions_arr = array("mp4","avi","3gp","mov","mpeg");

       // Check extension
       if( in_array($extension,$extensions_arr) ){
 
          // Check file size
          if(($_FILES['fileToUpload']['size'] >= $maxsize) || ($_FILES["fileToUpload"]["size"] == 0)) {
             $_SESSION['message'] = "File too large. File must be less than 5MB.";
			  echo '<script>alert(File too large. File must be less than 5MB.)</script>';
          }else{
             // Upload
             if(move_uploaded_file($_FILES['fileToUpload']['tmp_name'],$target_file)){
               // Insert record
               $query = "update tbl_team_member set video_exp_link = '".$target_file."' where id = $student_id";

               mysqli_query($con,$query);
               $_SESSION['message'] = "Upload successfully.";
			   echo "<script type='text/javascript'>window.location.href = 'home.php';</script>";
             }
          }

       }else{
          $_SESSION['message'] = "Invalid file extension.";
		  echo '<script>alert(Invalid file extension)</script>';
       }
   }else{
       $_SESSION['message'] = "Please select a file.";
	   echo '<script>alert(Please select a file)</script>';
   }
   #header('location: home.php');
   #exit;
   #echo $_SESSION['message'];
 
		}
	
if($_FILES['log_book']['size'] > 0 ){
	#echo "<script>alert('inside if')</script>";
	$target_dir = "../test_upload/";
	$target_file = $target_dir . basename($_FILES["log_book"]["name"]);
	$doc_path=$_FILES['log_book']['name'];
	mysqli_query($con,"update tbl_team_member set photo_consent_form='../test_upload/$doc_path' where id = $student_id");
	echo "<script type='text/javascript'>window.location.href = 'home.php';</script>";
	}
	#echo "<script type='text/javascript'>window.location.href = 'home.php';</script>";
	
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Edit Student Details</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="css/style.css" type="text/css">
<link rel="shortcut icon" href="http://emuinvent.emuem.org/favicon.png">
</head>
<?php include('../header.php');?>
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
    <?php include('navbar.php');?>





     <div class="container d-flex justify-content-left col-md-10">
        <div class="col-9">
		<form method="post" enctype="multipart/form-data" >
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
                            <input type="text" class="form-control" name="first_name" id="student_first_name" value="<?php echo $r['student_first_name']?>">
                        </div>
                    </td>
					
				</tr>	
				<tr>

                    <td>
                        <div class="form-group">
                            <label for="email"><b> Student Last Name:</b></label>
                            <input type="text" class="form-control" name="last_name" id="student_last_name" value="<?php echo $r['student_last_name']?>">
                        </div>
                    </td>
				</tr>
				<tr>	
                   <td>	
                        <div>
						<label for="studentType">Student Grade:</label>
						<select name="student_grade" class="form-control" required>
							<option>Select Student Grade</option>
							<option value="K" <?php if($r['student_grade'] == 'K') { echo 'selected';}?>>K</option>
							<option value="1" <?php if($r['student_grade'] == '1') { echo 'selected';}?>>1</option>
							<option value="2" <?php if($r['student_grade'] == '2') { echo 'selected';}?>>2</option>
							<option value="3" <?php if($r['student_grade'] == '3') { echo 'selected';}?>>3</option>
							<option value="4" <?php if($r['student_grade'] == '4') { echo 'selected';}?>>4</option>
							<option value="5" <?php if($r['student_grade'] == '5') { echo 'selected';}?>>5</option>
							<option value="6" <?php if($r['student_grade'] == '6') { echo 'selected';}?>>6</option>
							<option value="7" <?php if($r['student_grade'] == '7') { echo 'selected';}?>>7</option>
							<option value="8" <?php if($r['student_grade'] == '8') { echo 'selected';}?>>8</option>
							<option value="9" <?php if($r['student_grade'] == '9') { echo 'selected';}?>>9</option>
							<option value="10" <?php if($r['student_grade'] == '10') { echo 'selected';}?>>10</option>
							<option value="11" <?php if($r['student_grade'] == '11') { echo 'selected';}?>>11</option>
							<option value="12" <?php if($r['student_grade'] == '12') { echo 'selected';}?>>12</option>
							
						</select>
						</div>
					</td>
                </tr>

                <tr>
                   <td>	
                        <div >
                            <label>
                                T-Shirt Size
                            </label>
                            <select name="student_tshirt" class="form-control" required>
							<option>Select Student Shirt Size</option>
							<option value="Youth Small" <?php if($r['t_shirt_size'] == 'Youth Small') { echo 'selected';}?>>Youth Small</option>
							<option value="Youth Medium" <?php if($r['t_shirt_size'] == 'Youth Medium') { echo 'selected';}?>>Youth Medium</option>
							<option value="Youth Large" <?php if($r['t_shirt_size'] == 'Youth Large') { echo 'selected';}?>>Youth Large</option>
							<option value="Adult Small" <?php if($r['t_shirt_size'] == 'Adult Small') { echo 'selected';}?>>Adult Small</option>
							<option value="Adult Medium" <?php if($r['t_shirt_size'] == 'Adult Medium"') { echo 'selected';}?>>Adult Medium</option>
							<option value="Adult Large" <?php if($r['t_shirt_size'] == 'Adult Large') { echo 'selected';}?>>Adult Large</option>
							<option value="Adult X-Large" <?php if($r['t_shirt_size'] == 'Adult X-Large') { echo 'selected';}?>>Adult X-Large</option>
							
							
						</select>
                        </div>
					</td>
                </tr>

                <tr>

                    <td>	
						<div >
                            <label>
                                School Name
                            </label>
                            <input type="text"required autocomplete="off" class="form-control" name="student_school_name" value="<?php echo $r['student_school_name']?>"/>
                        </div>
					</td>	
                </tr>
				
				<tr>

                    <td>		
						<div >
                            <label>
                                School District
                            </label>
                            <input type="text"required autocomplete="off" class="form-control" name="student_school_district" value="<?php echo $r['student_school_district']?>"/>
                        </div>
					
                    </td>
                </tr>
				<tr>
				<td>
                       
                          <div >
                            
							<label for="pwd">Parent has given consent to photograph the student:</label>
                            <input type="radio" name="photo_consent" value="1"  <?php if(($r['photo_consent']) == 1 ) { echo 'Checked'; }?> />Yes
							<input type="radio" name="photo_consent" value="0"   <?php if(($r['photo_consent']) == 0 ) { echo 'Checked'; }?>/> No
                        </div>
                        
                    </td>
				</tr>
				<tr>	
					
                    <td>
                        
                          <div >
                            <label for="pwd">Attach your photo consent form:</label>
							<p><a class="nav-link" href="Photo-video waiver form1.pdf" target="_blank">Download the original Photo Consent Form to sign and upload</a></p>
                            <?php if(($r['photo_consent_form']) != '') { ?>
							<p><a href="../<?php echo $r['photo_consent_form']?>" target="_blank">Uploaded Consent Form - <?php echo $r['photo_consent_form']?></a></p>		
							<?php } ?>
							<input type="file" class="form-control" id="studentEmail" name="log_book" placeholder="Upload photo consent form">
                        </div>
                        
                    </td>
				</tr>	
				<tr>	
					<td>
					<div  >
					 <label for="pwd">Please record a minute-long video about your experience with the invention process (optional) :</label>
					<br>                           
						   <div >
                            <label for="pwd">Upload Recording File :</label>
                            <input type="file" class="form-control" name="fileToUpload" placeholder="Upload video">
							<p>Video Should be less than 5MB</p>
                        </div>
                        <br>
						<p><b>-OR-</b></p>
						
						<div >
                            <label for="pwd">Upload Youtube Video link:</label>
                            <input type="text" class="form-control" id="video_exp_link" name="video_exp_link" placeholder="Youtube video Link">					
                        </div>
                        </div>
					</td>
				</tr>

					

               <!-- <tr>
                    <td colspan="2">
                        <div class="form-group">
                            <label for="studentType"><b>t_shirt_size:</b></label>
                            <select class="form-control" id="SelectDepartment" name="t_shirt_size">
							<option selected value="<?php echo $r['t_shirt_size']?>"><?php echo $r['t_shirt_size']?></option>
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
			
			<?php if($r['video_exp_link']) { ?>
			<div class="col-9">	
				<table class="table table-borderless">
				<br>
					<h3> Optional Video :</h3>
				   <br>
				<br>
				<?php if ($youtube_id=='') {?>
				<div class="form-group">
					<video width="300" height="300" controls>
					  <source src="<?php echo $r['video_exp_link']?>" type="video/mp4">
					  <source src="<?php echo $r['video_exp_link']?>" type="video/ogg">
					</video>
						</div>	
				<?php } else {?>		
				<div class="form-group">
					<iframe width="300" height="300" src="https://www.youtube.com/embed/<?php echo $youtube_id?>" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
						</div>	
				<?php }?>
				</table>		
        </div>  
	<?php } ?>	
			
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