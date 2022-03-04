<?php

namespace Projet\Controllers;

class AdminController{
   
    function dashboard()
    {
        $getSlider = new \Projet\Models\AdminModel();
        $getSlides = $getSlider->getSlides();
        $slides = $getSlides->fetchAll();
        require 'app/Views/administration/dashboard.php';
    }

    function updateSlider1($tmpName, $name, $size, $error)
    {
        $slidePath = 'app/Public/front/images/'.$name;
        move_uploaded_file($tmpName, $slidePath);
        $sliderUpdate = new \Projet\Models\AdminModel();
        $updateSlider = $sliderUpdate->updateSlider($slidePath);
    }
}