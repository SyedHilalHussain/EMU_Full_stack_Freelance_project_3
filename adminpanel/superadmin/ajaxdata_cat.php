<?php
include('config.php');




// $id = $_SESSION['id'];
// $name = $_SESSION['name'];

//Include database configuration file

$cat = $_POST['cat'];

if($_POST["cat"]==''){
    //Get all state data
    $query2 = mysqli_query($conn,"SELECT * FROM tbl_team  ORDER BY project_team_name ASC");
    
    //Count total number of rows
   
        echo '<option value="">Select Team-1</option>';
        while($row2 = mysqli_fetch_assoc($query2)){ 
            $tid = $row2['id'];
		$s_c = mysqli_query($conn,"select count(*) as count from tbl_judge_team where team_id = $tid");
		$d_c = mysqli_fetch_assoc($s_c);
        echo '<option value='.$row2['id'].'>'.$row2['project_team_name'].'- Team Category -'.$row2['category'].'-('.$d_c['count'].')</option>';
        }
    
}
elseif(isset($_POST["cat"])){
    $query2 = mysqli_query($conn,"SELECT * FROM tbl_team WHERE category = '$cat' ORDER BY project_team_name ASC");
    
    //Count total number of rows
   
        echo '<option value="">Select Team-1</option>';
        while($row2 = mysqli_fetch_assoc($query2)){ 
            $tid = $row2['id'];
		$s_c = mysqli_query($conn,"select count(*) as count from tbl_judge_team where team_id = $tid");
		$d_c = mysqli_fetch_assoc($s_c);
        echo '<option value='.$row2['id'].'>'.$row2['project_team_name'].'- Team Category -'.$row2['category'].'-('.$d_c['count'].')</option>';
        }
}else{
    echo '<option value="">team'.$cat.'</option>';
}
?>




