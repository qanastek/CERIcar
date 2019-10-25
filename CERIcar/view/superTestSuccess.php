j’ai compris <?php echo $context->param1; ?> ,super: <?php echo $context->param2; ?>

<a role="button" href="monApplication.php?action=index" class="btn btn-primary">index</a>

<div>
    <b>Le trajet:</b>
    <p>
        <?php echo $context->trajet->distance; ?>
    </p>

    <b>Les voyages:</b>

    <?php foreach($context->voyages as $voyage): ?>
    <p>
        conducteur: <?php echo $voyage->conducteur->nom; ?>
    </p>
    <?php endforeach; ?>

    <b>Les reservations:</b>

    <?php foreach($context->reservations as $reservation): ?>
    <p>
        voyageur: <?php echo $reservation->voyageur->nom; ?>
    </p>
    <p>
        voyageur 2: <?php echo $reservation->voyage->trajet->arrivee; ?>
    </p>
    <?php endforeach; ?>

    <b>utilisateurTable:</b>

    <p>user1: <?php echo $context->user1->nom; ?></p>
    <p>user2: <?php echo $context->user2->nom; ?></p>
</div>