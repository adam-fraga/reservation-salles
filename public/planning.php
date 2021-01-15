<?php
include '../config/function.php';
spl_autoload_register('includeClass');
includeClass('User');
includeClass('UserManager');
includeClass('Event');
includeClass('EventManager');
session_start();
//Nouvelle instance de Manager
$Manager = new EventManager(new PDO('mysql:dbname=reservationsalles;host=localhost', 'root', ''));
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
                <?php
                $day = new DateTime('This week Monday 8:00');
                $Endweek = $day;
                $strDay = $day->format('l');
                $numbDay = $day->format('d');
                $Upday = (clone $day)->modify('+1 Day');
                $hourDisplay = 8;
                ?>
                <!--Affiche le mois en cours (Lui passer en param le mois du datetime recup) -->
                <h1 class="title-cal title-main"><?= $day->format('F').'/'.$day->format('Y') ?></h1>

            </div>
            <!--            TABLEAU PLANING PHP-->
            <table class="calendar">

                <tr>
                    <!--Affiche case Planing pour pouvoir placer heure en colonne-->
                    <th class="th-day">Planning</th>
                    <!--Affiche le lundi independement pour pouvoir incrementer reste de la semaine sans l'ecraser -->
                    <th class="th-day"><?php echo $strDay; ?><br><?php echo $numbDay; ?></th>
                    <!--Boucle les jours restant et les formate pour afficher jour + num jour -->
                    <?php for ($th = 0; $th < 6; $th++): ?>
                        <?php
                        echo "<th class='th-day'>{$Upday->format('l')}<br>{$Upday->format('d')}</th>";
                        $Upday->modify('+1 day');
                        ?>
                    <?php endfor; ?>
                </tr>
                <?php
//                Pour 10 creneaux
                for ($tr = 0; $tr <= 10; $tr++):
//                    Affiche l'heure et incremente l'air 10 fois
                    echo '<tr><td>'.$hourDisplay.'h</td>';
                $hourDisplay++;
                    for ($td = 0; $td <= 6; $td++):
                       $event = $Manager->pullEvents($day);
                       echo $day->format('Y-m-d H:00:00').'<br>';
//                       Si event existe Affiche Event sinon Affiche Creneau disponible
                        if ($event)  {echo '<td class="Pris"><a href="reservation.php">'.$event['titre'].'</a></td>';}
                        else {echo '<td class="Libre"><a class="btn-reserv" href="reservation-form.php">'.'Reserver'.'</a></td>';}
                        $day->modify('+1 Day');

                    endfor;
//                    Incremente d'une heure par ligne
                    $day->modify('+1 Hour');
//                    Retire 7 jour pour retourné au jour j
                    $day->modify('-7 Day');
                endfor;

                ?>

            </table>
        </div>
    </section>
</main>
<?php include 'footer.php' ?>
</body>
</html>