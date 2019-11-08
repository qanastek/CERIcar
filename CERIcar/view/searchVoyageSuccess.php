<div class="centeredSearch text-center">

  <p class="titleSearch">Où voulez-vous aller ?</p>

  <p class="fieldSearch fieldSearchFrom" role="button">
    <?php echo (isset($_SESSION["from"])) ? $_SESSION["from"] : "Ville de départ"; ?>
  </p>

  <br>

  <p class="fieldSearch fieldSearchTo" role="button">
    <?php echo (isset($_SESSION["to"])) ? $_SESSION["to"] : "Ville d'arrivé"; ?>
  </p>

  <br>

  <?php if($context->getSessionAttribute("from") && $context->getSessionAttribute("to")): ?>
  <a class="searchButton" role="button">
    Rechercher
  </a>
  <?php endif; ?>

</div>

<script>

$(".searchVoyage").click(function(){
  $.get( "monApplicationAjax.php?action=searchVoyage", function(data) {
      $( "#mainContent" ).html( data );
  });
});

$(".searchButton").click(function(){
    $.get( "monApplicationAjax.php?action=searchResult", function(data) {
      $( "#mainContent" ).html( data );
  
      $.get( "monApplicationAjax.php?action=banner", function(banner) {
          $( "#statusBar" ).html( banner );
      });
    });
});

$(".fieldSearchFrom").click(function(){
    $.get( "monApplicationAjax.php?action=searchVoyageFrom", function(data) {
        $( "#mainContent" ).html( data );
    });
});

$(".fieldSearchTo").click(function(){
    $.get( "monApplicationAjax.php?action=searchVoyageTo", function(data) {
        $( "#mainContent" ).html( data );
    });
});
</script>