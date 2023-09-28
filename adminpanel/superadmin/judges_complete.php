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
  </span>
  <span class="subtitle">'.$title.'</span>
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
  <div class="card-body">
    <h4 class="card-title">Recent Tickets</h4>
    <div class="table-responsive">
      <table class="table table1">
        <thead class="table-dark">
          <tr>
      	<th scope="col">Judge</th>
						<th scope="col">Judge Email</th>
						<th scope="col">Team Name</th>
						<th scope="col">Category</th>
          
       
            
          </tr>
        </thead>
        <tbody>';
        $count_tja= 0 ;
				$user_id_1 = array();
				$j_c_e = mysqli_query($conn,"select user_id, count(user_id) as count from tbl_judge_team group by (user_id)");
				while($row = mysqli_fetch_assoc($j_c_e))
				{
					$user_id = $row['user_id'];
					$count_tj = $row['count'];
					$q_c = mysqli_query($conn,"select count(user_id) as count from tbl_judge_assessment where user_id = $user_id and (identifying_understanding is not null 
                 and ideating is not null
                 and designing_building is not null
                 and testing_refinging is not null
                 and value_propoition is not null
                 and market_potential is not null
                 and social_value is not null
                 and originality is not null
                 and logbook is not null
                 and display_board is not null
                 and prototype is not null
                 and online_pitch is not null)");
				$j_c = mysqli_fetch_assoc($q_c);
				$count_tja = $j_c['count'];
					if($count_tj == $count_tja)
					{
						array_push($user_id_1,$user_id);
						
					}
				}		
				$stuff = $user_id_1;
				#$list =  implode(", ", $stuff);    //prints 1, 2, 3
				$list = join(',', $stuff);  
			#	echo $list;
				if($list!=='')
				{
                    $qu_c = mysqli_query($conn,"select t.user_id,judge_name,email, group_concat(category) as category, GROUP_CONCAT(project_team_name) as project_team_name from (select tj.user_id,concat(tu.first_name,' ', tu.last_name) as judge_name,tu.email, tt.project_team_name, tt.category FROM tbl_user tu, tbl_judge_team tj, tbl_team tt
                    where tj.user_id in ($list)
                    and tj.team_id = tt.id
                    and tj.user_id = tu.id) t 
                    group by (judge_name)");

while($r_team = mysqli_fetch_assoc($qu_c))
{
				
          
          echo '<tr> 
          <td><a href="profile.php?id='. $r_team["user_id"].'">'. $r_team['judge_name'].'</a></td> 
          <td><a href="profile.php?id='. $r_team["user_id"].'">'. $r_team['email'].'</a></td> 
          <td>'. $r_team['project_team_name'].'</a></td> 
          <td>'. $r_team['category'].'</a></td> 
          </tr>
       ';
           } }
        echo '</tbody>
      </table>
    </div>
  </div>
</div>
</div>
</div>';

        }

?>