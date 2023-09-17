<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title>Dare to Design</title>
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <meta content="" name="keywords">
  <meta content="" name="description">
  <link rel="stylesheet" href="adminpanel/assets/vendors/mdi/css/materialdesignicons.min.css">
  
  <style>
    /*  vanila js alert box */
    .bg-gradient-warning {
    background: -webkit-gradient(linear, left top, right top, from(#f6e384), to(#ffd500)) !important;
    background: linear-gradient(to right, #f6e384, #ffd500) !important; }
  
  .bg-gradient-danger {
    background: -webkit-gradient(linear, left top, right top, from( #fa5f5f), to(#f70f0f)) !important;
    background: linear-gradient(to right,  #fa5f5f, #f70f0f) !important; }
    .bg-gradient-success-dark {
      background: -webkit-gradient(linear, left top, right top, from(#57D9A3), to(#36B37E)) !important;
  background: linear-gradient(to right, #57D9A3,#36B37E) !important;  }
    .toast1 {
      position: absolute;
      top: 25px;
      right: 30px;
      border-radius: 12px;
      background: #fff;
      padding: 20px 35px 20px 25px;
      box-shadow: 0 6px 20px -5px rgba(0, 0, 0, 0.1);
      overflow: hidden;
      transform: translateX(calc(100% + 30px));
      display:block !important;
      transition: all 0.5s cubic-bezier(0.68, -0.55, 0.265, 1.35);

    }


    .toast1.active {
      transform: translateX(0%);


    }

    .toast1 .toast1-content {
      display: flex;
      align-items: center;
    }

    .toast1-content .check {
      display: flex;
      align-items: center;
      justify-content: center;
      height: 35px;
      min-width: 35px;

      color: blue ;
      font-size: 20px;
      border-radius: 50%;
    }

    .toast1-content .message1 {
      display: flex;
      flex-direction: column;
      margin: 0 20px;
    }

    .message1 .text {
      font-size: 16px;
      font-weight: 400;
      color: #666666;
    }

    .message1 .text.text-1 {
      font-weight: 600;
      color: #333;
    }

    .toast1 .close {
      position: absolute;
      top: 10px;
      right: 15px;
      padding: 5px;
      cursor: pointer;
      opacity: 0.7;
    }

    .toast1 .close:hover {
      opacity: 1;
    }

    .toast1 .progress1 {
      position: absolute;
      bottom: 0;
      left: 0;
      height: 3px;
      width: 100%;

    }

    #progress1::before {
      content: "";
      position: absolute;
      bottom: 0;
      right: 0;
      height: 100%;
      width: 100%;
      background: var(--bgColor, -webkit-gradient(linear, left top, right top, from(#57D9A3), to(#36B37E)));
      background: var(--bgColor, blue);
    }

    .progress1.active:before {
      animation: progress 5s linear forwards;
    }




    @keyframes progress {
      100% {
        right: 100%;
      }
    }



    .toast1.active~.pop-button {
      pointer-events: none;
    }


    /* end */
    @media(min-width:990px) {
      .toast1 {

        top: 17% !important;

      }

    }
  </style>
</head>

<body>




  <!-- Spinner Start  -->
  <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
    <div class="spinner-border text-primary" role="status" style="width: 3rem; height: 3rem;"></div>
  </div>
  <!-- Spinner End -->





  <!-- Navbar Start -->
  <?php include  'header.php';
  include './adminpanel/superadmin/config.php' ?>
  <!-- Navbar End -->


  <!-- Page Header Start -->

  <!-- Page Header End -->

  <div class=" mt-5" style="
                 
               
                 display: flex;
                 align-items: center;
                 justify-content: center;
                 background-color: #f4f7ff;
                 overflow: hidden;">
    <div class="toast1 mt-5 active ">

      <div class="toast1-content">
        <i class="mdi mdi-alert-circle check"></i>

        <div class="message1">
          <span class="text text-1"></span>
          dasd
          <span class="text text-2"></span>
        </div>
      </div>
      <i class="mdi mdi-close close"></i>

      <!-- Remove 'active' class, this is just to show in Codepen thumbnail -->
      <div id="progress1" class="progress1 "></div>
    </div>



  </div>

  <!-- Quote Start -->
  <div class="container-fluid py-2">
    <div class="container">
      <div class="text-center mx-auto wow fadeInUp" data-wow-delay="0.1s" style="max-width: 500px;">
        <p class="fs-5 fw-bold text-primary">Register To Join Dare2Design/EMUiNVENT</p>
        <h1 class="display-5 mb-5"></h1>
      </div>
      <div class="row justify-content-center">
        <div class="col-lg-7">
          <div class="bg-light rounded p-4 p-sm-5 wow fadeInUp" data-wow-delay="0.1s">
            <form class="forms-sample" id="registration">
              <div class="row g-3">
                
                  <div class="form-floating col-sm-12 ">

                    <select class="form-select" id="type" name="category" onchange="func_reg(this.value)" required>
                      <option selected value="" disabled>Select type</option>

                      <option value="Mentor">Teacher Or Mentor(parents/teachers)</option>
                      <option value="Student">Student</option>
                      <option value="General User">General User</option>

                    </select>
                    <label for="type">Type</label>
                  </div>
              
                  <div class="form-floating">

                    <input type="text" class="form-control" id="fname" name="fname" placeholder="First Name" value="" required>
                    <label for="fname">First Name</label>
                  </div>
               
                  <div class="form-floating">


                    <input type="text" class="form-control" id="lname" name="lname" placeholder="Last Name" value="" required>
                    <label for="lname">Last Name</label>
                  </div>
               
                  <div class="form-floating">
                    <input type="email" class="form-control" id="email" name="email" placeholder="Email" value="" required>
                    <label for="email">Email</label>

                  </div>
                
                  <div class="form-floating" id="phone">
                    <input type="text" class="form-control" id="contact" placeholder="Contact" name="contact" value="" required>
                    <label for="contact">Phone No</label>

                  </div>
                
                
                  <div class="form-floating" id="mentor" style="display:none">
                  

                    <select class="form-select" name="mentor_id" id="mentor_id" required>
                      
                      <?php $q = mysqli_query($conn, "select id, first_name, last_name from tbl_user where user_type = 'Mentor' and is_approved = 1 and year = '2021' order by first_name asc");
                      while ($r = mysqli_fetch_assoc($q)) {
                      ?>
                        <option value="<?php echo $r['id'] ?>"><?php echo $r['first_name'] . ' ' . $r['last_name']; ?></option>
                      <?php } ?>


                    </select>
                    <label for="mentor_id" >Select Mentor/Teacher.If you dont't have one Select D2D.</label>
                  </div>
                

                  <div class="form-floating" id="address1">
                    <input type="text" class="form-control" id="address" name="address" placeholder="Last Name" value="" required>
                    <label for="address">Address</label>

                  </div>
               
                  <div class="form-floating">

                    <input type="password" class="form-control" id="password" name="password" placeholder="Password" value="" required>
                    <label for="password">Password</label>

                    <i class="mdi mdi-eye-slash" id="togglePassword"></i>
                  </div>
              
                  <div class="form-floating">
                    <input type="password" class="form-control" id="confirmpassword" name="password" placeholder="Password" value="" required>
                    <label for="confirmpassword">Confirm Password</label>

                    <span class="form-text confirm-message"></span>
                  </div>
                </div>

                <div class="col-12 text-center">
                  <button type="submit" name="submit" class="btn btn-success me-2">Submit</button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>


    </div>
  </div>
  <!-- Quote End -->

  <!-- Team Start -->



  <!-- Footer Start -->
  <?php include  'footer.php'; ?>
  <!-- Footer End -->





  <!-- Back to Top -->
  <a href="#" class="btn btn-lg btn-primary btn-lg-square rounded-circle back-to-top"><i class="bi bi-arrow-up"></i></a>

  <script>
    function func_reg(Selectedvalue) {
      //alert(Selectedvalue);
      var a = Selectedvalue;
      var b = 'General User';
      var c = 'Student';
      var ans = a.localeCompare(b);
      var stud = a.localeCompare(c);
      if (ans == 0) {
        document.getElementById('phone').style.display = 'none';
        document.getElementById('address1').style.display = 'none';
        document.getElementById("contact").required = false;
        document.getElementById("address").required = false;
        document.getElementById('mentor').style.display = 'none';
		document.getElementById('mentor_id').required = false;


      } else if (stud == 0) {
        document.getElementById('mentor').style.display = 'block';
        document.getElementById('mentor_id').required = true;
        
      } else {

        document.getElementById('phone').style.display = 'block';
        document.getElementById('address1').style.display = 'block';
        document.getElementById("phone").required = true;
        document.getElementById("address").required = true;
        document.getElementById('mentor').style.display = 'none';
		document.getElementById('mentor_id').required = false;
      }




      //location.reload();
    }
  </script>
  <script src="./assets/js/jquery-3.3.1.min.js"></script>
  <script type="text/javascript" src="./assets/js/ajax.js?v=4"></script>

</body>

</html>