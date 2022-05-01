<?php

namespace Projet\Controllers;

class Controller
{
    public function viewFront($viewName, $data = null)
    {
    
        include('app/Views/front/'.$viewName.'.php');

    }

    public function viewAdmin($viewName, $data = null, $error = null)
    {
       
        include('app/Views/administration/'.$viewName.'.php');

    }

    public static function formatDate($date, $format = "d F Y"){
        $englishMonths = array('January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December');
        $frenchMonths = array('janvier', 'février', 'mars', 'avril', 'mai', 'juin', 'juillet', 'août', 'septembre', 'octobre', 'novembre', 'décembre');

        return str_replace($englishMonths, $frenchMonths, date($format, strtotime($date)));
    }
}