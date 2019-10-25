<!-- Bandeau -->
<?php if($context->notification): ?>
    <div class="alert alert-<?php echo $context->notification_status; ?>" role="alert">
    <?php echo " $context->notification" ?>
    </div>
<?php endif; ?>

<!-- Si l'utilisateur à la session de connection -->
<?php if($context->getSessionAttribute('user_id')): ?>
    <?php echo $context->getSessionAttribute('user_id') . " est connecte"; ?>
<?php endif; ?>

<!-- Si il y a une erreur -->
<?php if($context->error): ?>
<div id="flash_error" class="error">
    <?php echo " $context->error !!!!!" ?>
</div>
<?php endif; ?>