<?php
session_start();
include '../superadmin/config.php';
if(isset($_SESSION['id'])){
$current_year = date("Y");	
$id= $_SESSION['id'];
$year_query=mysqli_query($conn,"SELECT Year from tbl_user WHERE id = $id");
$year_row=mysqli_fetch_assoc($year_query);
if($year_row['Year']== $current_year){
  



if (isset($_GET['year'])) {
	$year = $_GET['year'];
} else {
	$year = date("Y");
}
$timezone = date_default_timezone_set('America/New_York');
$date = date('Y-m-d H:i:s');
$today_at_midnight = strtotime('midnight');

$date_check = '2030-09-27 00:00:00';

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
	<style>
		::-webkit-scrollbar {
			width: 5px;
			height: 5px;


		}

		::-webkit-scrollbar-thumb {
			background-color: green;
			border-radius: 5px;
		}

		/* Customize the thumb on hover */
		::-webkit-scrollbar-thumb:hover {
			background-color: #555;
		}

		.table .td_button::-webkit-scrollbar {

			height: 6px !important;

		}

		.table .td_button {
			max-width: 10rem;
			overflow: auto !important;
			white-space: nowrap;
			padding: 0.1rem 0.2rem;
			scrollbar-width: 10px !important;




		}

		.table th {
			font-size: medium !important;
		}
	</style>
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
						</span> Student
						<span class="subtitle">Portal</span>
					</h3>

					<!-- <nav aria-label="breadcrumb">
						<ul class="breadcrumb">
							<li class="breadcrumb-item active" aria-current="page">
								<span></span>Overview <i class="mdi mdi-alert-circle-outline icon-sm text-success align-middle"></i>
							</li>
						</ul>
					</nav> -->
				</div>

		
				<div class="row">
					<div class="col-12 grid-margin">
						<div class="card">
						<?php 
                                  
                                 $query = "SELECT DISTINCT t.year
								 FROM tbl_team AS t
								 JOIN tbl_team_member AS tm ON t.id = tm.team_id
								 WHERE tm.student_id = '$id'
                                ORDER BY t.year DESC
                                             LIMIT 4";

                                   $result = mysqli_query($conn, $query);

                                             ?> 
                                 <div class="d-flex justify-content-between mx-2 mt-2 mb-0">
                                             <h4 class="card-title mt-1">Your Teams <span id="year_span">2023
                                                </span> </h4>

                                           <div class="d-flex justify-content-between">
                                             <label for="studentType " class="mt-1">Student Grade:</label>
                                             <select name="year_change" id="team_year_change" class="form-select form-select-sm ms-3" style="width: fit-content;" >

                                             <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                                      <option><a href="home_prev.php?previous_year=<?php echo $row['year']; ?>"><?php echo $row['year']; ?></a></option>
                        <?php } ?>

                                             </select>
                                         </div>
                                         </div>
							<div class="card-body pt-3">

								<div class="table-responsive">
									<table class="table">
										<thead class="thead-dark bg-dark text-light" id="table">
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
														$q_team = mysqli_query($conn, "select distinct tt.id as team_id,tt.project_team_name as project_name,tt.project_description,tt.category,tt.video_pitch, tt.log_book
							from tbl_team tt, tbl_team_mentor ttm, tbl_student_mentor ts,tbl_team_member ttmb
							where ttmb.student_id = $id 
                			and ttmb.team_id is not null
							and ttmb.team_id = tt.id
							and year = '2023'
							and tt.deleted = 0");

											while ($r_team = mysqli_fetch_assoc($q_team)) {
												$team_id = $r_team['team_id'];
												$team_m_q = mysqli_query($conn,"SELECT GROUP_CONCAT(s.student_first_name) AS members
												FROM tbl_team_member tm
												JOIN student s ON tm.student_id = s.student_id
												WHERE tm.team_id = $team_id AND s.deleted = 0;");
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
														<td><a href="./test_upload/<?php echo $r_team['log_book'] ?>" target="blank">LogBook</a></td>
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
													<?php if (($year) ==2023) {
														// if ($date <= $date_check) {
															$encoded_team_id = base64_encode($team_id); ?>
															<td class="td_button">
															
																<a href="viewteams.php?team_id=<?php echo $encoded_team_id ?>"><button type="button" style="margin:0px;" class="btn-success btn-sm" onclick="edit(this)">Edit</button></a>
																<a href="edit_team.php?team_id=<?php echo $encoded_team_id ?>"><button type="button" style="margin:0px;" class="btn-success btn-sm" onclick="edit(this)">Upload Files</button></a>
																<a onClick="return confirm('Are you sure you want to delete?')" href="set_delete.php?id=<?php echo $team_id ?>&table=tbl_team&return=home" class="btn  purple border p-2"> Delete</a>
															</td>
													<?php 
													// }
													} ?>
													</td>
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
	<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

	<!-- End plugin js for this page -->
	<!-- inject:js -->
	<script src="../assets/js/off-canvas.js"></script>
	<script src="../assets/js/hoverable-collapse.js"></script>
	<script src="../assets/js/misc.js?v=1"></script>
	<!-- endinject -->
	<!-- Custom js for this page -->
	<script src="../assets/js/dashboard.js"></script>
	<script src="../assets/js/todolist.js"></script>
	<script src="./assets/js/ajax.js?v=4" type="text/javascript"></script>
	<!-- End custom js for this page -->
</body>

</html>

<?php   

												}else{

include '../note.php';

												}}else{

													echo "<script>alert('please log in first');
													document.location='../../login.php';
													
													</script>";
												}


?>