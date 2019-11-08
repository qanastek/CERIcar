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
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js" integrity="sha256-T0Vest3yCU7pafRw9r+settMBX6JkKN06dqBnpQ8d30=" crossorigin="anonymous"></script>

    <!-- Title in the tab -->
    <title>
     <?php echo $nameApp; ?>
    </title>
   
  </head>

  <body>

    <header class="pb-3">
      <?php include($context->getViewport("header")); ?>
    </header>

    <main>

      <div id="statusBar">
        <?php include($context->getViewport("statusBar")); ?>
      </div>

      <div id="mainContent" style="min-height: 80vh;">
        <?php include($template_view); ?>
      </div>

    </main>

    <footer class="pt-3">
      <?php include($context->getViewport("footer")); ?>
    </footer>
      
  </body>

</html>
