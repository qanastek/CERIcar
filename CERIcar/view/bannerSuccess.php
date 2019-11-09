<!-- Bandeau -->
<?php if(isset($_SESSION["notification"]) && isset($_SESSION["notification_status"])): ?>
    <div class="alert alert-<?php echo $context->getErrorStatus(); ?>" role="alert">
        <p id="error_message">
            <?php echo $context->getErrorMessage(); ?>
        </p>
    </div>
<?php endif; ?>

<!-- Si il y a une erreur -->
<?php if($context->error): ?>
<div id="flash_error" class="error">
    <?php echo " $context->error !!!!!" ?>
</div>
<?php endif; ?>