<div class="row" style="position: relative;">
    <div 
        class="header-img" 
        style="
            background-image: url(<?php echo $context->getImages($nameApp, 'index.jpg'); ?>);
            width: 100%;
            background-size: cover;
            background-position: center;
        "
    >
        <div class="header-content text-center pb-5">
            <p class="header-title">Et vous, qui allez-vous retrouver ?</p>
            <p class="header-subtitle">Bus ou covoiturage : choisissez le trajet qui vous convient le mieux</p>
            <a class="searchButton button-classic" style="color: #ffffff;" role="button">
                Rechercher un trajet
            </a>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="motto-index-0">
            <h4>Vers plus de 300 villes, nos conducteurs vous emmènent à petits prix.</h4>
            <p>Chaque semaine, chaque mois. Pour une réunion importante ou juste parce que vous avez envie de voir un nouvel endroit. Avec une grande famille. Ou un gros bagage. Vers la mer comme…</p>
        </div>
    </div>
</div>

<div class="row motto">
    <div class="col-6" style="padding: 0px;">
        <img src="<?php echo $context->getImages($nameApp, 'pic1.jpg'); ?>" class="motto-img">
    </div>
    <div class="col-6" style="background-color: rgb(245, 246, 247);">
        <div class="motto-content">
            <h2 class="motto-title">Avoir le choix</h2>
            <p class="motto-text">L'avantage des routes ? Elles vont partout ! Littéralement. Profitez de milliers de destinations.</p>
        </div>
    </div>
</div>

<div class="row motto">
    <div class="col-6" style="background-color: rgb(245, 246, 247);">
        <div class="motto-content">
            <h2 class="motto-title">Communauté</h2>
            <p class="motto-text">Nous connaissons chacun de nos membres et de nos partenaires de bus. Comment ? Nous vérifions profils, avis, et pièces d'identité. Vous savez ainsi avec qui vous voyagez.</p>
        </div>
    </div>
    <div class="col-6" style="padding: 0px;">
        <img src="<?php echo $context->getImages($nameApp, 'pic2.jpg'); ?>" class="motto-img">
    </div>
</div>

<div class="row motto">
    <div class="col-6" style="padding: 0px;">
        <img src="<?php echo $context->getImages($nameApp, 'pic3.jpg'); ?>" class="motto-img">
    </div>
    <div class="col-6" style="background-color: rgb(245, 246, 247);">
        <div class="motto-content">
            <h2 class="motto-title">Assurance</h2>
            <p class="motto-text">Assurez votre voiture à l'année avec BlaBlaSure : profitez de couvertures conçues pour les covoitureurs avec AXA à des tarifs très compétitifs !</p>
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