$(document).ready(function () {
  const button = document.querySelector(".pop-button"),
  toast1 = document.querySelector(".toast1");
(closeIcon = document.getElementById("popup-close-btn")),
  (progress = document.querySelector(".progress1"));
var checkItom = document.querySelector(".toast1-content .check ");
const progressColor1 = document.getElementById("progress1");
// const progressBefore =window.getComputedStyle(progressColor1, '::before');

let timer1, timer2;
function showAlertBox() {
  window.scrollTo(0, 0);
  toast1.style.display = "block";

  progress.classList.add("active");

  timer1 = setTimeout(function () {
    toast1.classList.add("active");
  }, 50);

  timer1 = setTimeout(() => {
    toast1.classList.remove("active");
  }, 5000); //1s = 1000 milliseconds

  timer2 = setTimeout(() => {
    toast1.style.display = "none";
    progress.classList.remove("active");
  }, 5300);
}

function successBox() {
  checkItom.classList.remove("mdi-alert-circle-outline");
  progressColor1.style.setProperty(
    "--bgColor",
    "linear-gradient(to right, #57D9A3,#36B37E)"
  );
  progressColor1.style.setProperty(
    "--bgColor",
    "-webkit-gradient(linear, left top, right top, from(#57D9A3), to(#36B37E))"
  );
  checkItom.classList.add("bg-gradient-success-dark");
  checkItom.classList.add("mdi-check");
}
function requireBox() {
  progressColor1.style.setProperty(
    "--bgColor",
    "linear-gradient(to right, #f6e384, #ffd500)"
  );
  progressColor1.style.setProperty(
    "--bgColor",
    "-webkit-gradient(linear, left top, right top, from(#f6e384), to(#ffd500))"
  );
  checkItom.classList.add("bg-gradient-warning");
}
function faileBox() {
  checkItom.classList.remove("mdi-alert-circle-outline");
  progressColor1.style.setProperty(
    "--bgColor",
    " linear-gradient(to right,  #fa5f5f, #f70f0f)"
  );
  progressColor1.style.setProperty(
    "--bgColor",
    "-webkit-gradient(linear, left top, right top, from( #fa5f5f), to(#f70f0f))"
  );
  checkItom.classList.add("bg-gradient-danger");
  checkItom.classList.add("mdi-close");
}

  $("#check_click").on("submit", function (e) {
      e.preventDefault();
  
  
      $.ajax({
        url: "./api.php?action=checkupdate",
  
        method: "POST",
        dataType: "html",
        data: new FormData(this),
        contentType: false,
        cache: false,
        processData: false,
        error: (err) => {
          
          console.log(err);
    
        },
        success: function (content) {
      $('#Tokyo').html(content);
        },
      });
  });

  $(document).on("submit","#teamselect", function (e) {
      e.preventDefault();
  
  
      $.ajax({
        url: "./api.php?action=teamselect",
  
        method: "POST",
        dataType: "html",
        data: new FormData(this),
        contentType: false,
        cache: false,
        processData: false,
        error: (err) => {
          
          console.log(err);
    
        },
        success: function (content) {
          
          
      $('#Tokyo').html(content);
      console.log(content);
        },
      });
      return false;
  });

  
//   $(document).on("change","#team_category", function (e) {
//     e.preventDefault();

//     var category = $(this).val();
//     //alert(category);
//     // if(category){
//       cat = category;
    
//                 $.ajax({
//                   type:'POST',
//                   url:'ajaxData_cat.php',
//                   data:{cat : category },
//                   success:function(html){
//                     $('#team_id_1').html(html);
//                   }
//                 }); 
   

 

//   });

$("#edit_members").on("submit", function (e) {
  e.preventDefault();
console.log('submit');
  $.ajax({
    url: "./api.php?action=edit_member",

    method: "POST",
    dataType: "json",
    data: new FormData(this),
    contentType: false,
    cache: false,
    processData: false,
error: (err) => {
      console.log(err);
      faileBox();
      $(".message1 .text-1").text("ERROR");
      $(".message1 .text-2").text(
        "An error occured while saving the records"
      );
      showAlertBox();
    },
   
    success: function (resp) {
      if (resp.status == "Success") {
        successBox();
        $(".message1 .text-1").text(resp.status);
        $(".message1 .text-2").html(resp.msg.replace(/\n/g, "<br>"));
        showAlertBox();
        setTimeout(function () {
          location.reload();
        }, 3000);
      } else if (resp.status == "Failed") {
        faileBox();
        $(".message1 .text-1").text(resp.status);
        $(".message1 .text-2").html(resp.msg.replace(/\n/g, "<br>"));
        showAlertBox();
      } else {
        requireBox();
        $(".message1 .text-1").text(resp.status);
        $(".message1 .text-2").html(resp.msg.replace(/\n/g, "<br>"));
        showAlertBox();
      }
    },
    error: (err) => {
      console.log(err);
      faileBox();
      $(".message1 .text-1").text("ERROR");
      $(".message1 .text-2").text("Unknown Error Check console");
      showAlertBox();
    },
  });
});

$("#create_members").on("submit", function (e) {
  e.preventDefault();
console.log('submit');
  $.ajax({
    url: "./api.php?action=create_member",

    method: "POST",
    dataType: "json",
    data: new FormData(this),
    contentType: false,
    cache: false,
    processData: false,
error: (err) => {
      console.log(err);
      faileBox();
      $(".message1 .text-1").text("ERROR");
      $(".message1 .text-2").text(
        "An error occured while saving the records"
      );
      showAlertBox();
    },
   
    success: function (resp) {
      if (resp.status == "Success") {
        successBox();
        $(".message1 .text-1").text(resp.status);
        $(".message1 .text-2").html(resp.msg.replace(/\n/g, "<br>"));
        showAlertBox();
        setTimeout(function () {
          location.reload();
        }, 3000);
      } else if (resp.status == "Failed") {
        faileBox();
        $(".message1 .text-1").text(resp.status);
        $(".message1 .text-2").html(resp.msg.replace(/\n/g, "<br>"));
        showAlertBox();
      } else {
        requireBox();
        $(".message1 .text-1").text(resp.status);
        $(".message1 .text-2").html(resp.msg.replace(/\n/g, "<br>"));
        showAlertBox();
      }
    },
    error: (err) => {
      console.log(err);
      faileBox();
      $(".message1 .text-1").text("ERROR");
      $(".message1 .text-2").text("Unknown Error Check console");
      showAlertBox();
    },
  });
});


});