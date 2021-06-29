<?php 
use Gestion\lib\Session;
use Gestion\models\ModuleModel;

//verification des erreur de session
$array_error = [];
if (Session::keyExist("array_error")){
    //recuperation des erreur de la session dans la variable local
    $array_error = Session::getSession("array_error");
    Session::destroyKey("array_error");    
}
?>
      <div class="container mt-5">
      <h1>Ajouter Professeur</h1>
      <form action="<?php ROOT_CONTROLLERS.'/professeur.php' ?>" method="post">
            <div class="column">

                <div class="col-md-6">
                    <div class="mb-3">
                        <label  class="form-label">Login</label>
                        <input type="text" class="form-control" name="login">
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="mb-3">
                        <label  class="form-label">Nom</label>
                        <input type="text" class="form-control" name="nom">
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="mb-3">
                        <label  class="form-label">Prenom</label>
                        <input type="text" class="form-control" name="prenom">
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="mb-3">
                        <label  class="form-label">Date de naissance</label>
                        <input type="date" class="form-control" name="date">
                    </div>
                </div>

            <div class="col-md-6">
              <label for="">Sexe</label>
              <select class="form-control" name="sexe">
                <option value="Masculin">Masculin</option>
                <option value="Feminin">Feminin</option>
              </select>
            </div>

            <div class="col-md-6">
              <label for="">Grade</label>
              <select class="form-control" name="grade">
                <option value="Ingenieur">Ingenieur</option>
                <option value="Docteur">Docteur</option>
                <option value="Autre">Autre</option>
              </select>
            </div>

            <?php $model=new ModuleModel();
            $modules=$model->getAllModules(); ?>

            <div class="col-md-6">
            <h6>Modules</h6>
            <?php foreach($modules as $mod):?>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" name="modules[]" value="<?=$mod["libelle"]?>">
                <label class="form-check-label" for="inlineCheckbox1"><?=$mod["libelle"] ?></label>
            </div>
            <?php endforeach ?>
            </div>

            <div class="row float-right">
             <button type="submit" class="btn btn-primary">Inscription</button>
            </div>
            
        </form>

      </div>
