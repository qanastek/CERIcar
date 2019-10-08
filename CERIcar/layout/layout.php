<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
  <head>
    
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
   
    <!-- Title in the tab -->
    <title>
     <?php echo $nameApp; ?>
    </title>
   
  </head>

  <body>

    <!-- Bandeau -->
    <?php if($context->notification): ?>
      <div class="alert alert-<?php echo $context->notification_status; ?>" role="alert">
        <?php echo " $context->notification" ?>
      </div>
    <?php endif; ?>

    <h2>Super c'est ton appli ! </h2>

    <!-- Si l'utilisateur à la session de connection -->
    <?php if($context->getSessionAttribute('user_id')): ?>
	   <?php echo $context->getSessionAttribute('user_id') . " est connecte"; ?>
    <?php endif; ?>

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
      
  </body>

</html>
