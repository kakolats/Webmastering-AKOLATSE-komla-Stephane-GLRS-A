<?php 
use Gestion\lib\Role;
use Gestion\lib\Session;?>
<nav class="navbar navbar-expand-sm navbar-light bg-info mt-1 mb-4">
    <a class="navbar-brand" href="<?php path('secuity/acceuil') ?>">Systeme Eureka</a>
    <button class="navbar-toggler d-lg-none" type="button" data-toggle="collapse" data-target="#collapsibleNavId" aria-controls="collapsibleNavId"
        aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="collapsibleNavId">
        <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
        
        <?php  if(Role::estEtudiant()): ?>
            <li class="nav-item active">
                <a class="nav-link">Mes Cours</a>
            </li>
        <?php endif ?>

        <?php  if(Role::estResponsable()): ?>
            <li class="nav-item active">
                <a class="nav-link" href="<?php path('professeur/showProfesseurs')?>" >Lister les professeurs</a>
            </li>
        <?php endif ?>
        <?php  if(Role::estResponsable()): ?>
            <li class="nav-item active">
                <a class="nav-link" href="<?php path('professeur/addProfesseur')?>">Ajouter un professeur</a>
            </li>
        <?php endif ?>
        <?php  if(Role::estResponsable()): ?>
            <li class="nav-item active">
                <a class="nav-link">Lister cours par classe</a>
            </li>
        <?php endif ?>

        <?php  if(Role::estResponsable()): ?>
            <li class="nav-item active">
                <a class="nav-link" href="<?php path('cour/addCours')?>">Planifier un cours</a>
            </li>
        <?php endif ?>

        <?php  if(Role::estProfesseur()): ?>
            <li class="nav-item active">
                <a class="nav-link" href="<?php path('cour/showProfesseurCours')?>">Lister mes cours</a>
            </li>
        <?php endif ?>

        <?php  if(Role::estAdmin()): ?>
            <li class="nav-item active">
                <a class="nav-link" href="<?php path('security/showResponsables')?>">Gerer Responsable</a>
            </li>
        <?php endif ?>

        <?php  if(Role::estAdmin()): ?>
            <li class="nav-item active">
                <a class="nav-link" href="<?php path('security/showAssistants')?>">Gerer Assistant</a>
            </li>
        <?php endif ?>

        <?php  if(Role::estAdmin()): ?>
            <li class="nav-item active">
                <a class="nav-link" href="<?php path('security/addUser')  ?>">Ajouter</a>
            </li>
        <?php endif ?>

        <?php  if(Role::estAssistant()): ?>
            <li class="nav-item active">
                <a class="nav-link" href="<?php path('etudiant/addEtudiant')  ?>">Inscrire Etudiant</a>
            </li>
        <?php endif ?>


        <?php  if(Role::estConnect()): ?>
            <li class="nav-item active">
                <a class="nav-link">Voir mes informations</a>
            </li>
        <?php endif ?>




            <?php  if(Role::estConnect()): ?>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="dropdownId" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Parametres</a>
                <div class="dropdown-menu" aria-labelledby="dropdownId">
                    <?php  if(Role::estConnect()): ?>
                     <a class="dropdown-item" href="<?php path('security/logout')?>">Deconnexion</a>
                    <?php endif ?>
                </div>
            </li>
            <?php endif ?>
        </ul>
        <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
            <?php if(Role::estConnect()):?>
            <li class="nav-item">
              <?= Session::getSession("user_connect")["nom_complet"];  
              ?>   
            </li>
            <?php endif?>

        </ul>
        
    </div>
</nav>