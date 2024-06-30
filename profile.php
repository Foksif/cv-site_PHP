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
                    $id = $_GET['alpha'];
                    session_start();

                    if (isset($_SESSION["username"])) {
                        $id = $_SESSION['username'];
                        echo "<li><a  class='button' href='profile.php?alpha=$id'>Profile</a></li>";
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
        <h2 style="color: rgb(102, 139, 170)"> Update your information!</h2> <br>

        <?php
        $id = $_GET['alpha'];
        echo "<form method='POST' id='profile.php?alpha=$id'>";
        echo "<p class='form-text'>Username: </p><input id='firstname' type='text' name='username' /><br><br>";
        echo  "<p class='form-text'>Email: </p><input id='firstname' type='text' name='email' /><br><br>";
        echo "<p class='form-text'>Key Programming: </p><input id='firstname' type='text' name='keyprogramming' /><br><br>";
        echo "<p class='form-text'>Profile: </p><input id='firstname' type='text' name='profile' /><br><br>";
        echo "<p class='form-text'>Education: </p><input id='firstname' type='text' name='education' /><br><br>";
        echo  "<p class='form-text'>URL Links: </p><input id='firstname' type='text' name='url' /><br><br>";

        echo "<input id='submit' name='update' type='submit' value='Update' style='font-size:15px' />";
        echo "<input type='hidden' name='submitted' value='true' />";
        echo "</form>"
        ?>

        <br>

        <?php

        if (isset($_POST['submitted'])) {
            require_once('connectdb.php');
            $id = $_GET['alpha'];

            $username = isset($_POST['username']) ? $_POST['username'] : false;
            $email = isset($_POST['email']) ? $_POST['email'] : false;
            $keyprogramming = isset($_POST['keyprogramming']) ? $_POST['keyprogramming'] : false;
            $profile = isset($_POST['profile']) ? $_POST['profile'] : false;
            $education = isset($_POST['education']) ? $_POST['education'] : false;
            $url = isset($_POST['url']) ? $_POST['url'] : false;


            if (empty($_POST['username'])) {
                echo "<p style='color:#D81E3D'; >Please insert a Username! </p><br>";
            } else if (empty($_POST['email'])) {
                echo "<p style='color:#D81E3D'; >Please insert an Email!</p><br>";
            } else if (empty($_POST['keyprogramming'])) {
                echo "<p style='color:#D81E3D'; >Please insert a Key Programming Language!</p><br>";
            } else if (empty($_POST['profile'])) {
                echo "<p style='color:#D81E3D'; >Please insert a Profile!</p><br>";
            } else if (empty($_POST['education'])) {
                echo "<p style='color:#D81E3D'; >Please insert an Education!</p><br>";
            } else if (empty($_POST['url'])) {
                echo "<p style='color:#D81E3D'; >Please insert a URL Link!</p><br>";
            } else {
                try {

                    $stat = $db->prepare("UPDATE cvs SET name='$username', email='$email', keyprogramming='$keyprogramming', 
                profile='$profile', education='$education', URLlinks='$url' where name='$id'");

                    $stat->execute();

                    echo "<p style='color: #00F95B; font-size:20px;' >Congratulations! Your details have been updated!</p> <br>";
                    echo "<p style='color:white; font-size:14px; font-family: 'Montserrat';'>If you want to update your profile again, please log out first and log back in for the update to take full effect!</p>";
                } catch (PDOexception $ex) {
                    echo "<p style='color:#D81E3D'; >Sorry, a database error occurred! Make sure you don't leave any fields blank! </p><br>";
                    echo "Error details: <em>" . $ex->getMessage() . "</em> <br><br>";
                }
            }
        }
        ?>
        <br>
    </div>

</body>





</html>