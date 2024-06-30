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

		<?php
		if (isset($_POST['submitted'])) {
			require_once('connectdb.php');

			$username = isset($_POST['username']) ? $_POST['username'] : false;
			$password = isset($_POST['password']) ? password_hash($_POST['password'], PASSWORD_DEFAULT) : false;
			$email = isset($_POST['email']) ? $_POST['email'] : false;
			$keyprogramming = isset($_POST['keyprogramming']) ? $_POST['keyprogramming'] : false;
			$profile = isset($_POST['profile']) ? $_POST['profile'] : false;
			$education = isset($_POST['education']) ? $_POST['education'] : false;
			$url = isset($_POST['url']) ? $_POST['url'] : false;

			if (empty($_POST['username'])) {
				echo "<p style='color:#D81E3D'; >Please insert a Username! </p><br>";
			} else if (empty($_POST['password'])) {
				echo "<p style='color:#D81E3D'; >Please insert a Password!</p><br>";
			} else if (strlen($_POST['password']) < 6) { 
				echo "<p style='color:#D81E3D'; >Password must be 6 characters or more.</p><br>";
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

					$stat = $db->prepare("insert into cvs values(default,?,?,?,?,?,?,?)");
					$stat->execute(array($username, $email, $password, $keyprogramming, $profile, $education, $url));

					$id = $db->lastInsertId();
					echo "<p style='color: #00F95B; font-size:20px;' >Congratulations! You are now registered.</p> <br><br> "; 
				} catch (PDOexception $ex) {
					echo "<p style='color:#D81E3D'; >Sorry, a database error occurred! Make sure you don't leave any fields blank! </p><br>";
					
				}
			}
		}

		?>

		<h2 style="color: rgb(102, 139, 170)"> Register</h2> <br>

		<form method="post" action="register.php" id="signup-form">
			<p class="form-text">Username: </p><input id="firstname" type="text" name="username" /><br><br>
			<p class="form-text">Password: </p><input id="firstname" type="password" name="password" /><br><br>
			<p class="form-text">Email: </p><input id="firstname" type="text" name="email" /><br><br>
			<p class="form-text">Key Programming: </p><input id="firstname" type="text" name="keyprogramming" /><br><br>
			<p class="form-text">Profile: </p><input id="firstname" type="text" name="profile" /><br><br>
			<p class="form-text">Education: </p><input id="firstname" type="text" name="education" /><br><br>
			<p class="form-text">URL Links: </p><input id="firstname" type="text" name="url" /><br><br>

			<input id="submit" type="submit" value="Register" style="font-size:15px" />
			<input id="submit" type="reset" value="Clear" style="font-size:15px" />
			<input type="hidden" name="submitted" value="true" />
		</form>
		<br>
		<p class="p-heading" style="font-size:15px"> Already a user? <a id="mailbox-format" href="index.php" style="font-size:16px">Log in</a> </p>
	</div>

</body>


</html>