<?php

#echo $return;
include('../superadmin/config.php'); 


if(isset($_GET['table']) && isset($_GET['table'])== 'tbl_team')
{
    $tab = $_GET['table'];
$id = $_GET['id'];
$return = $_GET['return'];
	echo 'isnide tab';
	$query = mysqli_query($conn,"update tbl_team set deleted = 1 where id = $id");
	if($query)
	{ mysqli_query($conn,"update tbl_team_member set team_id = NULL where team_id = $id"); }
	#header("location:home.php");
	#exit();
	echo "<script type='text/javascript'>
	alert('Deleted Successfully');
	document.location = 'home.php';
	</script>";
}
else 
{
	$q = "update $tab set deleted = 1 where id = $id";
	echo 'error'.$q;
}
mysqli_close($con);
#header("location:home.php");




?>