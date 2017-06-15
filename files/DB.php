<?php
/**
 __construct() // create connection with the database
 userDataExists(data to check , column) // checks if email or username exists
 addAccount(username , password , email) // add account to the database
 !!!	removeAccount(username) // remove account from the system
 *
 */
class DB{

	private $db_host, $db_username, $db_password, $db_name = '';
	private $conn;

	// private $host = $username = $password = $name;

	public function __construct($db_host = '', $db_username = '', $db_password = '', $db_name = ''){
		if (isset($db_host, $db_username, $db_name)) {
			$this->conn = mysqli_connect($db_host, $db_username, $db_password, $db_name);
			mysqli_set_charset($this->conn, "utf8");
			if (!$this->conn) {
				die("Failed to conect to the database. ");
			}
		}
	}

	public function userDataExists($col_name, $user_data){
		  // header('Content-Type: text/html; charset=utf-8');
		$query = "SELECT * FROM users WHERE ".$col_name." = '" . $user_data . "';";
		$r = mysqli_query($this->conn, $query);
		if (mysqli_num_rows($r) > 0) {
			return true;
		}else{
			return false;
		}
	}

	public function userDataMatch($par1, $par2, $par3){
		$query = "SELECT $par1 FROM users WHERE $par2 = '" . $par3 . "';";
		$result = mysqli_query($this->conn, $query);
		if (mysqli_num_rows($result) > 0) {
			$row = mysqli_fetch_assoc($result);
			return $row[$par1];
		}
		else {
			return false;
		}
	}

	public function addAccount($user, $pass, $email){
		$query = 'INSERT INTO users(username, password, email) VALUES("' . $user . '", "' . $pass . '", "' . $email . '");';
		if (mysqli_query($this->conn, $query)) {
			return true;
		}
		else {
			return false;
		}
	}

	// DANGER !!!

	public function removeAccount($username){
		$query = 'DELETE FROM users WHERE username = "' . $username . '";';
		if (mysqli_query($this->conn, $query)) {
			return true;
		}
	}

	public function getId($name){
		$q = "SELECT user_id FROM users WHERE username = '".$name."';";
		$r = mysqli_query( $this->conn, $q);
		$row = mysqli_fetch_assoc($r);
		return $row['user_id'];
	}

	public function getNotes($u_id, $offset, $rowsperpage)	{
		$query = "SELECT title, body, date FROM notes WHERE `user_id` = $u_id ORDER BY `date` DESC LIMIT " . $offset . ", " . $rowsperpage . ";";
		$result = mysqli_query($this->conn, $query);
		$row_num = mysqli_num_rows($result);

		if ($row_num > 0) {
			$i = 0;
			while( ($row =  mysqli_fetch_assoc($result)) ) {
				$data[$i] = $row;
				$i++;
			}
			return $data;
			}
	}

	public function addNote($id = '', $title = '', $body = ''){
		$query = "INSERT INTO notes(user_id, title, body) VALUES(".$id.", '".$title."', '".$body."');";
		if (mysqli_query($this->conn, $query)) {
			return true;
		}else{
			return false;
		}

	}

	public function removeNote($u_id, $date){
		if (DateTime::createFromFormat('Y-m-d H:m:s', $date) !== FALSE) {

				$query = "DELETE FROM `notes` WHERE `notes`.`user_id` = $u_id AND `notes`.`date` = '".$date."' ";
				if(mysqli_query($this->conn, $query)){
					return true;
				}else{
					return false;
				}


		}else{
			return false;
		}

	}

public function changeData($type, $u_id, $new_data){
	$query = "UPDATE users SET $type = '$new_data' WHERE user_id = $u_id";


			if(mysqli_query($this->conn, $query)){
				return true;
			}else{
				return false;
			}

		}

public function getNotesQuantity($u_id){
	$query = "SELECT COUNT(*) AS `n` FROM notes WHERE user_id = '" . $u_id . "'";
	$result = mysqli_query($this->conn, $query);
	$resultVal = mysqli_fetch_assoc($result);
	return (int) $resultVal['n'];

}

}