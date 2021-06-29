
<!-- -----------------------------------------------------------CONTAINER -->
<div class="container">
    <div class="row">

      <?php foreach($professeurs as $professeur): ?>
        <div class="col-sm-4 mb-4">
            <div class="card" style="width: 22rem">
             
            
                <span class="badge badge-light"><?=  $professeur["matricule"];?> </span>

            
                <span class="badge badge-light"><?=  $professeur["nom"];?> </span>

            
                <span class="badge badge-light"><?=  $professeur["prenom"];?> </span>

            
                <span class="badge badge-light"><?=  $professeur["grade"];?> </span>

            </div>

        </div>
        <?php endforeach?>

    </div>
      
      

</div>

