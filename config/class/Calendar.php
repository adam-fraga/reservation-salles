<?php

use JetBrains\PhpStorm\Pure;

class Calendar
{

    private array $_months = ['Janvier', 'Fevrier', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Aout', 'Septembre', 'Octobre', 'Novembre', 'Decembre',];
    private array $_day = ['Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi', 'Dimanche'];
    private array $_hours = [8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19];
    private int $_hour;
    private string $_month;
    private int $_year;

    /**
     * @param int|null $month Optionnel entier representant le mois compris entre 1 et 12
     * @param int|null $year Optionnel entier representant l'année
     * @throws Exception
     */
    public function __construct(?int $month = null, ?int $year = null)
    {
        if ($month === null) {
            $month = intval(date('m'));
        }
        if ($year === null) {
            $year = intval(date('Y'));
        }
        $this->setMonth($month);
        $this->setYear($year);
    }

    /**
     * @return DateTime Retourne le 1er jour du mois
     */
    public function firstDayOfMonth(): DateTime
    {
        return new DateTime("{$this->_year}-{$this->_month}-01");
    }

    /**
     * @return int Renvoi le nombre de semaine du mois en cours
     */
    public function getWeek(): int
    {
        //Chaine de caractere representant début du mois
        $startMonth = $this->firstDayOfMonth();
        //Clone permet de cloner ma variable sans l'alterer
        $endMonth = (clone $startMonth)->modify('+ 1month -1 day');
        $weekNumb = intval($endMonth->format('W')) - intval($startMonth->format('W')) + 1;
        if ($weekNumb < 0) {
            return $weekNumb = 5;
        }
        return $weekNumb;
    }

    /**
     * @return string retourne le mois en string
     */
    public function MonthString(): string
    {
        return $this->_months[$this->_month - 1] . ' ' . $this->_year;
    }
//Recupere tout les events (En vu de les afficher sous forme de tableau)

//Affiche les event sous forme de semaine/heure dans un  tableau html


// Trie les event par semaine en vue de les affiché

//SETTER
    /**
     * @param string $month
     * @throws Exception
     */
    public function setMonth(string $month): void
    {
        if ($month < 0 || $month > 12) {
            throw new Exception("Le mois $month doit être un entier compris entre 1 et 12");
        } else {
            $this->_month = $month;
        }
    }

    /**
     * @param int $year
     * @throws Exception
     */
    public function setYear(int $year): void
    {
        if (!is_int($year) || $year < 1970) {
            throw new Exception("L'année $year est infèrieur à 1970");
        } else {
            $this->_year = $year;
        }
    }

    /**
     * @param int $hour
     */
    public function setHour(int $hour): void
    {
        $this->_hour = $hour;
    }

//GETTER

    /**
     * @return string
     */
    public function getMonth(): string
    {
        return $this->_month;
    }

    /**
     * @return int
     */
    public function getYear(): int
    {
        return $this->_year;
    }

    /**
     * @return array
     */
    public function getMonths(): array
    {
        return $this->_months;
    }

    /**
     * @return array
     */
    public function getDay(): array
    {
        return $this->_day;
    }

    /**
     * @return int
     */
    public function getHour(): int
    {

        return $this->_hour;
    }

    /**
     * @return array
     */
    public function getHours(): array
    {
        return $this->_hours;
    }

}