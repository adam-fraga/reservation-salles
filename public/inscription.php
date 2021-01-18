<!--PHP-->
<?php
include '../config/function.php';
spl_autoload_register('includeClass');
includeClass('User');
includeClass('UserManager');
//Nouvelle instance de PDO
$PDO = new PDO('mysql:dbname=reservationsalles;host=localhost', 'root', '');
//Nouvelle instance de userManager
$manager = new  UserManager($PDO);
//Nouvelle instance Utilisateur pour incription en BDD
$user = new User();
//Si action boutton form
if (isset($_POST['submit'])) {
//    Echapement des caractere saisit
    if (htmlspecialchars($_POST['password']) == htmlspecialchars($_POST['confirmPassword'])) {
        //Methode de remplsisage des attribut de l'objet utilisateur
        $user->hydrate($_POST);
        //Methode inscription BDD
        $manager->insert($user);
        unset($user);
        header('location:connexion.php');
    }
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
            <input type="password" name="confirmPassword" id="confpass" required value="password">
            <button class="button" name="submit" type="submit">Envoyer</button>
        </form>
    </section>
</main>
<?php include 'footer.php' ?>
</body>