<?php
include '../admin.auth.php';
include 'config.php';
$interest_q = mysqli_query($conn, "select count(*) as count from tbl_user where user_type not in ('SuperUser')");
$interest_d = mysqli_fetch_assoc($interest_q);

$volunteer_q = mysqli_query($conn, "select count(*) as count from tbl_user where interested like '%Volunteering%'");
$volunteer_d = mysqli_fetch_assoc($volunteer_q);

$judges_q = mysqli_query($conn, "select count(*) as count from tbl_user where interested like '%Judging%'");
$judges_d = mysqli_fetch_assoc($judges_q);

$mentor_q = mysqli_query($conn, "select count(*) as count from tbl_user where interested like '%Mentoring%'");
$mentor_d = mysqli_fetch_assoc($mentor_q);

$team_q = mysqli_query($conn, "select count(*) as count from tbl_team");
$team_d = mysqli_fetch_assoc($team_q);



$comple_c_q = mysqli_query($conn, "select count(*) as count from tbl_team where (video_pitch is not null and log_book!='') ");
$complete_c_d = mysqli_fetch_assoc($comple_c_q);


$incomple_q = mysqli_query($conn, "select count(*) as count from tbl_team where (video_pitch is null or log_book='' or log_book is null) ");
$incomplete_d = mysqli_fetch_assoc($incomple_q);


$incomple_l_q = mysqli_query($conn, "select count(*) as count from tbl_team tt where log_book is null");
$incomplete_l_d = mysqli_fetch_assoc($incomple_l_q);

$incomple_v_q = mysqli_query($conn, "select count(*) as count from tbl_team tt where video_pitch is null");
$incomplete_v_d = mysqli_fetch_assoc($incomple_v_q);


$school_d_q = mysqli_query($conn, "select count(distinct student_school_district) as count from student");
$school_d_d = mysqli_fetch_assoc($school_d_q);

$school_d_aa = mysqli_query($conn, "select count(*)as count from tbl_team where id in (SELECT tm.team_id
FROM tbl_team_member AS tm
JOIN student AS s ON tm.student_id = s.student_id
WHERE s.student_school_district LIKE '%Ann Arbor%')");
$school_aa_d = mysqli_fetch_assoc($school_d_aa);

$school_d_la = mysqli_query($conn, "select count(*)as count from tbl_team where id in (SELECT tm.team_id
FROM tbl_team_member AS tm
JOIN student AS s ON tm.student_id = s.student_id
WHERE s.student_school_district LIKE '%Livonia%')");
$school_la_d = mysqli_fetch_assoc($school_d_la);

$school_d_pc = mysqli_query($conn, "select count(*)as count from tbl_team where id in (SELECT tm.team_id
FROM tbl_team_member AS tm
JOIN student AS s ON tm.student_id = s.student_id
WHERE s.student_school_district LIKE '%Plymouth%')");
$school_pc_d = mysqli_fetch_assoc($school_d_pc);

$school_d_sa = mysqli_query($conn, "select count(*)as count from tbl_team where id in (SELECT tm.team_id
FROM tbl_team_member AS tm
JOIN student AS s ON tm.student_id = s.student_id
WHERE s.student_school_district LIKE '%Saline%')");
$school_sa_d = mysqli_fetch_assoc($school_d_sa);

$tot_j_q = mysqli_query($conn, "select count(*)as count from tbl_user where user_type='Judge'");
$tot_j_d = mysqli_fetch_assoc($tot_j_q);

$conf_j_q = mysqli_query($conn, "select count(*)as count from tbl_user where user_type='Judge' and judge_confirm='Y'");
$conf_j_d = mysqli_fetch_assoc($conf_j_q);


$prof_j_q = mysqli_query($conn, "select count(*)as count from tbl_user where user_type='Judge' and category like 'Professional%'");
$prof_j_d = mysqli_fetch_assoc($prof_j_q);

$fac_j_q = mysqli_query($conn, "select count(*)as count from tbl_user where user_type='Judge' and category='Faculty'");
$fac_j_d = mysqli_fetch_assoc($fac_j_q);

