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
  <div class="card-body">';
  $count_tja= 0 ;
  $team_id_1 = array();
  $t_c_e = mysqli_query($conn,"select team_id, count(team_id) as count from tbl_judge_team group by (team_id)");
  while($row_t = mysqli_fetch_assoc($t_c_e))
  {
    $team_id = $row_t['team_id'];
    $count_tj = $row_t['count'];
    $q_c = mysqli_query($conn,"select count(team_id) as count from tbl_judge_assessment where team_id = $team_id and (identifying_understanding is not null 
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
    if(($count_tj-$count_tja)== $query)
    {
      array_push($team_id_1,$team_id);
      
    }
  }		
  $stuff = $team_id_1;
  #$list =  implode(", ", $stuff);    //prints 1, 2, 3
  $list = join(',', $stuff);  

  
  $qu_c = mysqli_query($conn,"select project_team_name,GROUP_CONCAT(judge_name) as judge_list, GROUP_CONCAT(category) as category from (  select tt.project_team_name, tt.category, concat(first_name,' ',last_name) as judge_name FROM tbl_user tu, tbl_judge_team tj, tbl_team tt
              where tj.team_id in ($list)
              and tj.team_id = tt.id
              and tj.user_id = tu.id) t 
                                  group by (project_team_name)");

  $no_rows =mysqli_num_rows($qu_c);


  echo'
    <h4 class="card-title">Total : '.$no_rows.'</h4>
    <div class="table-responsive">
      <table class="table table1">
        <thead class="table-dark">
          <tr>
          <th scope="col">Team Name</th>

          <th scope="col">Category</th>
          <th scope="col">Judge</th>
          
        
            
          </tr>
        </thead>
        <tbody>';
       
				
				while($r_team = mysqli_fetch_assoc($qu_c))
					{		
        
       		
          
          echo '	<tr> 
          <td> '.$r_team["project_team_name"].'</td> 
        
          <td> '.$r_team["category"].'</a></td> 
          <td> '.$r_team["judge_list"].'</a></td> 
         
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