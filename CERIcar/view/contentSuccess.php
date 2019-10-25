<div id="page">

    <!-- Si il y a une erreur -->
    <?php if($context->error): ?>
    <div id="flash_error" class="error">
        <?php echo " $context->error !!!!!" ?>
    </div>
    <?php endif; ?>

    <div id="page_maincontent">	
        <?php include($template_view); ?>
    </div>

</div>