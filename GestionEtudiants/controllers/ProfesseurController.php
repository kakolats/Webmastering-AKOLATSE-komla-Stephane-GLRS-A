<?php
namespace Gestion\controllers;
use Gestion\lib\Request;
use Gestion\lib\Session;
use Gestion\lib\Response;
use Gestion\lib\AbstractModel;
use Gestion\lib\AbstractController;
use Gestion\models\ProfesseurModel;

class ProfesseurController extends AbstractController{

    private AbstractModel $model;
    public function __construct(){
        parent::__construct();
        $this->model= new ProfesseurModel();
    }

    public function showProfesseurs(){
        $data= $this->model->selectAll();
        $this->render("professeur/liste.professeur", ["professeurs" => $data]);
    }

    public function addProfesseur(Request $request){

        if ($request->isPost()){
            $model= new ProfesseurModel();
            $data=$request->getBody();
            //dd($data);
            $this->validator->estVide($data["nom"], "nom");
            $this->validator->estVide($data["prenom"], "prenom");
            if(!$this->validator->estVide($data["login"], "login")){
                if($this->validator->estMail($data["login"], "login")){
                    if($model->loginExiste($data["login"])){
                        $this->validator->setErrors("login","ce login existe deja dans le systeme");
                    }
                }
            }
            if($this->validator->formValide()){
                $model->insert($data);
                Response::redirectUrl("security/login");
            }else{
                
                Session::SetSession("array_error",$this->validator->getErrors());
                dd($_SESSION["array_error"]);
                Session::SetSession("array_post",$data);
                Response::redirectUrl("professeur/addProfesseur");  
            }
        }
        $this->render("professeur/add.professeur");

        
        
    }
}