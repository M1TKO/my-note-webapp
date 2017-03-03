<?php 
class User{
	private $username, $password, $email =  '';
	public $db;

	public function __construct($user = '', $pass = '', $email = '', $db){
		if (isset($user, $pass, $email)) {
			 $this->db = $db;
			if($this->db->addAccount($user, $pass, $email)){
				echo "account created";
			}

		}
	}


}


