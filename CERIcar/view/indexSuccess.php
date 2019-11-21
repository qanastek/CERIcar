<div style="position:relative;">
    <div 
        style="
            background-image: url(<?php echo $context->getImages($nameApp, 'index.jpg'); ?>);
            width: 100%;
            height: 75vh;
            background-size: cover;
            background-position: center;
        "
    >
        <div class="text-center pb-5" style="color: #ffffff; position: absolute; width: 100%; bottom: 0; z-index: 2; background: linear-gradient(0deg, rgba(0, 0, 0, .4) 72%, rgba(0, 0, 0, .2) 85%, rgba(0, 0, 0, 0) 100%);">
            <p style="font-size: 3em; font-weight: 700; margin: 0%;">Et vous, qui allez-vous retrouver ?</p>
            <p style="font-size: 1.25em; font-weight: 600;">Bus ou covoiturage : choisissez le trajet qui vous convient le mieux</p>
            <a class="searchButton" style="color: #ffffff;" role="button">
                Rechercher un trajet
            </a>
        </div>
    </div>
</div>

C'est l'action par défaut ! 

<a role="button" class="btn btn-primary helloWorld">helloWorld</a>

<a role="button" class="btn btn-primary superTest">superTest</a>

<a role="button" class="btn btn-primary searchVoyage">Rechercher un voyage</a>

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