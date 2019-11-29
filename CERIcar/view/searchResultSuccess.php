<div class="centeredSearch">

<?php include($nameApp . "/view/fromToBar.php"); ?>

<p>
    <?php echo $context->nbVoyagesDisponible; ?> voyages total disponible
</p>
<p>
    <?php echo count($context->voyages); ?> voyages simple disponible
</p>
<p>
    <?php echo count($context->voyagesCorrespondance); ?> voyages avec correspondance disponible
</p>

<?php foreach($context->voyages as $voyage): ?>

    <!-- Vérifie si il y a des places restantes -->

    <div class="card mb-3 shadow" style="width: 100%; border: 0px; border-radius: 16px;">
        <div class="card-body">

            <div class="row">

                <div class="col-10">
                    <h5 class="card-title" style="color: rgb(5, 71, 82);">
                        <?php echo $voyage->heureDepart; ?>:00 à <?php echo $voyage->trajet->depart; ?>
                        <i class="fas fa-caret-right" aria-hidden="true"></i>
                        <?php echo $context->getDureeTrajet($voyage->heureDepart, $voyage->trajet->distance); ?> à <?php echo $voyage->trajet->arrivee; ?>
                    </h5>

                    <p href="#" class="card-link">
                        <?php if($voyage->conducteur->avatar): ?>
                            <img alt="" class="avatar" src="<?php echo $context->getImages($nameApp, $voyage->conducteur->avatar); ?>">
                        <?php endif; ?>

                        <?php echo $voyage->conducteur->nom . " " . $voyage->conducteur->prenom; ?>
                    </p>

                    <p>
                        Il reste <?php echo $context->getNbrPlacesRestante($voyage->id); ?> places.
                    </p>
                    
                    <?php if(isset($_SESSION['user_id'])): ?>
                        <button class="bookBtn button-classic" style="text-transform: uppercase;" value="<?php echo $voyage->id; ?>">Réserver</button>
                    <?php endif; ?>
                </div>

                <div class="col-2">
                    <p class="card-text" style="text-align: right; font-weight: 500; font-size: 18px; color: rgb(5, 71, 82);">
                        <span class="price"><?php echo $voyage->tarif; ?></span> €
                    </p>
                </div>
            </div>
            
        </div>
    </div>

<?php endforeach; ?>

<?php foreach($context->voyagesCorrespondance as $correspance): ?>

    <div class="card mb-3 shadow" style="width: 100%; border: 0px; border-radius: 16px;">
        <div class="card-body">

            <div class="row">

                <div class="col-10">

                    <p>        
                        <?php echo $correspance["departHeure"]; ?>:00
                        à 
                        <?php echo $correspance["villes"]; ?>
                        à
                        <?php echo $correspance["arriveeHeure"]; ?>
                    </p>

                    <?php if(isset($_SESSION['user_id'])): ?>
                        <button class="bookBtn button-classic" style="text-transform: uppercase;" value="<?php echo $correspance['voyagesIds']; ?>">Réserver</button>
                    <?php endif; ?>
                </div>

                <div class="col-2">
                    <p class="card-text" style="text-align: right; font-weight: 500; font-size: 18px; color: rgb(5, 71, 82);">
                        <span class="price"><?php echo $correspance["prix_total"]; ?></span> €
                    </p>
                </div>
            </div>
            
        </div>
    </div>

<?php endforeach; ?>

</div>

<div class="modal payementConfirmation" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">

      <div class="modal-header">
        <h5 class="modal-title">Êtes-vous sûr ?</h5>
        <button type="button" class="close deny" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">
        <p>Êtes-vous sûr de vouloir payer <span class="priceModal">X</span> € ?</p>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-primary book">Payer</button>
        <button type="button" class="btn btn-secondary deny" data-dismiss="modal">Annuler</button>
      </div>

    </div>
  </div>
</div>

<script>
$(".book").click(function(){

    var voyageId = $(this).val();

    $.ajax({
        url: "monApplicationAjax.php?action=book",
        type: "post",
        data: {
            "voyageId": voyageId
        },
        success: function(response) {
            $.get( "monApplicationAjax.php?action=book", function(data) {

                $( "#mainContent" ).html( data );

                $.get( "monApplicationAjax.php?action=banner", function(banner) {
                    $( "#statusBar" ).html( banner );
                });
                
            });
        },
        error: function(xhr) {
            console.log("fail");
        }
    });
});

$(".bookBtn").click(function(){

    var voyageId = $(this).val();
    var price = $(this).closest(".row").find(".price").text();

    $(".book").val(voyageId);
    $(".priceModal").text(price);

    $(".payementConfirmation").toggle();

});

$(".deny").click(function(){    
    $(this).closest(".payementConfirmation").toggle();
});
</script>