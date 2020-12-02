<div id="texte">
<?php
    if (!empty($_GET["page"]))
        $page=$_GET["page"];
    else
        $page='home';

    switch ($page) {
        case 'home':
            include_once('pages/accueil.inc.php');
            break;
        case 'connexion':
            include_once('pages/connexion.inc.php');
            break;
        case 'validationConnexion':
            include_once('pages/validationConnexion.inc.php');
            break;
        case 'deconnexion':
            include_once('pages/deconnexion.inc.php');
            break;
        case 'ajouterPersonne':
            include_once('pages/ajouterPersonne.inc.php');
            break;
        case 'ajouterEtudiant':
            include_once('pages/ajouterEtudiant.inc.php');
            break;
        case 'ajouterSalarie':
            include_once('pages/ajouterSalarie.inc.php');
            break;
        case 'listerPersonne':
            include_once('pages/listerPersonne.inc.php');
            break;
        case 'afficherPersonne':
            include_once('pages/afficherPersonne.inc.php');
            break;
        case 'modifierPersonne':
            include_once('pages/modifierPersonne.inc.php');
            break;
        case 'supprimerPersonne':
            include_once('pages/supprimerPersonne.inc.php');
            break;
        case 'ajouterVille':
            include_once('pages/ajouterVille.inc.php');
            break;
        case 'listerVille':
            include_once('pages/listerVille.inc.php');
            break;
        case 'ajouterParcours':
            include_once('pages/ajouterParcours.inc.php');
            break;
        case 'listerParcours':
            include_once('pages/listerParcours.inc.php');
            break;
        case 'proposerTrajet':
            if (!empty($_SESSION['username']))
                include_once('pages/proposerTrajet.inc.php');
            else
                include_once('pages/accueil.inc.php');
            break;
        case 'rechercherTrajet':
            if (!empty($_SESSION['username']))
                include_once('pages/rechercherTrajet.inc.php');
            else
                include_once('pages/accueil.inc.php');
            break;
        default : 	include_once('pages/accueil.inc.php');
    }
?>
</div>
