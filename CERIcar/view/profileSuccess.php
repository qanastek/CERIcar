<div style="padding-left: 10vw; padding-right: 10vw;">
    <h2>
        Profil public de <?php echo $context->user->identifiant; ?>
    </h2>

    <p>
        Nom: <?php echo $context->user->nom; ?>
    </p>

    <p>
        Prénom: <?php echo $context->user->prenom; ?>
    </p>

    <?php if($context->user->avatar): ?>
        <img alt="" class="avatar" src="<?php echo $context->getImages($nameApp, $context->user->avatar); ?>">
    <?php endif; ?>

    <h3>Liste des voyages éffectuer:</h3>

    <table class="table">
    <thead>
        <tr>
        <th scope="col">Départ</th>
        <th scope="col">Arrivée</th>
        <th scope="col">Prix</th>
        </tr>
    </thead>
    <tbody>

        <?php foreach($context->allReservation as $reservation): ?>
        <tr>
        <td><?php echo $reservation->voyage->trajet->depart; ?></td>
        <td><?php echo $reservation->voyage->trajet->arrivee; ?></td>
        <td><?php echo $reservation->voyage->tarif; ?></td>
        </tr>
        <?php endforeach; ?>

    </tbody>
    </table>
</div>