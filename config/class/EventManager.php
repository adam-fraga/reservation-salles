<?php

/**
 * Class EventManager Gère les interaction BDD de la classe Event
 */
class EventManager
{
    /**
     * @var PDO Attribut de type Objet PDO
     */
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
     * @param Event $Event Prend en param un objet event et l'inscrit en BDD
     */
    public function create(Event $Event): void
    {
        $stmt = $this->_db->prepare('INSERT INTO reservations (titre, description, debut, fin, id_utilisateur) VALUES (?,?,?,?,?)');
        $stmt->bindValue(1, $Event->getTitle());
        $stmt->bindValue(2, $Event->getDescribe());
//      Formatage date
        $stmt->bindValue(3, $Event->getDateBegin()->format('Y-m-d H:i:s'));
        $stmt->bindValue(4, $Event->getDateEnd()->format('Y-m-d H:i:s'));
        $stmt->bindValue(5, $Event->getUserId());

        $stmt->execute();
    }

    /**
     * @param string Titre de l'évenement à consulter
     * @return array Retourne un tableau d'un evenement
     */
    public function read(string $EventTitle): array
    {
        $result = $this->_db->query("SELECT * FROM reservations WHERE titre='$EventTitle'");
        return $result->fetch(PDO::FETCH_ASSOC);
    }

    public function update(Event $Event): void
    {

    }

    public function delete(Event $Event): void
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