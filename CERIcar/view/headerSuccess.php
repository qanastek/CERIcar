<nav class="navbar navbar-dark bg-dark navbar-expand-lg">

    <a class="navbar-brand home" style="color: white !important;">CERIcar</a>

    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
        <div class="navbar-collapse collapse w-100 order-2">
            <ul class="navbar-nav ml-auto">

                <li class="nav-item">
                    <a class="nav-link searchVoyage">Rechercher</a>
                </li>

                <?php if(isset($_SESSION["user_id"])): ?>
                <li class="nav-item">
                    <a class="nav-link offerSeats">Proposer un voyage</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link profile"><?php echo $context->getSessionAttribute('user_login'); ?></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link logout">Deconnection</a>
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
</script>