<nav class="navbar navbar-dark bg-dark navbar-expand-lg">

    <a class="navbar-brand" href="monApplication.php?action=index">CERIcar</a>

    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
        <div class="navbar-collapse collapse w-100 order-2">
            <ul class="navbar-nav ml-auto">

                <li class="nav-item">
                    <a class="nav-link" href="monApplication.php?action=searchVoyage">Rechercher</a>
                </li>

                <?php if($context->getSessionAttribute('user_id')): ?>
                <li class="nav-item">
                    <a class="nav-link" href="monApplication.php?action=logout">Deconnection</a>
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