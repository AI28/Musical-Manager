<?php

use \Firebase\JWT;

spl_autoload_register(function($className){
    switch(substr($className, 0, 1)){
        case 'M':
            if(file_exists("Models".DIRECTORY_SEPARATOR.$className.".php"))
                include("Models".DIRECTORY_SEPARATOR.$className.".php");
            break;
        case 'V':
            if(file_exists("Views".DIRECTORY_SEPARATOR.$className.".php"))
                include("Views".DIRECTORY_SEPARATOR.$className.".php");
            break;
        case 'C':
            if(file_exists("Controllers".DIRECTORY_SEPARATOR.$className.".php"))
                include("Controllers".DIRECTORY_SEPARATOR.$className.".php");
        case 'U':
            if(file_exists("Util".DIRECTORY_SEPARATOR.$className.".php"))
                include("Util".DIRECTORY_SEPARATOR.$className.".php");
            break;
        case 'J':
            switch($className){
                case 'JWT':
                    include("Controllers".DIRECTORY_SEPARATOR."php-jwt-master".DIRECTORY_SEPARATOR."src".DIRECTORY_SEPARATOR."JWT.php");
                    break;
                case 'JWK':
                    include("Controllers".DIRECTORY_SEPARATOR."php-jwt-master".DIRECTORY_SEPARATOR."src".DIRECTORY_SEPARATOR."JWK.php");
                    break;
                case 'JWT_PARAMS':
                    include("Controllers".DIRECTORY_SEPARATOR."php-jwt-master".DIRECTORY_SEPARATOR."src".DIRECTORY_SEPARATOR."JWT_PARAMS.php");
                    break;
            }
}});

//Alexandru Ichim
?>

