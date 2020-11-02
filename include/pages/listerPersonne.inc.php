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
            </tr>
    <?php
        }
    ?>
    </tbody>
</table>
