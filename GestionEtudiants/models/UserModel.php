<?php
namespace Gestion\models;
use Gestion\lib\DataBase;
use Gestion\lib\AbstractModel;

class UserModel extends AbstractModel{

    private DataBase $dataBase;
    public function __construct() {
        parent::__construct();
        $this->tableName = "user";
        $this->primaryKey = "id";
    }

    public function selectUserByLoginPassword(string $login):array{
        $sql= "SELECT * FROM user 
        WHERE login=?";
        $result=$this->selectBy($sql,[$login],true);
        return $result["count"]==0?[]:$result["data"];
       }
    
    public function loginExiste(string $login):bool{
        $sql= "SELECT * FROM user WHERE login=:login";
        $result=$this->selectBy($sql,[':login'=>$login],true);
        return $result["count"]==0?false:true;
    }
    public function insert(array $user):bool{
        extract($user);
        $sql= "INSERT INTO user 
        (matricule_user,nom_complet,login,password,role)
        VALUES 
        (?,?,?,?,?)";
    
        $result=$this->persit($sql,[$matricule_user,$nom_complet,$login,$password,$role]);
        
        return $result["count"]==0?false:true;
    }

    public function userCount():int{
        $sql="SELECT COUNT(*) FROM user";
        $dataBase=new DataBase();
        $result=$dataBase->executeSelect($sql);
        return intval($result["data"][0]["COUNT(*)"]);
    }

    public function getResponsable():array{
        $sql="SELECT * FROM user 
        WHERE role=?";
        $result=$this->selectBy($sql,["ROLE_RESPONSABLE"]);
        return $result["count"]==0?[]:$result["data"];
    }

    public function getAssistant():array{
        $sql="SELECT * FROM user 
        WHERE role=?";
        $result=$this->selectBy($sql,["ROLE_ASSISTANT"]);
        return $result["count"]==0?[]:$result["data"];
    }

    public function deleteUser($login){
        $sql="DELETE * FROM user
        WHERE login=?";
        $database= new DataBase();
        $result=$database->executeUpdate($sql,[$login]);
    }
    


}
