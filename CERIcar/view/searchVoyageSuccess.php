<div class="centeredSearch text-center">

  <p class="titleSearch">Où voulez-vous aller ?</p>

  <a class="fieldSearch fieldSearchFrom" role="button">
    <?php echo (isset($_SESSION["from"])) ? $_SESSION["from"] : "Ville de départ"; ?>
  </a>

  <br>

  <a class="fieldSearch fieldSearchTo" role="button">
    <?php echo (isset($_SESSION["to"])) ? $_SESSION["to"] : "Ville d'arrivé"; ?>
  </a>

  <br>

  <?php if($context->getSessionAttribute("from") && $context->getSessionAttribute("to")): ?>
  <a class="searchButton" role="button">
    Rechercher
  </a>
  <?php endif; ?>

</div>