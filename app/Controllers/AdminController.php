<?php

namespace Projet\Controllers;

class AdminController
{
    public function dashboard()
    {
        $getSlider = new \Projet\Models\AdminModel();
        $getSlides = $getSlider->getSlides();
        $slides = $getSlides->fetchAll();
        require 'app/Views/administration/dashboard.php';
    }

    public function updateSlider($sliders)
    {
        $slidePath = 'app/Public/front/images/' . $sliders['name'];
        move_uploaded_file($sliders['tmpName'], $sliders['slidePath']);
        $sliderUpdate = new \Projet\Models\AdminModel();
        $updateSlider = $sliderUpdate->updateSlider($sliders);
    }
    public function addSlide($title, $tmpName, $name, $size, $error)
    {
        $slidePath = 'app/Public/front/images/' . $name;
        move_uploaded_file($tmpName, $slidePath);
        $addSlide = new \Projet\Models\AdminModel();
        $newSlider = $addSlide->addSlide($slidePath, $title);
    }
    public function deleteSlide($id)
    {
        $slideDelete = new \Projet\Models\AdminModel();
        $deleteSlide = $slideDelete->deleteSlide($id);
    }
}
