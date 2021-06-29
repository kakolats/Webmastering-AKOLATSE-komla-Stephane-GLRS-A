<?php
namespace Gestion\controllers;

use Gestion\lib\Request;
use Gestion\lib\Session;
use Gestion\lib\Response;
use Gestion\models\UserModel;
use Gestion\models\EtudiantModel;
use Gestion\lib\AbstractController;

class EtudiantController extends AbstractController{
    
    public function addEtudiant(Request $request){
        if ($request->isPost()){
            $model= new EtudiantModel();
            $model1= new UserModel();
            $data=$request->getBody();
            $this->validator->estVide($data["nom"], "nom");
            $this->validator->estVide($data["prenom"], "prenom");
            if(!$this->validator->estVide($data["login"], "login")){
                if($this->validator->estMail($data["login"], "login")){
                    if($model1->loginExiste($data["login"])){
                        $this->validator->setErrors("login","ce login existe deja dans le systeme");
                    }
                }
            }
            if($this->validator->formValide()){
                $model->insert($data);
                Response::redirectUrl("security/accueil");
            }else{
                
                Session::SetSession("array_error",$this->validator->getErrors());
                Session::SetSession("array_post",$data);
                Response::redirectUrl("etudiant/addEtudiant");  
            }
        }
        $this->render("etudiant/inscrire.etudiant");
    }
}
?>