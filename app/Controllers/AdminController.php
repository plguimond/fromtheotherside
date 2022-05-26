<?php
namespace Projet\Controllers;

// controller pour le backoffice
class AdminController extends Controller
{

    // function pour vérifier les extensions des photos
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

     // function pour gérer l'affichage du dashboard
    public function dashboard()
    {
        // On récupère les counts pour afficher les stats sur le dashboard
        $members =  \Projet\Models\Bandmembers::count();
        $messages = \Projet\Models\Contacts::count();
        $articles = \Projet\Models\Articles::count();
        $nextConcerts = \Projet\Models\Calendar::count();
 
        $data = [
            'members' => $members['number_of'],
            'messages' => $messages['number_of'],
            'articles' => $articles['number_of'],
            'concerts' => $nextConcerts['number_of'],
        ];
        return $this->viewAdmin('dashboard', $data); 
    }

    // +++++++++++++++++++++++++++++++++++++++++++++ //
    //      Function pour la page admin slider
    // +++++++++++++++++++++++++++++++++++++++++++++ //

    public function sliderPage($error){

        // récupère les slider en bdd
        $getSlider = new \Projet\Models\slider();
        $getSlides = $getSlider->getSlides();
        $slides = $getSlides->fetchAll();
        $data = [
            'slides' => $slides,
            'error' => $error
        ];
        //retourne les données sur la page slider du backoffice
        return $this->viewAdmin('slider',$data);
    }

    //function lors de la modification d'un slider
    public function updateSlider($sliders)
    {
        
        //si il n'y a pas de fichier, on récupère la photo existante en bdd
        if ($sliders['name'] == '') {
            $slider = new \Projet\Models\Slider();
            $slide = $slider->getSlidepath($sliders['id']);
            $slidePath = $slide['slide'];
            $exist = false;

        //sinon on vérifie que cette photo n'existe pas déjà
        }else{
            $slidePath = 'app/Public/front/images/slider/' . $sliders['name'];
            $exist = \Projet\Models\Slider::exist('slide', $slidePath);
        }

        //si la photo n'existe pas et que l'extension est validée on modifie la slide selon l'id
        if($exist === false && $this->extVerify($slidePath) === true)
        {
            $getSlider = \Projet\Models\slider::find('id', $sliders['id']);
            unlink($getSlider['slide']);
            move_uploaded_file($sliders['tmpName'], $slidePath);
            $sliderUpdate = new \Projet\Models\slider();
            $updateSlider = $sliderUpdate->updateSlider($sliders, $slidePath);

        //sinon on retourne un emessage d'erreur   
        }elseif($exist === true){
            $error = "Cette image est déjà dans le carroussel";
            $this->sliderPage($error);
        }

        //message d'erreur d'extension non valide
        else
        {
            $error = $this->extVerify($slidePath);
            $this->sliderPage($error);
        }

    }

