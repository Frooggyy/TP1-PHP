<?php
include 'php/sessionManager.php';
include 'models/users.php';
adminAccess();
$userId = (int) $_GET["id"];
$user = UsersFile()->get($userId);

if ($user->Type() == 1)
    $user->setType(0);
else if ($user->Type() == 0)
    $user->setType(1);

UsersFile()->update($user);
redirect('manageUsers.php');
?>