<?php  
session_start();
if(isset($_SESSION['user'])){
	header('Location: home.php');
} else {
	require 'files/Validate.php';
	require 'files/User.php';
	include 'files/DB.php';
	$db = new DB('localhost', 'root', '', 'my_note');
	$title = "MyNote - Register new account";
	$stylesheet = '<link rel="stylesheet" type="text/css" href="css/register.css">';
	include 'files/headTemplate.php';
}
?>
<body>
<div class="nav">
	<h1 id="title">MyNote</h1>
	<button id="login-btn" class="btn btn-primary" ><a href="./" style="color:white; text-decoration: none">Log In</a></button>
</div>
<div class="register-form">
	<p id="reg-title">Register new account</p>
		<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
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

		  <input id="submit-reg" type="submit" class="btn btn-success" value="Register me">
		  </div>
		</form>
</div>

}
<?php 

if ($_SERVER['REQUEST_METHOD'] == "POST") {
	// $user = new User();
	if (isset($_POST['username'], $_POST['password'], $_POST['conf-password'], $_POST['email'])){
		try{
			$uname = Validate::username($_POST['username']);
			$pass = Validate::password($_POST['password']);
			$c_pass = Validate::password($_POST['conf-password']);
			$email = Validate::email($_POST['email']);

			if ($pass == $c_pass) {
				if(!($db->userDataExists($uname, 'username'))){
					if(!($db->userDataExists($email, 'email'))){

						$u = new User($uname, $pass, $email, $db);
						$_SESSION['user'] = $uname;
						header('Location: home.php');




					}
				}

			}




		}catch(Exception $e){
			echo 'error: '. $e->getMessage();
		}





	// $u = new User();

	}
	





	}







 ?>






</body>
</html>