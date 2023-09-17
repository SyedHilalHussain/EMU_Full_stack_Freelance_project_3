<?php 
include 'config.php';
$category='';
if (isset($_GET['query']) && isset($_GET['title'])){
    $query=$_GET['query'];
    $title=$_GET['title'];


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

        <?php include '../dashboardheader.php'; ?>
        <!-- partial -->
        <div class="main-panel">
            <div class="content-wrapper updated">

<div class="page-header">
  <h3 class="page-title">
    <span class="page-title-icon text-white me-2">
      <i class="mdi mdi-view-dashboard"></i>
    </span> Dashboard ->
    <span class="subtitle"><?php echo $title; ?></span>
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
          <table class="table team_table">

            <thead>
              <tr>
                <th scope="col">Team Name</th>
                <th scope="col">Category</th>
                <th scope="col">Scores</th>
                <th scope="col">Status</th>
                <th>View Details</th>
              </tr>
            </thead>
            <tbody>

            <?php 
				$q_team = mysqli_query($conn,$query);	
									
				while ($r_team = mysqli_fetch_assoc($q_team))					
				{
					$team_id = $r_team['team_id'];				
				$q_e = mysqli_query($conn,"select * from tbl_judge_assessment where team_id = $team_id");
				$r_q_e = mysqli_num_rows($q_e);
				$d_q_e = mysqli_fetch_assoc($q_e);
				if ($d_q_e['id'])
				{
				$st_q = mysqli_query($conn,"select sum(count_a) as count from (select count(*) as count_a from tbl_judge_team where team_id = $team_id and user_id not in (select user_id from tbl_judge_assessment where team_id = $team_id) union (select count(*) as count_a From tbl_judge_assessment 
					where team_id = $team_id and  (identifying_understanding is null or ideating is null
					or designing_building is null or testing_refinging is null or value_propoition is null
					or market_potential is null or social_value is null or originality is null or logbook is null
					or display_board is null or prototype is null or online_pitch is null or question_asked is null
					))) t");
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
                <!--<td><a href="viewteams.php?team_id=<?php echo $r_team['team_id']; ?>"><?php echo $r_team['team_id']; ?></a></td>-->
                <td><?php echo $r_team['project_name']; ?></td>
                <td><?php echo $r_team['category']; ?></td>
                <td><?php echo $r_team['total']; ?></td>
                <td><?php echo $status; ?></td>
                <td><a href="#" class="ajaxupdated" data-url="view_evaluations.php" data-query="<?php echo $r_team['team_id']; ?>" data-title="View Evaluations of Teams"><button type="button" style="margin:0px;" class="btn-sm btn-gradient-success">View Evaluations</button></a></td>
              </tr>

            <?php
            } }
            ?>

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

