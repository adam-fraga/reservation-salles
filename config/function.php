<?php
//Fonction de chargement de classe
function includeClass($myclass)
{
    require '../config/class/' . $myclass . '.php';
}