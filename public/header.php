<!--HEADER SITE-->
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://kit.fontawesome.com/a95f1c7873.js" crossorigin="anonymous"></script>
    <title>Document</title>
</head>
<body>
<header class="header">
    <!--    NAVIGATION BAR-->
    <nav class="nav">
        <!--        MENU -->
        <ul class="menu container-row">
            <li class="item-menu link-user"><a href="../index.php">Accueil</a>
            <li class="item-menu link-user"><a href="#">User</a>
                <!--            SOUS MENU UTILISATEUR-->
                <ul class="sous-menu sm-user">
                    <?php if (empty($_SESSION)):  ?>
                   <li class="item-sous-menu"><a href="inscription.php">Inscription</a></li>
                    <li class="item-sous-menu"><a href="connexion.php">Connexion</a></li>
                    <?php endif;?>
                    <?php if (isset($_SESSION['user'])):  ?>
                    <li class="item-sous-menu"><a href="profil.php">Mon Profil</a></li>
                    <?php endif;?>
                </ul>
            </li>
            <li class="item-menu link-reservation"><a href="#">Reservation</a>
                <!--            SOUS MENU RESERVATION-->
                <ul class="sous-menu sm-reservation">
                    <li class="item-sous-menu"><a href="planning.php">Planning</a></li>
                    <?php if (isset($_SESSION['user'])):  ?>
                    <li class="item-sous-menu"><a href="reservation-form.php">Reserver</a>
                    <li class="item-sous-menu"><a href="reservation.php">Mes reservations</a></li>
                    <?php endif; ?>
                </ul>
            </li>
            <?php if (isset($_SESSION['user'])):  ?>
            <form action="" method="post" class="container-tools">
                <button name="logout" class="button-logout"><i class="fas fa-sign-out-alt"></i></button>
            </form>
            <?php endif; ?>
        </ul>
    </nav>
</header>
</body>
</html>