<?php 
include '../superadmin/config.php';


if(isset($_GET['year']))
{
	$year = $_GET['year'];
}
else {
$year = date("Y");
}

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
   
</head>

<body>
<div class="container-scroller">

<?php include '../dashboardheader.php'; 
$id = $_SESSION['id'];
$name = $_SESSION['name'];

?>
<!-- partial -->
<div class="main-panel">
    <div class="content-wrapper updated">

    

    
<div class="page-header">
  <h3 class="page-title">
    <span class="page-title-icon text-white me-2">
      <i class="mdi mdi-view-dashboard"></i>
    </span> Dashboard ->
    <span class="subtitle">Judges Details</span>
  </h3>

  <nav aria-label="breadcrumb">
    <ul class="breadcrumb">
      <li class="breadcrumb-item active" aria-current="page">
        <span></span>Overview <i class="mdi mdi-alert-circle-outline icon-sm text-success align-middle"></i>
      </li>
    </ul>
  </nav>
</div>
<div class="row">
  <div class="col-12 grid-margin">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">Recent Tickets</h4>
        <div class="table-responsive">
          <table class="table">
          <thead class="thead-dark bg-dark text-light" id="table">
                    <tr>
						<th scope="col">Team Name</th>
						<th scope="col">Team Description</th>
						<th scope="col">Team Members</th>
						<th scope="col">Video Pitch</th>
                       <!-- <th> View Details</th>-->
                    </tr>
                </thead>
                <tbody> 
				
				<?php 
				$q_team = mysqli_query($conn,"select distinct tt.id as team_id,tt.project_team_name as project_name,tt.project_description,tt.category,tt.video_pitch, tt.log_book
				from tbl_team tt where tt.year = '$year' and tt.deleted = 0 order by project_team_name");	
									
				while ($r_team = mysqli_fetch_assoc($q_team))					
				{
					$youtube_id='';
					$url = $r_team['video_pitch'];
				if(preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $url, $match))
					{
						$youtube_id = $match[1];
					}
					$team_id = $r_team['team_id'];
				$team_m_q = mysqli_query($conn, "select GROUP_CONCAT(concat(student_first_name,' ',student_last_name)) as members from tbl_team_member where team_id = $team_id");
				$team_m_r = mysqli_fetch_assoc($team_m_q);
				
				?>
											
					<tr> 
						<td><?php echo $r_team['project_name']?></td> 
						<td><?php echo $r_team['project_description']?></td> 
						<td><?php echo $team_m_r['members']?></td>  
						<?php if ($r_team['video_pitch']!='') {
							if ($youtube_id!='') { ?>
						<td><a href ="<?php echo $r_team['video_pitch']?>" target="_blank">Video Pitch</a></td> 
							<?php } else {?>
							<td><a href ="http://grading.emuem.org/Team/<?php echo $r_team['video_pitch']?>" target="_blank">Video Pitch</a></td> 
							<?php } ?>
							<?php } else {?>
							<td>Video Pitch</td> 
							<?php }?>
						
						<!--<td><a href="edit_team.php?team_id=<?php echo $team_id?>"><button type="button" style="margin:0px;"  class="btn-success btn-sm"  onclick="edit(this)">Update Details</button></a></td> -->
				    </tr> 
				<?php } ?>								
												
											</tbody> 
          </table>
        </div>
      </div>
    </div>
  </div>
</div>






       <!-- partial:partials/_footer.html -->
       <footer class="footer">

</footer>
<!-- partial -->
</div>
<!-- main-panel ends -->
</div>
<!-- page-body-wrapper ends -->
</div>
<!-- container-scroller -->
<!-- plugins:js -->
<script src="../assets/vendors/js/vendor.bundle.base.js"></script>
<!-- <script src="./../assets/js/main.js"></script> -->
<!-- endinject -->
<!-- Plugin js for this page -->

<script src="../assets/js/jquery.cookie.js" type="text/javascript"></script>
<!-- End plugin js for this page -->
<!-- inject:js -->
<script src="../assets/js/off-canvas.js"></script>
<script src="../assets/js/hoverable-collapse.js"></script>
<script src="../assets/js/misc.js"></script>
<!-- endinject -->
<!-- Custom js for this page -->
<script src="../assets/js/dashboard.js"></script>
<script src="../assets/js/todolist.js"></script>
<script src="../assets/js/ajaxscript.js" type = "text/javascript"></script>
<!-- End custom js for this page -->
</body>

</html>