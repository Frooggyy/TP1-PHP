<?php
    include 'php/sessionManager.php';
    include 'models/users.php';
    $viewTitle = "Retrait de compte";
    
    adminAccess(200);
    $userId = (int)$_GET["id"];
    $viewContent = <<<HTML
    <div class="content loginForm">
        <br>
       <h3> Voulez-vous vraiment effacer le compte? </h3>
        <div class="form">
            <a href="deleteProfilAdmin.php?id=$userId"><button class="form-control btn-danger">Effacer le compte</button>
            <br>
            <a href="manageUsers.php" class="form-control btn-secondary">Annuler</a>
        </div>
    </div>
    HTML;
    $viewScript = <<<HTML
        <script defer>
            $("#addPhotoCmd").hide();
        </script>
    HTML;
    include "views/master.php";