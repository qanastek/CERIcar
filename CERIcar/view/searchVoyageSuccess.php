<form>

  <a class="btn btn-lg btn-primary" href="monApplication.php?action=searchVoyageFrom" role="button">
    From: <?php echo (isset($_SESSION["from"])) ? $_SESSION["from"] : "Renseigné la ville de départ"; ?>
  </a>

  <br>

  <a class="btn btn-lg btn-primary" href="monApplication.php?action=searchVoyageTo" role="button">
    To: <?php echo (isset($_SESSION["to"])) ? $_SESSION["to"] : "Renseigné la ville d'arrivé"; ?>
  </a>

  <br>

  <button type="submit" class="btn btn-primary">Rechercher</button>
</form>