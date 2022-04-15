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
        
        if ($sliders['name'] == '') {

            $slider = new \Projet\Models\Slider();
            $slide = $slider->getSlidepath($sliders['id']);
            $slidePath = $slide['slide'];
            $exist = false;
        }else{
            $slidePath = 'app/Public/front/images/slider/' . $sliders['name'];
            $exist = \Projet\Models\Slider::exist('slide', $slidePath);
        }

        
       
        if($exist === false && $this->extVerify($slidePath) === true)
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
            $error = $this->extVerify($slidePath);
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
    
    // +++++++++++++++++++++++++++++++++++++++++++++ //
    //          Function pour la page admin concert
    // +++++++++++++++++++++++++++++++++++++++++++++ //

    public function concertsPage($error){

        $concerts  = new \Projet\Models\Calendar();
        $nextConcerts = $concerts->concerts();

        $data = [
            'concerts' => $nextConcerts,
            'error' => $error
        ];

        return $this->viewAdmin('concerts',$data);
    }

    public function addConcert($postData){

        $data = [
            'title' => htmlspecialchars($postData['title']),
            'date' => htmlspecialchars($postData['date']),
            'location' => htmlspecialchars($postData['location']),
            'price' => htmlspecialchars($postData['price']),

        ];

        if(!empty($data['title']) && !empty($data['date']) && !empty($data['location'])){
            $addConcert = \Projet\Models\Calendar::addConcert($data);
            unset($_POST);
            $this->concertsPage($error = null); 

        }else{
            $error = "Les champs marqués d'une étoile sont obligatoire.";
            $this->concertsPage($error);
        }
    }
    public function updateConcert($postData, $id){
        $data = [
            'title' => htmlspecialchars($postData['title']),
            'date' => htmlspecialchars($postData['date']),
            'location' => htmlspecialchars($postData['location']),
            'price' => htmlspecialchars($postData['price']),
            'id' => htmlspecialchars($id),
            
        ];
    }   
    public function deleteConcert($id){
        $deleteConcert = \Projet\Models\Calendar::delete('id', $id);
        $this->concertsPage($error = null); 
    }



   
    // +++++++++++++++++++++++++++++++++++++++++++++ //
    //          Function pour la page admin band
    // +++++++++++++++++++++++++++++++++++++++++++++ //
    
    public function bandPage($error){

        $concerts = \Projet\Models\Bandmembers::all();
        $data = [
            'band' => $concerts,
            'error' => $error,
        ];

        return $this->viewAdmin('band',$data);
    }

    public function bandPictures($exist, $data, $memberPath, $action){

        if($exist === false && $this->extVerify($memberPath) === true){
            
            move_uploaded_file($data['tmpName'], $memberPath);
            if($action == "update"){   
                $memberUpdate = new \Projet\Models\Bandmembers();
                $updateMember = $memberUpdate->updateMember($data, $memberPath);
            }elseif ($action == "add"){
                $newMember = new \Projet\Models\Bandmembers();
                $addMember = $newMember->addMember($data, $memberPath);
            }
            unset($_POST);
            $this->bandPage($error = null);

        }elseif($exist === true){
            unset($_POST);
            $error = "Cette image est déjà publiée, pour conserver la même, merci de ne rien sélectionner";
            $this->bandPage($error);
        }
        else
        {
            unset($_POST);
            $error = $this->extVerify($memberPath);
            $this->bandPage($error);
        }
    }

    public function updateMember($memberId,$files,$post){

        
        $data = [
            "id" => htmlspecialchars($memberId),
            "firstname"  => htmlspecialchars($post['firstname']),
            "lastname"  => htmlspecialchars($post['lastname']),
            "type"  => htmlspecialchars($post['type']),
            "excerpt"  => htmlspecialchars($post['excerpt']),
            "info"  => htmlspecialchars($post['info']),
            'tmpName' => $files['file']['tmp_name'],
            'fileName' => htmlspecialchars($files['file']['name']),
            'fileSize' => $files['file']['size'],
        ];
        
        if ($data['fileName'] == '') {
            $members = new \Projet\Models\Bandmembers();
            $member = $members->getPicturePath($data['id']);
            $memberPath = $member['picture'];
            $exist = false;

        }else{
            $memberPath = 'app/Public/front/images/band/' .  $data['fileName'];
            $exist = \Projet\Models\Bandmembers::exist('picture', $memberPath);
            
        }
        $this->bandPictures($exist, $data, $memberPath, "update");
    }

    public function addMember($files,$post)
    {
        
        if (isset($files['file']) && $files['file']['name'] != "") {
            $data = [
                "firstname"  => htmlspecialchars($post['firstname']),
                "lastname"  => htmlspecialchars($post['lastname']),
                "type"  => htmlspecialchars($post['type']),
                "excerpt"  => htmlspecialchars($post['excerpt']),
                "info"  => htmlspecialchars($post['info']),
                'tmpName' => $files['file']['tmp_name'],
                'fileName' => htmlspecialchars($files['file']['name']),
                'fileSize' => $files['file']['size'],
            ];
        
            if(!empty($data['firstname']) && !empty($data['lastname']) && !empty($data['type']) && !empty($data['excerpt']) && !empty($data['info']) && !empty($data['fileName'])){
                $memberPath = 'app/Public/front/images/band/' .  $data['fileName'];
                $exist = \Projet\Models\Bandmembers::exist('picture', $memberPath);

                $this->bandPictures($exist, $data, $memberPath, "add");
            }else{
                $error = "Tous les champs doivent être remplis";
                $this->bandPage($error);
            }
        }else{
            $error = "La photo du nouveau membre est obligatoire";
            $this->bandPage($error);
        }
    }

    public function deleteMember($memberId){
        $id = htmlspecialchars($memberId);
        $deleteMember = \Projet\Models\Bandmembers::delete('id', $id);
        $this->bandPage($error = null); 
    }

    
 // +++++++++++++++++++++++++++++++++++++++++++++ //
    //          Function pour la page admin news
    // +++++++++++++++++++++++++++++++++++++++++++++ //

    public function newsPage(){

        $news = \Projet\Models\Articles::all();
        $data = [
            'news' => $news
        ];

        return $this->viewAdmin('news',$data);
    }

    public function picturesExist($picturePath){
        for ($i=1; $i < 4; $i++) { 
            $exist = \Projet\Models\Articles::exist('picture'. $i, $picturePath);
            if ($exist == true){
                return true;
            }
        }
        return false;
    }

    public function newsPictures($files, $id){

        $pictures = [];
            // Trois image max sont vérifiées
            for ($i=1; $i < 4 ; $i++) { 
                if (isset($files['picture'. $i]) && $files['picture'. $i]['name'] != "" ) {    
                    $picturePath = 'app/Public/front/images/news/' .  htmlspecialchars($files['picture'. $i]['name']);
                    $exist = $this->picturesExist($picturePath);
                    $extVerify = $this->extVerify($picturePath);
                    $tmpName = $files['picture'. $i]['tmp_name'];
                    
                }elseif (!isset($files['picture'. $i])){
                        $pic = new \Projet\Models\Articles();
                        $path = $pic->getNewsPicture('picture'. $i, $id);
                        $picturePath = $path['picture' . $i];
                        $exist = false;
                        $extVerify = true;
                        $tmpName = "";
                }else{
                    $picturePath = "";
                    $exist = false;
                    $extVerify = true;
                    $tmpName = "";
                }
                    array_push($pictures, [
                        'exist' => $exist,
                        'extVerify' => $extVerify,
                        'path' => $picturePath,
                        'tmpName' => $tmpName,
                    ]);        
            }
            
        return $pictures;
    }

    public function moveNewsFile($pictures){
        move_uploaded_file($pictures[0]['tmpName'], $pictures[0]['path']);
        move_uploaded_file($pictures[1]['tmpName'], $pictures[1]['path']);
        move_uploaded_file($pictures[2]['tmpName'], $pictures[2]['path']);

        $picturesPath = [
            'picture1' => $pictures[0]['path'],
            'picture2' => $pictures[1]['path'],
            'picture3' => $pictures[2]['path'],
        ];

        return $picturesPath;
    }
    public function addNewsPage($error){

        $data = [
            'error' => $error,
        ];

        $this->viewAdmin('addNews',$data);
    }

    public function createNews($files, $post){
        $pictures = $this->newsPictures($files, $id = null);
        $data = [
            'title' => $post['title'],
            'content' => $post['content'],
        ];
        
        if(!empty($data['title']) && !empty($data['content'])){      

            if(!$pictures[0]['exist'] && !$pictures[1]['exist'] && !$pictures[2]['exist'] && $pictures[0]['extVerify'] && $pictures[1]['extVerify'] && $pictures[2]['extVerify']){
                
                $picturesPath = $this->moveNewsFile($pictures);

                $addNews = new \Projet\Models\Articles();
                $createNews = $addNews->createNews($data, $picturesPath);
                $this->newsPage($error = null);

            }elseif($pictures[0]['exist'] || $pictures[1]['exist'] || $pictures[2]['exist']){ 
                $error = "Une de vos images est déjà publiée, merci d'en sélectionner une autre'";
                $this->addNewsPage($error);
            }
            else{
                $error = "Le format de l'image n'est pas bon";
                $this->addNewsPage($error);
            }   
        }
        else{
            $error = "Tous les champs doivent être remplis";
            $this->addNewsPage($error);
        }
    }

    public function deleteNews($newsId){
        $id = htmlspecialchars($newsId);

        $getPictures = \Projet\Models\Articles::find('id', $newsId);
        for ($i=1; $i < 4 ; $i++) { 
            unlink($getPictures['picture' . $i]);
        }
        
        $deleteNews = \Projet\Models\Articles::delete('id', $id);
        $this->newsPage($error = null); 
    }

    public function viewNews($newsId, $error = null){
        $id = htmlspecialchars($newsId);
        $news = \Projet\Models\Articles::find('id', $id);
        $data = [
            'news' => $news,
            'error' =>$error,
        ];
        return $this->viewAdmin('singleNews',$data);
    }
    public function updateNews($newsId,$files,$post){
        
        $pictures = $this->newsPictures($files, $newsId);
        $data = [
            'id' => htmlspecialchars($newsId),
            'title' => htmlspecialchars($post['title']),
            'content' => htmlspecialchars($post['content']),
        ];
        
        if(!empty($data['title']) && !empty($data['content'])){      

            if(!$pictures[0]['exist'] && !$pictures[1]['exist'] && !$pictures[2]['exist'] && $pictures[0]['extVerify'] && $pictures[1]['extVerify'] && $pictures[2]['extVerify']){
                
                $picturesPath = $this->moveNewsFile($pictures);
                
                $updateNews = new \Projet\Models\Articles();
                $newsUpdate = $updateNews->updateNews($data, $picturesPath);
                $this->viewNews($newsId);

            }elseif($pictures[0]['exist'] || $pictures[1]['exist'] || $pictures[2]['exist']){ 
                $error = "Une de vos images est déjà publiée, merci d'en sélectionner une autre'";
                $this->viewNews($newsId, $error);
            }

            else{
                $error = "Le format de l'image n'est pas bon";
                $this->viewNews($newsId, $error);
            }   
        }
        else{
            $error = "Tous les champs doivent être remplis";
            $this->viewNews($newsId, $error);
        }
    }

    public function deletePicture($picture, $newsId){
        $pictureNumber = "picture" . htmlspecialchars($picture);
        $id = htmlspecialchars($newsId);
        
        $getPictures = \Projet\Models\Articles::find('id', $newsId);
        unlink($getPictures[$pictureNumber]);

        $deletePic = new \Projet\Models\Articles();
        $deletePicture = $deletePic->deletePicture($pictureNumber, $id);

        return $this->viewNews($newsId);

    }

}