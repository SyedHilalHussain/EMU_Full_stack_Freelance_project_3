<?php
include('../database/config.php'); 
include('control.php'); 

$id = $_SESSION['id'];
$name = $_SESSION['name'];


$interest_q = mysqli_query($con,"select count(*) as count from tbl_user where user_type not in ('SuperUser')");
$interest_d = mysqli_fetch_assoc($interest_q);

$volunteer_q = mysqli_query($con,"select count(*) as count from tbl_user where interested like '%Volunteering%'");
$volunteer_d = mysqli_fetch_assoc($volunteer_q);

$judges_q = mysqli_query($con,"select count(*) as count from tbl_user where interested like '%Judging%'");
$judges_d = mysqli_fetch_assoc($judges_q);

$mentor_q = mysqli_query($con,"select count(*) as count from tbl_user where interested like '%Mentoring%'");
$mentor_d = mysqli_fetch_assoc($mentor_q);

$team_q = mysqli_query($con,"select count(*) as count from tbl_team");
$team_d = mysqli_fetch_assoc($team_q);



$comple_c_q = mysqli_query($con,"select count(*) as count from tbl_team where (video_pitch is not null and log_book!='') ");
$complete_c_d = mysqli_fetch_assoc($comple_c_q);


$incomple_q = mysqli_query($con,"select count(*) as count from tbl_team where (video_pitch is null or log_book='' or log_book is null) ");
$incomplete_d = mysqli_fetch_assoc($incomple_q);


$incomple_l_q = mysqli_query($con,"select count(*) as count from tbl_team tt where log_book is null");
$incomplete_l_d = mysqli_fetch_assoc($incomple_l_q);

$incomple_v_q = mysqli_query($con,"select count(*) as count from tbl_team tt where video_pitch is null");
$incomplete_v_d = mysqli_fetch_assoc($incomple_v_q);


$school_d_q = mysqli_query($con,"select count(distinct student_school_district) as count from tbl_team_member");
$school_d_d = mysqli_fetch_assoc($school_d_q);

$school_d_aa = mysqli_query($con,"select count(*)as count from tbl_team where id in (select team_id from tbl_team_member where student_school_district like '%Ann Arbor%')");
$school_aa_d = mysqli_fetch_assoc($school_d_aa);

$school_d_la = mysqli_query($con,"select count(*)as count from tbl_team where id in (select team_id from tbl_team_member where student_school_district like '%Livonia%')");
$school_la_d = mysqli_fetch_assoc($school_d_la);

$school_d_pc = mysqli_query($con,"select count(*)as count from tbl_team where id in (select team_id from tbl_team_member where student_school_district like '%Plymouth%')");
$school_pc_d = mysqli_fetch_assoc($school_d_pc);

$school_d_sa = mysqli_query($con,"select count(*)as count from tbl_team where id in (select team_id from tbl_team_member where student_school_district like '%Saline%')");
$school_sa_d = mysqli_fetch_assoc($school_d_sa);

$tot_j_q = mysqli_query($con,"select count(*)as count from tbl_user where user_type='Judge'");
$tot_j_d = mysqli_fetch_assoc($tot_j_q);

$conf_j_q = mysqli_query($con,"select count(*)as count from tbl_user where user_type='Judge' and judge_confirm='Y'");
$conf_j_d = mysqli_fetch_assoc($conf_j_q);


$prof_j_q = mysqli_query($con,"select count(*)as count from tbl_user where user_type='Judge' and category like 'Professional%'");
$prof_j_d = mysqli_fetch_assoc($prof_j_q);

$fac_j_q = mysqli_query($con,"select count(*)as count from tbl_user where user_type='Judge' and category='Faculty'");
$fac_j_d = mysqli_fetch_assoc($fac_j_q);

$stud_j_q = mysqli_query($con,"select count(*)as count from tbl_user where user_type='Judge' and category='Student'");
$stud_j_d = mysqli_fetch_assoc($stud_j_q);

$other_j_q = mysqli_query($con,"select count(*)as count from tbl_user where user_type='Judge' and category = 'Others'");
$other_j_d = mysqli_fetch_assoc($other_j_q);

$pt_j_q = mysqli_query($con,"select count(*)as count from tbl_user where user_type='Judge' and category like '%Pre-service%'");
$pt_j_d = mysqli_fetch_assoc($pt_j_q);

$k_j_q = mysqli_query($con,"select count(*)as count from tbl_user where user_type='Judge' and category = 'K-12 teachers'");
$k_j_d = mysqli_fetch_assoc($k_j_q);

$j_ass_q = mysqli_query($con,"select  distinct user_id, count(*) as count from tbl_judge_team group by (user_id)");
$j_ass_d = mysqli_fetch_assoc($j_ass_q);
$count_j = mysqli_num_rows($j_ass_q);

$j_ass_3q = mysqli_query($con,"select  distinct user_id, count(*) as count from tbl_judge_team group by (user_id) having count(user_id) <=3");
$j_ass_3d = mysqli_fetch_assoc($j_ass_3q);
$count_3j = mysqli_num_rows($j_ass_3q);

$j_ass_4q = mysqli_query($con,"select  distinct user_id, count(*) as count from tbl_judge_team group by (user_id) having count(user_id) = 4");
$j_ass_4d = mysqli_fetch_assoc($j_ass_4q);
$count_4j = mysqli_num_rows($j_ass_4q);


$j_ass_5q = mysqli_query($con,"select  distinct user_id, count(*) as count from tbl_judge_team group by (user_id) having count(user_id) = 5");
$j_ass_5d = mysqli_fetch_assoc($j_ass_5q);
$count_5j = mysqli_num_rows($j_ass_5q);

$j_ass_6q = mysqli_query($con,"select  distinct user_id, count(*) as count from tbl_judge_team group by (user_id) having count(user_id) = 6");
$j_ass_6d = mysqli_fetch_assoc($j_ass_6q);
$count_6j = mysqli_num_rows($j_ass_6q);


$k_ass_q = mysqli_query($con,"select team_id, count(team_id) from tbl_judge_team group by team_id");
$count_k = mysqli_num_rows($k_ass_q);

