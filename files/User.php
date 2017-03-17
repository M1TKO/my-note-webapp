<?php
class User {

    private $username, $password, $email = '';
    public $db;
    
    public function __construct($user = '', $pass = '', $email = '', $db){
        if (isset($user, $pass, $email)) {
            $this->db = $db;
            if ($this->db->addAccount($user, $pass, $email)) {
                echo "account created";
            }
            
        }
    }
    
    public static function changeUsername($new_name, $user_id, $db){

        if(!($db->userDataExists('username', $new_name))) {

            if($db->changeData('username', $user_id, $new_name)){
                return true;
            }else{
                return false;
            }
        }
    }

}