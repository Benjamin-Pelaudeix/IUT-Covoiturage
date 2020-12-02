<?php
    if (session_status() == PHP_SESSION_ACTIVE) {
        $db = new Mypdo();
        $idPersonne = $_GET["id"];
        $personneManager = new PersonneManager($db);
        $etudiantManager = new EtudiantManager($db);
        $salarieManager = new SalarieManager($db);
        $verifyPersonne = $personneManager->getPersonneFromId($idPersonne);
        $verifyEtudiant = $etudiantManager->getEtudiantFromId($idPersonne);
        $verifySalarie = $salarieManager->getSalarieFromId($idPersonne);
        #Contrôle si l'identifiant de la personne n'est pas saisi ou n'existe pas dans le base
        if (empty($idPersonne) || !$verifyPersonne) {
            header('Location: index.php?page=listerPersonne');
        }
        #Contrôle si l'identifiant est celui d'un étudiant
        else if ($verifyEtudiant) {
            $etudiant = new Personne($personneManager->getPersonneAsEtudiant($idPersonne));
    ?>
            <h1>Détail sur l'étudiant <?php echo $etudiant->getNom() ?></h1>
            <table>
                <thead>
                    <tr>
                        <th>Prénom</th>
                        <th>Mail</th>
                        <th>Tel</th>
                        <th>Département</th>
                        <th>Ville</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><?php echo $etudiant->getPrenom(); ?></td>
                        <td><?php echo $etudiant->getMail(); ?></td>
                        <td><?php echo $etudiant->getTelephone(); ?></td>
                        <td><?php echo $etudiant->getDepartement(); ?></td>
                        <td><?php echo $etudiant->getVille(); ?></td>
                    </tr>
                </tbody>
            </table>
            <input type="button" onclick="history.back()" value="Retour">
    <?php
        }
        #Contrôle si l'identifiant est celui d'un salarié
        else if ($verifySalarie) {
            $salarie = new Personne($personneManager->getPersonneAsSalarie($idPersonne));
    ?>
            <h1>Détail sur le salarié <?php echo $salarie->getNom() ?></h1>
            <table>
                <thead>
                <tr>
                    <th>Prénom</th>
                    <th>Mail</th>
                    <th>Tel</th>
                    <th>Tel pro</th>
                    <th>Fonction</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td><?php echo $salarie->getPrenom(); ?></td>
                    <td><?php echo $salarie->getMail(); ?></td>
                    <td><?php echo $salarie->getTelephone(); ?></td>
                    <td><?php echo $salarie->getTelephonePro(); ?></td>
                    <td><?php echo $salarie->getFonction(); ?></td>
                </tr>
                </tbody>
            </table>
            <input type="button" onclick="history.back()" value="Retour">
    <?php
        }
    }
        else {
            header('Location: ../../index.php');
        }
?>
