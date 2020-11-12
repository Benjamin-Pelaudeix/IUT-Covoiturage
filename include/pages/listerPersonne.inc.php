<?php
    $db = new Mypdo();
    $personneManager = new PersonneManager($db);
    $listePersonne = $personneManager->getAllPersonne();
?>
<h1>Liste des personnes enregistrées</h1>
<p>Actuellement <?php echo count($listePersonne) ?> personnes enregistrées</p>
<table>
    <thead>
        <tr>
            <th>Numéro</th>
            <th>Nom</th>
            <th>Prénom</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
    <?php
        foreach ($listePersonne as $personne) {
    ?>
            <tr>
                <td><a href="index.php?page=afficherPersonne&id=<?php echo $personne->getNumero() ?>"><?php echo $personne->getNumero() ?></a></td>
                <td><?php echo $personne->getNom() ?></td>
                <td><?php echo $personne->getPrenom() ?></td>
                <td>
                    <a href="index.php?page=modifierPersonne&id=<?php echo $personne->getNumero() ?>"><i class="fas fa-user-edit" title="Modifier"></i></a>
                    <a href="index.php?page=supprimerPersonne&id=<?php echo $personne->getNumero() ?>"><i class="fas fa-user-times" title="Supprimer"></i></a>
                </td>
            </tr>
    <?php
        }
    ?>
    </tbody>
</table>
