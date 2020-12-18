<?php


//CLASSE UTILISATEUR
class User
{
//    ATTRIBUTS DE AC CLASSE UTILISATEUR

    private $_login;
    private $_id;

//    GETER
//Recupere Login
    public function getLogin()
    {
        return $this->_login;
    }

//Recupere ID
    public function getId()
    {
        return $this->_id;
    }
//    METHODE CLASS UTILISATEUR
//Fonction permettant de recuperer le lien de connexion DB PDO
    public function dbConnect()
    {
        $dsn = 'mysql:dbname=reservationsalles;localhost:localhost';
        $userDB = 'root';
        $passwordDB = '';
//        TEST connexion DB return lien de connexion si ok
        try {
            return $PDO = new PDO($dsn, $userDB, $passwordDB);
//            Renvoi erreur si fail
        } catch (PDOException $e) {
            return 'Erreur de connexion' . $e->getMessage();
        }
    }

    public function inscription($login, $password, $confirmPassword)
    {
//        Si login set + longueur login < 25 char + set pass et pass == confirme pass
        if (isset($login) && strlen($login) < 25 && isset($password) && $password == $confirmPassword) {
//            secure saisit dans variable
            $userlogin = htmlspecialchars($login);
            $userPass = htmlspecialchars($password);
//          CRYPTE PASS
            $userPass = password_hash($userPass, CRYPT_BLOWFISH);
//            Stockage variable de connexion
            $PDO = $this->dbConnect();
//            Requete sl
            $sql = "INSERT INTO utilisateurs (login,password) VALUES(?,?)";
//            Prepa requete SQL
            $stmt = $PDO->prepare($sql);
//            Secure requete d'écriture
            $stmt->bindParam(1, $userlogin);
            $stmt->bindParam(2, $userPass);
//            Execution requete
            $stmt->execute();
//            Redirige sur page de connexion
            header("location:connexion.php");
//            Retourne message
            return "Votre demande d'inscription à bien été envoyée!";
        } else {
            return "Les données saisit sont incorrect!";
        }
    }

    public function connect($login, $password): array
    {
//        Connexion DB
        $PDO = $this->dbConnect();
//        Secure parametres
        $userLogin = htmlspecialchars($login);
        $userPassword = htmlspecialchars($password);
//        requête sql
        $sql = "SELECT * FROM utilisateurs WHERE login='$userLogin'";
//        execution query direct pas d'ecriture
        $stmt = $PDO->query($sql);
//        Recup data from db tableau assoc
        $userData = $stmt->fetch(PDO::FETCH_ASSOC);
//        Recup pass
        $hashPassword = $userData['password'];
//        Verif pass + login correspond a info db
        if ($userLogin == $userData['login'] && password_verify($userPassword, $hashPassword) == true) {
//            Stock id utilisateur et login dans mes attributs de classes
            $this->_login = $userData['login'];
            $this->_id = $userData['id'];
//            Redirige sur planing.php
            header('location:planing.php');
        }
    }

    public function profil($newLogin, $newPassword)
    {
//        secure param
        $userLogin = htmlspecialchars($newLogin);
        $userPassword = htmlspecialchars($newPassword);
//        requete sql
        $sql = "UPDATE utilisateurs SET login=?,password=? WHERE id='$this->_id'";
        $PDO = $this->dbConnect();
        $stmt = $PDO->prepare($sql);
//        Lie les param au valeur attendu dans la requete
        $stmt->bindParam(1, $userLogin);
        $stmt->bindParam(2, $userPassword);
//        Execute la requete
        $stmt->execute();
    }

    public function disconnect()
    {
        unset($this->_id);
        unset($this->_login);
        session_destroy();
        header('location:connexion.php');
    }

}