<?php

class Event
{
    private int $_eventId;
    private string $_title;
    private string $_describe;
    private DateTime $_dateBegin;
    private DateTime $_dateEnd;
    private int $_userId;

    public function hydrate(array $array): void
    {
//        Parcourt le tableau passé en param
        foreach ($array as $key => $value) {
//        $method contient ma methode adaptative (Clés dt tableau 1ere lettre en majuscule
            $method = 'set' . ucfirst($key);
//        Si le setter existe alors la methode existe
            if (method_exists($this, $method)) {
//        Set l'attribut de l'objet Event avec la valeur passé
                $this->$method($value);
            }
        }
    }

//    GETTER

    /**
     * @return int
     */
    public function getEventId(): int
    {
        return $this->_eventId;
    }

    /**
     * @return int
     */
    public function getUserId(): int
    {
        return $this->_userId;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->_title;
    }

    /**
     * @return string
     */
    public function getDescribe(): string
    {
        return $this->_describe;
    }

    /**
     * @return DateTime
     */
    public function getDateBegin(): DateTime
    {
        return $this->_dateBegin;
    }

    /**
     * @return DateTime
     */
    public function getDateEnd(): DateTime
    {
        return $this->_dateEnd;
    }
//SETTER

    /**
     * @param int $userId
     */
    public function setUserId(int $userId): void
    {
        if (is_int($userId) && $userId > 0)
            $this->_userId = $userId;
    }

    /**
     * @param int $eventId
     */
    public function setEventId(int $eventId): void
    {
        if (is_int($eventId) && $eventId > 0) {
            $this->_eventId = $eventId;
        }
    }

    /**
     * @param string $title
     */
    public function setTitle(string $title): void
    {
        if (is_string($title))
            $this->_title = $title;
    }

    /**
     * @param string $describe
     */
    public function setDescribe(string $describe): void
    {
        if (is_string($describe))
            $this->_describe = $describe;
    }

    /**
     * @param string $dateBegin
     * @throws Exception
     */
    public function setDateBegin(string $dateBegin): void
    {
        if (is_string($dateBegin)) {
            try {
                $dateBegin = new DateTime($dateBegin);
                $this->_dateBegin = $dateBegin;
            } catch (Exception $e) {
                echo 'Fail to hydrate Date begin' . $e->getMessage();
            }
        }
    }

    /** Prends en parametre une date STR et la convertie en Objet Datetime
     * @param string $dateEnd
     * @throws Exception
     */
    public function setDateEnd(string $dateEnd): void
    {
        if (is_string($dateEnd)) {
            try {
                $dateEnd = new DateTime($dateEnd);
                $this->_dateEnd = $dateEnd;
            } catch (Exception $e) {
                echo 'Fail to hydrate Date end' . $e->getMessage();
            }
        }
    }
}