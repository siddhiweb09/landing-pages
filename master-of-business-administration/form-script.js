function disableButton() {
  var submitButton = document.getElementById("submitButton");
  submitButton.disabled = true;
  submitButton.value = "Submitting...";
  return true;
}

$(document).ready(function () {
  // Fetch states and courses on page load
  fetch_states();
  fetch_course();

  $(".state").on("change", function () {
    fetch_city();
  });

  $(".course").on("change", function () {
    var course = $(".course").val();
    fetch_level(course);
  });

  $("#otpModal").modal({
    backdrop: "static",
    keyboard: false,
  });

  fetch_states2();
  fetch_course2();

  $(".state2").on("change", function () {
    fetch_city2();
  });

  $(".course2").on("change", function () {
    var course = $(".course2").val();
    fetch_level2();
  });

  $("#otpModal2").modal({
    backdrop: "static",
    keyboard: false,
  });

  fetch_states3();
  fetch_course3();

  $(".state3").on("change", function () {
    fetch_city3();
  });

  $(".course3").on("change", function () {
    var course = $(".course3").val();
    fetch_level3();
  });

  $("#otpModal3").modal({
    backdrop: "static",
    keyboard: false,
  });
});

function fetch_states() {
  $.ajax({
    type: "POST",
    url: "https://insityapp.com/dbFiles/fetch_states.php",
    dataType: "json",
    success: function (response) {
      var names = response.states;
      var state = $(".state");
      state.empty();
      state.append(
        $("<option>", {
          text: "Select State",
        })
      );
      for (var i = 0; i < names.length; i++) {
        var name = names[i];
        state.append(
          $("<option>", {
            value: name,
            text: name,
          })
        );
      }
    },
    error: function (error) {
      console.error("Error fetching states:", error);
    },
  });
}

function fetch_city() {
  var state = document.getElementById("state").value;
  $.ajax({
    type: "POST",
    url: "https://insityapp.com/dbFiles/fetch_cities.php",
    data: {
      state: state,
    },
    dataType: "json",
    success: function (response) {
      var names = response.cities;
      var city = $(".city");
      city.empty().append('<option value="">Select City</option>');
      for (var i = 0; i < names.length; i++) {
        var name = names[i];
        city.append(
          $("<option>", {
            value: name,
            text: name,
          })
        );
      }
    },
    error: function (error) {
      console.error("Error fetching cities:", error);
    },
  });
}

function fetch_course() {
  var courseselectedvalue = "Master of Business Administration (MBA)";

  $.ajax({
    type: "POST",
    url: "https://insityapp.com/dbFiles/isbmu_fetch_courses.php",
    data: {
      department: "Management",
      entity: "ISBMU",
    },
    dataType: "json",
    success: function (response) {
      var selectedvalue = courseselectedvalue;
      var names = response.courses;
      var course = $(".course");
      course.empty();
      
        course.append($("<option>", {
            value: "",
            text: "Select Course"
         }));

      // Append the options
      for (var i = 0; i < names.length; i++) {
        var name = names[i];
        var option = $("<option>", {
          value: name,
          text: name,
        });

        course.append(option);
      }

      // Set the selected value
      course.val(selectedvalue).change();
      fetch_level(selectedvalue);
    },
    error: function (error) {
      console.error("Error fetching Emails:", error);
    },
  });
}

function fetch_level(course) {
  console.log(course);
  $.ajax({
    type: "POST",
    url: "https://insityapp.com/dbFiles/isbmu_fetch_levels.php",
    data: {
      course: course,
      entity: "ISBMU",
    },
    dataType: "json",
    success: function (response) {
      var name = response.levels;
      var level = $(".level");
      level.empty();
      // for (var i = 0; i < names.length; i++) {
      // var name = names[i];
      level.append(
        $("<option>", {
          value: name,
          text: name,
        })
      );
      // }
    },
    error: function (error) {
      console.error("Error fetching levels:", error);
    },
  });
}

function fetch_states2() {
  $.ajax({
    type: "POST",
    url: "https://insityapp.com/dbFiles/fetch_states.php",
    dataType: "json",
    success: function (response) {
      var names = response.states;
      var state2 = $(".state2");
      state2.empty();
      state2.append(
        $("<option>", {
          text: "Select State",
        })
      );
      for (var i = 0; i < names.length; i++) {
        var name = names[i];
        state2.append(
          $("<option>", {
            value: name,
            text: name,
          })
        );
      }
    },
    error: function (error) {
      console.error("Error fetching states:", error);
    },
  });
}

