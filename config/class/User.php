<?php

class User
{
    private $_id,
            $_login,
            $_password,
            $_connected;

    //Fonction d'hydratation de la classe utilisateur
    public function hydrate(array $data)
    {
        //Parcourt mon tableau passé en param
        foreach ($data as $key => $value) {
            /*Création d'une methode adaptative: comme chaque setter commence
            par 'set' puis premiere lettre de ma propriété en majuscule J'utilise
            ucfirst (Fonction passe la premiere lettre en MAJ pour controler si le
            setter existe.*/
            $method = 'set' . ucfirst($key);
            /* method existe permet de check si la method existe dans l'objet
             passé en premier parametre*/
            if (method_exists($this, $method)) {
                /* Si la method existe passe la valeur correspondante à mon
                 setter qui se charge de modifier mon attribut de classe */
                $this->$method($value);
            }
        }

    }
    // SETTER

    /**
     * @param mixed $id
     */
    public function setId(int $id): void
    {
        $id = (int)$id;
        if ($id > 0) {
            $this->_id = $id;
        }
    }

    /**
     * @param mixed $login
     */
    public function setLogin(string $login): void
    {
        if (is_string($login && strlen($login < 25))) {
            $this->_login = $login;
        }
    }

    /**
     * @param mixed $password
     */
    public function setPassword(string $password): void
    {
        if (is_string($password)) {
            $this->_password = password_hash($password, CRYPT_BLOWFISH);
        }
    }

    /**
     * @param mixed $connected
     */
    public function setConnected(bool $connected): void
    {
        $this->_connected = $connected;
    }
    //    GETTER
    public function getId(): int
    {
        return $this->_id;
    }

    public function getLogin(): string
    {
        return $this->_login;
    }

    /**
     * @return mixed
     */
    public function getPassword():string
    {
        return $this->_password;
    }

    /**
     * @return mixed
     */
    public function getConnected():bool
    {
        return $this->_connected;
    }
}