$stud_j_q = mysqli_query($conn, "select count(*)as count from tbl_user where user_type='Judge' and category='Student'");
$stud_j_d = mysqli_fetch_assoc($stud_j_q);

$other_j_q = mysqli_query($conn, "select count(*)as count from tbl_user where user_type='Judge' and category = 'Others'");
$other_j_d = mysqli_fetch_assoc($other_j_q);

$pt_j_q = mysqli_query($conn, "select count(*)as count from tbl_user where user_type='Judge' and category like '%Pre-service%'");
$pt_j_d = mysqli_fetch_assoc($pt_j_q);

$k_j_q = mysqli_query($conn, "select count(*)as count from tbl_user where user_type='Judge' and category = 'K-12 teachers'");
$k_j_d = mysqli_fetch_assoc($k_j_q);

$j_ass_q = mysqli_query($conn, "select  distinct user_id, count(*) as count from tbl_judge_team group by (user_id)");
$j_ass_d = mysqli_fetch_assoc($j_ass_q);
$count_j = mysqli_num_rows($j_ass_q);

$j_ass_3q = mysqli_query($conn, "select  distinct user_id, count(*) as count from tbl_judge_team group by (user_id) having count(user_id) <=3");
$j_ass_3d = mysqli_fetch_assoc($j_ass_3q);
$count_3j = mysqli_num_rows($j_ass_3q);

$j_ass_4q = mysqli_query($conn, "select  distinct user_id, count(*) as count from tbl_judge_team group by (user_id) having count(user_id) = 4");
$j_ass_4d = mysqli_fetch_assoc($j_ass_4q);
$count_4j = mysqli_num_rows($j_ass_4q);


$j_ass_5q = mysqli_query($conn, "select  distinct user_id, count(*) as count from tbl_judge_team group by (user_id) having count(user_id) = 5");
$j_ass_5d = mysqli_fetch_assoc($j_ass_5q);
$count_5j = mysqli_num_rows($j_ass_5q);

$j_ass_6q = mysqli_query($conn, "select  distinct user_id, count(*) as count from tbl_judge_team group by (user_id) having count(user_id) = 6");
$j_ass_6d = mysqli_fetch_assoc($j_ass_6q);
$count_6j = mysqli_num_rows($j_ass_6q);


$k_ass_q = mysqli_query($conn, "select team_id, count(team_id) from tbl_judge_team group by team_id");
$count_k = mysqli_num_rows($k_ass_q);