function fetch_city2() {
  var state2 = document.getElementById("state2").value;
  $.ajax({
    type: "POST",
    url: "https://insityapp.com/dbFiles/fetch_cities.php",
    data: {
      state: state2,
    },
    dataType: "json",
    success: function (response) {
      var names = response.cities;
      var city2 = $(".city2");
      city2.empty().append('<option value="">Select City</option>');
      for (var i = 0; i < names.length; i++) {
        var name = names[i];
        city2.append(
          $("<option>", {
            value: name,
            text: name,
          })
        );
      }
    },
    error: function (error) {
      console.error("Error fetching cities:", error);
    },
  });
}

function fetch_course2() {
  var courseselectedvalue = "Master of Business Administration (MBA)";

  $.ajax({
    type: "POST",
    url: "https://insityapp.com/dbFiles/isbmu_fetch_courses.php",
    data: {
      department: "Management",
      entity: "ISBMU",
    },
    dataType: "json",
    success: function (response) {
      var selectedvalue = courseselectedvalue;
      var names = response.courses;
      var course2 = $(".course2");
      course2.empty();

      // Append the options
      for (var i = 0; i < names.length; i++) {
        var name = names[i];
        var option = $("<option>", {
          value: name,
          text: name,
        });

        course2.append(option);
      }

      // Set the selected value
      course2.val(selectedvalue).change();
      fetch_level2(selectedvalue);

      // Set the selected value
    },
    error: function (error) {
      console.error("Error fetching Emails:", error);
    },
  });
}

function fetch_level2(course2) {
//   var course2 = $(".course2").val();
  $.ajax({
    type: "POST",
    url: "https://insityapp.com/dbFiles/isbmu_fetch_levels.php",
    data: {
      course: course2,
      entity: "ISBMU",
    },
    dataType: "json",
    success: function (response) {
      var name = response.levels;
      var level = $(".level");
      level.empty();
      // for (var i = 0; i < names.length; i++) {
      // var name = names[i];
      level.append(
        $("<option>", {
          value: name,
          text: name,
        })
      );
      // }
    },
    error: function (error) {
      console.error("Error fetching levels:", error);
    },
  });
}

function fetch_states3() {
  $.ajax({
    type: "POST",
    url: "https://insityapp.com/dbFiles/fetch_states.php",
    dataType: "json",
    success: function (response) {
      var names = response.states;
      var state3 = $(".state3");
      state3.empty();
      state3.append(
        $("<option>", {
          text: "Select State",
        })
      );
      for (var i = 0; i < names.length; i++) {
        var name = names[i];
        state3.append(
          $("<option>", {
            value: name,
            text: name,
          })
        );
      }
    },
    error: function (error) {
      console.error("Error fetching states:", error);
    },
  });
}

function fetch_city3() {
  var state3 = document.getElementById("state3").value;
  console.log(state3);
  $.ajax({
    type: "POST",
    url: "https://insityapp.com/dbFiles/fetch_cities.php",
    data: {
      state: state3,
    },
    dataType: "json",
    success: function (response) {
      var names = response.cities;
      var city3 = $(".city3");
      city3.empty().append('<option value="">Select City</option>');
      for (var i = 0; i < names.length; i++) {
        var name = names[i];
        city3.append(
          $("<option>", {
            value: name,
            text: name,
          })
        );
      }
    },
    error: function (error) {
      console.error("Error fetching cities:", error);
    },
  });
}

function fetch_course3() {
  var courseselectedvalue = "Master of Business Administration (MBA)";

  $.ajax({
    type: "POST",
    url: "https://insityapp.com/dbFiles/isbmu_fetch_courses.php",
    data: {
      department: "Management",
      entity: "ISBMU",
    },
    dataType: "json",
    success: function (response) {
      var selectedvalue = courseselectedvalue;
      var names = response.courses;
      var course3 = $(".course3");
      course3.empty();

      // Append the options
      for (var i = 0; i < names.length; i++) {
        var name = names[i];
        var option = $("<option>", {
          value: name,
          text: name,
        });

        course3.append(option);
      }

      // Set the selected value
      course3.val(selectedvalue).change();
      fetch_level3(selectedvalue);

      // Set the selected value
    },
    error: function (error) {
      console.error("Error fetching Emails:", error);
    },
  });
}

function fetch_level3(course3) {
//   var course3 = $(".course3").val();
  $.ajax({
    type: "POST",
    url: "https://insityapp.com/dbFiles/isbmu_fetch_levels.php",
    data: {
      course: course3,
      entity: "ISBMU",
    },
    dataType: "json",
    success: function (response) {
      var name = response.levels;
      var level = $(".level");
      level.empty();
      // for (var i = 0; i < names.length; i++) {
      // var name = names[i];
      level.append(
        $("<option>", {
          value: name,
          text: name,
        })
      );
      // }
    },
    error: function (error) {
      console.error("Error fetching levels:", error);
    },
  });
}
