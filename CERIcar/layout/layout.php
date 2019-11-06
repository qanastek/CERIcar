<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
  <head>
    
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

    <link rel="stylesheet" href="<?php echo $nameApp; ?>/view/css/app.css">

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <!-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script> -->

      
    <!-- Font awsome -->
    <script src="<?php echo $nameApp; ?>/view/js/fontawesome.js"></script>

    <!-- JQuery -->
    <script src="<?php echo $nameApp; ?>/view/js/jquery-3.4.1.js"></script>
    <script src="<?php echo $nameApp; ?>/view/js/app.js"></script>
    
    <!-- Title in the tab -->
    <title>
     <?php echo $nameApp; ?>
    </title>
   
  </head>

  <body>

    <header>
      <?php include($context->getViewport("header")); ?>
    </header>

    <?php include($context->getViewport("statusBar")); ?>

    <div id="mainContent">
      <?php include($template_view); ?>
    </div>

    <footer>
      <?php include($context->getViewport("footer")); ?>
    </footer>
      
  </body>

</html>
