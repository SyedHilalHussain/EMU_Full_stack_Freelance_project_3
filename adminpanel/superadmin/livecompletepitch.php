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
    <button id="reloadButton" class="btn page-title-icon btn-sm text-white" onclick="location.reload();">Back</button>
    </li>
  </ul>
</nav>
</div>
<div class="row">
<div class="col-12 grid-margin">
<div class="card">
  <div class="card-body">';
  $q_team = mysqli_query($conn,"select distinct tt.id as team_id,tt.project_team_name as project_name,tt.project_description,tt.category,tt.video_pitch, tt.log_book
				from tbl_team tt, tbl_judge_assessment tja where tja.team_id = tt.id and tja.live_qa is not null order by project_team_name");	
  $num_row = mysqli_num_rows($q_team);
    
    
    echo '<h4 class="card-title">Total '.$num_row.'</h4>
    <div class="table-responsive">
      <table class="table table1">
        <thead class="table-dark">
          <tr>
          <th>S.No</th>
            <th>Team Name</th>
            <th>Category</th>
            <th>Team Members</th>
            <th>View Details</th>
            
          </tr>
        </thead>
        <tbody>';
        
				
				
							$count = 1;		
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
				
				
          
          echo '<tr>
          <td>'.$count.'</td>
            <td>'.$r_team["project_name"].'</td>

           
            <td>'.$r_team["category"] .'</td>
            <td>'.$team_m_r["members"].'</td>
            <td>
            <a href="edit_team_liveqa.php?team_id='.$r_team["team_id"].'"><button class="btn   btn-sm btn-gradient-success ">Update Details</button></a>
                          </td>
          </tr>
       ';
         $count++;  } 
        echo '</tbody>
      </table>
    </div>
  </div>
</div>
</div>
</div>';



?>