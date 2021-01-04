<?php
include '../config/function.php';
spl_autoload_register('includeClass');
includeClass('User');
includeClass('Event');
includeClass('EventManager');
session_start();

$PDO = new PDO('mysql:dbname=reservationsalles;host=localhost', 'root', '');
$Event = new Event();
$EventManage = new EventManager($PDO);

if (isset($_POST['submit'])) {
    if (isset($_POST['title']) && !empty($_POST['title']) && isset($_POST['describe']) && !empty($_POST['describe']) && isset($_POST['dateBegin']) && !empty($_POST['dateBegin']) && isset($_POST['dateEnd']) && !empty($_POST['dateEnd']) ) {

        $_POST['title'] = htmlspecialchars($_POST['title']);
        $_POST['describe'] = htmlspecialchars($_POST['describe']);
        $_POST['dateBegin'] = htmlspecialchars($_POST['dateBegin']);
        $_POST['dateEnd'] = htmlspecialchars($_POST['dateEnd']);
        //Ajout d'un champs post pour l'id utilisateur à stocker en BDD récup depuis SESSION
        $_POST['userId'] = $_SESSION['user']->getId();
        //Hydratation Event
        $Event->hydrate($_POST);
        //Requete d'insertion
        $EventManage->create($Event);
        // Purger objet Event
        unset($Event);
    }
}
echo 'POST';
var_dump($_POST);
echo 'OBJET EVENT';
var_dump($Event);

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../style/global.css">
    <link rel="stylesheet" href="../style/reservation-form.css">

    <title>Document</title>
</head>
<body>
<?php include 'header.php' ?>
<main class="main">
    <section class="pesentation container-col ">
        <h1 class="title-main">Choisissez un creneau pour votre reservation</h1>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Amet explicabo perferendis qui similique. Adipisci
            blanditiis commodi est fugiat labore quae qui voluptatem? Ad laudantium molestiae quam quidem quod
            repudiandae
            tempora.</p>
    </section>
    <section class="container-col decoration-bloc bloc-resa">
        <h2 class="title-main font-light">Formulaire de reservation</h2>
        <form action="" method="post" class="form-connexion container-col form-resa">
            <label for="title" class="label font-light">Votre évenement</label>
            <input type="text" name="title" id="title" placeholder="Entrez votre évenement">
            <label for="describe" class="label font-light">Description</label>
            <textarea name="describe" id="describe" placeholder="Déscription de votre évenement" cols="20"
                      rows="8"></textarea>

            <label for="date-debut" class="label font-light">Date et heure de début</label>
            <input type="datetime-local" name="dateBegin" id="date-debut" >

            <label for="date-fin" class="label font-light">Date et heure de fin</label>
            <input type="datetime-local" name="dateEnd" id="date-fin" >
            <button class="button" type="submit" name="submit">Envoyer</button>
        </form>
    </section>
</main>
<?php include 'footer.php' ?>
</body>