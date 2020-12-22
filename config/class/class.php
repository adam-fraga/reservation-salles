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

//    SETER LOGIN
    public function setLogin($newlogin)
    {
        $this->_login = $newlogin;
    }

    //    SETER ID
    public function setId($id)
    {
        $this->_id = $id;
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
        }
    }

    public function connect($login, $password)
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
//            Redirige sur planning.php
//            header('location:planning.php');
        }
    }

    public function profil($newLogin, $newPassword)
    {
//        secure param
        $userLogin = htmlspecialchars($newLogin);
        $userPassword = htmlspecialchars($newPassword);
//        Crypte pass
        $userPassword = password_hash($userPassword, CRYPT_BLOWFISH);
//        requete sql
        $sql = "UPDATE utilisateurs SET login=?,password=? WHERE id='$this->_id'";
        $PDO = $this->dbConnect();
        $stmt = $PDO->prepare($sql);
        var_dump($stmt);
//        Lie les param au valeur attendu dans la requete
        $stmt->bindParam(1, $userLogin);
        $stmt->bindParam(2, $userPassword);
//        Execute la requete
        $stmt->execute();
    }

//    Method de deconnexion
    public function disconnect()
    {
        unset($this->_id);
        unset($this->_login);
        session_destroy();
        header('location:connexion.php');
    }

}

//Classe évenement
class Event
{
    private $_id;
    private $_title;
    private $_describe;
    private $_dateDebut;
    private $_dateFin;

    //method permettant de recuperer le lien de connexion DB PDO
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

//    Method creation Event
    public function create(string $title, string $describe, $dateDebut, $dateFin, int $UserId)
    {
//        Stock variable de connexion dans $PDO
        $PDO = $this->dbConnect();
//      Clean user entry
        htmlspecialchars($title);
        htmlspecialchars($describe);
        htmlspecialchars($dateDebut);
        htmlspecialchars($dateFin);
//      Sql request
        $sql = "INSERT INTO reservations (titre, description, debut, fin, id_utilisateur) VALUES (?,?,?,?,?)";
//      Prepare request with PDO
        $stmt = $PDO->prepare($sql);
//        Lie les parametre en attente
        $stmt->bindParam(1, $title);
        $stmt->bindParam(2, $describe);
        $stmt->bindParam(3, $dateDebut);
        $stmt->bindParam(4, $dateFin);
//        Convertie id str passé en param en int
        $UserId = intval($UserId);
        $stmt->bindParam(5, $UserId);
//        Execute la reqête
        $stmt->execute();
    }
}

class Month
{
//    Attribut privé permet de retourner les mois en toutes lettres
    private $_months = ['Janvier', 'Fevrier', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Aout', 'Septembre', 'Octobre', 'Novembre', 'Decembre'];
    public $_day = ['Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi', 'Dimanche'];
    public $_month;
    public $_year;

//        Prend en parametre le mois compris entre 1 et 12 et l'année
    public function __construct(?int $month = null, ?int $year = null)
    {
//        Si le mois est nul formate le mois en vu de recup un int et de s'axer sur le mois actuel
        if ($month === null) {
            $month = intval(date('m'));
        }
        //        Si l'année est nul formate l'année en vu de recup un int et de s'axer sur l'année actuelle
        if ($year === null) {
            $year = intval(date('Y'));
        }
//        Controle que le parametre passé soit compris entre 1 et 12
        if ($month < 1 || $month > 12) {
            throw new Exception("Le mois $month n'est pas valide");
        }
//        Controle l'année
        if ($year < 1970) {
            throw  new Exception("L'année est inférieur a 1970");
        }
        $this->_month = $month;
        $this->_year = $year;
    }

//    Retourne le mois en lettre
    public function toString(): string
    {
        return $this->_months[$this->_month - 1] . ' ' . $this->_year;
    }

    /*   Renvoi le 1er jour du mois (crée un nouvel objet DateTime avec les attribut présent dans la classe
        et 01 qui represente le 1er jour du mois */
    public function getFirstDay(): DateTime
    {
        return new DateTime("{$this->_year}-{$this->_month}-01");
    }

    public function getWeeks(): int
    {
//      Date de début de mois
        $start = $this->getFirstDay();
        /*Date de fin de mois// clone la variable start et grace à la method modify:
        on ajoute un mois au mois en cours puis on retire un jour ce qui permet de récuperer le dernier jour
        du mois en cours */
        $end = (clone $start)->modify('+1 month -1 day');
        /* Recuperer le numero de semaine du début et de la fin */
        $weeks = intval($end->format('W')) - intval($start->format('W')) + 1;
        if ($weeks < 0) {
            $weeks = intval($end->format('W'));
        }
        return $weeks;
    }

//    Verifier si date est dans le mois en cours renvoi un booleen
    public function withinMonth(DateTime $date): bool
    {
        return $this->getFirstDay()->format('Y-m') === $date->format('Y-m');
    }
//RENVOI LE MOIS SUIVANT
    public function nextMonth(): Month
    {
        $month = $this->_month + 1;
        $year = $this->_year;
        if ($month > 12) {
            $month = 1;
            $year += 1;
        }
        return new Month($month, $year);
    }
//RENVOIE LE MOIS PRECEDENT
    public function previousMonth(): Month
    {
        $month = $this->_month - 1;
        $year = $this->_year;
        if ($month < 1) {
            $month = 12;
            $year -= 1;
        }

        return new Month($month, $year);
    }


}


