<?php require('./src/config/project.php');

 $uri = str_replace('/'.$project_name.'/','', $_SERVER['REQUEST_URI'],) ;



 $router = [
    "" => './src/views/login.php',
    "login" => './src/views/login.php',
    "register" => './src/views/register.php',
    "logout" => './src/views/logout.php',
    "reset-password" => './src/views/reset-password.php',
    "profile" => './src/views/profile/profile.php',
    "update-profile" => './src/views/profile/update-profile.php',
    "change-password" => './src/views/profile/change-password.php',
    "404" => './src/views/404.php'
 ];

 if(array_key_exists($uri,$router )) {
    require($router[$uri]);
 } else {
   require($router['404']);
 }
?>