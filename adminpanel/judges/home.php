<?php
 
include '../superadmin/config.php';





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
        $judge_id=$_SESSION['id'];
        
        ?>
        
        <!-- partial -->
        <div class="main-panel">
            <div class="content-wrapper updated">

<div class="page-header">
  <h3 class="page-title">
    <span class="page-title-icon text-white me-2">
      <i class="mdi mdi-view-dashboard"></i>
    </span> Judge Portal
    <!-- <span class="subtitle">Evaluation Result</span> -->
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
        <h4 class="card-title"></h4>
        <div class="table-responsive">
          <table class="table team_table">

            <thead>
            <tr>
						<!--<th scope="col">Team ID</th>-->
                        <th scope="col" >Team Name</th>
                        <!--<th scope="col">Team Mentor</th>-->
                        <th scope="col" >Video Pitch</th>
                        <th scope="col" >LogBook</th>
						<th scope="col" >Team Members</th>
						<th scope="col" >Team Category</th>
						<th scope="col" >Status</th>
                        <th> View Details</th>
                    </tr>
            </thead>
            <tbody>

        	
				<?php 
				$q_team = mysqli_query($conn,"SELECT DISTINCT tt.id AS team_id, tt.project_team_name AS project_name, tt.category AS category, tu.first_name, tu.last_name, tt.video_pitch, tt.log_book
                FROM tbl_judge_team tj
                INNER JOIN tbl_team tt ON tj.team_id = tt.id
                INNER JOIN tbl_team_mentor ttm ON tt.id = ttm.team_id
                INNER JOIN tbl_team_member tm ON tt.id = tm.team_id
                INNER JOIN tbl_user tu ON tj.user_id = tu.id
                WHERE tj.user_id = $judge_id

									");	
						$status = 'Incomplete';				
				while ($r_team = mysqli_fetch_assoc($q_team))					
				{
					$youtube_id='';
				$url = $r_team['video_pitch'];
				if(preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $url, $match))
					{
						$youtube_id = $match[1];
					}
	
				
					$team_id = $r_team['team_id'];
				$team_m_q = mysqli_query($conn, "SELECT GROUP_CONCAT(s.student_first_name) AS members
        FROM tbl_team_member tm
        JOIN student s ON tm.student_id = s.student_id
        WHERE tm.team_id = $team_id");
				$team_m_r = mysqli_fetch_assoc($team_m_q);
				
				$q_e = mysqli_query($conn,"select * from tbl_judge_assessment where team_id = $team_id and user_id = $judge_id");
				$r_q_e = mysqli_num_rows($q_e);
				$d_q_e = mysqli_fetch_assoc($q_e);
				if ($d_q_e['id'])
				{
				$st_q = mysqli_query($conn,"select count(*) as count From tbl_judge_assessment 
					where team_id = $team_id and user_id = $judge_id  and  (identifying_understanding is null or ideating is null
					or designing_building is null or testing_refinging is null or value_propoition is null
					or market_potential is null or social_value is null or originality is null or logbook is null
					or display_board is null or prototype is null or online_pitch is null or question_asked is null
					)");
				$st_d = mysqli_fetch_assoc($st_q);
				$c = $st_d['count'];
				if($c == 0)
				{
					$status = 'Complete';
				}
				else{
					$status = 'Incomplete';
				}
				}

				?>

<tr> 
													<!--<td><a href="viewteams.php?team_id=<?php echo $r_team['team_id']?>"><?php echo $r_team['team_id']?></a></td>-->
													<td><?php echo $r_team['project_name']?></td> 
													<!--<td><?php echo $r_team['first_name'].' '.$r_team['last_name']?></td> -->
													<?php if ($youtube_id!='') { ?>
													<td><a href="<?php echo $r_team['video_pitch']?>" target="_blank">Video Pitch</a></td> 
													<?php } else {?>
													<td><a href="<?php echo 'http://grading.emuem.org/Team/'.$r_team['video_pitch']?>" target="_blank">Video Pitch</a></td> 
													<?php } 
													 if ($r_team['log_book']!='') {?>
														<td><a href="http://grading.emuem.org/Team/<?php echo $r_team['log_book']?>" target="_blank">LogBook</a></td>  
												<?php } else {?>
														<td>LogBook</td>  
												<?php }?>
															<td><?php echo $team_m_r['members']?></td>  
													<td><?php echo $r_team['category']?></td>  
													<td><?php echo $status?></td> 
													<!-- <?php if($r_q_e) { ?> -->
                            <?php  
                              $encode_team_id = base64_encode($r_team['team_id']);
                              $encode_judge_id =base64_encode($judge_id);
                              
                              ?>
													<td><a  href="../superadmin/update_evaluation_team.php?team_id=<?php echo $encode_team_id ?>&judge_id=<?php echo $encode_judge_id ?>" ><button type="button" style="margin:0px;"  class="btn-success btn-sm" >Update Evaluation</button></a></td> 
													<!-- <?php }else{ ?>
													<td><a href="evaluate_team.php?team_id=<?php echo $r_team['team_id']?>"><button type="button" style="margin:0px;"  class="btn-success btn-sm"  onclick="edit(this)">Evaluate Team</button></a></td> 
													<?php }?> -->
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

