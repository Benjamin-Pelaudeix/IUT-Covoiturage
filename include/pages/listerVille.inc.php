<?php
if (session_status() == PHP_SESSION_ACTIVE) {
    $db = new Mypdo();
    $villeManager = new VilleManager($db);
    $listeVille = $villeManager->getAllVille();
?>
<h1>Liste des villes</h1>
<p>Actuellement <?php echo count($listeVille) ?> villes sont enregistrées</p>
<table>
    <thead>
        <tr>
            <th>Numéro</th>
            <th>Nom</th>
        </tr>
    </thead>
    <tbody>
        <?php
            foreach ($listeVille as $ville) {
        ?>
                <tr>
                    <td><?php echo $ville->getNumero() ?></td>
                    <td><?php echo $ville->getNom() ?></td>
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