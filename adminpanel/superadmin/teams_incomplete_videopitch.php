<?php 
include 'config.php';
$category='';
extract($_POST);
if(isset($_POST['submit']))
{	
$category = $_POST['team_category'];
}
echo '
<div class="page-header">
<h3 class="page-title">
  <span class="page-title-icon  text-white me-2">
    <i class="mdi mdi-view-dashboard"></i>
  </span> Dashboard ->
  <span class="subtitle">Incomplete logbook Teams</span>
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
        <th scope="col">Team Description</th>
        <th scope="col">Category</th>
        <th scope="col">Video Pitch</th>
        <th scope="col">LogBook</th>
        <th scope="col">Team Members</th>
        <th> View Details</th>
    </tr>
        </thead>
        <tbody>';
        if($category!=='')
        {
        $q_team = mysqli_query($conn,"select distinct tt.id as team_id,tt.project_team_name as project_name,tt.project_description,tt.category,tt.video_pitch, tt.log_book
        from tbl_team tt where category = '$category' and video_pitch is null");	
        }
        else
        {
            $q_team = mysqli_query($conn,"select distinct tt.id as team_id,tt.project_team_name as project_name,tt.project_description,tt.category,tt.video_pitch, tt.log_book
        from tbl_team tt where video_pitch is null");	
        }
                            
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
				
				
          
          echo '	<tr> 
          <td><a href="viewteams.php?team_id='.$r_team["team_id"].'">'.$r_team["project_name"].'</a></td> 
          <td><a href="viewteams.php?team_id='.$r_team["team_id"].'">'.$r_team["project_description"].'</a></td> 
          <td><a href="viewteams.php?team_id='.$r_team["team_id"].'">'.$r_team["category"].'</a></td> ';
          
           if ($r_team['video_pitch']!='') {
              if ($youtube_id!='') { 
       
       echo'         <td><a href="'.$r_team["video_pitch"].'" target="_blank">Video Pitch</a></td> ';
               } else {
               echo ' 
              <td><a href ="http://grading.emuem.org/Team/'.$r_team['video_pitch'].'" target="_blank">Video Pitch</a></td> 
              ';
             } 
              } else {
                echo '
              <td>Video Pitch</td>' 
             ; 
             } if ($r_team['log_book']!='') {

                echo     ' <td><a href="http://grading.emuem.org/Team/ '.$r_team['log_book'].'" target="_blank">LogBook</a></td>  ';
               } else {
                    echo ' <td>LogBook</td>';  
             }
          echo '<td>'.$team_m_r["members"].'</td>  
          <td><a href="edit_team.php?team_id='.$team_id.'"><button type="button" style="margin:0px;"  class="btn btn-gradient-success btn-sm"  onclick="edit(this)">Update Details</button></a></td> 
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