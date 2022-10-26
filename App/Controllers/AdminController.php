<?php
namespace Shop\Controllers;

use Shop\Models\UserQuery;
use Shop\Service\PurchaseService;
use Shop\Service\UserService;

class AdminController extends BaseController
{
    protected UserService $userService;
    protected PurchaseService $purchaseService;

    function __construct()
    {
        $this->userService = new UserService();
        $this->purchaseService = new PurchaseService();
    }

    public function index()
    {
        if (!isset($_SESSION['userLoggedIn']) || $_SESSION['userLoggedIn']->getLevel() < 1)
        {
            return $this->redirectWithMessage("You do not have permission to view this page", "/");
        }

        $this->_render("admin");
    }

    public function RenderAllPurchases()
    {
        $purchases = $this->purchaseService->getAllPurchases();
        foreach($purchases as $purchase)
        {
            $getPurchaseID = $purchase->getPurchaseId();
            $getUserID = $purchase->getUserId();
            $getPurchaseStatus = $purchase->getStatus();

            echo "<tr>";
            echo "<th scope='row'>$getPurchaseID</th>";
            echo "<td>$getUserID</td>";
            echo "<td>$getPurchaseStatus</td>";
            echo "</tr>";
        }
    }

    public function RenderAllUsers()
    {
        $users = $this->userService->getAllUsers();
        foreach($users as $user)
        {
            $userId = $user->getUserId();
            $username = $user->getUsername();
            $level = $user->getLevel();

            echo "<tr>";
            echo "<th scope='row'>$userId</th>";
            echo "<td>$username</td>";
            echo "<td>$level</td>";
            if ($_SESSION['userLoggedIn']->getLevel() == 1 && $level == 0)
            {
                echo "   <td>
                            <a class='btn btn-primary btn-sm mx-2' type='button' href='/admin/ban/$userId'>Ban</a>
                            <a class='btn btn-primary btn-sm mx-2' type='button' href='/admin/unban/$userId'>Waive Ban</a>
                        </td>";
            }

            if ($_SESSION['userLoggedIn']->getLevel() == 2)
            {
                echo "   <td>
                            <a class='btn btn-primary btn-sm mx-2' type='button' href='/admin/ban/$userId'>Ban</a>
                            <a class='btn btn-primary btn-sm mx-2' type='button' href='/admin/unban/$userId'>Waive Ban</a>
                        </td>";
            }

            echo "</tr>";
        }
    }

    public function banUser($userId)
    {
        $userLoggedIn = $_SESSION['userLoggedIn'];
        $user = (new UserQuery)->findOneByUserId($userId);

        if ($userLoggedIn == null)
        {
            return $this->redirectWithMessage("You need to login for this action", "/login");
        }

        if ($user == null)
        {
            return $this->redirectWithMessage("User does not exist", "/");
        }

        if ($userLoggedIn->getUserId() == $user->getUserId())
        {
            return $this->redirectWithMessage("You cannot ban yourself", "/admin");
        }

        if ($userLoggedIn->getLevel() == $user->getLevel())
        {
            return $this->redirectWithMessage("You do not have the privilege to ban " . $user->getForename() . " " . $user->getSurname(), "/admin");
        }

        $this->userService->banUserByUserId($user->getUserId());
        $this->redirectWithMessage("User has been banned", "/admin");
    }

    public function unbanUser($userId)
    {
        $userLoggedIn = $_SESSION['userLoggedIn'];
        $user = (new UserQuery)->findOneByUserId($userId);

        if ($userLoggedIn == null)
        {
            return $this->redirectWithMessage("You need to login for this action", "/login");
        }

        if ($user == null)
        {
            return $this->redirectWithMessage("User does not exist", "/");
        }

        if ($userLoggedIn->getUserId() == $user->getUserId())
        {
            return $this->redirectWithMessage("You cannot ban yourself", "/admin");
        }

        if ($userLoggedIn->getLevel() == $user->getLevel())
        {
            return $this->redirectWithMessage("You do not have the privilege to unban " . $user->getForename() . " " . $user->getSurname(), "/admin");
        }

        $this->userService->unBanUserByUserId($user->getUserId());
        $this->redirectWithMessage("User is no longer banned", "/admin");
    }
}
?>