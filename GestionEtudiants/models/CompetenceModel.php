<?php 
namespace Gestion\models;

use Gestion\lib\AbstractModel;

class CompetenceModel extends AbstractModel{

    public function __construct() {
        parent::__construct();
        $this->tableName = "competence";
        $this->primaryKey = "libelle";
    }


    public function getAllCompetences(){
        $result=$this->selectAll();
        return $result["count"]==0?[]:$result["data"];
    }
}
?>