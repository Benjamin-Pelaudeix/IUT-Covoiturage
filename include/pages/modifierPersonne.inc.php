<?php
    $db = new Mypdo();
    $personneManager = new PersonneManager($db);
    $numeroPersonne = $_GET["id"];
    $personne = new Personne($personneManager->getPersonneFromId($numeroPersonne));
?>
    <h1>Modifier la personne <?php echo $personne->getPrenom() ?></h1>
<?php
    if (empty($_POST["nom"]) || empty($_POST["prenom"]) || empty($_POST["telephone"]) || empty($_POST["mail"]) || empty($_POST["login"]) || empty($_POST["password"])) {
?>
    <form action="index.php?page=modifierPersonne&id=<?php echo $numeroPersonne ?>" method="post" id="gridForm">
        <div>
            <div id="label1">
                <label for="nom">Nom : </label><br>
                <label for="telephone">Téléphone : </label><br>
                <label for="login">Login : </label><br>
            </div>
            <div id="input1">
                <input type="text" name="nom" id="nom" value="<?php echo $personne->getNom() ?>">
                <input type="tel" name="telephone" id="telephone" pattern="[0-9]{10}" value="<?php echo $personne->getTelephone() ?>">
                <input type="text" name="login" id="login" value="<?php echo $personne->getLogin() ?>">
            </div>
            <div id="label2">
                <label for="prenom">Prénom : </label><br>
                <label for="mail">Mail : </label><br>
                <label for="password">Mot de passe : </label><br>
            </div>
            <div id="input2">
                <input type="text" name="prenom" id="prenom" value="<?php echo $personne->getPrenom() ?>">
                <input type="email" name="mail" id="mail" value="<?php echo $personne->getMail() ?>">
                <input type="password" name="password" id="password">
            </div>
        </div>
        <br>
        <input type="submit" value="Valider">
        <input type="button" value="Retour" onclick="history.back()">
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
    $personneManager->update($numeroPersonne, $newPersonne);
?>
    <p><img src="image/valid.png" alt="Valid Check"> La personne a été modifiée avec succès</p>
<?php
    header('Refresh: 1.5; url = index.php?page=listerPersonne');
}
