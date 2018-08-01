<?php

function afficherBarreConnexion($estConnecte){

  $lienDeconnexion = PATH_CONTROLEURS.'deconnexionPublic';

  if($estConnecte){
  ?>
    <li class="menu-monprofil"><a href="#"><?php echo NAV_MON_COMPTE; ?></a>
        <ul class="submenu">
          <li><a href="profile"><?php echo NAV_PROFIL; ?></a></li>
          <li><a href="ajout-photo"><?php echo NAV_AJOUT_PHOTO; ?></a></li>
          <li><a href="mes-photos"><?php echo NAV_MES_PHOTOS; ?></a></li>
          <li><a href="mes-commandes"><?php echo NAV_MES_COMMANDES; ?></a></li>
          <li><a href="<?php echo $lienDeconnexion ?>"><?php echo NAV_DECONNEXION; ?></a></li>
        </ul>
    </li>
  <?php
  }else{
    ?>
    <li class="menu-inscription"><a href="inscription"><?php echo NAV_INSCRIPTION; ?></a></li>
    <li class="menu-connexion"><a href="connexion"><?php echo NAV_CONNEXION; ?></a></li>
  <?php
  }
}

?>
