j’ai compris <?php echo $context->param1; ?> ,super: <?php echo $context->param2; ?>

<a role="button" href="monApplication.php?action=index" class="btn btn-primary">index</a>

<p>Le trajet:</p>
<?php echo $context->trajet->distance; ?>

<p>Les voyages:</p>

<?php foreach($context->voyages as $voyage): ?>
<p>conducteur: <?php echo $voyage->conducteur; ?></p>
<?php endforeach; ?>

<p>Les reservations:</p>

<?php foreach($context->reservations as $reservation): ?>
<p>voyageur: <?php echo $reservation->voyageur; ?></p>
<?php endforeach; ?>

<p>user1: <?php echo $context->user1->nom; ?></p>
<p>user2: <?php echo $context->user2->nom; ?></p>