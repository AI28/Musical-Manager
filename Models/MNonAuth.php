<?php

include_once("DBConn.php");

class MNonAuth{
    public function registerUser($userName, $email, $firstPassword, $sndPassword){
        $sql = "INSERT INTO users(Username, Email, PasswordHash) VALUES(:cUserName, :cEmail, :cPassword)";
        echo "$userName $email $firstPassword $sndPassword";
        if(empty($userName)||empty($email)||empty($firstPassword)||empty($sndPassword)){
            throw new Exception("Exception. Please leave no empty fields.");
        }
        if($firstPassword !== $sndPassword){
            throw new Exception("Exception. Unmatching passwords.");
        }
        if(!preg_match('/^[a-zA-Z0-9._-]+@[a-zA-Z0-9]+\.[a-zA-Z]{2,5}$/', $email)){
            throw new Exception("Exception. Invalid email address.");
        }
        $request = DBConn::getConnection()->prepare($sql);
        return $request -> execute(['cUserName' => $userName, 'cEmail' => $email, 'cPassword' => password_hash($firstPassword, PASSWORD_DEFAULT)]);
    }

    public function loginUser($userName, $password){
        $sql = DBConn::getConnection()->
            prepare("SELECT PasswordHash FROM users WHERE Username =:cUsername");
        $sql->execute(['cUsername'=>$userName]);
        $passwordHash = $sql->fetch();
        if($passwordHash === False)
            throw new Exception("Exception. User doesn't exist in the database.");
        return password_verify($password, $passwordHash[0]);
    }

    public function generateJWTArray($userName){
        $sql = DBConn::getConnection()->prepare("SELECT id, Email FROM users WHERE Username = :cUsername");
        $sql->execute(['cUsername'=>$userName]);
        $user_rows = $sql->fetch();
        $token = array( "iss"=>JWT_PARAMS::$iss, "aud"=>JWT_PARAMS::$aud,
            "iat"=>JWT_PARAMS::getIAT(),
            "exp"=>JWT_PARAMS::getEXT(),
            "data"=>array(
                "id"=>$user_rows[0],
                "Email"=>$user_rows[1],
                "username"=>$userName
            )
        );

        return JWT::encode($token, JWT_PARAMS::$key);
    }
}
//Alexandru Ichim
?>