$k_ass_2q = mysqli_query($conn, "
 select GROUP_CONCAT(concat(first_name,' ', last_name)) as judge_list , project_team_name, tt.category 
                               from `tbl_judge_team` tj, tbl_user tu, tbl_team tt
                               WHERE tj.user_id=tu.id
                               and tu.id = tj.user_id
                               and tj.team_id = tt.id
                                                   group by (project_team_name)
                                                   having count(project_team_name) < 3");
$count_2k = mysqli_num_rows($k_ass_2q);


$k_ass_3q = mysqli_query($conn, "select team_id, count(team_id) from tbl_judge_team group by (team_id) having count(team_id) = 3");
$count_3k = mysqli_num_rows($k_ass_3q);


$k_ass_4q = mysqli_query($conn, "select team_id, count(team_id) from tbl_judge_team group by (team_id) having count(team_id) = 4");
$count_4k = mysqli_num_rows($k_ass_4q);


$k_ass_5q = mysqli_query($conn, "select team_id, count(team_id) from tbl_judge_team group by (team_id) having count(team_id) = 5");
$count_5k = mysqli_num_rows($k_ass_5q);

$k_ass_6q = mysqli_query($conn, "select team_id, count(team_id) from tbl_judge_team group by (team_id) having count(team_id) = 6");
$count_6k = mysqli_num_rows($k_ass_6q);


$count_comp_j = 0;
$count_comp1_j = 0;
$count_comp2_j = 0;
$count_comp3_j = 0;
$count_comp4_j = 0;
$count_comp5_j = 0;
$count_comp6_j = 0;
$j_c_e = mysqli_query($conn, "select user_id, count(user_id) as count from tbl_judge_team group by (user_id)");
while ($row = mysqli_fetch_assoc($j_c_e)) {
  $user_id = $row['user_id'];
  $count_tj = $row['count'];
  $q_c = mysqli_query($conn, "select count(user_id) as count from tbl_judge_assessment where user_id = $user_id and (identifying_understanding is not null 
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
  if ($count_tj == $count_tja) {
    $count_comp_j = $count_comp_j + 1;
  } else {
    if (($count_tj - $count_tja) == 1) {
      $count_comp1_j = $count_comp1_j + 1;
    }
    if (($count_tj - $count_tja) == 2) {
      $count_comp2_j = $count_comp2_j + 1;
    }
    if (($count_tj - $count_tja) == 3) {
      $count_comp3_j = $count_comp3_j + 1;
    }
    if (($count_tj - $count_tja) == 4) {
      $count_comp4_j = $count_comp4_j + 1;
    }
    if (($count_tj - $count_tja) == 5) {
      $count_comp5_j = $count_comp5_j + 1;
    }
    if (($count_tj - $count_tja) == 6) {
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
$t_c_e = mysqli_query($conn, "select team_id, count(team_id) as count from tbl_judge_team group by (team_id)");
while ($row_t = mysqli_fetch_assoc($t_c_e)) {
  $team_id = $row_t['team_id'];
  $count_t = $row_t['count'];
  $q_tc = mysqli_query($conn, "select count(team_id) as count from tbl_judge_assessment where team_id = $team_id and (identifying_understanding is not null 
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
  if ($count_t == $count_ta) {
    $count_comp_t = $count_comp_t + 1;
    #echo $team_id;
  } else {
    if (($count_t - $count_ta) == 1) {
      $count_comp1_t = $count_comp1_t + 1;
    }
    if (($count_t - $count_ta) == 2) {
      $count_comp2_t = $count_comp2_t + 1;
    }
    if (($count_t - $count_ta) == 3) {
      $count_comp3_t = $count_comp3_t + 1;
    }
    if (($count_t - $count_ta) == 4) {
      $count_comp4_t = $count_comp4_t + 1;
    }
    if (($count_t - $count_ta) == 5) {
      $count_comp5_t = $count_comp5_t + 1;
    }
    if (($count_t - $count_ta) == 6) {
      $count_comp6_t = $count_comp6_t + 1;
    }
  }
}

$results_912_q = mysqli_query($conn, "select group_concat(concat(project_name,'-',(@row_number:=@row_number + 1)) SEPARATOR '<br>') as team_name from (select team_id, tt.project_team_name as project_name, tt.category, avg(total) as total from tbl_team tt, stut_tot st where tt.id = st.team_id and tt.category = '9-12' group by(team_id) order by total desc limit 3 ) t, (SELECT @row_number := 0) r");

$r = mysqli_fetch_assoc($results_912_q);
$teams_9 = $r['team_name'];

$results_68_q = mysqli_query($conn, "select group_concat(concat(project_name,'-',(@row_number:=@row_number + 1)) SEPARATOR '<br>') as team_name from (select team_id, tt.project_team_name as project_name, tt.category, avg(total) as total from tbl_team tt, stut_tot st where tt.id = st.team_id and tt.category = '6-8' group by(team_id) order by total desc limit 3 ) t, (SELECT @row_number := 0) r");

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
$results_35_q = mysqli_query($conn, $sel);


#$results_35_q = mysqli_query($conn,"");

$r_3 = mysqli_fetch_assoc($results_35_q);
$teams_3 = $r_3['team_name'];

$results_k2_q = mysqli_query($conn, "select group_concat(concat(project_name,'-',(r.a)) SEPARATOR '<br>') as team_name from (select team_id, tt.project_team_name as project_name, tt.category, avg(total) as total from tbl_team tt, stut_tot st where tt.id = st.team_id and tt.category = 'K-2' group by(team_id) order by total desc limit 3 ) t, (SELECT (@row_number := 1) as a) r");

$r_k = mysqli_fetch_assoc($results_k2_q);
$teams_k = $r_k['team_name'];



$sel_q = mysqli_query($conn, "select count(distinct team_id) as count from tbl_judge_assessment where live_qa is not null");
$live_complete_pitches = mysqli_fetch_assoc($sel_q);

$sel_aq = mysqli_query($conn, "select count(distinct team_id) as count from tbl_judge_assessment where live_qa is null");
$live_incomplete_pitches = mysqli_fetch_assoc($sel_aq);


?>


<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Purple Admin</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="../assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css" />
  
    <link rel="stylesheet" href="../assets/vendors/css/vendor.bundle.base.css">
  <!-- endinject -->
  <!-- Plugin css for this page -->
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <!-- endinject -->
  <!-- Layout styles -->
  <link rel="stylesheet" href="../assets/css/style2.css">
  <!-- End layout styles -->
  <!-- <link rel="shortcut icon" href="../assets/images/favicon.ico" /> -->
</head>

<body>
  <div class="container-scroller">

    <?php include '../dashboardheader.php'; ?>
    <!-- partial -->
    <div class="main-panel">
      <div class="content-wrapper updated">
        <div class="page-header">
          <h3 class="page-title">
            <span class="page-title-icon  text-white me-2">
              <i class="mdi mdi-view-dashboard"></i>
            </span> Dashboard

          </h3>

        
        </div>
        <div class="row">
        <div class="col-md-4 stretch-card grid-margin">
            <div class="card  card-img-holder text-white" style="background: rgb(103,255,85);
background: radial-gradient(circle, rgba(103,255,85,1) 0%, rgba(7,159,38,1) 100%);">
              <div class="card-body">
                <img src="../assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
                <h4 class="font-weight-normal mb-3">Current Results <i class="mdi mdi-diamond mdi-24px float-right"></i>
                </h4>

               
                <a href="#" class="result-btn" data-title=" Team 3-5 Results" data-url="results.php" data-query="select team_id, tt.project_team_name as project_name, tt.category, avg(total) as total
										from tbl_team tt, stut_tot st
										where tt.id = st.team_id
                                        and tt.category = '3-5'
										group by(team_id)
                                        order by total desc
									"> <h6 class="card-text"><span>3-5: <br> <p><?php echo $teams_3 ?></p></span></h6></a>
              </div>
            </div>
          </div>
          <div class="col-md-4 stretch-card grid-margin">
            <div class="card  card-img-holder text-white" style="background: rgb(0,249,170);
background: radial-gradient(circle, rgba(0,249,170,1) 0%, rgba(27,94,163,1) 100%);">
              <div class="card-body">
                <img src="../assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
                <h4 class="font-weight-normal mb-3">Current Results <i class="mdi mdi-diamond mdi-24px float-right"></i>
                </h4>

                <a href="#" class="result-btn" data-title="Team 6-8 Results" data-url="results.php" data-query="select team_id, tt.project_team_name as project_name, tt.category, avg(total) as total
										from tbl_team tt, stut_tot st
										where tt.id = st.team_id
                                        and tt.category = '6-8'
										group by(team_id)
                                        order by total desc
									">  <h6 class="card-text"><span>6-8: <br> <p><?php echo $teams_6 ?></p></span></h6></a>
              </div>
            </div>
          </div>
          <div class="col-md-4 stretch-card grid-margin">
            <div class="card  card-img-holder text-white" style="background: rgb(246,106,106);
background: linear-gradient(90deg, rgba(246,106,106,1) 13%, rgba(250,112,112,0.9640231092436975) 35%, rgba(242,40,40,1) 71%);">
              <div class="card-body">
                <img src="../assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
                <h4 class="font-weight-normal mb-3">Current Results <i class="mdi mdi-diamond mdi-24px float-right"></i>
                </h4>

                <a href="#" class="result-btn" data-title="Team 9-12 Results" data-url="results.php" data-query="select team_id, tt.project_team_name as project_name, tt.category, avg(total) as total
										from tbl_team tt, stut_tot st
										where tt.id = st.team_id
                                        and tt.category = '9-12'
										group by(team_id)
                                        order by total desc
									">   <h6 class="card-text"><span>9-12 :<br><p><?php echo $teams_9 ?></p></span></h6></a>
              </div>
            </div>
          </div>
        </div>
        <div class="row ">
          <div class="col-md-4 stretch-card grid-margin">
            <div class="card bg-gradient-danger card-img-holder text-white" >
              <div class="card-body">
                <img src="../assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
                <h4 class="font-weight-normal mb-3">Live Complete Pitches <i class="mdi mdi-chart-line mdi-24px float-right"></i>
                </h4>
                <a href="#" class="ajaxupdated" data-url="livecompletepitch.php">
                  <h2 class="mb-3"><?php echo $live_complete_pitches['count'] ?></h2>
                </a>
                <a href="#" class="ajaxupdated" data-url="livecompletepitch.php">
                  <h6 class="card-text"> Complete : <span><?php echo $live_complete_pitches['count'] ?></span></h6>
                </a>
                <a href="#" class="ajaxupdated" data-url="liveincompletepitch.php">
                  <h6 class="card-text"> Incomplete : <span><?php echo $live_incomplete_pitches['count'] ?></span></h6>
                </a>

              </div>
            </div>
          </div>
          <div class="col-md-4 stretch-card grid-margin">
            <div class="card bg-gradient-info card-img-holder text-white">
              <div class="card-body">
                <img src="../assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
                <h4 class="font-weight-normal mb-3">Community Interest <i class="mdi mdi-bookmark-outline mdi-24px float-right"></i>
                </h4>
                <a href="#" class="ajaxupdated" data-url="communityinterest.php">
                  <h2 class="mb-3"><?php echo $interest_d['count'] ?></h2>
                </a>
                <h6 class="card-text">Volunteers: <span><?php echo $volunteer_d['count'] ?></span> &nbsp&nbsp&nbspJudges: <span><?php echo $judges_d['count'] ?></span></h6>
                <h6 class="card-text">Teams: <span><?php echo $team_d['count'] ?></span> &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbspMentors: <span><?php echo $mentor_d['count'] ?></span> </h6>
              </div>
            </div>
          </div>
          <div class="col-md-4 stretch-card grid-margin">
            <div class="card bg-gradient-success card-img-holder text-white">
              <div class="card-body">
                <img src="../assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
                <a href="teams.php" >
                  <h4 class="font-weight-normal mb-3">Team Submissions: <i class="mdi mdi-diamond mdi-24px float-right"></i>
                  </h4>
                  <h2 class="mb-3"><?php echo $team_d['count'] ?></h2>
                </a>
                <h6 class="card-text"> <a href="#" class="ajaxupdated" data-url="teams_complete.php"> Complete: <span> <?php echo $complete_c_d['count'] ?> </span></a> <br> <a href="#" class="ajaxupdated" data-url="teams_incomplete_logbook.php"> Incomplete: <span><?php echo $incomplete_d['count'] ?> </span></a></h6>
                <h6 class="card-text"> <a href="#" class="ajaxupdated" data-url="teams_incomplete_logbook.php"> W/t LogBooks: <span><?php echo $incomplete_l_d['count'] ?></span></a> <br><a href="#" class="ajaxupdated" data-url="teams_incomplete_videopitch.php">W/t Videos: <span><?php echo $incomplete_v_d['count'] ?> </span></a> </h6>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-4 stretch-card grid-margin">
            <div class="card bg-gradient-danger card-img-holder text-white">
              <div class="card-body">
                <img src="../assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
                <a href="judges.php" >
                
                  <h4 class="font-weight-normal">Total Judges<i class="mdi mdi-gavel mdi-24px float-right"></i>
                  </h4>
                  <h2><?php echo $tot_j_d['count']; ?></h2>
                </a>
                <a href="#" class="result-btn" data-title="Confirm" data-url="confirmjudges.php" data-query="select distinct id,first_name, last_name, category,judge_confirm from tbl_user where user_type='Judge' and judge_confirm = 'Y' order by judge_confirm desc,first_name asc">
                  <h4 class="mb-3">Confirmed: <span><?php echo $conf_j_d['count']; ?> </span> </h4>
                </a>
                <a href="#" class="result-btn " data-title="Professional " data-url="confirmjudges.php" data-query="select distinct id,first_name, last_name, category,judge_confirm from tbl_user where user_type='Judge' and  category LIKE 'Professional%' order by first_name asc"><h6 class="card-text ">Professional: <span><?php echo $prof_j_d['count'] ?> </span></h6>
                  </a>
                   <a href="#" class="result-btn" data-title="Faculty " data-url="confirmjudges.php" data-query="select distinct id,first_name, last_name, category,judge_confirm from tbl_user where user_type='Judge' and  category LIKE '%Faculty%' order by first_name asc"><h6 class="card-text  ">Faculty: <span><?php echo $fac_j_d['count'] ?></span></h6></a>
                  <a href="#" class="result-btn" data-title="Pre Service Teachers " data-url="confirmjudges.php" data-query="select distinct id,first_name, last_name, category,judge_confirm from tbl_user where user_type='Judge' and  category LIKE '%Pre-service%' order by first_name asc"> <h6 class="card-text">Pre-Service-Teachers: <span><?php echo $pt_j_d['count'] ?></span> </h6></a>
                  <a href="#" class="result-btn" data-title="K-12 Teachers " data-url="confirmjudges.php" data-query="select distinct id,first_name, last_name, category,judge_confirm from tbl_user where user_type='Judge' and category ='K-12 teachers' order by first_name asc"><h6 class="card-text ">K-12 Teachers: <span><?php echo $k_j_d['count'] ?> </span> </h6></a>
                  <a href="#" class="result-btn" data-title="Students " data-url="confirmjudges.php" data-query="select distinct id,first_name, last_name, category,judge_confirm from tbl_user where user_type='Judge' and  category='Student' order by first_name asc"><h6 class="card-text ">Student: <span><?php echo $stud_j_d['count'] ?></span></h6></a>
                  <a href="#" class="result-btn" data-title="Other " data-url="confirmjudges.php" data-query="select distinct id,first_name, last_name, category,judge_confirm from tbl_user where user_type='Judge' and  category='Others' order by first_name asc"><h6 class="card-text ">Others: <span><?php echo $other_j_d['count'] ?></span></h6></a>
                

              </div>
            </div>
          </div>
          <div class="col-md-4 stretch-card grid-margin">
            <div class="card bg-gradient-info card-img-holder text-white">
              <div class="card-body">
                <img src="../assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
                <h4 class="font-weight-normal mb-3">Teams Allocation to Judges<i class="mdi mdi-bookmark-outline mdi-24px float-right"></i>
                </h4>
                <a href="#" class="ajaxupdated" data-title="Team Allocation To Judges" data-url="team_to_judges.php" data-query="SELECT 
    GROUP_CONCAT(CONCAT(tu.first_name, ' ', tu.last_name)) AS judge_list,
    tt.project_team_name,
    tt.category
FROM 
    tbl_judge_team tj
    INNER JOIN tbl_user tu ON tj.user_id = tu.id
    INNER JOIN tbl_team tt ON tj.team_id = tt.id
GROUP BY 
    tt.project_team_name;">
                    <h2 class="mb-3"><?php echo $count_k; ?></h2></a>
                <h6 class="card-text">  <a href="#" class="ajaxupdated" data-title="Team Allocation To Judges" data-url="team_to_judges.php" data-query="SELECT 
    GROUP_CONCAT(CONCAT(tu.first_name, ' ', tu.last_name)) AS judge_list,
    tt.project_team_name,
    tt.category
FROM 
    tbl_judge_team tj
    INNER JOIN tbl_user tu ON tj.user_id = tu.id
    INNER JOIN tbl_team tt ON tj.team_id = tt.id
GROUP BY 
    tt.project_team_name
    HAVING COUNT(project_team_name)<3;">Teams with less than 3 Judges: <span><?php echo $count_2k ?></span></a> <br><a href="#" class="ajaxupdated" data-title="Team Allocation To Judges" data-url="team_to_judges.php" data-query="SELECT 
    GROUP_CONCAT(CONCAT(tu.first_name, ' ', tu.last_name)) AS judge_list,
    tt.project_team_name,
    tt.category
FROM 
    tbl_judge_team tj
    INNER JOIN tbl_user tu ON tj.user_id = tu.id
    INNER JOIN tbl_team tt ON tj.team_id = tt.id
GROUP BY 
    tt.project_team_name
    HAVING COUNT(project_team_name)=3;"> Teams with 3 Judges: <span><?php echo $count_3k ?></span></a></h6>
                <h6 class="card-text"><a href="#" class="ajaxupdated" data-title="Team Allocation To Judges" data-url="team_to_judges.php" data-query="SELECT 
    GROUP_CONCAT(CONCAT(tu.first_name, ' ', tu.last_name)) AS judge_list,
    tt.project_team_name,
    tt.category
FROM 
    tbl_judge_team tj
    INNER JOIN tbl_user tu ON tj.user_id = tu.id
    INNER JOIN tbl_team tt ON tj.team_id = tt.id
GROUP BY 
    tt.project_team_name
    HAVING COUNT(project_team_name)=4;">Teams with 4 Judges: <span><?php echo $count_4k ?></span></a> <br>Teams with less than 5 Judges: <span><?php echo $count_5k ?></span></h6>
              </div>
            </div>
          </div>
          <div class="col-md-4 stretch-card grid-margin">
            <div class="card bg-gradient-success card-img-holder text-white">
              <div class="card-body">
                <img src="../assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
                <a href="#" class="ajaxupdated" data-title="Judges Allocation To Team" data-url="view_judge_team.php" data-query="select t.user_id,judge_name,email, group_concat(category) as category, GROUP_CONCAT(project_team_name) as project_team_name from (select tj.user_id,concat(tu.first_name,' ', tu.last_name) as judge_name,tu.email, tt.project_team_name, tt.category FROM tbl_user tu, tbl_judge_team tj, tbl_team tt
										where tj.user_id in (select distinct user_id from tbl_judge_team)
										and tj.team_id = tt.id
										and tj.user_id = tu.id) t 
                                        group by (judge_name)">    <h4 class="font-weight-normal mb-3">Judges Allocation to Teams<i class="mdi mdi-diamond mdi-24px float-right"></i>
                </h4>
                <h2 class="mb-3"><?php echo $count_j; ?></h2></a>
                <h6 class="card-text">  <a href="#" class="ajaxupdated" data-title="Judges Allocation To Team" data-url="view_judge_team3.php" data-query="select  distinct user_id, GROUP_CONCAT(team_id) as team_list ,count(*) as count from tbl_judge_team group by (user_id) having count(user_id) <= 3">   
                  3 Teams and less than 3: <span><?php echo $count_3j ?></span></a> <br>  <a href="#" class="ajaxupdated" data-title="Judges Allocation To Team" data-url="view_judge_team3.php" data-query="select  distinct user_id, GROUP_CONCAT(team_id) as team_list ,count(*) as count from tbl_judge_team group by (user_id) having count(user_id)=4">   
                   4 Teams: <span><?php echo $count_4j ?></span></a> <br>  <a href="#" class="ajaxupdated" data-title="Judges Allocation To Team" data-url="view_judge_team3.php" data-query="select  distinct user_id, GROUP_CONCAT(team_id) as team_list ,count(*) as count from tbl_judge_team group by (user_id) having count(user_id)=5">   
                   5 Teams: <span><?php echo $count_5j ?></span></a> </h6>


              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-4 stretch-card grid-margin">
            <div class="card bg-gradient-danger card-img-holder text-white">
              <div class="card-body">
                <img src="../assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
                <a href="#" class="ajaxupdated" data-title="No Of Judges Completed Evaluations" data-url="judges_complete.php" data-query=" ">   <h4 class="font-weight-normal mb-3">No Of Judges Completed evaluations<i class="mdi mdi-chart-line mdi-24px float-right"></i>
                </h4>
                <h2 class="mb-3"><?php echo $count_comp_j; ?></h2></a>
                <h6 class="card-text"> <a href="#" class="ajaxupdated" data-title=" Judges With 1 incomplete Evaluation" data-url="judges_incomplete.php" data-query="1">   
               Judges With 1 incomplete Evaluation: <span><?php echo $count_comp1_j ?></span></a> <br> <a href="#" class="ajaxupdated" data-title=" Judges With 2 incomplete Evaluation" data-url="judges_incomplete.php" data-query="2">   
               Judges With 2 incomplete Evaluation: <span><?php echo $count_comp2_j ?></span></a> <br><a href="#" class="ajaxupdated" data-title=" Judges With 3 incomplete Evaluation" data-url="judges_incomplete.php" data-query="3">   
               Judges With 3 incomplete Evaluation: <span><?php echo $count_comp3_j ?></span> </a><br>
               <a href="#" class="ajaxupdated" data-title=" Judges With 4 incomplete Evaluation" data-url="judges_incomplete.php" data-query="4">   
               Judges With 4 incomplete Evaluation: <span><?php echo $count_comp4_j ?></span> </a><br> <a href="#" class="ajaxupdated" data-title=" Judges With 5 incomplete Evaluation" data-url="judges_incomplete.php" data-query="5">   
               Judges With 5 incomplete Evaluation: <span><?php echo $count_comp5_j ?></span></a></h6>
              </div>
            </div>
          </div>
          <div class="col-md-4 stretch-card grid-margin">
            <div class="card bg-gradient-info card-img-holder text-white">
              <div class="card-body">
                <img src="../assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
                <a href="#" class="ajaxupdated" data-title=" No Of Teams with Completed evaluations" data-url="complete_teams.php" data-query="0">   
                    <h4 class="font-weight-normal mb-3">No Of Teams with Completed evaluations<i class="mdi mdi-bookmark-outline mdi-24px float-right"></i>
                </h4>
                <h2 class="mb-3"><?php echo $count_comp_t; ?></h2></a>
                <h6 class="card-text"> <a href="#" class="ajaxupdated" data-title=" Teams With 1 incomplete Evaluation" data-url="complete_teams.php" data-query="1">   
              Teams With 1 incomplete Evaluation: <span><?php echo $count_comp1_t ?></span></a><br> <a href="#" class="ajaxupdated" data-title=" Teams With 2 incomplete Evaluation" data-url="complete_teams.php" data-query="2">   
              Teams With 2 incomplete Evaluation:<span><?php echo $count_comp2_t ?></span></a> <br> <a href="#" class="ajaxupdated" data-title=" Teams With 3 incomplete Evaluation" data-url="complete_teams.php" data-query="3">   
              Teams With 3 incomplete Evaluation: <span><?php echo $count_comp3_t ?></span></a><br> <a href="#" class="ajaxupdated" data-title=" Teams With 4 incomplete Evaluation" data-url="complete_teams.php" data-query="4">   
              Teams With 4 incomplete Evaluation: <span><?php echo $count_comp4_t ?></span></a><br> 
              Teams With 5 incomplete Evaluation: <span><?php echo $count_comp5_t ?></span></h6>
              </div>
            </div>
          </div>
          <div class="col-md-4 stretch-card grid-margin">
            <div class="card bg-gradient-success card-img-holder text-white">
              <div class="card-body">
                <img src="../assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
                <h4 class="font-weight-normal mb-3">Current Results <i class="mdi mdi-diamond mdi-24px float-right"></i>
                </h4>

                <h6 class="card-text">K-2 <span><?php echo $teams_k ?></span></h6>
              </div>
            </div>
          </div>
        </div>

        


      </div>
      <!-- content-wrapper ends -->
      <!-- partial:partials/_footer.html -->
      <footer class="footer">

      </footer>
      <!-- partial -->
    </div>
    <!-- main-panel ends -->
  </div>
  <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->
  <!-- plugins:js -->
  <script src="../assets/vendors/js/vendor.bundle.base.js"></script>
  <!-- <script src="https://code.jquery.com/jquery-3.7.0.js" integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM=" crossorigin="anonymous"></script> -->
  <!-- endinject -->
  <!-- Plugin js for this page -->

  <script src="../assets/js/jquery.cookie.js" type="text/javascript"></script>
  <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
  <!-- End plugin js for this page -->
  <!-- inject:js -->
  <script src="../assets/js/off-canvas.js"></script>
  <script src="../assets/js/hoverable-collapse.js"></script>
  <script src="../assets/js/misc.js"></script>
  <!-- endinject -->
  <!-- Custom js for this page -->
  <!-- <script src="../assets/js/dashboard.js"></script> -->
  <script src="../assets/js/todolist.js"></script>
  <script src="../assets/js/ajaxscript.js?v=4"></script>
  <!-- End custom js for this page -->
</body>

</html>