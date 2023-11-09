<?php
include 'php/sessionManager.php';
include_once "models/Users.php";

$currentUser = UsersFile()->get($_SESSION['currentUserId']);
$currentUserId = strval($currentUser->id());
if ($currentUser->Type() == 1) {
    $_SESSION['isAdmin'] = true;
}
adminAccess();

$viewTitle = "Gestion des usagers";
$list = UsersFile()->toArray();
$viewContent = "";



foreach ($list as $User) {
    $id = strval($User->id());
    $name = $User->name();
    $email = $User->Email();
    $avatar = $User->Avatar();
    $isAdmin = $User->isAdmin();
    $isBlocked = $User->isBlocked();

    //Check si admin va changer si le user est un admin ou pas
    if ($isAdmin) {
        $txtAdmin = <<<HTML
        <div><a href="changeAdmin.php?id=$id">Un-Admin</a></div>
    HTML;
    } else {
        $txtAdmin = <<<HTML
            <div><a href="changeAdmin.php?id=$id">Admin</a></div>
        HTML;
    }

    //Check si le user est blocked, change si le user est blocked ou pas
    if ($isBlocked) {
        $txtBlocked = <<<HTML
        <div><a href="changeBlocked.php?id=$id">Un-Block</a></div>
    HTML;
    } else {
        $txtBlocked = <<<HTML
        <div><a href="changeBlocked.php?id=$id">Block</a></div>
    HTML;
    }

    $txtDelete = <<<HTML
    <div><a href="confirmDeleteProfilAdmin.php?id=$id">Delete</a></div>
    HTML;


    $UserHTML = <<<HTML
        <div class="UserRow" User_id="$id">
            <div class="UserContainer noselect">
                <div class="ManageUserLayout">
                    <div class="UserAvatar" style="background-image:url('$avatar')"></div>
                    <div class="UserInfo">
                        <span class="UserName">$name</span>
                        <a href="mailto:$email" class="UserEmail" target="_blank" >$email</a>
                    </div>
                          
        HTML;

    $finUserHTML = <<<HTML
                    
                </div>
            </div>
        </div>  
        HTML;

    $UserHTML = $UserHTML . $txtAdmin . $txtBlocked . $txtDelete.$finUserHTML;


    if ($currentUserId != $id) {
        $viewContent = $viewContent . $UserHTML;
    }
}


$viewScript = <<<HTML
    <script src='js/session.js'></script>
    <script defer>
        $("#addPhotoCmd").hide();
    </script>
HTML;

include "views/master.php";
