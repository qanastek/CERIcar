<!-- Bandeau -->
<?php if($context->notification): ?>
    <div class="alert alert-<?php echo $context->notification_status; ?>" role="alert">
    <?php echo " $context->notification" ?>
    </div>
<?php endif; ?>

<h2>Super c'est ton appli ! - Content </h2>

<!-- Si l'utilisateur à la session de connection -->
<?php if($context->getSessionAttribute('user_id')): ?>
    <?php echo $context->getSessionAttribute('user_id') . " est connecte"; ?>
<?php endif; ?>