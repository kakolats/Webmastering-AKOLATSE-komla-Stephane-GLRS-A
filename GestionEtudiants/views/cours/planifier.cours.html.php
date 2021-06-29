<?php 
use Gestion\lib\Session;
use Gestion\models\ClasseModel;
use Gestion\models\ModuleModel;
use Gestion\models\ProfesseurModel;

//verification des erreur de session
$array_error = [];
if (Session::keyExist("array_error")){
    //recuperation des erreur de la session dans la variable local
    $array_error = Session::getSession("array_error");
    Session::destroyKey("array_error");    
}
?>
      <div class="container mt-5">
      <h1>Planifier cours</h1>
      <form action="" method="post">
            <div class="column">

                <?php $model=new ModuleModel();
                $modules=$model->getAllModules(); 
                $mo="";?>

                
                
                <div class="col-md-6">
                <label for="">Module</label>
                <select class="form-control" name="module">
                <?php foreach($modules as $mod):?>
                    <option value="<?=$mod["libelle"];?>"><?=$mod["libelle"];?></option>
                    <?=$mo=$mod["libelle"] ?>
                <?php endforeach ?>
                </select>
                </div>

                <div class="row float-right">
             <button type="submit" class="btn btn-primary" name="modules" value="sub">Choisir prof</button>
            </div>

            
        </form>
        <?php if(isset($_POST["modules"])&&($_POST["modules"]=="sub")):?>

        <form action="<?php ROOT_CONTROLLERS.'/professeur.php' ?>" method="post">
            <div class="column">
 
                <input type="hidden" name="module" value="<?=$_POST["module"]?>">
                    
                <?php $model1= new ProfesseurModel();
                $professeurs=$model1->getProfesseurByModule($_POST["module"]); ?>
                <div class="col-md-6">
                <label for="">Professeur</label>
                <select class="form-control" name="professeur_id">
                <?php foreach($professeurs as $prof):?>
                    <option value="<?=$prof["id"];?>"><?=$prof["nom"];?></option>
                <?php endforeach ?>
                </select>
                </div>      

                <?php $model1=new ClasseModel();
                $classes=$model1->getAllClasses(); ?>

            <div class="col-md-6">
            <h6>classes</h6>
            <?php foreach($classes as $classe):?>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" name="classes[]" value="<?=$classe["libelle"]?>">
                <label class="form-check-label" for="inlineCheckbox1"><?=$classe["libelle"] ?></label>
            </div>
            <?php endforeach ?>
            </div>  

                <div class="col-md-6">
              <label for="">Semestre</label>
              <select class="form-control" name="semestre">
              <option value="">Veuillez choisir le semestre</option>
                <option value="Semestre 1">Semestre 1</option>
                <option value="Semestre 2">Semestre 2</option>
              </select>
            </div>
            <br>

            <div class="col-md-6">
            <label for="">Date</label>
            <input type="date" name="date">
            </div>
                    <br>

            <div class="col-md-6">
            <label for="">Heure de debut</label>
            <input type="time" name="heure_debut">
            </div>
                    <br>
            <div class="col-md-6">
            <label for="">Heure de fin</label>
            <input type="time" name="heure_fin">
            </div>

            <br>
            <div class="col-md-6">
            <label for="">Nombre d'heures du module</label>
            <input type="number" name="nombre_heures">
            </div>

            
            
            

            <div class="row float-right">
             <button type="submit" class="btn btn-primary" >Planifier</button>
            </div>
            
        </form>
        <?php endif; ?>

      </div>
