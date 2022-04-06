<?php

namespace Projet\Controllers;

class AdminController extends Controller
{
    public function extVerify($name)
    {
        $allowed = array('png', 'jpg', 'jpeg');
        $filename = $name;
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
    
        if (!in_array(strtolower($ext), $allowed)) {
            return $error = "Ce type de fichier n'est pas accepté";
        }else{
            return true;
        }
    }

     
    public function dashboard()
    {
        return $this->viewAdmin('dashboard'); 
    }

    // +++++++++++++++++++++++++++++++++++++++++++++ //
    //      Function pour la page admin slider
    // +++++++++++++++++++++++++++++++++++++++++++++ //
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
        $slidePath = 'app/Public/front/images/slider/' . $sliders['name'];
        $exist = \Projet\Models\Slider::exist('slide', $slidePath);
       
        if($exist === false && $this->extVerify($sliders['name']) === true)
        {
            
            move_uploaded_file($sliders['tmpName'], $slidePath);
            $sliderUpdate = new \Projet\Models\slider();
            $updateSlider = $sliderUpdate->updateSlider($sliders, $slidePath);
        }elseif($exist === true){
            $error = "Cette image est déjà dans le carroussel";
            $this->sliderPage($error);
        }
        else
        {
            $error = $this->extVerify($sliders['name']);
            $this->sliderPage($error);
        }

    }
    public function addSlide($sliders)
    {
        $slidePath = 'app/Public/front/images/slider/' . $sliders['name'];
        $exist = \Projet\Models\Slider::exist('slide', $slidePath);
       
        if ($exist === false && $this->extVerify($sliders['name']) === true) {
        
            
            move_uploaded_file($sliders['tmpName'], $slidePath);
            $addSlide = new \Projet\Models\slider();
            $newSlider = $addSlide->addSlide($slidePath, $sliders['title']);
        }elseif ($exist === true)
        {
            $error = "Cette image est déjà dans le carroussel";
            $this->sliderPage($error);

        }else
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

    // +++++++++++++++++++++++++++++++++++++++++++++ //
    //          Function pour la page admin email
    // +++++++++++++++++++++++++++++++++++++++++++++ //

    public function emailPage(){
        $emails = \Projet\Models\Contacts::all();
        $data = [
            'emails' => $emails
        ];
        return $this->viewAdmin('messages',$data);
    }

    public function deleteMail($id){
        $deleteMail = \Projet\Models\Contacts::delete('id', $id);
    }

    public function viewMail($id){
        $email = \Projet\Models\Contacts::find('id', $id);
        $data = [
            'email' => $email
        ];
        return $this->viewAdmin('singleMail',$data);
    }

}