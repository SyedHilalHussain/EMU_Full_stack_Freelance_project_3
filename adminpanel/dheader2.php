
<?php

session_start();
header("Cache-Control: no-cache, no-store, must-revalidate");
include '../superadmin/config.php';
$usertype = $_SESSION['user_type'];
$username =$_SESSION['name'] ;
if(!isset($_SESSION)){
session_start();
}
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
          <input type="text" class="form-control bg-transparent border-0" placeholder="Search projects">
        </div>
      </form>
    </div>
    <ul class="navbar-nav navbar-nav-right">
      <li class="nav-item nav-profile dropdown">
        <a class="nav-link dropdown-toggle" id="profileDropdown" href="#" data-bs-toggle="dropdown" aria-expanded="false">
          <div class="nav-profile-img">
            <img src="../assets/images/faces/ai2.png" alt="image">
            <span class="availability-status online"></span>
          </div>
          <div class="nav-profile-text">
            <p class="mb-1 text-black">Hi <span class="text-capitalize">'.$username.'</span></p>
          </div>
        </a>
        <div class="dropdown-menu navbar-dropdown" aria-labelledby="profileDropdown">
          <a class="dropdown-item" href="#">
            <i class="mdi mdi-cached me-2 text-success"></i>Profile</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="./../../logout.php">
            <i class="mdi mdi-logout me-2 text-primary"></i> Signout </a>
        </div>
      </li>
      
    
      <li class="nav-item nav-logout d-none d-lg-block">
        <a class="nav-link" href="#">
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
          <div class="nav-profile-image">
            <img src="../assets/images/faces/ai2.png" alt="profile">
            <span class="login-status online"></span>
            <!--change to offline or busy as needed-->
          </div>
          <div class="nav-profile-text d-flex flex-column">
            <span class="font-weight-bold text-capitalize mb-2">'.$username.'</span>
            <span class="text-secondary text-small">'.$usertype.'</span>
          </div>
          <i class="mdi mdi-bookmark-check text-success nav-profile-badge"></i>
        </a>
      </li>
      ';
