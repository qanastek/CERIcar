<p class="titleSearch">Quelle est votre destination exacte ?</p>

<div class="centeredSearch text-center">
    <div class="form-group">

        <div>
            <input 
                type="text"
                class="form-control to fieldSearchInput"
                list="citiesTo"
                name="to"
                autocomplete=off
                id="to"
                style="background-color: rgb(237, 237, 237);"
                placeholder="Ville de d'arrivé..."
                value="<?php echo (isset($_SESSION["to"])) ? $_SESSION["to"] : ""; ?>"
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

    <a class="toSubmit button-classic" style="color: #ffffff;" role="button">
        Suivant
    </a>
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