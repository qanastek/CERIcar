<div class="centeredSearch">

<?php include($nameApp . "/view/fromToBar.php"); ?>

<p>
    <?php echo $context->nbVoyagesDisponible; ?> voyages disponible
</p>

<?php foreach($context->voyages as $voyage): ?>

    <!-- Vérifie si il y a des places restantes -->
    <?php if($context->getNbrPlacesRestante($voyage->id) > 0): ?>

    <div class="card mb-3 shadow" style="width: 100%; border: 0px; border-radius: 16px;">
        <div class="card-body">

            <div class="row">

                <div class="col-md-10">
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
                        <button class="book button-classic" style="text-transform: uppercase;" value="<?php echo $voyage->id; ?>">Réserver</button>
                    <?php endif; ?>
                </div>

                <div class="col-md-2">
                    <p class="card-text" style="text-align: right; font-weight: 500; font-size: 18px; color: rgb(5, 71, 82);">
                        <?php echo $voyage->tarif; ?> €
                    </p>
                </div>
            </div>
            
        </div>
    </div>

    <?php endif; ?>

<?php endforeach; ?>

<?php foreach($context->voyagesCorrespondance as $correspance): ?>

    <p>        

    <?php echo $correspance[0]->trajet->depart ?>
    <i class="fas fa-caret-right" aria-hidden="true"></i>

    <?php for($i = 1; $i < count($correspance); $i++): ?>
        
        <?php echo $correspance[$i]->trajet->depart ?>
        <i class="fas fa-caret-right" aria-hidden="true"></i>

    <?php endfor; ?>
    <?php echo $correspance[count($correspance) - 1]->trajet->arrivee ?>
    </p>

<?php endforeach; ?>

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
            });
        },
        error: function(xhr) {
            console.log("fail");
        }
    });
});
</script>