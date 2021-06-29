<?php

namespace Gestion\controllers;
use Gestion\lib\Role;
use Gestion\lib\Request;
use Gestion\lib\Session;
use Gestion\lib\Response;
use Gestion\models\UserModel;
use Gestion\lib\AbstractController;
use Gestion\lib\PasswordEncoder;

/**
 * Undocumented class
 */
class SecurityController extends AbstractController{

    private string $format="LLL-LLL-LL";
    
public function login(Request $request){
    if($request->isPost()){

        //dd($this->validator->getErrors());
        $data= $request->getBody();
    if(!$this->validator->estVide($data["login"], "login")){
        $this->validator->estMail($data["login"], "login");
    }
    $this->validator->estVide($data["password"], "password");
    if($this->validator->formValide()){
        // login et mot de passe correct
        $model= new UserModel;
        $user = $model->selectUserByLoginPassword($data["login"] );

        if(empty($user)){
           $this->validator->setErrors("error_login","login ou mot de passe incorrect");
          Session::setSession("array_error",$this->validator->getErrors());
        
           Response::redirectUrl("security/login");
           
        }else{
            // login et password correct et existe
           // set_session("user_connect",$user);
            Session::setSession("user_connect",$user);
            if($data["password"]==$user["password"]){
                
                if(Session::keyExist("action") && Session::getSession("action")== "reservation"){
                    Response::redirectUrl("reservation/addReservation");
                }
                if($user["role"]=="ROLE_RESPONSABLE"){
                    $this->render("security/accueil");
                }
                elseif($user["role"]=="ROLE_ETUDIANT"){
                    //redirect_url("accueil.visiteur");
                    $this->render("security/accueil");
                }elseif($user["role"]=="ROLE_PROFESSEUR"){
                    $this->render("security/accueil");
                }elseif($user["role"]=="ROLE_ADMIN"){
                    $this->render("security/accueil");
                }elseif($user["role"]=="ROLE_ASSISTANT"){
                    $this->render("security/accueil");
                }
            }else{
                $this->validator->setErrors("error_login","login ou mot de passe incorrect");
                Session::setSession("array_error",$this->validator->getErrors());
                Response::redirectUrl("security/login");
            }
        }
    }else {
        //Erreur de validation donc redirection vers page de connexion
        //dd($this->validator->getErrors());
        Session::SetSession("array_error",$this->validator->getErrors());
        Response::redirectUrl("security/login");
    }
    }
    $this->render("security/login");
}

public function addUser(Request $request){
    if($request->isPost()){
        $model= new UserModel();
        
        $data=$request->getBody();
        $this->validator->estVide($data["nom"], "nom");
        if(!$this->validator->estVide($data["login"], "login")){
            if($this->validator->estMail($data["login"], "login")){
                
                if($model->loginExiste($data["login"])){
                    $this->validator->setErrors("login","ce login existe deja dans le systeme");
                }
            }
        }
    
        
        if($this->validator->formValide()){
           $data["nom_complet"] = $data["nom"];
           $data["password"]="1234";
           unset($data["nom"]);
           //$data["password"]=PasswordEncoder::encode($data["1234"]);
           //dd($data);
           $model->insert($data);
       }else{
        Session::SetSession("array_error",$this->validator->getErrors());
        Session::SetSession("array_post",$data);
        Response::redirectUrl("security/addUser");  
       }
    }
    $this->render("security/add.user");
    
}

public function logout(){
    Session::destroySession();
    Response::redirectUrl("security/login");
}

public function showUser(){
    if(!Role::estAdmin())Response::redirectUrl("bien/showCatalogue");
    $model=new UserModel();
    $data=$model->selectAll();
    //dd($data);
    $this->render("security/show.user",["users"=> $data]);

}

public function generateMatricule():string{
    $model = new UserModel();
    $number=$model->userCount();
    $numberString=strval($number);
    $mat=$this->format;
    for($i=0;$i<=strlen($numberString);$i++){
        substr($mat,0,-1);
    }
    $mat.=strval($number+1);
    return $mat;
}

public function showResponsables(){
    $this->render("security/gerer.responsable");
}
public function showAssistants(){
    $this->render("security/gerer.assistant");
}

public function supprimerResponsable(){
    if (isset($_SESSION["log"])){
        $login=$_SESSION["log"];
        $model= new UserModel();
        $model->deleteUser($login);
        
    }
    $this->render("security/gerer.responsable");
}

public function accueil(){
    $this->render("security/accueil");
}
}