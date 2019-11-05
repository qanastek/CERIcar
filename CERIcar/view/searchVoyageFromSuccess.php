<p class="titleSearch">D'où partez-vous exactement ?</p>

<form action="monApplication.php?action=searchVoyageFrom" method="POST">
    <div class="form-group">

        <label for="from">Départ</label>

        <div class="fieldSearchWrapper">
            <input 
                type="text"
                class="form-control"
                list="citiesFrom"
                name="from"
                autocomplete=off
                id="from"
                placeholder="Ville de départ..."
                value="<?php echo (isset($_SESSION["from"])) ? $_SESSION["from"] : "Ville de départ"; ?>"
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

    <button type="submit" class="btn btn-primary">Suivant</button>
</form>