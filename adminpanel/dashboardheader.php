
<?php

session_start();
include '../superadmin/config.php';
$user_id = $_SESSION['id'];
$usertype = $_SESSION['user_type'];
$username = $_SESSION['name'];
$current_year =date('Y');
if (isset($user_id)) {
  $query = mysqli_query($conn, "SELECT * FROM tbl_user WHERE id = $user_id");
  $fquery = mysqli_fetch_assoc($query);
}
if(isset($_GET['year']))
{
	$year = $_GET['year'];
}
else {
$year = date("Y");
}

$timezone = date_default_timezone_set('America/New_York');
$date = date('Y-m-d H:i:s');
$today_at_midnight = strtotime('midnight');

$date_check = '2023-09-27 00:00:00';
echo '
<!-- partial:partials/_navbar.html -->
<nav class="navbar default-layout-navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
  <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
    <a class="navbar-brand brand-logo" href="index.html"><img src="../assets/images/emuinventlogo.jpg" alt="logo" /></a>
    <a class="navbar-brand brand-logo-mini" href="index.html"><img src="../assets/images/mini-logopic.PNG" alt="logo" /></a>
  </div>
  <div class="navbar-menu-wrapper d-flex align-items-stretch">
    <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
      <span class="mdi mdi-menu"></span>
    </button>
    <div class="search-field d-none d-md-block">
      <form class="d-flex align-items-center h-100" action="#">
        <div class="input-group">
          <div class="input-group-prepend bg-transparent">
            <i class="input-group-text border-0 mdi mdi-magnify"></i>
          </div>
          <input type="text" class="form-control bg-transparent border-0" placeholder="Search Here" id="search">
        </div>
      </form>
    </div>
    <ul class="navbar-nav navbar-nav-right">
      <li class="nav-item nav-profile dropdown">
        <a class="nav-link dropdown-toggle" id="profileDropdown" href="#" data-bs-toggle="dropdown" aria-expanded="false">
        ';

echo '
          <div class="nav-profile-text">
            <p class="mb-1 text-black">Hi <span class="text-capitalize">' . $username . '</span></p>
          </div>
        </a>';
if (isset($_SESSION['id'])) {
  $user_id = $_SESSION['id'];
  echo  '<div class="dropdown-menu navbar-dropdown" aria-labelledby="profileDropdown">
          <a class="dropdown-item" href="../profile.php?id=' . $user_id . '">
            <i class="mdi mdi-cached me-2 text-success"></i>User Profile</a>
          <div class="dropdown-divider"></div>
          ';
     if(isset($_SESSION['user_type']) && $_SESSION['user_type']=='Student'){
      echo'<a class="dropdown-item" href="../student/edit_member.php?student_id=' . $user_id . '">
      <i class="mdi mdi-cached me-2 text-success"></i>Student Profile</a>
    <div class="dropdown-divider"></div>
    ';

     } 
     echo'    
          <a class="dropdown-item" href="./../../logout.php">
            <i class="mdi mdi-logout me-2 text-primary"></i> Signout </a>
        </div>';
}
echo '
      </li>
      
    
      <li class="nav-item nav-logout d-none d-lg-block">
        <a class="nav-link" href="./../../logout.php">
          <i class="mdi mdi-power"></i>
        </a>
      </li>
      <li class="nav-item nav-settings d-none d-lg-block">
        <a class="nav-link" href="#">
          <i class="mdi mdi-format-line-spacing"></i>
        </a>
      </li>
    </ul>
    <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
      <span class="mdi mdi-menu"></span>
    </button>
  </div>
</nav>
<!-- partial -->
<div class="container-fluid page-body-wrapper">
  <!-- partial:partials/_sidebar.html -->
  <nav class="sidebar sidebar-offcanvas pt-3" id="sidebar">
    <ul class="nav">
      <li class="nav-item nav-profile">
        <a href="#" class="nav-link">
        ';
if ($fquery['profile_pic'] != NULL && $fquery['profile_pic'] != '') {
  echo
  '  
          <div class="nav-profile-image">
            <img src="../profilepic/' . $fquery['profile_pic'] . '" alt="profile">
            <span class="login-status online"></span>
            <!--change to offline or busy as needed-->
          </div>
          ';
} else {
  echo '
          <div class="nav-profile-image">
            <img src="../assets/images/faces-clipart/pic-4.png" alt="profile">
            <span class="login-status online"></span>
            <!--change to offline or busy as needed-->
          </div>
          ';
}
echo '
          <div class="nav-profile-text d-flex flex-column">
            <span class="font-weight-bold text-capitalize mb-2">' . $username . '</span>
            <span class="text-secondary text-small">' . $usertype . '</span>
          </div>
          <i class="mdi mdi-bookmark-check text-success nav-profile-badge"></i>
        </a>
      </li>
      ';
