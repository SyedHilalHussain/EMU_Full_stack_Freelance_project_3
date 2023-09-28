<?php
include 'config.php';
session_start();

$type = 'Judge';
$id = $_SESSION['id'];

$team_id = base64_decode($_GET['team_id']);

$q_vt = mysqli_query($conn,"select distinct tt.id as team_id,tt.project_team_name as project_name,tt.project_description,tu.first_name, tu.last_name,tt.video_pitch, tt.log_book,tu.email 
from tbl_team tt, tbl_team_mentor ttm, tbl_user tu
											where tt.id = $team_id
											and tt.id = ttm.team_id
											and ttm.user_id = tu.id");

$d_vt = mysqli_fetch_assoc($q_vt);

$url = $d_vt['video_pitch'];
preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $url, $match);
if (!empty($match) && isset($match[1])) {
    $youtube_id = $match[1];
} else {
    // Handle the case when the YouTube ID is not found or URL is not present.
    $youtube_id = null; // You can set a default value or take appropriate action.
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
    
    <style>
        .update_table th {
            font-size: 15px !important;

        }

        .update_table td {
            font-size: 12px !important;

        }

        .form-heading {

            background: -webkit-gradient(linear, left top, right top, from(#ACE1AF), to(#98FF98)) !important;
            background: linear-gradient(to right, #ACE1AF, #98FF98) !important;
            padding: 1.25rem;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            color: #333333;
            /* opacity: 0.9; */
            border-radius: 5px;
            margin: 20px 5px;
            font-size: 1.5rem;


        }

        .forms-sample .form-group {
            display: flex;

            justify-content: space-between !important;
        }

        .form-group iframe {
            width: 100%;
            height: 400px;
            
        }

        select {

            display: block;
            width: 20%;
            padding: 0.375rem 1.2rem 0.375rem 0.3rem;
            -moz-padding-start: calc(0.75rem - 3px);
            font-size: .8rem;
            font-weight: 400;
            line-height: 1.5;
            color: black;
            font-family: 'Poppins', sans-serif !important;
            background-color: #fff;
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16'%3e%3cpath fill='none' stroke='%23343a40' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M2 5l6 6 6-6'/%3e%3c/svg%3e");
            background-repeat: no-repeat;
            background-position: right 0.3rem center;
            background-size: 15px 12px;
            border: 1px solid #ced4da;
            border-radius: 2px;
            -webkit-transition: border-color 0.15s ease-in-out, -webkit-box-shadow 0.15s ease-in-out;
            transition: border-color 0.15s ease-in-out, -webkit-box-shadow 0.15s ease-in-out;
            transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
            transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out, -webkit-box-shadow 0.15s ease-in-out;
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;

        }

        textarea {
            -webkit-transition: border-color 0.15s ease-in-out, -webkit-box-shadow 0.15s ease-in-out;
            transition: border-color 0.15s ease-in-out, -webkit-box-shadow 0.15s ease-in-out;
            transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
            transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out, -webkit-box-shadow 0.15s ease-in-out;
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
            border: 1px solid #ced4da;
            width: 350px;
            height: 120px;
        }

        .content-wrapper {}

        @media (max-width:1200px) {
            textarea {
                width: 200px;

                font-size: small;
            }

            .form-heading {
                font-size: 15px;
                padding: .8rem;
            }

            .form-group iframe {
                width: 300px;
                height: 300px;
            }

        }
    </style>
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
                        </span> Dashboard ->
                        <span class="subtitle">Team Editing</span>
                    </h3>
                    <nav aria-label="breadcrumb">
    <ul class="breadcrumb">
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
                            <i class="mdi mdi-alert-circle-outline check" id="check"></i>

                            <div class="message1">
                                <span class="text text-1"></span>
                                <span class="text text-2"></span>
                            </div>
                        </div>
                        <i class="mdi mdi-close close"></i>

                        <!-- Remove 'active' class, this is just to show in Codepen thumbnail -->
                        <div id="progress1" class="progress1 "></div>
                    </div>



                </div>
                <div class="content-wrapper-inside">
                    <div class="row">
                        <div class="col-md-7 col-sm-12 grid-margin align-item-center justify-content-center">
                            <div class="card">
                                <div class="card-body">
                                    <h3>Team Information</h3>
                                    <div class="table-responsive">
                                        <table class="table team_table update_table">
                                            <thead class="thead-dark" id="table">
                                                <tr>
                                                    <!--<th scope="col">Team ID</th>-->
                                                    <th scope="col">Team Name</th>
                                                    <th scope="col">Project Description</th>
                                                    <th scope="col">Team Cateogory</th>
                                                    <th scope="col">Video Pitch</th>
                                                    <th scope="col">LogBook</th>
                                                    <th scope="col">Team Members</th>

                                                </tr>
                                            </thead>
                                            <tbody>

                                                <?php
                                                $q_team = mysqli_query($conn, "select distinct tt.id as team_id,tt.project_team_name as project_name,tt.category,tt.project_description,tt.video_pitch, tt.log_book
											from tbl_team tt, tbl_team_mentor ttm, tbl_team_member tm 
											where ttm.user_id = $id 
											and tt.id = $team_id
											and tt.id = ttm.team_id
											

									");

                                                while ($r_team = mysqli_fetch_assoc($q_team)) {
                                                    $team_id = $r_team['team_id'];


                                                ?>

                                                    <tr>
                                                        <!--<td><?php echo $r_team['team_id'] ?></a></td> -->
                                                        <td><?php echo $r_team['project_name'] ?></a></td>
                                                        <td><?php echo $r_team['project_description'] ?></td>
                                                        <td><?php echo $r_team['category'] ?></td>
                                                        <!--<td><iframe frameborder="0" height="100" width="100" 
														src="https://www.youtube.com/embed/sA9DwvbQ-hI">
													  </iframe></a></td> -->
                                                        <?php if ($r_team['video_pitch']) { ?>
                                                            <td><a href="<?php echo $r_team['video_pitch'] ?>" target="_blank">Video Pitch</a></td>
                                                        <?php } else { ?>
                                                            <td></td>
                                                        <?php }
                                                        if ($r_team['log_book']) {  ?>
                                                            <td><a href="http://grading.emuem.org/Team/<?php echo $r_team['log_book'] ?>">LogBook</a></td>
                                                        <?php } else { ?>
                                                            <td></td>
                                                        <?php }  ?>
                                                        <!--<td><a href="http://grading.emuem.org/Team/<?php echo $r_team['log_book'] ?>" target="_blank">LogBook</a></td>  -->
                                                        <td>

                                                            <?php
                                                            $team_m_q = mysqli_query($conn, "SELECT *
                                                            FROM tbl_team_member tm
                                                            JOIN student s ON tm.student_id = s.student_id
                                                            WHERE tm.team_id = $team_id ");
                                                            while ($team_m_r = mysqli_fetch_assoc($team_m_q)) {
                                                            ?>


                                                                <?php echo $team_m_r['student_first_name'] . ' ' . $team_m_r['student_last_name']; ?>


                                                            <?php } ?>

                                                        </td>
                                                    </tr>
                                                <?php } ?>



                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-md-7 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                   
                                    <h4 class="form-heading">Upload Photo Consent Forms:</h4>

                                    <table class="table table-borderless ">



                                        <form method="post"   enctype="multipart/form-data">

                                            <?php $team_m_q = mysqli_query($conn, "SELECT *
                        FROM tbl_team_member tm
                        JOIN student s ON tm.student_id = s.student_id
                        WHERE tm.team_id = $team_id ");
                                            while ($team_m_r = mysqli_fetch_assoc($team_m_q)) {  ?>


                                                <tr>

                                                    <td colspan="6">
                                                        <?php echo $team_m_r['student_first_name'] . ' ' . $team_m_r['student_last_name']; ?>
                                                        <div>

                                                            <label class="m-3"><b>Parent has given consent to photograph the student:</b></label>
                                                            <input class="m-3" type="radio" name="photo_consent_<?php echo $team_m_r['student_id']; ?>" value="Yes" onchange="return func(this.value,<?php echo $team_m_r['student_id']; ?>,'photo_consent')" <?php if (($team_m_r['photo_consent']) == 1) {
                                                                                                                                                                                                            echo 'Checked';
                                                                                                                                                                                                        } ?>>Yes
                                                            <input class="m-3" type="radio" name="photo_consent_<?php echo $team_m_r['student_id']; ?>" value="No" id="fileUpload" onchange="return func(this.value,<?php echo $team_m_r['student_id']; ?>,'photo_consent')" <?php if (($team_m_r['photo_consent']) == 0) {
                                                                                                                                                                                                                            echo 'Checked';
                                                                                                                                                                                                                        } ?>>No
                                                        </div>

                                                    </td>

                                                    <td colspan="6">

                                                        <div>
                                                            <label for="pwd"><b>Photo Consent Form for <?php echo $team_m_r['student_first_name'] ?>:</b></label>
                                                            <?php if (($team_m_r['photo_consent_form']) != '') { ?>
                                                                <a  class="text-dark"   href="<?php echo $team_m_r['photo_consent_form'] ?>" target="_blank">Consent Form</a>
                                                            <?php } ?>
                                                            <input type="file" class="form-control form-control-md" name="photo_form_<?php echo $team_m_r['student_id']; ?>" id="photo_form_<?php echo $team_m_r['student_id']; ?>" placeholder="Upload Photo Consent Form" onchange="func(this.value,<?php echo $team_m_r['student_id']; ?>,'photo_consent_form')">
                                                        </div>

                                                    </td>
                                                </tr>
                                            <?php } ?>


                                                                            <!--<tr>
				                                                    <td>
				                                <div class="form-group">
				                                <button type="submit" class="btn btn-success" name="submit">Update</button>
				                                </div>
				                                </td>
				                                </tr> 	-->




                                                                            <!--</td>
				                                </tr>-->
                                        </form>
                                    </table>
                                </div>
                            </div>
                        </div>



                        <div class=" col-lg-5 col-sm-12">



                            <br>
                            <h3>Video Pitch:</h3>


                            <?php if ($youtube_id == '') { ?>
                                <div class="form-group">
                                    <video  controls style="width:100%!important; height:100%!important;">
                                        <source src="<?php echo  $url ?>" type="video/mp4">
                                        <source src="<?php echo  $url ?>" type="video/ogg">
                                    </video>
                                </div>
                            <?php } else { ?>
                                <div class="form-group">
                                    <iframe src="https://www.youtube.com/embed/<?php echo $youtube_id ?>" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                </div>
                            <?php } ?>
                            <p>Don't forget to click on "Submit Evaluation" to record your evaluation.</p>

                        </div>
                        


                    </div>
                    <div class="row">
                        <div class="col-md-7 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                  
                                    <h4 class="form-heading">Upload Video Pitch , LogBook</h4>
                                    <p>Youtube link is preferred for the Video Pitch</p>
                                    <table class="table table-borderless" >
            
				
				
				<form method="post"  id="edit_team" enctype="multipart/form-data" >
                <input  type="hidden" class="form-control" name="team_id" placeholder="Upload video" value="<?php echo $team_id ?>">
							
                
				<tr>
                    <td colspan="6">
                        
                           <div >
                            <label class="m-3" for="pwd"><b>Upload Video Pitch:</b></label>
                            <input  type="file" class="form-control" name="fileToUpload" placeholder="Upload video">
							<p class="mx-3">Video Should less than 25MB</p>
                        </div>
                        <br>
						<p><b>-OR-</b></p>
						
						<div >
                            <label class="m-3" for="pwd"><b>Update Video Pitch Link:</b></label>
                            <input type="text" class="form-control" id="studentEmail" name="video_pitch_link" placeholder="Upload video">
                        </div>
						
                    </td>
					</tr>	
					
				<br>	
				<tr>
                    <td colspan="6">
                        
                          <div >
                            <label class="m-3" for="pwd"><b>LogBook:</b></label>
                            <input type="file" class="form-control" id="log_book" name="log_book" placeholder="Upload logbook">
                        </div>
                        
                    </td>
					</tr>		
		
				
				
				
				<tr>
				<td>
				<div class="form-group">
				<button type="submit" class="btn btn-success" name="submit">Update</button>	
				</div>
				</td>
				</tr>

				
            
        
				<!--</td>
				</tr>-->
				</form>
			</table>
                                </div>
                            </div>
                        </div>



                       


                    </div>
                </div>
            </div>

        </div>
    </div>

    <script >
   
  
   
   function func(SelectedValue,Id,value)
   {
       
       if(value == 'photo_consent')
       {
       
       $.ajax({
                   type:'POST',
                   url:'./api.php?action=update_consent',
                   dataType: "json",
                   data: 'student_id='+Id+'&photo_consent='+SelectedValue,
                   success:function(resp){
                       console.log(resp.status);
                       
                       if (resp.status == "Success") {
            
                            alert(resp.msg);
                            
           } else if(resp.status == "Failed") {
             
            alert(resp.msg);

           }
               }
           }); 
           
       }	
       
       if(value == 'photo_consent_form')
       {
           //alert(value);
           
           var input = document.getElementById("photo_form_"+Id);
               
                 //alert('hi');
                 file = input.files[0];
                 //alert(file)
                 //alert('hi');
                   formData= new FormData();
                   if(!!file.type.match(/pdf.*/)){
                   //alert('inside if');
                     formData.append("photo_form", file);
                     formData.append("student_id", Id);
                     $.ajax({
                       url: "api.php?action=photo_consent_form",
                       type: "POST",
                       dataType: "json",
                       data: formData,
                       processData: false,
                       contentType: false,
                       success: function(resp){
                           if (resp.status == "Success") {
                            // location.reload();
                            alert(resp.msg);
                            window.location.reload();
           } else if(resp.status == "Failed") {
             
            alert(resp.message);
           }
                       }
                     });
                   }else{
                    alert("not a valid image!");
               
                   }
       
       //}
       
       
   
   }
   }
   
   
   
   
       
   
   </script>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="../assets/vendors/js/vendor.bundle.base.js"></script>
    <!-- <script src="./../assets/js/main.js"></script> -->
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
    <script src="../assets/js/dashboard.js"></script>
    <script src="../assets/js/todolist.js"></script>
    <script src="../assets/js/ajaxscript.js?v=2" type="text/javascript"></script>
    <!-- End custom js for this page -->
</body>

</html>