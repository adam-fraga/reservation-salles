<!--PHP-->
<?php
//Inclusion DB et fichier class
require '../config/db/db.php';
require '../config/class/class.php';

if (isset($_POST['submit'])) {
    $user = new User();
    $message = $user->inscription($_POST['login'], $_POST['password'], $_POST['confpassword']);
}
?>
<!--HTML-->
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../style/global.css">
    <link rel="stylesheet" href="../style/inscription.css">

    <title>Document</title>
</head>
<body>
<?php include 'header.php' ?>
<main class="main">
    <section class="pesentation container-col">
        <h1 class="title-main">NOUS REJOINDRE</h1>
        <p>Pour pouvoir éffectuer votre premiere reservation remplissez le formulaire d'inscription ci dessous,
            Inutile de vous précisez que le Staff ne vous demandera jamais vos informations de connexion,
            Alors gardez les précieusement! en ésperant vous voir d'ici peu!</p>
    </section>
    <section class="container-col bloc-inscription decoration-bloc">
        <h2 class="title-main font-light">Formulaire d'inscription</h2>
        <form action="" method="post" class="form-inscription container-col">
            <label for="login" class="label font-light">Votre identifiant</label>
            <input type="text" name="login" id="login" required placeholder="Entrez votre identifiant">
            <label for="password" class="label font-light">Votre mot de passe</label>
            <input type="password" name="password" id="password" value="password" required>
            <label for="confpass" class="label font-light">Confirmez votre mot de passe</label>
            <input type="password" name="confpassword" id="confpass" required value="password">
            <button class="button" name="submit" type="submit">Envoyer</button>
            <?php if (isset($_POST['submit'])) {
                echo '<p>' . $message . '</p>';
            } ?>
        </form>
    </section>
</main>
<?php include 'footer.php' ?>
</body>