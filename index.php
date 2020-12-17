<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style/index.css">
    <link rel="stylesheet" href="style/global.css">
    <script src="https://kit.fontawesome.com/a95f1c7873.js" crossorigin="anonymous"></script>
    <title>Room</title>
</head>
<body>
<!--HEADER SITE-->
<header class="header">
    <!--    NAVIGATION BAR-->
    <nav class="nav">
        <!--        MENU -->
        <ul class="menu container-row">
            <li class="item-menu link-user"><a href="#">User</a>
                <!--            SOUS MENU UTILISATEUR-->
                <ul class="sous-menu sm-user">
                    <li class="item-sous-menu"><a href="site/inscription.php">Inscription</a></li>
                    <li class="item-sous-menu"><a href="site/connexion.php">Connexion</a></li>
                    <li class="item-sous-menu"><a href="site/profil.php">Mon Profil</a></li>
                </ul>
            </li>
            <li class="item-menu link-reservation"><a href="#">Reservation</a>
                <!--            SOUS MENU RESERVATION-->
                <ul class="sous-menu sm-reservation">
                    <li class="item-sous-menu"><a href="site/planing.php">Planing</a></li>
                    <li class="item-sous-menu"><a href="site/reservation-form.php">Reserver</a></li>
                    <li class="item-sous-menu"><a href="site/reservation.php">Mes reservations</a></li>


                </ul>
            </li>
            <form action="" method="post" class="container-tools">
                <button class="button-logout"><i class="fas fa-sign-out-alt"></i></button>
            </form>
        </ul>

    </nav>
</header>
<!--Main content-->
<!--TITRE SITE-->
<h1 class="main-title-index title-main">SYB ROOM</h1>
<main class="main">
    <!--    BANNIERE-->
    <div class="container-large banniere"></div>
    <!--    Section presentation du site-->
    <section class="presentation container-col">
        <h2 class="title-main">Swap your brain</h2>
        <p> SYB met à votre disposition plusieurs salles dans le cadre de vos différentes activités professionnels.
            en effet vous retrouverez sur notre site un outil de reservation simple et intuitif en vu de réserver une
            salle
            moderne et éclairé idéal pour le coworking, une salle de conférence pour vos meeting ou autres évements du
            genre et
            pour finir une salle à l'ambiance sombre et insonorisé. Enfin vous l'aurez compris nos salles sont dediées à
            un usage
            professionnel pour toute premiere reservation rendez vous dans la
            rubrique
            inscription pour creer un compte puis pour vous connecter!
        </p>

    </section>
    <!--    Presentation de la formation-->
    <section class="presentation-formation container-col">
        <h2 class="title-main">Nos salles</h2>
        <div class="container-card">
            <!--            CARD-->
            <article class="card decoration-bloc">
                <h3 class="title-main font-light">Salle de Coworking</h3>
                <div class="pics-bloc">
                <img class="pics" src="style/img/coworking%20room.jfif" alt="salle de conférence">
        </div>
                <p class="font-light">
                    Salle dediée au travail de groupe vous pouvez la privatisé mais son concept vise à travailler en groupe
                    échanger avec vos collaborateurs.
                </p>
            </article>
            <article class="card decoration-bloc">
                <h3 class="title-main font-light">Salle de conference</h3>
                <div class="pics-bloc">
                    <img class="pics" src="style/img/conf-room.jfif" alt="salle de conférence">
                </div>
                <p class="font-light">
                    La salle de conférence est mise à votre disposition dans le cadre de meet up ou comme son nom l'indique de conference
                    sa capacité d'accueil est de 160 personnes.
                </p>
            </article>
            <article class="card decoration-bloc">
                <h3 class="title-main font-light">Dark Room</h3>
                <div class="pics-bloc">
                    <img class="pics" src="style/img/photo-1584670380670-28f0d4cabb06.jfif" alt="Dark room">
                </div>
                <p class="font-light">
                    Une ambiance tamisé pour un travail en petit groupe ou en solo la Dark room vous permettra de rester concentrer
                et de vous plonger dans le calme le plus total.</p>
            </article>
        </div>
    </section>
</main>
<!--FOOTER-->
<footer class="footer container-col">
    <nav class="foot-nav">
        <ul class="footer-menu container-row">
            <li><a class="font-light" href="#">Nous suivre sur les réseaux</a></li>
            <li><a  class="font-light" href="#">Liens externes</a></li>
            <li><a  class="font-light" href="#">Nous contacter</a></li>
        </ul>
    </nav>
</footer>
</body>
</html>