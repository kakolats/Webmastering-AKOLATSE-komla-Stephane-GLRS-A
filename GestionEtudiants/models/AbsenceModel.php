<?php 
namespace Gestion\models;

use Gestion\lib\AbstractModel;

class AbsenceModel extends AbstractModel{
    public function __construct() {
        parent::__construct();
        $this->tableName = "absence";
        $this->primaryKey = "";
    }

    /*
    public function addAbsence(){
        $sql="INSERT INTO absence 
        (date,etudiant_matricule,cours_libelle)
        VALUES (?,?,?)";
        $result=$this->persit($sql,[$date,$mat,$cours_libelle]);
        return $result["count"]==0?false:true;
    }*/
}
?>