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
     * @return bool Check si la reservation se fait sur le même jour renvoi un bool
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

    /** Retourne un tableau qui hydrate l'objet event
     * @param DateTime $date Date de début de l'event
     * @return array
     * @throws Exception
     */
    public function pullEvents(DateTime $date): array
    {
        $strDate = $date->format('Y-m-d H:00:00');
        $stmt = $this->_db->query("SELECT * FROM reservations INNER JOIN utilisateurs ON utilisateurs.id = reservations.id_utilisateur WHERE debut='$strDate'");
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($result == true) {
            return $result;
        } else return [];
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