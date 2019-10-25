<div class="centeredSearch">

<a class="fieldSearch mb-3" href="monApplication.php?action=searchVoyage" role="button">
    <i class="fas fa-search"></i>
    &nbsp;
    <?php echo $context->getSessionAttribute("from"); ?>
    &nbsp;
    <i class="fas fa-caret-right"></i>
    &nbsp;
    <?php echo $context->getSessionAttribute("to"); ?>
</a>

<?php if(count($context->voyages) > 0): ?>

    <p>
        <?php echo count($context->voyages); ?> voyages disponible
    </p>

    <?php foreach($context->voyages as $voyage): ?>
        <div class="card mb-3" style="width: 100%;">
            <div class="card-body">

                <h5 class="card-title">
                    <?php echo $voyage->trajet->depart; ?> -> <?php echo $voyage->trajet->arrivee; ?>
                </h5>

                <p class="card-text">
                    <?php echo $voyage->tarif; ?> €
                </p>

                <p href="#" class="card-link">
                    <?php if($voyage->conducteur->avatar): ?>
                        <img alt="" class="avatar" src="<?php echo $voyage->conducteur->avatar; ?>">
                    <?php endif; ?>
                    <?php echo $voyage->conducteur->nom . " " . $voyage->conducteur->prenom; ?>
                </p>
            </div>
        </div>
    <?php endforeach; ?>

<?php else: ?>

    <div class="text-center">
        <img src="undraw_not_found_60pq.svg" style="width: 25em;">
        <h1 class="titleSearch">Pas de voyages trouver.</h1>
    </div>

<?php endif; ?>

</div>