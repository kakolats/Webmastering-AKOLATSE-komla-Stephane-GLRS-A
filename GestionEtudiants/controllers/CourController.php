<?php 
namespace Gestion\controllers;

use Gestion\lib\Request;
use Gestion\lib\Session;
use Gestion\lib\Response;
use Gestion\models\CourModel;
use Gestion\lib\AbstractModel;
use Gestion\lib\AbstractController;

class CourController extends AbstractController{

    private AbstractModel $model;
    private $model1;
    public function __construct(){
        parent::__construct();
        $this->model1= new CourModel();
    }

    public function showProfesseurCours(){
        $mat=Session::getSession("user_connect")["matricule_user"];
        $data=$this->model1->getCoursByProfesseur($mat);
        $this->render("cours/cours.professeur", ["cours" => $data]);
    }

    public function addCours(Request $request){
        if ($request->isPost()&&!isset($_POST["modules"])){
            $model= new CourModel();
            $data=$request->getBody();
            
            $this->validator->estVide($data["semestre"], "semestre");
            $this->validator->estVide($data["date"], "date");
            $this->validator->estVide($data["heure_debut"], "heure_debut");
            
            if($this->validator->formValide()){
                $model->insert($data);
                Response::redirectUrl("cour/addCours");
            }else{
                
                Session::SetSession("array_error",$this->validator->getErrors());
                Session::SetSession("array_post",$data);
                Response::redirectUrl("cour/addCours"); 
                
            }
        }
        $this->render("cours/planifier.cours");
        
    }
}