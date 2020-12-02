<?php
if (session_status() == PHP_SESSION_ACTIVE) {
    $db = new Mypdo();
    $parcoursManager = new ParcoursManager($db);
    $listeParcours = $parcoursManager->getAllParcours();
?>
<h1>Liste des parcours proposés</h1>
<p>Actuellement <?php echo count($listeParcours) ?> sont enregistrés</p>
<table>
    <thead>
        <tr>
            <th>Numéro</th>
            <th>Ville 1</th>
            <th>Ville 2</th>
            <th>Kilomètres</th>
        </tr>
    </thead>
    <tbody>
    <?php
        foreach ($listeParcours as $parcours) {
    ?>
            <tr>
                <td><?php echo $parcours->getNumero() ?></td>
                <td><?php echo $parcours->getVille1() ?></td>
                <td><?php echo $parcours->getVille2() ?></td>
                <td><?php echo $parcours->getKilometrage() ?></td>
            </tr>
    <?php
        }
    ?>
    </tbody>
</table>
<?php
}
else {
    header('Location: ../../index.php');
}