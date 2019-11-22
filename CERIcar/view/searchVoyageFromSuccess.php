<p class="titleSearch">D'où partez-vous exactement ?</p>

<div>
    <div class="form-group">

        <label for="from">Départ</label>

        <div class="fieldSearchWrapper">
            <input 
                type="text"
                class="form-control from fieldSearch"
                list="citiesFrom"
                name="from"
                autocomplete=off
                id="from"
                placeholder="Ville de départ..."
                value="<?php echo (isset($_SESSION["from"])) ? $_SESSION["from"] : ""; ?>"
            >
        </div>

        <datalist id="citiesFrom">
            <?php foreach($context->allFrom as $trajet): ?>
                <option id="<?php echo $trajet["depart"]; ?>">
                    <?php echo $trajet["depart"]; ?>
                </option>
            <?php endforeach; ?>
        </datalist>
    </div>
    
    <br>

    <button class="btn btn-primary fromSubmit">Suivant</button>
</div>

<script>
$(".fromSubmit").click(function(){

    var from = $(".from").val();

    $.ajax({
        url: "monApplicationAjax.php?action=searchVoyageFrom",
        type: "post",
        data: {
            "from": from
        },
        success: function(response) {
            $.get( "monApplicationAjax.php?action=searchVoyage", function(data) {
                $( "#mainContent" ).html( data );
            });
        },
        error: function(xhr) {
            console.log("fail");
        }
    });
});
</script>