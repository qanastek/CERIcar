<div class="centeredSearch">

<?php include($nameApp . "/view/components/fromToBar.php"); ?>

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

</div>