    //Function pour ajouter une nouvelle side
    public function addSlide($sliders)
    {
        //création du chemin de l'image à mettre en bdd
        $slidePath = 'app/Public/front/images/slider/' . $sliders['name'];

        //vérification si elle existe déjà
        $exist = \Projet\Models\Slider::exist('slide', $slidePath);
       
        //si la slide n'existe pas et que l'extension est vérifiée
        if ($exist === false && $this->extVerify($sliders['name']) === true) {

            //on ajoute dans le dossier l'image
            move_uploaded_file($sliders['tmpName'], $slidePath);

            //on ajoute en bdd la nouvelle slide
            $addSlide = new \Projet\Models\slider();
            $newSlider = $addSlide->addSlide($slidePath, $sliders['title']);

        //Sinon on retourne les erreurs correpondantes    
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

    //suppression d'une slide
    public function deleteSlide($id)
    {
        //récupère l'url de la photo par son id en bdd
        $getSlider = \Projet\Models\slider::find('id', $id);
        
        //supprime la photo des fichiers
        unlink($getSlider['slide']);
        
        //supprime la slide de la bdd
        $slideDelete = new \Projet\Models\slider();
        $deleteSlide = $slideDelete->deleteSlide($id);
    }

    // +++++++++++++++++++++++++++++++++++++++++++++ //
    //          Function pour la page admin email
    // +++++++++++++++++++++++++++++++++++++++++++++ //
    
    // affichage de la page des messages
    public function emailPage(){
        $emails = \Projet\Models\Contacts::all();
        $data = [
            'emails' => $emails
        ];
        return $this->viewAdmin('messages',$data);
    }

    //suppression d'un message par son id
    public function deleteMail($id){
        $deleteMail = \Projet\Models\Contacts::delete('id', $id);
    }

    // affichage du message en entier sur une autre page
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
        $nextConcerts = $concerts->allConcerts();

        $data = [
            'concerts' => $nextConcerts,
            'error' => $error
        ];

        return $this->viewAdmin('concerts',$data);
    }

    //ajoute un nouveau concert 
    public function addConcert($postData){
        
        // si le prix n'est pas renseigné on retourne 0
        if ($postData['price'] == ""){
            $price = 0;
        }else{
            $price =  htmlspecialchars($postData['price']);
        }
        $data = [
            'title' => htmlspecialchars($postData['title']),
            'date' => htmlspecialchars($postData['date']),
            'location' => htmlspecialchars($postData['location']),
            'price' => $price,

        ];

        //véification des champs obligatoires
        if(!empty($data['title']) && !empty($data['date']) && !empty($data['location'])){
            $addConcert = \Projet\Models\Calendar::addConcert($data);
            unset($_POST);
            $this->concertsPage($error = null); 

        // message d'erreur champs obligatoire
        }else{
            $error = "Les champs marqués d'une étoile sont obligatoire.";
            $this->concertsPage($error);
        }
    }

    //mise à jour d'un concer
    public function updateConcert($postData, $id){

        if ($postData['price'] == ""){
            $price = 0;
        }else{
            $price =  htmlspecialchars($postData['price']);
        }
        $data = [
            'title' => htmlspecialchars($postData['title']),
            'date' => htmlspecialchars($postData['date']),
            'location' => htmlspecialchars($postData['location']),
            'price' => $price,
            'id' => htmlspecialchars($id), 
        ];

        //vérification des champs obligatoire et modification en bdd
        if(!empty($data['title']) && !empty($data['date']) && !empty($data['location'])){
            $concertUpdate = new \Projet\Models\Calendar();
            $updateConcert = $concertUpdate->updateConcert($data);
            unset($_POST);
            $this->concertsPage($error = null);

        }else{
            $error = "Les champs marqués d'une étoile sont obligatoire.";
            $this->concertsPage($error);
        }
    }   

    //suppression d'un concert
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

    //function pour l'ajout ou la mise à jour du membre du groupe
    public function bandPictures($exist, $data, $memberPath, $action){

        //Si la photo n'existe pas et que l'extension est vérifiée
        if($exist === false && $this->extVerify($memberPath) === true){
            
            //enregistre la photo dans les fichiers
            move_uploaded_file($data['tmpName'], $memberPath);

            //vérifie si c'est une mise à jour ou un nouveau membres et enregistre en bdd
            if($action == "update"){   
                $memberUpdate = new \Projet\Models\Bandmembers();
                $updateMember = $memberUpdate->updateMember($data, $memberPath);
            }elseif ($action == "add"){
                $newMember = new \Projet\Models\Bandmembers();
                $addMember = $newMember->addMember($data, $memberPath);
            }
            unset($_POST);
            $this->bandPage($error = null);

        // si la nouvelle photo sélectionnée est déja en bdd, retourne erreur
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

    // mise à jour d'un membre du groupe
    public function updateMember($memberId,$files,$post){

        // tableau avec les informations du formulaire
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
        
        //vérification si il y a une photo dans le formulaire
        if ($data['fileName'] == '') {

            //récupère la photo actuelle
            $members = new \Projet\Models\Bandmembers();
            $member = $members->getPicturePath($data['id']);
            $memberPath = $member['picture'];
            $exist = false;

        // Ajoute en bdd une nouvelle photo
        }else{
            //créer l'url de la photo et vérifie si elle existe en bdd
            $memberPath = 'app/Public/front/images/band/' .  $data['fileName'];
            $exist = \Projet\Models\Bandmembers::exist('picture', $memberPath);
            
        }
        //Mise à jour du membre du groupe
        $this->bandPictures($exist, $data, $memberPath, "update");
    }

    //Ajout d'un nouveau membre du groupe
    public function addMember($files,$post)
    {
        //vérification du fichier dans le formulaire et créaton tableau de données
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
        
            //vérification des données obligatoires
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

    //suppression d'un membre du groupe
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

    //Fonction qui vérifie que l'image de l'aritcle existe déjà
    public function picturesExist($picturePath){
        
        $exist = \Projet\Models\Articles::exist('picture1', $picturePath);
        if ($exist == true){
            return true;
        }else{
            return false;
        }
        
    }

    //Gestion de l'image de l'article
    public function newsPictures($file, $id){
        
        $pictures = [];

        // si il y a une image dans le formulaire on vérifie l'image et son extension avant de la créer
            if (isset($file['picture1']) && $file['picture1']['name'] != "" ) {    
                $picturePath = 'app/Public/front/images/news/' .  htmlspecialchars($file['picture1']['name']);
                $exist = $this->picturesExist($picturePath);
                $extVerify = $this->extVerify($picturePath);
                $tmpName = $file['picture1']['tmp_name'];
                
            //Si il n'y a pas de input files (update), on récupère l'image actuelle en bdd
            }elseif (!isset($files['picture1'])){
                
                    $pic = new \Projet\Models\Articles();
                    $path = $pic->getNewsPicture('picture1', $id);
                    $picturePath = $path['picture1'];
                    $exist = false;
                    $extVerify = true;
                    $tmpName = "";
            
            //si la photo est vide on retourne un chemin vide et on valide les vérificateurs
            }else{
                $picturePath = "";
                $exist = false;
                $extVerify = true;
                $tmpName = "";
            }
            //on  retourne un tableau avec les informations de la photos 
                $pictures = [
                    'exist' => $exist,
                    'extVerify' => $extVerify,
                    'path' => $picturePath,
                    'tmpName' => $tmpName,
                ];        
        
        return $pictures;
    }

    //affichage de la page d'ajout d'un article
    public function addNewsPage($error){

        $data = [
            'error' => $error,
        ];
        $this->viewAdmin('addNews',$data);
    }

    //function pour créer un nouvel article en bdd
    public function createNews($file, $post){
        //envois le file dans la fonction nexsPictures pour vérifier la photo
        $pictures = $this->newsPictures($file, $id = null);
        $data = [
            'title' => $post['title'],
            'content' => $post['content'],
        ];
        
        //vérification des champs obligatoires
        if(!empty($data['title']) && !empty($data['content'])){      
            
            //si la photos est vérifiée on enregistre dans les fichiers et en bdd
            if(!$pictures['exist'] && $pictures['extVerify']){

                move_uploaded_file($pictures['tmpName'], $pictures['path']) ;
                $picturesPath = $pictures['path'];

                $addNews = new \Projet\Models\Articles();
                $createNews = $addNews->createNews($data, $picturesPath);
                $this->newsPage($error = null);

            // message d'erreur selon le cas
            }elseif($pictures['exist'] || $pictures['exist'] || $pictures['exist']){ 
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

    //Suppression de l'image physiquement et en bdd
    public function deleteNews($newsId){
        $id = htmlspecialchars($newsId);

        $getPictures = \Projet\Models\Articles::find('id', $newsId);

        //suppression physique si elle est en bdd
            if ($getPictures['picture1'] != ""){
            unlink($getPictures['picture1']);
            }
        
            // supprime de la bdd
        $deleteNews = \Projet\Models\Articles::delete('id', $id);
        $this->newsPage($error = null); 
    }

    // affichage de la page d'un article sélectionné
    public function viewNews($newsId, $error = null){
        $id = htmlspecialchars($newsId);
        $news = \Projet\Models\Articles::find('id', $id);
        $data = [
            'news' => $news,
            'error' =>$error,
        ];
        return $this->viewAdmin('singleNews',$data);
    }
    
    // mise  jour d'un article
    public function updateNews($newsId,$files,$post){
        
        //le titre et le contenu sont modifiable
        $pictures = $this->newsPictures($files, $newsId);
        $data = [
            'id' => htmlspecialchars($newsId),
            'title' => htmlspecialchars($post['title']),
            'content' => htmlspecialchars($post['content']),
        ];
        
        //vérification des champs obligatoire 
        if(!empty($data['title']) && !empty($data['content'])){      

            if(!$pictures['exist'] && $pictures['extVerify']){
                
                move_uploaded_file($pictures['tmpName'], $pictures['path']) ;
                $picturesPath = $pictures['path'];
                
                $updateNews = new \Projet\Models\Articles();
                $newsUpdate = $updateNews->updateNews($data, $picturesPath);
                $this->viewNews($newsId);

        // retourne les messages d'erreurs selon le cas
            }elseif($pictures['exist']){ 
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

    //suppression de la photo d'un artile en bdd et physiquement (bouton supprimer sur la page d'un article backoffice)
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