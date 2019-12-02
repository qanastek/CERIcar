<nav class="navbar navbar-expand-lg bg-white navbar-light bg-light">

  <a class="navbar-brand">
    <img src="<?php echo $context->getImages($nameApp, 'logo_cericar.PNG'); ?>" style="width: 75%;">
  </a>

  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Link</a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Dropdown
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="#">Action</a>
          <a class="dropdown-item" href="#">Another action</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#">Something else here</a>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
      </li>
    </ul>
    <form class="form-inline my-2 my-lg-0">
      <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
    </form>
  </div>
</nav>


<nav class="navbar navbar-dark bg-white navbar-expand-lg">
    
    <a class="navbar-brand home">
        <img src="<?php echo $context->getImages($nameApp, 'logo_cericar.PNG'); ?>" style="width: 75%;">
    </a>

    <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#menuPrincipal">
        <i class="fas fa-bars" style="color:  rgb(0, 175, 245);"></i>
    </button>

    <div class="collapse navbar-collapse" id="menuPrincipal">
        <div class="nav navbar-nav navbar-collapse collapse w-100 order-2">
            <ul class="navbar-nav ml-auto">

                <li class="nav-item">
                    <a class="nav-link searchVoyage">
                        <i class="fas fa-search"></i>
                        Rechercher
                    </a>
                </li>

                <?php if(isset($_SESSION["user_id"])): ?>
                <li class="nav-item">
                    <a class="nav-link offerSeats">
                        <i class="fas fa-plus-circle"></i>
                        Proposer un voyage
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link profile">
                        <i class="far fa-user-circle"></i>
                        <?php echo $context->getSessionAttribute('user_login'); ?>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link logout">Déconnexion</a>
                </li>
                <?php endif; ?>
                
                <?php if(!isset($_SESSION["user_id"])): ?>
                <li class="nav-item">
                    <a class="nav-link register">Inscription</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link login">Connexion</a>
                </li>
                <?php endif; ?>

            </ul>
        </div>
    </div>

</nav>

<script>
$(".home").click(function(){
    $.get( "monApplicationAjax.php?action=index", function(data) {
        $( "#mainContent" ).html( data );
        
        $.get( "monApplicationAjax.php?action=banner", function(banner) {
            $( "#statusBar" ).html( banner );
        });
    });
});

$(".profile").click(function(){
    $.get( "monApplicationAjax.php?action=profile", function(data) {
        $( "#mainContent" ).html( data );
        
        $.get( "monApplicationAjax.php?action=banner", function(banner) {
            $( "#statusBar" ).html( banner );
        });
    });
});

$(".searchVoyage").click(function(){
    $.get( "monApplicationAjax.php?action=searchVoyage", function(data) {
        $( "#mainContent" ).html( data );
    });

    $.get( "monApplicationAjax.php?action=banner", function(banner) {
        $( "#statusBar" ).html( banner );
    });
});

$(".register").click(function(){
    $.get( "monApplicationAjax.php?action=register", function(data) {
        $( "#mainContent" ).html( data );
    });

    $.get( "monApplicationAjax.php?action=banner", function(banner) {
        $( "#statusBar" ).html( banner );
    });
});

$(".login").click(function(){
    $.get( "monApplicationAjax.php?action=login", function(data) {

        $( "#mainContent" ).html( data );

        $.get( "monApplicationAjax.php?action=banner", function(banner) {
            $( "#statusBar" ).html( banner );
        });
    });
});

$(".logout").click(function(){
    $.get( "monApplicationAjax.php?action=logout", function(data) {

        $.get( "monApplicationAjax.php?action=banner", function(banner) {
            $( "#statusBar" ).html( banner );     

            $.get( "monApplicationAjax.php?action=index", function(index) {
                $( "#mainContent" ).html(index);

                $.get( "monApplicationAjax.php?action=header", function(header) {
                    $( "#header" ).html(header);
                });
            });
        });

    });
});

$(".offerSeats").click(function(){
    $.get( "monApplicationAjax.php?action=offerSeats", function(data) {
        $( "#mainContent" ).html( data );
    });

    $.get( "monApplicationAjax.php?action=banner", function(banner) {
        $( "#statusBar" ).html( banner );
    });
});

$(".navbar-toggler").click(function(){
    $("#menuPrincipal").toggle();
});
</script>