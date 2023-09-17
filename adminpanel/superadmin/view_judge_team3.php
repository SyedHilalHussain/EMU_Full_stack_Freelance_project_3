<?php 
include 'config.php';
if (isset($_POST['query']) && isset($_POST['title'])){
   $query=$_POST['query'];
   $title=$_POST['title'];

echo '
<div class="page-header">
<h3 class="page-title">
  <span class="page-title-icon  text-white me-2">
    <i class="mdi mdi-view-dashboard"></i>
  </span> Dashboard ->
  <span class="subtitle">'.$title.'</span>
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
        <thead>
          <tr>
      	<th scope="col">Judge</th>
						<th scope="col">Judge Email</th>
						<th scope="col">Team Name</th>
						<th scope="col">Category</th>
          
       
            
          </tr>
        </thead>
        <tbody>';
        
        $q_team = mysqli_query($conn,$query);	
									
        while ($r_team = mysqli_fetch_assoc($q_team))					
        {	
			$user_id = $r_team['user_id'];
					$list = $r_team['team_list'];
					
					$q_n = mysqli_query($conn,"select concat(first_name,' ',last_name) as judge_name,email from tbl_user where id = $user_id");
					$d_n = mysqli_fetch_assoc($q_n);
					
					$q_t = mysqli_query($conn,"select group_concat(project_team_name) as team_name, group_concat(category) as category from tbl_team where id in ($list)");
					$q_d = mysqli_fetch_assoc($q_t);	
          
          echo '<tr> 
          <td><a href="JudgeDetails.php?id='.$user_id.'">'. $d_n['judge_name'].'</a></td> 
          <td><a href="JudgeDetails.php?id='.$user_id.'">'. $d_n['email'].'</a></td> 
          <td>'.$q_d['team_name'].'</a></td> 
          <td>'.$q_d['category'].'</a></td> 
          
      </tr> 
       ';
           } 
        echo '</tbody>
      </table>
    </div>
  </div>
</div>
</div>
</div>';

        }

?>