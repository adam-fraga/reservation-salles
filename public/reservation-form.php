<?php
//Inclusion de la fonction de chargement de classe auto
include '../config/function.php';
spl_autoload_register('includeClass');
//Inclusion classe
includeClass('User');
includeClass('Event');
includeClass('EventManager');
//Session ini
session_start();
//Instanciation des objets
$PDO = new PDO('mysql:dbname=reservationsalles;host=localhost', 'root', '');
$Event = new Event();
$Manager = new EventManager($PDO);

//Si action boutton
if (isset($_POST['submit'])) {
    if (isset($_POST['title']) && !empty($_POST['title']) && isset($_POST['describe']) && !empty($_POST['describe']) && isset($_POST['dateBegin']) && !empty($_POST['dateBegin']) && isset($_POST['dateEnd']) && !empty($_POST['dateEnd'])) {
        $_POST['title'] = htmlspecialchars($_POST['title']);
        $_POST['describe'] = htmlspecialchars($_POST['describe']);
        $_POST['dateBegin'] = htmlspecialchars($_POST['dateBegin']);
        $_POST['dateEnd'] = htmlspecialchars($_POST['dateEnd']);
        $_POST['hourBegin'] = htmlspecialchars($_POST['hourBegin']);
        $_POST['hourEnd'] = htmlspecialchars($_POST['hourEnd']);

        //Ajout d'un champs post pour l'id utilisateur à stocker en BDD récup depuis SESSION
        $_POST['userId'] = $_SESSION['user']->getId();
        //Hydratation de l'objet Event
        $Event->hydrate($_POST);

        try {
            //Test les exception Event hors Weekend, Reservation sur Même jour, durée de une heure du creneaux et Présence d'un event similaire en BDD
            $weekTest = $Manager->onWeek($Event->getDateBegin());
            $hourTest = $Manager->oneHour($Event);
            $dayTest = $Manager->sameDay($Event);
            $testAvailable = $Manager->isEventAvailable($Event);
        } catch (Exception $e) {
            echo $e;
        }
        if (isset($testAvailable) && $testAvailable == true && isset($hourTest) && $hourTest == true && isset($weekTest) && $weekTest == true && isset($dayTest) && $dayTest == true) {
            //Requete d'insertion
            $Manager->create($Event);
            // Purge objet Event
            unset($Event);
        }
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
    <link rel="stylesheet" href="../style/reservation-form.css">

    <title>Document</title>
</head>
<body>
<?php include 'header.php' ?>
<main class="main">
    <section class="pesentation container-col ">
        <h1 class="title-main">Choisissez un creneau pour votre reservation</h1>
        <p>C'est ici que vous pourrez choisir votre créneau de reservation attention toutefois Vous ne pouvez pas editer
            vos créneaux alors reflechissez bien pour toute modalité de remboursement
            veuillez vous réferer aux conditions général.</p>
    </section>
    <section class="container-col decoration-bloc bloc-resa">
        <h2 class="title-main font-light">Formulaire de reservation</h2>
        <form action="" method="post" class="form-connexion container-col form-resa">
            <label for="title" class="label font-light">Votre évenement</label>
            <input type="text" name="title" id="title" placeholder="Entrez votre évenement">
            <label for="describe" class="label font-light">Description</label>
            <textarea name="describe" id="describe" placeholder="Déscription de votre évenement" cols="20"
                      rows="8"></textarea>

            <label for="date-debut" class="label font-light">Date de début</label>
            <input type="date" name="dateBegin" id="date-debut" required>
            <label for="heure-debut" class="label font-light">Heure de début</label>
            <select name="hourBegin" id="heure-debut">
                <option value="8">8h00</option>
                <option value="9">9h00</option>
                <option value="10">10h00</option>
                <option value="11">11h00</option>
                <option value="12">12h00</option>
                <option value="13">13h00</option>
                <option value="14">14h00</option>
                <option value="15">15h00</option>
                <option value="16">16h00</option>
                <option value="17">17h00</option>
                <option value="18">18h00</option>
            </select>

            <label for="date-fin" class="label font-light">Date de fin</label>
            <input type="date" name="dateEnd" id="date-fin" required>

            <label for="heure-fin" class="label font-light">Heure de Fin</label>
            <select name="hourEnd" id="heure-fin">
                <option value="9">9h00</option>
                <option value="10">10h00</option>
                <option value="10">11h00</option>
                <option value="12">12h00</option>
                <option value="13">13h00</option>
                <option value="14">14h00</option>
                <option value="15">15h00</option>
                <option value="16">16h00</option>
                <option value="17">17h00</option>
                <option value="18">18h00</option>
                <option value="19">19h00</option>
            </select>
            <button class="button" type="submit" name="submit">Envoyer</button>
            <?php if (isset($testAvailable) && $testAvailable == false):
                echo '<p class="error">' . 'La date que vous avez choisie n\'est plus disponible' . '<p>';
            elseif (isset($weekTest) && $weekTest == false):
                echo '<p class="error">' . 'Nos services sont indisponible le weekend' . '<p>';
            elseif (isset($dayTest) && $dayTest == false || isset($hourTest) && $hourTest == false):
                echo '<p class="error">' . 'Vous ne pouvez pas reserver des creneaux de plus d\'une heure.' . '<p>';
            endif; ?>

        </form>


    </section>
</main>
<?php include 'footer.php' ?>
</body>