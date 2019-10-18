<form>

  <a class="btn btn-lg btn-primary" href="monApplication.php?action=searchVoyageFrom" role="button">
    From: <?php echo ($context->from) ? $context->from : "Renseigné la ville de départ"; ?>
  </a>

  <br>

  <a class="btn btn-lg btn-primary" href="monApplication.php?action=searchVoyageTo" role="button">
    To: <?php echo ($context->to) ? $context->to : "Renseigné la ville d'arrivé"; ?>
  </a>

  <br>

  <button type="submit" class="btn btn-primary">Rechercher</button>
</form>