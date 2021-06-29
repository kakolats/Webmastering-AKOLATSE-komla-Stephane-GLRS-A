<?php 
use Gestion\lib\Session;
use Gestion\models\CompetenceModel;
use Gestion\models\ClasseModel;

//verification des erreur de session
$array_error = [];
if (Session::keyExist("array_error")){
    //recuperation des erreur de la session dans la variable local
    $array_error = Session::getSession("array_error");
    Session::destroyKey("array_error");    
}
?>
      <div class="container mt-5">
      <h2>Inscrire Etudiant</h2>
      <form action="<?php ROOT_CONTROLLERS.'/etudiant.php' ?>" method="post">
      <div class="column">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label  class="form-label">Nom</label>
                        <input type="text" class="form-control" name="nom" >
                        <?php if(isset($array_error["nom"])):?>
                            <div  class="form-text text-danger ">
                            <?= $array_error["nom"]; ?></div>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="mb-3">
                        <label  class="form-label">Prénom</label>
                        <input type="text" class="form-control" name="prenom">
                        <?php if(isset($array_error["prenom"])):?>
                            <div  class="form-text text-danger ">
                            <?= $array_error["prenom"]; ?></div>
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


            <?php $model1=new ClasseModel();
            $classes=$model1->getAllClasses(); ?>

            <div class="col-md-6">
              <label for="">Classe</label>
              <select class="form-control" name="classe_id">
              <?php foreach($classes as $classe):?>
                <option value="<?=$classe["id"]?>"><?=$classe["libelle"]?></option>
                <?php endforeach ?>
              </select>
            </div>



            <?php $model=new CompetenceModel();
            $competences=$model->getAllCompetences(); ?>

            <div class="col-md-6">
            <h6>competences</h6>
            <?php foreach($competences as $competence):?>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" name="competence[]" value="<?=$competence["libelle"]?>">
                <label class="form-check-label" for="inlineCheckbox1"><?=$competence["libelle"] ?></label>
            </div>
            <?php endforeach ?>
            </div>

            <textarea rows="5" cols="150" name="parcours"></textarea>

            <div class="row float-right">
             <button type="submit" class="btn btn-primary">Inscription</button>
            </div>
            
        </form>

      </div>
