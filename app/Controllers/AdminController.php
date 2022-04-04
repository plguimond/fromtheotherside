<?php

namespace Projet\Controllers;

class AdminController extends Controller
{
    public function dashboard()
    {
        return $this->viewAdmin('dashboard'); 
    }
    public function extVerify($name){

        $allowed = array('png', 'jpg', 'jpeg');
        $filename = $name;
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        
        if (!in_array(strtolower($ext), $allowed)) {
            return $error = "Ce type de fichier n'est pas accepté";
        }else{
            return true;
        }
    }
    public function sliderPage($error){
        $getSlider = new \Projet\Models\slider();
        $getSlides = $getSlider->getSlides();
        $slides = $getSlides->fetchAll();
        $data = [
            'slides' => $slides,
            'error' => $error
        ];
        return $this->viewAdmin('slider',$data);
    }
    public function updateSlider($sliders)
    {
        
        if($this->extVerify($sliders['name']) === true)
        {
            $slidePath = 'app/Public/front/images/' . $sliders['name'];
            move_uploaded_file($sliders['tmpName'], $slidePath);
            $sliderUpdate = new \Projet\Models\slider();
            $updateSlider = $sliderUpdate->updateSlider($sliders, $slidePath);
        }
        else
        {
            $error = $this->extVerify($sliders['name']);
            $this->sliderPage($error);
        }

    }
    public function addSlide($sliders)
    {
        if($this->extVerify($sliders['name']) === true)
        {
        $slidePath = 'app/Public/front/images/' . $sliders['name'];
        move_uploaded_file($sliders['tmpName'], $slidePath);
        $addSlide = new \Projet\Models\slider();
        $newSlider = $addSlide->addSlide($slidePath, $sliders['title']);
    }
    else
    {
        $error = $this->extVerify($sliders['name']);
        $this->sliderPage($error);
    }
    }
    public function deleteSlide($id)
    {
        
        $getSlider = \Projet\Models\slider::find('id', $id);
        
        unlink($getSlider['slide']);
        
        $slideDelete = new \Projet\Models\slider();
        $deleteSlide = $slideDelete->deleteSlide($id);
    }
}