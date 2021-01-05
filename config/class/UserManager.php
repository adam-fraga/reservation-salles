<?php

/**
 * Class userManager permet de gerer les interactions utilisateur avec la base de données
 */
class UserManager
{
    private $_db;

    /**
     * userManager constructor.
     * @param PDO $db Prends en parametre une instance de PDO
     */
    public function __construct(PDO $db)
    {
        $this->setDb($db);
    }
    public function connect(User $User):bool{
        $stmt = $this->_db->query('SELECT * FROM utilisateurs WHERE'. $User->getLogin());
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        var_dump($data);
        if ($User->getLogin() == $data['login'] && password_verify($User->getPassword(),$data['password']))
        {
            $User->setId(intval($data['id']));
            return true;
        }
        else
        {
            return false;
        }
    }
    /**
     * @param User $User Prend en parametre un objet User et l'inscrit en BDD
     */
    public function insert(User $User)
    {
        $stmt = $this->_db->prepare("INSERT INTO utilisateurs (login,password) VALUES(?,?)");
        //Bind les params de l'utilisateur en les recuperant via les getter
        $stmt->bindValue(1, $User->getLogin());
        $stmt->bindValue(2, $User->getPassword());
        $stmt->execute();
    }

    /**
     * @param User $User Prends en parametre un Objet User et change ses infos en BDD
     */
    public function update(User $User)
    {

        $stmt = $this->_db->prepare("UPDATE utilisateurs SET login=?,password=? WHERE id=?");
        $stmt->bindValue(1,$User->getLogin());
        $stmt->bindValue(2,password_hash($User->getPassword(),CRYPT_BLOWFISH));
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

    /**
     * @param User $User Prends en parametre l'objet User et le deconnecte
     */
    public function disconnect(User $User)
    {
        session_destroy();
        unset($User);
        header('location: /public/connexion.php');
    }

    //SETTER
    /**
     * @param mixed $db Prends en parametre une instance de PDO
     */
    public function setDb(PDO $db): void
    {
        try {
            $db;
            $this->_db = $db;
        }
        catch (PDOException $e)
        {
            echo 'Error'.$e->getMessage();
        }
    }
}