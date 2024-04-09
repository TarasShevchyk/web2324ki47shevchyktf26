// Get references to the necessary elements
const overlay = document.getElementById("overlay");
const loginForm = document.getElementById("login-form");
const registerForm = document.getElementById("register-form");
const loginLink = document.getElementById("login-link");
const registerLink = document.getElementById("register-link");
const closeBtn = document.getElementsByClassName("close-btn")[0];
const loginRegisterLink = document.getElementById("login-register-link");

// If Sign in | Sign Up button clicked open overlay.
loginRegisterLink.addEventListener("click", function(event) {
  event.preventDefault(); // Prevent the default link behavior
  openLoginForm(); // Open the login form overlay
});

// Open the overlay and display the login form
function openLoginForm() {
  overlay.style.display = "block";
  loginForm.style.display = "block";
  registerForm.style.display = "none";
}

// Open the overlay and display the register form
function openRegisterForm() {
  overlay.style.display = "block";
  loginForm.style.display = "none";
  registerForm.style.display = "block";
}

// Close the overlay
function closeOverlay() {
  overlay.style.display = "none";
}

// Add event listeners
loginLink.addEventListener("click", openLoginForm);
registerLink.addEventListener("click", openRegisterForm);
closeBtn.addEventListener("click", closeOverlay);
window.addEventListener("click", function(event) {
  if (event.target == overlay) {
    closeOverlay();
  }
});

// Check if the user is already logged in
window.addEventListener('load', function() {
  const xhr = new XMLHttpRequest();
  xhr.open('GET', 'check_login.php', true);
  xhr.onreadystatechange = function() {
    if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
      const response = JSON.parse(xhr.responseText);
      if (response.loggedIn) {
        document.getElementById('overlay').style.display = 'none';
        document.getElementById('username').textContent = response.username;
        document.getElementById('username-container').style.display = 'inline';
        document.getElementById('login-register-container').style.display = 'none';
        document.getElementById('google-login-link').style.display = 'none';
      }
    }
  };
  xhr.send();
});

// Logout function
document.getElementById('logout-link').addEventListener('click', function(event) {
  event.preventDefault();
  logoutUser();
});

function logoutUser() {
  const xhr = new XMLHttpRequest();
  xhr.open('GET', 'logout.php', true);
  xhr.onreadystatechange = function() {
    if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
      location.reload();
    }
  };
  xhr.send();
}

// Handle form submissions
document.getElementById('login-form-data').addEventListener('submit', function(event) {
  event.preventDefault();
  loginUser();
});

document.getElementById('register-form-data').addEventListener('submit', function(event) {
  event.preventDefault();
  registerUser();
});

// Login function
function loginUser() {
  const username = document.getElementById('login-username').value;
  const password = document.getElementById('login-password').value;
  const errorMsg = document.getElementById('login-error-msg');

  // Send an AJAX request to login.php
  const xhr = new XMLHttpRequest();
  xhr.open('POST', 'login.php', true);
  xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
  xhr.onreadystatechange = function() {
    if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
      const response = xhr.responseText;
      if (response === 'success') {
        // Login successful, refresh the page
        location.reload();
      } else if (response === 'already_logged_in') {
        // User is already logged in
        errorMsg.textContent = 'You are already logged in.';
      } else {
        // Display the error message
        errorMsg.textContent = response;
      }
    }
  };
  xhr.send('username=' + encodeURIComponent(username) + '&password=' + encodeURIComponent(password));
}

// Register function
function registerUser() {
  const username = document.getElementById("register-username").value;
  const password = document.getElementById("register-password").value;
  const errorMsg = document.getElementById("register-error-msg");

  // Send an AJAX request to register.php
  const xhr = new XMLHttpRequest();
  xhr.open("POST", "register.php", true);
  xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
  xhr.onreadystatechange = function() {
    if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
      const response = xhr.responseText;
      if (response === "success") {
        // Registration successful, display a success message
        errorMsg.textContent = "Registration successful! You can now login.";
        errorMsg.style.color = "green";
        setTimeout(function() {
          closeOverlay();
          openLoginForm();
          errorMsg.textContent = "";
        }, 2000);
      } else {
        // Display the error message
        errorMsg.textContent = response;
        errorMsg.style.color = "red";
      }
    }
  };
  xhr.send("username=" + encodeURIComponent(username) + "&password=" + encodeURIComponent(password));
}