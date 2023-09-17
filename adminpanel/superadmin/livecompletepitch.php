<?php 
include 'config.php';
echo '
<div class="page-header">
<h3 class="page-title">
  <span class="page-title-icon  text-white me-2">
    <i class="mdi mdi-view-dashboard"></i>
  </span> Dashboard ->
  <span class="subtitle"> Complete Pitches</span>
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
            <th>Team Name</th>
            <th>Category</th>
            <th>Team Members</th>
            <th>View Details</th>
            
          </tr>
        </thead>
        <tbody>';
        
				$q_team = mysqli_query($conn,"select distinct tt.id as team_id,tt.project_team_name as project_name,tt.project_description,tt.category,tt.video_pitch, tt.log_book
				from tbl_team tt, tbl_judge_assessment tja where tja.team_id = tt.id and tja.live_qa is not null order by project_team_name");	
				
									
				while ($r_team = mysqli_fetch_assoc($q_team))					
				{
					$youtube_id='';
					$url = $r_team['video_pitch'];
				if(preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $url, $match))
					{
						$youtube_id = $match[1];
					}
					$team_id = $r_team['team_id'];
				$team_m_q = mysqli_query($conn, "select GROUP_CONCAT(student_first_name) as members from tbl_team_member where team_id = $team_id");
				$team_m_r = mysqli_fetch_assoc($team_m_q);
				
				
          
          echo '<tr>
           
            <td>'.$r_team["project_name"].'</td>

           
            <td>'.$r_team["category"] .'</td>
            <td>'.$team_m_r["members"].'</td>
            <td>
            <button class="btn   btn-sm btn-gradient-success ">Update Details</button>
                          </td>
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



?>