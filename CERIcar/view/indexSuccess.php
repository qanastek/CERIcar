<img src="<?php echo $context->getImages($nameApp, 'index.jpg'); ?>" style="width: 100%; height: 75vh; overflow: hidden; object-fit: cover;">

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
</script>