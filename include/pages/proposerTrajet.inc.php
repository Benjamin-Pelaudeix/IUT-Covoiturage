<?php
    $db = new Mypdo();
    $villeManager = new VilleManager($db);
    $parcoursManager = new ParcoursManager($db);
    $proposeManager = new ProposeManager($db);
    $listeVille = $villeManager->getAllVilleWhereExistParcours();
    if (!empty($_POST["villeDepart"]))
        $_SESSION['villeDepart'] = $_POST["villeDepart"];
?>
    <h1>Proposer un trajet</h1>
<?php
    #Contrôle si les données renvoyées par le formulaire sont vides
    if (empty($_SESSION["villeDepart"])) {
?>
        <form action="index.php?page=proposerTrajet" method="post">
            <div>
                <label for="villeDepart">Ville de départ : </label>
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
        $listeParcours = $parcoursManager->getParcoursVille2FromVille1($_SESSION['villeDepart']);
        if (empty($_POST["villeArrivee"]) || empty($_POST["dateDepart"]) || empty($_POST["heureDepart"]) || empty($_POST["nombrePlaces"])) {
?>
            <form action="index.php?page=proposerTrajet" method="post" id="gridForm">
                <div>
                    <label>Ville de départ :</label>
                    <label><?php echo $villeDepart->getNom(); ?></label>
                    <label for="villeArrivee">Ville d'arrivée : </label>
                    <select name="villeArrivee" id="villeArrivee">
                        <?php
                        foreach ($listeParcours as $parcours) {
                            ?>
                            <option value="<?php echo $parcours->getVille1() ?>"><?php echo $parcours->getVille2() ?></option>
                            <?php
                        }
                        ?>
                    </select>
                </div>
                <div>
                    <label for="dateDepart">Date de départ : </label>
                    <input type="date" name="dateDepart" id="dateDepart" value="<?php echo date('Y-m-d')?>">
                    <label for="heureDepart">Heure de départ : </label>
                    <input type="time" name="heureDepart" id="heureDepart" value="<?php echo date('H:i:s') ?>">
                </div>
                <div>
                    <label for="nombrePlaces">Nombre de places : </label>
                    <input type="number" name="nombrePlaces" id="nombrePlaces" min="0">
                </div>
                <input type="submit" value="Valider">
            </form>
<?php
        }
        else {
            $existingParcours = $parcoursManager->checkParcours($_SESSION['villeDepart'], $_POST["villeArrivee"]);
            $checkSens = $parcoursManager->getParcours($_SESSION['villeDepart'], $_POST["villeArrivee"]);
            if ($checkSens)
                $sens = 0;
            else
                $sens = 1;
            $newTrajet = new Propose(
                array(
                    'par_num' => $existingParcours->getNumero(),
                    'per_num' => $_SESSION['userid'],
                    'pro_date' => $_POST["dateDepart"],
                    'pro_time' => $_POST["heureDepart"],
                    'pro_place' => $_POST["nombrePlaces"],
                    'pro_sens' => $sens
                )
            );
            $proposeManager->add($newTrajet);
?>
            <p><img src="image/valid.png" alt="Valid Check"> Le trajet a bien été ajouté</p>
<?php
            unset($_SESSION['villeDepart']);
            header('Refresh: 1.5; url=index.php?page=proposerTrajet');
        }
    }
?>
