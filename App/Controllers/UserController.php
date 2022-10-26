<?php
namespace Shop\Controllers;

use Shop\Models\TwitterQuery;
use Shop\Models\UserQuery;
use Shop\Service\UserService;
use Shop\Validation\UserValidation;

class UserController extends BaseController
{
    protected UserService $userService;

    function __construct()
    {
        $this->userService = new UserService();   
    }

    public function login()
    {
        if (isset($_SESSION['userLoggedIn']))
        {
            $this->redirectWithMessage("You are already logged in", "/");
        }

        $this->_render("login");
    }

    public function register()
    {
        if (isset($_SESSION['userLoggedIn']))
        {
            $this->redirectWithMessage("You are already logged in", "/");
        }
        
        $this->_render("register");
    }

    public function loginUser($post)
    {
        $validation = UserValidation::LoginUserValidate($post);
        if (!$validation[0])
        {
            return $this->redirectWithPersistance($validation[1], "login");
        }

        $user = $this->userService->getUserByUsername($post->username);

        if ($user == null)
        {
            return $this->redirectWithPersistance("Username or Password does not match", "login");
        }

        if (!password_verify($post->password, $user->getPassword()))
        {
            return $this->redirectWithPersistance("Username or Password does not match", "login");
        }

        if ($user->getIsBanned())
        {
            return $this->redirectWithPersistance("You are banned, please contact the administrators", "login");
        }

        $_SESSION["userLoggedIn"] = $user;
        $this->redirectWithMessage("Login Successful, Welcome " . $user->getForename(), "/");
    }

    public function registerUser($post)
    {
        $validation = UserValidation::RegisterUserValidate($post);
        if (!$validation[0])
        {
            return $this->redirectWithPersistance($validation[1], "register");
        }
        
        if ($post->password != $post->password2)
        {
            return $this->redirectWithPersistance("Password does not match. Try again", "register");
        }

        $user = (new UserQuery)->findOneByUsername($post->username);
        if ($user != null)
        {
            return $this->redirectWithPersistance("Username already taken, please try another", "register");
        }

        // Hash password
        $post->password = password_hash($post->password, PASSWORD_BCRYPT);
        
        $this->userService->createUser($post);
        $this->redirectWithMessage("Register Success, please login", "/login");
    }

    public function profile($userLoggedIn)
    {
        if ($userLoggedIn == null)
        {
            return $this->redirectWithMessage("You need to login to access this", "/login");
        }

        $user = (new UserQuery)->findOneByUserId($userLoggedIn->getUserId());
        $twitter = (new TwitterQuery)->findOneByTwitterId($user->getTwitterId());

        if ($twitter != null)
        {
            $_SESSION['twitter'] = $twitter;
        }

        $this->_render("profile");
    }

    public function logout()
    {
        session_unset();
        session_destroy();

        session_start();
        $this->redirectWithMessage("Successful logout", "/");
    }
}