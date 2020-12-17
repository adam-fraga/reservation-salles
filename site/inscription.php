<!--PHP-->
<?php
//Inclusion DB
require '../config/db.php';
//Bool permetant style message erreur ou succes
$fill = NULL;
//Bool  check login longueur
$loginLength = NULL;

//    Verification remplissage des champs
if (!empty($_POST['login']) && !empty($_POST['password']) && !empty($_POST['confpass'])) {
//        Stockage infos utilisateur
    $userLogin = htmlspecialchars($_POST['login']);
    $userPassword = htmlspecialchars($_POST['password']);
    $userConfpass = htmlspecialchars($_POST['confpass']);
    $fill = true;
    //    Verif longueur login
    if (strlen($userLogin) < 50) {
        $loginLength = true;
    } else {
        $loginLength = "Votre nom d'utilisateur est beaucoup trop long!";
    }
} else {
    $fill = "Tout les champs doivent être remplit!";
}

//Action boutton + control mot de passe = confpass + longueur login + case non vide
if (isset($_POST['submit']) && $fill == true && $loginLength == true && $userPassword == $userConfpass) {
    $userPassword = password_hash($userPassword,CRYPT_BLOWFISH);
    $sql = "INSERT INTO utilisateurs (login,password) VALUES (?,?)";
    $stmt = $PDO->prepare($sql);
    $stmt->bindParam(1, $userLogin);
    $stmt->bindParam(2, $userPassword);
    $stmt->execute();
    header('location:connexion.php');
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
            <input type="password" name="confpass" id="confpass" required value="password">
            <button class="button" name="submit" type="submit">Envoyer</button>
        </form>
    </section>
</main>
<?php include 'footer.php' ?>
</body>