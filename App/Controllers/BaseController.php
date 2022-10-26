<?php
namespace Shop\Controllers;

class BaseController 
{
    public function _render(string $filename)
    {
        ob_start(); echo "<link rel='stylesheet' type='text/css' href='/css/$filename.css'/>"; $style = ob_get_clean();
        ob_start(); include_once __DIR__ . "/../Views/$filename.php"; $content = ob_get_clean();
        ob_start(); include_once __DIR__ . "/../Views/navbar.php"; $navbar = ob_get_clean();
        ob_start(); echo "<script type='module' src='/Script/public/$filename.js'></script>"; $script = ob_get_clean();
        include_once __DIR__ . "/../Views/_layout.php";
    }

    public function redirectWithMessage($message, $url)
    {
        $_SESSION['message'] = $message;
        header("Location: $url");
    }

    public function redirectWithPersistance($message, $fileName)
    {
        $_SESSION['message'] = $message;
        self::_render($fileName);
    }
    
    public static function RenderMessage()
    {
        $message = $_SESSION["message"] ?? null;
        if ($message != null)
        {
            echo "<div class='alert alert-danger' role='alert'>$message</div>";
            unset($_SESSION["message"]); // Message goes after refresh
        }
    }
    
    public static function NavbarDropDown($userLoggedIn)
    {
        if($userLoggedIn == null)
        {
            echo "<li><a class='dropdown-item' href='/login'>Login</a></li>";
            echo "<li><a class='dropdown-item' href='/register'>Register</a></li>";
        }
        else
        {
            if ($userLoggedIn->getLevel() >= 0) 
            {
                echo "<li><a class='dropdown-item' href='/profile'>Profile</a></li>";
                echo "<li><a class='dropdown-item' href='/purchase'>Purchases</a></li>";
                echo "<li><a class='dropdown-item' href='/logout'>Log out</a></li>";
            }
            if ($userLoggedIn->getLevel() >= 1)
            {
                echo "<li><hr class='dropdown-divider'></li>";
                echo "<li><a class='dropdown-item' href='/discount'>Discount</a></li>";
                echo "<li><a class='dropdown-item' href='/admin'>Admin</a></li>";
            }
        }   
    }

    public static function GetCookie($key)
    {
        return $_COOKIE[$key];
    }

    public static function updateCookie($key, $value)
    {
        // Expires in one week
        setcookie($key, $value, time() + 604800, "/");
    }

    public static function retainPostValue($key)
    {
        return !isset($_POST[$key]) ? "" : htmlspecialchars($_POST[$key]);
    }
}