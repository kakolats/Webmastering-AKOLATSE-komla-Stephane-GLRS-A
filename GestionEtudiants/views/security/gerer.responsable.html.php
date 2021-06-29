<?php
use Gestion\models\UserModel;
use Gestion\lib\Session;
$model = new UserModel();
$responsables=$model->getResponsable();
?>

<table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">Nom</th>
      <th scope="col">Login</th>
      <th scope="col">Password</th>
      <th scope="col"></th>
      <th scope="col"></th>
    </tr>
  </thead>
  <tbody>
    <?php foreach($responsables as $responsable): ?>
    <?php $_SESSION["log"]=$responsable["login"]; ?>
    <tr>
      <th scope="row"><?=$responsable["nom_complet"] ?></th>
      <td><?=$responsable["login"] ?></td>
      <td><?=$responsable["password"] ?></td>

      <td><a href="<?=path('security/supprimerResponsable') ?>">Supprimer</a></td>

      <td><div class="btn-group"  aria-label="Basic example">
      <button type="button" class="btn btn-secondary">Modifier</button>
      </div></td>

    </tr>
    
    <?php endforeach; ?>
  </tbody>
</table>