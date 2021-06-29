<?php
namespace Gestion\models;

use Gestion\lib\AbstractModel;

class ModuleModel extends AbstractModel{

    public function __construct() {
        parent::__construct();
        $this->tableName = "module";
        $this->primaryKey = "libelle";
    }


    public function getAllModules(){
        $result=$this->selectAll();
        return $result["count"]==0?[]:$result["data"];
    }
}