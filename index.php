<?php
	session_start();

	if (isset($_SESSION['user'])) {
		header('Location: home.php');
	}
	$stylesheet = '<link rel="stylesheet" type="text/css" href="css/style.css">';
	$title = 'MyNote - Login';
	$error = '';
	require 'files/Validate.php';
	require 'files/DB.php';
	require 'files/headTemplate.php';

	$db = new DB('localhost', 'root', '', 'my_note');
?>
<body>
<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	if (isset($_POST['username'], $_POST['password'])) {
		try {
			$uname = Validate::username($_POST['username']);
			$pass = Validate::password($_POST['password']);
			if ($db->userDataExists('username', $uname)) {
				$pass_db = $db->userDataMatch('password', 'username', $uname);
				if ($pass_db === $pass) {
					$_SESSION['user'] = $uname;
					$_SESSION['user_id'] = $db->getId($uname);
					header('Location: home.php');
				}
				else {
					throw new Exception("Username or password doesn't match");
					echo '<style>div[class="alert alert-danger"]{display:block;}</style>';
				}
			}
			else {
				throw new Exception("Wrong username or password");
			}
		}

		catch(Exception $e) {
			$error = $e->getMessage();
			echo '<style>div[class="alert alert-danger"]{display:block;}</style>';
		}
	}
	else {
		$error = 'All fields are required. ';
		echo '<style>div[class="alert alert-danger"]{display:block;}</style>';
	}
}

?>
 <div class="nav">
 	<img src="logo-note.png" alt="logo-note" id="logo"><br>
	<h1 id="title"><a href="./" style="color: white;text-decoration: none;">MyNote</a></h1>
	<a href="./register.php" id="login-btn" class="btn btn-primary" ><style="color:white; text-decoration: none">Register</a>
</div>
<div class="register-form">
	<p id="reg-title">Login to your account</p>
		<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
		  <div class="input-group">
		    <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i>
			</span>
		    <input id="username" type="text" class="form-control" name="username" placeholder="Username" autofocus>
		  </div>
		  <div class="input-group">
		    <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
		    <input id="password" type="password" class="form-control" name="password" placeholder="Password">
		  </div>
		  <div class="input-group">

			<div class="alert alert-danger">
  				<strong>* </strong><?php echo $error; ?>
			</div>
			
		  <input id="submit-reg" type="submit" class="btn btn-success" value="Log In">
		  </div>
		</form>
</div>


 </body>
 </html>