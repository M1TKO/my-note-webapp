
<?php 
class Validate{
    private function __construct(){}

     public static function username($user = ''){
        if(!isset($user) && strlen($user) < 3){
            throw new Exception("Username too short. ", 11);
        } else{
            $user = self::test_input($user);


            if(preg_match("/^[a-zA-Z0-9._-]{3,}$/m", $user) == true){

                if (strlen($user) > 20) {
                    throw new Exception("Username too long. ", 12);
                } else {
                    return $user;
                }

            } else {
                throw new Exception('Wrong username. ', 13);
            }
        }
        }
    
     public static function password($pass = ''){
        if(!isset($pass) || strlen($pass) < 6){
            throw new Exception("Password too short. ", 21);
        }else{
            $pass = self::test_input($pass);
            if (strlen($pass) >40) {
                throw new Exception("Password too long. ", 23);
            }else{
                return $pass;
            }
        }
    }

     public static function email($email = ''){
        if(isset($email) && strlen($email) > 5){
            $email = filter_var($email, FILTER_SANITIZE_EMAIL);
            

            if (!filter_var($email, FILTER_VALIDATE_EMAIL) == false && strlen($email) < 80) {
                return $email;
            } else{
                throw new Exception("Wrong Email. ", 33);
            }
        } else {
            throw new Exception('Email too short. ', 31);
        }

    }

     public static function noteText($data){
        return self::test_input($data);
    }

     public static function test_input($data) {
          $data = trim($data);
          $data = stripslashes($data);
          $data = htmlspecialchars($data);
          return $data;
    }




}
