<?php

session_start();
session_destroy();

?>

<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <title>Home</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
  <link rel="shortcut icon" type="image/x-icon" href="Images/cv.png" />
  <link rel="stylesheet" href="style.css" />
  <meta name="description" content="" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link rel="stylesheet" href="style.css" />
  <script src="https://kit.fontawesome.com/aa1a7f25aa.js" crossorigin="anonymous"></script>
</head>

<body>
  <header>
    <div class="main-header">
      <nav>
        <ul class="nav_links">
          <li><a id="name" href="viewcv.php">Home</a></li>
          <?php
          session_start();
          if (isset($_SESSION["username"])) {
            $id = $_SESSION['username'];
            echo "<li><a  class='button' href='profile.php'>Profile</a></li>";
            echo "<li><a  class='button' href='logout.php'>Log Out</a></li>";
          } else {
            echo "<li><a  class='button' href='register.php'>Sign up</a></li>";
            echo "<li><a  class='button' href='index.php'>Log In</a></li>";
          }
          ?>
        </ul>
      </nav>
    </div>
  </header>

  <div style="padding: 30px">
    <h2 style="color: rgb(102, 139, 170)"> Logged out now! </h2> <br>
    <p style="color:white;  font-family: 'Montserrat'; font-size:15px">Would like to log in again? <a href="index.php" id="mailbox-format" style="font-size:16px">Log in</a> </p>
  </div>
</body>
  