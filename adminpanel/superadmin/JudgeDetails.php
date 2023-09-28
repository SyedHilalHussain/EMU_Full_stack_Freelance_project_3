<?php
include 'config.php';
$id = $_GET['id'];

$q = mysqli_query($conn, "select * from tbl_user where id = $id");
$r = mysqli_fetch_assoc($q);



echo '
<div class="page-header">
<h2 >Judge Profile</h2>
<nav aria-label="breadcrumb">
    <ul class="breadcrumb">
      <li class="breadcrumb-item active" aria-current="page">
      <button id="reloadButton" class="btn page-title-icon btn-sm text-white" onclick="window.location.href = "/grading.php/" ;">Back</button>
      </li>
    </ul>
  </nav>
</div>
<div class="row justify-content-center">
    <div class="col-md-6 grid-margin stretch-card">
  <div class="card">
    <div class="card-body">
      <h4 class="card-title">Profile</h4>
      <p class="card-description"> Basic Information</p>
      <form class="forms-sample" id="judge_detail_update" >
        <div class="form-group">
          <label for="exampleInputUsername1">First Name</label> 
          <input type="text" class="form-control" id="exampleInputfname" name="fname" placeholder="First Name"  value="' . $r['first_name'] . '">
        </div>
        <div class="form-group">
          <label for="exampleInputUsername2">Last Name</label>
          <input type="text" class="form-control" id="exampleInputlname"  name="lname" placeholder="Last Name" value="' . $r['last_name'] . '">
        </div>
        <div class="form-group">
          <label for="exampleInputEmail1">Email</label>
          <input type="email" class="form-control" id="exampleInputemail" name="email" placeholder="Email" value="' . $r['email'] . '">
        </div>
        <div class="form-group">
          <label for="exampleInputConfirmPassword1">Password</label>
          <input type="password" class="form-control" id="exampleInputConfirmPassword" name="password" placeholder="Password" value="' . $r['password'] . '">
        </div>
        <div class="form-group">
        <label for="exampleInputConfirmPassword1">Contact No</label>
        <input type="text" class="form-control" id="exampleInputContactNo" placeholder="Contact" name="contact" value="' . $r['phone'] . '">
      </div>
      <div class="form-group ">
                            <label for="studentType">Category</label>
                            <select class="form-select" id="SelectDepartment" name="category">
				                  	<option selected value="' . $r['category'] . '">' . $r['category'] . '</option>
                        
                            <option value="Professional">Professional/Engineers</option>
                                <option value="Faculty">Faculty </option>
								                <option value="K-12 Teachers">K-12 Teachers </option>
                                <option value="Student">Student</option>
                                <option value="Pre-Service teacher">Pre-Service Teacher</option>
								                <option value="Others">Others</option>
                            </select>
                        </div>
                        <div class="form-group">
                        <label for="studentType">Judge Confirm</label>
                        <select class="form-select" id="SelectDepartment" name="judge_confirm">
          ';
if ($r['judge_confirm'] = 'Y') {
  $val = 'Yes';
} else {
  $val = 'No';
}

echo ' <option selected value="' . $r['judge_confirm'] . '">' . $val . '</option>
              <option value="Y">Yes</option>
                            <option value="N">No</option>
                        </select>
                    </div>
       
        <button type="submit"   name="submit" class="btn btn-gradient-success me-2">Submit</button>
       
      </form>
    </div>
  </div>
    </div>


         
    
  

</div>
';
