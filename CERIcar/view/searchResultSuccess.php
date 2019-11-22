<div class="centeredSearch">

<?php include($nameApp . "/view/fromToBar.php"); ?>

<p>
    <?php echo $context->nbVoyagesDisponible; ?> voyages disponible
</p>

<?php foreach($context->voyages as $voyage): ?>

    <!-- Vérifie si il y a des places restantes -->
    <?php if($context->getNbrPlacesRestante($voyage->id) > 0): ?>

    <div class="card mb-3" style="width: 100%;">
        <div class="card-body">

            <h5 class="card-title">
                <?php echo $voyage->heureDepart; ?>:00 à <?php echo $voyage->trajet->depart; ?>
                <i class="fas fa-caret-right" aria-hidden="true"></i>
                <?php echo $context->getDureeTrajet($voyage->heureDepart, $voyage->trajet->distance); ?> à <?php echo $voyage->trajet->arrivee; ?>
            </h5>

            <p class="card-text">
                <?php echo $voyage->tarif; ?> €
            </p>

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
                <button class="book" value="<?php echo $voyage->id; ?>">Réserver</button>
            <?php endif; ?>
        </div>
    </div>

    <?php endif; ?>

<?php endforeach; ?>

<?php foreach($context->voyagesCorrespondance as $correspance): ?>

    <p>
    <?php foreach($correspance as $voyage): ?>
        <?php echo $voyage->trajet->arrivee ?>
        <i class="fas fa-caret-right" aria-hidden="true"></i>

    <?php endforeach; ?>
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