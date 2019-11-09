<p>
    <?php echo $context->user->id; ?>
</p>
<p>
    <?php echo $context->user->identifiant; ?>
</p>
<p>
    <?php echo $context->user->nom; ?>
</p>
<p>
    <?php echo $context->user->prenom; ?>
</p>
<?php if($context->user->avatar): ?>
    <img alt="" class="avatar" src="<?php echo $context->getImages($nameApp, $context->user->avatar); ?>">
<?php endif; ?>