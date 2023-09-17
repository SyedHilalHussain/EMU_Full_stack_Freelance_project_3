<?php 
include 'config.php';
$team_id= $_POST['query'];
$title=$_POST['title'];
$q_t = mysqli_query($conn,"select * from tbl_team where id = $team_id");
$d_t = mysqli_fetch_assoc($q_t);
$team_name = $d_t['project_team_name'];



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
    <h1 class="card-title ">Team Name:'.$team_name.'</h1>
    <div class="table-responsive">
      <table class="table team_table">
     
        <thead>
        <tr>
        <th scope="col">Evaluation Text</th>';
        
   
        $q_j = mysqli_query($conn,"SELECT jt.* 
        FROM tbl_judge_team jt
        JOIN tbl_judge_assessment ja ON jt.user_id = ja.user_id 
        WHERE jt.team_id = $team_id AND ja.team_id = $team_id 
        ORDER BY jt.user_id ASC");
        $count = mysqli_num_rows($q_j);
      
        $i=1;
        while($d_j = mysqli_fetch_assoc($q_j))
        {
        
    #<a href="JudgeDetails.php?id='.$d_j['user_id'].'"
        
      echo'  <th scope="col"><a href="profile.php?id='.$d_j['user_id'].'">Judge'.$i.'</a></th>
        '; 
        $i++;}
        
    
       
         
       echo ' </tr>
        </thead>
        <tbody>';
        
        $columnMapping = array(
            'identifying_understanding' => 'Identifying & Understanding',
            'ideating' => 'Ideating',
            'designing_building' => 'Designing & Building',
            'testing_refinging' => 'Testing & Refining',
            'value_propoition' => 'Value Proposition',
            'market_potential' => 'Market Potential',
            'social_value' => 'Social Value',
            'originality' => 'Originality',
            'logbook' => 'LogBook',
            'display_board' => 'Display Board',
            'prototype' => 'Prototype',
            'online_pitch' => 'Online Pitch',
            'question_asked' => 'Q & A',
            'live_qa' => 'Live QA'
        );
        
        $sql = mysqli_query($conn, "DESCRIBE tbl_judge_assessment");
        
        while ($d = mysqli_fetch_assoc($sql)) {
            $col_name_val = '';
            $col_name = $d['Field'];
        
            if ($col_name != 'id' && $col_name != 'team_id' && $col_name != 'user_id') {
                $q_team = mysqli_query($conn, "SELECT team_id, GROUP_CONCAT(IFNULL($col_name, 'Incomplete') ORDER BY user_id SEPARATOR '; ') AS val, GROUP_CONCAT(user_id ORDER BY user_id SEPARATOR ', ') AS judges FROM tbl_judge_assessment WHERE team_id = $team_id ORDER BY user_id ASC");
        
                $r_team = mysqli_fetch_assoc($q_team);
        
                $string = $r_team['val'];
                $string = rtrim($string, '.');
                $array = explode('; ', $string);
                $judges_list = $r_team['judges'];
                $string_j = rtrim($judges_list, '.');
                $array_j = explode(', ', $string_j);
        
                if (array_key_exists($col_name, $columnMapping)) {
                    $col_name_val = $columnMapping[$col_name];
                }
                // Rest of your code
            
        
        
    
	
				
          
            echo '<tr>
            <td style="width: 40px;">' . $col_name_val . '</td>';
            $i=0;
        foreach ($array as $value) {
            echo '<td style="width: 10px;">
                    <a href="update_evaluation_team.php?judge_id=' . $array_j[$i] . '&team_id=' . $team_id . '">
                        ' . $value . PHP_EOL . '
                    </a>
                </td>';
            $i++;
        }
        
        $q = "SELECT user_id FROM tbl_judge_team 
              WHERE team_id = $team_id AND user_id NOT IN 
              (SELECT user_id FROM tbl_judge_assessment WHERE team_id = $team_id ORDER BY user_id ASC) 
              ORDER BY user_id ASC";
        $qu_q = mysqli_query($conn, $q);
        
        while ($qu_d = mysqli_fetch_assoc($qu_q)) {
            echo '<td style="width: 10px;">
                    <a href="evaluate_team.php?judge_id=' . $qu_d['user_id'] . '&team_id=' . $team_id . '">
                        Incomplete
                    </a>
                </td>';
        }
        
        echo '</tr>';
        
           } }
        echo '</tbody>
      </table>
    </div>
  </div>
</div>
</div>
</div>';



?>