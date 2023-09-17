<?php
$tab = $_GET['table'];
$id = $_GET['id'];
$return = $_GET['return'];
#echo $return;
include('./../superadmin/config.php'); 


$query = mysqli_query($conn,"update $tab set deleted = 1 where id = $id");

if($query)
{
	$query = mysqli_query($conn,"update tbl_team_member set deleted = 1 where team_id = $id");
	#header("location:home.php");
	#exit();
	echo "<script type='text/javascript'>
	alert('Deleted Successfully');
	document.location = 'home.php';
	</script>";
}
else 
{
	echo "<script type='text/javascript'>
	alert('error');
	document.location = 'home.php';
	</script>";
}
mysqli_close($con);
header("location:home.php");




?>