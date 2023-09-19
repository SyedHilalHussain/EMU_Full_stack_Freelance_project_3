<?php
session_start();
include '../superadmin/config.php';
$id = $_SESSION['id'];
$name = $_SESSION['name'];
$usertype = $_SESSION['user_type'];
$username = $_SESSION['name'];
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
    <link rel="stylesheet" href="../assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="../assets/vendors/css/vendor.bundle.base.css">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="../assets/css/style2.css">
    <!-- End layout styles -->
    <link rel="shortcut icon" href="../assets/images/favicon.ico" />

    <style>
        .note-heading {
            font-weight: 900;
            font-size: 3rem;


        }

        ul li {
            line-height: 30px;
            font-size: 1rem;
        }

        @media(max-width:400px) {


            .note-heading {
                font-weight: 900;
                font-size: 2rem;


            }
        }
    </style>

</head>

<body>
    <div class="container-scroller">

        <?php echo  '<nav class="navbar default-layout-navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
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
        ';
        if ($r['profile_pic'] != NULL && $r['profile_pic'] != '') {
            echo
            '  
          <div class="nav-profile-img">
          <img src="../profilepic/' . $r['profile_pic'] . '" alt="image">
            
            <span class="availability-status online"></span>
          </div>
          ';
        } else {
            echo '
            <div class="nav-profile-img">
           
              <img src="../assets/images/faces-clipart/pic-4.png" alt="image">
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
          <a class="dropdown-item" href="../profile.php?id=' . $user_id . '">
            <i class="mdi mdi-cached me-2 text-success"></i>User Profile</a>
          <div class="dropdown-divider"></div>
          ';
            if (isset($_SESSION['user_type']) && $_SESSION['user_type'] == 'Student') {
                echo '<a class="dropdown-item" href="../student/edit_member.php?student_id=' . $user_id . '">
      <i class="mdi mdi-cached me-2 text-success"></i>Student Proile</a>
    <div class="dropdown-divider"></div>
    ';
            }
            echo '    
          <a class="dropdown-item" href="../../logout.php">
            <i class="mdi mdi-logout me-2 text-primary"></i> Signout </a>
        </div>';
        }
        echo '
      </li>
      
    
      <li class="nav-item nav-logout d-none d-lg-block">
        <a class="nav-link" href="../../logout.php">
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
            <img src="../profilepic/' . $r['profile_pic'] . '" alt="profile">
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
    if ($usertype == 'Mentor') {
            echo '
      <li class="nav-item">
        <a class="nav-link" href="../../mentor/home.php">
          <span class="menu-title">Home</span>
          <i class="mdi mdi-home menu-icon"></i>
        </a>
      </li>
      ';
        } elseif ($usertype == 'Judge') {
            echo '
        <li class="nav-item">
          <a class="nav-link" href="../adminpanel/judges/home.php">
            <span class="menu-title">Home</span>
            <i class="mdi mdi-home menu-icon"></i>
          </a>
        </li>
      ';
        } elseif ($usertype == 'Student') {
            echo '
            <li class="nav-item">
              <a class="nav-link" href="../student/home.php">
                <span class="menu-title">Home</span>
                <i class="mdi mdi-view-dashboard menu-icon"></i>
              </a>
            </li>
           ';
         

    
           
 
         
        }

        echo '</ul>
  </nav>'; ?>
        <!-- partial -->
        <div class="main-panel">
            <div class="content-wrapper updated">



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
                    <div class="col-md-12 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <h1 class="note-heading text-center text-dark my-0 py-0">WELCOME TO <span style="color:darkgreen;">EMU</span>iNVENT</h1>
                                <h4 class="text-center mb-5">We're delighted to have you here.</h4>
                                <ul>

                                    <li>To maximize your experience and explore a world of opportunities, we invite you to complete and update your profile.</li>
                                    <li>If you're a new student, create your student profile.</li>
                                    <li>If you're a returning student, update both your student and user profiles.</li>
                                    <li>For non-students, kindly update your user profile.</li>

                                </ul>
                                <h2 class="text-center ">Thank you!</h2>
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
    <!-- <script src="././assets/js/main.js"></script> -->
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

    <script src="../assets/js/todolist.js"></script>

    <!-- End custom js for this page -->
</body>

</html>