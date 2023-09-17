$(document).ready(function () {
   

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





});