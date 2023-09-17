<?php 
include 'config.php';
echo '
<div class="page-header">
<h3 class="page-title">
  <span class="page-title-icon  text-white me-2">
    <i class="mdi mdi-view-dashboard"></i>
  </span> Dashboard ->
  <span class="subtitle">Confirm Judges</span>
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
          <th scope="col">JudgeFirst Name</th>
          <th scope="col">Judge Last Name</th>
          <th scope="col">Category</th>
          <th scope="col">Confirm Judge</th>
          
          <th> View Details</th>
            
          </tr>
        </thead>
        <tbody>';
        
        $q_team = mysqli_query($conn,"");	
									
        while ($r_team = mysqli_fetch_assoc($q_team))					
        {
        
				
          
          echo '	<tr> 
          <td> '.$r_team["first_name"].'</td> 
          <td> '.$r_team["last_name"].'</a></td> 
          <td> '.$r_team["category"].'</a></td> 
          <td> '.$r_team["judge_confirm"].'</a></td> 
         
          <td><a href="JudgeDetails.php?id='.$r_team["id"].'"><button type="button" style="margin:0px;"  class="btn btn-success btn-gradient-success btn-sm  "  onclick="edit(this)">View Details</button></a></td> 
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