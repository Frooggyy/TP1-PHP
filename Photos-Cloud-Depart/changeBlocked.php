<?php
include 'php/sessionManager.php';
include 'models/users.php';
adminAccess();
$userId = (int) $_GET["id"];
$user = UsersFile()->get($userId);

if ($user->isBlocked()) {
    $user->setBlocked(0);
}else {
    $user->setBlocked(1);
}


UsersFile()->update($user);
redirect('manageUsers.php');
?>