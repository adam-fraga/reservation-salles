<?php
include '../config/function.php';
spl_autoload_register('includeClass');
includeClass('User');
includeClass('UserManager');
includeClass('Event');
includeClass('EventManager');
includeClass('Calendar');
session_start();
//Nouvelle instance de Calendar
try {
//Prend en parametre le mois et l'année passé en GET sinon prends la valeur null
    $Calendar = new Calendar($_GET['month'] ?? null, $_GET['year'] ?? null);
} catch (Exception $e) {
    $Calendar = new Calendar();
    //Recupere le premier lundi du mois
}
$firstDay = $Calendar->firstDayOfMonth()->modify('last monday');
?>


<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../style/global.css">
    <link rel="stylesheet" href="../style/planning.css">

    <title>Document</title>
</head>
<body>
<?php include 'header.php' ?>
<main class="main">
    <section class="pesentation container-col">
        <h1 class="title-main">Ici vous pouvez verifier crenaux disponibles!</h1>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Amet explicabo perferendis qui similique. Adipisci
            blanditiis commodi est fugiat labore quae qui voluptatem? Ad laudantium molestiae quam quidem quod
            repudiandae
            tempora.</p>
    </section>
    <section class="container-col">
        <h2 class="title-main">Planning des reservations</h2>
        <div class="container-tab">
            <div class="box-cal">
                <!--Affiche le mois en cours -->
                <h1 class="title-cal title-main"><?php echo $Calendar->MonthString(); ?></h1>
                <div class="box-controller">
                    <a href=""
                       class="btn-ctrl"><i class="fas fa-arrow-alt-circle-left"></i></a>
                    <a href=""
                       class="btn-ctrl"><i class="fas fa-arrow-alt-circle-right"></i></a>
                </div>
            </div>
            <!--            TABLEAU PLANING PHP-->
            <table class="calendar">
                <!--Affichage des jours-->
                <tr class="tr-day">
                    <th class="th-entête">Planning</th>
                    <?php foreach ($Calendar->getDay() as $day): ?>
                        <th class="th-day"><?php echo $day; ?></th>
                    <?php endforeach; ?>
                </tr>
                <!--Affichage des heure-->
                <?php foreach ($Calendar->getHours() as $hour): ?>
                    <tr>
                        <td class="td-hour"><?php echo $hour . 'h' ?></td>
                        <td class="td-creneaux">
                            <!--Affichage des creneaux (liés aux heure a voir pour futur method tableau ou objet creneaux-->
                            Creneaux Lun <?php echo $hour; ?>
                        </td>
                        <td class="td-creneaux">
                            Creneaux Mar <?php echo $hour; ?>
                        </td>
                        <td class="td-creneaux">
                            Creneaux Mer<?php echo $hour; ?>
                        </td>
                        <td class="td-creneaux">
                            Creneaux Jeu<?php echo $hour; ?>
                        </td>
                        <td>
                            Creneaux Ven<?php echo $hour; ?>
                        </td>
                        <td>NONE</td>
                        <td>NONE</td>
                    </tr>
                <?php endforeach; ?>
            </table>
            <?php
            var_dump($firstDay);

            echo 'Objet Calendar';
            var_dump($Calendar);
            ?>

        </div>
    </section>
</main>
<?php include 'footer.php' ?>
</body>
</html>