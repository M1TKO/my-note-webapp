<?php
/**
 __construct() // create connection with the database
 userDataExists(data to check , column) // checks if email or username exists
 addAccount(username , password , email) // add account to the database
 !!!	removeAccount(username) // remove account from the system
 *
 */
class DB

{
	private $db_host, $db_username, $db_password, $db_name = '';
	private $conn;

	// private $host = $username = $password = $name;

	public

	function __construct($db_host = '', $db_username = '', $db_password = '', $db_name = '')
	{
		if (!isset($db_host, $db_username, $db_name)) {
			echo 'miss';
		}
		else {
			$this->conn = mysqli_connect($db_host, $db_username, $db_password, $db_name);
			if (!$this->conn) {
				die("Failed to conect to the database. ");
			}
		}
	}

	// true = exists

	public

	function userDataExists($user_data, $col_name)
	{
		$query = "SELECT * FROM users WHERE $col_name = '" . $user_data . "';";
		$result = mysqli_query($this->conn, $query);
		if (mysqli_num_rows($result) > 0) {
			return true;

			// echo "exists <br />";
			// echo '<pre>'.print_r(mysqli_fetch_assoc($result), true).'</pre>';

		}
		else {
			return false;

			// echo "not exists";

		}
	}

	public

	function userDataMatch($par1, $par2, $par3)
	{

		// "SELECT password FROM users WHERE  username = 'Mitko1999';";

		$query = "SELECT $par1 FROM users WHERE $par2 = '" . $par3 . "';";
		$result = mysqli_query($this->conn, $query);
		if (mysqli_num_rows($result) > 0) {
			$row = mysqli_fetch_assoc($result);
			return $row['password'];
		}
		else {
			return false;
		}
	}

	public

	function addAccount($user, $pass, $email)
	{
		$query = 'INSERT INTO users(username, password, email) VALUES("' . $user . '", "' . $pass . '", "' . $email . '");';
		if (mysqli_query($this->conn, $query)) {
			return true;
		}
		else {
			return false;
		}
	}

	// DANGER !!!

	public

	function removeAccount($username)
	{
		$query = 'DELETE FROM users WHERE username = "' . $username . '";';
		if (mysqli_query($this->conn, $query)) {
			return true;
		}
	}

	public

	function changeData($u, $p, $e, $date)
	{
	}
}