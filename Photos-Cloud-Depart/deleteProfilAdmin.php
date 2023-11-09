<?php
include 'php/sessionManager.php';
include 'models/users.php';
include 'models/photos.php';

userAccess();
$userId = (int) $_GET["id"];

do {
    $photos = PhotosFile()->toArray();
    $oneDeleted = false;
    foreach ($photos as $photo) {
        if ($photo->OwnerId() == $userId) {
            $oneDeleted = true;
            PhotosFile()->remove($photo->Id());
            break;
        }
    }
} while ($oneDeleted);

UsersFile()->remove($userId);
redirect('manageUsers.php');