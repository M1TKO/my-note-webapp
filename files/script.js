function logOut() {
	document.write('<php session_destroy(); header('Location: index.php'); ?> ');
}