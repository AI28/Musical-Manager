<?php
class CNonAuthentificated{
    private $model;

    public function __construct(){
        $this->model = new MNonAuth();
    }
    
    public function Register(){

        $json_input = json_decode(file_get_contents('php://input'));
        $additionalViewMessage = NULL;
        $successValue=False;
        try{
           $successValue = $this->model->registerUser($json_input->username, $json_input->email, $json_input->passwd, $json_input->retryPasswd);
        }
        catch(Exception $e){
             $additionalViewMessage = $e->getMessage();
        }
        if($successValue == False){
            echo json_encode(array('success'=>False,'additionalMessage'=>$additionalViewMessage));
        }
        else{
            echo json_encode(array('success'=>True,'additionalMessage'=>'You have succesfuly registered an account'));
        }
    }

    public function Login(){

        $json_input = json_decode(file_get_contents('php://input'));
        $loginResult = False;
        $additionalViewMessage=NULL;
        $token = NULL;
        $loginResult =  $this->model->loginUser($json_input->username, $json_input->password);
        if($loginResult === True){
               $additionalViewMessage = 'Succesfull login attempt';
               $token =  $this->model->generateJWTArray($json_input->username);
               http_response_code(200);
               setcookie("jwt_token", $token, -1, '/');
        }
        else $additionalViewMessage = 'Invalid credentials.';
        echo json_encode(array('success'=>$loginResult,'additionalMessage'=>$additionalViewMessage));
    }

}
//Alexandru Ichim
?>
