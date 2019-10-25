<p>
    From: <?php echo (isset($_SESSION["from"])) ?  $_SESSION["from"] : "Vide"; ?>
</p>
<p>
    To: <?php echo (isset($_SESSION["to"])) ?  $_SESSION["to"] : "Vide"; ?>
</p>

<form action="monApplication.php?action=searchVoyageFrom" method="POST">
    <div class="form-group">
        <label for="from">Départ</label>
        <input type="text" class="form-control" list="citiesFrom" name="from" autocomplete=off id="from" placeholder="Ville de départ...">

        <datalist id="citiesFrom">
            <?php foreach($context->allFrom as $trajet): ?>
            <option id="<?php echo $trajet->depart; ?>">
                <?php echo $trajet->depart; ?>
            </option>
            <?php endforeach; ?>
        </datalist>
    </div>
    
    <br>

    <button type="submit" class="btn btn-primary">Rechercher</button>
</form>