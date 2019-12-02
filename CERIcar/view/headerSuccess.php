<nav class="navbar navbar-expand-lg bg-white navbar-light bg-light">

  <a class="navbar-brand home">
    <img src="<?php echo $context->getImages($nameApp, 'logo_cericar.PNG'); ?>" style="width: 75%;">
  </a>

  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav ml-auto mr-0">
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