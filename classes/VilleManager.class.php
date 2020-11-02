<?php


class VilleManager
{
    private $db;

    /**
     * VilleManager constructor.
     * @param $db
     */
    public function __construct($db)
    {
        $this->db = $db;
    }

    public function addVille($ville) {
        $requete = $this->db->prepare("INSERT INTO ville (vil_nom) VALUES (:nom)");
        $requete->bindValue(':nom', $ville->getNom());
        $requete->execute();
    }

    public function getAllVille() {
        $listeVille = array();
        $requete = $this->db->prepare("SELECT vil_num, vil_nom FROM ville ORDER BY vil_nom");
        $requete->execute();
        while ($ville = $requete->fetch(PDO::FETCH_ASSOC))
            $listeVille[] = new Ville($ville);
        $requete->closeCursor();
        return $listeVille;
    }

    public function getAllVilleWhereExistParcours() {
        $listeVille = array();
        $requete = $this->db->prepare('SELECT DISTINCT vil_num, vil_nom FROM ville WHERE vil_num IN (SELECT vil_num1 FROM parcours UNION SELECT vil_num2 FROM parcours)');
        $requete->execute();
        while ($ville = $requete->fetch(PDO::FETCH_ASSOC))
            $listeVille[] = new Ville($ville);
        return $listeVille;
    }

    public function getAllVilleDepartWhereExistTrajet() {
        $listeVille = array();
        $requete = $this->db->prepare('SELECT DISTINCT vil_num1, vil_nom FROM (SELECT vil_num1, pro_sens FROM propose JOIN parcours p on propose.par_num = p.par_num WHERE pro_sens = 0 UNION SELECT vil_num2, pro_sens FROM propose JOIN parcours p2 on propose.par_num = p2.par_num WHERE pro_sens = 1) T1 JOIN ville on T1.vil_num1 = ville.vil_num');
        $requete->execute();
        while ($ville = $requete->fetch(PDO::FETCH_ASSOC))
            $listeVille[] = new Ville($ville);
        return $listeVille;
    }

    public function getAllVilleArriveeWhereExistTrajetFromVille1($id) {
        $listeVille = array();
        $requete = $this->db->prepare('SELECT vil_num2, vil_nom FROM parcours JOIN ville v on parcours.vil_num2 = v.vil_num WHERE par_num IN (SELECT propose.par_num FROM propose) AND vil_num1 =' . $id);
        $requete->execute();
        while ($ville = $requete->fetch(PDO::FETCH_ASSOC))
            $listeVille[] = new Ville($ville);
        return $listeVille;
    }

    public function getVilleFromId($id) {
        $requete = $this->db->prepare('SELECT vil_num, vil_nom FROM ville WHERE vil_num = ' . $id);
        $requete->execute();
        return $requete->fetch(PDO::FETCH_ASSOC);
    }

}
