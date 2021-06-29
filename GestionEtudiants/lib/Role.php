<?php
namespace Gestion\lib;

class Role{
    public static function estConnect():bool{
        return isset($_SESSION["user_connect"]);
    }
    public static function estAdmin():bool{
        return self::estConnect() && $_SESSION["user_connect"]["role"] == "ROLE_ADMIN";
    }
    public static function estEtudiant():bool{
        return self::estConnect() && $_SESSION["user_connect"]["role"] == "ROLE_ETUDIANT";
    }
    public static function estResponsable():bool{
        return self::estConnect() && $_SESSION["user_connect"]["role"] == "ROLE_RESPONSABLE";
    }
    public static function estAssistant():bool{
        return self::estConnect() && $_SESSION["user_connect"]["role"] == "ROLE_ASSISTANT";
    }
    public static function estProfesseur():bool{
        return self::estConnect() && $_SESSION["user_connect"]["role"] == "ROLE_PROFESSEUR";
    }

}