<?php
//Database connexion

$dsn = "mysql:dbname=reservationsalles;host=localhost";
$userDB='root';
$passDB='';
//Creation de l'objet PDO
try {
    $PDO = new PDO($dsn,$userDB,$passDB);
}
catch (PDOException $e)
{
    echo 'Erreur:'.$e->getMessage();
}
