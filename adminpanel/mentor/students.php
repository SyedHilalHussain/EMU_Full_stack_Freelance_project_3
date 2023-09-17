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
    </span> Teachers/Mentors 
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
      <div class="card-body">
       
        <div class="table-responsive">
          <table class="table">
          <thead class="thead-dark bg-dark text-light" id="table">
                    <tr>
						<th>First Name</th>
						<th>Last Name</th>
						<th>Email</th>
						<th>Phone No</th>
                        <th>Actions</th>
						
                    </tr>
                </thead>
                <tbody> 
				
				<?php 
                $date =date('Y');
               
				$q_team = mysqli_query($conn,"select tu.*, ts.approve from tbl_user tu, tbl_student_mentor ts where tu.id = ts.student_id
				and ts.mentor_id = $id and ts.approve = -1 and tu.Year=$date");	
									
				while ($r_team = mysqli_fetch_assoc($q_team))					
				{
				
				?>
											
					<tr> 
						<td><?php echo $r_team['first_name']?></td> 
						<td><?php echo $r_team['last_name']?></a></td> 
						<td><?php echo $r_team['email']?></a></td> 
						<td><?php echo $r_team['phone']?></a></td> 
						
					
						<td style="white-space:nowrap;">
						
						<!--<a href="edit_team.php?team_id=<?php echo $team_id?>"><button type="button" style="margin:0px;"  class="btn-success btn-sm"  >Update Details</button></a>-->
                        <a onClick="return confirm('Do you want to approve the Student?')" href="approve.php?id=<?php echo $r_team['id']?>&flag=1" ><button type="button" style="margin:0px!important;  "  class="btn-gradient-success btn-sm">Approve</button></a>
                        <a onClick="return confirm('Do you want to disapprove the Student?')" href="approve.php?id=<?php echo $r_team['id']?>&flag=0" ><button type="button" style="margin:0px;"  class="btn-gradient-danger btn-sm" style="margin:0px;background-color:red">Disapprove</button></a>
					
                 
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

<div class="row">
  <div class="col-12 grid-margin">
    <div class="card">
      <div class="card-body">
       
        <div class="table-responsive">
          <table class="table">
          <thead class="thead-dark bg-dark text-light" id="table">
                    <tr>
						<th>First Name</th>
						<th>Last Name</th>
						<th>Email</th>
						<th>Phone No</th>
                        <th>Actions</th>
						
                    </tr>
                </thead>
                <tbody> 
				
				<?php 
			$q_team = mysqli_query($conn,"select tu.*, ts.approve from tbl_user tu, tbl_student_mentor ts where tu.id = ts.student_id
            and ts.mentor_id = $id and ts.approve = 1");	
                                
            while ($r_team = mysqli_fetch_assoc($q_team))	{
				
				?>
											
					<tr> 
						<td><?php echo $r_team['first_name']?></td> 
						<td><?php echo $r_team['last_name']?></a></td> 
						<td><?php echo $r_team['email']?></a></td> 
						<td><?php echo $r_team['phone']?></a></td> 
						
					
						<td style="white-space:nowrap;">
						
                        
						
                        <a onClick="return confirm('Do you want to disapprove the Student?')" href="approve.php?id=<?php echo $r_team['id']?>&flag=0" ><button type="button" style="margin:0px;"  class="btn-gradient-success btn-sm" style="margin:0px;background-color:red">Disapprove</button></a>
				
                        </td> 
				<?php } ?>								
												
											</tbody> 
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-12 grid-margin">
    <div class="card">
      <div class="card-body">
       
        <div class="table-responsive">
          <table class="table">
          <thead class="thead-dark bg-dark text-light" id="table">
                    <tr>
						<th>First Name</th>
						<th>Last Name</th>
						<th>Email</th>
						<th>Phone No</th>
                        <th>Actions</th>
						
                    </tr>
                </thead>
                <tbody> 
				
				<?php 
			$q_team = mysqli_query($conn,"select tu.*, ts.approve from tbl_user tu, tbl_student_mentor ts where tu.id = ts.student_id
            and ts.mentor_id = $id and ts.approve = 0");	
                                
            while ($r_team = mysqli_fetch_assoc($q_team))					
            {
            
            ?>
                                        
                <tr> 
                    <td><?php echo $r_team['first_name']?></td> 
                    <td><?php echo $r_team['last_name']?></a></td> 
                    <td><?php echo $r_team['email']?></a></td> 
                    <td><?php echo $r_team['phone']?></a></td> 
               
                    <td>
                    
                    <a onClick="return confirm('Do you want to Approve the Student?')" href="approve.php?id=<?php echo $r_team['id']?>&flag=1" ><button type="button" style="margin:0px;"  class="btn-gradient-success btn-sm"  >Approve</button></a>
                    
                    

             
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