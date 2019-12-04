<p class="titleSearch">A combien voyagez-vous ?</p>

<div class="centeredSearch text-center">
    <div class="form-group">

        <div>
            <input 
                type="number"
                class="form-control seats fieldSearchInput"
                value="<?php echo (isset($_SESSION["seats"])) ? $_SESSION["seats"] : "1"; ?>"
                name="seats"
                id="seats"
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

    <a class="fromSubmit button-classic" style="color: #ffffff;" role="button">
        Suivant
    </a>
</div>

<script>
$(".fromSubmit").click(function(){

    var seats = $(".seats").val();

    if (seats <= 0) {
        alert("Nombre de places incorrects");
    } else {

        $.ajax({
            url: "monApplicationAjax.php?action=searchVoyageSeats",
            type: "post",
            data: {
                "seats": seats
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

    }
});
</script>