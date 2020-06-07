<?php


class CRouter{


    private $requestUri;
    private $requestMethod;
    private $supportedMethodArray = array('GET', 'POST');
    private $get = [];
    private $post = [];
  /*      $array = explode('/', $_SERVER['PATH_INFO']);
        $controller = new $array[1]();
        $method = strtolower($array[2]);
        try{
         call_user_func(array($controller, $method));
        }
        catch(Error $e){
            echo "test";
        }

        */


    function __call($name, $args){

        $this->requestUri = $args[0];
        $this->requestMethod = strtolower($name);

        $controllerMethod = array(explode('/', $this->requestUri)[1],explode('/', $this->requestUri)[2]);

        switch($this->requestMethod){
            case "get":
                $this->get[$this->requestUri] = $controllerMethod;
                break;
            case "post":
                $this->post[$this->requestUri] = $controllerMethod;
                break;
        }
        return $this;
    }

    function resolve(){

        $test = $this->requestMethod;
        $test1 = $this->requestUri;
        $methodArray = $this->{$test}[$test1];
        $test = new $methodArray[0];
        $test->{$methodArray[1]}();
    }
}
//Alexandru Ichim
?>
