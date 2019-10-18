<p>
    From: <?php echo $context->from; ?>
</p>
<p>
    To: <?php echo $context->to; ?>
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