<?php
namespace Gestion\models;

use Gestion\lib\DataBase;
use Gestion\lib\AbstractModel;
use Gestion\controllers\SecurityController;

class ProfesseurModel extends AbstractModel{
    public function __construct() {
        parent::__construct();
        $this->tableName = "professeur";
        $this->primaryKey = "matricule";
    }


    public function selectAll():array {
        $sql="SELECT * FROM professeur ";
        $result=$this->selectBy($sql);
        return $result["data"];
    }
    
    public function loginExiste(string $login):bool{
        $sql= "SELECT * FROM user WHERE login=:login";
        $result=$this->selectBy($sql,[':login'=>$login],true);
        return $result["count"]==0?false:true;
    }

    public function insert(array $professeur):bool{
        extract($professeur);
        $sql= "INSERT INTO professeur 
        (matricule,login,nom,prenom,date_naissance,sexe,grade,modules)
        VALUES 
        (?,?,?,?,?,?,?,?)";
    
        $security= new SecurityController();
        $mat=$security->generateMatricule();
        $result=$this->persit($sql,[$mat,$login,$nom,$prenom,$date,$sexe,$grade,json_encode($modules)]);
        $model = new UserModel();
        $nom_complet=$nom." ".$prenom;
        $model->insert(["nom_complet"=>$nom_complet,"login"=>$login,"password"=>"1234","role"=>"ROLE_PROFESSEUR"]);
        return $result["count"]==0?false:true;
    }
 
    public function getProfesseurByModule($module):array{
        $profs=$this->selectAll();
        $professeurs=[];
        foreach($profs as $pro){
            $modules=json_decode($pro["modules"]);
            if ($modules!=null){
                if(in_array($module,$modules)){
                array_push($professeurs,$pro);
            }
            }
        };
        return $professeurs;
    }
}