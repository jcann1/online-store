<?php include_once "../../vendor/autoload.php";

include_once "../../generated-conf/config.php";

use Bramus\Router\Router;
use Shop\Controllers\AdminController;
use Shop\Controllers\BasketController;
use Shop\Controllers\DiscountController;
use Shop\Controllers\HomeController;
use Shop\Controllers\PurchaseController;
use Shop\Controllers\TwitterController;
use Shop\Controllers\UserController;
use Shop\MockData\SaveMockData;

if (session_status() == PHP_SESSION_NONE) session_start();

if (isset($_SESSION["userLoggedIn"])) $userLoggedIn = $_SESSION["userLoggedIn"];

$post = new \stdClass();
foreach($_POST as $key => $value) {
    $post->$key = $value;
}

if (!isset($_COOKIE['basket'])) {
    // Expires in one week
    setcookie('basket', "{}", time() + 604800, "/");
    header("Refresh:0");
    return;
}

$router = new Router();

// All Admins Endpoints
$router->get("/admin", fn()=> (new AdminController)->index());
$router->get("/admin/ban/(\d+)", fn($id)=> (new AdminController)->banUser($id));
$router->get("/admin/unban/(\d+)", fn($id)=> (new AdminController)->unbanUser($id));

// All Basket Endpoints
$router->get("/basket", fn() => (new BasketController)->index());
$router->get("/basket/add/(\d+)", fn($id) => (new BasketController)->addProduct($id));

// All Discount Endpoints
$router->get("/discount", fn() => (new DiscountController)->index());
$router->get("/discount/create", fn() => (new DiscountController)->create());
$router->post("/discount/create", fn() => (new DiscountController)->createPOST($post));
$router->post("/discount/apply", fn() => (new DiscountController)->applyDiscount($post));
$router->get("/discount/delete/(\d+)", fn($id) => (new DiscountController)->delete($id));

// All Product Endpoints
$router->get("/", fn() => (new HomeController)->index());
$router->get("/product/create", fn() => (new HomeController)->createProductPage());
$router->get("/product/edit/(\d+)", fn($id) => (new HomeController)->editProductPage($id));
$router->post("/product/create", fn() => (new HomeController)->createProduct($post));
$router->post("/product/edit/(\d+)", fn($id) => (new HomeController)->editProduct($id, $post));
$router->get("/product/delete/(\d+)", fn($id) => (new HomeController)->deleteProduct($id));
$router->post("/product/edit/image/(\d+)", fn($id) => (new HomeController)->uploadProductImage($id));

// All Purchase Endpoints
$router->get("/purchase", fn() => (new PurchaseController)->index());
$router->get("/purchase/(\d+)", fn($purchaseId) => (new PurchaseController)->viewPurchases($purchaseId));
$router->post("/purchase/order", fn() => (new PurchaseController)->placeOrder($_COOKIE['basket'], $_SESSION["discount"], $_SESSION["userLoggedIn"]));

// All User Endpoints
$router->get("/login", fn() => (new UserController)->login());
$router->get("/register", fn() => (new UserController)->register());
$router->get("/logout", fn() => (new UserController)->logout());
$router->get("/profile", fn() => (new UserController)->profile($userLoggedIn));
$router->post("/login", fn() => (new UserController)->loginUser($post));
$router->post("/register", fn() => (new UserController)->registerUser($post));

// All Twitter Endpoints
$router->get("/twitter/authorize/(\w+)", fn($action) => (new TwitterController)->authorize($action));
$router->get("/twitter/callback", fn() => (new TwitterController)->callback());

// All Mock data endpoints
$router->get("/mock/user", fn() => SaveMockData::CreateUsersFromJSON());
$router->get("/mock/product", fn() => SaveMockData::CreateProductsFromJSON());
$router->get("/mock/purchase", fn() => SaveMockData::Create50Purchase());

$router->run();