<?php

    class Auth extends Url{

        

        public static function isLoggedIn()
        {
            
            return isset($_SESSION['isLoggedIn']) && $_SESSION['isLoggedIn'] ;
        }

        public static function requireLogin()
        {
            
            if(!static::isLoggedIn())
            {
                $_SESSION['loginError'] = "You are not allowed to access this page";
                Url::redirect('/Ecommerce/Login.php');
            }
        }

        public static function logOut()
        {
            if (ini_get("session.use_cookies")) {
                $params = session_get_cookie_params();
    
                setcookie(
                    session_name(),
                    '',
                    time() - 42000,
                    $params["path"],
                    $params["domain"],
                    $params["secure"],
                    $params["httponly"]
                );
            }
            session_destroy();
        }
    }

?>