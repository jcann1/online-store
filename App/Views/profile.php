<?php

if (isset($_SESSION["userLoggedIn"])) $userLoggedIn = $_SESSION["userLoggedIn"];
$fullName = $userLoggedIn->getForename() . " " . $userLoggedIn->getSurname();
$twitter = $_SESSION['twitter'] ?? null;

echo "Welcome $fullName <br>";

if ($twitter != null)
{
    echo "Your twitter is linked! Username: " . $twitter->getName();
}
else
{
    echo "<a class='btn btn-primary' href='/twitter/authorize/register'>Link your twitter</a>";
}