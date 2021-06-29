<?php
namespace Gestion\models;

use Gestion\lib\AbstractModel;
use Gestion\lib\DataBase;

class CourModel extends AbstractModel{

    

    public function __construct() {
        parent::__construct();
        $this->tableName = "cours";
        $this->primaryKey = "";
    }


    public function getAllCours(){
        $result=$this->selectAll();
        return $result["count"]==0?[]:$result["data"];
    }

    public function getCoursByProfesseur($mat):array{
        $sql= "SELECT * FROM cour WHERE professeur_mat=?";
        $data=new DataBase();
        $result=$data->executeSelect($sql,[$mat],false);
        return $result["count"]==0?[]:$result["data"];
    }

    public function getCoursByDate($date1,$date2):array{
        $sql="SELECT * FROM cours
        WHERE date BETWEEN ‘?’ AND ‘?’";
        $result=$this->data->executeSelect($sql,[$date1,$date2],false);
        return $result["count"]==0?[]:$result["data"];
    }

    public function getCoursByClasse($classe){
        $sql="SELECT FROM cours 
        WHERE JSON_EXTRACT(classes,?) IS NOT NULL";
        $result=$this->data->executeSelect($sql,[$classe],false);
        return $result["count"]==0?[]:$result["data"];
    }

    public function insert(array $data)
    {
        extract($data);
        $sql= "INSERT INTO cour 
        (date,classes,professeur_id,module,semestre,nombre_heures,heure_debut,heure_fin)
        VALUES 
        (?,?,?,?,?,?,?,?)";
        $result=$this->persit($sql,[$date,json_encode($classes),$professeur_id,$module,$semestre,$nombre_heures,$heure_debut,$heure_fin]);
        return $result["count"]==0?false:true;
    }
        
    
}