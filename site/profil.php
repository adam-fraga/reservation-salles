<?php
session_start();
//Inclusion fichier DB + Classe
require '../config/class/class.php';
require '../config/db/db.php';
//Si action boutton
if (isset($_POST['submit']))
{
    $user = new User();
    $user->setLogin($_POST['login']);
    $user->setId($_SESSION['UserId']);
    $user->profil($_POST['login'],$_POST['password']);
}
var_dump('SESSION');
var_dump($_SESSION);
var_dump('POST');
var_dump($_POST);
?>


<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../style/global.css">
    <link rel="stylesheet" href="../style/profil.css">

    <title>Document</title>
</head>
<body>
<?php include 'header.php' ?>
<main class="main">
    <section class="pesentation container-col">
        <h1 class="title-main">Modifiez vos informations</h1>
        <p>Envie de changer vos informations personnel? peu importe votre motif il vous suffit simplement
            de remplir le formulaire ci dessous. Attention aucune confirmation ne vous sera demandé alors faites
            attention
            lors de la saisit de votre nouveau login et password!</p>
    </section>
    <section class="container-col bloc-profil decoration-bloc">
        <h2 class="title-main font-light">Formulaire de gestion de profil</h2>
        <form action="" method="post" class="form-profil container-col">
            <label for="login" class="label font-light">Votre nouvel identifiant</label>
            <input type="text" name="login" id="login" placeholder="Entrez otre identifiant">
            <label for="password" class="label font-light">Votre nouveau mot de passe</label>
            <input type="password" name="password" id="password" value="password">
            <button class="button" name="submit" type="submit">Envoyer</button>
        </form>
    </section>
</main>
<?php include 'footer.php' ?>
</body>