<?php

namespace Projet\Controllers;

class AdminController extends Controller
{
    public function dashboard()
    {
        return $this->viewAdmin('dashboard'); 
    }

    public function sliderPage(){
        $getSlider = new \Projet\Models\slider();
        $getSlides = $getSlider->getSlides();
        $slides = $getSlides->fetchAll();
        return $this->viewAdmin('slider',$slides);
    }
    public function updateSlider($sliders)
    {
        $slidePath = 'app/Public/front/images/' . $sliders['name'];
        move_uploaded_file($sliders['tmpName'], $slidePath);
        $sliderUpdate = new \Projet\Models\slider();
        $updateSlider = $sliderUpdate->updateSlider($sliders, $slidePath);

    }
    public function addSlide($title, $tmpName, $name, $size, $error)
    {
        $slidePath = 'app/Public/front/images/' . $name;
        move_uploaded_file($tmpName, $slidePath);
        $addSlide = new \Projet\Models\slider();
        $newSlider = $addSlide->addSlide($slidePath, $title);
    }
    public function deleteSlide($id)
    {
        
        $getSlider = \Projet\Models\slider::find('id', $id);
        
        unlink($getSlider['slide']);
        
        $slideDelete = new \Projet\Models\slider();
        $deleteSlide = $slideDelete->deleteSlide($id);
    }
}
