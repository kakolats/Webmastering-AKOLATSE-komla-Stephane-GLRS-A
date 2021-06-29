<?php 
use Gestion\lib\Session;
//verification des erreur de session
$array_error = [];
if (Session::keyExist("array_error")){
    //recupeeration des erreur de la session dans la variable local
    $array_error = Session::getSession("array_error");
    Session::destroyKey("array_error");    
}
?>
      <div class="container mt-5">
      <h1>Inscription</h1>
      <form action="<?php path("security/addUser") ?>" method="post">
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label  class="form-label">Nom</label>
                        <input type="text" class="form-control" name="nom" value="<?php
                            echo !isset($array_error["nom"]) && isset($array_post["nom"])?trim($array_post["nom"]):'';?>
                        ">
                        <?php if(isset($array_error["nom"])):?>
                            <div  class="form-text text-danger ">
                            <?= $array_error["nom"]; ?></div>
                        <?php endif; ?>
                    </div>
                </div>

            
            </div>
            <div class="col-md-6">
            <div class="mb-3">
                <label  class="form-label">Email address</label>
                <input type="text" class="form-control" name="login">
                <?php if(isset($array_error["login"])):?>
                    <div id="emailHelp" class="form-text text-danger ">
                    <?= $array_error["login"]; ?></div>
                <?php endif; ?>
            </div>
            </div>
            
            
            <div class="form-group">
              <label for="">Role</label>
              <select class="form-control" name="role" id="">
                <option value="ROLE_RESPONSABLE">Responsable</option>
                
                <option value="ROLE_ASSISTANT">Assistant</option>
              </select>
            </div>

            <div class="row float-right">
             <button type="submit" class="btn btn-primary">Ajouter</button></button>
            </div>
            
        </form>

      </div>
