<?php


class ParcoursManager
{
    private $db;

    /**
     * ParcoursManager constructor.
     * @param $db
     */
    public function __construct($db)
    {
        $this->db = $db;
    }

    #Ajout d'un parcours dans la BD
    public function add($parcours) {
        $requete = $this->db->prepare('INSERT INTO parcours (par_km, vil_num1, vil_num2) VALUES (:kilometres, :ville1, :ville2)');
        $requete->bindValue(':kilometres', $parcours->getKilometrage());
        $requete->bindValue(':ville1', $parcours->getVille1());
        $requete->bindValue(':ville2', $parcours->getVille2());
        $requete->execute();
    }

    #Affichage d'un parcours entre deux villes
    public function getParcours($ville1, $ville2) {
        $requete = $this->db->prepare("SELECT par_num, par_km, vil_num1, vil_num2 FROM parcours WHERE vil_num1 = " . $ville1 . " AND vil_num2 = " . $ville2);
        $requete->execute();
        return $requete->fetch(PDO::FETCH_ASSOC);
    }

    #Vérification de l'existance d'un parcours entre deux villes dans la BD
    public function checkParcours($ville1, $ville2) {
        $requete = $this->db->prepare("SELECT par_num, par_km, vil_num1, vil_num2 FROM parcours WHERE vil_num1 = " . $ville1 . " AND vil_num2 = " . $ville2 . " OR vil_num1 = " . $ville2 . " AND vil_num2 = " . $ville1);
        $requete->execute();
        $parcours = $requete->fetch(PDO::FETCH_ASSOC);
        return new Parcours($parcours);
    }

    #Affichage de tous les parcours de la BD
    public function getAllParcours() {
        $listeParcours = array();
        $requete = $this->db->prepare('SELECT par_num, par_km, v.vil_nom AS vil_num1, v2.vil_nom AS vil_num2 FROM parcours JOIN ville v on parcours.vil_num1 = v.vil_num JOIN ville v2 on parcours.vil_num2 = v2.vil_num');
        $requete->execute();
        while ($parcours = $requete->fetch(PDO::FETCH_ASSOC))
            $listeParcours[] = new Parcours($parcours);
        $requete->closeCursor();
        return $listeParcours;
    }

    #Affichage de tous les parcours de la BD depuis une ville de départ
    public function getParcoursVille2FromVille1($ville1) {
        $listeParcours = array();
        $requete = $this->db->prepare('SELECT vil_num1, vil_nom AS vil_num2 FROM parcours JOIN ville v on parcours.vil_num1 = v.vil_num WHERE vil_num2 = ' . $ville1 . ' UNION SELECT vil_num2, vil_nom FROM parcours JOIN ville v2 on parcours.vil_num2 = v2.vil_num WHERE vil_num1 = ' . $ville1);
        $requete->execute();
        while ($parcours = $requete->fetch(PDO::FETCH_ASSOC))
            $listeParcours[] = new Parcours($parcours);
        return $listeParcours;
    }
}
