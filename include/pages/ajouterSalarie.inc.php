<?php
    $db = new Mypdo();
    $personneManager = new PersonneManager($db);
    $fonctionManager = new FonctionManager($db);
    $salarieManager = new SalarieManager($db);
    $listeFonction = $fonctionManager->getAllFonction();
?>
<h1>Ajouter un étudiant</h1>
<?php
    #Contrôle si les données renvoyées par le formulaire sont vides
    if (empty($_POST["telpro"]) || empty($_POST["fonction"])) {
?>
        <form action="index.php?page=ajouterSalarie" method="post">
            <div>
                <label for="telpro">Téléphone professionnel : </label>
                <input type="tel" name="telpro" id="telpro">
            </div>
            <div>
                <label for="fonction">Fonction : </label>
                <select name="fonction" id="fonction">
                    <?php
                    foreach ($listeFonction as $fonction) {
                        ?>
                        <option value="<?php echo $fonction->getNumero() ?>"><?php echo $fonction->getLibelle() ?></option>
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
        $lastPersonne = new Personne($personneManager->getLastAddedPersonne());
        $newSalarie = new Salarie(
            array(
                'per_num' => $lastPersonne->getNumero(),
                'sal_telprof' => $_POST["telpro"],
                'fon_num' => $_POST["fonction"]
            )
        );
        $salarieManager->add($newSalarie);
    ?>
        <p><img src="image/valid.png" alt="Valid Check"> Le salarié a bien été ajouté</p>
<?php
        header('Refresh: 1.5; url=index.php?page=ajouterPersonne');
    }
?>