$k_ass_2q = mysqli_query($con,"
select GROUP_CONCAT(concat(first_name,' ', last_name)) as judge_list , project_team_name, tt.category 
															from `tbl_judge_team` tj, tbl_user tu, tbl_team tt
															WHERE tj.user_id=tu.id
															and tu.id = tj.user_id
															and tj.team_id = tt.id
                                        					group by (project_team_name)
                                        					having count(project_team_name) < 3");
$count_2k = mysqli_num_rows($k_ass_2q);


$k_ass_3q = mysqli_query($con,"select team_id, count(team_id) from tbl_judge_team group by (team_id) having count(team_id) = 3");
$count_3k = mysqli_num_rows($k_ass_3q);


$k_ass_4q = mysqli_query($con,"select team_id, count(team_id) from tbl_judge_team group by (team_id) having count(team_id) = 4");
$count_4k = mysqli_num_rows($k_ass_4q);


$k_ass_5q = mysqli_query($con,"select team_id, count(team_id) from tbl_judge_team group by (team_id) having count(team_id) = 5");
$count_5k = mysqli_num_rows($k_ass_5q);

$k_ass_6q = mysqli_query($con,"select team_id, count(team_id) from tbl_judge_team group by (team_id) having count(team_id) = 6");
$count_6k = mysqli_num_rows($k_ass_6q);


$count_comp_j = 0;
$count_comp1_j = 0;
$count_comp2_j = 0;
$count_comp3_j = 0;
$count_comp4_j = 0;
$count_comp5_j = 0;
$count_comp6_j = 0;
$j_c_e = mysqli_query($con,"select user_id, count(user_id) as count from tbl_judge_team group by (user_id)");
while($row = mysqli_fetch_assoc($j_c_e))
{
	$user_id = $row['user_id'];
	$count_tj = $row['count'];
	$q_c = mysqli_query($con,"select count(user_id) as count from tbl_judge_assessment where user_id = $user_id and (identifying_understanding is not null 
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
		$count_comp_j = $count_comp_j + 1;
	}
	else 
	{
		if(($count_tj-$count_tja) == 1)
		{
			$count_comp1_j = $count_comp1_j + 1;
		}
		if(($count_tj-$count_tja) == 2)
		{
			$count_comp2_j = $count_comp2_j + 1;
		}
		if(($count_tj-$count_tja) == 3)
		{
			$count_comp3_j = $count_comp3_j + 1;
		}
		if(($count_tj-$count_tja) == 4)
		{
			$count_comp4_j = $count_comp4_j + 1;
		}
		if(($count_tj-$count_tja) == 5)
		{
			$count_comp5_j = $count_comp5_j + 1;
		}
		if(($count_tj-$count_tja) == 6)
		{
			$count_comp6_j = $count_comp6_j + 1;
		}
		
	}
	
}

$count_comp_t = 0;
$count_comp1_t = 0;
$count_comp2_t = 0;
$count_comp3_t = 0;
$count_comp4_t = 0;
$count_comp5_t = 0;
$count_comp6_t = 0;
$t_c_e = mysqli_query($con,"select team_id, count(team_id) as count from tbl_judge_team group by (team_id)");
while($row_t = mysqli_fetch_assoc($t_c_e))
{
	$team_id = $row_t['team_id'];
	$count_t = $row_t['count'];
	$q_tc = mysqli_query($con,"select count(team_id) as count from tbl_judge_assessment where team_id = $team_id and (identifying_understanding is not null 
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
	$t_c = mysqli_fetch_assoc($q_tc);
	
	$count_ta = $t_c['count'];
	if($count_t==$count_ta)
	{	
		$count_comp_t = $count_comp_t + 1;
		#echo $team_id;
	}
	else 
	{
		if(($count_t-$count_ta)==1)
		{
			$count_comp1_t = $count_comp1_t + 1;
		}
		if(($count_t-$count_ta)==2)
		{
			$count_comp2_t = $count_comp2_t + 1;
		}
		if(($count_t-$count_ta)==3)
		{
			$count_comp3_t = $count_comp3_t + 1;
		}
		if(($count_t-$count_ta)==4)
		{
			$count_comp4_t = $count_comp4_t + 1;
		}
		if(($count_t-$count_ta)==5)
		{
			$count_comp5_t = $count_comp5_t + 1;
		}
		if(($count_t-$count_ta)==6)
		{
			$count_comp6_t = $count_comp6_t + 1;
		}
		
	}
	
}

$results_912_q = mysqli_query($con,"select group_concat(concat(project_name,'-',(@row_number:=@row_number + 1)) SEPARATOR '<br>') as team_name from (select team_id, tt.project_team_name as project_name, tt.category, avg(total) as total from tbl_team tt, stut_tot st where tt.id = st.team_id and tt.category = '9-12' group by(team_id) order by total desc limit 3 ) t, (SELECT @row_number := 0) r");
										
$r = mysqli_fetch_assoc($results_912_q);
$teams_9 = $r['team_name'];

$results_68_q = mysqli_query($con,"select group_concat(concat(project_name,'-',(@row_number:=@row_number + 1)) SEPARATOR '<br>') as team_name from (select team_id, tt.project_team_name as project_name, tt.category, avg(total) as total from tbl_team tt, stut_tot st where tt.id = st.team_id and tt.category = '6-8' group by(team_id) order by total desc limit 3 ) t, (SELECT @row_number := 0) r");
										
$r_6 = mysqli_fetch_assoc($results_68_q);
$teams_6 = $r_6['team_name'];

#$sel = "SET @row_number=0;";
$sel = "select group_concat(concat(project_name,'-',(@row_number:=@row_number + 1)) SEPARATOR '<br>') as team_name 
from (select team_id, tt.project_team_name as project_name, tt.category, avg(total) as total
										from tbl_team tt, stut_tot st
										where tt.id = st.team_id
                                        and tt.category = '3-5'
										group by(team_id)
                                        order by total desc
                                        limit 3
                                        ) t, (SELECT @row_number := 0) r";
										#echo $sel;
$results_35_q = mysqli_query($con, $sel);


#$results_35_q = mysqli_query($con,"");
										
$r_3 = mysqli_fetch_assoc($results_35_q);
$teams_3 = $r_3['team_name'];

$results_k2_q = mysqli_query($con,"select group_concat(concat(project_name,'-',(r.a)) SEPARATOR '<br>') as team_name from (select team_id, tt.project_team_name as project_name, tt.category, avg(total) as total from tbl_team tt, stut_tot st where tt.id = st.team_id and tt.category = 'K-2' group by(team_id) order by total desc limit 3 ) t, (SELECT (@row_number := 1) as a) r");
										
$r_k = mysqli_fetch_assoc($results_k2_q);
$teams_k = $r_k['team_name'];



$sel_q = mysqli_query($con,"select count(distinct team_id) as count from tbl_judge_assessment where live_qa is not null");
$live_complete_pitches=mysqli_fetch_assoc($sel_q);										

$sel_aq = mysqli_query($con,"select count(distinct team_id) as count from tbl_judge_assessment where live_qa is null");
$live_incomplete_pitches=mysqli_fetch_assoc($sel_aq);										

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Home</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="css/widget.css" type="text/css">
	<link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

<link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
</head>
<style>
html, body {
    top:0;
    bottom:0;
    left:0;
    right:0;
    
   
}
</style>
 <?php include('../header.php'); ?>
<body>
<div id="wrapper">


	<nav class="navbar navbar-expand bg-dark navbar-dark" style="margin-top:20px;width:100%;">
        <!-- Links -->
        <ul class="navbar-nav">

            <li class="nav-item" style="font-weight: bold;">
                <a class="nav-link" href="home.php">Home</a>
            </li>
			
			
			<!--<li class="nav-item dropdown" style="font-weight: bold;">
                <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                    Add
                </a>
                <div class="dropdown-menu"  id="mainNavbar">
                    <!--<a class="dropdown-item" href="teams.php">Teams</a>
                    <a class="dropdown-item" href="add_judges.php">Judges</a>
                </div>
            </li>-->
			
			
			<li class="nav-item dropdown" style="font-weight: bold;">
                <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                    View
                </a>
                <div class="dropdown-menu"  id="mainNavbar">
                    <a class="dropdown-item" href="users.php">Users</a>
					<a class="dropdown-item" href="teams.php">Teams</a>
                    <a class="dropdown-item" href="judges.php">Judges</a>
                </div>
            </li>
			
			<!--<li class="nav-item dropdown" style="font-weight: bold;">
                <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                    View
                </a>
                <div class="dropdown-menu"  id="mainNavbar">
                    <a class="dropdown-item" href="teams.php">Teams</a>
                    <a class="dropdown-item" href="judges.php">Judges</a>
                </div>
            </li>-->
			
			
			<li class="nav-item dropdown" style="font-weight: bold;">
                <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                    Assign Teams vs Judges
                </a>
                <div class="dropdown-menu"  id="mainNavbar">
                    <a class="dropdown-item" href="assign_judge_team.php">Assign Teams vs Judges</a>
                    <a class="dropdown-item" href="view_judge_team.php">View Assigned Teams vs Judges</a>
                </div>
            </li>
			
			<li class="nav-item" style="font-weight: bold;">
                <a class="nav-link" href="liveqa_teams.php">Live QA</a>
            </li>
			
			
			<li class="nav-item" style="font-weight: bold;">
                <a class="nav-link" href="evaluation_results.php">Evaluation Details</a>
            </li>
			
			 <li class="nav-item dropdown" style="font-weight: bold;">
                <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                    <?php echo $name?>
                </a>
                <div class="dropdown-menu"  id="mainNavbar">
					<a class="dropdown-item" href="profile.php">Profile</a>
                    <a class="dropdown-item" href="logout.php">Logout</a>
                    
                </div>
            </li>

            <!--<li class="nav-item">
                <a class="nav-link" href="addStudent.html">Add Student</a>
            </li>

            <li class="nav-item" id="addAccount">
				<a class="nav-link" href="addUser.html">Add Account</a>
            </li>-->
        </ul>
    </nav>

    <br>
   
 <div class="jumbotron col-md-12" style="font-size: 14px;
    height: 10em;    margin-block-start: -129px;">
	<div class="row">
	
	
	
	<div class="col-md-4" >
			<div class="dbox dbox--color-1" style="height: 235px;">
				
				<div class="dbox__body" align="left">
				 <table style="margin-block-start: -43px;">
					<thead>
					<tr>
					<th align="Center"><a href="live_complete.php" style="text-color:white"><font color="white"><h3>Live Complete Pitches:<?php echo $live_complete_pitches['count']?></h3></font></a></th>
					</tr>
					</thead>
					<tbody> 
					<tr>
					<td style="width:40px"><a href="live_complete.php" style="text-color:white"><span class="dbox__title" style=" font-size: 16px;">Complete</span></a></td>
					<td style="width:175px;"><a href="live_incomplete.php" style="text-color:white"><span class="dbox__title" style=" font-size: 16px;">Incomplete</span></a></td>
					</tr>
					<tr>
					<td style="width:40px"><a href="live_complete.php"><span class="dbox__count"><?php echo $live_complete_pitches['count']?></span></a></td>
					<td style="width:175px"><a href="live_incomplete.php"><span class="dbox__count"><?php echo $live_incomplete_pitches['count']?></span></a></td>
					
					</tr>
					</tbody>
					</table>
					
					
                <!--<span class="dbox__count"><?php echo $complete_c_d['count']?></span>-->
					
				</div>
				
						
			</div>
		</div>
	
	
	<div class="col-md-4" >
			<div class="dbox dbox--color-1" style="height: 235px;">
				
				<div class="dbox__body" align="left">
				 <table style="margin-block-start: -43px;">
					<thead>
					<tr>
					<th align="Center"><a href="community_interest.php" style="text-color:white"><font color="white"><h3>Community Interest:<?php echo $interest_d['count']?></h3></font></a></th>
					</tr>
					</thead>
					<tbody> 
					<tr>
					<td style="width:40px"><a href="volunteers.php" style="text-color:white"><span class="dbox__title" style=" font-size: 16px;">Volunteers</span></a></td>
					<td style="width:175px;"><a href="judges.php" style="text-color:white"><span class="dbox__title" style=" font-size: 16px;">Judges</span></a></td>
					<td style="width:120px;"><a href="teams.php" style="text-color:white"><span class="dbox__title" style=" font-size: 16px;">Teams</span></a></td>
					<td style="width:40px;"><a href="mentors.php" style="text-color:white"><span class="dbox__title" style=" font-size: 16px;">Mentors</span></a></td>
					</tr>
					<tr>
					<td style="width:40px"><a href="judges.php"><span class="dbox__count"><?php echo $volunteer_d['count']?></span></a></td>
					<td style="width:175px"><span class="dbox__count"><?php echo $judges_d['count']?></span></td>
					<td style="width:120px"><span class="dbox__count"><?php echo $team_d['count']?></span></td>
					<td style="width:40px"><span class="dbox__count"><?php echo $mentor_d['count']?></span></td>
					</tr>
					</tbody>
					</table>
					
					
                <!--<span class="dbox__count"><?php echo $complete_c_d['count']?></span>-->
					
				</div>
				
						
			</div>
		</div>
	
		
		
		
		<div class="col-md-4">
			<div class="dbox dbox--color-1">
				<!--<div class="dbox__icon">
					<i class="glyphicon glyphicon-cloud"></i>
				</div>-->
				<div class="dbox__body" align="left" style="height:235px">
				 <table style="margin-block-start: -43px;">
					<thead>
					<tr>
					<th align="Center"><a href="teams.php" style="text-color:white"><font color="white"><h3>Team Submissions:<?php echo $team_d['count']?></h3></font></a></th>
					</tr>
					</thead>
					<tbody> 
					<tr>
					<td style="width:40px"><a href="teams_complete.php" style="text-color:white"><span class="dbox__title" style=" font-size: 13px;">Complete</span></a></td>
					<td style="width:175px;"><a href="teams_incomplete_logbook.php" style="text-color:white"><span class="dbox__title" style=" font-size: 13px;">Incomplete</span></a></td>
					<td style="width:120px;"><a href="teams_incomplete_logbook.php" style="text-color:white"><span class="dbox__title" style=" font-size: 13px;">W/t LogBooks</span></a></td>
					<td style="width:40px;"><a href="teams_incomplete_videopitch.php" style="text-color:white"><span class="dbox__title" style=" font-size: 13px;">W/t Videos</span></a></td>
					</tr>
					<tr>
					<td style="width:40px"><span class="dbox__count"><?php echo $complete_c_d['count']?></span></td>
					<td style="width:175px"><span class="dbox__count"><?php echo $incomplete_d['count']?></span></td>
					<td style="width:120px"><span class="dbox__count"><?php echo $incomplete_l_d['count']?></span></td>
					<td style="width:40px"><span class="dbox__count"><?php echo $incomplete_v_d['count']?></span></td>
					</tr>
					
					
					</tbody>
					</table>
					
					
                <!--<span class="dbox__count"><?php echo $complete_c_d['count']?></span>-->
					
				</div>
				
							
			</div>
		</div>
		
		
		<div class="col-md-4" >
			<div class="dbox dbox--color-2" style="height: 367px;margin-block-start: -7px;">
				
				<div class="dbox__body" align="left">
				 <table style="margin-block-start: -43px;">
					<thead>
					<tr>
					<th align="Center"><a href="judges.php" style="text-color:white"><font color="white"><h3>Total Judges:<?php echo $tot_j_d['count'];?></h3></font></a></th>
					<th align="Center"><a href="confirm_judges.php" style="text-color:white"><font color="white"><h3>Confirmed Judges:<?php echo $conf_j_d['count'];?></h3></font></a></th>
					</tr>
					</thead>
					<tbody align="center"> 
					<tr>
					<td><a href="judges.php" style="text-color:white"><span class="dbox__title" style="font-size:16px">Professionals</span></td>
					<td><a href="judges.php" style="text-color:white"><span class="dbox__title" style="font-size:16px">Faculty</span></td>
					<td><a href="judges.php" style="text-color:white"><span class="dbox__title" style="font-size:16px">Pre-Service Teachers</span></td>
					</tr>
					
					<tr>
					<td><span class="dbox__count"><?php echo $prof_j_d['count']?></span></td>
					<td><span class="dbox__count"><?php echo $fac_j_d['count']?></span></td>
					<td><span class="dbox__count"><?php echo $pt_j_d['count']?></span></td>
					</tr>
					
					<tr>
					<td><a href="judges.php" style="text-color:white"><span class="dbox__title" style="font-size:16px">K-12 Teachers</span></td>
					<td><a href="judges.php" style="text-color:white"><span class="dbox__title" style="font-size:16px">Student</span></td>
					<td><a href="judges.php" style="text-color:white"><span class="dbox__title" style="font-size:16px">Others</span></td>
					</tr>
					
					
					<tr>
					<td><span class="dbox__count"><?php echo $k_j_d['count']?></span></td>
					<td><span class="dbox__count"><?php echo $stud_j_d['count']?></span></td>
					<td><span class="dbox__count"><?php echo $other_j_d['count']?></span></td>					
					</tr>
					</tbody>
					</table>
					
					
                <!--<span class="dbox__count"><?php echo $complete_c_d['count']?></span>-->
					
				</div>
				
						
			</div>
		</div>
		
		
		<div class="col-md-4" >
			<div class="dbox dbox--color-2" style="height: 367px;margin-block-start: -7px;">
				
				<div class="dbox__body" align="left">
				 <table style="margin-block-start: -43px;">
					<thead>
					<tr>
					<th align="Center"><a href="view_team_judge.php" style="text-color:white"><font color="white"><h3>Teams Allocation to Judges:<?php echo $count_k;?></h3></font></a></th>
					</tr>
					</thead>
					<tbody> 
					<tr>
					<td><a href="view_team2_judge.php" style="text-color:white"><span class="dbox__title" style="font-size:16px">Teams with less than 3 Judges</span></a></td>
					<td><a href="view_team2_judge.php" style="text-color:white"><span class="dbox__count"><?php echo $count_2k?></span></a></td>
					</tr>
					<tr>
					<td><a href="view_team3_judge.php" style="text-color:white"><span class="dbox__title" style="font-size:16px">Teams with 3 Judges</span></a></td>
					<td><a href="view_team3_judge.php" style="text-color:white"><span class="dbox__count"><?php echo $count_3k?></span></a></td>
					</tr>
					<tr>
					<td><a href="view_team4_judge.php" style="text-color:white"><span class="dbox__title" style="font-size:16px">Teams with 4 Judges</span></a></td>
					<td><a href="view_team4_judge.php" style="text-color:white"><span class="dbox__count"><?php echo $count_4k?></span></a></td>
					</tr>
					<tr>
					<td><span class="dbox__title" style="font-size:16px">Teams with 5 Judges</span></td>
					<td><span class="dbox__count"><?php echo $count_5k?></span></td>
					</tr>
					
					</tbody>
					</table>
					
					
                <!--<span class="dbox__count"><?php echo $complete_c_d['count']?></span>-->
					
				</div>
				
							
			</div>
		</div>
		
		<div class="col-md-4" >
			<div class="dbox dbox--color-2" style="height: 367px;margin-block-start: -7px;">
				
				<div class="dbox__body" align="left">
				 <table style="margin-block-start: -43px;">
					<thead>
					<tr>
					<th align="Center"><a href="view_judge_teams.php" style="text-color:white"><font color="white"><h3>Judges Allocation to Teams:<?php echo $count_j;?></h3></font></a></th>
					</tr>
					</thead>
					<tbody> 
					<tr>
					<td><a href="view_judge_teams_3.php" style="text-color:white"><span class="dbox__title" style="font-size:16px">3 Teams and less than 3</span></a></td>
					<td><a href="view_judge_teams_3.php" style="text-color:white"><span class="dbox__count"><?php echo $count_3j?></span></a></td>
					</tr>
					<tr>
					<td><a href="view_judge_teams_4.php" style="text-color:white"><span class="dbox__title" style="font-size:16px">4 Teams</span></a></td>
					<td><a href="view_judge_teams_4.php" style="text-color:white"><span class="dbox__count"><?php echo $count_4j?></span></a></td>
					</tr>
					<tr>
					<td><a href="view_judge_teams_5.php" style="text-color:white"><span class="dbox__title" style="font-size:16px">5 Teams</span></a></td>
					<td><a href="view_judge_teams_5.php" style="text-color:white"><span class="dbox__count"><?php echo $count_5j?></span></a></td>
					</tr>
					
					</tbody>
					</table>
					
					
                <!--<span class="dbox__count"><?php echo $complete_c_d['count']?></span>-->
					
				</div>
				
							
			</div>
		</div>
		
		<div class="col-md-4">
			<div class="dbox dbox--color-3" style="background: cornflowerblue;margin-block-start: -7px;height:571px">
				
				<div class="dbox__body" style="align:left">
				 <table style="margin-block-start: -43px;">
					<thead>
					<tr>
					<th align="Center"><a href="complete_judges.php" style="text-color:white"><font color="white"><h3>No Of Judges Completed evaluations:<?php echo $count_comp_j;?></h3></font></a></th>
					</tr>
					</thead>
					<tbody align="center"> 
					<tr>
					<td><a href="incomplete1_judges.php" style="text-color:white"><span class="dbox__title" style="font-size:16px">Judges With 1 incomplete Evaluation</span></a></td>
					<td><a href="incomplete1_judges.php" style="text-color:white"><span class="dbox__count"><?php echo $count_comp1_j?></span></a></td>
					</tr>
					<tr>
					<td><a href="incomplete2_judges.php" style="text-color:white"><span class="dbox__title" style="font-size:16px">Judges With 2 incomplete Evaluation</span></a></td>
					<td><a href="incomplete2_judges.php" style="text-color:white"><span class="dbox__count"><?php echo $count_comp2_j?></span></a></td>
					</tr>
					<tr>
					<td><a href="incomplete3_judges.php" style="text-color:white"><span class="dbox__title" style="font-size:16px">Judges With 3 incomplete Evaluation</span></a></td>
					<td><a href="incomplete3_judges.php" style="text-color:white"><span class="dbox__count"><?php echo $count_comp3_j?></span></a></td>
					</tr>
					<tr>
					<td><a href="incomplete4_judges.php" style="text-color:white"><span class="dbox__title" style="font-size:16px">Judges With 4 incomplete Evaluation</span></a></td>
					<td><a href="incomplete4_judges.php" style="text-color:white"><span class="dbox__count"><?php echo $count_comp4_j?></span></a></td>
					</tr>
					<tr>
					<td><a href="incomplete5_judges.php" style="text-color:white"><span class="dbox__title" style="font-size:16px">Judges With 5 incomplete Evaluation</span></a></td>
					<td><a href="incomplete5_judges.php" style="text-color:white"><span class="dbox__count"><?php echo $count_comp5_j?></span></a></td>
					</tr>
					</tbody>
					</table>
					
					
                <!--<span class="dbox__count"><?php echo $complete_c_d['count']?></span>-->
					
				</div>
						
			</div>
		</div>
		
		<div class="col-md-4">
			<div class="dbox dbox--color-3" style="background: cornflowerblue;margin-block-start: -7px;height:571px">
				
				<div class="dbox__body" style="align:left">
				 <table style="margin-block-start: -43px;">
					<thead>
					<tr>
					<th align="Center"><a href="complete_teams.php" style="text-color:white"><font color="white"><h3>No Of Teams with Completed evaluations:<?php echo $count_comp_t;?></h3></font></a></th>
					</tr>
					</thead>
					<tbody align="center"> 
					<tr>
					<td><a href="incomplete1_teams.php" style="text-color:white"><span class="dbox__title" style="font-size:16px">Teams With 1 incomplete Evaluation</span></a></td>
					<td><a href="incomplete1_teams.php" style="text-color:white"><span class="dbox__count"><?php echo $count_comp1_t?></span></a></td>
					</tr>
					<tr>
					<td><a href="incomplete2_teams.php" style="text-color:white"><span class="dbox__title" style="font-size:16px">Teams With 2 incomplete Evaluation</span></a></td>
					<td><a href="incomplete2_teams.php" style="text-color:white"><span class="dbox__count"><?php echo $count_comp2_t?></span></a></td>
					</tr>
					<tr>
					<td><a href="incomplete3_teams.php" style="text-color:white"><span class="dbox__title" style="font-size:16px">Teams With 3 incomplete Evaluation</span></a></td>
					<td><a href="incomplete3_teams.php" style="text-color:white"><span class="dbox__count"><?php echo $count_comp3_t?></span></a></td>
					</tr>
					<tr>
					<td><a href="incomplete4_teams.php" style="text-color:white"><span class="dbox__title" style="font-size:16px">Teams With 4 incomplete Evaluation</span></a></td>
					<td><a href="incomplete4_teams.php" style="text-color:white"><span class="dbox__count"><?php echo $count_comp4_t?></span></a></td>
					</tr>
					<tr>
					<td><a href="incomplete5_teams.php" style="text-color:white"><span class="dbox__title" style="font-size:16px">Teams With 5 incomplete Evaluation</span></a></td>
					<td><a href="incomplete5_teams.php" style="text-color:white"><span class="dbox__count"><?php echo $count_comp5_t?></span></a></td>
					</tr>
					</tbody>
					</table>
					
					
                <!--<span class="dbox__count"><?php echo $complete_c_d['count']?></span>-->
					
				</div>
				
							
							
			</div>
		</div>
		
		<div class="col-md-4" >
			<div class="dbox dbox--color-3" style="background: cornflowerblue;margin-block-start: -7px;height:571px">
				
				<div class="dbox__body" style="align:left;">
				 <table style="margin-block-start: -43px;">
					<thead>
					<tr>
					<th align="Center"><a href="evaluation_results.php" style="text-color:white"><font color="white"><h3>Current Results:</h3></a></font></th>
					</tr>
					</thead>

					<tbody> 
					<tr>
					<td><a href="results_k2.php" style="text-color:white"><span class="dbox__title" style="font-size:16px">K-2</span></a></td>
					<td><a href="results_k2.php" style="text-color:white"><span class="dbox__title" style="font-size:16px"><?php echo $teams_k?></span></a></td>
					</tr>
					<tr>
					<td><a href="results_35.php" style="text-color:white"><span class="dbox__title" style="font-size:16px">3-5</span></a></td>
					<td><a href="results_35.php" style="text-color:white"><span class="dbox__title" style="font-size:16px"><?php echo $teams_3?></span></a></td>
					</tr>
					<tr>
					<td><a href="results_68.php" style="text-color:white"><span class="dbox__title" style="font-size:16px">6-8</span></a></td>
					<td><a href="results_68.php" style="text-color:white"><span class="dbox__title" style="font-size:16px"><?php echo $teams_6?></span></a></td>
					</tr>
					
					<tr>
					<td><a href="results_912.php" style="text-color:white"><span class="dbox__title" style="font-size:16px">9-12</span></a></td>
					<td><a href="results_912.php" style="text-color:white"><span class="dbox__title" style="font-size:16px"><?php echo $teams_9?></span></a></td>
					
					</tr>
					
					</tbody>
					</table>
					
					
                <!--<span class="dbox__count"><?php echo $complete_c_d['count']?></span>-->
					
				</div>
				
				
				
								
			</div>
		</div>
		
		
		
		
		
	</div>
</div>
</body>
</html>	





























<?php
include('../database/config.php'); 
include('control.php'); 

$id = $_SESSION['id'];
$name = $_SESSION['name'];
$category='';
extract($_POST);
if(isset($_POST['submit']))
{	
$category = $_POST['team_category'];
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Team Lists</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="css/style.css" type="text/css">
</head>

<style>
html, body {
    top:0;
    bottom:0;
    left:0;
    right:0;
    
   
}
</style>
<?php include('../header.php'); ?>
<div id="wrapper">
<body>

    <nav class="navbar navbar-expand bg-dark navbar-dark" style="margin-top:20px;width:100%;">
        <!-- Links -->
        <ul class="navbar-nav">

            <li class="nav-item" style="font-weight: bold;">
                <a class="nav-link" href="home.php">Home</a>
            </li>
			
			
			<!--<li class="nav-item dropdown" style="font-weight: bold;">
                <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                    Add
                </a>
                <div class="dropdown-menu"  id="mainNavbar">
                    <!--<a class="dropdown-item" href="teams.php">Teams</a>
                    <a class="dropdown-item" href="add_judges.php">Judges</a>
                </div>
            </li>-->
			
			
			<li class="nav-item dropdown" style="font-weight: bold;">
                <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                    View
                </a>
                <div class="dropdown-menu"  id="mainNavbar">
                    <a class="dropdown-item" href="users.php">Users</a>
					<a class="dropdown-item" href="teams.php">Teams</a>
                    <a class="dropdown-item" href="judges.php">Judges</a>
                </div>
            </li>
			
			<!--<li class="nav-item dropdown" style="font-weight: bold;">
                <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                    View
                </a>
                <div class="dropdown-menu"  id="mainNavbar">
                    <a class="dropdown-item" href="teams.php">Teams</a>
                    <a class="dropdown-item" href="judges.php">Judges</a>
                </div>
            </li>-->
			
			
			<li class="nav-item dropdown" style="font-weight: bold;">
                <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                    Assign Teams vs Judges
                </a>
                <div class="dropdown-menu"  id="mainNavbar">
                    <a class="dropdown-item" href="assign_judge_team.php">Assign Teams vs Judges</a>
                    <a class="dropdown-item" href="view_judge_team.php">View Assigned Teams vs Judges</a>
                </div>
            </li>
			
			<li class="nav-item" style="font-weight: bold;">
                <a class="nav-link" href="liveqa_teams.php">Live QA</a>
            </li>
			
			
			<li class="nav-item" style="font-weight: bold;">
                <a class="nav-link" href="evaluation_results.php">Evaluation Details</a>
            </li>
			
			 <li class="nav-item dropdown" style="font-weight: bold;">
                <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                    <?php echo $name?>
                </a>
                <div class="dropdown-menu"  id="mainNavbar">
					<a class="dropdown-item" href="profile.php">Profile</a>
                    <a class="dropdown-item" href="logout.php">Logout</a>
                    
                </div>
            </li>

            <!--<li class="nav-item">
                <a class="nav-link" href="addStudent.html">Add Student</a>
            </li>

            <li class="nav-item" id="addAccount">
				<a class="nav-link" href="addUser.html">Add Account</a>
            </li>-->
        </ul>
    </nav>
    <br>
    <div class="container d-flex justify-content-left col-md-12">
        <div class="col-12">
		<input type="text" class="form-control" id="myInput" onkeyup="myFunction()" placeholder="Search for Team names..">
		<br>
            <table class="table" id="myTable" style="margin-block-start: -20px">
                <thead class="thead-dark" id="table">
                    <tr>
						<th scope="col">Team Name</th>
						<th scope="col">Category</th>
                        <th scope="col">Team Members</th>
                        <th> View Details</th>
                    </tr>
                </thead>
				<tbody> 
				
				<?php 
				$q_team = mysqli_query($con,"select distinct tt.id as team_id,tt.project_team_name as project_name,tt.project_description,tt.category,tt.video_pitch, tt.log_book
				from tbl_team tt, tbl_judge_assessment tja where tja.team_id = tt.id and tja.live_qa is not null order by project_team_name");	
				
									
				while ($r_team = mysqli_fetch_assoc($q_team))					
				{
					$youtube_id='';
					$url = $r_team['video_pitch'];
				if(preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $url, $match))
					{
						$youtube_id = $match[1];
					}
					$team_id = $r_team['team_id'];
				$team_m_q = mysqli_query($con, "select GROUP_CONCAT(student_first_name) as members from tbl_team_member where team_id = $team_id");
				$team_m_r = mysqli_fetch_assoc($team_m_q);
				
				?>
											
					<tr> 
						<td><a href="viewteams.php?team_id=<?php echo $r_team['team_id']?>"><?php echo $r_team['project_name']?></a></td> 
						<!--<td><a href="viewteams.php?team_id=<?php echo $r_team['team_id']?>"><?php echo $r_team['project_description']?></a></td> -->
						<td><a href="viewteams.php?team_id=<?php echo $r_team['team_id']?>"><?php echo $r_team['category']?></a></td> 
						<td><?php echo $team_m_r['members']?></td>  
						<td><a href="edit_team_liveqa.php?team_id=<?php echo $team_id?>"><button type="button" style="margin:0px;"  class="btn-success btn-sm"  onclick="edit(this)">Update Details</button></a></td> 
				    </tr> 
				<?php } ?>								
												
											</tbody> 
            </table>
        </div>

    </div>

    <!-- <div class="container d-flex justify-content-center col-md-8">
        <p class="dbtn">
            <button type="button" id="signout-btn" onclick="signOutUser()" class="btn btn-danger"> SignOut </button>
        </p>
    </div> -->
<script>
function myFunction() {
  // Declare variables
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("myInput");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");

  // Loop through all table rows, and hide those who don't match the search query
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[0];
    if (td) {
      txtValue = td.textContent || td.innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }
  }
}
</script>
</body>
<div>
</html>	


live incomplete
<?php
include('../database/config.php'); 
include('control.php'); 

$id = $_SESSION['id'];
$name = $_SESSION['name'];
$category='';
extract($_POST);
if(isset($_POST['submit']))
{	
$category = $_POST['team_category'];
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Team Lists</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="css/style.css" type="text/css">
</head>

<style>
html, body {
    top:0;
    bottom:0;
    left:0;
    right:0;
    
   
}
</style>
<?php include('../header.php'); ?>
<div id="wrapper">
<body>

    <nav class="navbar navbar-expand bg-dark navbar-dark" style="margin-top:20px;width:100%;">
        <!-- Links -->
        <ul class="navbar-nav">

            <li class="nav-item" style="font-weight: bold;">
                <a class="nav-link" href="home.php">Home</a>
            </li>
			
			
			<!--<li class="nav-item dropdown" style="font-weight: bold;">
                <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                    Add
                </a>
                <div class="dropdown-menu"  id="mainNavbar">
                    <!--<a class="dropdown-item" href="teams.php">Teams</a>
                    <a class="dropdown-item" href="add_judges.php">Judges</a>
                </div>
            </li>-->
			
			
			<li class="nav-item dropdown" style="font-weight: bold;">
                <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                    View
                </a>
                <div class="dropdown-menu"  id="mainNavbar">
                    <a class="dropdown-item" href="users.php">Users</a>
					<a class="dropdown-item" href="teams.php">Teams</a>
                    <a class="dropdown-item" href="judges.php">Judges</a>
                </div>
            </li>
			
			<!--<li class="nav-item dropdown" style="font-weight: bold;">
                <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                    View
                </a>
                <div class="dropdown-menu"  id="mainNavbar">
                    <a class="dropdown-item" href="teams.php">Teams</a>
                    <a class="dropdown-item" href="judges.php">Judges</a>
                </div>
            </li>-->
			
			
			<li class="nav-item dropdown" style="font-weight: bold;">
                <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                    Assign Teams vs Judges
                </a>
                <div class="dropdown-menu"  id="mainNavbar">
                    <a class="dropdown-item" href="assign_judge_team.php">Assign Teams vs Judges</a>
                    <a class="dropdown-item" href="view_judge_team.php">View Assigned Teams vs Judges</a>
                </div>
            </li>
			
			<li class="nav-item" style="font-weight: bold;">
                <a class="nav-link" href="liveqa_teams.php">Live QA</a>
            </li>
			
			
			<li class="nav-item" style="font-weight: bold;">
                <a class="nav-link" href="evaluation_results.php">Evaluation Details</a>
            </li>
			
			 <li class="nav-item dropdown" style="font-weight: bold;">
                <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                    <?php echo $name?>
                </a>
                <div class="dropdown-menu"  id="mainNavbar">
					<a class="dropdown-item" href="profile.php">Profile</a>
                    <a class="dropdown-item" href="logout.php">Logout</a>
                    
                </div>
            </li>

            <!--<li class="nav-item">
                <a class="nav-link" href="addStudent.html">Add Student</a>
            </li>

            <li class="nav-item" id="addAccount">
				<a class="nav-link" href="addUser.html">Add Account</a>
            </li>-->
        </ul>
    </nav>
    <br>
    <div class="container d-flex justify-content-left col-md-12">
        <div class="col-12">
		<input type="text" class="form-control" id="myInput" onkeyup="myFunction()" placeholder="Search for Team names..">
		<br>
            <table class="table" id="myTable" style="margin-block-start: -20px">
                <thead class="thead-dark" id="table">
                    <tr>
						<th scope="col">Team Name</th>
						<th scope="col">Category</th>
                        <th scope="col">Team Members</th>
                        <th> View Details</th>
                    </tr>
                </thead>
				<tbody> 
				
				<?php 
				$q_team = mysqli_query($con,"select distinct tt.id as team_id,tt.project_team_name as project_name,tt.project_description,tt.category,tt.video_pitch, tt.log_book
				from tbl_team tt, tbl_judge_assessment tja where tja.team_id = tt.id and tja.live_qa is null order by project_team_name");	
				
									
				while ($r_team = mysqli_fetch_assoc($q_team))					
				{
					$youtube_id='';
					$url = $r_team['video_pitch'];
				if(preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $url, $match))
					{
						$youtube_id = $match[1];
					}
					$team_id = $r_team['team_id'];
				$team_m_q = mysqli_query($con, "select GROUP_CONCAT(student_first_name) as members from tbl_team_member where team_id = $team_id");
				$team_m_r = mysqli_fetch_assoc($team_m_q);
				
				?>
											
					<tr> 
						<td><a href="viewteams.php?team_id=<?php echo $r_team['team_id']?>"><?php echo $r_team['project_name']?></a></td> 
						<!--<td><a href="viewteams.php?team_id=<?php echo $r_team['team_id']?>"><?php echo $r_team['project_description']?></a></td> -->
						<td><a href="viewteams.php?team_id=<?php echo $r_team['team_id']?>"><?php echo $r_team['category']?></a></td> 
						<td><?php echo $team_m_r['members']?></td>  
						<td><a href="edit_team_liveqa.php?team_id=<?php echo $team_id?>"><button type="button" style="margin:0px;"  class="btn-success btn-sm"  onclick="edit(this)">Update Details</button></a></td> 
				    </tr> 
				<?php } ?>								
												
											</tbody> 
            </table>
        </div>

    </div>

    <!-- <div class="container d-flex justify-content-center col-md-8">
        <p class="dbtn">
            <button type="button" id="signout-btn" onclick="signOutUser()" class="btn btn-danger"> SignOut </button>
        </p>
    </div> -->
<script>
function myFunction() {
  // Declare variables
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("myInput");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");

  // Loop through all table rows, and hide those who don't match the search query
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[0];
    if (td) {
      txtValue = td.textContent || td.innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }
  }
}
</script>
</body>
<div>
</html>	
 
community interest
<?php
include('../database/config.php'); 
include('control.php'); 

$id = $_SESSION['id'];
$name = $_SESSION['name'];



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Users Lists</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="css/style.css" type="text/css">
</head>

<style>
html, body {
    top:0;
    bottom:0;
    left:0;
    right:0;
    
   
}
</style>
<?php include('../header.php'); ?>
<div id="wrapper">
<body>
 <nav class="navbar navbar-expand bg-dark navbar-dark" style="margin-top:20px;width:100%;">
        <!-- Links -->
        <ul class="navbar-nav">

            <li class="nav-item" style="font-weight: bold;">
                <a class="nav-link" href="home.php">Home</a>
            </li>
			
			
			<!--<li class="nav-item dropdown" style="font-weight: bold;">
                <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                    Add
                </a>
                <div class="dropdown-menu"  id="mainNavbar">
                    <!--<a class="dropdown-item" href="teams.php">Teams</a>
                    <a class="dropdown-item" href="add_judges.php">Judges</a>
                </div>
            </li>-->
			
			
			<li class="nav-item dropdown" style="font-weight: bold;">
                <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                    View
                </a>
                <div class="dropdown-menu"  id="mainNavbar">
                    <a class="dropdown-item" href="users.php">Users</a>
					<a class="dropdown-item" href="teams.php">Teams</a>
                    <a class="dropdown-item" href="judges.php">Judges</a>
                </div>
            </li>
			
			<!--<li class="nav-item dropdown" style="font-weight: bold;">
                <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                    View
                </a>
                <div class="dropdown-menu"  id="mainNavbar">
                    <a class="dropdown-item" href="teams.php">Teams</a>
                    <a class="dropdown-item" href="judges.php">Judges</a>
                </div>
            </li>-->
			
			
			<li class="nav-item dropdown" style="font-weight: bold;">
                <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                    Assign Teams vs Judges
                </a>
                <div class="dropdown-menu"  id="mainNavbar">
                    <a class="dropdown-item" href="assign_judge_team.php">Assign Teams vs Judges</a>
                    <a class="dropdown-item" href="view_judge_team.php">View Assigned Teams vs Judges</a>
                </div>
            </li>
			
			<li class="nav-item" style="font-weight: bold;">
                <a class="nav-link" href="liveqa_teams.php">Live QA</a>
            </li>
			
			
			<li class="nav-item" style="font-weight: bold;">
                <a class="nav-link" href="evaluation_results.php">Evaluation Details</a>
            </li>
			
			 <li class="nav-item dropdown" style="font-weight: bold;">
                <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                    <?php echo $name?>
                </a>
                <div class="dropdown-menu"  id="mainNavbar">
					<a class="dropdown-item" href="profile.php">Profile</a>
                    <a class="dropdown-item" href="logout.php">Logout</a>
                    
                </div>
            </li>

            <!--<li class="nav-item">
                <a class="nav-link" href="addStudent.html">Add Student</a>
            </li>

            <li class="nav-item" id="addAccount">
				<a class="nav-link" href="addUser.html">Add Account</a>
            </li>-->
        </ul>
    </nav>
    <br>
    <div class="container d-flex justify-content-left col-md-12">
        <div class="col-12">
		<input type="text" class="form-control" id="myInput" onkeyup="myFunction()" placeholder="Search for first name..">
            <table class="table" id="myTable" style="margin-block-start: 8px">
                <thead class="thead-dark" id="table">
                    <tr>
						<th scope="col">First Name</th>
						<th scope="col">Last Name</th>
						<th scope="col">Category</th>
						<th scope="col">Confirm Judge</th>
						<th scope="col">Interested</th>
                        <th> View Details</th>
                    </tr>
                </thead>
				<tbody> 
				
				<?php 
				$q_team = mysqli_query($con,"select distinct id,first_name, last_name, category,judge_confirm,interested from tbl_user  order by first_name asc");	
									
				while ($r_team = mysqli_fetch_assoc($q_team))					
				{
				
				?>
											
					<tr> 
						<td><?php echo $r_team['first_name']?></td> 
						<td><?php echo $r_team['last_name']?></a></td> 
						<td><?php echo $r_team['category']?></a></td> 
						<td><?php echo $r_team['judge_confirm']?></a></td> 
								<td><?php echo $r_team['interested']?></a></td> 
						<td><a href="JudgeDetails.php?id=<?php echo $r_team['id']?>"><button type="button" style="margin:0px;"  class="btn-success btn-sm"  onclick="edit(this)">View Details</button></a></td> 
				    </tr> 
				<?php } ?>								
												
											</tbody> 
            </table>
        </div>

    </div>

    <!-- <div class="container d-flex justify-content-center col-md-8">
        <p class="dbtn">
            <button type="button" id="signout-btn" onclick="signOutUser()" class="btn btn-danger"> SignOut </button>
        </p>
    </div> -->
<script>
function myFunction() {
  // Declare variables
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("myInput");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");

  // Loop through all table rows, and hide those who don't match the search query
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[0];
    if (td) {
      txtValue = td.textContent || td.innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }
	
  }
}
</script>
</body>
<div>
</html>	


teams.php 
<?php
include('../database/config.php'); 
include('control.php'); 

$id = $_SESSION['id'];
$name = $_SESSION['name'];
$category='';
extract($_POST);
if(isset($_POST['submit']))
{	
$category = $_POST['team_category'];
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Team Lists</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="css/style.css" type="text/css">
</head>

<style>
html, body {
    top:0;
    bottom:0;
    left:0;
    right:0;
    
   
}
</style>
<div id="wrapper">
<body>

    <div class="jumbotron col-md-12" style="font-size: 16px;
    height: 10em;margin-block-start: -55px;">
       <img class="card-img-top" src="images/emulogo.png" alt="logo image" style="width:99%;height: 226px;">
    </div>

	<nav class="navbar navbar-expand bg-dark navbar-dark" style="    margin-top: 140px;
    width: 1289px;
    left: 2.3%;">
        <!-- Links -->
        <ul class="navbar-nav">

            <li class="nav-item" style="font-weight: bold;">
                <a class="nav-link" href="home.php">Home</a>
            </li>
			
			
			<li class="nav-item dropdown" style="font-weight: bold;">
                <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                    Add
                </a>
                <div class="dropdown-menu"  id="mainNavbar">
                    <!--<a class="dropdown-item" href="teams.php">Teams</a>-->
                    <a class="dropdown-item" href="add_judges.php">Judges</a>
                </div>
            </li>
			
			
			<li class="nav-item dropdown" style="font-weight: bold;">
                <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                    View
                </a>
                <div class="dropdown-menu"  id="mainNavbar">
                    <a class="dropdown-item" href="teams.php">Teams</a>
                    <a class="dropdown-item" href="judges.php">Judges</a>
                </div>
            </li>
			
			
			<li class="nav-item dropdown" style="font-weight: bold;">
                <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                    Assign Teams vs Judges
                </a>
                <div class="dropdown-menu"  id="mainNavbar">
                    <a class="dropdown-item" href="assign_judge_team.php">Assign Teams vs Judges</a>
                    <a class="dropdown-item" href="view_judge_team.php">View Assigned Teams vs Judges</a>
                </div>
            </li>
			
			<li class="nav-item" style="font-weight: bold;">
                <a class="nav-link" href="evaluation_results.php">Evaluation Details</a>
            </li>
			
			 <li class="nav-item dropdown" style="font-weight: bold;">
                <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                    <?php echo $name?>
                </a>
                <div class="dropdown-menu"  id="mainNavbar">
					<a class="dropdown-item" href="profile.php">Profile</a>
                    <a class="dropdown-item" href="logout.php">Logout</a>
                    
                </div>
            </li>

            <!--<li class="nav-item">
                <a class="nav-link" href="addStudent.html">Add Student</a>
            </li>

            <li class="nav-item" id="addAccount">
				<a class="nav-link" href="addUser.html">Add Account</a>
            </li>-->
        </ul>
    </nav>
    <br>
    <div class="container d-flex justify-content-left col-md-12">
        <div class="col-12">
		<input type="text" class="form-control" id="myInput" onkeyup="myFunction()" placeholder="Search for Team names..">
		<br>
            <table class="table" id="myTable" style="margin-block-start: -20px">
                <thead class="thead-dark" id="table">
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
				<tbody> 
				
				<?php 
				if($category!=='')
				{
				$q_team = mysqli_query($con,"select distinct tt.id as team_id,tt.project_team_name as project_name,tt.project_description,tt.category,tt.video_pitch, tt.log_book
				from tbl_team tt where category = '$category'");	
				}
				else
				{
					$q_team = mysqli_query($con,"select distinct tt.id as team_id,tt.project_team_name as project_name,tt.project_description,tt.category,tt.video_pitch, tt.log_book
				from tbl_team tt");	
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
				$team_m_q = mysqli_query($con, "select GROUP_CONCAT(student_first_name) as members from tbl_team_member where team_id = $team_id");
				$team_m_r = mysqli_fetch_assoc($team_m_q);
				
				?>
											
					<tr> 
						<td><a href="viewteams.php?team_id=<?php echo $r_team['team_id']?>"><?php echo $r_team['project_name']?></a></td> 
						<td><a href="viewteams.php?team_id=<?php echo $r_team['team_id']?>"><?php echo $r_team['project_description']?></a></td> 
						<td><a href="viewteams.php?team_id=<?php echo $r_team['team_id']?>"><?php echo $r_team['category']?></a></td> 
						<?php if ($r_team['video_pitch']!='') {
							if ($youtube_id!='') { ?>
						<td><a href ="<?php echo $r_team['video_pitch']?>" target="_blank">Video Pitch</a></td> 
							<?php } else {?>
							<td><a href ="http://grading.emuem.org/Team/<?php echo $r_team['video_pitch']?>" target="_blank">Video Pitch</a></td> 
							<?php } ?>
							<?php } else {?>
							<td>Video Pitch</td> 
							<?php } if ($r_team['log_book']!='') {?>
									<td><a href="http://grading.emuem.org/Team/<?php echo $r_team['log_book']?>" target="_blank">LogBook</a></td>  
							<?php } else {?>
									<td>LogBook</td>  
							<?php }?>
						<td><?php echo $team_m_r['members']?></td>  
						<td><a href="edit_team.php?team_id=<?php echo $team_id?>"><button type="button" style="margin:0px;"  class="btn-success btn-sm"  onclick="edit(this)">Update Details</button></a></td> 
				    </tr> 
				<?php } ?>								
												
											</tbody> 
            </table>
        </div>

    </div>

    <!-- <div class="container d-flex justify-content-center col-md-8">
        <p class="dbtn">
            <button type="button" id="signout-btn" onclick="signOutUser()" class="btn btn-danger"> SignOut </button>
        </p>
    </div> -->
<script>
function myFunction() {
  // Declare variables
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("myInput");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");

  // Loop through all table rows, and hide those who don't match the search query
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[0];
    if (td) {
      txtValue = td.textContent || td.innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }
  }
}
</script>
</body>
<div>
</html>	


teams complete 
<?php
include('../database/config.php'); 
include('control.php'); 

$id = $_SESSION['id'];
$name = $_SESSION['name'];
$category='';
extract($_POST);
if(isset($_POST['submit']))
{	
$category = $_POST['team_category'];
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Team Lists</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="css/style.css" type="text/css">
</head>

<style>
html, body {
    top:0;
    bottom:0;
    left:0;
    right:0;
    
   
}
</style>
<?php include('../header.php'); ?>
<div id="wrapper">
<body>

    <nav class="navbar navbar-expand bg-dark navbar-dark" style="margin-top:20px;width:100%;">
        <!-- Links -->
        <ul class="navbar-nav">

            <li class="nav-item" style="font-weight: bold;">
                <a class="nav-link" href="home.php">Home</a>
            </li>
			
			
			<!--<li class="nav-item dropdown" style="font-weight: bold;">
                <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                    Add
                </a>
                <div class="dropdown-menu"  id="mainNavbar">
                    <!--<a class="dropdown-item" href="teams.php">Teams</a>
                    <a class="dropdown-item" href="add_judges.php">Judges</a>
                </div>
            </li>-->
			
			
			<li class="nav-item dropdown" style="font-weight: bold;">
                <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                    View
                </a>
                <div class="dropdown-menu"  id="mainNavbar">
                    <a class="dropdown-item" href="users.php">Users</a>
					<a class="dropdown-item" href="teams.php">Teams</a>
                    <a class="dropdown-item" href="judges.php">Judges</a>
                </div>
            </li>
			
			<!--<li class="nav-item dropdown" style="font-weight: bold;">
                <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                    View
                </a>
                <div class="dropdown-menu"  id="mainNavbar">
                    <a class="dropdown-item" href="teams.php">Teams</a>
                    <a class="dropdown-item" href="judges.php">Judges</a>
                </div>
            </li>-->
			
			
			<li class="nav-item dropdown" style="font-weight: bold;">
                <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                    Assign Teams vs Judges
                </a>
                <div class="dropdown-menu"  id="mainNavbar">
                    <a class="dropdown-item" href="assign_judge_team.php">Assign Teams vs Judges</a>
                    <a class="dropdown-item" href="view_judge_team.php">View Assigned Teams vs Judges</a>
                </div>
            </li>
			
			<li class="nav-item" style="font-weight: bold;">
                <a class="nav-link" href="liveqa_teams.php">Live QA</a>
            </li>
			
			
			<li class="nav-item" style="font-weight: bold;">
                <a class="nav-link" href="evaluation_results.php">Evaluation Details</a>
            </li>
			
			 <li class="nav-item dropdown" style="font-weight: bold;">
                <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                    <?php echo $name?>
                </a>
                <div class="dropdown-menu"  id="mainNavbar">
					<a class="dropdown-item" href="profile.php">Profile</a>
                    <a class="dropdown-item" href="logout.php">Logout</a>
                    
                </div>
            </li>

            <!--<li class="nav-item">
                <a class="nav-link" href="addStudent.html">Add Student</a>
            </li>

            <li class="nav-item" id="addAccount">
				<a class="nav-link" href="addUser.html">Add Account</a>
            </li>-->
        </ul>
    </nav>
    <br>
    <div class="container d-flex justify-content-left col-md-12">
        <div class="col-12">
		<input type="text" class="form-control" id="myInput" onkeyup="myFunction()" placeholder="Search for Team names..">
		<br>
            <table class="table" id="myTable" style="margin-block-start: -20px">
                <thead class="thead-dark" id="table">
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
				<tbody> 
				
				<?php 
				if($category!=='')
				{
				$q_team = mysqli_query($con,"select distinct tt.id as team_id,tt.project_team_name as project_name,tt.project_description,tt.category,tt.video_pitch, tt.log_book
				from tbl_team tt where category = '$category' and log_book is not null and video_pitch is not null");	
				}
				else
				{
					$q_team = mysqli_query($con,"select distinct tt.id as team_id,tt.project_team_name as project_name,tt.project_description,tt.category,tt.video_pitch, tt.log_book
				from tbl_team tt where (video_pitch is not null and log_book!='')");	
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
				$team_m_q = mysqli_query($con, "select GROUP_CONCAT(student_first_name) as members from tbl_team_member where team_id = $team_id");
				$team_m_r = mysqli_fetch_assoc($team_m_q);
				
				?>
											
					<tr> 
						<td><a href="viewteams.php?team_id=<?php echo $r_team['team_id']?>"><?php echo $r_team['project_name']?></a></td> 
						<td><a href="viewteams.php?team_id=<?php echo $r_team['team_id']?>"><?php echo $r_team['project_description']?></a></td> 
						<td><a href="viewteams.php?team_id=<?php echo $r_team['team_id']?>"><?php echo $r_team['category']?></a></td> 
						<?php if ($r_team['video_pitch']!='') {
							if ($youtube_id!='') { ?>
						<td><a href ="<?php echo $r_team['video_pitch']?>" target="_blank">Video Pitch</a></td> 
							<?php } else {?>
							<td><a href ="http://grading.emuem.org/Team/<?php echo $r_team['video_pitch']?>" target="_blank">Video Pitch</a></td> 
							<?php } ?>
							<?php } else {?>
							<td>Video Pitch</td> 
							<?php } if ($r_team['log_book']!='') {?>
									<td><a href="http://grading.emuem.org/Team/<?php echo $r_team['log_book']?>" target="_blank">LogBook</a></td>  
							<?php } else {?>
									<td>LogBook</td>  
							<?php }?>
						<td><?php echo $team_m_r['members']?></td>  
						<td><a href="edit_team.php?team_id=<?php echo $team_id?>"><button type="button" style="margin:0px;"  class="btn-success btn-sm"  onclick="edit(this)">Update Details</button></a></td> 
				    </tr> 
				<?php } ?>								
												
											</tbody> 
            </table>
        </div>

    </div>

    <!-- <div class="container d-flex justify-content-center col-md-8">
        <p class="dbtn">
            <button type="button" id="signout-btn" onclick="signOutUser()" class="btn btn-danger"> SignOut </button>
        </p>
    </div> -->
<script>
function myFunction() {
  // Declare variables
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("myInput");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");

  // Loop through all table rows, and hide those who don't match the search query
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[0];
    if (td) {
      txtValue = td.textContent || td.innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }
  }
}
</script>
</body>
<div>
</html>	

teamincomplete_logbook 
<?php
include('../database/config.php'); 
include('control.php'); 

$id = $_SESSION['id'];
$name = $_SESSION['name'];
$category='';
extract($_POST);
if(isset($_POST['submit']))
{	
$category = $_POST['team_category'];
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Team Lists</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="css/style.css" type="text/css">
</head>

<style>
html, body {
    top:0;
    bottom:0;
    left:0;
    right:0;
    
   
}
</style>
<?php include('../header.php'); ?>
<div id="wrapper">
<body>

    <nav class="navbar navbar-expand bg-dark navbar-dark" style="margin-top:20px;width:100%;">
        <!-- Links -->
        <ul class="navbar-nav">

            <li class="nav-item" style="font-weight: bold;">
                <a class="nav-link" href="home.php">Home</a>
            </li>
			
			
			<!--<li class="nav-item dropdown" style="font-weight: bold;">
                <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                    Add
                </a>
                <div class="dropdown-menu"  id="mainNavbar">
                    <!--<a class="dropdown-item" href="teams.php">Teams</a>
                    <a class="dropdown-item" href="add_judges.php">Judges</a>
                </div>
            </li>-->
			
			
			<li class="nav-item dropdown" style="font-weight: bold;">
                <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                    View
                </a>
                <div class="dropdown-menu"  id="mainNavbar">
                    <a class="dropdown-item" href="users.php">Users</a>
					<a class="dropdown-item" href="teams.php">Teams</a>
                    <a class="dropdown-item" href="judges.php">Judges</a>
                </div>
            </li>
			
			<!--<li class="nav-item dropdown" style="font-weight: bold;">
                <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                    View
                </a>
                <div class="dropdown-menu"  id="mainNavbar">
                    <a class="dropdown-item" href="teams.php">Teams</a>
                    <a class="dropdown-item" href="judges.php">Judges</a>
                </div>
            </li>-->
			
			
			<li class="nav-item dropdown" style="font-weight: bold;">
                <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                    Assign Teams vs Judges
                </a>
                <div class="dropdown-menu"  id="mainNavbar">
                    <a class="dropdown-item" href="assign_judge_team.php">Assign Teams vs Judges</a>
                    <a class="dropdown-item" href="view_judge_team.php">View Assigned Teams vs Judges</a>
                </div>
            </li>
			
			<li class="nav-item" style="font-weight: bold;">
                <a class="nav-link" href="liveqa_teams.php">Live QA</a>
            </li>
			
			
			<li class="nav-item" style="font-weight: bold;">
                <a class="nav-link" href="evaluation_results.php">Evaluation Details</a>
            </li>
			
			 <li class="nav-item dropdown" style="font-weight: bold;">
                <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                    <?php echo $name?>
                </a>
                <div class="dropdown-menu"  id="mainNavbar">
					<a class="dropdown-item" href="profile.php">Profile</a>
                    <a class="dropdown-item" href="logout.php">Logout</a>
                    
                </div>
            </li>

            <!--<li class="nav-item">
                <a class="nav-link" href="addStudent.html">Add Student</a>
            </li>

            <li class="nav-item" id="addAccount">
				<a class="nav-link" href="addUser.html">Add Account</a>
            </li>-->
        </ul>
    </nav>
    <br>
    <div class="container d-flex justify-content-left col-md-12">
        <div class="col-12">
		<input type="text" class="form-control" id="myInput" onkeyup="myFunction()" placeholder="Search for Team names..">
		<br>
            <table class="table" id="myTable" style="margin-block-start: -20px">
                <thead class="thead-dark" id="table">
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
				<tbody> 
				
				<?php 
				if($category!=='')
				{
				$q_team = mysqli_query($con,"select distinct tt.id as team_id,tt.project_team_name as project_name,tt.project_description,tt.category,tt.video_pitch, tt.log_book
				from tbl_team tt where category = '$category' and log_book is null");	
				}
				else
				{
					$q_team = mysqli_query($con,"select distinct tt.id as team_id,tt.project_team_name as project_name,tt.project_description,tt.category,tt.video_pitch, tt.log_book
				from tbl_team tt where log_book is null");	
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
				$team_m_q = mysqli_query($con, "select GROUP_CONCAT(student_first_name) as members from tbl_team_member where team_id = $team_id");
				$team_m_r = mysqli_fetch_assoc($team_m_q);
				
				?>
											
					<tr> 
						<td><a href="viewteams.php?team_id=<?php echo $r_team['team_id']?>"><?php echo $r_team['project_name']?></a></td> 
						<td><a href="viewteams.php?team_id=<?php echo $r_team['team_id']?>"><?php echo $r_team['project_description']?></a></td> 
						<td><a href="viewteams.php?team_id=<?php echo $r_team['team_id']?>"><?php echo $r_team['category']?></a></td> 
						<?php if ($r_team['video_pitch']!='') {
							if ($youtube_id!='') { ?>
						<td><a href ="<?php echo $r_team['video_pitch']?>" target="_blank">Video Pitch</a></td> 
							<?php } else {?>
							<td><a href ="http://grading.emuem.org/Team/<?php echo $r_team['video_pitch']?>" target="_blank">Video Pitch</a></td> 
							<?php } ?>
							<?php } else {?>
							<td>Video Pitch</td> 
							<?php } if ($r_team['log_book']!='') {?>
									<td><a href="http://grading.emuem.org/Team/<?php echo $r_team['log_book']?>" target="_blank">LogBook</a></td>  
							<?php } else {?>
									<td>LogBook</td>  
							<?php }?>
						<td><?php echo $team_m_r['members']?></td>  
						<td><a href="edit_team.php?team_id=<?php echo $team_id?>"><button type="button" style="margin:0px;"  class="btn-success btn-sm"  onclick="edit(this)">Update Details</button></a></td> 
				    </tr> 
				<?php } ?>								
												
											</tbody> 
            </table>
        </div>

    </div>

    <!-- <div class="container d-flex justify-content-center col-md-8">
        <p class="dbtn">
            <button type="button" id="signout-btn" onclick="signOutUser()" class="btn btn-danger"> SignOut </button>
        </p>
    </div> -->
<script>
function myFunction() {
  // Declare variables
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("myInput");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");

  // Loop through all table rows, and hide those who don't match the search query
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[0];
    if (td) {
      txtValue = td.textContent || td.innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }
  }
}
</script>
</body>
<div>
</html>	

teams_incomplete_videopitch.php
<?php
include('../database/config.php'); 
include('control.php'); 

$id = $_SESSION['id'];
$name = $_SESSION['name'];
$category='';
extract($_POST);
if(isset($_POST['submit']))
{	
$category = $_POST['team_category'];
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Team Lists</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="css/style.css" type="text/css">
</head>

<style>
html, body {
    top:0;
    bottom:0;
    left:0;
    right:0;
    
   
}
</style>
<?php include('../header.php'); ?>
<div id="wrapper">
<body>

    <nav class="navbar navbar-expand bg-dark navbar-dark" style="margin-top:20px;width:100%;">
        <!-- Links -->
        <ul class="navbar-nav">

            <li class="nav-item" style="font-weight: bold;">
                <a class="nav-link" href="home.php">Home</a>
            </li>
			
			
			<!--<li class="nav-item dropdown" style="font-weight: bold;">
                <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                    Add
                </a>
                <div class="dropdown-menu"  id="mainNavbar">
                    <!--<a class="dropdown-item" href="teams.php">Teams</a>
                    <a class="dropdown-item" href="add_judges.php">Judges</a>
                </div>
            </li>-->
			
			
			<li class="nav-item dropdown" style="font-weight: bold;">
                <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                    View
                </a>
                <div class="dropdown-menu"  id="mainNavbar">
                    <a class="dropdown-item" href="users.php">Users</a>
					<a class="dropdown-item" href="teams.php">Teams</a>
                    <a class="dropdown-item" href="judges.php">Judges</a>
                </div>
            </li>
			
			<!--<li class="nav-item dropdown" style="font-weight: bold;">
                <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                    View
                </a>
                <div class="dropdown-menu"  id="mainNavbar">
                    <a class="dropdown-item" href="teams.php">Teams</a>
                    <a class="dropdown-item" href="judges.php">Judges</a>
                </div>
            </li>-->
			
			
			<li class="nav-item dropdown" style="font-weight: bold;">
                <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                    Assign Teams vs Judges
                </a>
                <div class="dropdown-menu"  id="mainNavbar">
                    <a class="dropdown-item" href="assign_judge_team.php">Assign Teams vs Judges</a>
                    <a class="dropdown-item" href="view_judge_team.php">View Assigned Teams vs Judges</a>
                </div>
            </li>
			
			<li class="nav-item" style="font-weight: bold;">
                <a class="nav-link" href="liveqa_teams.php">Live QA</a>
            </li>
			
			
			<li class="nav-item" style="font-weight: bold;">
                <a class="nav-link" href="evaluation_results.php">Evaluation Details</a>
            </li>
			
			 <li class="nav-item dropdown" style="font-weight: bold;">
                <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                    <?php echo $name?>
                </a>
                <div class="dropdown-menu"  id="mainNavbar">
					<a class="dropdown-item" href="profile.php">Profile</a>
                    <a class="dropdown-item" href="logout.php">Logout</a>
                    
                </div>
            </li>

            <!--<li class="nav-item">
                <a class="nav-link" href="addStudent.html">Add Student</a>
            </li>

            <li class="nav-item" id="addAccount">
				<a class="nav-link" href="addUser.html">Add Account</a>
            </li>-->
        </ul>
    </nav>
    <br>
    <div class="container d-flex justify-content-left col-md-12">
        <div class="col-12">
		<input type="text" class="form-control" id="myInput" onkeyup="myFunction()" placeholder="Search for Team names..">
		<br>
            <table class="table" id="myTable" style="margin-block-start: -20px">
                <thead class="thead-dark" id="table">
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
				<tbody> 
				
				<?php 
				if($category!=='')
				{
				$q_team = mysqli_query($con,"select distinct tt.id as team_id,tt.project_team_name as project_name,tt.project_description,tt.category,tt.video_pitch, tt.log_book
				from tbl_team tt where category = '$category' and video_pitch is null");	
				}
				else
				{
					$q_team = mysqli_query($con,"select distinct tt.id as team_id,tt.project_team_name as project_name,tt.project_description,tt.category,tt.video_pitch, tt.log_book
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
				$team_m_q = mysqli_query($con, "select GROUP_CONCAT(student_first_name) as members from tbl_team_member where team_id = $team_id");
				$team_m_r = mysqli_fetch_assoc($team_m_q);
				
				?>
											
					<tr> 
						<td><a href="viewteams.php?team_id=<?php echo $r_team['team_id']?>"><?php echo $r_team['project_name']?></a></td> 
						<td><a href="viewteams.php?team_id=<?php echo $r_team['team_id']?>"><?php echo $r_team['project_description']?></a></td> 
						<td><a href="viewteams.php?team_id=<?php echo $r_team['team_id']?>"><?php echo $r_team['category']?></a></td> 
						<?php if ($r_team['video_pitch']!='') {
							if ($youtube_id!='') { ?>
						<td><a href ="<?php echo $r_team['video_pitch']?>" target="_blank">Video Pitch</a></td> 
							<?php } else {?>
							<td><a href ="http://grading.emuem.org/Team/<?php echo $r_team['video_pitch']?>" target="_blank">Video Pitch</a></td> 
							<?php } ?>
							<?php } else {?>
							<td>Video Pitch</td> 
							<?php } if ($r_team['log_book']!='') {?>
									<td><a href="http://grading.emuem.org/Team/<?php echo $r_team['log_book']?>" target="_blank">LogBook</a></td>  
							<?php } else {?>
									<td>LogBook</td>  
							<?php }?>
						<td><?php echo $team_m_r['members']?></td>  
						<td><a href="edit_team.php?team_id=<?php echo $team_id?>"><button type="button" style="margin:0px;"  class="btn-success btn-sm"  onclick="edit(this)">Update Details</button></a></td> 
				    </tr> 
				<?php } ?>								
												
											</tbody> 
            </table>
        </div>

    </div>

    <!-- <div class="container d-flex justify-content-center col-md-8">
        <p class="dbtn">
            <button type="button" id="signout-btn" onclick="signOutUser()" class="btn btn-danger"> SignOut </button>
        </p>
    </div> -->
<script>
function myFunction() {
  // Declare variables
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("myInput");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");

  // Loop through all table rows, and hide those who don't match the search query
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[0];
    if (td) {
      txtValue = td.textContent || td.innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }
  }
}
</script>
</body>
<div>
</html>	

judges.php 
<?php
include('../database/config.php'); 
include('control.php'); 

$id = $_SESSION['id'];
$name = $_SESSION['name'];



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Judges Lists</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="css/style.css" type="text/css">
</head>

<style>
html, body {
    top:0;
    bottom:0;
    left:0;
    right:0;
    
   
}
</style>
 <?php include('../header.php'); ?>
<div id="wrapper">
<body>
<nav class="navbar navbar-expand bg-dark navbar-dark" style="margin-top:20px;width:100%;">
        <!-- Links -->
        <ul class="navbar-nav">

            <li class="nav-item" style="font-weight: bold;">
                <a class="nav-link" href="home.php">Home</a>
            </li>
			
			
			<!--<li class="nav-item dropdown" style="font-weight: bold;">
                <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                    Add
                </a>
                <div class="dropdown-menu"  id="mainNavbar">
                    <!--<a class="dropdown-item" href="teams.php">Teams</a>
                    <a class="dropdown-item" href="add_judges.php">Judges</a>
                </div>
            </li>-->
			
			
			<li class="nav-item dropdown" style="font-weight: bold;">
                <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                    View
                </a>
                <div class="dropdown-menu"  id="mainNavbar">
                    <a class="dropdown-item" href="users.php">Users</a>
					<a class="dropdown-item" href="teams.php">Teams</a>
                    <a class="dropdown-item" href="judges.php">Judges</a>
                </div>
            </li>
			
			<!--<li class="nav-item dropdown" style="font-weight: bold;">
                <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                    View
                </a>
                <div class="dropdown-menu"  id="mainNavbar">
                    <a class="dropdown-item" href="teams.php">Teams</a>
                    <a class="dropdown-item" href="judges.php">Judges</a>
                </div>
            </li>-->
			
			
			<li class="nav-item dropdown" style="font-weight: bold;">
                <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                    Assign Teams vs Judges
                </a>
                <div class="dropdown-menu"  id="mainNavbar">
                    <a class="dropdown-item" href="assign_judge_team.php">Assign Teams vs Judges</a>
                    <a class="dropdown-item" href="view_judge_team.php">View Assigned Teams vs Judges</a>
                </div>
            </li>
			
			<li class="nav-item" style="font-weight: bold;">
                <a class="nav-link" href="liveqa_teams.php">Live QA</a>
            </li>
			
			
			<li class="nav-item" style="font-weight: bold;">
                <a class="nav-link" href="evaluation_results.php">Evaluation Details</a>
            </li>
			
			 <li class="nav-item dropdown" style="font-weight: bold;">
                <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                    <?php echo $name?>
                </a>
                <div class="dropdown-menu"  id="mainNavbar">
					<a class="dropdown-item" href="profile.php">Profile</a>
                    <a class="dropdown-item" href="logout.php">Logout</a>
                    
                </div>
            </li>

            <!--<li class="nav-item">
                <a class="nav-link" href="addStudent.html">Add Student</a>
            </li>

            <li class="nav-item" id="addAccount">
				<a class="nav-link" href="addUser.html">Add Account</a>
            </li>-->
        </ul>
    </nav>
    <br>
    <div class="container d-flex justify-content-left col-md-12">
        <div class="col-12">
		<input type="text" class="form-control" id="myInput" onkeyup="myFunction()" placeholder="Search for judge first name..">
            <table class="table" id="myTable" style="margin-block-start: 8px">
                <thead class="thead-dark" id="table">
                    <tr>
						<th scope="col">Judge First Name</th>
						<th scope="col">Judge Last Name</th>
						<th scope="col">Category</th>
						<th scope="col">Confirm Judge</th>
                        <th> View Details</th>
                    </tr>
                </thead>
				<tbody> 
				
				<?php 
				$q_team = mysqli_query($con,"select distinct id,first_name, last_name, category,judge_confirm from tbl_user where user_type='Judge' order by judge_confirm desc,first_name asc");	
									
				while ($r_team = mysqli_fetch_assoc($q_team))					
				{
				
				?>
											
					<tr> 
						<td><?php echo $r_team['first_name']?></td> 
						<td><?php echo $r_team['last_name']?></a></td> 
						<td><?php echo $r_team['category']?></a></td> 
						<td><?php echo $r_team['judge_confirm']?></a></td> 
						<td><a href="JudgeDetails.php?id=<?php echo $r_team['id']?>"><button type="button" style="margin:0px;"  class="btn-success btn-sm"  onclick="edit(this)">View Details</button></a></td> 
				    </tr> 
				<?php } ?>								
												
											</tbody> 
            </table>
        </div>

    </div>

    <!-- <div class="container d-flex justify-content-center col-md-8">
        <p class="dbtn">
            <button type="button" id="signout-btn" onclick="signOutUser()" class="btn btn-danger"> SignOut </button>
        </p>
    </div> -->
<script>
function myFunction() {
  // Declare variables
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("myInput");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");

  // Loop through all table rows, and hide those who don't match the search query
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[0];
    if (td) {
      txtValue = td.textContent || td.innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }
	
  }
}
</script>
</body>
<div>
</html>	


confirm_judges.php 
<?php
include('../database/config.php'); 
include('control.php'); 

$id = $_SESSION['id'];
$name = $_SESSION['name'];



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Judges Lists</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="css/style.css" type="text/css">
</head>

<style>
html, body {
    top:0;
    bottom:0;
    left:0;
    right:0;
    
   
}
</style>
<?php include('../header.php'); ?>
<div id="wrapper">
<body>
<nav class="navbar navbar-expand bg-dark navbar-dark" style="margin-top:20px;width:100%;">
        <!-- Links -->
        <ul class="navbar-nav">

            <li class="nav-item" style="font-weight: bold;">
                <a class="nav-link" href="home.php">Home</a>
            </li>
			
			
			<!--<li class="nav-item dropdown" style="font-weight: bold;">
                <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                    Add
                </a>
                <div class="dropdown-menu"  id="mainNavbar">
                    <!--<a class="dropdown-item" href="teams.php">Teams</a>
                    <a class="dropdown-item" href="add_judges.php">Judges</a>
                </div>
            </li>-->
			
			
			<li class="nav-item dropdown" style="font-weight: bold;">
                <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                    View
                </a>
                <div class="dropdown-menu"  id="mainNavbar">
                    <a class="dropdown-item" href="users.php">Users</a>
					<a class="dropdown-item" href="teams.php">Teams</a>
                    <a class="dropdown-item" href="judges.php">Judges</a>
                </div>
            </li>
			
			<!--<li class="nav-item dropdown" style="font-weight: bold;">
                <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                    View
                </a>
                <div class="dropdown-menu"  id="mainNavbar">
                    <a class="dropdown-item" href="teams.php">Teams</a>
                    <a class="dropdown-item" href="judges.php">Judges</a>
                </div>
            </li>-->
			
			
			<li class="nav-item dropdown" style="font-weight: bold;">
                <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                    Assign Teams vs Judges
                </a>
                <div class="dropdown-menu"  id="mainNavbar">
                    <a class="dropdown-item" href="assign_judge_team.php">Assign Teams vs Judges</a>
                    <a class="dropdown-item" href="view_judge_team.php">View Assigned Teams vs Judges</a>
                </div>
            </li>
			
			<li class="nav-item" style="font-weight: bold;">
                <a class="nav-link" href="liveqa_teams.php">Live QA</a>
            </li>
			
			
			<li class="nav-item" style="font-weight: bold;">
                <a class="nav-link" href="evaluation_results.php">Evaluation Details</a>
            </li>
			
			 <li class="nav-item dropdown" style="font-weight: bold;">
                <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                    <?php echo $name?>
                </a>
                <div class="dropdown-menu"  id="mainNavbar">
					<a class="dropdown-item" href="profile.php">Profile</a>
                    <a class="dropdown-item" href="logout.php">Logout</a>
                    
                </div>
            </li>

            <!--<li class="nav-item">
                <a class="nav-link" href="addStudent.html">Add Student</a>
            </li>

            <li class="nav-item" id="addAccount">
				<a class="nav-link" href="addUser.html">Add Account</a>
            </li>-->
        </ul>
    </nav>
    <br>
    <div class="container d-flex justify-content-left col-md-12">
        <div class="col-12">
		<input type="text" class="form-control" id="myInput" onkeyup="myFunction()" placeholder="Search for judge first name..">
            <table class="table" id="myTable" style="margin-block-start: 8px">
                <thead class="thead-dark" id="table">
                    <tr>
						<th scope="col">Judge First Name</th>
						<th scope="col">Judge Last Name</th>
						<th scope="col">Category</th>
						<th scope="col">Confirm Judge</th>
                        <th> View Details</th>
                    </tr>
                </thead>
				<tbody> 
				
				<?php 
				$q_team = mysqli_query($con,"select distinct id,first_name, last_name, category,judge_confirm from tbl_user where user_type='Judge' and judge_confirm = 'Y' order by judge_confirm desc,first_name asc");	
									
				while ($r_team = mysqli_fetch_assoc($q_team))					
				{
				
				?>
											
					<tr> 
						<td><?php echo $r_team['first_name']?></td> 
						<td><?php echo $r_team['last_name']?></a></td> 
						<td><?php echo $r_team['category']?></a></td> 
						<td><?php echo $r_team['judge_confirm']?></a></td> 
						<td><a href="JudgeDetails.php?id=<?php echo $r_team['id']?>"><button type="button" style="margin:0px;"  class="btn-success btn-sm"  onclick="edit(this)">View Details</button></a></td> 
				    </tr> 
				<?php } ?>								
												
											</tbody> 
            </table>
        </div>

    </div>

    <!-- <div class="container d-flex justify-content-center col-md-8">
        <p class="dbtn">
            <button type="button" id="signout-btn" onclick="signOutUser()" class="btn btn-danger"> SignOut </button>
        </p>
    </div> -->
<script>
function myFunction() {
  // Declare variables
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("myInput");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");

  // Loop through all table rows, and hide those who don't match the search query
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[0];
    if (td) {
      txtValue = td.textContent || td.innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }
	
  }
}
</script>
</body>
<div>
</html>	


<?php
include('../database/config.php'); 
include('control.php'); 
$url= $_SERVER['REQUEST_URI'];
$id = $_SESSION['id'];
$name = $_SESSION['name'];
$mentor_id = $_SESSION['mentor_id'];
$year = date("Y");
$timezone = date_default_timezone_set('America/New_York');
$date = date('Y-m-d H:i:s');
$today_at_midnight = strtotime('midnight');

$date_check = '2030-02-27 00:00:00';
echo $date;
if (($year) == date("Y")) { 
if($date <= $date_check)
						{
echo 'isnide'							;
$student = 0;
$upload = 0;
$team_id = -1;
$team_select = 0;
if(!isset($team))
{
	$team = 0;
}

extract($_POST);

if(isset($_POST['submit_check'])) {
	
	if($terms)
	{
		$_SESSION['team'] = 1;
	}
	
}

if(isset($_POST['submit_team_select'])) {
	$team_select = 1;
	if($team_id > 0) 
	{
		header("location:viewteams.php?team_id=$team_id");
	}
	
}

if(isset($_POST['submit_team'])) {
$year = date("Y");
$project_description = mysqli_real_escape_string($con,$_POST['project_description']);
#echo 'tesitng'.$year;
$sql = mysqli_query($con,"insert into tbl_team (project_team_name,project_description,category,year) values ('$team_name', '$project_description','$category','$year')")	;
if($sql)
{
	$team_id = mysqli_insert_id($con);
	$team_q = mysqli_query($con,"insert into tbl_team_mentor values (NULL,$team_id,$mentor_id,'','','')");
	if($team_q)
	{
		$student = 1;
		$team_submit = 1;
		foreach( $_POST[ 'student_id' ] as $p )
		{
        //$q_u = mysqli_query($con, "select * from tbl_user where id= $p");
		//$r_u = mysqli_fetch_assoc($q_u);
		mysqli_query($con,"update tbl_team_member set team_id = $team_id where student_id = $p");
		}
	
	}
	
}
else 
{
	echo "<script>alert('Database error. Please report to admin!')</script>";
}
echo "<script type='text/javascript'>window.location.href = 'home.php';</script>";
}
#echo 'outside the script';

if(isset($_POST['submit_update']))	
{
$team_id = $_POST['team_id'];
$year = date("Y");
$project_description = mysqli_real_escape_string($con,$_POST['project_description']);

#echo 'inside the script';

$sql = mysqli_query($con,"update tbl_team set project_team_name ='$team_name' ,
                                            ,project_description = '$project_description',
											category = '$category' where id = $team_id" );
											
											
foreach($_POST['student_id'] as $p)
		{
        //$q_u = mysqli_query($con, "select * from tbl_user where id= $p");
		//$r_u = mysqli_fetch_assoc($q_u);
		mysqli_query($con,"update tbl_team_member set team_id = $team_id where student_id = $p");
		#echo "update tbl_team_member set team_id = $team_id where student_id = $p";
		}	
echo "<script type='text/javascript'>window.location.href = 'home.php';</script>";	
}



} else { 
	echo "<script>alert('Submission deadline is 02/26/2021 12:00:00')</script>";
	echo "<script type='text/javascript'>window.location.href = 'home.php';</script>";	
	} 
	}
  #echo "<script type='text/javascript'>window.location.href = 'home.php';</script>";  


?>

<!-- view_team_judges.php -->

<?php
include('../database/config.php'); 
include('control.php'); 

$id = $_SESSION['id'];
$name = $_SESSION['name'];


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <title>Team Vs Judges</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="css/style.css" type="text/css">
</head>

<style>
html, body {
    top:0;
    bottom:0;
    left:0;
    right:0;
    
   
}
</style>
<body>
<div id="wrapper">
    <div class="jumbotron col-md-12" style="font-size: 16px;
    height: 10em;margin-block-start: -55px;">
       <img class="card-img-top" src="images/emulogo.png" alt="logo image" style="width:99%;height: 226px;">
    </div>

	<nav class="navbar navbar-expand bg-dark navbar-dark" style="    margin-top: 140px;
    width: 1289px;
    left: 2.3%;">
        <!-- Links -->
        <ul class="navbar-nav">

            <li class="nav-item" style="font-weight: bold;">
                <a class="nav-link" href="home.php">Home</a>
            </li>
			
			
			<li class="nav-item dropdown" style="font-weight: bold;">
                <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                    Add
                </a>
                <div class="dropdown-menu"  id="mainNavbar">
                    <!--<a class="dropdown-item" href="teams.php">Teams</a>-->
                    <a class="dropdown-item" href="add_judges.php">Judges</a>
                </div>
            </li>
			
			
			<li class="nav-item dropdown" style="font-weight: bold;">
                <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                    View
                </a>
                <div class="dropdown-menu"  id="mainNavbar">
                    <a class="dropdown-item" href="teams.php">Teams</a>
                    <a class="dropdown-item" href="judges.php">Judges</a>
                </div>
            </li>
			
			
			<li class="nav-item dropdown" style="font-weight: bold;">
                <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                    Assign Teams vs Judges
                </a>
                <div class="dropdown-menu"  id="mainNavbar">
                    <a class="dropdown-item" href="assign_judge_team.php">Assign Teams vs Judges</a>
                    <a class="dropdown-item" href="view_judge_team.php">View Assigned Teams vs Judges</a>
                </div>
            </li>
			
			<li class="nav-item" style="font-weight: bold;">
                <a class="nav-link" href="liveqa_teams.php">Live QA</a>
            </li>
			
			<li class="nav-item" style="font-weight: bold;">
                <a class="nav-link" href="evaluation_results.php">Evaluation Details</a>
            </li>
			
			 <li class="nav-item dropdown" style="font-weight: bold;">
                <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                    <?php echo $name?>
                </a>
                <div class="dropdown-menu"  id="mainNavbar">
					<a class="dropdown-item" href="profile.php">Profile</a>
                    <a class="dropdown-item" href="logout.php">Logout</a>
                    
                </div>
            </li>

            <!--<li class="nav-item">
                <a class="nav-link" href="addStudent.html">Add Student</a>
            </li>

            <li class="nav-item" id="addAccount">
				<a class="nav-link" href="addUser.html">Add Account</a>
            </li>-->
        </ul>
    </nav>




        <div class="container d-flex justify-content-left col-md-12">
        <div class="col-12">
		<input type="text" class="form-control" id="myInput" onkeyup="myFunction()" style="margin-block-start: 10px;" placeholder="Search for Team names..">
		<br>
            <table class="table" id="myTable" style="margin-block-start: -11px">
                <thead class="thead-dark" id="table">
                    <tr>
						<th scope="col">Team Name</th>
						<th scope="col">Category</th>
						<th scope="col">Judges</th>
                    </tr>
                </thead>
				<tbody> 
				
				<?php 
				$q_team = mysqli_query($con,"select GROUP_CONCAT(concat(first_name,' ', last_name)) as judge_list , project_team_name, tt.category 
															from `tbl_judge_team` tj, tbl_user tu, tbl_team tt
															WHERE tj.user_id=tu.id
															and tu.id = tj.user_id
															and tj.team_id = tt.id
                                        					group by (project_team_name)");	
									
				while ($r_team = mysqli_fetch_assoc($q_team))					
				{
				
				?>
											
					<tr> 
						<td><?php echo $r_team['project_team_name']?></td> 
						<td><?php echo $r_team['category']?></a></td> 
						<td><?php echo $r_team['judge_list']?></a></td> 
						<!--<td><a href="delete_ja.php?id=<?php echo $r_team['id']?>"><button type="button" style="margin:0px;"  class="btn-success btn-sm"  onclick="edit(this)">Delete</button></a></td> -->
				    </tr> 
				<?php } ?>								
												
											</tbody> 
            </table>
        </div>

    </div>



    
</div>
<script>
function myFunction() {
  // Declare variables
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("myInput");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");

  // Loop through all table rows, and hide those who don't match the search query
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[0];
    if (td) {
      txtValue = td.textContent || td.innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }
  }
}
</script>
</body>

</html>


<!-- view_judge_teams.php -->
<?php
include('../database/config.php'); 
include('control.php'); 

$id = $_SESSION['id'];
$name = $_SESSION['name'];

$judge_id='';
extract($_POST);
if(isset($_POST['submit']))
{	
$judge_id = $_POST['judge_id'];
}



?>


<!DOCTYPE html>
<html lang="en">

<head>
    <title>Judges List</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="css/style.css" type="text/css">
</head>

<style>
html, body {
    top:0;
    bottom:0;
    left:0;
    right:0;
    
   
}
</style>
<body>
<div id="wrapper">
    <div class="jumbotron col-md-12" style="font-size: 16px;
    height: 10em;margin-block-start: -55px;">
       <img class="card-img-top" src="images/emulogo.png" alt="logo image" style="width:99%;height: 226px;">
    </div>

	<nav class="navbar navbar-expand bg-dark navbar-dark" style="    margin-top: 140px;
    width: 1289px;
    left: 2.3%;">
        <!-- Links -->
        <ul class="navbar-nav">

            <li class="nav-item" style="font-weight: bold;">
                <a class="nav-link" href="home.php">Home</a>
            </li>
			
			
			<li class="nav-item dropdown" style="font-weight: bold;">
                <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                    Add
                </a>
                <div class="dropdown-menu"  id="mainNavbar">
                    <!--<a class="dropdown-item" href="teams.php">Teams</a>-->
                    <a class="dropdown-item" href="add_judges.php">Judges</a>
                </div>
            </li>
			
			
			<li class="nav-item dropdown" style="font-weight: bold;">
                <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                    View
                </a>
                <div class="dropdown-menu"  id="mainNavbar">
                    <a class="dropdown-item" href="teams.php">Teams</a>
                    <a class="dropdown-item" href="judges.php">Judges</a>
                </div>
            </li>
			
			
			<li class="nav-item dropdown" style="font-weight: bold;">
                <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                    Assign Teams vs Judges
                </a>
                <div class="dropdown-menu"  id="mainNavbar">
                    <a class="dropdown-item" href="assign_judge_team.php">Assign Teams vs Judges</a>
                    <a class="dropdown-item" href="view_judge_team.php">View Assigned Teams vs Judges</a>
                </div>
            </li>
			
			
			<li class="nav-item" style="font-weight: bold;">
                <a class="nav-link" href="liveqa_teams.php">Live QA</a>
            </li>
			
			<li class="nav-item" style="font-weight: bold;">
                <a class="nav-link" href="evaluation_results.php">Evaluation Details</a>
            </li>
			
			 <li class="nav-item dropdown" style="font-weight: bold;">
                <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                    <?php echo $name?>
                </a>
                <div class="dropdown-menu"  id="mainNavbar">
					<a class="dropdown-item" href="profile.php">Profile</a>
                    <a class="dropdown-item" href="logout.php">Logout</a>
                    
                </div>
            </li>

            <!--<li class="nav-item">
                <a class="nav-link" href="addStudent.html">Add Student</a>
            </li>

            <li class="nav-item" id="addAccount">
				<a class="nav-link" href="addUser.html">Add Account</a>
            </li>-->
        </ul>
    </nav>




        <div class="container d-flex justify-content-left col-md-12">
        <div class="col-12">
		<input type="text" class="form-control" id="myInput" onkeyup="myFunction()" style="margin-block-start: 10px;" placeholder="Search for Judge names..">
		<br>
            <table class="table" id="myTable" style="margin-block-start: -11px">
                <thead class="thead-dark" id="table">
                    <tr>
						<th scope="col">Judge</th>
						<th scope="col">Judge Email</th>
						<th scope="col">Team Name</th>
						<th scope="col">Category</th>
                        <!--<th>Delete Record</th>-->
                    </tr>
                </thead>
				<tbody> 
				
				<?php 
				$count_tja= 0 ;
				$user_id_1 = array();
				$j_c_e = mysqli_query($con,"select user_id, count(user_id) as count from tbl_judge_team group by (user_id)");
				while($row = mysqli_fetch_assoc($j_c_e))
				{
					$user_id = $row['user_id'];
					$count_tj = $row['count'];
					$q_c = mysqli_query($con,"select count(user_id) as count from tbl_judge_assessment where user_id = $user_id and (identifying_understanding is not null 
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
				#echo 'inside list';
				$qu_c = mysqli_query($con,"select t.user_id,judge_name,email, group_concat(category) as category, GROUP_CONCAT(project_team_name) as project_team_name from (select tj.user_id,concat(tu.first_name,' ', tu.last_name) as judge_name,tu.email, tt.project_team_name, tt.category FROM tbl_user tu, tbl_judge_team tj, tbl_team tt
										where tj.user_id in (select distinct user_id from tbl_judge_team)
										and tj.team_id = tt.id
										and tj.user_id = tu.id) t 
                                        group by (judge_name)");
				
				while($qu_d = mysqli_fetch_assoc($qu_c))
					{		
				?>
											
					<tr> 
						<td><a href="JudgeDetails.php?id=<?php echo $qu_d['user_id']?>"><?php echo $qu_d['judge_name']?></a></td> 
						<td><a href="JudgeDetails.php?id=<?php echo $qu_d['user_id']?>"><?php echo $qu_d['email']?></a></td> 
						<td><?php echo $qu_d['project_team_name']?></a></td> 
						<td><?php echo $qu_d['category']?></a></td> 
						<!--<td><a href="delete_ja.php?id=<?php echo $qu_d['id']?>"><button type="button" style="margin:0px;"  class="btn-success btn-sm"  onclick="edit(this)">Delete</button></a></td> -->
				    </tr> 
				<?php }}?>								
												
											</tbody> 
            </table>
        </div>

    </div>



    
</div>
<script>
function myFunction() {
  // Declare variables
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("myInput");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");

  // Loop through all table rows, and hide those who don't match the search query
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[0];
    if (td) {
      txtValue = td.textContent || td.innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";


      }
    }
  }
}
</script>
</body>

</html>


<!-- <<3 -->
<?php 
				
				$q_team = mysqli_query($con,"select  distinct user_id, GROUP_CONCAT(team_id) as team_list ,count(*) as count from tbl_judge_team group by (user_id) having count(user_id) <= 3");	
				while ($r_team = mysqli_fetch_assoc($q_team))					
				{
					$user_id = $r_team['user_id'];
					$list = $r_team['team_list'];
					
					$q_n = mysqli_query($con,"select concat(first_name,' ',last_name) as judge_name,email from tbl_user where id = $user_id");
					$d_n = mysqli_fetch_assoc($q_n);
					
					$q_t = mysqli_query($con,"select group_concat(project_team_name) as team_name, group_concat(category) as category from tbl_team where id in ($list)");
					$q_d = mysqli_fetch_assoc($q_t);
				
				?>


<!-- judgescomplete.php -->
<?php 
				$count_tja= 0 ;
				$user_id_1 = array();
				$j_c_e = mysqli_query($con,"select user_id, count(user_id) as count from tbl_judge_team group by (user_id)");
				while($row = mysqli_fetch_assoc($j_c_e))
				{
					$user_id = $row['user_id'];
					$count_tj = $row['count'];
					$q_c = mysqli_query($con,"select count(user_id) as count from tbl_judge_assessment where user_id = $user_id and (identifying_understanding is not null 
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
				#echo 'inside list';
				$qu_c = mysqli_query($con,"select t.user_id,judge_name,email, group_concat(category) as category, GROUP_CONCAT(project_team_name) as project_team_name from (select tj.user_id,concat(tu.first_name,' ', tu.last_name) as judge_name,tu.email, tt.project_team_name, tt.category FROM tbl_user tu, tbl_judge_team tj, tbl_team tt
										where tj.user_id in ($list)
										and tj.team_id = tt.id
										and tj.user_id = tu.id) t 
                                        group by (judge_name)");
				
				while($qu_d = mysqli_fetch_assoc($qu_c))
					{		
				?>
											
					<tr> 
						<td><a href="JudgeDetails.php?id=<?php echo $qu_d['user_id']?>"><?php echo $qu_d['judge_name']?></a></td> 
						<td><a href="JudgeDetails.php?id=<?php echo $qu_d['user_id']?>"><?php echo $qu_d['email']?></a></td> 
						<td><?php echo $qu_d['project_team_name']?></a></td> 
						<td><?php echo $qu_d['category']?></a></td> 
						<!--<td><a href="delete_ja.php?id=<?php echo $qu_d['id']?>"><button type="button" style="margin:0px;"  class="btn-success btn-sm"  onclick="edit(this)">Delete</button></a></td> -->
				    </tr> 
				<?php }}?>	
                
                
                <?php 
				$count_tja= 0 ;
				$team_id_1 = array();
				$t_c_e = mysqli_query($con,"select team_id, count(team_id) as count from tbl_judge_team group by (team_id)");
				while($row_t = mysqli_fetch_assoc($t_c_e))
				{
					$team_id = $row_t['team_id'];
					$count_tj = $row_t['count'];
					$q_c = mysqli_query($con,"select count(team_id) as count from tbl_judge_assessment where team_id = $team_id and (identifying_understanding is not null 
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
					if(($count_tj-$count_tja)== 0)
					{
						array_push($team_id_1,$team_id);
						
					}
				}		
				$stuff = $team_id_1;
				#$list =  implode(", ", $stuff);    //prints 1, 2, 3
				$list = join(',', $stuff);  

				
				$qu_c = mysqli_query($con,"select project_team_name,GROUP_CONCAT(judge_name) as judge_list, GROUP_CONCAT(category) as category from (  select tt.project_team_name, tt.category, concat(first_name,' ',last_name) as judge_name FROM tbl_user tu, tbl_judge_team tj, tbl_team tt
										where tj.team_id in ($list)
										and tj.team_id = tt.id
										and tj.user_id = tu.id) t 
                                        group by (project_team_name)");
				
				while($qu_d = mysqli_fetch_assoc($qu_c))
					{		
				?>
											
					<tr> 
						<td><?php echo $qu_d['project_team_name']?></a></td> 
						<td><?php echo $qu_d['judge_list']?></td> 
						<td><?php echo $qu_d['category']?></a></td> 
						<!--<td><a href="delete_ja.php?id=<?php echo $qu_d['id']?>"><button type="button" style="margin:0px;"  class="btn-success btn-sm"  onclick="edit(this)">Delete</button></a></td> -->
				    </tr> 
					<?php }?>
                    <?php
include('../database/config.php'); 
include('control.php'); 

$id = $_SESSION['id'];
$name = $_SESSION['name'];
$category='';
extract($_POST);
if(isset($_POST['submit']))
{	
$category = $_POST['team_category'];
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Team Lists</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="css/style.css" type="text/css">
</head>

<style>
html, body {
    top:0;
    bottom:0;
    left:0;
    right:0;
    
   
}
</style>
<?php include('../header.php'); ?>
<div id="wrapper">
<body>

   <nav class="navbar navbar-expand bg-dark navbar-dark" style="margin-top:20px;width:100%;">
        <!-- Links -->
        <ul class="navbar-nav">

            <li class="nav-item" style="font-weight: bold;">
                <a class="nav-link" href="home.php">Home</a>
            </li>
			
			
			<!--<li class="nav-item dropdown" style="font-weight: bold;">
                <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                    Add
                </a>
                <div class="dropdown-menu"  id="mainNavbar">
                    <!--<a class="dropdown-item" href="teams.php">Teams</a>
                    <a class="dropdown-item" href="add_judges.php">Judges</a>
                </div>
            </li>-->
			
			
			<li class="nav-item dropdown" style="font-weight: bold;">
                <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                    View
                </a>
                <div class="dropdown-menu"  id="mainNavbar">
                    <a class="dropdown-item" href="users.php">Users</a>
					<a class="dropdown-item" href="teams.php">Teams</a>
                    <a class="dropdown-item" href="judges.php">Judges</a>
                </div>
            </li>
			
			<!--<li class="nav-item dropdown" style="font-weight: bold;">
                <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                    View
                </a>
                <div class="dropdown-menu"  id="mainNavbar">
                    <a class="dropdown-item" href="teams.php">Teams</a>
                    <a class="dropdown-item" href="judges.php">Judges</a>
                </div>
            </li>-->
			
			
			<li class="nav-item dropdown" style="font-weight: bold;">
                <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                    Assign Teams vs Judges
                </a>
                <div class="dropdown-menu"  id="mainNavbar">
                    <a class="dropdown-item" href="assign_judge_team.php">Assign Teams vs Judges</a>
                    <a class="dropdown-item" href="view_judge_team.php">View Assigned Teams vs Judges</a>
                </div>
            </li>
			
			<li class="nav-item" style="font-weight: bold;">
                <a class="nav-link" href="liveqa_teams.php">Live QA</a>
            </li>
			
			
			<li class="nav-item" style="font-weight: bold;">
                <a class="nav-link" href="evaluation_results.php">Evaluation Details</a>
            </li>
			
			 <li class="nav-item dropdown" style="font-weight: bold;">
                <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                    <?php echo $name?>
                </a>
                <div class="dropdown-menu"  id="mainNavbar">
					<a class="dropdown-item" href="profile.php">Profile</a>
                    <a class="dropdown-item" href="logout.php">Logout</a>
                    
                </div>
            </li>

            <!--<li class="nav-item">
                <a class="nav-link" href="addStudent.html">Add Student</a>
            </li>

            <li class="nav-item" id="addAccount">
				<a class="nav-link" href="addUser.html">Add Account</a>
            </li>-->
        </ul>
    </nav>
    <br>
    <div class="container d-flex justify-content-left col-md-12">
        <div class="col-12">
		<input type="text" class="form-control" id="myInput" onkeyup="myFunction()" placeholder="Search for Team names..">
		<br>
            <table class="table" id="myTable" style="margin-block-start: -20px">
                <thead class="thead-dark" id="table">
                    <tr>
						<th scope="col">Team Name</th>
						<th scope="col">Category</th>
                        <th scope="col">Team Members</th>
                        <th> View Details</th>
                    </tr>
                </thead>
				<tbody> 
				
				<?php 
				if($category!=='')
				{
				$q_team = mysqli_query($con,"select distinct tt.id as team_id,tt.project_team_name as project_name,tt.project_description,tt.category,tt.video_pitch, tt.log_book
				from tbl_team tt where category = '$category'");	
				}
				else
				{
					$q_team = mysqli_query($con,"select distinct tt.id as team_id,tt.project_team_name as project_name,tt.project_description,tt.category,tt.video_pitch, tt.log_book
				from tbl_team tt");	
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
				$team_m_q = mysqli_query($con, "select GROUP_CONCAT(student_first_name) as members from tbl_team_member where team_id = $team_id");
				$team_m_r = mysqli_fetch_assoc($team_m_q);
				
				?>
											
					<tr> 
						<td><a href="viewteams.php?team_id=<?php echo $r_team['team_id']?>"><?php echo $r_team['project_name']?></a></td> 
						<!--<td><a href="viewteams.php?team_id=<?php echo $r_team['team_id']?>"><?php echo $r_team['project_description']?></a></td> -->
						<td><a href="viewteams.php?team_id=<?php echo $r_team['team_id']?>"><?php echo $r_team['category']?></a></td> 
						<td><?php echo $team_m_r['members']?></td>  
						<td><a href="edit_team_liveqa.php?team_id=<?php echo $team_id?>"><button type="button" style="margin:0px;"  class="btn-success btn-sm"  onclick="edit(this)">Update Details</button></a></td> 
				    </tr> 
				<?php } ?>								
												
											</tbody> 
            </table>
        </div>

    </div>

    <!-- <div class="container d-flex justify-content-center col-md-8">
        <p class="dbtn">
            <button type="button" id="signout-btn" onclick="signOutUser()" class="btn btn-danger"> SignOut </button>
        </p>
    </div> -->
<script>
function myFunction() {
  // Declare variables
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("myInput");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");

  // Loop through all table rows, and hide those who don't match the search query
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[0];
    if (td) {
      txtValue = td.textContent || td.innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }
  }
}
</script>
</body>
<div>
</html>	

<!-- evaluation_result -->

<?php
include('../database/config.php'); 
include('control.php'); 

$id = $_SESSION['id'];
$name = $_SESSION['name'];


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Team Lists</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="css/style.css" type="text/css">
</head>
<style>
html, body {
    top:0;
    bottom:0;
    left:0;
    right:0;
    
   
}
</style>
<?php include('../header.php'); ?>
<body>
<div id="wrapper">
   <nav class="navbar navbar-expand bg-dark navbar-dark" style="margin-top:20px;width:100%;">
        <!-- Links -->
        <ul class="navbar-nav">

            <li class="nav-item" style="font-weight: bold;">
                <a class="nav-link" href="home.php">Home</a>
            </li>
			
			
			<!--<li class="nav-item dropdown" style="font-weight: bold;">
                <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                    Add
                </a>
                <div class="dropdown-menu"  id="mainNavbar">
                    <!--<a class="dropdown-item" href="teams.php">Teams</a>
                    <a class="dropdown-item" href="add_judges.php">Judges</a>
                </div>
            </li>-->
			
			
			<li class="nav-item dropdown" style="font-weight: bold;">
                <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                    View
                </a>
                <div class="dropdown-menu"  id="mainNavbar">
                    <a class="dropdown-item" href="users.php">Users</a>
					<a class="dropdown-item" href="teams.php">Teams</a>
                    <a class="dropdown-item" href="judges.php">Judges</a>
                </div>
            </li>
			
			<!--<li class="nav-item dropdown" style="font-weight: bold;">
                <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                    View
                </a>
                <div class="dropdown-menu"  id="mainNavbar">
                    <a class="dropdown-item" href="teams.php">Teams</a>
                    <a class="dropdown-item" href="judges.php">Judges</a>
                </div>
            </li>-->
			
			
			<li class="nav-item dropdown" style="font-weight: bold;">
                <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                    Assign Teams vs Judges
                </a>
                <div class="dropdown-menu"  id="mainNavbar">
                    <a class="dropdown-item" href="assign_judge_team.php">Assign Teams vs Judges</a>
                    <a class="dropdown-item" href="view_judge_team.php">View Assigned Teams vs Judges</a>
                </div>
            </li>
			
			<li class="nav-item" style="font-weight: bold;">
                <a class="nav-link" href="liveqa_teams.php">Live QA</a>
            </li>
			
			
			<li class="nav-item" style="font-weight: bold;">
                <a class="nav-link" href="evaluation_results.php">Evaluation Details</a>
            </li>
			
			 <li class="nav-item dropdown" style="font-weight: bold;">
                <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                    <?php echo $name?>
                </a>
                <div class="dropdown-menu"  id="mainNavbar">
					<a class="dropdown-item" href="profile.php">Profile</a>
                    <a class="dropdown-item" href="logout.php">Logout</a>
                    
                </div>
            </li>

            <!--<li class="nav-item">
                <a class="nav-link" href="addStudent.html">Add Student</a>
            </li>

            <li class="nav-item" id="addAccount">
				<a class="nav-link" href="addUser.html">Add Account</a>
            </li>-->
        </ul>
    </nav>

    <br>
    <div class="container d-flex justify-content-left col-md-12" >
        <div class="col-12">
		
		<input type="text" class="form-control" id="myInput" onkeyup="myFunction()" placeholder="Search for Team names..">
		<br>
		
            <table class="table" id="myTable" style="margin-block-start: -20px">
                <thead class="thead-dark" id="table">
                    <tr>
						<!--<th scope="col">Team ID</th>-->
                        <th scope="col" >Team Name</th>
                        <!--<th scope="col">Team Mentor</th>-->
                        <th scope="col" >Category</th>
                        <th scope="col" >Scores</th>
						<!--<th scope="col" >Team Members</th>
						<th scope="col" >Team Category</th>-->
						<th scope="col" >Status</th>
                        <th> View Details</th>
                    </tr>
                </thead>
				<tbody> 
				
				<?php 
				$q_team = mysqli_query($con,"select team_id, tt.project_team_name as project_name, tt.category, avg(total) as total
										from tbl_team tt, stut_tot st
										where tt.id = st.team_id
										group by(team_id)
									");	
									
				while ($r_team = mysqli_fetch_assoc($q_team))					
				{
					$team_id = $r_team['team_id'];				
				$q_e = mysqli_query($con,"select * from tbl_judge_assessment where team_id = $team_id");
				$r_q_e = mysqli_num_rows($q_e);
				$d_q_e = mysqli_fetch_assoc($q_e);
				if ($d_q_e['id'])
				{
				$st_q = mysqli_query($con,"select sum(count_a) as count from (select count(*) as count_a from tbl_judge_team where team_id = $team_id and user_id not in (select user_id from tbl_judge_assessment where team_id = $team_id) union (select count(*) as count_a From tbl_judge_assessment 
					where team_id = $team_id and  (identifying_understanding is null or ideating is null
					or designing_building is null or testing_refinging is null or value_propoition is null
					or market_potential is null or social_value is null or originality is null or logbook is null
					or display_board is null or prototype is null or online_pitch is null or question_asked is null
					))) t");
				$st_d = mysqli_fetch_assoc($st_q);
				$c = $st_d['count'];
				if($c == 0)
				{
					$status = 'Complete';
				}
				else{
					$status = 'Incomplete';
				}
				}

				?>
											
												<tr> 
													<!--<td><a href="viewteams.php?team_id=<?php echo $r_team['team_id']?>"><?php echo $r_team['team_id']?></a></td>-->
													<td><?php echo $r_team['project_name']?></td> 
													<td><?php echo $r_team['category']?></td>  
													<td><?php echo $r_team['total']?></td>  
													<td><?php echo $status?></td> 
													<td><a href="view_evaluations.php?team_id=<?php echo $r_team['team_id']?>"><button type="button" style="margin:0px;"  class="btn-success btn-sm"  onclick="edit(this)">View Evaluations</button></a></td> 
													
												</tr> 
				<?php } ?>								
												
											</tbody> 
            </table>
        </div>

    </div>

    <!-- <div class="container d-flex justify-content-center col-md-8">
        <p class="dbtn">
            <button type="button" id="signout-btn" onclick="signOutUser()" class="btn btn-danger"> SignOut </button>
        </p>
    </div> -->




    <!-- Firebase App is always required and must be first -->
    <script src="https://www.gstatic.com/firebasejs/5.9.1/firebase-app.js"></script>

    <!-- Add additional services that you want to use -->
    <script src="https://www.gstatic.com/firebasejs/5.9.1/firebase-auth.js"></script>
    <script src="https://www.gstatic.com/firebasejs/3.1.0/firebase-database.js"></script>

    <!-- TODO: Add SDKs for Firebase products that you want to use
     https://firebase.google.com/docs/web/setup#config-web-app -->

    
</div>
<script>
function myFunction() {
  // Declare variables
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("myInput");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");

  // Loop through all table rows, and hide those who don't match the search query
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[0];
    if (td) {
      txtValue = td.textContent || td.innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }
  }
}
</script>
</body>
</html>	



<?php
include('../database/config.php'); 
include('control.php'); 

$id = $_SESSION['id'];
$name = $_SESSION['name'];

$team_id = $_GET['team_id'];
$q_t = mysqli_query($con,"select * from tbl_team where id = $team_id");
$d_t = mysqli_fetch_assoc($q_t);
$team_name = $d_t['project_team_name'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Evaluation Team Lists</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="css/style.css" type="text/css">
</head>
<style>
html, body {
    top:0;
    bottom:0;
    left:0;
    right:0;
    
   
}
</style>
<body>
<div id="wrapper">
    <div class="jumbotron col-md-12" style="font-size: 16px;
    height: 10em;margin-block-start: -55px;">
       <img class="card-img-top" src="images/emulogo.png" alt="logo image" style="width:99%;height: 226px;">
    </div>

	<nav class="navbar navbar-expand bg-dark navbar-dark" style="    margin-top: 140px;
    width: 1289px;
    left: 2.3%;">
        <!-- Links -->
        <ul class="navbar-nav">

            <li class="nav-item" style="font-weight: bold;">
                <a class="nav-link" href="home.php">Home</a>
            </li>
			
			
			<li class="nav-item dropdown" style="font-weight: bold;">
                <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                    Add
                </a>
                <div class="dropdown-menu"  id="mainNavbar">
                    <!--<a class="dropdown-item" href="teams.php">Teams</a>-->
                    <a class="dropdown-item" href="add_judges.php">Judges</a>
                </div>
            </li>
			
			
			<li class="nav-item dropdown" style="font-weight: bold;">
                <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                    View
                </a>
                <div class="dropdown-menu"  id="mainNavbar">
                    <a class="dropdown-item" href="teams.php">Teams</a>
                    <a class="dropdown-item" href="judges.php">Judges</a>
                </div>
            </li>
			
			
			<li class="nav-item dropdown" style="font-weight: bold;">
                <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                    Assign Teams vs Judges
                </a>
                <div class="dropdown-menu"  id="mainNavbar">
                    <a class="dropdown-item" href="assign_judge_team.php">Assign Teams vs Judges</a>
                    <a class="dropdown-item" href="view_judge_team.php">View Assigned Teams vs Judges</a>
                </div>
            </li>
			
			<li class="nav-item" style="font-weight: bold;">
                <a class="nav-link" href="liveqa_teams.php">Live QA</a>
            </li>
			
			<li class="nav-item" style="font-weight: bold;">
                <a class="nav-link" href="evaluation_results.php">Evaluation Details</a>
            </li>
			
			 <li class="nav-item dropdown" style="font-weight: bold;">
                <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                    <?php echo $name?>
                </a>
                <div class="dropdown-menu"  id="mainNavbar">
					<a class="dropdown-item" href="profile.php">Profile</a>
                    <a class="dropdown-item" href="logout.php">Logout</a>
                    
                </div>
            </li>

            <!--<li class="nav-item">
                <a class="nav-link" href="addStudent.html">Add Student</a>
            </li>

            <li class="nav-item" id="addAccount">
				<a class="nav-link" href="addUser.html">Add Account</a>
            </li>-->
        </ul>
    </nav>

    <br>
    <div class="container d-flex justify-content-left col-md-12" >
	<div class="col-12">
		<h3><?php echo 'Team Name: '.$team_name?></h3>
		
		
		<table class="table table-borderless" style="margin-block-start: -5px;">
                <thead class="thead-dark" id="table">
				
                    <tr>
						<th scope="col">Evaluation Text</th>
						<?php 
						$q_j = mysqli_query($con,"select * from tbl_judge_team where team_id = $team_id and user_id in (select user_id from tbl_judge_assessment where team_id = $team_id) order by user_id asc");
						$count = mysqli_num_rows($q_j);
						#echo $count;
						$i=1;
						while($d_j = mysqli_fetch_assoc($q_j))
						{
						?>
						<th scope="col"><a href="JudgeDetails.php?id=<?php echo $d_j['user_id']?>">Judge<?php echo $i;?></a></th>
						<?php $i++;} 
						$q_j = mysqli_query($con,"select * from tbl_judge_team where team_id = $team_id and user_id not in (select user_id from tbl_judge_assessment where team_id = $team_id) order by user_id");
						#$count = mysqli_num_rows($q_j);
						#echo $count;
						$i=$count+1;
						while($d_j = mysqli_fetch_assoc($q_j))
						{
						?>
						<th scope="col"><a href="JudgeDetails.php?id=<?php echo $d_j['user_id']?>">Judge<?php echo $i;?></a></th>
						<?php $i++;} ?>
						</tr>
				
                </thead>
			<?php 
			
			$sql = mysqli_query($con,"describe tbl_judge_assessment");
				while($d = mysqli_fetch_assoc($sql))
				{
					$col_name_val = '';
					$col_name = $d['Field'];
					
					if($col_name != 'id' && $col_name!='team_id' && $col_name!='user_id')
					{
						
						$q_team = mysqli_query($con,"select team_id,GROUP_CONCAT(ifnull($col_name,'Incomplete') order by user_id SEPARATOR '; ') as val, group_concat(user_id order by user_id SEPARATOR ', ') as judges from tbl_judge_assessment
						where team_id = $team_id order by user_id asc");	
				

				$r_team = mysqli_fetch_assoc($q_team);
				
				$string = $r_team['val'];
				#echo $string;
				$string = preg_replace('/\.$/', '', $string); //Remove dot at end if exists
				$array = explode('; ', $string); //split string into array seperated by ', '
				$judges_list = $r_team['judges'];
				$string_j = preg_replace('/\.$/', '', $judges_list); //Remove dot at end if exists
				$array_j= explode(', ', $string_j); //split string into array seperated by ', '
				#$array_j = arsort($array_j);
				#print_r($array_j);
				if($col_name == 'identifying_understanding')
					{
						$col_name_val = 'Identifying & Understanding';
					}
					else if($col_name == 'ideating')
					{
						$col_name_val = 'Ideating';
					}
					else if($col_name == 'designing_building')
					{
						$col_name_val = 'Designing & Building';
					}
					else if($col_name == 'testing_refinging')
					{
						$col_name_val = 'Testing & Refinging';
					}
					else if($col_name == 'value_propoition')
					{
						$col_name_val = 'Value Proportion';
					}
					else if($col_name == 'market_potential')
					{
						$col_name_val = 'Market Potential';
					}
					else if($col_name == 'social_value')
					{
						$col_name_val = 'Social Value';
					}
					else if($col_name == 'originality')
					{
						$col_name_val = 'Originality';
					}
					else if($col_name == 'logbook')
					{
						$col_name_val = 'LogBook';
					}
					else if($col_name == 'display_board')
					{
						$col_name_val = 'Display Board';
					}
					else if($col_name == 'prototype')
					{
						$col_name_val = 'Prototype';
					}
					else if($col_name == 'online_pitch')
					{
						$col_name_val = 'Online Pitch';
					}
					else if($col_name == 'question_asked')
					{
						$col_name_val = 'Q & A';
					}
					else if($col_name == 'live_qa')
					{
						$col_name_val = 'Live QA';
					}	
					
            ?>		
				<tbody>								
					<tr> 
					<td style="width: 40px;"><?php echo $col_name_val?></td> 
					<?php 
					$i=0;
					foreach($array as $value) //loop over values
					{
						#echo $array_j[$i];
					?>
					<td style="width: 10px;"><a href="update_evaluation_team.php?judge_id=<?php echo $array_j[$i]?>&team_id=<?php echo $team_id?>"><?php echo $value . PHP_EOL;?></a></td> 
					<?php $i++;}
					$q = "select user_id from tbl_judge_team 
					where team_id = $team_id and user_id not in 
					(select user_id from tbl_judge_assessment where team_id = $team_id order by user_id asc) order by user_id asc";
					$qu_q = mysqli_query($con,$q);
					while($qu_d = mysqli_fetch_assoc($qu_q))
					{
						
					?>
					<td style="width: 10px;"><a href="evaluate_team.php?judge_id=<?php echo $qu_d['user_id']?>&team_id=<?php echo $team_id?>">Incomplete</a></td> 
					<?php } ?>
					
			</tr> 
												</tbody>
				<?php }} ?>									
												
            </table>
			
			
			
        </div>

    </div>

    <!-- <div class="container d-flex justify-content-center col-md-8">
        <p class="dbtn">
            <button type="button" id="signout-btn" onclick="signOutUser()" class="btn btn-danger"> SignOut </button>
        </p>
    </div> -->




    <!-- Firebase App is always required and must be first -->
    <script src="https://www.gstatic.com/firebasejs/5.9.1/firebase-app.js"></script>

    <!-- Add additional services that you want to use -->
    <script src="https://www.gstatic.com/firebasejs/5.9.1/firebase-auth.js"></script>
    <script src="https://www.gstatic.com/firebasejs/3.1.0/firebase-database.js"></script>

    <!-- TODO: Add SDKs for Firebase products that you want to use
     https://firebase.google.com/docs/web/setup#config-web-app -->



    
</div>
</body>
</html>	


<?php
include('../database/config.php'); 
include('control.php'); 

$id = $_GET['id'];
$name = $_SESSION['name'];
$q = mysqli_query($con,"select * from tbl_user where id = $id");
$r = mysqli_fetch_assoc($q);
extract($_POST);
if(isset($_POST['submit']))
{
	echo 'inside if';
	$q = ("update tbl_user set first_name = '$first_name', 
												last_name = '$last_name',
												phone = '$phone',
												email = '$email',
												password = '$password',
												category = '$category', judge_confirm = '$judge_confirm' where id = $id");
	$q_u=mysqli_query($con,$q);
	if($q_u)												
	{
		header("location:judges.php");
		
	}
	else 
	{
		echo("Update failed".$q);
	}
	
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Edit Profile</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="css/style.css" type="text/css">
</head>

<style>
html, body {
    top:0;
    bottom:0;
    left:0;
    right:0;
    
   
}
</style>
<body>
<div id="wrapper">
    <div class="jumbotron col-md-12" style="font-size: 16px;
    height: 10em;margin-block-start: -55px;">
       <img class="card-img-top" src="images/emulogo.png" alt="logo image" style="width:99%;height: 226px;">
    </div>

	<nav class="navbar navbar-expand bg-dark navbar-dark" style="    margin-top: 140px;
    width: 1289px;
    left: 2.3%;">
        <!-- Links -->
        <ul class="navbar-nav">

            <li class="nav-item" style="font-weight: bold;">
                <a class="nav-link" href="home.php">Home</a>
            </li>
			
			
			<li class="nav-item dropdown" style="font-weight: bold;">
                <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                    Add
                </a>
                <div class="dropdown-menu"  id="mainNavbar">
                    <!--<a class="dropdown-item" href="teams.php">Teams</a>-->
                    <a class="dropdown-item" href="add_judges.php">Judges</a>
                </div>
            </li>
			
			
			<li class="nav-item dropdown" style="font-weight: bold;">
                <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                    View
                </a>
                <div class="dropdown-menu"  id="mainNavbar">
                    <a class="dropdown-item" href="teams.php">Teams</a>
                    <a class="dropdown-item" href="judges.php">Judges</a>
                </div>
            </li>
			
			
			<li class="nav-item dropdown" style="font-weight: bold;">
                <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                    Assign Teams vs Judges
                </a>
                <div class="dropdown-menu"  id="mainNavbar">
                    <a class="dropdown-item" href="assign_judge_team.php">Assign Teams vs Judges</a>
                    <a class="dropdown-item" href="view_judge_team.php">View Assigned Teams vs Judges</a>
                </div>
            </li>
			
			<li class="nav-item" style="font-weight: bold;">
                <a class="nav-link" href="liveqa_teams.php">Live QA</a>
            </li>
			
			<li class="nav-item" style="font-weight: bold;">
                <a class="nav-link" href="evaluation_results.php">Evaluation Details</a>
            </li>
			
			 <li class="nav-item dropdown" style="font-weight: bold;">
                <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                    <?php echo $name?>
                </a>
                <div class="dropdown-menu"  id="mainNavbar">
					<a class="dropdown-item" href="profile.php">Profile</a>
                    <a class="dropdown-item" href="logout.php">Logout</a>
                    
                </div>
            </li>

            <!--<li class="nav-item">
                <a class="nav-link" href="addStudent.html">Add Student</a>
            </li>

            <li class="nav-item" id="addAccount">
				<a class="nav-link" href="addUser.html">Add Account</a>
            </li>-->
        </ul>
    </nav>





    <div class="container d-flex justify-content-left col-md-10">
        <div class="col-9">
		<form method="post" enctype="multipart/form-data" >
            <br>
            <h3> Profile:</h3>
            <br>

            <table class="table table-borderless">

                <thead class="thead-dark">
                    <tr>
                        <th colspan="3"> Basic Information </th>
                     </tr>
                    </thead>

                <tr>
                    <td>
                        <div class="form-group">
                            <label for="email"> <b> First Name: </b> </label>
                            <input type="text" class="form-control" name="first_name" id="first_name" value="<?php echo $r['first_name']?>">
                        </div>
                    </td>
					
				</tr>	
				<tr>

                    <td>
                        <div class="form-group">
                            <label for="email"><b> Last Name:</b></label>
                            <input type="text" class="form-control" name="last_name" id="last_name" value="<?php echo $r['last_name']?>">
                        </div>
                    </td>
				</tr>
				<tr>	
                    <td>
                        <div class="form-group">
                            <label for="email"><b> Email:</b></label>
                           <input type="text" class="form-control" name="email" id="email" value="<?php echo $r['email']?>">
                        </div>
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <div class="form-group">
                            <label for="email"><b>Password:</b></label>
                           <input type="text" class="form-control" name="password" id="password" value="<?php echo $r['password']?>">
                        </div>
                    </td>
                </tr>

                <tr>

                    <td>
                        <div class="form-group">
                            <label for="pwd"><b>Contact No:</b></label>
                            <input type="text" class="form-control" name="phone" id="phone" value="<?php echo $r['phone']?>">
                        </div>
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <div class="form-group">
                            <label for="studentType"><b>Category:</b></label>
                            <select class="form-control" id="SelectDepartment" name="category">
							<option selected value="<?php echo $r['category']?>"><?php echo $r['category']?></option>
                                <option value="Professional">Professional/Engineers</option>
                                <option value="Faculty">Faculty </option>
								<option value="K-12 Teachers">K-12 Teachers </option>
                                <option value="Student">Student</option>
                                <option value="Pre-Service teacher">Pre-Service Teacher</option>
								<option value="Others">Others</option>
                            </select>
                        </div>

                    </td>
                </tr>

               <tr>
                    <td colspan="2">
                        <div class="form-group">
                            <label for="studentType"><b>Judge Confirm:</b></label>
                            <select class="form-control" id="SelectDepartment" name="judge_confirm">
							<?php if($r['judge_confirm'] = 'Y')
							{
								$val = 'Yes';
							}
							else
								{
								$val='No';
								}?>
							<option selected value="<?php echo $r['judge_confirm']?>"><?php echo $val?></option>
							    <option value="Y">Yes</option>
                                <option value="N">No</option>
                            </select>
                        </div>

                    </td>
                </tr>

            </table>

            <div id="alertBox"> </div>
            <button type="submit" class="btn btn-primary" name="submit">Submit</button>
			</form>
        </div>
    </div>

    <!-- <div class="container d-flex justify-content-center col-md-8">
        <p class="dbtn">
            <button type="button" id="signout-btn" onclick="signOutUser()" class="btn btn-danger"> SignOut </button>
        </p>
    </div> -->




    
    <!-- TODO: Add SDKs for Firebase products that you want to use
     https://firebase.google.com/docs/web/setup#config-web-app -->
</div>
</body>
</html>


update_evaluation_team
<?php 
include('../database/config.php'); 
include('control.php'); 

$id = $_SESSION['id'];
$user_id = $_GET['judge_id'];
$name=$_SESSION['name'];
$team_id = $_GET['team_id'];

$q_e = mysqli_query($con,"select * from tbl_judge_assessment where user_id = $user_id and team_id = $team_id");
$d_e = mysqli_fetch_assoc($q_e);
$e_id = $d_e['id'];
$team= $d_e['team_id'];
$v_q = mysqli_query($con,"select * from tbl_team where id = $team_id");
$v_d = mysqli_fetch_assoc($v_q);

$video_pitch = $v_d['video_pitch'];
				$url = $video_pitch;
				preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $url, $match);
				$youtube_id = $match[1];

extract($_POST);
if(isset($_POST['submit']))
{
	if ($identifying_understanding == '')
	{
		$identifying_understanding = 'NULL';
	}
	if($ideating == '')
	{
		$ideating = 'NULL';
	}
	if($designing_building == '')
	{
		$designing_building = 'NULL';
	}
	if($testing_refinging == '')
	{
		$testing_refinging = 'NULL';
	}
	if($value_propoition == '')
	{
		$value_propoition = 'NULL';
	}
	if($market_potential == '')
	{
		$market_potential = 'NULL';
	}
	if($social_value == '')
	{
		$social_value = 'NULL';
	}
	if($originality == '')
	{
		$originality = 'NULL';
	}
	if($logbook == '')
	{
		$logbook = 'NULL';
	}
	if($display_board == '')
	{
		$display_board = 'NULL';
	}
	if($prototype == '')
	{
		$prototype = 'NULL';
	}
	if($online_pitch == '')
	{
		$online_pitch = 'NULL';
	}
		
	$question_asked = mysqli_real_escape_string($con,$question_asked);				
			$r = "update tbl_judge_assessment set
                                 	identifying_understanding = $identifying_understanding,
	                                ideating = $ideating,
									designing_building = $designing_building,
									testing_refinging = $testing_refinging,
									value_propoition = $value_propoition,
									market_potential = $market_potential,
									social_value = $social_value,
									originality = $originality,
									logbook = $logbook,
									display_board = $display_board,
									prototype = $prototype,
									online_pitch = $online_pitch,
									question_asked = '$question_asked' where id = $e_id";
				$update = mysqli_query($con,$r);
	if($update)
	{
		echo"<script>alert('Updated Evaluation Entered Successfully')</script>";
		#echo $r;
		echo "<script type='text/javascript'> document.location = 'home.php'; </script>";
	}
	else 
	{
		echo"<script>alert('Evaluation Updation Failed')</script>";
	}

	
}




?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Evaluation Details</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="css/style.css" type="text/css">
</head>

<style>
html, body {
    top:0;
    bottom:0;
    left:0;
    right:0;
    
   
}
</style>
<body>
<div id="wrapper">
    <div class="jumbotron col-md-12" style="font-size: 16px;
    height: 10em;margin-block-start: -55px;">
       <img class="card-img-top" src="images/emulogo.png" alt="logo image" style="width:99%;height: 226px;">
    </div>

	

	

	


		

    <div class="container d-flex justify-content-left col-md-10">
		<div class="col-7">
		<table class="table table-borderless" style="margin-left: -110px;">
                <thead class="thead-dark" id="table">
                    <tr>
						<!--<th scope="col">Team ID</th>-->
                        <th scope="col">Team Name</th>
						<th scope="col">Project Description</th>
						<th scope="col">Team Cateogory</th>
                        <!--<th scope="col">Video Pitch</th>-->
                        <th scope="col">LogBook</th>
						<!--<th scope="col">Team Members</th>-->
                       
                    </tr>
                </thead>
				<tbody> 
				
				<?php 
				$team_id = $d_e['team_id'];
				$q_team = mysqli_query($con,"
                SELECT DISTINCT
                tt.id AS team_id,
                tt.project_team_name AS project_name,
                tt.category,
                tt.project_description,
                tu.first_name,
                tu.last_name,
                tt.video_pitch,
                tt.log_book
            FROM
                tbl_team tt
                INNER JOIN tbl_team_mentor ttm ON tt.id = ttm.team_id
                INNER JOIN tbl_user tu ON ttm.user_id = tu.id
            WHERE
                tt.id = $team_id
            

									");	  
									
				while ($r_team = mysqli_fetch_assoc($q_team))					
				{
					$team_id = $r_team['team_id'];
				$team_m_q = mysqli_query($con, "select GROUP_CONCAT(student_first_name) as members from tbl_team_member where team_id = $team_id");
				$team_m_r = mysqli_fetch_assoc($team_m_q);
				
				?>
											
												<tr> 
													<!--<td><?php echo $r_team['team_id']?></a></td> -->
													<td><?php echo $r_team['project_name']?></a></td> 
													<td><?php echo $r_team['project_description']?></td> 
													<td><?php echo $r_team['category']?></td>
													<!--<td><iframe frameborder="0" height="100" width="100" 
														src="https://www.youtube.com/embed/sA9DwvbQ-hI">
													  </iframe></a></td> -->
																	<?php if ($r_team['log_book']!='') {?>
													<td><a href="http://grading.emuem.org/Team/<?php echo $r_team['log_book']?>" target="_blank">LogBook</a></td>  
											<?php } else {?>
													<td>LogBook</td>  
											<?php }?>
													<!--<td><?php echo $team_m_r['members']?></td>  -->
													
												</tr> 
				<?php } ?>								
				
												
											</tbody> 
            </table>
			
			
		          

            <!--<div class="form-group">
                <label for="studentType">Select Account Type:</label>
                <select class="form-control" id="accountType">
                    <option>Select account type</option>
                    <option value="superUser">Super User</option>
                    <option value="administrator">Administrator</option>
                    <option value="student">Student</option>
                </select>
            </div>-
			<table  class="table table-borderless" style="margin-right: 547px;margin-bottom: -52px;margin-right: -474px;">
				<tr>
				<td colspan="-4">
				<div class="form-group">
					<iframe frameborder="0" height="100" width="100" 
														src="https://www.youtube.com/embed/sA9DwvbQ-hI">
													  </iframe>
            </div>
				</td>
				</tr>		
			</table>-->	
            <table class="table" style="margin-left: -110px;">
            <h3> Evaluation:</h3>
				
				
				<form method="post" enctype="multipart/form-data" >
				
                <thead class="thead-dark">
                    <tr>
					   <th colspan="24"> Invention Process (45) </th>
					</tr>
				</thead>
					
                <tr>
				
								
                    <td colspan="6">
                     
                            <label for="email">Identifying & Understanding: </label>
                            <select name="identifying_understanding" style="margin-left: 31px">
							<option value="<?php echo $d_e['identifying_understanding']?>" selected><?php echo $d_e['identifying_understanding']?></option>
							<?php 

								for($i=0; $i<=15; $i=$i+0.5)
								{

									echo "<option value=".$i.">".$i."</option>";
								}
								?> 
                        
                    </td>
				</tr>	
				<tr>
                    
                    <td colspan="6">
                        
                            <label for="email"> Designing & Building: </label>
                            <select name="designing_building" style="margin-left: 84px">
							<option value="<?php echo $d_e['designing_building']?>" selected><?php echo $d_e['designing_building']?></option>
							<?php 

								for($i=0; $i<=10;$i=$i+0.5)
								{

									echo "<option value=".$i.">".$i."</option>";
								}
								?> 
                       
                    </td>
					</tr>
					<tr>
                    <td colspan="6">
                        
                            <label for="email">  Testing & Refining:  </label>
                            <select name="testing_refinging" style="margin-left: 104px">
							<option value="<?php echo $d_e['testing_refinging']?>" selected><?php echo $d_e['testing_refinging']?></option>
							<?php 

								for($i=0; $i<=10;$i=$i+0.5)
								{

									echo "<option value=".$i.">".$i."</option>";
								}
								?> 
                        
                    </td>
					</tr>	
				<tr>
					<td colspan="6">
                        
                            <label for="email">  Ideating Process:  </label>
                            <select  name="ideating" style="margin-left: 116px">
							<option value="<?php echo $d_e['ideating']?>" selected><?php echo $d_e['ideating']?></option>
							<?php 

								for($i=0; $i<=10;$i=$i+0.5)
								{

									echo "<option value=".$i.">".$i."</option>";
								}
								?> 
                        
                    </td>
					
                </tr>

                

                   <thead class="thead-dark">
                    <tr>
                        <th colspan="24"> Invention Impact (25) </th>
                     </tr>
                    </thead>

                <tr>
                    <td colspan="4">
                            <label for="email">Value Proposition:</label>
                            <select name="value_propoition" style="margin-left: 104px">
							<option value="<?php echo $d_e['value_propoition']?>" selected><?php echo $d_e['value_propoition']?></option>
							<?php 

								for($i=0; $i<=5;$i=$i+0.5)
								{

									echo "<option value=".$i.">".$i."</option>";
								}
								?> 
                        
                    </td>
				</tr>	
				<tr>
                    
                    <td colspan="4">
                            <label for="email">Market Potential:</label>
                            <select  name="market_potential" style="margin-left: 112px">
							<option value="<?php echo $d_e['market_potential']?>" selected><?php echo $d_e['market_potential']?></option>
							<?php 

								for($i=0; $i<=5;$i=$i+0.5)
								{

									echo "<option value=".$i.">".$i."</option>";
								}
								?> 
                        
                    </td>
					
					</tr>	
				<tr>
					
                    <td colspan="4">
                            <label for="email">Social Value: </label>
                            <select  name="social_value" style="margin-left: 143px">
							<option value="<?php echo $d_e['social_value']?>" selected><?php echo $d_e['social_value']?></option>
							<?php 

								for($i=0; $i<=5;$i=$i+0.5)
								{

									echo "<option value=".$i.">".$i."</option>";
								}
								?> 
                        
                    </td>
                </tr>	
				<tr>
                    <td colspan="4">
                            <label for="email">Originality: </label>
                            <select  name="originality" style="margin-left: 153px">
							<option value="<?php echo $d_e['originality']?>" selected><?php echo $d_e['originality']?></option>
							<?php 

								for($i=0; $i<=10;$i=$i+0.5)
								{

									echo "<option value=".$i.">".$i."</option>";
								}
								?> 
                        
                    </td>
                </tr>

                

            
			
			
			      <thead class="thead-dark">
                    <tr>
                        <th colspan="24"> Inventor Communication (30) </th>
                     </tr>
                    </thead>

                <tr>
                    <td colspan="4">
                        
                            <label for="email">LogBook: </label>
                            <select name="logbook" style="margin-left: 164px">
							<option value="<?php echo $d_e['logbook']?>" selected><?php echo $d_e['logbook']?></option>
							<?php 

								for($i=0; $i<=5;$i=$i+0.5)
								{

									echo "<option value=".$i.">".$i."</option>";
								}
								?> 
                        
                    </td>
				</tr>
                <tr>    
                
                    <td colspan="4">
                        
                            <label for="email">Display Board: </label>
                            <select  name="display_board" style="margin-left: 127px">
							<option value="<?php echo $d_e['display_board']?>" selected><?php echo $d_e['display_board']?></option>
							<?php 

								for($i=0; $i<=5;$i=$i+0.5)
								{

									echo "<option value=".$i.">".$i."</option>";
								}
								?> 
                        
                    </td>
					</tr>
                <tr>    
                    <td colspan="4">
                        
                            <label for="email">  Prototype:  </label>
                            <select  name="prototype" style="margin-left: 152px">
							<option value="<?php echo $d_e['prototype']?>" selected><?php echo $d_e['prototype']?></option>
							<?php 

								for($i=0; $i<=5;$i=$i+0.5)
								{

									echo "<option value=".$i.">".$i."</option>";
								}
								?> 
                        
                    </td>
					</tr>
                <tr>    
                    <td colspan="4">
                        
                            <label for="email"> Online Pitch: </label>
                            <select  name="online_pitch" style="margin-left: 135px">
							<option value="<?php echo $d_e['online_pitch']?>" selected><?php echo $d_e['online_pitch']?></option>
							<?php 

								for($i=0; $i<=5;$i=$i+0.5)
								{

									echo "<option value=".$i.">".$i."</option>";
								}
								?> 
                        
                    </td>
					</tr>
					<tr>
                    <td colspan="8">
					
					
					
					
                        <div class="form-group">
                            <label for="email"> Q&A:  </label>
							
							<textarea  style="margin-left: 180px;
    width: 360px;
    height: 200px;" placeholder="Questions that are to be asked during Live Q & A" name="question_asked">
							<?php echo $d_e['question_asked']?>
							</textarea>
						
						</div>	
					</td>	
					</tr>
                <tr>    		
						<br>
						 <!--<td colspan="4">
					    
						<label for="email"> Live Pitch and Q&A Score: </label>
                            <select  name="live_qa" style="margin-left: 36px">
							<option value="0" selected><?php echo $d_e['live_qa']?></option>
							<?php 

								for($i=0; $i<=10;$i=$i+0.5)
								{

									echo "<option value=".$i.">".$i."</option>";
								}
								?> 
                        
						</td>-->
                    
               
				
				
				</tr>
				
				<tr>
				<td>
				<div class="form-group">
				<button type="submit" class="btn btn-primary" name="submit">Submit Evaluation</button>	
				</div>
				</td>
				</tr>

            
        
				<!--</td>
				</tr>-->
				</form>
			</table>
              
		
			
		
		
    
				
    </div>   
	
	<div class="col-9">	
		<table class="table table-borderless">
		<br>
            <h3>Video Pitch:</h3>
           <br>
		<br>
		<?php if ($youtube_id == '') {?>
		<div class="form-group">
			<video width="500" height="400" controls>
			  <source src="<?php echo '../Team/'.$video_pitch?>" type="video/mp4">
			  <source src="<?php echo '../Team/'.$video_pitch?>" type="video/ogg">
			</video>
				</div>	
		<?php } else {?>		
		<div class="form-group">
			<iframe width="500" height="400" src="https://www.youtube.com/embed/<?php echo $youtube_id?>" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
				</div>	
		<?php }?>
		<p>Don't forget to click on "Submit Evaluation" to record your evaluation.</p>
		</table>		
    </div>  
	</div>
</body>
</html>


approve.php 
<?php
$tab = $_GET['table'];
$id = $_GET['id'];
$return = $_GET['return'];
$flag = $_GET['flag'];
#echo $return;
include('../database/config.php'); 
include('control.php'); 


$q = mysqli_query($con,"update tbl_user set is_approved = $flag where id = $id");
if($q)
{
	$query = mysqli_query($con, "select * from tbl_user where id = $id");
	$row = mysqli_fetch_assoc($query);
	
		  $to = $row['email'];
		  $username = $row['email'];
		  $password = $row['password'];
		  $name = $row['first_name'];
		  $user_type = $row['user_type'];
		  if($flag == 1)
		  {
	
	      	
		
         $subject = "EMUiNVENT User Registration-Acceptance";
        // $body = "Dear $name,
		//We are excited to welcome your team(s) for participation in the EMUiNVENT competition. Please login using  :Username: $username, Password: $password @ http://grading.emuem.org/login.php to provide all details of the participating teams. Closer to the video submission deadline, you will receive another email with details of submission.EMUiNVENT 2021 will be entirely online. So please make sure you visit the submission system and provide all the information and materials in a timely manner.After the submission of videos is completed, a panel of professionals will judge all student projects. We will announce awards and winners in a broadcasted awards ceremony on March 12. You will receive more details about the ceremony and how to access it in the coming weeks.For more information and all deadlines, visit the https://emich.edu/emuinvent website. If you have questions, please email emu_invent@emich.edu.
		//EMUiNVENT Team";
		// To send HTML mail, the Content-type header must be set
		$headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		 
		if(($user_type) == 'Mentor')	  { 	 
		// Compose a simple HTML email message
		$message = '<html><body>';
		$message .= '<p style="color:#080;font-size:18px;">Dear '.$name.',</p>';
		$message .= '<p style="color:#080;font-size:18px;">We are excited to welcome your team(s) for participation in the EMUiNVENT competition.</p>';
		$message .= '<p style="color:#080;font-size:18px;">Please login using the following credentials @ <a href="http://grading.emuem.org/login.php">EMUiNVENT Login</a>:';
		$message .='<p style="color:#080;font-size:18px;">Username: '.$username.', Password: '.$password.' to provide all details of the participating teams.</p>';
		$message.= ' <p style="color:#080;font-size:18px;">Closer to the video submission deadline, you will receive another email with details of submission.</p>
		<p style="color:#080;font-size:18px;">EMUiNVENT 2021 will be entirely online. So please make sure you visit the submission system and provide all the information and materials in a timely manner.</p>
		<p style="color:#080;font-size:18px;">After the submission of videos is completed, a panel of professionals will judge all student projects. We will announce awards and winners in a broadcasted awards ceremony on March 12. </p>
		<p style="color:#080;font-size:18px;">You will receive more details about the ceremony and how to access it in the coming weeks.For more information and all deadlines, visit the <a href="https://emich.edu/emuinvent">EMUiNVENT website</a>. If you have questions, please email emu_invent@emich.edu.</p>';
		$message .= '<br><p style="color:#080;font-size:18px;">EMUiNVENT</p>';	
		$message .= '</body></html>';	
		}
	else {
		$message = '<html><body>';
		$message .= '<p style="color:#080;font-size:18px;">Dear '.$name.',</p>';
		$message .= '<p style="color:#080;font-size:18px;">We are excited to welcome you to EMUiNVENT website. You should be able to view student presentation from this year & previous year.</p>';
		$message .= '<p style="color:#080;font-size:18px;">Please login using the following credentials @ <a href="http://grading.emuem.org/login.php">EMUiNVENT Login</a>:';
		$message .='<p style="color:#080;font-size:18px;">Username: '.$username.', Password: '.$password.'.</p>';
		$message.= '<p style="color:#080;font-size:18px;"> If you have questions, please email emu_invent@emich.edu.</p>';
		$message .= '<br><p style="color:#080;font-size:18px;">EMUiNVENT</p>';	
		$message .= '</body></html>';
		
	}		
        if (mail($to, $subject, $message, $headers)) {
		
		  echo 'Your mail has been sent successfully.';
				
			
        //$message ="Dear $name,
		//We are excited to welcome your team(s) for participation in the EMUiNVENT competition. Please login using  :Username: $username, Password: $password @ http://grading.emuem.org/login.php to provide all details of the participating teams. Closer to the video submission deadline, you will receive another email with details of submission.EMUiNVENT 2021 will be entirely online. So please make sure you visit the submission system and provide all the information and materials in a timely manner.After the submission of videos is completed, a panel of professionals will judge all student projects. We will announce awards and winners in a broadcasted awards ceremony on March 12. You will receive more details about the ceremony and how to access it in the coming weeks.For more information and all deadlines, visit the https://emich.edu/emuinvent website. If you have questions, please email emu_invent@emich.edu.
		//EMUiNVENT Team";
         } else {
       echo 'Unable to send email. Please try again.';
         }
		
	}
	 else 
		{
		 $subject = "EMUiNVENT User Registration-Rejection";
        $headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		 
		if(($user_type) == 'Mentor')	  { 	 
		// Compose a simple HTML email message
		$message = '<html><body>';
		$message .= '<p style="color:#080;font-size:18px;">Dear '.$name.',</p>';
		$message .= '<p style="color:#080;font-size:18px;">Thank you for signing up to participate in EMUiNVENT. We reviewed the information you provided. Unfortunately, at this time you do not meet the requirements for participation in EMUiNVENT.  </p>';
		$message.= ' <p style="color:#080;font-size:18px;">If you think this is in error or if you can provide more information about your eligibility, please email us at emu_invent@emich.edu</p>
		<p style="color:#080;font-size:18px;">EMUiNVENT 2021 will be entirely online.</p>
		<p style="color:#080;font-size:18px;">For more information and all deadlines, visit the <a href="https://emich.edu/emuinvent">EMUiNVENT website</a>. If you have questions, please email emu_invent@emich.edu.</p>';
		$message .= '<br><p style="color:#080;font-size:18px;">EMUiNVENT</p>';	
		$message .= '</body></html>';	
		}
		else {
		$message = '<html><body>';
		$message .= '<p style="color:#080;font-size:18px;">Dear '.$name.',</p>';
		$message .= '<p style="color:#080;font-size:18px;">Thank you for your interest in the EMUiNVENT. Unfortunately we will not be able to approve your registration request.</p>';
		$message.= '<p style="color:#080;font-size:18px;">If you have questions, please email emu_invent@emich.edu.</p>';
		$message .= '<br><p style="color:#080;font-size:18px;">EMUiNVENT</p>';	
		$message .= '</body></html>';		
		}
        if (mail($to, $subject, $message, $headers)) {
		
		  echo 'Your mail has been sent successfully.';
				
			
        //$message ="Dear $name,
		//We are excited to welcome your team(s) for participation in the EMUiNVENT competition. Please login using  :Username: $username, Password: $password @ http://grading.emuem.org/login.php to provide all details of the participating teams. Closer to the video submission deadline, you will receive another email with details of submission.EMUiNVENT 2021 will be entirely online. So please make sure you visit the submission system and provide all the information and materials in a timely manner.After the submission of videos is completed, a panel of professionals will judge all student projects. We will announce awards and winners in a broadcasted awards ceremony on March 12. You will receive more details about the ceremony and how to access it in the coming weeks.For more information and all deadlines, visit the https://emich.edu/emuinvent website. If you have questions, please email emu_invent@emich.edu.
		//EMUiNVENT Team";
         } else {
       echo 'Unable to send email. Please try again.';
         }
		}			
		
}
else {
	
}
mysqli_close($con);
echo "<script>alert('Updated Sucessfully')</script>";

ob_start();   
 if(strpos($return,'.php')!==false)
{
	header("location:$return");
}else
{
header("location: $return.php");   
}
 ob_flush();
      exit(0);
?>

<?php
include('../database/config.php'); 
include('control.php'); 

$id = $_SESSION['id'];
$team_id = $_GET['team_id'];
$name = $_SESSION['name'];
$q_vt = mysqli_query($con,"select distinct tt.id as team_id,tt.project_team_name as project_name,tt.project_description,tu.first_name, tu.last_name,tt.video_pitch, tt.log_book,tu.email 
from tbl_team tt, tbl_team_mentor ttm, tbl_user tu
											where tt.id = $team_id
											and tt.id = ttm.team_id
											and ttm.user_id = tu.id");

$d_vt = mysqli_fetch_assoc($q_vt);


$url = $d_vt['video_pitch'];
if (preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $url, $match))
	{
	$youtube_id = $match[1];
	}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Team Lists</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="css/style.css" type="text/css">
</head>

<div id="wrapper">
<body>

   <div class="jumbotron col-md-12" style="font-size: 16px;
    height: 10em;margin-block-start: -55px;">
       <img class="card-img-top" src="images/emulogo.png" alt="logo image" style="width:99%;height: 226px;">
    </div>

	<nav class="navbar navbar-expand bg-dark navbar-dark" style="    margin-top: 140px;
    width: 1289px;
    left: 2.3%;">
        <!-- Links -->
        <ul class="navbar-nav">

            <li class="nav-item" style="font-weight: bold;">
                <a class="nav-link" href="home.php">Home</a>
            </li>
			
			
			<li class="nav-item dropdown" style="font-weight: bold;">
                <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                    Add
                </a>
                <div class="dropdown-menu"  id="mainNavbar">
                    <!--<a class="dropdown-item" href="teams.php">Teams</a>-->
                    <a class="dropdown-item" href="add_judges.php">Judges</a>
                </div>
            </li>
			
			
			<li class="nav-item dropdown" style="font-weight: bold;">
                <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                    View
                </a>
                <div class="dropdown-menu"  id="mainNavbar">
                    <a class="dropdown-item" href="teams.php">Teams</a>
                    <a class="dropdown-item" href="judges.php">Judges</a>
                </div>
            </li>
			
			
			<li class="nav-item dropdown" style="font-weight: bold;">
                <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                    Assign Teams vs Judges
                </a>
                <div class="dropdown-menu"  id="mainNavbar">
                    <a class="dropdown-item" href="assign_judge_team.php">Assign Teams vs Judges</a>
                    <a class="dropdown-item" href="view_judge_team.php">View Assigned Teams vs Judges</a>
                </div>
            </li>
			
			<li class="nav-item" style="font-weight: bold;">
                <a class="nav-link" href="liveqa_teams.php">Live QA</a>
            </li>
			
			<li class="nav-item" style="font-weight: bold;">
                <a class="nav-link" href="evaluation_results.php">Evaluation Details</a>
            </li>
			
			 <li class="nav-item dropdown" style="font-weight: bold;">
                <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                    <?php echo $name?>
                </a>
                <div class="dropdown-menu"  id="mainNavbar">
					<a class="dropdown-item" href="profile.php">Profile</a>
                    <a class="dropdown-item" href="logout.php">Logout</a>
                    
                </div>
            </li>

            <!--<li class="nav-item">
                <a class="nav-link" href="addStudent.html">Add Student</a>
            </li>

            <li class="nav-item" id="addAccount">
				<a class="nav-link" href="addUser.html">Add Account</a>
            </li>-->
        </ul>
    </nav>
    <br>

 <div class="container d-flex justify-content-left col-md-12">
        <div class="col-12" id="editDetails">
            <br>
            <h3>View Team:</h3>
            <br>

            <table class="table table-borderless">

                <thead class="thead-dark">
                    <tr>
                        <th colspan="3"> Basic Information </th>
                     </tr>
                    </thead>

                <tr>
                    <td>
                        <div class="form-group">
                            <label for="email"> <b> Mentor Name: </b> </label>
                            <input type="text" readonly class="form-control" id="studentName" value="<?php echo $d_vt['first_name'].' '.$d_vt['last_name']?>" placeholder="Enter your name">
                        </div>
                    </td>

                    <td>
                        <div class="form-group">
                            <label for="email"><b> Mentor Email:</b></label>
                            <input type="text" readonly class="form-control" id="studentFN" value="<?php echo $d_vt['email']?>"
                                placeholder="Enter your Father's name">
                        </div>
                    </td>

                    <td>
                        <div class="form-group">
                            <label for="email"><b> Project Title:</b></label>
                            <input type="text" readonly class="form-control" id="studentRegNo" value="<?php echo $d_vt['project_name']?>" placeholder="Enter student registration number">
                        </div>
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <div class="form-group">
                            <label for="email"><b>Project Description:</b></label>
                            <textarea class="form-control" readonly><?php echo $d_vt['project_description']?></textarea>
                        </div>
                    </td>
                </tr>

                <tr>
                    <td>
					<!--<div class="form-group">
					   <video width="624" height="352" controls>
						<source src="https://www.youtube.com/watch?v=sA9DwvbQ-hI" type="video/mp4">
						Your browser does not support the video tag.
						</video>
					</div>-->
					<?php if ($youtube_id=='') {?>
	                	        <div class="form-group">
	                		<video width="200" height="200" controls>
	                		  <source src="http://grading.emuem.org/Team/<?php echo $d_vt['video_pitch']?>" type="video/mp4">
	                		  <source src="http://grading.emuem.org/Team/<?php echo $d_vt['video_pitch']?>" type="video/ogg">
	                		</video>
	                			</div>	
	                	<?php } else {?>		
	                	<div class="form-group">
	                		<iframe width="200" height="200" src="https://www.youtube.com/embed/<?php echo $youtube_id?>" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
	                			</div>	
	                	<?php }?>
                            
                        <!--<div >
                            <label for="pwd"><b>Video Pitch:</b></label>
                            <input type="text" class="form-control" id="studentEmail" placeholder="Enter your email">
                        </div>-->
                    </td>

                    <td>
					  <div class="form-group">
                            <label for="pwd"><b>LogBook:</b></label>
                           <a href="http://grading.emuem.org/Team/<?php echo $d_vt['log_book']?>" target="_blank">LogBook</a>
                        </div>
                    </td>
                     </tr>

                         <tr>
                    <td>
                        <!--<div class="form-group">
                            <label for="pwd"><b>Upload File/Photo (MAX LIMIT: 2MB)</label>
                            <input type="file" class="form-control" id="uploadFile" multiple> <br>
                        <button type="submit" class="btn btn-info" id="uploadButton">Upload</button>
                        </div>-->
                    </td>

                   <!-- <td>
                        <p id="uploadStatus"></p>
                         </td>-->
                         </tr>

            </table>

            <!-- Basic Requirments for students ends here -->




            <!-- Requirments for current students -->

            <table class="table table-borderless currentShow" style="margin-top: -98px;">

                <thead class="thead-dark">
                    <tr>
                        <th colspan="3"> Team Members. </th>
                     </tr>
                    </thead>

				<br>
				<?php
				$t_q = mysqli_query($con,"select * from tbl_team_member where team_id = $team_id")	;
				$i=1;
				while ($row = mysqli_fetch_assoc($t_q))
				{
				
				?>
				<thead class="thead-light">
                    <tr>
                        <th colspan="3"> Student - <?php echo $i?></th>
					</tr>
                </thead>
					
                <tr>
                    <td>
                        <div class="form-group currentShow" >
                            <label for="email"><b>Student First Name:</b></label>
                            <input type="text" readonly class="form-control" id="yearOfAdmissionInNed"
                                value="<?php echo $row['student_first_name']?>" placeholder="Year of Admission In NED">
                        </div>
						
						
						
                    </td>
					
					<td>
                        <div class="form-group currentShow" >
                            <label for="email"><b>Student Last Name:</b></label>
                            <input type="text" readonly class="form-control" id="yearOfAdmissionInNed"
                                value="<?php echo $row['student_last_name']?>" placeholder="Year of Admission In NED">
                        </div>
						
						
						
                    </td>

                    <td>
					
					
                        <div class="form-group currentShow" >
                            <label for="email"><b>Grade:</b></label>
                            <input type="text" readonly class="form-control" id="studentRoll" value="<?php echo $row['student_grade']?> Grade" placeholder="Enter your Roll No">
                        </div>
                    </td>
                   
                </tr>

                <tr>
				
				
					 <td>
                        <div class="form-group currentShow" >
                            <label for="email"><b>Student School District:</b></label>
                            <input type="text" readonly class="form-control" id="noOfSiblings" value="<?php echo $row['student_school_district']?>" placeholder="">
                        </div>
                    </td>
					
                    <td>
                        <div class="form-group currentShow" >
                            <label for="pwd"><b>Student School Name:</b></label>
                            <input type="text" readonly class="form-control" id="monthlyIncomeParents"
                               value="<?php echo $row['student_school_name']?>" placeholder="Enter your parent's monthly income.">
                        </div>
                    </td>
					
					<td>
                        <div class="form-group currentShow" >
                            <label for="pwd"><b>Student School County:</b></label>
                            <input type="text" class="form-control" id="monthlyIncomeParents"
                                value="<?php echo $row['student_school_county']?>" readonly placeholder="Enter your parent's monthly income.">
                        </div>
                    </td>

                    
                </tr>

                <tr>
				<td>
                        <div class="form-group" id="mRent">
                            <label for="pwd"><b>T-shirt Size:</b></label>
                            <input type="text" readonly class="form-control" id="monthlyRent"
                                placeholder="Enter your monthly house rent" value="<?php echo $row['t_shirt_size']?>">
                        </div>
                    </td>
				</tr>
				<br>			
                <!-- S1 Starts Here -->
				
                <?php $i++;} ?>

            </table>

            

            
        </div>

    </div>

    <!-- <div class="container d-flex justify-content-center col-md-8">
        <p class="dbtn">
            <button type="button" id="signout-btn" onclick="signOutUser()" class="btn btn-danger"> SignOut </button>
        </p>
    </div> -->
</body>
</div>
</html>	


assign_judge_team

<?php
include('../database/config.php'); 
include('control.php'); 

$id = $_SESSION['id'];
$name = $_SESSION['name'];

extract($_POST);
if(isset($_POST['submit']))
{	
$judge_id = $_POST['judge_id'];
$team_id_1 = $_POST['team_id_1'];
$team_id_2 = $_POST['team_id_2'];
$team_id_3 = $_POST['team_id_3'];
$team_id_4 = $_POST['team_id_4'];
$team_id_5 = $_POST['team_id_5'];
$team_id_6 = $_POST['team_id_6'];
#echo $judge_id;
#$teams = $_POST['team_id'];
if ($team_id_1 != ''){
#echo $i;
$sql = "INSERT INTO `tbl_judge_team` (`team_id`,`user_id`) VALUES ('$team_id_1','$judge_id')";
$c = mysqli_query($con,$sql);
#$jt_id = mysqli_insert_id;
}
if ($team_id_2 != ''){
#echo $i;
$sql = "INSERT INTO `tbl_judge_team` (`team_id`,`user_id`) VALUES ('$team_id_2','$judge_id')";
$c = mysqli_query($con,$sql);
#$jt_id = mysqli_insert_id;
}
if ($team_id_3 != ''){
#echo $i;
$sql = "INSERT INTO `tbl_judge_team` (`team_id`,`user_id`) VALUES ('$team_id_3','$judge_id')";
$c = mysqli_query($con,$sql);
#$jt_id = mysqli_insert_id;
}
if ($team_id_4 != ''){
#echo $i;
$sql = "INSERT INTO `tbl_judge_team` (`team_id`,`user_id`) VALUES ('$team_id_4','$judge_id')";
$c = mysqli_query($con,$sql);
#$jt_id = mysqli_insert_id;
}
if ($team_id_5 != ''){
#echo $i;
$sql = "INSERT INTO `tbl_judge_team` (`team_id`,`user_id`) VALUES ('$team_id_5','$judge_id')";
$c = mysqli_query($con,$sql);
#$jt_id = mysqli_insert_id;
}
if ($team_id_6 != ''){
#echo $i;
$sql = "INSERT INTO `tbl_judge_team` (`team_id`,`user_id`) VALUES ('$team_id_6','$judge_id')";
$c = mysqli_query($con,$sql);
#$jt_id = mysqli_insert_id;
}


}




?>


<!DOCTYPE html>
<html lang="en">

<head>
    <title>Edit Profile</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="css/style.css" type="text/css">
</head>

<style>
html, body {
    top:0;
    bottom:0;
    left:0;
    right:0;
    
   
}
</style>
<script type="text/javascript">
$(document).ready(function(){
var team = [];
var cat = '';
$('#team_category').on('change',function(){
var category = $(this).val();
//alert(category);
if(category){
	    
	
						$.ajax({
							type:'POST',
							url:'ajaxData_cat.php',
							data:'cat='+category,
							success:function(html){
								$('#team_id_1').html(html);
							}
						}); 
					}else{
						category = '';
						cat = category;
						$.ajax({
							type:'POST',
							url:'ajaxData.php',
							data:'cat='+category,
							success:function(html){
								$('#team_id_1').html(html);
							}
						}); 
}



$('#team_id_1').on('change',function(){
    var team1_id = $(this).val();
    if(team1_id){
	//alert(team1_id);
	team.push(team1_id);
	console.log(team);
	dataString = team;
	console.log(cat);
							$.ajax({
							type:'POST',
							url:'ajaxData_team2.php',
							data:  {id_data :JSON.stringify(dataString), caty: cat}, 
							success:function(html){
								$('#team_id_2').html(html);
							}
						}); 
					}else{
						alert('going in else');
						$.ajax({
							type:'POST',
							url:'ajaxData.php',
							data:'cat='+cat,
							success:function(html){
								$('#team_id_2').html(html);
							}
						}); 
					}

});

$('#team_id_2').on('change',function(){
var team2_id = $(this).val();
if(team2_id){
	//alert(team2_id);
	team.push(team2_id);
	console.log(team);
	dataString = team;
	console.log(cat);
							$.ajax({
							type:'POST',
							url:'ajaxData_team3.php',
							data:  {id_data :JSON.stringify(dataString), caty: cat}, 
							success:function(html){
								$('#team_id_3').html(html);
							}
						}); 
					}else{
						alert('going in else');
						$.ajax({
							type:'POST',
							url:'ajaxData.php',
							data:'cat='+cat,
							success:function(html){
								$('#team_id_3').html(html);
							}
						}); 
					}

});

$('#team_id_3').on('change',function(){
var team3_id = $(this).val();
if(team3_id){
	//alert(team3_id);
	team.push(team3_id);
	console.log(team);
	dataString = team;
	console.log(cat);
							$.ajax({
							type:'POST',
							url:'ajaxData_team4.php',
							data:  {id_data :JSON.stringify(dataString), caty: cat}, 
							success:function(html){
								$('#team_id_4').html(html);
							}
						}); 
					}else{
						alert('going in else');
						$.ajax({
							type:'POST',
							url:'ajaxData.php',
							data:'cat='+cat,
							success:function(html){
								$('#team_id_4').html(html);
							}
						}); 
					}

});

$('#team_id_4').on('change',function(){
var team4_id = $(this).val();
if(team4_id){
	//alert(team4_id);
	team.push(team4_id);
	console.log(team);
	dataString = team;
	console.log(cat);
							$.ajax({
							type:'POST',
							url:'ajaxData_team5.php',
							data:  {id_data :JSON.stringify(dataString), caty: cat}, 
							success:function(html){
								$('#team_id_5').html(html);
							}
						}); 
					}else{
						alert('going in else');
						$.ajax({
							type:'POST',
							url:'ajaxData.php',
							data:'cat='+cat,
							success:function(html){
								$('#team_id_5').html(html);
							}
						}); 
					}

});

$('#team_id_5').on('change',function(){
var team5_id = $(this).val();
if(team5_id){
	//alert(team5_id);
	team.push(team5_id);
	console.log(team);
	dataString = team;
	console.log(cat);
							$.ajax({
							type:'POST',
							url:'ajaxData_team5.php',
							data:  {id_data :JSON.stringify(dataString), caty: cat}, 
							success:function(html){
								$('#team_id_6').html(html);
							}
						}); 
					}else{
						alert('going in else');
						$.ajax({
							type:'POST',
							url:'ajaxData.php',
							data:'cat='+cat,
							success:function(html){
								$('#team_id_6').html(html);
							}
						}); 
					}

});

});
});
</script>   
 <?php include('../header.php'); ?>
<body>
<div id="wrapper">
  <nav class="navbar navbar-expand bg-dark navbar-dark" style="margin-top:20px;width:100%;">
        <!-- Links -->
        <ul class="navbar-nav">

            <li class="nav-item" style="font-weight: bold;">
                <a class="nav-link" href="home.php">Home</a>
            </li>
			
			
			<!--<li class="nav-item dropdown" style="font-weight: bold;">
                <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                    Add
                </a>
                <div class="dropdown-menu"  id="mainNavbar">
                    <!--<a class="dropdown-item" href="teams.php">Teams</a>
                    <a class="dropdown-item" href="add_judges.php">Judges</a>
                </div>
            </li>-->
			
			
			<li class="nav-item dropdown" style="font-weight: bold;">
                <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                    View
                </a>
                <div class="dropdown-menu"  id="mainNavbar">
                    <a class="dropdown-item" href="users.php">Users</a>
					<a class="dropdown-item" href="teams.php">Teams</a>
                    <a class="dropdown-item" href="judges.php">Judges</a>
                </div>
            </li>
			
			<!--<li class="nav-item dropdown" style="font-weight: bold;">
                <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                    View
                </a>
                <div class="dropdown-menu"  id="mainNavbar">
                    <a class="dropdown-item" href="teams.php">Teams</a>
                    <a class="dropdown-item" href="judges.php">Judges</a>
                </div>
            </li>-->
			
			
			<li class="nav-item dropdown" style="font-weight: bold;">
                <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                    Assign Teams vs Judges
                </a>
                <div class="dropdown-menu"  id="mainNavbar">
                    <a class="dropdown-item" href="assign_judge_team.php">Assign Teams vs Judges</a>
                    <a class="dropdown-item" href="view_judge_team.php">View Assigned Teams vs Judges</a>
                </div>
            </li>
			
			<li class="nav-item" style="font-weight: bold;">
                <a class="nav-link" href="liveqa_teams.php">Live QA</a>
            </li>
			
			
			<li class="nav-item" style="font-weight: bold;">
                <a class="nav-link" href="evaluation_results.php">Evaluation Details</a>
            </li>
			
			 <li class="nav-item dropdown" style="font-weight: bold;">
                <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                    <?php echo $name?>
                </a>
                <div class="dropdown-menu"  id="mainNavbar">
					<a class="dropdown-item" href="profile.php">Profile</a>
                    <a class="dropdown-item" href="logout.php">Logout</a>
                    
                </div>
            </li>

            <!--<li class="nav-item">
                <a class="nav-link" href="addStudent.html">Add Student</a>
            </li>

            <li class="nav-item" id="addAccount">
				<a class="nav-link" href="addUser.html">Add Account</a>
            </li>-->
        </ul>
    </nav>




        <div class="container d-flex justify-content-left col-md-10">
        <div class="col-9">
		<form method="post" enctype="multipart/form-data" >

            <br>
            <h3>Assign Judge Vs Teams:</h3>
            <br>
			<table class="table table-borderless">
			
			
			<tr>
			<td>
           
                <label for="studentType">Select Judge:</label>
                <select class="form-control" id="judge_id" name="judge_id">
                    <option>Select Judge type</option>
					<?php 
					$q_j = mysqli_query($con,"select * from tbl_user where user_type='Judge' and judge_confirm = 'Y' order by first_name asc");
					while($d_j = mysqli_fetch_assoc($q_j))
					{
						$jid  = $d_j['id'];
						$s_c = mysqli_query($con,"select count(*) as count from tbl_judge_team where user_id = $jid");
						$d_c = mysqli_fetch_assoc($s_c);
					
					?>
                    <option value="<?php echo $d_j['id']?>"><?php echo $d_j['first_name'].' '.$d_j['last_name']. '-' .$d_j['category'].' ('.$d_c['count'].')'?></option>
					<?php }?>
                    </select>
            
			</td>
			</tr>
			<tr>
			<td>
			
                <label for="studentType">Select Team Category:</label>
                <select class="form-control" id="team_category" name="team_category">
					<option value="">Select Team Category</option>
					<option value="">Select Team Category</option>
					<?php 
					$q_t = mysqli_query($con,"select distinct category from tbl_team where category !=' '");
					while($d_t = mysqli_fetch_assoc($q_t))
					{
						
					?>
                    <option value="<?php echo $d_t['category']?>"><?php echo $d_t['category']?></option>
					<?php }?>
                </select>
            
			</td>
			</tr>
			<tr>
			<td>
			
			    <label for="studentType">Select Team-1:</label>
                <select class="form-control" id="team_id_1" name="team_id_1">
				<option selected>Select Team-1</option>
			   </select>
            
			</td>
			</tr>
            
			<tr>
			<td>
			
			    <label for="studentType">Select Team-2:</label>
                <select class="form-control" id="team_id_2" name="team_id_2" >
				<option selected>Select Team-2</option>
					
                </select>
            
			</td>
			</tr>
			
			<tr>
			<td>
			
			    <label for="studentType">Select Team-3:</label>
                <select class="form-control" id="team_id_3" name="team_id_3" >
				<option selected>Select Team-3</option>
					
                </select>
            
			</td>
			</tr>
			
			<tr>
			<td>
			
			    <label for="studentType">Select Team-4:</label>
                <select class="form-control" id="team_id_4" name="team_id_4" >
				<option selected>Select Team-4</option>
					
                </select>
            
			</td>
			</tr>
			
			
			<tr>
			<td>
			
			    <label for="studentType">Select Team-5:</label>
                <select class="form-control" id="team_id_5" name="team_id_5" >
				<option selected>Select Team-5</option>
					
                </select>
            
			</td>
			</tr>
			
			
			<tr>
			<td>
			
			    <label for="studentType">Select Team-6:</label>
                <select class="form-control" id="team_id_6" name="team_id_6" >
				<option selected>Select Team-6</option>
					
                </select>
            
			</td>
			</tr>
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			<tr>
			<td>

           
			<br>
			<br>
            
            <div class="form-group">
				<button type="submit" class="btn btn-primary" name="submit">Submit</button>	
				</div>
			</td>
			</tr>
		</table>	
		</form>	
        </div>
    </div>



    
</div>
</body>

</html>

<!-- view_judge_team.php -->

<?php
include('../database/config.php'); 
include('control.php'); 

$id = $_SESSION['id'];
$name = $_SESSION['name'];

$judge_id='';
extract($_POST);
if(isset($_POST['submit']))
{	
$judge_id = $_POST['judge_id'];
}



?>


<!DOCTYPE html>
<html lang="en">

<head>
    <title>Judge List</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="css/style.css" type="text/css">
</head>

<style>
html, body {
    top:0;
    bottom:0;
    left:0;
    right:0;
    
   
}
</style>
<body>
<?php include('../header.php'); ?>
<div id="wrapper">
   <nav class="navbar navbar-expand bg-dark navbar-dark" style="margin-top:20px;width:100%;">
        <!-- Links -->
        <ul class="navbar-nav">

            <li class="nav-item" style="font-weight: bold;">
                <a class="nav-link" href="home.php">Home</a>
            </li>
			
			
			<!--<li class="nav-item dropdown" style="font-weight: bold;">
                <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                    Add
                </a>
                <div class="dropdown-menu"  id="mainNavbar">
                    <!--<a class="dropdown-item" href="teams.php">Teams</a>
                    <a class="dropdown-item" href="add_judges.php">Judges</a>
                </div>
            </li>-->
			
			
			<li class="nav-item dropdown" style="font-weight: bold;">
                <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                    View
                </a>
                <div class="dropdown-menu"  id="mainNavbar">
                    <a class="dropdown-item" href="users.php">Users</a>
					<a class="dropdown-item" href="teams.php">Teams</a>
                    <a class="dropdown-item" href="judges.php">Judges</a>
                </div>
            </li>
			
			<!--<li class="nav-item dropdown" style="font-weight: bold;">
                <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                    View
                </a>
                <div class="dropdown-menu"  id="mainNavbar">
                    <a class="dropdown-item" href="teams.php">Teams</a>
                    <a class="dropdown-item" href="judges.php">Judges</a>
                </div>
            </li>-->
			
			
			<li class="nav-item dropdown" style="font-weight: bold;">
                <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                    Assign Teams vs Judges
                </a>
                <div class="dropdown-menu"  id="mainNavbar">
                    <a class="dropdown-item" href="assign_judge_team.php">Assign Teams vs Judges</a>
                    <a class="dropdown-item" href="view_judge_team.php">View Assigned Teams vs Judges</a>
                </div>
            </li>
			
			<li class="nav-item" style="font-weight: bold;">
                <a class="nav-link" href="liveqa_teams.php">Live QA</a>
            </li>
			
			
			<li class="nav-item" style="font-weight: bold;">
                <a class="nav-link" href="evaluation_results.php">Evaluation Details</a>
            </li>
			
			 <li class="nav-item dropdown" style="font-weight: bold;">
                <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                    <?php echo $name?>
                </a>
                <div class="dropdown-menu"  id="mainNavbar">
					<a class="dropdown-item" href="profile.php">Profile</a>
                    <a class="dropdown-item" href="logout.php">Logout</a>
                    
                </div>
            </li>

            <!--<li class="nav-item">
                <a class="nav-link" href="addStudent.html">Add Student</a>
            </li>

            <li class="nav-item" id="addAccount">
				<a class="nav-link" href="addUser.html">Add Account</a>
            </li>-->
        </ul>
    </nav>




        <div class="container d-flex justify-content-left col-md-12">
        <div class="col-12">
		<input type="text" class="form-control" id="myInput" onkeyup="myFunction()" style="margin-block-start: 10px;" placeholder="Search for Judge names..">
		<br>
            <table class="table" id="myTable" style="margin-block-start: -11px">
                <thead class="thead-dark" id="table">
                    <tr>
						<th scope="col">Judge</th>
						<th scope="col">Team Name</th>
						<th scope="col">Category</th>
                        <th>Delete Record</th>
                    </tr>
                </thead>
				<tbody> 
				
				<?php 
				if($judge_id !=='')
				{
					$q_team = mysqli_query($con,"select distinct tj.id, first_name, last_name , project_team_name, tt.category 
					from `tbl_judge_team` tj, tbl_user tu, tbl_team tt
					WHERE tj.user_id=$judge_id
					and tu.id = tj.user_id
					and tj.team_id = tt.idz");	
				}
				else
				{
				$q_team = mysqli_query($con,"select distinct tj.id, first_name, last_name , project_team_name, tt.category 
					from `tbl_judge_team` tj, tbl_user tu, tbl_team tt
					WHERE tj.user_id=tu.id
					and tu.id = tj.user_id
					and tj.team_id = tt.id");	
				}					
				while ($r_team = mysqli_fetch_assoc($q_team))					
				{
				
				?>  
											
					<tr> 
						<td><?php echo $r_team['first_name'].' '.$r_team['last_name']?></td> 
						<td><?php echo $r_team['project_team_name']?></a></td> 
						<td><?php echo $r_team['category']?></a></td> 
						<td><a href="delete_ja.php?id=<?php echo $r_team['id']?>"><button type="button" style="margin:0px;"  class="btn-success btn-sm"  onclick="edit(this)">Delete</button></a></td> 
				    </tr> 
				<?php } ?>								
												
											</tbody> 
            </table>
        </div>

    </div>



    
</div>
<script>
function myFunction() {
  // Declare variables
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("myInput");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");

  // Loop through all table rows, and hide those who don't match the search query
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[0];
    if (td) {
      txtValue = td.textContent || td.innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }
  }
}
</script>
</body>

</html>