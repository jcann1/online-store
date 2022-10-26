<?php
namespace Shop\Controllers;

use Shop\Service\TwitterService;

class TwitterController extends BaseController
{
    protected TwitterService $twitterService;

    function __construct()
    {
        $this->twitterService = new TwitterService();
    }

    public function authorize($action)
    {
        unset($_SESSION['action']);

        if ($action == "login" || $action == "register")
        {
            $_SESSION['action'] = $action;
        }

        if ($_SESSION['action'] == null)
        {
            $this->redirectWithMessage("Something went wrong.. try again", "/");
            return;
        }
        
        $auth = $this->twitterService->returnAuthInformation();
        $_SESSION["state"] = $auth->state;
        $_SESSION["challenge"] = $auth->challenge;
        $_SESSION["basicAuth"] = $auth->basicAuth;

        header("Location:$auth->url");
        die();
    }

    public function callback()
    {
        $get = $_GET;
        if ($get['code'] == null && $get['state'] == null)
        {
            $this->redirectWithMessage("Something went wrong.. try again", "/");
        }

        if ($get['state'] != $_SESSION['state'])
        {
            $this->redirectWithMessage("Something went wrong.. try again", "/");
        }

        switch ($_SESSION['action'])
        {
            case "register":
                $response = $this->twitterService->registerUser($get['code'], $_SESSION['challenge'], $_SESSION["basicAuth"], $_SESSION['userLoggedIn']);
                if (!$response[0])
                {
                    $this->redirectWithMessage("Something went wrong: ". $response[1], "/");
                    return;
                }

                $this->redirectWithMessage("Twitter Registration Complete", "/");
                break;

            case "login":
                $response = $this->twitterService->loginUser($get['code'], $_SESSION['challenge'], $_SESSION["basicAuth"]);
                if (!$response[0])
                {
                    $this->redirectWithMessage("Something went wrong: ". $response[1], "/");
                    return;
                }

                $_SESSION['userLoggedIn'] = $response[1];
                $this->redirectWithMessage("Login Successful, Welcome " . $response[1]->getForename(), "/");
                break;

            default:
                $this->redirectWithMessage("Something went wrong, try again", "/");
        }
    }
}