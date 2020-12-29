<?php

class Month
{
    private $_months = ['Janvier', 'Fevrier', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Aout', 'Septembre', 'Octobre', 'Novembre', 'Decembre',];
    private $_day = ['Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi', 'Dimanche'];
    private $_year;
    private $_month;

    /**
     * @return string[]
     */
    public function getDay(): array
    {
        return $this->_day;
    }

    /**
     * @throws Exception
     */
    public function __construct()
    {
//       Definit l'année et le mois en cours et la formate en int
        $month = intval(date('m'));
        $year = intval(date(format: 'Y'));

        if ($month < 1 || $month > 12) {
            throw new Exception("Le mois $month n'est pas valide");
        }
        if ($year < 1970) {
            throw new Exception("L'année est inferieur à 1970");
        }
        $this->_month = $month;
        $this->_year = $year;
    }

    /**
     * @return string retourne le mois en toute lettre
     */
    public function toString(): string
    {
        return $this->_months[$this->_month - 1] . ' ' . $this->_year;
    }


    /**
     * @return DateTime retourne le 1er jour du mois sous for
     */
    public function getFirstDay():DateTime
    {
      return  $monthStart = new DateTime("{$this->_year}-{$this->_month}-01");
    }

    /**
     * @return int retourne le nombre de semaine du mois
     */
    public function weekCount(): int
    {
       $monthStart = $this->getFirstDay();
        $monthEnd = (clone $monthStart)->modify('+1 month -1 day');
        $weeks = intval($monthEnd->format('W')) - intval($monthStart->format('W')) + 1;
        if ($weeks < 0) {
            $weeks = intval($monthEnd->format('W'));
        }
        return $weeks;
    }
}