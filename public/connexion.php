<!--PHP-->
<?php
include '../config/function.php';
spl_autoload_register('includeClass');
includeClass('User');
includeClass('UserManager');
session_start();
//Nouvelle instance de PDO
$PDO = new PDO('mysql:dbname=reservationsalles;host=localhost', 'root', '');
//Nouvelle instance de User
$user = new User();
//Nouvelle instance de userManager
$manager = new UserManager($PDO);
//Si action boutton
if (isset($_POST['login']) && isset($_POST['password']) && isset($_POST['submit'])) {
    //Hydrate User avec $_POST
    $user->hydrate($_POST);
    //Connecte l'utilisateur renvoi un bool
    $connexion = $manager->connect($user);
    if ($connexion == true) {
        echo 'test';
        $user->setConnected(true);
        $_SESSION['user'] = $user;
        header('location:reservation-form.php');
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
    <link rel="stylesheet" href="../style/connexion.css">

    <title>Document</title>
</head>
<body>
<?php include 'header.php' ?>
<main class="main">
    <section class="pesentation container-col">
        <h1 class="title-main">Connectez vous et reserver votre creneau</h1>
        <p>Connectez vous à l'aide du formulaire ci dessous pour acceder au creneaux de reservation
        </p>
    </section>
    <section class="container-col decoration-bloc bloc-connexion">
        <h2 class="title-main font-light">Formulaire de connexion</h2>
        <form action="" method="post" class="form-connexion container-col ">
            <label for="login" class="label font-light">Identifiant de connexion</label>
            <input type="text" name="login" id="login" placeholder="Entrez votre identifiant">
            <label for="password" class="label font-light">Mot de passe</label>
            <input type="password" name="password" id="password" value="password">
            <button class="button" name="submit" type="submit">Connexion</button>
        </form>
    </section>
</main>

<?php include 'footer.php' ?>
</body>
</html>