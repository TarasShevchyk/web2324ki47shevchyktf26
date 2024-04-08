<?php

//Include google login processing file.
include('googlelogin.php');

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Taras Shevchyk - C/C++ Engineer</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
  <link rel="stylesheet" href="assets/css/styles.css">
</head>
<body>
  <header class="sticky-header">
    <div class="header-content">
      <div class="header-left">
        <img class="profile-pic animate__animated animate__fadeInLeft" src="photo.png" alt="Profile Picture">
      </div>
      <div class="header-right">
        <h1 class="animate__animated animate__fadeInRight">TARAS SHEVCHYK</h1>
        <h2 class="animate__animated animate__fadeInRight">C/C++ ENGINEER</h2>
      </div>
      <div class="header-menu">
        <?php
        if(isset($_SESSION["access_token"])) {
            // If logged in, display user's name and logout link
            echo '<div class="menu-item" id="username">'.$_SESSION['user_first_name'].' '.$_SESSION['user_last_name'].'</div>';
            echo '<a id="google-logout-link" href="logout.php" class="menu-item">Log out</a>';
        } else {
            // If not logged in, display login link
            echo '<li id="username-container" style="display: none;"><span id="username"></span> <a href="#" id="logout-link">Logout</a></li>';
            echo '<a id="google-login-link" href="'.$google_client->createAuthUrl().'" style="display: grid;" class="menu-item">Google login</a>';
            echo '<li id="login-register-container"><a id="login-register-link" href="#">Sign up | Sign in</a></li>';
            echo '<a id="logout-link" href="/" style="display: none;" class="menu-item">Log out</a>';
        }
        ?>
      </div>
    </div>
  </header>

  <main>
    <section class="box animate__animated animate__fadeInUp">
      <div class="textbox">
        <h3><i class="fas fa-graduation-cap"></i> EDUCATION</h3>
      </div>
      <h4>Lviv Polytechnic National University</h4>
      <p>Bachelor's degree in Computer Engineering 2020 - Present</p>
    </section>

    <section class="box animate__animated animate__fadeInUp">
      <div class="textbox">
        <h3><i class="fas fa-briefcase"></i> WORK EXPERIENCE</h3>
      </div>
      <h4>The "FileManager" project in C++</h4>
      <p>is a file manager with a textual interface for interacting with the file system of the Windows operating system. It provides basic operations of creating, deleting, renaming and copying files and directories. The program displays file properties and provides an option to work with archives.</p>
      <ul>
        <li><i class="fas fa-code"></i> Used technologies: C++</li>
        <li><i class="fab fa-windows"></i> Windows API Filesystem Library Git/GitHub</li>
      </ul>
    </section>

    <section class="box animate__animated animate__fadeInUp">
      <div class="textbox">
        <h3><i class="fas fa-heart"></i> HOBBIES AND INTERESTS</h3>
      </div>
      <p>I am fond of learning foreign languages and solving algorithmic problems. I also enjoy reading and drawing.</p>
    </section>

    <section class="box animate__animated animate__fadeInUp">
      <div class="textbox">
        <h3><i class="fas fa-user"></i> PROFILE</h3>
      </div>
      <p>I am a young, ambitious and highly motivated C++ engineer with a strong desire to succeed in the world of programming.</p>
    </section>

    <section class="box animate__animated animate__fadeInUp">
      <div class="textbox">
        <h3><i class="fas fa-star"></i> PERSONAL SKILLS:</h3>
      </div>
      <p>Teamwork, Responsibility, Time management, Conflict Resolution, Flexibility, Organization Skills, Creativity</p>
    </section>

    <section class="box animate__animated animate__fadeInUp">
      <div class="textbox">
        <h3><i class="fas fa-code"></i> DEVELOPER SKILLS:</h3>
      </div>
      <p>C/C++, Algorithms and data structures, OOP, Windows API, Git/GitHub, Debugger</p>
    </section>

    <section class="box animate__animated animate__fadeInUp">
      <div class="textbox">
        <h3><i class="fas fa-address-book"></i> CONTACTS</h3>
      </div>
      <p><i class="fas fa-phone"></i> +380689536673</p>
      <p><i class="fas fa-map-marker-alt"></i> Lviv</p>
      <p><i class="fas fa-envelope"></i> <a href="mailto:taras.shevchyk.72@gmail.com" target="_blank">taras.shevchyk.72@gmail.com</a></p>
      <p><i class="fab fa-github"></i> <a href="https://github.com/TarasShevchyk" target="_blank">GitHub</a></p>
    </section>
  </main>

  <!-- Login/Register Overlay -->
  <div id="overlay" class="overlay">
    <div class="overlay-content">
      <span class="close-btn">&times;</span>
      <div id="login-form" class="form">
        <h2>Sign In</h2>
        <form id="login-form-data" method="post" action="login.php">
          <input type="text" id="login-username" name="username" placeholder="Username" required>
          <input type="password" id="login-password" name="password" placeholder="Password" required>
          <input type="submit" value="Login">
        </form>
        <p id="login-error-msg" class="error-msg"></p>
        <p>Not registered? <span id="register-link" class="link">Register now!</span></p>
      </div>
      <div id="register-form" class="form">
        <h2>Sign Up</h2>
        <form id="register-form-data" method="post" action="register.php">
          <input type="text" id="register-username" name="username" placeholder="Username" required>
          <input type="password" id="register-password" name="password" placeholder="Password" required>
          <input type="submit" value="Register">
        </form>
        <p id="register-error-msg" class="error-msg"></p>
        <p>Already registered? <span id="login-link" class="link">Login now!</span></p>
      </div>
    </div>
  </div>

  <script src="assets/js/animations.js"></script>
  <script src="scripts.js"></script>
</body>
</html>