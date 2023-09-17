
$(document).ready(function () {









  const button = document.querySelector(".pop-button"),
  toast1 = document.querySelector(".toast1");
(closeIcon = document.getElementById("popup-close-btn")),
  (progress = document.querySelector(".progress1"));
  var checkItom= document.querySelector(".toast1-content .check ");
  const progressColor1=document.getElementById('progress1');
  // const progressBefore =window.getComputedStyle(progressColor1, '::before');
 

let timer1, timer2 ;
function showAlertBox() {
  window.scrollTo(0, 0);
  toast1.style.display = 'block';
  
  progress.classList.add("active");

  timer1 = setTimeout(function() {
    toast1.classList.add('active');
  }, 50);

  timer1 = setTimeout(() => {
    toast1.classList.remove("active");
  }, 5000); //1s = 1000 milliseconds

 

  timer2 = setTimeout(() => {
    toast1.style.display = 'none';
    progress.classList.remove("active");
  }, 5300);
}




function successBox(){
  checkItom.classList.remove("mdi-alert-circle-outline"); 
  progressColor1.style.setProperty('--bgColor','linear-gradient(to right, #57D9A3,#36B37E)'); 
  progressColor1.style.setProperty('--bgColor','-webkit-gradient(linear, left top, right top, from(#57D9A3), to(#36B37E))');
 checkItom.classList.add("bg-gradient-success-dark"); 
 checkItom.classList.add("mdi-check"); 

}
function requireBox(){
 
   progressColor1.style.setProperty('--bgColor','linear-gradient(to right, #f6e384, #ffd500)');
   progressColor1.style.setProperty('--bgColor','-webkit-gradient(linear, left top, right top, from(#f6e384), to(#ffd500))');
 checkItom.classList.add("bg-gradient-warning"); 

}
function faileBox(){
  checkItom.classList.remove("mdi-alert-circle-outline"); 
  progressColor1.style.setProperty('--bgColor',' linear-gradient(to right,  #fa5f5f, #f70f0f)');
   progressColor1.style.setProperty('--bgColor','-webkit-gradient(linear, left top, right top, from( #fa5f5f), to(#f70f0f))');
 checkItom.classList.add("bg-gradient-danger"); 
 checkItom.classList.add("mdi-close"); 

}

$("#registration").on("submit", function (e) {
  e.preventDefault();
alert("Please enter");

  $.ajax({
  
   url: "./reg.php?action=registration",
    method: "POST",
    dataType: "json",
    data: new FormData(this),
    contentType: false,
    cache: false,
    processData: false,

    success: function (resp) {
      if (resp.status == "Success") {
       
       successBox();
        $('.message1 .text-1').text(resp.status);
        $('.message1 .text-2').text(resp.msg);
        showAlertBox();
        setTimeout(function () {
          location.reload();
        }, 3000);
      } else if(resp.status == "Failed") {
        
        faileBox();
        $('.message1 .text-1').text(resp.status);
        $('.message1 .text-2').text(resp.msg);
        showAlertBox();
      }else{
        requireBox();
        $('.message1 .text-1').text(resp.status);
        $('.message1 .text-2').text(resp.msg);
        showAlertBox();
        setTimeout(function () {
          location.reload();
        }, 3000);
      }
    },
  });

});
$("#logIn").on("submit", function (e) {
  e.preventDefault();


  $.ajax({
  
    url: "./logincode.php",
    method: "POST",
    dataType: "json",
    data: new FormData(this),
    contentType: false,
    cache: false,
    processData: false,
    error: (err) => {
      
      console.log(err);
      faileBox();
      $('.message1 .text-1').text("ERROR");
      $('.message1 .text-2').text("An error occured while saving the records");
      showAlertBox();
    },
    success: function (resp) {
      if (resp.status == "Success") {
       
        if (resp.user_type == "Judge") {
          window.location.href = "judges/home.php";
      } else if (resp.user_type == "General User") {
          window.location.href = "generaluser/home.php";
      } else if (resp.user_type == "SuperUser") {
          window.location.href = "././adminpanel/superadmin/grading.php";
      } else if (resp.user_type == "Mentor") {
        location.reload();
          window.location.href = "mentor/home.php";
      } else if (resp.user_type == "Organizer") {
          window.location.href = "admin/admin_home.php";
      }
      } else if(resp.status == "Failed") {
        
        faileBox();
        $('.message1 .text-1').text(resp.status);
        $('.message1 .text-2').text(resp.msg);
        showAlertBox();
      }else{
        requireBox();
        $('.message1 .text-1').text(resp.status);
        $('.message1 .text-2').text(resp.msg);
        showAlertBox();
      }
    },
  });

});

});