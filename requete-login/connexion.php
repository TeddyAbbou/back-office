<?php

require "../classes/classCheckId.php";
require "../classes/redirection.php";

$login = $_POST['nom'];
$password = $_POST['password'];

if ($login ===  "" || $password === ""){
    ?>
    <!doctype html>
    <html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="refresh" content="2, URL=../index.php">
        <title>Connexion</title>
    </head>
    <body>

    <h2>vous n'avez pas remplis tout les champs du formulaire!</h2>

    </body>
    </html>
    <?php
}

else if(isset($login) && isset($password)) {

        $connexionUser = new CheckId($login, $password);
        if ($connexionUser->checkId() === false) {
            echo $connexionUser->errorId;
        } else {
            session_start();
            $_SESSION['iduser'] = $connexionUser->checkId()['id'];

            if ($connexionUser->checkId()['init'] === "1") {

                $redirectionHome = new Redirection("../siteform.php");
                $redirectionHome->redirect();

            } else {

                $redirectionChangePW = new Redirection("../premiereConnexion.php");
                $redirectionChangePW->redirect();

            }
        }
    }
?>