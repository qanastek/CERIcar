<div class="centeredSearch">

<?php include($nameApp . "/view/components/fromToBar.php"); ?>

<p>
    <?php echo count($context->voyages); ?> voyages disponible
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
        </div>
    </div>

    <?php endif; ?>

<?php endforeach; ?>

</div>