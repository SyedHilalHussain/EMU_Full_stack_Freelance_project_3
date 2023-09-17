<?php 
include('config.php'); 


// $id = $_SESSION['id'];
// $name = $_SESSION['name'];
if($_POST['id']==1){
$json = json_decode(file_get_contents("php://input"));
$array = array();
$cat_arr = array();
//Include database configuration file
#$cat = json_decode($_GET['caty']);
$team_id = json_decode($_POST['id_data']);
$array = ($team_id);
#echo $array;
$list = join(',', $array);
$cat = $_POST['caty'];
// echo $cat;
if($list){
	if ($cat)
	{
	//Get all state data
    $query2 = mysqli_query($conn,"SELECT * FROM tbl_team WHERE id not in ($list) and category = '$cat' ORDER BY project_team_name ASC");
    #$q = "SELECT * FROM tbl_team WHERE id not in ($list) and category = '$cat' ORDER BY project_team_name ASC";
    //Count total number of rows
   
        echo '<option value="0" >Select Team-2</option>';
        while($row2 = mysqli_fetch_assoc($query2)){ 
        $tid = $row2['id'];
		$s_c = mysqli_query($conn,"select count(*) as count from tbl_judge_team where team_id = $tid");
		$d_c = mysqli_fetch_assoc($s_c);
        echo '<option value='.$row2['id'].'>'.$row2['project_team_name'].'- Team Category -'.$row2['category'].'-('.$d_c['count'].')</option>';
        }
        
    
}   
else 
{
	$query2 = mysqli_query($conn,"SELECT * FROM tbl_team WHERE id not in ($list) ORDER BY project_team_name ASC");
   # $q = "SELECT * FROM tbl_team WHERE id not in ($list) ORDER BY project_team_name ASC";
    //Count total number of rows
   
        echo '<option value="0" >Select Team-2</option>';
        while($row2 = mysqli_fetch_assoc($query2)){ 
            echo '<option value='.$row2['id'].'>'.$row2['project_team_name'].'- Team Category -'.$row2['category'].'</option>';
        }
}
}
else{
	echo '<option value="0" >team'.$team_id.'</option>';
}
}elseif($_POST['id']==2){
    $json = json_decode(file_get_contents("php://input"));
    $array = array();
    $cat_arr = array();
    //Include database configuration file
    #$cat = json_decode($_GET['caty']);
    $team_id = json_decode($_POST['id_data']);
    $array = ($team_id);
    #echo $array;
    $list = join(',', $array);
    $cat = $_POST['caty'];
    // echo $cat;
    if($list){
        if ($cat)
        {
        //Get all state data
        $query2 = mysqli_query($conn,"SELECT * FROM tbl_team WHERE id not in ($list) and category = '$cat' ORDER BY project_team_name ASC");
        #$q = "SELECT * FROM tbl_team WHERE id not in ($list) and category = '$cat' ORDER BY project_team_name ASC";
        //Count total number of rows
       
            echo '<option value="0" >Select Team-3</option>';
            while($row2 = mysqli_fetch_assoc($query2)){ 
            $tid = $row2['id'];
            $s_c = mysqli_query($conn,"select count(*) as count from tbl_judge_team where team_id = $tid");
            $d_c = mysqli_fetch_assoc($s_c);
            echo '<option value='.$row2['id'].'>'.$row2['project_team_name'].'- Team Category -'.$row2['category'].'-('.$d_c['count'].')</option>';
            }
            
        
    }   
    else 
    {
        $query2 = mysqli_query($conn,"SELECT * FROM tbl_team WHERE id not in ($list) ORDER BY project_team_name ASC");
       # $q = "SELECT * FROM tbl_team WHERE id not in ($list) ORDER BY project_team_name ASC";
        //Count total number of rows
       
            echo '<option value="0" >Select Team-3</option>';
            while($row2 = mysqli_fetch_assoc($query2)){ 
                echo '<option value='.$row2['id'].'>'.$row2['project_team_name'].'- Team Category -'.$row2['category'].'</option>';
            }
    }
    }
    else{
        echo '<option value="0" >team'.$team_id.'</option>';
    }
    }elseif($_POST['id']==3){
        $json = json_decode(file_get_contents("php://input"));
        $array = array();
        $cat_arr = array();
        //Include database configuration file
        #$cat = json_decode($_GET['caty']);
        $team_id = json_decode($_POST['id_data']);
        $array = ($team_id);
        #echo $array;
        $list = join(',', $array);
        $cat = $_POST['caty'];
        // echo $cat;
        if($list){
            if ($cat)
            {
            //Get all state data
            $query2 = mysqli_query($conn,"SELECT * FROM tbl_team WHERE id not in ($list) and category = '$cat' ORDER BY project_team_name ASC");
            // $q = "SELECT * FROM tbl_team WHERE id not in ($list) and category = '$cat' ORDER BY project_team_name ASC";
            //Count total number of rows
           
                echo '<option value="0" >Select Team-4</option>';
                while($row2 = mysqli_fetch_assoc($query2)){ 
                $tid = $row2['id'];
                $s_c = mysqli_query($conn,"select count(*) as count from tbl_judge_team where team_id = $tid");
                $d_c = mysqli_fetch_assoc($s_c);
                echo '<option value='.$row2['id'].'>'.$row2['project_team_name'].'- Team Category -'.$row2['category'].'-('.$d_c['count'].')</option>';
                }
                
            
        }   
        else 
        {
            $query2 = mysqli_query($conn,"SELECT * FROM tbl_team WHERE id not in ($list) ORDER BY project_team_name ASC");
           # $q = "SELECT * FROM tbl_team WHERE id not in ($list) ORDER BY project_team_name ASC";
            //Count total number of rows
           
                echo '<option value="0" >Select Team-4</option>';
                while($row2 = mysqli_fetch_assoc($query2)){ 
                    echo '<option value='.$row2['id'].'>'.$row2['project_team_name'].'- Team Category -'.$row2['category'].'</option>';
                }
        }
        }
        else{
            echo '<option value="0" >team'.$team_id.'</option>';
        }
        }elseif($_POST['id']==4){
            $json = json_decode(file_get_contents("php://input"));
            $array = array();
            $cat_arr = array();
            //Include database configuration file
            #$cat = json_decode($_GET['caty']);
            $team_id = json_decode($_POST['id_data']);
            $array = ($team_id);
            #echo $array;
            $list = join(',', $array);
            $cat = $_POST['caty'];
            // echo $cat;
            if($list){
                if ($cat)
                {
                //Get all state data
                $query2 = mysqli_query($conn,"SELECT * FROM tbl_team WHERE id not in ($list) and category = '$cat' ORDER BY project_team_name ASC");
                #$q = "SELECT * FROM tbl_team WHERE id not in ($list) and category = '$cat' ORDER BY project_team_name ASC";
                //Count total number of rows
               
                    echo '<option value="0" >Select Team-5</option>';
                    while($row2 = mysqli_fetch_assoc($query2)){ 
                    $tid = $row2['id'];
                    $s_c = mysqli_query($conn,"select count(*) as count from tbl_judge_team where team_id = $tid");
                    $d_c = mysqli_fetch_assoc($s_c);
                    echo '<option value='.$row2['id'].'>'.$row2['project_team_name'].'- Team Category -'.$row2['category'].'-('.$d_c['count'].')</option>';
                    }
                    
                
            }   
            else 
            {
                $query2 = mysqli_query($conn,"SELECT * FROM tbl_team WHERE id not in ($list) ORDER BY project_team_name ASC");
               # $q = "SELECT * FROM tbl_team WHERE id not in ($list) ORDER BY project_team_name ASC";
                //Count total number of rows
               
                    echo '<option value="0" >Select Team-5</option>';
                    while($row2 = mysqli_fetch_assoc($query2)){ 
                        echo '<option value='.$row2['id'].'>'.$row2['project_team_name'].'- Team Category -'.$row2['category'].'</option>';
                    }
            }
            }
            else{
                echo '<option value="0" >team'.$team_id.'</option>';
            }
            }elseif($_POST['id']==5){
                $json = json_decode(file_get_contents("php://input"));
                $array = array();
                $cat_arr = array();
                //Include database configuration file
                #$cat = json_decode($_GET['caty']);
                $team_id = json_decode($_POST['id_data']);
                $array = ($team_id);
                #echo $array;
                $list = join(',', $array);
                $cat = $_POST['caty'];
                // echo $cat;
                if($list){
                    if ($cat)
                    {
                    //Get all state data
                    $query2 = mysqli_query($conn,"SELECT * FROM tbl_team WHERE id not in ($list) and category = '$cat' ORDER BY project_team_name ASC");
                    #$q = "SELECT * FROM tbl_team WHERE id not in ($list) and category = '$cat' ORDER BY project_team_name ASC";
                    //Count total number of rows
                   
                        echo '<option value="0" >Select Team-6</option>';
                        while($row2 = mysqli_fetch_assoc($query2)){ 
                        $tid = $row2['id'];
                        $s_c = mysqli_query($conn,"select count(*) as count from tbl_judge_team where team_id = $tid");
                        $d_c = mysqli_fetch_assoc($s_c);
                        echo '<option value='.$row2['id'].'>'.$row2['project_team_name'].'- Team Category -'.$row2['category'].'-('.$d_c['count'].')</option>';
                        }
                        
                    
                }   
                else 
                {
                    $query2 = mysqli_query($conn,"SELECT * FROM tbl_team WHERE id not in ($list) ORDER BY project_team_name ASC");
                   # $q = "SELECT * FROM tbl_team WHERE id not in ($list) ORDER BY project_team_name ASC";
                    //Count total number of rows
                   
                        echo '<option value="0" >Select Team-6</option>';
                        while($row2 = mysqli_fetch_assoc($query2)){ 
                            echo '<option value='.$row2['id'].'>'.$row2['project_team_name'].'- Team Category -'.$row2['category'].'</option>';
                        }
                }
                }
                else{
                    echo '<option value="0" >team'.$team_id.'</option>';
                }
                }

?>