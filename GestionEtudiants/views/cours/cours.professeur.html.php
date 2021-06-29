<!-- -----------------------------------------------------------CONTAINER -->
<div class="container">
    <div class="row">

      <?php foreach($cours as $cour): ?>
      <?= $classes=json_decode($cour["classes"]); ?>
        <div class="col-sm-4 mb-4">
            <div class="card" style="width: 22rem">
             
            
                <span class="badge badge-light"><?=  $cour["module"];?> </span>

            
                <span class="badge badge-light"><?=  $cour["date"];?> </span>

            
                <span class="badge badge-light"><?=  $cour["semestre"];?> </span>

                <span class="badge badge-light"><?=  $cour["heure_debut"]."-".$cour["heure_fin"];?> </span>

            
            <?php foreach($classes as $classe): ?>
                <span class="badge badge-light"><?= $classe;?> </span>
            <?php endforeach?>

            <a href="#" class="btn btn-primary stretched-link">Marquer absence</a>

            </div>

        </div>
        <?php endforeach?>

    </div>
      
      

</div>