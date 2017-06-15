<?php
session_start();

if (isset($_SESSION['user'])) {
	header('Location: home.php');
}
else {
	require 'files/Validate.php';
	require 'files/User.php';
	require 'files/db_connect.php';
	$error = '';
	$title = "MyNote - Register new account";
	$stylesheet = '<link rel="stylesheet" type="text/css" href="css/style.css">';
	include 'files/headTemplate.php';
	
}
?>
<body>
<?php

if ($_SERVER['REQUEST_METHOD'] == "POST") {

	if (isset($_POST['username']) && isset($_POST['password']) && isset($_POST['conf-password']) && isset($_POST['email'])) {
		try {
			$uname = Validate::username($_POST['username']);
			$pass = Validate::password($_POST['password']);
			$c_pass = Validate::password($_POST['conf-password']);
			$email = Validate::email($_POST['email']);
			if ($pass == $c_pass) {
				if (!($db->userDataExists('username', $uname))) {
					if (!($db->userDataExists('email', $email))) {
						$u = new User($uname, $pass, $email, $db);
						$_SESSION['user'] = $uname;
						$_SESSION['user_id'] = $db->getId($uname);

						header('Location: home.php');
					}
				}
			}
		}

		catch(Exception $e) {
			$error = $error . $e->getMessage();
			echo '<style>div[class="alert alert-danger"]{display:block;}</style>';
		}
	}
	else {
		$error = 'All fields are required. ';
	}
}

?>
<div class="nav">
 	<img src="logo-note.png" alt="logo-note" id="logo"><br>
	<h1 id="title"><a href="./" style="color: white;text-decoration: none;">MyNote</a></h1>
	<a href="./" id="login-btn" class="btn btn-primary" ><style="color:white; text-decoration: none">Log In</a>
</div>
<div class="register-form">
	<p id="reg-title">Register new account</p>
		<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
		  <div class="input-group">
		    <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i>
			</span>
		    <input id="username" type="text" class="form-control" name="username" placeholder="Username">
		  </div>
		  <div class="input-group">
		    <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
		    <input id="password" type="password" class="form-control" name="password" placeholder="Password">
		  </div>
		  <div class="input-group">
		  <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
		    <input id="conf-password" type="password" class="form-control" name="conf-password" placeholder="Confirm Password">
		  </div>
		  <div class="input-group">
		    <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i>
			</span>
		    <input id="email" type="text" class="form-control" name="email" placeholder="Email">
		  </div>
		  <div class="input-group">

			<div class="alert alert-danger">
  				<strong>* </strong><?php echo $error; ?>
			</div>
			
		  <input id="submit-reg" type="submit" class="btn btn-success" value="Register me">
		  </div>
		</form>
</div>
<?php include 'files/footer.html'; ?>


</body>
</html>