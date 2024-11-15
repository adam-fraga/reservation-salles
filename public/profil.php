<?php
include '../config/function.php';
spl_autoload_register('includeClass');
includeClass('User');
includeClass('UserManager');
session_start();
$User = new User();
$PDO = new PDO('mysql:dbname=reservationsalles;host=localhost', 'root', '');
$UserManager = new UserManager($PDO);
if (isset($_POST['submit'])) {
    if (htmlspecialchars(isset($_POST['login'])) && htmlspecialchars(isset($_POST['password']))) {
        //Tableau assoc hydratation
        $tab = [
            'id' => $_SESSION['user']->getId(),
            'login' => $_POST['login'],
            'password' => $_POST['password'],
            'connected' => $_SESSION['user']->getConnected()
        ];
        $User->hydrate($tab);
        $UserManager->update($User);
        $_SESSION['user']=$User;
    }
}
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
            <input type="text" name="login" id="login" placeholder="Entrez votre identifiant">
            <label for="password" class="label font-light">Votre nouveau mot de passe</label>
            <input type="password" name="password" id="password" value="password">
            <button class="button" name="submit" type="submit">Envoyer</button>
        </form>
    </section>
</main>
<?php include 'footer.php' ?>
</body>