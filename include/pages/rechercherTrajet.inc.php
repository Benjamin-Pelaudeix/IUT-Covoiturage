<?php
if (session_status() == PHP_SESSION_ACTIVE) {
    if (empty($_SESSION['username'])) {
        header('url: index.php&page=home');
    }
    else {
    $db = new Mypdo();
    $villeManager = new VilleManager($db);
    $proposeManager = new ProposeManager($db);
    $personneManager = new PersonneManager($db);
    $listeVille = $villeManager->getAllVilleDepartWhereExistTrajet();
    if (!empty($_POST["villeDepart"]))
        $_SESSION['villeDepart'] = $_POST["villeDepart"];
?>
<h1>Rechercher un trajet</h1>
<?php
    #Contrôle si les données renvoyées par le formulaire sont vides
    if (empty($_SESSION['villeDepart'])) {
?>
<form action="index.php?page=rechercherTrajet" method="post">
    <div>
        <label for="villeDepart">Ville de départ : </label>
        <br>
        <select name="villeDepart" id="villeDepart">
            <?php
                foreach ($listeVille as $ville) {
            ?>
                    <option value="<?php echo $ville->getNumero() ?>"><?php echo $ville->getNom() ?></option>
            <?php
                }
            ?>
        </select>
    </div>
    <input type="submit" value="Valider">
</form>
<?php
    }
    else {
        $villeDepart = new Ville($villeManager->getVilleFromId($_SESSION['villeDepart']));
        $listeVilleArrivee = $villeManager->getAllVilleArriveeWhereExistTrajetFromVille1($_SESSION['villeDepart']);
        if (empty($_POST["villeArrivee"]) || empty($_POST["dateDepart"]) || empty($_POST["precision"]) && empty($_POST["aPartirDe"])) {
?>
        <form action="index.php?page=rechercherTrajet" method="post" id="gridForm">
            <div>
                <label>Ville de départ :</label>
                <label><?php echo $villeDepart->getNom(); ?></label>
                <label for="villeArrivee">Ville d'arrivée : </label>
                <select name="villeArrivee" id="villeArrivee">
                    <?php
                    foreach ($listeVilleArrivee as $ville) {
                        ?>
                        <option value="<?php echo $ville->getNumero() ?>"><?php echo $ville->getNom() ?></option>
                        <?php
                    }
                    ?>
                </select>
            </div>
            <div>
                <label for="dateDepart">Date de départ : </label>
                <input type="date" name="dateDepart" id="dateDepart" value="<?php echo date('Y-m-d')?>">
                <label for="precision">Précision : </label>
                <select name="precision" id="precision">
                    <option value="0">Ce jour</option>
                    <option value="1">+/- 1 jour</option>
                    <option value="2">+/- 2 jours</option>
                    <option value="3">+/- 3 jours</option>
                </select>
            </div>
            <div>
                <label for="aPartirDe">A partir de : </label>
                <select name="aPartirDe" id="aPartirDe">
                    <?php
                        for ($i=0; $i<24; $i++) {
                    ?>
                            <option value="<?php echo $i . ':' . 00 . ':' . 00 ?>"><?php echo $i . 'h' ?></option>
                    <?php
                        }
                    ?>
                </select>
            </div>
            <input type="submit" value="Valider">
        </form>
<?php
        }
        else {
               $listeTrajet = $proposeManager->getAllExistTrajet($_SESSION['villeDepart'], $_POST["villeArrivee"], $_POST["dateDepart"], $_POST["precision"], $_POST["aPartirDe"]);
               if (count($listeTrajet) == 0) {
?>
                   <p><img src="image/erreur.png" alt="Error Cross">Désolé, pas de trajet disponible !</p>
<?php
                   unset($_SESSION['villeDepart']);
                   header('Refresh: 1.5; url = index.php?page=rechercherTrajet');
               }
               else {
?>
                   <table id="parcours_possibles">
                       <thead>
                            <tr>
                                <th>Ville départ</th>
                                <th>Ville arrivée</th>
                                <th>Date départ</th>
                                <th>Heure départ</th>
                                <th>Nombre de place(s)</th>
                                <th>Nom du covoitureur</th>
                            </tr>
                       </thead>
                       <tbody>
                       <?php
                            foreach ($listeTrajet as $trajet) {
                                $conducteur = new Personne($personneManager->getPersonneFromId($trajet->getNumeroPersonne()));
                       ?>
                                <tr>
                                    <td><?php echo $trajet->getVilleDepart() ?></td>
                                    <td><?php echo $trajet->getVilleArrivee() ?></td>
                                    <td><?php echo $trajet->getDate() ?></td>
                                    <td><?php echo $trajet->getHeure() ?></td>
                                    <td><?php echo $trajet->getNombrePlaces() ?></td>
                                    <td title="<?php echo 'Moyenne des notes : ' . $conducteur->getNote() . ', Dernier commentaire : ' . $conducteur->getCommentaire() ?>"><?php echo $conducteur->getNom() ?></td>
                                </tr>
                       <?php
                            }
                       ?>
                       </tbody>
                   </table>
<?php
               }
?>
<?php
        }
    }
    }
}
else {
    header('Location: ../../index.php');
}
?>    
