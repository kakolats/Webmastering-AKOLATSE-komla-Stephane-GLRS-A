<?php
use Gestion\models\UserModel;
$model = new UserModel();
$assistants=$model->getAssistant();
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
    <?php foreach($assistants as $assistant): ?>
    <tr>
      <th scope="row">$<?=$assistant["nom_complet"] ?></th>
      <td><?=$assistant["login"] ?></td>
      <td><?=$assistant["password"] ?></td>

      <td><div class="btn-group" role="group" aria-label="Basic example">
      <button type="button" class="btn btn-secondary">Supprimer</button>
      </div></td>

      <td><div class="btn-group" role="group" aria-label="Basic example">
      <button type="button" class="btn btn-secondary">Modifier</button>
      </div></td>

    </tr>
    
    <?php endforeach; ?>
  </tbody>
</table>