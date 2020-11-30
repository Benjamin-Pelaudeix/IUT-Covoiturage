<?php
    $db = new Mypdo();
    $personneManager = new PersonneManager($db);
    $divisionManager = new DivisionManager($db);
    $departementManager = new DepartementManager($db);
    $etudiantManager = new EtudiantManager($db);
    $listeDivision = $divisionManager->getAllDivision();
    $listeDepartement = $departementManager->getAllDepartement();
?>
<h1>Ajouter un étudiant</h1>
<?php
    #Contrôle si les données renvoyées par le formulaire sont vides
    if (empty($_POST["annee"]) || empty($_POST["departement"])) {
?>
            <form action="index.php?page=ajouterEtudiant" method="post">
                <div>
                    <label for="annee">Année : </label>
                    <select name="annee" id="annee">
                        <?php
                            foreach ($listeDivision as $division) {
                        ?>
                                <option value="<?php echo $division->getNumero() ?>"><?php echo $division->getNom() ?></option>
                        <?php
                            }
                        ?>
                    </select>
                </div>
                <div>
                    <label for="departement">Département : </label>
                    <select name="departement" id="departement">
                        <?php
                            foreach ($listeDepartement as $departement) {
                        ?>
                                <option value="<?php echo $departement->getNumero() ?>"><?php echo $departement->getNom() ?></option>
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
                $newEtudiant = new Etudiant(
                        array(
                            'per_num' => $lastPersonne->getNumero(),
                            'dep_num' => $_POST["departement"],
                            'div_num' => $_POST["annee"]
                        )
                );
                $etudiantManager->add($newEtudiant);
?>
                <p><img src="image/valid.png" alt="Valid Check"> L'étudiant a bien été ajouté</p>
<?php
                #Redirection vers la page d'ajout d'une personne
                header('Refresh: 1.5; url=index.php?page=ajouterPersonne');
            }
?>
