<p class="titleSearch">Quelle est votre destination exacte ?</p>

<div>
    <div class="form-group">

        <label for="to">Arrivée</label>

        <div class="fieldSearchWrapper">
            <input 
                type="text"
                class="form-control to"
                list="citiesTo"
                name="to"
                autocomplete=off
                id="to"
                placeholder="Ville de d'arrivé..."
                value="<?php echo (isset($_SESSION["to"])) ? $_SESSION["to"] : "Ville d'arrivé"; ?>"
            >
        </div>

        <datalist id="citiesTo">
            <?php foreach($context->allTo as $trajet): ?>
            <option id="<?php echo $trajet["arrivee"]; ?>">
                <?php echo $trajet["arrivee"]; ?>
            </option>
            <?php endforeach; ?>
        </datalist>
    </div>
    
    <br>

    <button class="btn btn-primary toSubmit">Suivant</button>
</div>

<script>
$(".toSubmit").click(function(){

    var to = $(".to").val();

    $.ajax({
        url: "monApplicationAjax.php?action=searchVoyageTo",
        type: "post",
        data: {
            "to": to
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