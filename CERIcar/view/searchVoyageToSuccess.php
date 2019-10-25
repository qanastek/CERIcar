<p>
    From: <?php echo (isset($_SESSION["from"])) ?  $_SESSION["from"] : "Vide"; ?>
</p>
<p>
    To: <?php echo (isset($_SESSION["to"])) ? $_SESSION["to"] : "Vide"; ?>
</p>

<form action="monApplication.php?action=searchVoyageTo" method="POST">
    <div class="form-group">
        <label for="to">Arrivé</label>
        <input type="text" class="form-control" list="citiesTo" name="to" autocomplete=off id="to" placeholder="Ville d'arrivé...">

        <datalist id="citiesTo">
            <?php foreach($context->allTo as $trajet): ?>
            <option id="<?php echo $trajet->arrivee; ?>">
                <?php echo $trajet->arrivee; ?>
            </option>
            <?php endforeach; ?>
        </datalist>
    </div>
    
    <br>

    <button type="submit" class="btn btn-primary">Rechercher</button>
</form>