<?php

use JetBrains\PhpStorm\Pure;

/**
 * Class EventManager Gère les interaction BDD de la classe Event
 */
class EventManager
{
    private PDO $_db;

    /**
     * EventManager constructor.
     * @param PDO $PDO Constructeur prends en param un objet de la classe PDO
     */
    public function __construct(PDO $PDO)
    {
        $this->setDb($PDO);
    }

    /**
     * @param Event $Event
     * @return bool Verifie la disponibilité de l'Event en DB
     */
    public function isEventAvailable(Event $Event): bool
    {
        $hourBegin = $Event->getHourBegin();
        $hourEnd = $Event->getHourEnd();
        $dateBegin = $Event->getDateBegin();
        $dateEnd = $Event->getDateEnd();

        $strBegin = $dateBegin->format("Y-m-d {$hourBegin}:00");
        $strEnd = $dateBegin->format("Y-m-d {$hourEnd}:00");

        $resultBegin = $this->_db->query("SELECT * FROM reservations WHERE debut='$strBegin'");
        $dateDebutDB = $resultBegin->fetchAll(PDO::FETCH_ASSOC);
        //Check si l'heure de debut existe pour un event
        if ($dateDebutDB == true) {
            return false;
        } else {
            return true;
        }
    }

    /**
     * @param DateTime $datebegin Prend en parametre la date de début de l'event
     * @return bool test si l'event tombe sur un week end
     */
    public function onWeek(DateTime $datebegin): bool
    {
        $dateformat = $datebegin->format('l');
        var_dump($dateformat);
        if ($dateformat == 'Saturday' || $dateformat == 'Sunday') {
            return false;
        } else {
            return true;
        }
    }

    /**
     * @param Event $Event
     * @return bool Check si l'event dur bien une heure renvoi un bool
     */
    #[Pure] public function oneHour(Event $Event): bool
    {
        $hourBegin = $Event->getHourBegin();
        $hourEnd = $Event->getHourEnd();

        if ($hourEnd == $hourBegin + 1) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * @param Event $Event
     * @return bool Check si la reservatkion se fait sur le même jour renvoi un bool
     */
    public function sameDay(Event $Event): bool
    {
        $day1 = $Event->getDateBegin();
        $day2 = $Event->getDateEnd();
        $interval = $day1->diff($day2);
        if ($interval->days == 0) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * @param Event $Event Prend en param un objet event et l'inscrit en BDD
     */
    public function create(Event $Event): void
    {
        $hourBegin = $Event->getHourBegin();
        $hourEnd = $Event->getHourEnd();
        $stmt = $this->_db->prepare('INSERT INTO reservations (titre, description, debut, fin, id_utilisateur) VALUES (?,?,?,?,?)');
        $stmt->bindValue(1, $Event->getTitle());
        $stmt->bindValue(2, $Event->getDescribe());
//      Formatage date
        $stmt->bindValue(3, $Event->getDateBegin()->format("Y-m-d {$hourBegin}:00"));
        $stmt->bindValue(4, $Event->getDateEnd()->format("Y-m-d {$hourEnd}:00"));
        $stmt->bindValue(5, $Event->getUserId());

        $stmt->execute();
    }

    /**
     * @param string Titre de l'évenement à consulter
     * @return array Retourne un tableau d'un evenement
     */

    /** Recupere les event de toute une semaine en BDD et retourne un tableau D'event ( A mettre en forme html)
     */
    public function pullEvents(): array
    {

    }

    /**
     * Requete permettant de récuperer la semaine suivante en DB et l'afficher sous forme de tableau
     */
    public function nextWeek(): void
    {

    }

    /**
     *Requete permettant de récuperer la semaine précedente en DB et l'afficher sous forme de tableau
     */
    public function previousWeek(): void
    {

    }

//    SETTER

    /**
     * @param PDO $db
     */
    public function setDb(PDO $db): void
    {
        try {
            $this->_db = $db;
        } catch (PDOException $e) {
            echo 'Erreur de connection PDO:' . $e->getMessage();
        }
    }


//GETTER

    /**
     * @return PDO
     */
    public function getDb(): PDO
    {
        return $this->_db;
    }

}

//$PDO = new PDO('mysql:dbname=reservationsalles;host=localhost', 'root', '');
//$EventManager = new EventManager($PDO);
//$date1 = new DateTime('2021-01-07 11:00:00');
//$date2 = new DateTime('2021-01-07 12:00:00');
//$Event = new  Event();
//try {
//    $EventManager->isEventAvailable($Event);
//} catch (Exception $e) {
//    echo $e;
//}
