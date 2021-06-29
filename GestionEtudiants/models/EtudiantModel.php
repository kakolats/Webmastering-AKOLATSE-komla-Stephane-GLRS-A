<?php
namespace Gestion\models;

use Gestion\lib\AbstractModel;
use Gestion\controllers\SecurityController;

class EtudiantModel extends AbstractModel{

    

    public function insert(array $etudiant):bool{
        //dd($etudiant);
        extract($etudiant);
        $sql= "INSERT INTO etudiant 
        (matricule,nom,prenom,date_naissance,sexe,classe_id,competence,parcours)
        VALUES 
        (?,?,?,?,?,?,?,?)";
        $security= new SecurityController();
        $mat=$security->generateMatricule();
        $result=$this->persit($sql,[$mat,$nom,$prenom,$date,$sexe,$classe_id,json_encode($competence),$parcours]);
        $model = new UserModel();
        $nom_complet=$nom." ".$prenom;
        $model->insert(["matricule_user"=>$mat,"nom_complet"=>$nom_complet,"login"=>$login,"password"=>"1234","role"=>"ROLE_ETUDIANT"]);
        return $result["count"]==0?false:true;
    }
}
?>