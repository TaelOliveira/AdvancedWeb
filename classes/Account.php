<?php

namespace aitsydney;

use aitsydney\Database;
use Exception;

class Account extends Database{
    
    public function __construct(){

        parent::__construct();
        
    }

    public function register($email, $password){

        $query= "INSERT INTO account
                    (account_id, email, password, created, accessed, updated)
                    VALUES (UNHEX(?), ?, ?, NOW(), NOW(), NOW())";
    
        $register_errors = array();
        $response = array();

        if(strlen($password) < 8){
            $register_errors['password'] = "Minimum 8 characters!";
        }

        if(filter_var($email, FILTER_VALIDATE_EMAIL) == false){
            $register_errors['email'] = "Email address not valid!";
        }
print_r($register_errors);
        if(count($register_errors) == 0){
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $account_id = $this -> createAccountID();

            try{
                if($statement = $this -> connection -> prepare($query) == false){
                    throw(new \Exception('Query error!'));
                }
                $statement -> bind_param('sss', $account_id, $email, $hash);

                if($statement -> execute() == false){
                    throw(new \Exception('Failde to execute!'));
                }
                else{
                    //account is created in database
                    $response['success'] = true;
                }
            }
            catch(Exception $ex){
                error_log($ex -> getMessage());
            }
        }
        else{
            $response['errors'] = $register_errors;
            $response['success'] = false;
        }
        
        return $response;
    }

    private function createAccountID(){

        //random bytes
        $bytes = openssl_random_pseudo_bytes(16);

        //convert to hexadecimal
        $str = bin2hex($bytes);

        return $str;
    }

}

?>