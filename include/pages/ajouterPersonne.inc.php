<?php
    $db = new Mypdo();
    $personneManager = new PersonneManager($db);
?>
<?php
    if (empty($_POST["nom"]) || empty($_POST["prenom"]) || empty($_POST["telephone"]) || empty($_POST["mail"]) || empty($_POST["login"]) || empty($_POST["password"])) {
?>
        <h1>Ajouter une personne</h1>
        <form action="index.php?page=ajouterPersonne" method="post" id="gridForm">
            <div>
                <div id="label1">
                    <label for="nom">Nom : </label><br>
                    <label for="telephone">Téléphone : </label><br>
                    <label for="login">Login : </label><br>
                </div>
                <div id="input1">
                    <input type="text" name="nom" id="nom">
                    <input type="tel" name="telephone" id="telephone" pattern="[0-9]{10}">
                    <input type="text" name="login" id="login">
                </div>
                <div id="label2">
                    <label for="prenom">Prénom : </label><br>
                    <label for="mail">Mail : </label><br>
                    <label for="password">Mot de passe : </label><br>
                </div>
                <div id="input2">
                    <input type="text" name="prenom" id="prenom">
                    <input type="email" name="mail" id="mail">
                    <input type="password" name="password" id="password">
                </div>
            </div>
            <label for="categorie">Catégorie : </label>
            <input type="radio" name="categorie" id="etudiant" value="0">
            <label for="etudiant">Etudiant</label>
            <input type="radio" name="categorie" id="personnel" value="1">
            <label for="personnel">Personnel</label>
            <br>
            <input type="submit" value="Valider">
        </form>
<?php
    }
    else {
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
        $personneManager->add($newPersonne);
        if ($_POST["categorie"] == 0) {
           header('Location: index.php?page=ajouterEtudiant');
        }
        else {
            header('Location: index.php?page=ajouterSalarie');
        }
    }
