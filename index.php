<?php
	session_start();
// 	if($_SESSION['logged_in'] == true){
// 	// header 'notes.php';
// }
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>myNote</title>
</head>
<body>

<div>
	<form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" >
		Username:<input type="text" name="username"><br>
		Password:<input type="password" name="password"><br>
		<input type="submit" name="submit" value="Log in"><br>
	</form>

	<hr /><br>

	<form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" >
		Username: <input type="text" name="username" placeholder="5 to 16 letters" ><br>
		Password: <input type="password" name="password" placeholder="5 to 16 letters" ><br>
		Confirm password: <input type="password" name="conf-password" ><br>
		Email: <input type="email" name="email"><br>
		<input type="submit" name="submit" value="Register me"><br>
	</form>



<?php
if ($_SERVER['REQUEST_METHOD'] == "POST") {
	if ($_POST['submit'] == 'Log in') {

		//XSS ERROR !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!

		echo "<hr /><br />";
		echo "<b>LOGIN</b><br />";
		echo $_POST['username'] . '<br />';
		echo $_POST['password'] . '<br />';
	}elseif ($_POST['submit'] == "Register me") {

 //XSS ERROR !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
		echo "<hr /><br />";
		echo "<b>REGISTER</b><br />";
		echo $_POST['username'] . '<br />';
		echo $_POST['password'] . '<br />';
		echo $_POST['conf-password'] . '<br />';
		echo $_POST['email'] . '<br />';
	}
}


//
// function checkInput(){
//
// }


 ?>

















</body>
</html>
