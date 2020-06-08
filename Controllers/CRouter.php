<?php


class CRouter{


    private $requestUri;
    private $requestMethod;
    private $getArgs;
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

        $request_array = explode('/',$this->requestUri);

        $controllerMethod = array($request_array[1], $request_array[2]);
        if(count($request_array) >= 4)
            $this->getArgs = $request_array[3];

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

        $method = $this->requestMethod;
        $uri = $this->requestUri;
        $methodArray = $this->{$method}[$uri];
        $test = new $methodArray[0]();
        if((isset($this->getArgs)) === False)
            $test->{$methodArray[1]}();
        else $test->{$methodArray[1]}($this->getArgs);
    }
}
//Alexandru Ichim
?>