if ($usertype == 'SuperUser') {

  echo '
    <li class="nav-item">
      <a class="nav-link" data-bs-toggle="collapse" href="#ui-basic1" aria-expanded="false" aria-controls="ui-basic1">
      <span class="menu-title">Super User</span>
      <i class="menu-arrow"></i>
      <i class="mdi mdi-gavel menu-icon"></i>
      </a>
     <div class="collapse" id="ui-basic1">
      <ul class="nav flex-column sub-menu">
      <li class="nav-item">
      <a class="nav-link" href="grading.php">
        Dashboard
      
      </a>
    </li>
    <li class="nav-item">
     <a href="liveaqa_team.php" class=" nav-link "  >
        Live QA
      
      </a>
    </li>
    
    <li class="nav-item">
     
      <a href="evaluation_results.php" class=" nav-link "  >Evaluation details
<!--        // <i class="mdi mdi-chart-line menu-icon"></i> -->
      </a>
    </li>
    <li class="nav-item "> <a href="assign_judge_team.php" class=" nav-link "  >
    Assign Teams Vs Judges</a></li>
    <li class="nav-item"><a href="view_judges_team.php"   class=" nav-link " >
    View Assigned Teams Vs Judges</a></li>
      </ul>
    </div>
  </li>
   <li class="nav-item">
      <a class="nav-link" data-bs-toggle="collapse" href="#ui-basic2" aria-expanded="false" aria-controls="ui-basic2">
        <span class="menu-title">Student</span>
        <i class="menu-arrow"></i>
        <i class="mdi mdi-account menu-icon"></i>
      </a>
      <div class="collapse" id="ui-basic2">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item "> <a href="student_profiles.php" class=" nav-link "  >
          Profile</a></li>
          <li class="nav-item "> <a href="#" class=" nav-link "  >
          LogBook</a></li>
          <li class="nav-item">
      <a class="nav-link ui-3" data-bs-toggle="collapse1" href="#" data-bs-target="#ui-basic3" aria-expanded="false" aria-controls="ui-basic3">
        <span class="menu-title">Tools</span>
        <i class="menu-arrow"></i>
        <i class="mdi mdi-toolbox menu-icon"></i>
      </a>
      <div class="collapse collapse1" id="ui-basic3">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item "> <a href="#" class=" nav-link "  >
          BrainStorm</a></li>
          <li class="nav-item "> <a href="#" class=" nav-link "  >
          Fishbone</a></li>
         
         
        </ul>
      </div>
    </li> 
         
        </ul>
      </div>
    </li>   
    
    <li class="nav-item">
    <a class="nav-link" data-bs-toggle="collapse" href="#ui-basic4" aria-expanded="false" aria-controls="ui-basic4">
      <span class="menu-title">User View</span>
      <i class="menu-arrow"></i>
      <i class="mdi mdi-account-group menu-icon"></i>
    </a>
    <div class="collapse" id="ui-basic4">
      <ul class="nav flex-column sub-menu">
        <li class="nav-item "> <a href="users.php?type=SuperUser" class=" nav-link "  >
        Super Users</a></li>
        <li class="nav-item"><a href="users.php?type=Student" class=" nav-link " >
        Student List</a></li>
        <li class="nav-item"><a href="users.php?type=Judge" class=" nav-link "  >
        Judge List</a></li>
        <li class="nav-item"><a href="users.php?type=Mentor" class=" nav-link "  >
        Teacher List</a></li>
        <li class="nav-item"><a href="edit_users.php" class=" nav-link "  >
        Edit Users</a></li>
      </ul>
    </div>
  </li>
  <li class="nav-item">
  <a class="nav-link" data-bs-toggle="collapse" href="#ui-basic7" aria-expanded="false" aria-controls="ui-basic7">
    <span class="menu-title">Judge</span>
    <i class="menu-arrow"></i>
    <i class="mdi mdi-account-group menu-icon"></i>
  </a>
 
</li>
  <li class="nav-item">
        <a class="nav-link" data-bs-toggle="collapse" href="#ui-basic5" aria-expanded="false" aria-controls="ui-basic5">
          <span class="menu-title">Teacher</span>
          <i class="menu-arrow"></i>
          <i class="mdi mdi-account-group menu-icon"></i>
        </a>
        <div class="collapse" id="ui-basic5">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item "> <a href="users.php" class=" nav-link "  >
            link1</a></li>
            <li class="nav-item"><a href="teams.php" class=" nav-link " >
            link2</a></li>
            <li class="nav-item"><a href="judges.php" class=" nav-link "  >
            link3</a></li>
          </ul>
        </div>
      </li>
      <li class="nav-item">
      <a class="nav-link" data-bs-toggle="collapse" href="#ui-basic6" aria-expanded="false" aria-controls="ui-basic6">
        <span class="menu-title">Team</span>
        <i class="menu-arrow"></i>
        <i class="mdi mdi-account-group menu-icon"></i>
      </a>
      <div class="collapse" id="ui-basic6">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item "> <a href="assign_judge_team.php" class=" nav-link "  >
          Assign Teams Vs Judges</a></li>
          <li class="nav-item"><a href="view_judges_team.php"   class=" nav-link " >
          View Assigned Teams Vs Judges</a></li>
         
        </ul>
      </div>
    </li>';
} elseif ($usertype == 'Mentor') {

  if($fquery['Year']==$current_year){
  echo '
      <li class="nav-item">
        <a class="nav-link" href="./../mentor/home.php">
          <span class="menu-title">Home</span>
          <i class="mdi mdi-home menu-icon"></i>
        </a>
      </li>
    
    
      <li class="nav-item">
        <a class="nav-link" data-bs-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
          <span class="menu-title">Previous Year</span>
          <i class="menu-arrow"></i>
          <i class="mdi mdi-calendar menu-icon"></i>
        </a>
        <div class="collapse" id="ui-basic">
          <ul class="nav flex-column sub-menu">
           ';
  $current = date("Y");

  $q_y = mysqli_query($conn, "select distinct year
          from tbl_team tt, tbl_team_mentor ttm
          where ttm.team_id = tt.id
          and tt.deleted = 0
          and year <> $current");
  while ($q_y_d = mysqli_fetch_assoc($q_y)) {
    $y = $q_y_d['year'];

    echo ' <li class="nav-item "> <a class="nav-link" href="../mentor/home.php?year=' . $y . '">' . $y . '</a></li>';
  }
  echo '
        
         
          </ul>
        </div>
      </li>
      <li class="nav-item">
      <a class="nav-link" data-bs-toggle="collapse" href="#ui-basic2" aria-expanded="false" aria-controls="ui-basic2">
        <span class="menu-title">Last Year Events</span>
        <i class="menu-arrow"></i>
        <i class="mdi mdi-calendar-check menu-icon"></i>
      </a>
      <div class="collapse" id="ui-basic2">
        <ul class="nav flex-column sub-menu">';
  $current1 = date("Y");

  $q_y1 = mysqli_query($conn, "select distinct year
      from tbl_team tt, tbl_team_mentor ttm
      where ttm.team_id = tt.id
      and tt.deleted = 0
      and year <> $current1");
  while ($q_y_d = mysqli_fetch_assoc($q_y1)) {
    $y1 = $q_y_d['year'];

    echo ' <li class="nav-item "> <a class="nav-link" href="../mentor/home_prev.php?year=' . $y1 . '">' . $y1 . '</a></li>';
  }
  echo '
         
        </ul>
      </div>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="./../mentor/students.php">
          <span class="menu-title">Student</span>
          <i class="mdi mdi-account menu-icon"></i>
        </a>
      </li>';}else{
      echo'  <li class="nav-item">
        <a class="nav-link" href="./../mentor/home.php">
          <span class="menu-title">Home</span>
          <i class="mdi mdi-home menu-icon"></i>
        </a>
      </li>';
      }
} elseif ($usertype == 'Judge') {
  echo '
        <li class="nav-item">
          <a class="nav-link" href="../judges/home.php">
            <span class="menu-title">Home</span>
            <i class="mdi mdi-home menu-icon"></i>
          </a>
        </li>
      ';
} elseif ($usertype == 'General User') {
  echo '
          <li class="nav-item">
            <a class="nav-link" href="./judge/home.php">
              <span class="menu-title">Home</span>
              <i class="mdi mdi-home menu-icon"></i>
            </a>
          </li>
          <li class="nav-item">
          <a class="nav-link" data-bs-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
            <span class="menu-title">Previous Year</span>
            <i class="menu-arrow"></i>
            <i class="mdi mdi-calendar menu-icon"></i>
          </a>
          <div class="collapse" id="ui-basic">
            <ul class="nav flex-column sub-menu">
             ';
  $current = date("Y");

  $q_y = mysqli_query($conn, "select distinct year
            from tbl_team tt, tbl_team_mentor ttm
            where ttm.team_id = tt.id
            and tt.deleted = 0
            and year <> $current");
  while ($q_y_d = mysqli_fetch_assoc($q_y)) {
    $y = $q_y_d['year'];

    echo ' <li class="nav-item "> <a class="nav-link" href="../generaluser/home.php?year=' . $y . '">' . $y . '</a></li>';
  }
  echo '
          
           
            </ul>
          </div>
        </li>';
} elseif ($usertype == 'Student') {

  if($fquery['Year']==$current_year){
  echo '
            <li class="nav-item">
              <a class="nav-link" href="../student/home.php">
                <span class="menu-title">Home</span>
                <i class="mdi mdi-view-dashboard menu-icon"></i>
              </a>
            </li>
            <li class="nav-item">
            <a class="nav-link" href="../student/home.php">
              <span class="menu-title">My Team</span>
              <i class="mdi mdi-account-group menu-icon"></i>
            </a>
          </li>';
          //  if (($year) == date("Y")) { 
					// 	if($date <= $date_check)
					// 	{
				
				// $q_team_1 = mysqli_query($conn,"select *
				// from tbl_team_member ttm
				// where ttm.student_id = $user_id 
        //         and ttm.team_id is null");
				// $c_rows = mysqli_num_rows($q_team_1);
				// #echo 'this is count'.$c_rows;
				// if($c_rows > 0 )
				// {
				
				echo '
        <li class="nav-item">
        <a class="nav-link" href="../student/teams1.php">
          <span class="menu-title">Add Teams</span>
          <i class="mdi mdi-plus menu-icon"></i>
        </a>
      </li>
';
      // } } }
      echo '
      <li class="nav-item"  >
      <a class="nav-link" href="Photo-video waiver form1.pdf" target="_blank">
      <span class="menu-title">Download Consent Form</span>
      <i class="mdi mdi-download menu-icon"></i></a>
    </li>
            <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
              <span class="menu-title">Last Year Events</span>
              <i class="menu-arrow"></i>
              <i class="mdi mdi-calendar menu-icon"></i>
            </a>
            <div class="collapse" id="ui-basic">
              <ul class="nav flex-column sub-menu">
               ';
    $current = date("Y");
  
    $q_y = mysqli_query($conn, "select distinct year
              from tbl_team tt, tbl_team_mentor ttm
              where ttm.team_id = tt.id
              and tt.deleted = 0
              and year <> $current");
    while ($q_y_d = mysqli_fetch_assoc($q_y)) {
      $y = $q_y_d['year'];
  
      echo ' <li class="nav-item "> <a class="nav-link" href="../generaluser/generalhome.php?year=' . $y . '">' . $y . '</a></li>';
    }
    echo '
               
              </ul>
            </div>
          </li>
        
          <li class="nav-item "> <a href="#" class=" nav-link "  >
          LogBook</a></li>
          <li class="nav-item">
      <a class="nav-link ui-3" data-bs-toggle="collapse1" href="#" data-bs-target="#ui-basic3" aria-expanded="false" aria-controls="ui-basic3">
        <span class="menu-title">Tools</span>
        <i class="menu-arrow"></i>
        <i class="mdi mdi-toolbox menu-icon"></i>
      </a>
      <div class="collapse collapse1" id="ui-basic3">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item "> <a href="#" class=" nav-link "  >
          BrainStorm</a></li>
          <li class="nav-item "> <a href="#" class=" nav-link "  >
          Fishbone</a></li>
         
         
        </ul>
      </div>
    </li> ';}else{

    echo'  <li class="nav-item">
              <a class="nav-link" href="../student/home.php">
                <span class="menu-title">Home</span>
                <i class="mdi mdi-view-dashboard menu-icon"></i>
              </a>
            </li>';

    }
}

echo '</ul>
  </nav>';

?>