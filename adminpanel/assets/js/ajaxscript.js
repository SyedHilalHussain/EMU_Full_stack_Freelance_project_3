$(document).ready(function () {
  let dataTable = $(".table1").DataTable({
    debug: true,
    numbering: false,
    lengthChange: false,
    paging: false,
    info: false,
    ordering: true,
    dom: "lrtip",
    columnDefs: [
      { orderable: true, className: "reorder", targets: [0, 1, 2] },
      { orderable: false, targets: "_all" },
    ],
  });
  $("#search").keyup(function () {
    dataTable.search(this.value).draw();
  });

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

  $(document).on("click", ".ajaxupdated", function (event) {
    event.preventDefault();

    var url = $(this).data("url");
    var query = $(this).data("query");
    var title = $(this).data("title");

    $.ajax({
      url: url,
      method: "POST",
      data: {
        query: query,
        title: title,
      },
      success: function (response) {
        $(".updated").html(response);
      },
      error: function (xhr, status, error) {
        console.log("AJAX request error:", error);
      },
    });
  });
  $(document).on("click", ".result-btn", function (event) {
    event.preventDefault();

    var url = $(this).data("url");
    var query = $(this).data("query");
    var title = $(this).data("title");

    // Construct the URL with the query parameter
    var fullUrl =
      url +
      "?query=" +
      encodeURIComponent(query) +
      "&&title=" +
      encodeURIComponent(title);

    // Redirect to the new page
    window.location.href = fullUrl;
    // $.ajax({
    //   url: url,
    //   method: "POST",
    //   data: {
    //     query: query,
    //     title: title
    //   },
    //   success: function (response) {
    //     $(".updated").html(response);
    //   },
    //   error: function (xhr, status, error) {
    //     console.log("AJAX request error:", error);
    //   }
    // });
  });

  
  $("#judge_detail_update").on("submit", function (e) {
    e.preventDefault();

    $.ajax({
      url: "./api.php?action=judge_details_update",

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
          $(".message1 .text-2").text(resp.msg);
          showAlertBox();
        } else if (resp.status == "Failed") {
          faileBox();
          $(".message1 .text-1").text(resp.status);
          $(".message1 .text-2").text(resp.msg);
          showAlertBox();
        } else {
          requireBox();
          $(".message1 .text-1").text(resp.status);
          $(".message1 .text-2").text(resp.msg);
          showAlertBox();
        }
      },
    });
  });
  $("#profile_updated").on("submit", function (e) {
    e.preventDefault();

    $.ajax({
      url: "../adminpanel/superadmin/api.php?action=profile_updated",

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
          $(".message1 .text-2").text(resp.msg);
          showAlertBox();
          setTimeout(function () {
            location.reload();
           
          }, 3000);
        } else if (resp.status == "Failed") {
          faileBox();
          $(".message1 .text-1").text(resp.status);
          $(".message1 .text-2").text(resp.msg);
          showAlertBox();
        } else {
          requireBox();
          $(".message1 .text-1").text(resp.status);
          $(".message1 .text-2").text(resp.msg);
          showAlertBox();
        }
      },
    });
  });
  $("#evaluation_team_update").on("submit", function (e) {
    e.preventDefault();

    $.ajax({
      url: "./api.php?action=evaluation_team_update",

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
          $(".message1 .text-2").text(resp.msg);
          showAlertBox();
        } else if (resp.status == "Failed") {
          faileBox();
          $(".message1 .text-1").text(resp.status);
          $(".message1 .text-2").text(resp.msg);
          showAlertBox();
        } else {
          requireBox();
          $(".message1 .text-1").text(resp.status);
          $(".message1 .text-2").text(resp.msg);
          showAlertBox();
        }
      },
    });
  });
  $("#registration").on("submit", function (e) {
    e.preventDefault();

    $.ajax({
      url: "../adminpanel/superadmin/api.php?action=registration",
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
          $(".message1 .text-2").text(resp.msg);
          showAlertBox();
        } else if (resp.status == "Failed") {
          faileBox();
          $(".message1 .text-1").text(resp.status);
          $(".message1 .text-2").text(resp.msg);
          showAlertBox();
        } else {
          requireBox();
          $(".message1 .text-1").text(resp.status);
          $(".message1 .text-2").text(resp.msg);
          showAlertBox();
        }
      },
    });
  });
  $("#edit_team_liveqa").on("submit", function (e) {
    e.preventDefault();

    $.ajax({
      url: "./api.php?action=edit_team_liveqa",

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
          "An error occured while register the records"
        );
        showAlertBox();
      },
      success: function (resp) {
        if (resp.status == "Success") {
          successBox();
          $(".message1 .text-1").text(resp.status);
          $(".message1 .text-2").text(resp.msg);
          showAlertBox();
        } else if (resp.status == "Failed") {
          faileBox();
          $(".message1 .text-1").text(resp.status);
          $(".message1 .text-2").text(resp.msg);
          showAlertBox();
        } else {
          requireBox();
          $(".message1 .text-1").text(resp.status);
          $(".message1 .text-2").text(resp.msg);
          showAlertBox();
        }
      },
    });
  });
  $(".approve-btn").on("click", function (e) {
    e.preventDefault();
    var flag = $(this).data("flag");
    var returns = $(this).data("returns");
    var table = $(this).data("table");
    var id = $(this).data("id");

    $.ajax({
      url: "./api.php?action=approve_user",

      method: "POST",
      dataType: "json",
      data: {
        flag: flag,
        returns: returns,
        table: table,
        id: id,
      },

      error: (err) => {
        console.log(err);
        faileBox();
        $(".message1 .text-1").text("ERROR");
        $(".message1 .text-2").text("An error occured While Doing the Process");
        showAlertBox();
      },
      success: function (resp) {
        if (resp.status == "Success") {
          successBox();
          $(".message1 .text-1").text(resp.status);
          $(".message1 .text-2").text(resp.msg);
          showAlertBox();
        } else if (resp.status == "Failed") {
          faileBox();
          $(".message1 .text-1").text(resp.status);
          $(".message1 .text-2").text(resp.msg);
          showAlertBox();
        } else {
          requireBox();
          $(".message1 .text-1").text(resp.status);
          $(".message1 .text-2").text(resp.msg);
          showAlertBox();
        }
      },
    });
  });
  $(document).on("click", ".delete-user-btn", function (e) {
    e.preventDefault();

    var returns = $(this).data("returns");
    var table = $(this).data("table");
    var id = $(this).data("id");

    $.ajax({
      url: "./api.php?action=delete_member",

      method: "POST",
      dataType: "json",
      data: {
        returns: returns,
        table: table,
        id: id,
      },

      error: (err) => {
        console.log(err);
        faileBox();
        $(".message1 .text-1").text("ERROR");
        $(".message1 .text-2").text("An error occured While Doing the Process");
        showAlertBox();
      },
      success: function (resp) {
        if (resp.status == "Success") {
          $(".user-table").html(resp.loaddata);
          successBox();
          $(".message1 .text-1").text(resp.status);
          $(".message1 .text-2").text(resp.msg);
          showAlertBox();
        } else if (resp.status == "Failed") {
          faileBox();
          $(".message1 .text-1").text(resp.status);
          $(".message1 .text-2").text(resp.msg);
          showAlertBox();
        } else {
          requireBox();
          $(".message1 .text-1").text(resp.status);
          $(".message1 .text-2").text(resp.msg);
          showAlertBox();
        }
      },
    });
  });

  $("#edit_member").on("submit", function (e) {
    e.preventDefault();

    $.ajax({
      url: "./api.php?action=edit_member",

      method: "POST",
      dataType: "json",
      data: new FormData(this),
      contentType: false,
      cache: false,
      processData: false,

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
  var team = [];
  var cat = "";

  $(document).on("change", "#team_category", function (e) {
    e.preventDefault();

    var category = $(this).val();
    //alert(category);
    // if(category){
    cat = category;

    $.ajax({
      type: "POST",
      url: "ajaxData_cat.php",
      data: { cat: category },
      success: function (html) {
        $("#team_id_1").html(html);
      },
    });
  });

  $("#team_id_1").on("change", function (e) {
    e.preventDefault();
    var team1_id = $(this).val();
    if (team1_id) {
      //alert(team1_id);
      team.push(team1_id);
      console.log(team);
      dataString = team;
      console.log(cat);
      $.ajax({
        type: "POST",
        url: "ajaxData_team.php",
        data: { id_data: JSON.stringify(dataString), caty: cat, id: 1 },
        success: function (html) {
          $("#team_id_2").html(html);
        },
      });
    } else {
      alert("going in else");
      $.ajax({
        type: "POST",
        url: "ajaxdata_cat.php",
        data: "cat=" + cat,
        success: function (html) {
          $("#team_id_2").html(html);
        },
      });
    }
  });
  $("#team_id_2").on("change", function (e) {
    e.preventDefault();
    var team1_id = $(this).val();
    if (team1_id) {
      //alert(team1_id);
      team.push(team1_id);
      console.log(team);
      dataString = team;
      console.log(cat);
      $.ajax({
        type: "POST",
        url: "ajaxData_team.php",
        data: { id_data: JSON.stringify(dataString), caty: cat, id: 2 },
        success: function (html) {
          $("#team_id_3").html(html);
        },
      });
    } else {
      alert("going in else");
      $.ajax({
        type: "POST",
        url: "ajaxdata_cat.php",
        data: "cat=" + cat,
        success: function (html) {
          $("#team_id_3").html(html);
        },
      });
    }
  });
  $("#team_id_3").on("change", function (e) {
    e.preventDefault();
    var team1_id = $(this).val();
    if (team1_id) {
      //alert(team1_id);
      team.push(team1_id);
      console.log(team);
      dataString = team;
      console.log(cat);
      $.ajax({
        type: "POST",
        url: "ajaxData_team.php",
        data: { id_data: JSON.stringify(dataString), caty: cat, id: 3 },
        success: function (html) {
          $("#team_id_4").html(html);
        },
      });
    } else {
      alert("going in else");
      $.ajax({
        type: "POST",
        url: "ajaxdata_cat.php",
        data: "cat=" + cat,
        success: function (html) {
          $("#team_id_4").html(html);
        },
      });
    }
  });
  $("#team_id_4").on("change", function (e) {
    e.preventDefault();
    var team1_id = $(this).val();
    if (team1_id) {
      //alert(team1_id);
      team.push(team1_id);
      console.log(team);
      dataString = team;
      console.log(cat);
      $.ajax({
        type: "POST",
        url: "ajaxData_team.php",
        data: { id_data: JSON.stringify(dataString), caty: cat, id: 4 },
        success: function (html) {
          $("#team_id_5").html(html);
        },
      });
    } else {
      alert("going in else");
      $.ajax({
        type: "POST",
        url: "ajaxdata_cat.php",
        data: "cat=" + cat,
        success: function (html) {
          $("#team_id_5").html(html);
        },
      });
    }
  });
  $("#team_id_5").on("change", function (e) {
    e.preventDefault();
    var team1_id = $(this).val();
    if (team1_id) {
      //alert(team1_id);
      team.push(team1_id);
      console.log(team);
      dataString = team;
      console.log(cat);
      $.ajax({
        type: "POST",
        url: "ajaxData_team.php",
        data: { id_data: JSON.stringify(dataString), caty: cat, id: 5 },
        success: function (html) {
          $("#team_id_6").html(html);
        },
      });
    } else {
      alert("going in else");
      $.ajax({
        type: "POST",
        url: "ajaxdata_cat.php",
        data: "cat=" + cat,
        success: function (html) {
          $("#team_id_6").html(html);
        },
      });
    }
  });

  $("#assign_judge_team").on("submit", function (e) {
    e.preventDefault();
    $.ajax({
      url: "./api.php?action=assign_judge_team",

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
          $(".message1 .text-2").text(resp.msg);
          showAlertBox();
        } else if (resp.status == "Failed") {
          faileBox();
          $(".message1 .text-1").text(resp.status);
          $(".message1 .text-2").text(resp.msg);
          showAlertBox();
        } else {
          requireBox();
          $(".message1 .text-1").text(resp.status);
          $(".message1 .text-2").text(resp.msg);
          showAlertBox();
        }
      },
    });
  });

  $(document).on("click", ".delete_judge", function (e) {
    e.preventDefault();

    var id = $(this).data("id");

    $.ajax({
      url: "./api.php?action=delete_judge",

      method: "POST",
      dataType: "json",
      data: {
        id: id,
      },

      error: (err) => {
        console.log(err);
        faileBox();
        $(".message1 .text-1").text("ERROR");
        $(".message1 .text-2").text("An error occured While Doing the Process");
        showAlertBox();
      },
      success: function (resp) {
        if (resp.status == "Success") {
          $(".judge-table").html(resp.loaddata);

          successBox();
          $(".message1 .text-1").text(resp.status);
          $(".message1 .text-2").text(resp.msg);
          showAlertBox();
        } else if (resp.status == "Failed") {
          faileBox();
          $(".message1 .text-1").text(resp.status);
          $(".message1 .text-2").text(resp.msg);
          showAlertBox();
        } else {
          requireBox();
          $(".message1 .text-1").text(resp.status);
          $(".message1 .text-2").text(resp.msg);
          showAlertBox();
        }
      },
    });
  });

  // edit team page work

  $("#edit_team").on("submit", function (e) {
    e.preventDefault();
    $.ajax({
      url: "./api.php?action=edit_team",

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
        $(".message1 .text-2").text("An error occured:Check console");
        showAlertBox();
      },
      success: function (resp) {
        if (resp.status == "Success") {
          successBox();
          $(".message1 .text-1").text(resp.status);
          $(".message1 .text-2").text(resp.msg);
          showAlertBox();
        }
      },
    });
  });

  // non ajax working for menu collapse
  $(".ui-3").on("click", function (e) {
    e.preventDefault();

    // Toggle the aria-expanded attribute
    $(this).attr("aria-expanded", function (index, attr) {
      return attr === "false" ? "true" : "false";
    });

    // Toggle the collapsed class on the anchor tag
    $(this).toggleClass("collapsed");

    // Get the target collapse element
    var targetCollapse = $($(this).data("bs-target"));

    // Toggle the show class on the target collapse element
    targetCollapse.toggleClass("show");
  });
});

$("#year_change").on("change", function (e) {
  e.preventDefault();
  var year_change = $(this).val();
  $.ajax({
    url: "./api.php?action=year_change",
    method: "POST",
    dataType: "json",
    data: { selectedyear: year_change },
    success: function (response) {
      $("#total").html(response.no_rows);
      $("#year_span").html(response.selected_year);
      $("#tbl_body1").html(response.content);
    },
  });
});
