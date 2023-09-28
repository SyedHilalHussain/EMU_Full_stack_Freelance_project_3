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
  $q_team = mysqli_query($conn,$query);
  $num_row = mysqli_num_rows($q_team);
    
    
    echo '<h4 class="card-title">Total '.$num_row.'</h4>
    <div class="table-responsive">
      <table class="table table1">
        <thead class="table-dark">
          <tr>
          <th scope="col">S.No</th>
      	<th scope="col">Judge</th>
						<th scope="col">Judge Email</th>
						<th scope="col">Team Name</th>
						<th scope="col">Category</th>
          
       
            
          </tr>
        </thead>
        <tbody>';
        
      
        $count = 1;					
        while ($r_team = mysqli_fetch_assoc($q_team))					
        {	
				
          
          echo '<tr> 
          <td> '.$count.'</td> 
          <td><a href="JudgeDetails.php?id='. $r_team["user_id"].'">'. $r_team['judge_name'].'</a></td> 
          <td><a href="JudgeDetails.php?id='. $r_team["user_id"].'">'. $r_team['email'].'</a></td> 
          <td>'. $r_team['project_team_name'].'</a></td> 
          <td>'. $r_team['category'].'</a></td> 
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

        }

?>