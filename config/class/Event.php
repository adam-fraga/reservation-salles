<?php

class Event
{
    private int $_eventId;
    private string $_title;
    private string $_describe;
    private DateTime $_dateBegin;
    private DateTime $_dateEnd;
    private int $_hourBegin;
    private int $_hourEnd;
    private int $_userId;

    public function hydrate(array $array): void
    {
//        Parcourt le tableau passé en param
        foreach ($array as $key => $value) {
//        $method contient ma methode adaptative (Clés du tableau 1ere lettre en majuscule)
            $method = 'set' . ucfirst($key);
//        Si le setter existe alors la methode existe
            if (method_exists($this, $method)) {
//        Set l'attribut de l'objet Event avec la valeur passé
                $this->$method($value);
            }
        }
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
     * @throws Exception
     */
    public function setTitle(string $title): void
    {
        if (is_string($title))
            $this->_title = $title;
        else {
            throw new Exception('Fail to hydrate title');
        }
    }


    /**
     * @param string $describe
     * @throws Exception
     */
    public function setDescribe(string $describe): void
    {
        if (is_string($describe))
            $this->_describe = $describe;
        else {
            throw new Exception('Fail to hydrate Events Describe');
        }
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

    /**
     * @param mixed $hourBegin
     * @throws Exception
     */
    public function setHourBegin(string $hourBegin): void
    {
        intval($hourBegin);
        if ($hourBegin >= 8 && $hourBegin <= 18) {
            $this->_hourBegin = ($hourBegin);
        }
        else{
            throw new Exception("Fail to hydrate $hourBegin" );
        }
    }

    /**
     * @param mixed $hourEnd
     * @throws Exception
     */
    public
    function setHourEnd(string $hourEnd): void
    {

        if (intval($hourEnd) >= 9 && intval($hourEnd) <= 19) {
            $this->_hourEnd = ($hourEnd);
        }
        else{
            throw new Exception("Fail to hydrate $hourEnd" );
        }
    }

    /** Prends en parametre une date STR et la convertie en Objet Datetime
     * @param string $dateEnd
     * @throws Exception
     */
    public
    function setDateEnd(string $dateEnd): void
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

//    GETTER

    /**
     * @return int
     */
    public
    function getEventId(): int
    {
        return $this->_eventId;
    }

    /**
     * @return int
     */
    public
    function getUserId(): int
    {
        return $this->_userId;
    }

    /**
     * @return string
     */
    public
    function getTitle(): string
    {
        return $this->_title;
    }

    /**
     * @return string
     */
    public
    function getDescribe(): string
    {
        return $this->_describe;
    }

    /**
     * @return DateTime
     */
    public
    function getDateBegin(): DateTime
    {
        return $this->_dateBegin;
    }

    /**
     * @return DateTime
     */
    public
    function getDateEnd(): DateTime
    {
        return $this->_dateEnd;
    }

    /**
     * @return mixed
     */
    public
    function getHourBegin(): int
    {
        return $this->_hourBegin;
    }

    /**
     * @return mixed
     */
    public
    function getHourEnd(): int
    {
        return $this->_hourEnd;
    }
}