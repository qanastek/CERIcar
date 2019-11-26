<div class="centeredSearch pb-4">

    <h3 class="pb-3">Publier une annonce</h3>

    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12 col-xl-12 card mb-3" style="padding: 0px;">
            <div class="card-header seats">
                Itinéraire
            </div>

            <div style="background-color: #EDEDED; color: #054752; padding: 3%;">
                <div class="form-group">
                    <label for="from">D’où partez-vous ?</label>
                    <input type="text" list="citiesFrom" class="form-control" id="from" placeholder="Paris">
                    
                    <datalist id="citiesFrom">
                        <?php foreach($context->citiesFrom as $trajet): ?>
                            <option id="<?php echo $trajet["depart"]; ?>">
                                <?php echo $trajet["depart"]; ?>
                            </option>
                        <?php endforeach; ?>
                    </datalist>
                </div>

                <div class="form-group">
                    <label for="to">Où allez-vous ?</label>
                    <input type="text" list="citiesTo" class="form-control" id="to" placeholder="Lyon">

                    <datalist id="citiesTo">
                        <?php foreach($context->citiesTo as $trajet): ?>
                            <option id="<?php echo $trajet["arrivee"]; ?>">
                                <?php echo $trajet["arrivee"]; ?>
                            </option>
                        <?php endforeach; ?>
                    </datalist>
                </div>
            </div>
        </div>
    </div>
    
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12 col-xl-12 card mb-3" style="padding: 0px;">
            <div class="card-header seats">
                Horaire
            </div>

            <div style="background-color: #EDEDED; color: #054752; padding: 3%;">
                <div class="form-group">
                    <label for="fromHour">Heure de l'aller :</label>
                    <select class="custom-select" id="fromHour">
                        <option selected value="0">00:00</option>
                        <option value="1">01:00</option>
                        <option value="2">02:00</option>
                        <option value="3">03:00</option>
                        <option value="4">04:00</option>
                        <option value="5">05:00</option>
                        <option value="6">06:00</option>
                        <option value="7">07:00</option>
                        <option value="8">08:00</option>
                        <option value="9">09:00</option>
                        <option value="10">10:00</option>
                        <option value="11">11:00</option>
                        <option value="12">12:00</option>
                        <option value="13">13:00</option>
                        <option value="14">14:00</option>
                        <option value="15">15:00</option>
                        <option value="16">16:00</option>
                        <option value="17">17:00</option>
                        <option value="18">18:00</option>
                        <option value="19">19:00</option>
                        <option value="20">20:00</option>
                        <option value="21">21:00</option>
                        <option value="22">22:00</option>
                        <option value="23">23:00</option>
                    </select>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12 col-xl-12 card mb-3" style="padding: 0px;">
            <div class="card-header seats">
                Informations du trajet
            </div>

            <div style="background-color: #EDEDED; color: #054752; padding: 3%;">
                <div class="form-group">
                    <label for="price">Prix par passager :</label>
                    <input type="number" class="form-control" id="price" value="41">
                </div>

                <div class="form-group">
                    <label for="seats">Nombre de places proposées :</label>
                    <input type="number" class="form-control" id="seats" value="3">
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12 col-xl-12 card mb-3" style="padding: 0px;">
            <div class="card-header seats">
                Contraintes
            </div>

            <div style="background-color: #EDEDED; color: #054752; padding: 3%;">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="nosmoking" id="nosmoking">
                    <label class="form-check-label" for="nosmoking">Interdiction de fumer</label>
                </div>

                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="noanimals" id="noanimals">
                    <label class="form-check-label" for="noanimals">Animaux interdits</label>
                </div>

                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="noguns" id="noguns">
                    <label class="form-check-label" for="noguns">Armes interdites</label>
                </div>
            </div>
        </div>
    </div>

    <button id="submit" class="btn btn-primary mt-3" style="background-color: #00AFF5; border-color: #00AFF5;">Publier</button>

</div>

<script>
$("#submit").click(function(){

    var cityFrom = $("#from").val();
    var cityTo = $("#to").val();

    var fromHour = $("#fromHour").val();

    var price = $("#price").val();
    var seats = $("#seats").val();

    if (cityFrom == "" || cityTo == "" || fromHour == "" || price == "" || seats == "") {
        alert("Le formulaire est incompler.");
    }
    else {

        if (price <= 14 || price >= 300) {
            alert("Prix incorrect.");
        }
        else if (seats < 1 || seats > 10) {
            alert("Nombre de sièges incorrect.");            
        }
        else {

            var constraintsArray = [];

            if ($("#nosmoking").prop('checked')) {
                constraintsArray.push($("#nosmoking").val());                
            }

            if ($("#noanimals").prop('checked')) {
                constraintsArray.push($("#noanimals").val());               
            }

            if ($("#noguns").prop('checked')) {
                constraintsArray.push($("#noguns").val());               
            }

            var constraints = constraintsArray.join('|');

            $.ajax({
                url: "monApplicationAjax.php?action=offerSeats",
                type: "post",
                data: {
                    "cityFrom": cityFrom,
                    "cityTo": cityTo,

                    "fromHour": fromHour,

                    "price": price,
                    "seats": seats,

                    "contraints": constraints
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
    }
});
</script>