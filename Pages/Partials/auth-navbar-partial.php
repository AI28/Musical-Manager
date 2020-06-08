<nav id='my-nav'>
    <span id='logo'><img src='Images/1765391-music/svg/003-music.svg' alt=''></span>
    <ul class='button-list'>
     <li><a href='/Pages/admin.php' id='account'><?php
          include_once($_SERVER["DOCUMENT_ROOT"].DIRECTORY_SEPARATOR."Controllers".DIRECTORY_SEPARATOR."php-jwt-master".DIRECTORY_SEPARATOR."src".DIRECTORY_SEPARATOR."JWT.php"); 
          include_once($_SERVER["DOCUMENT_ROOT"].DIRECTORY_SEPARATOR."Controllers".DIRECTORY_SEPARATOR."php-jwt-master".DIRECTORY_SEPARATOR."src".DIRECTORY_SEPARATOR."JWT_PARAMS.php"); 
          $user_array =  ((array)JWT::decode($_COOKIE['jwt_token'],JWT_PARAMS::$key, array('HS256')))["data"];
          echo $user_array->username;
        ?>
    </a></li>
     <li><a href='/Pages/dashboard.php' id='live'>Live</a></li>
     <li><a href='' id='music'>Music</a></li>
     <li><a href='' id='stats'>Stats</a></li>
    </ul>
</nav>

<!--Alexandru Ichim-->