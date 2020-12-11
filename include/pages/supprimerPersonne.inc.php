<?php
if (session_status() == PHP_SESSION_ACTIVE) {
?>
<h1>Supprimer une personne</h1>
<?php
    $db = new Mypdo();
    $personneManager = new PersonneManager($db);
    $etudiantManager = new EtudiantManager($db);
    $salarieManager = new SalarieManager($db);
    $proposeManager= new ProposeManager($db);
    $numeroPersonne = $_GET["id"];
    $personne = new Personne($personneManager->getPersonneFromId($numeroPersonne));
    $verifyEtudiant = $etudiantManager->getEtudiantFromId($numeroPersonne);
    $verifySalarie = $salarieManager->getSalarieFromId($numeroPersonne);
    #Contrôle si l'identifiant est celui d'un étudiant
    if ($verifyEtudiant) {
        #Suppression de sa ligne dans étudiant
        $etudiantManager->delete($numeroPersonne);
        #test pour savoir si des lignes le concernant existent dans propose
        if($proposeManager->presenceIdPropose($numeroPersonne)->getNombreLignes()!=0){
            #Existence de lignes
            $proposeManager->delete($numeroPersonne);
        }
        #test pour savoir si des lignes le concernant existent dans avis
        if($proposeManager->presenceIdAvis($numeroPersonne)->getNombreLignes()!=0){
            $proposeManager->deleteAvis($numeroPersonne);
        }
        #Suppression de sa ligne dans personne
        $personneManager->delete($numeroPersonne);
?>
        <p><img src="image/valid.png" alt="Valid Check"> Personne supprimée avec succès</p>
<?php
        header('Refresh: 1.5; url = index.php?page=listerPersonne');
    }
    #Contrôle si l'identifiant est celui d'un salarié
    else if ($verifySalarie) {
        #Suppression de sa ligne dans salarié
        $salarieManager->delete($numeroPersonne);
        #test pour savoir si des lignes le concernant existent dans propose
        if($proposeManager->presenceIdPropose($numeroPersonne)->getNombreLignes()!=0){
            #Existence de lignes
            $proposeManager->delete($numeroPersonne);
        }
        #test pour savoir si des lignes le concernant existent dans avis
        if($proposeManager->presenceIdAvis($numeroPersonne)->getNombreLignes()!=0){
            $proposeManager->deleteAvis($numeroPersonne);
        }
        #Suppression de sa ligne dans personne
        $personneManager->delete($numeroPersonne);
?>
        <p><img src="image/valid.png" alt="Valid Check"> Personne supprimée avec succès</p>
<?php
        header('Refresh: 1.5; url = index.php?page=listerPersonne');
    }
    #Si l'identifiant n'est pas présent dans la base salarié ni etudiant
    else {
        #test pour savoir si des lignes le concernant existent dans propose
        if($proposeManager->presenceIdPropose($numeroPersonne)->getNombreLignes()!=0){
            #Existence de lignes
            $proposeManager->delete($numeroPersonne);
        }
        #test pour savoir si des lignes le concernant existent dans avis
        if($proposeManager->presenceIdAvis($numeroPersonne)->getNombreLignes()!=0){
            $proposeManager->deleteAvis($numeroPersonne);
        }
        #Suppression de sa ligne dans personne
        $personneManager->delete($numeroPersonne);
?>
        <p><img src="image/valid.png" alt="Valid Check"> Personne supprimée avec succès</p>
<?php
        header('Refresh: 1.5; url = index.php?page=listerPersonne');
    }
}
else {
    header('Location: ../../index.php');
}
?>
