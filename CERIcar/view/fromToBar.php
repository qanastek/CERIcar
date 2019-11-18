<a class="fieldSearch mb-3 searchVoyage" role="button">
    <i class="fas fa-search"></i>
    &nbsp;
    <?php echo $context->getSessionAttribute("from"); ?>
    &nbsp;
    <i class="fas fa-caret-right"></i>
    &nbsp;
    <?php echo $context->getSessionAttribute("to"); ?>
</a>

<script>
$(".searchVoyage").click(function(){
    $.get( "monApplicationAjax.php?action=searchVoyage", function(data) {
        $( "#mainContent" ).html( data );

        $.get( "monApplicationAjax.php?action=banner", function(banner) {
            $( "#statusBar" ).html( banner );
        });
    });
});
</script>