<?php
if (session_status() == PHP_SESSION_ACTIVE) {
    $db = new Mypdo();
    $personneManager = new PersonneManager($db);
    $etudiantManager = new EtudiantManager($db);
    $salarieManager = new SalarieManager($db);

    $numeroPersonne = $_GET["id"];
    $personne = new Personne($personneManager->getPersonneFromId($numeroPersonne));
?>
    <h1>Modifier la personne <?php echo $personne->getPrenom() ?></h1>
<?php
    #Contrôle si les données renvoyées par le formulaire sont vides
    if (empty($_POST["nom"]) || empty($_POST["prenom"]) || empty($_POST["telephone"]) || empty($_POST["mail"]) || empty($_POST["login"])) {
    ?>
        <form action="index.php?page=modifierPersonne&id=<?php echo $numeroPersonne ?>" method="post" id="gridForm">
            <div>
                <div id="label1">
                    <label for="nom">Nom : </label><br>
                    <label for="telephone">Téléphone : </label><br>
                    <label for="login">Login : </label><br>
                </div>
                <div id="input1">
                    <input type="text" name="nom" id="nom" pattern="[a-zA-ZÀ-ÿ]" value="<?php echo $personne->getNom() ?>">
                    <input type="tel" name="telephone" id="telephone" pattern="[0-9]{10}" value="<?php echo $personne->getTelephone() ?>">
                    <input type="text" name="login" id="login" value="<?php echo $personne->getLogin() ?>">
                </div>
                <div id="label2">
                    <label for="prenom">Prénom : </label><br>
                    <label for="mail">Mail : </label><br>
                    <label for="password">Mot de passe : </label><br>
                </div>
                <div id="input2">
                    <input type="text" name="prenom" id="prenom" pattern="[a-zA-ZÀ-ÿ]" value="<?php echo $personne->getPrenom() ?>">
                    <input type="email" name="mail" id="mail" value="<?php echo $personne->getMail() ?>">
                    <input type="password" name="password" id="password">
                </div>
            </div>

        <?php
        if($etudiantManager->getIsEtudiant($numeroPersonne)){
            $_SESSION["formulaire"]="etudiant";
            $divisionManager = new DivisionManager($db);
            $departementManager = new DepartementManager($db);
            $listeDivision = $divisionManager->getAllDivision();
            $listeDepartement = $departementManager->getAllDepartement();
            $etudiant = new Etudiant($etudiantManager->getEtudiantFromId($numeroPersonne));
            ?>
            <div>
                <label for="annee">Année : </label>
                <select name="annee" id="annee">
                    <?php
                    foreach ($listeDivision as $division) {
                        ?>
                        <option value="<?php echo $division->getNumero() ?>" <?php if ($etudiant->getDivision()==$division->getNumero()){ echo "selected";}?>><?php echo $division->getNom() ?></option>
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
                        <option value="<?php echo $departement->getNumero() ?>" <?php if ($etudiant->getDepartement()==$departement->getNumero()){ echo "selected";}?>><?php echo $departement->getNom() ?></option>
                        <?php
                    }
                    ?>
                </select>
            </div>
            <?php

        } else {
            $_SESSION["formulaire"]="salarie";
            $salarieManager = new SalarieManager($db);
            $fonctionManager = new FonctionManager($db);
            $listeFonction = $fonctionManager->getAllFonction();
            $salarie = new Salarie($salarieManager->getSalarieFromId($numeroPersonne));
            ?>

            <div>
                <label for="telpro">Téléphone professionnel : </label>
                <input type="tel" name="telpro" id="telpro" value="<?php echo $salarie->getTelephonePro()?>">
            </div>
            <div>
                <label for="fonction">Fonction : </label>
                <select name="fonction" id="fonction">
                    <?php
                    foreach ($listeFonction as $fonction) {
                        ?>
                        <option value="<?php echo $fonction->getNumero() ?>" <?php if ($salarie->getFonction()==$fonction->getNumero()){ echo "selected";}?>><?php echo $fonction->getLibelle() ?></option>
                        <?php
                    }
                    ?>
                </select>
            </div>
            <?php
        }
?>          <div>
                <label for=""></label>

            </div>
            <br>
            <input type="submit" value="Valider">
            <input type="button" value="Retour" onclick="history.back()">
        </form>
<?php
}
else {
    if(empty($_POST["password"])){
        $newPersonne = new Personne(
            array(
                'per_nom' => $_POST["nom"],
                'per_prenom' => $_POST["prenom"],
                'per_tel' => $_POST["telephone"],
                'per_mail' => $_POST["mail"],
                'per_login' => $_POST["login"]
            )
        );
        $personneManager->updateWithoutPWD($numeroPersonne, $newPersonne);
    } else {
        //INSERTION NORMALE
        $newPersonne = new Personne(
            array(
                'per_nom' => $_POST["nom"],
                'per_prenom' => $_POST["prenom"],
                'per_tel' => $_POST["telephone"],
                'per_mail' => $_POST["mail"],
                'per_login' => $_POST["login"],
                'per_pwd' => sha1(sha1(mb_convert_encoding($_POST["password"], "UTF-8")) . mb_convert_encoding(SALT, "UTF-8"))
            )
        );
        $personneManager->update($numeroPersonne, $newPersonne);
    }

    if($_SESSION["formulaire"]==="etudiant"){
        //MAJ ETUDIANT
        $newEtudiant = new Etudiant(
            array(
                'dep_num' => $_POST["departement"],
                'div_num' => $_POST["annee"]
            )
        );
        $etudiantManager->update($numeroPersonne,$newEtudiant);
    } else {
        $newSalarie = new Salarie(
            array(
                'sal_telprof' => $_POST["telpro"],
                'fon_num' => $_POST["fonction"],
            )
        );
        $salarieManager->update($newSalarie, $numeroPersonne);
    }

?>
    <p><img src="image/valid.png" alt="Valid Check"> La personne a été modifiée avec succès</p>
<?php
    unset($_SESSION["formulaire"]);
    header('Refresh: 1.5; url = index.php?page=listerPersonne');
}
}
else {
    header('Location: ../../index.php');
}
?>
