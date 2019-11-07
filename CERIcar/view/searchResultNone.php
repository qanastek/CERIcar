<div class="centeredSearch">

<a class="fieldSearch mb-3 searchVoyage" role="button">
    <i class="fas fa-search"></i>
    &nbsp;
    <?php echo $context->getSessionAttribute("from"); ?>
    &nbsp;
    <i class="fas fa-caret-right"></i>
    &nbsp;
    <?php echo $context->getSessionAttribute("to"); ?>
</a>

<div class="text-center">
    <img src="undraw_not_found_60pq.svg" style="width: 25em;">
    <h1 class="titleSearch">Pas de voyages trouver.</h1>
</div>

</div>

<script>
$(".searchVoyage").click(function(){
    $.get( "monApplicationAjax.php?action=searchVoyage", function(data) {
        $( "#mainContent" ).html( data );
    });
});
</script>