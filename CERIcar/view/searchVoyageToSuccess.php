<p class="titleSearch">Quelle est votre destination exacte ?</p>

<form action="monApplication.php?action=searchVoyageTo" method="POST">
    <div class="form-group">

        <label for="to">Arrivée</label>

        <div class="fieldSearchWrapper">
            <input 
                type="text"
                class="form-control"
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
            <option id="<?php echo $trajet->arrivee; ?>">
                <?php echo $trajet->arrivee; ?>
            </option>
            <?php endforeach; ?>
        </datalist>
    </div>
    
    <br>

    <button type="submit" class="btn btn-primary">Suivant</button>
</form>