$(document).ready(function () {
  // Registration form validation
  $("#registerForm").on("submit", function (e) {
    let valid = true;
    $(".error").text(""); // Clear previous errors

    const username = $("#username").val().trim();
    const password = $("#password").val().trim();
    const confirmPassword = $("#confirm_password").val().trim();

    if (username === "") {
      $("#usernameError").text("Username is required");
      valid = false;
    }
    if (password === "") {
      $("#passwordError").text("Password is required");
      valid = false;
    }
    if (password.length < 6) {
      $("#passwordError").text("Password must be at least 6 characters");
      valid = false;
    }
    if (password !== confirmPassword) {
      $("#confirmPasswordError").text("Passwords do not match");
      valid = false;
    }

    if (!valid) {
      e.preventDefault();
    }
  });

  // Login form validation
  $("#loginForm").on("submit", function (e) {
    let valid = true;
    $(".error").text("");

    const username = $("#username").val().trim();
    const password = $("#password").val().trim();

    if (username === "") {
      $("#usernameError").text("Username is required");
      valid = false;
    }
    if (password === "") {
      $("#passwordError").text("Password is required");
      valid = false;
    }

    if (!valid) {
      e.preventDefault();
    }
  });

  // File upload validation
  $("#uploadForm").on("submit", function (e) {
    let valid = true;
    $("#uploadError").text("");
    const fileInput = $("#file");

    if (fileInput.val() === "") {
      $("#uploadError").text("Please select a file to upload.");
      valid = false;
    }

    if (!valid) {
      e.preventDefault();
    }
  });
});
