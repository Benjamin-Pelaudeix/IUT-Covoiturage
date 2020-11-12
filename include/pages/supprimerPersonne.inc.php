<h1>Supprimer une personne</h1>
<?php
    $db = new Mypdo();
    $personneManager = new PersonneManager($db);
    $etudiantManager = new EtudiantManager($db);
    $salarieManager = new SalarieManager($db);
    $numeroPersonne = $_GET["id"];
    $personne = new Personne($personneManager->getPersonneFromId($numeroPersonne));
    $verifyEtudiant = $etudiantManager->getEtudiantFromId($numeroPersonne);
    $verifySalarie = $salarieManager->getSalarieFromId($numeroPersonne);
    #Contrôle si l'identifiant est celui d'un étudiant
    if ($verifyEtudiant) {
        $etudiantManager->delete($numeroPersonne);
        $personneManager->delete($numeroPersonne);
?>
        <p><img src="image/valid.png" alt="Valid Check"> Personne supprimée avec succès</p>
<?php
        header('Refresh: 1.5; url = index.php?page=listerPersonne');
    }
    #Contrôle si l'identifiant est celui d'un salarié
    else if ($verifySalarie) {
        $salarieManager->delete($numeroPersonne);
        $personneManager->delete($numeroPersonne);
?>
        <p><img src="image/valid.png" alt="Valid Check"> Personne supprimée avec succès</p>
<?php
        header('Refresh: 1.5; url = index.php?page=listerPersonne');
    }
    #Si l'identifiant n'est pas présent dans la base
    else {
?>
        <p><img src="image/erreur.png" alt="Error Cross"> La personne ne peut être supprimée</p>
<?php
        header('Refresh: 1.5; url = index.php?page=listerPersonne');
    }
?>
