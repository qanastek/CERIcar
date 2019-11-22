<div style="position: relative;">
    <div 
        class="header-img" 
        style="
            background-image: url(<?php echo $context->getImages($nameApp, 'index.jpg'); ?>);
            width: 100%;
            background-size: cover;
            background-position: center;
        "
    >
        <div class="text-center pb-5" style="color: #ffffff; position: absolute; width: 100%; bottom: 0; z-index: 2; background: linear-gradient(0deg, rgba(0, 0, 0, .4) 72%, rgba(0, 0, 0, .2) 85%, rgba(0, 0, 0, 0) 100%);">
            <p style="font-size: 3em; font-weight: 700; margin: 0%;">Et vous, qui allez-vous retrouver ?</p>
            <p style="font-size: 1.25em; font-weight: 600;">Bus ou covoiturage : choisissez le trajet qui vous convient le mieux</p>
            <a class="searchButton button-classic" style="color: #ffffff;" role="button">
                Rechercher un trajet
            </a>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div style="padding-left: 25%; padding-right: 25%; padding-top: 3%; padding-bottom: 3%; text-align: center;">
            <h4 style="font-weight: 700; font-size: 23px; color: #21314D;">Vers plus de 300 villes, nos conducteurs vous emmènent à petits prix.</h4>
            <p style="font-size: 17px; line-height: 1.5em; color: #8C8A8C;">Chaque semaine, chaque mois. Pour une réunion importante ou juste parce que vous avez envie de voir un nouvel endroit. Avec une grande famille. Ou un gros bagage. Vers la mer comme…</p>
        </div>
    </div>
</div>

<div class="row motto">
    <div class="col-md-6" style="padding: 0px;">
        <img src="<?php echo $context->getImages($nameApp, 'pic1.jpg'); ?>" style="width: 100%; overflow: hidden; object-fit: cover;">
    </div>
    <div class="col-md-6" style="background-color: rgb(245, 246, 247);">
        <div style="max-width: 60%; text-align: center; margin-left: auto; margin-right: auto; margin-top: 25%; margin-bottom: auto;">
            <h2 style="color: #21314D; font-size: 32px; font-weight: 700;">Avoir le choix</h2>
            <p style="color: #8C8A8C; font-size: 19px;">L'avantage des routes ? Elles vont partout ! Littéralement. Profitez de milliers de destinations.</p>
        </div>
    </div>
</div>

<div class="row motto">
    <div class="col-md-6" style="background-color: rgb(245, 246, 247);">
        <div style="max-width: 60%; text-align: center; margin-left: auto; margin-right: auto; margin-top: 25%; margin-bottom: auto;">
            <h2 style="color: #21314D; font-size: 32px; font-weight: 700;">Communauté</h2>
            <p style="color: #8C8A8C; font-size: 19px;">Nous connaissons chacun de nos membres et de nos partenaires de bus. Comment ? Nous vérifions profils, avis, et pièces d'identité. Vous savez ainsi avec qui vous voyagez.</p>
        </div>
    </div>
    <div class="col-md-6" style="padding: 0px;">
        <img src="<?php echo $context->getImages($nameApp, 'pic2.jpg'); ?>" style="width: 100%; overflow: hidden; object-fit: cover;">
    </div>
</div>

<div class="row motto">
    <div class="col-md-6" style="padding: 0px;">
        <img src="<?php echo $context->getImages($nameApp, 'pic3.jpg'); ?>" style="width: 100%; overflow: hidden; object-fit: cover;">
    </div>
    <div class="col-md-6" style="background-color: rgb(245, 246, 247);">
        <div style="max-width: 60%; text-align: center; margin-left: auto; margin-right: auto; margin-top: 25%; margin-bottom: auto;">
            <h2 style="color: #21314D; font-size: 32px; font-weight: 700;">Assurance</h2>
            <p style="color: #8C8A8C; font-size: 19px;">Assurez votre voiture à l'année avec BlaBlaSure : profitez de couvertures conçues pour les covoitureurs avec AXA à des tarifs très compétitifs !</p>
        </div>
    </div>
</div>

<script>
$(".helloWorld").click(function(){
    $.ajax({
        url: "monApplicationAjax.php?action=helloWorld",
        type: "get",
        data: {},
        success: function(response) {
            $( "#mainContent" ).html(response);
        },
        error: function(xhr) {
            console.log("fail");
        }
    });
});

$(".superTest").click(function(){
    $.get( "monApplicationAjax.php?action=superTest&param1=yanis&param2=labrak", function(data) {
        $( "#mainContent" ).html( data );
    });
});

$(".searchVoyage").click(function(){
    $.get( "monApplicationAjax.php?action=searchVoyage", function(data) {
        $( "#mainContent" ).html( data );
    });
});

$(".searchButton").click(function(){
    $.get( "monApplicationAjax.php?action=searchVoyage", function(data) {
        $( "#mainContent" ).html( data );
    });
});
</script>