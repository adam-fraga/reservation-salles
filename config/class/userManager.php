<?php

/**
 * Class userManager permet de gerer les interactions utilisateur avec la base de données
 */
class userManager
{
    private $_db;

    /**
     * userManager constructor.
     * @param PDO $db Prends en parametre une instance de PDO
     */
    public function __construct(PDO $db)
    {
        $this->setDb = ($db);
    }

    /**
     * @param User $User Prend en parametre un objet User et l'inscrit en BDD
     */
    public function insert(User $User)
    {
        $stmt = $this->_db->prepare("INSERT INTO utilisateurs (id,login,password) VALUES(?,?,?)");

        //Bind les params de l'utilisateur en les recuperant via les getter
        $stmt->bindValue(1, $User->getId());
        $stmt->bindValue(2, $User->getLogin());
        $stmt->bindValue(3, $User->getPassword());
        $stmt->execute();
    }

    /**
     * @param User $User Prends en parametre un Objet User et change ses infos en BDD
     */
    public function update(User $User)
    {
        $stmt = $this->_db->prepare("UPDATE utilisateurs SET login=?,password=? WHERE id=?");
        $stmt->bindValue(1,$User->getLogin());
        $stmt->bindValue(2,$User->getPassword());
        $stmt->bindValue(3,$User->getId());

        $stmt->execute();
    }

    /**
     * @param User $User Prend en parametre l'objet utilisateur et supprime l'utilisateur de la BDD
     */
    public function delete(User $User)
    {
        $stmt = $this->_db->exec('DELETE FROM utilisateurs WHERE id ='.$User->getId());
    }

//    Connecte utilisateur
    public function connect(User $User)
    {


    }
    //Deconnecte l'utilisateur
    public function disconnect()
    {


    }
    //SETTER
    /**
     * @param mixed $db
     */
    public function setDb($db): void
    {
        $this->_db = $db;
    }
}