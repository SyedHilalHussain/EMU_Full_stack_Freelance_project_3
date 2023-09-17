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
				
          
          echo '<tr> 
          <td><a href="JudgeDetails.php?id='. $r_team["user_id"].'">'. $r_team['judge_name'].'</a></td> 
          <td><a href="JudgeDetails.php?id='. $r_team["user_id"].'">'. $r_team['email'].'</a></td> 
          <td>'. $r_team['project_team_name'].'</a></td> 
          <td>'. $r_team['category'].'</a></td> 
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