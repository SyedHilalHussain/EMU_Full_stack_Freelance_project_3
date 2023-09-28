<?php
session_start();
include '../adminpanel/superadmin/config.php';
$id = $_SESSION['id'];
$name = $_SESSION['name'];
$usertype = $_SESSION['user_type'];
$username = $_SESSION['name'];
$current_year =date('Y');
$q = mysqli_query($conn, "select * from tbl_user where id = $id");
$r = mysqli_fetch_assoc($q);
extract($_POST);
if (isset($_POST['submit'])) {
  $first_name = $_POST['first_name'];
  $last_name = $_POST['last_name'];
  $phone = $_POST['phone'];
  $password = $_POST['password'];
  $user_type = $_POST['user_type'];
  $year = date('Y');

  if (isset($_FILES['dp']) && $_FILES['dp']['size'] > 0) {



    $filesize = $_FILES['dp']['size'];
    $filetmpname = $_FILES["dp"]["tmp_name"];
    $filename = $_FILES["dp"]["name"];

    $fileext = explode('.', $filename);
    $filenewname = rand(99999, 1000000) . "-" . $filename;
    $filedestination = '../adminpanel/profilepic/' . $filenewname;
    $fileactualext = strtolower(end($fileext));
    $allow = array('jpg', 'jpeg', 'pdf', 'png', 'gif', 'docx');
    if (in_array($fileactualext, $allow)) {
      if ($filesize < 1000000) {
        if (move_uploaded_file($filetmpname, $filedestination)) {

          $q = ("update tbl_user set first_name = '$first_name', 
												last_name = '$last_name',
												phone = '$phone',
												email = '$email',
												password = '$password',
												user_type = '$user_type',
                        Year = '$year',
                                                profile_pic='$filenewname' where id = $id");
          $q_u = mysqli_query($conn, $q);
          if ($q_u && isset($_SERVER['HTTP_REFERER'])) {
            header('Location: ' . $_SERVER['HTTP_REFERER']);
          } else {
            echo ('Location: ' . $_SERVER['PHP_SELF']);
          }
        } else {
          echo "<script>alert('Unexpected Error Try Again!')</script>";
        }
      } else {
        echo "<script>alert('Too Big File For profile')</script>";
      }
    } else {
      echo "<script>alert('Invalid Picture For profile')</script>";
    }
  } else {

    $q = ("update tbl_user set first_name = '$first_name', 
												last_name = '$last_name',
												phone = '$phone',
												email = '$email',
												password = '$password',
												user_type = '$user_type' 
                        Year = '$year',
                        
                        where id = $id");
    $q_u = mysqli_query($conn, $q);
    if ($q_u && isset($_SERVER['HTTP_REFERER'])) {
      header('Location: ' . $_SERVER['HTTP_REFERER']);
    } else {
      echo ('Location: ' . $_SERVER['PHP_SELF']);
    }
  }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Purple Admin</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="./assets/vendors/mdi/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="./assets/vendors/css/vendor.bundle.base.css">
  <!-- endinject -->
  <!-- Plugin css for this page -->
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <!-- endinject -->
  <!-- Layout styles -->
  <link rel="stylesheet" href="./assets/css/style2.css">
  <!-- End layout styles -->
  <link rel="shortcut icon" href="./assets/images/favicon.ico" />

  <style>
    @media(max-width:400px) {


      .form-control,
      .form-select {
        display: block;
        width: 100%;
        padding: 0.3rem .5rem !important;
        font-size: .7rem !important;
        font-weight: 400;
        line-height: 1;


      }

      .form-select option {

        width: 50% !important;
        padding: 0.3rem .5rem !important;
        font-size: xx-small;
        font-weight: 400;
        line-height: 1;
        background-color: yellow;


      }
    }
  </style>

</head>

<body>
  <div class="container-scroller">

    <?php echo  '<nav class="navbar default-layout-navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
  <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
    <a class="navbar-brand brand-logo" href="index.html"><img src="./assets/images/emuinventlogo.jpg" alt="logo" /></a>
    <a class="navbar-brand brand-logo-mini" href="index.html"><img src="./assets/images/mini-logopic.PNG" alt="logo" /></a>
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
        ';
    if ($r['profile_pic'] != NULL && $r['profile_pic'] != '') {
      echo
      '  
          <div class="nav-profile-img">
          <img src="./profilepic/' . $r['profile_pic'] . '" alt="image">
            
            <span class="availability-status online"></span>
          </div>
          ';
    } else {
      echo '
            <div class="nav-profile-img">
           
              <img src="./assets/images/faces-clipart/pic-4.png" alt="image">
              <span class="availability-status online"></span>
            </div>';
    }
    echo '
          <div class="nav-profile-text">
            <p class="mb-1 text-black">Hi <span class="text-capitalize">' . $username . '</span></p>
          </div>
        </a>';
    if (isset($_SESSION['id'])) {
      $user_id = $_SESSION['id'];
      echo  '<div class="dropdown-menu navbar-dropdown" aria-labelledby="profileDropdown">
          <a class="dropdown-item" href="./profile.php?id=' . $user_id . '">
            <i class="mdi mdi-cached me-2 text-success"></i>User Profile</a>
          <div class="dropdown-divider"></div>
          ';
      if (isset($_SESSION['user_type']) && $_SESSION['user_type'] == 'Student') {
        echo '<a class="dropdown-item" href="./student/edit_member.php?student_id=' . $user_id . '">
      <i class="mdi mdi-cached me-2 text-success"></i>Student Proile</a>
    <div class="dropdown-divider"></div>
    ';
      }
      echo '    
          <a class="dropdown-item" href="../logout.php">
            <i class="mdi mdi-logout me-2 text-primary"></i> Signout </a>
        </div>';
    }
    echo '
      </li>
      
    
      <li class="nav-item nav-logout d-none d-lg-block">
        <a class="nav-link" href="../logout.php">
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
    if ($r['profile_pic'] != NULL && $r['profile_pic'] != '') {
      echo
      '  
          <div class="nav-profile-image">
            <img src="./profilepic/' . $r['profile_pic'] . '" alt="profile">
            <span class="login-status online"></span>
            <!--change to offline or busy as needed-->
          </div>
          ';
    } else {
      echo '
          <div class="nav-profile-image">
            <img src="./assets/images/faces-clipart/pic-4.png" alt="profile">
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
      <a class="nav-link" href="./superadmin/grading.php">
        Dashboard
      
      </a>
    </li>
    <li class="nav-item">
     <a href="./superadmin/liveaqa_team.php" class=" nav-link "  >
        Live QA
      
      </a>
    </li>
    
    <li class="nav-item">
     
      <a href="./superadmin/evaluation_results.php" class=" nav-link "  >Evaluation details
<!--        // <i class="mdi mdi-chart-line menu-icon"></i> -->
      </a>
    </li>
    <li class="nav-item "> <a href="./superadmin/assign_judge_team.php" class=" nav-link "  >
    Assign Teams Vs Judges</a></li>
    <li class="nav-item"><a href="./superadmin/view_judges_team.php"   class=" nav-link " >
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
          <li class="nav-item "> <a href="./superadmin/student_profiles.php" class=" nav-link "  >
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
        <li class="nav-item "> <a href="./superadmin/users.php?type=SuperUser" class=" nav-link "  >
        Super Users</a></li>
        <li class="nav-item"><a href="./superadmin/users.php?type=Student" class=" nav-link " >
        Student List</a></li>
        <li class="nav-item"><a href="./superadmin/users.php?type=Judge" class=" nav-link "  >
        Judge List</a></li>
        <li class="nav-item"><a href="./superadmin/users.php?type=Mentor" class=" nav-link "  >
        Teacher List</a></li>
        <li class="nav-item"><a href="./superadmin/edit_users.php" class=" nav-link "  >
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
      if($r['Year']==$current_year){
      echo '
      <li class="nav-item">
        <a class="nav-link" href="../adminpanel/mentor/home.php">
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

        echo ' <li class="nav-item "> <a class="nav-link" href="../adminpanel/mentor/home.php?year=' . $y . '">' . $y . '</a></li>';
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

        echo ' <li class="nav-item "> <a class="nav-link" href="../adminpanel/mentor/home_prev.php?year=' . $y1 . '">' . $y1 . '</a></li>';
      }
      echo '
         
        </ul>
      </div>
    </li>
    <li class="nav-item">
    <a class="nav-link" href="../adminpanel/mentor/students.php">
      <span class="menu-title">Student</span>
      <i class="mdi mdi-account menu-icon"></i>
    </a>
  </li>
    ';}else{
      echo '
      <li class="nav-item">
        <a class="nav-link" href="../adminpanel/mentor/home.php">
          <span class="menu-title">Home</span>
          <i class="mdi mdi-home menu-icon"></i>
        </a>
      </li>';
    }
    } elseif ($usertype == 'Judge') {
      echo '
        <li class="nav-item">
          <a class="nav-link" href="../adminpanel/judges/home.php">
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
      if($r['Year'] == $current_year) { 
      echo '
            <li class="nav-item">
              <a class="nav-link" href="../adminpanel/student/home.php">
                <span class="menu-title">Home</span>
                <i class="mdi mdi-view-dashboard menu-icon"></i>
              </a>
            </li>
            <li class="nav-item">
            <a class="nav-link" href="../adminpanel/student/home.php">
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
        <a class="nav-link" href="../adminpanel/student/teams1.php">
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

        echo ' <li class="nav-item "> <a class="nav-link" href="../generaluser/home.php?year=' . $y . '">' . $y . '</a></li>';
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
echo'
      <li class="nav-item">
      <a class="nav-link" href="../adminpanel/student/home.php">
        <span class="menu-title">Home</span>
        <i class="mdi mdi-view-dashboard menu-icon"></i>
      </a>
    </li>';
    }
    }

    echo '</ul>
  </nav>'; ?>
    <!-- partial -->
    <div class="main-panel">
      <div class="content-wrapper updated">
        <div class="page-header">
          <h2>User Profile</h2>
          <nav aria-label="breadcrumb">
      <ul class="breadcrumb border-0">
      <li class="breadcrumb-item active" aria-current="page">
      <button id="reloadButton" class="btn page-title-icon btn-sm text-white" onclick="window.history.back() ">Back</button>
          </li>
        </ul>
       </nav>
        </div>


        <div class="my-3 mt-5" style="
                 
                 display: flex;
                 align-items: center;
                 justify-content: center;
                 background-color: #f4f7ff;
                 overflow: hidden;">
          <div class="toast1 mt-5 ">

            <div class="toast1-content">
              <i class="mdi mdi-alert-circle-outline check"></i>

              <div class="message1">
                <span class="text text-1"></span>
                <span class="text text-2"></span>
              </div>
            </div>
            <i id="popup-close-btn" class="mdi mdi-close close"></i>

            <!-- Remove 'active' class, this is just to show in Codepen thumbnail -->
            <div id="progress1" class="progress1 "></div>
          </div>



        </div>


        <div class="row justify-content-center">
          <div class="col-md-6 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <h4 class="card-title">User Profile</h4>
                <p class="card-description"> Basic Information</p>
                <form id="profile_updated" enctype="multipart/form-data">


                  <input type="hidden" class="form-control" name="user_id" id="user_id" value="<?php echo $id ?>">










                  <div class="form-group">
                    <label for="email"> <b> First Name: </b> </label>
                    <input type="text" class="form-control" name="first_name" id="first_name" value="<?php echo $r['first_name'] ?>">
                  </div>






                  <div class="form-group">
                    <label for="email"><b> Last Name:</b></label>
                    <input type="text" class="form-control" name="last_name" id="last_name" value="<?php echo $r['last_name'] ?>">
                  </div>




                  <div class="form-group">
                    <label for="email"><b> Email:</b></label>
                    <input type="text" class="form-control" name="email" id="email" value="<?php echo $r['email'] ?>">
                  </div>





                  <div class="form-group">
                    <label for="email"><b>Password:</b></label>
                    <input type="text" class="form-control" name="password" id="password" value="<?php echo $r['password'] ?>">
                  </div>






                  <div class="form-group">
                    <label for="pwd"><b>Contact No:</b></label>
                    <input type="text" class="form-control" name="phone" id="phone" value="<?php echo $r['phone'] ?>">
                  </div>




                  <div class="form-group col-sm-12 ">
                    <label for="type"><b>Type</b></label>
                    <select class="form-select" id="user_type" name="user_type" required>
                      <option selected value="<?php echo $r['user_type'] ?>" ><?php echo $r['user_type'] ?></option>

                      <option value="Mentor">Teacher Or Mentor(parents/teachers)</option>
                      <option value="Student">Student</option>
                      <option value="General User">General User</option>

                    </select>

                  </div>

                 

                    <div class="form-group my-2 " style="display:<?php echo ($_SESSION["user_type"] != "Student") ? 'block': 'none';  ?>">
                      <label for="studentType">Category</label>
                      <select class="form-select" id="category" name="category">
                        <option selected value="<?php echo $r['category'] ?>"><?php echo $r['category'] ?></option>

                        <option value="Professional">Professional/Engineers</option>
                        <option value="Faculty">Faculty </option>
                        <option value="K-12 Teachers">K-12 Teachers </option>
                        <option value="Retired">Retired</option>
                        <option value="Pre-Service teacher">Pre-Service Teacher</option>
                        <option value="Others">Others</option>
                      </select>
                    </div>




                  <?php 
                  if ($r['profile_pic'] == NULL && $r['profile_pic'] == '') { ?>


                    <div class="form-group">
                      <label for="pwd"><b>Upload Profile Pic</b></label>
                      <input type="file" class="form-control" name="dp" id="dp">
                    </div>



                  <?php } else { ?>
                    <a class="text-primary p-2 my-2" href="../adminpanel/profilepic/<?php echo $r['profile_pic'] ?>" target="_blank">View Profile Pic</a>
                    <div class="form-group">
                      <label for="pwd"><b>Upload Profile Pic</b></label>
                      <input type="file" class="form-control" name="dp" id="dp">
                    </div>

                  <?php
                  }
                  ?>


                  <div id="alertBox"> </div>
                  <button type="submit" class="btn btn-primary" name="submit">Submit</button>
                </form>
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
  <script src="./assets/vendors/js/vendor.bundle.base.js"></script>
  <!-- <script src="././assets/js/main.js"></script> -->
  <!-- endinject -->
  <!-- Plugin js for this page -->

  <script src="./assets/js/jquery.cookie.js" type="text/javascript"></script>
  <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
  <!-- End plugin js for this page -->
  <!-- inject:js -->
  <script src="./assets/js/off-canvas.js"></script>
  <script src="./assets/js/hoverable-collapse.js"></script>
  <script src="./assets/js/misc.js"></script>
  <!-- endinject -->
  <!-- Custom js for this page -->

  <script src="./assets/js/todolist.js"></script>
  <script src="./assets/js/ajaxscript.js?v=2" type="text/javascript"></script>
  <!-- End custom js for this page -->
</body>

</html>