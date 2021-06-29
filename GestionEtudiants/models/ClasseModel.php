<?php
namespace Gestion\models;

use Gestion\lib\AbstractModel;

class ClasseModel extends AbstractModel{
    public function __construct() {
        parent::__construct();
        $this->tableName = "classe";
        $this->primaryKey = "id";
    }


    public function getAllClasses(){
        $result=$this->selectAll();
        return $result["count"]==0?[]:$result["data"];
    }
}
?>