<nav class="navbar navbar-dark bg-dark navbar-expand-lg">

    <a class="navbar-brand home" style="color: white !important;">CERIcar</a>

    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
        <div class="navbar-collapse collapse w-100 order-2">
            <ul class="navbar-nav ml-auto">

                <li class="nav-item">
                    <a class="nav-link" class="searchVoyage">Rechercher</a>
                </li>

                <?php if($context->getSessionAttribute('user_id')): ?>
                <li class="nav-item">
                    <a class="nav-link" class="logout">Deconnection</a>
                </li>
                <?php endif; ?>

                <?php if(!$context->getSessionAttribute('user_id')): ?>
                <li class="nav-item">
                    <a class="nav-link" href="monApplication.php?action=register">Inscription</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="monApplication.php?action=login">Connexion</a>
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
    });
});

$(".searchVoyage").click(function(){
    $.get( "monApplicationAjax.php?action=searchVoyage", function(data) {
        $( "#mainContent" ).html( data );
    });
});

$(".logout").click(function(){
    $.get( "monApplicationAjax.php?action=logout", function(data) {
        $( "#mainContent" ).html( data );
    });
});
</script>