if($usertype=='SuperUser'){ 
  
    echo '
      <li class="nav-item">
        <a class="nav-link" href="grading.php">
          <span class="menu-title">Dashboard</span>
          <i class="mdi mdi-view-dashboard menu-icon"></i>
        </a>
      </li>
      <li class="nav-item">
      <a href="liveaqa_team.php" class=" nav-link "  >
          <span class="menu-title">Live QA</span>
          <i class="mdi mdi-comment-multiple-outline menu-icon"></i>
        </a>
      </li>
      <li class="nav-item">
       
        <a href="evaluation_results.php" class=" nav-link "  > <span class="menu-title">Evaluation details</span>
          <i class="mdi mdi-chart-line menu-icon"></i>
        </a>
      </li>
    
      <li class="nav-item">
        <a class="nav-link" data-bs-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
          <span class="menu-title">User View</span>
          <i class="menu-arrow"></i>
          <i class="mdi mdi-account-group menu-icon"></i>
        </a>
        <div class="collapse" id="ui-basic">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item "> <a href="users.php" class=" nav-link "  >
            Users</a></li>
            <li class="nav-item"><a href="teams.php" class=" nav-link " >
            Teams</a></li>
            <li class="nav-item"><a href="judges.php" class=" nav-link "  >
            Judges</a></li>
          </ul>
        </div>
      </li>
      <li class="nav-item">
      <a class="nav-link" data-bs-toggle="collapse" href="#ui-basic1" aria-expanded="false" aria-controls="ui-basic">
        <span class="menu-title">Assign Teams Vs Judges</span>
        <i class="menu-arrow"></i>
        <i class="mdi mdi-account-group menu-icon"></i>
      </a>
      <div class="collapse" id="ui-basic1">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item "> <a href="assign_judge_team.php" class=" nav-link "  >
          Assign Teams Vs Judges</a></li>
          <li class="nav-item"><a href="view_judges_team.php"   class=" nav-link " >
          View Assigned Teams Vs Judges</a></li>
         
        </ul>
      </div>
    </li>';
}elseif($usertype=='Mentor'){
  echo '
      <li class="nav-item">
        <a class="nav-link" href="./../mentor/home.php">
          <span class="menu-title">Home</span>
          <i class="mdi mdi-home menu-icon"></i>
        </a>
      </li>
      <li class="nav-item">
      <a class="nav-link" data-bs-toggle="collapse" href="#ui-basic1" aria-expanded="false" aria-controls="ui-basic">
        <span class="menu-title">Add </span>
        <i class="menu-arrow"></i>
        <i class="mdi mdi-plus menu-icon"></i>
      </a>
      <div class="collapse" id="ui-basic1">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item "> <a href="assign_judge_team.php" class=" nav-link "  >
          Teams</a></li>
          
         
        </ul>
      </div>
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

            $q_y = mysqli_query($conn,"select distinct year
          from tbl_team tt, tbl_team_mentor ttm
          where ttm.team_id = tt.id
          and tt.deleted = 0
          and year <> $current");
            while($q_y_d = mysqli_fetch_assoc($q_y))
            {
            $y = $q_y_d['year'];
            
            echo ' <li class="nav-item "> <a class="nav-link" href="../mentor/home.php?year='.$y.'">'.$y.'</a></li>';
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

        $q_y1 = mysqli_query($conn,"select distinct year
      from tbl_team tt, tbl_team_mentor ttm
      where ttm.team_id = tt.id
      and tt.deleted = 0
      and year <> $current1");
        while($q_y_d = mysqli_fetch_assoc($q_y1))
        {
        $y1 = $q_y_d['year'];
        
        echo ' <li class="nav-item "> <a class="nav-link" href="../mentor/home_prev.php?year='.$y1.'">'.$y1.'</a></li>';
         } 	
      echo '
         
        </ul>
      </div>
    </li>';
  }elseif($usertype=='Judge'){
    echo '
        <li class="nav-item">
          <a class="nav-link" href=".././adminpanel/judges/judgehome.php">
            <span class="menu-title">Home</span>
            <i class="mdi mdi-home menu-icon"></i>
          </a>
        </li>
      
      
        
       ';
    }elseif($usertype=='General User'){
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
  
              $q_y = mysqli_query($conn,"select distinct year
            from tbl_team tt, tbl_team_mentor ttm
            where ttm.team_id = tt.id
            and tt.deleted = 0
            and year <> $current");
              while($q_y_d = mysqli_fetch_assoc($q_y))
              {
              $y = $q_y_d['year'];
              
              echo ' <li class="nav-item "> <a class="nav-link" href="../generaluser/home.php?year='.$y.'">'.$y.'</a></li>';
               } 	
            echo '
          
           
            </ul>
          </div>
        </li>';
      }elseif($usertype=='Student'){
        echo '
            <li class="nav-item">
              <a class="nav-link" href="grading.php">
                <span class="menu-title">Home</span>
                <i class="mdi mdi-view-dashboard menu-icon"></i>
              </a>
            </li>
            <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#ui-basic1" aria-expanded="false" aria-controls="ui-basic">
              <span class="menu-title">Add </span>
              <i class="menu-arrow"></i>
              <i class="mdi mdi-account-group menu-icon"></i>
            </a>
            <div class="collapse" id="ui-basic1">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item "> <a href="assign_judge_team.php" class=" nav-link "  >
                Teams</a></li>
                
               
              </ul>
            </div>
          </li>
          
            <li class="nav-item">
              <a class="nav-link" data-bs-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
                <span class="menu-title">Previous Year</span>
                <i class="menu-arrow"></i>
                <i class="mdi mdi-account-group menu-icon"></i>
              </a>
              <div class="collapse" id="ui-basic">
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item "> <a href="users.php" class=" nav-link "  >
                  2020</a></li>
               
                </ul>
              </div>
            </li>
            <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#ui-basic1" aria-expanded="false" aria-controls="ui-basic">
              <span class="menu-title">Last Year Events</span>
              <i class="menu-arrow"></i>
              <i class="mdi mdi-account-group menu-icon"></i>
            </a>
            <div class="collapse" id="ui-basic1">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item "> <a href="assign_judge_team.php" class=" nav-link "  >
                2020</a></li>
                
               
              </ul>
            </div>
          </li>';
              
         
      }
    
    echo '</ul>
  </nav>';

?>