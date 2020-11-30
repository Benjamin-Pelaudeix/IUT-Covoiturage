<?php


class ProposeManager
{
    private $db;

    /**
     * ProposeManager constructor.
     * @param $db
     */
    public function __construct($db)
    {
        $this->db = $db;
    }

    #Ajout d'un trajet dans la BD
    public function add($trajet) {
        $numeroParcours = $trajet->getNumeroParcours();
        $numeroPersonne = $trajet->getNumeroPersonne();
        $date = $trajet->getDate();
        $heure = $trajet->getHeure();
        $nombrePlaces = $trajet->getNombrePlaces();
        $sens = $trajet->getSens();
        $requete = $this->db->prepare("INSERT INTO propose (par_num, per_num, pro_date, pro_time, pro_place, pro_sens) VALUES ($numeroParcours, $numeroPersonne, " . "'$date'" . ", " . "'$heure'" . ", $nombrePlaces, $sens)");
        $requete->execute();
    }

    #Affichage de tous les trajets existants de la BD
    public function getAllExistTrajet($ville1, $ville2, $date, $precision, $heure) {
        $listeTrajet = array();
        $requete = $this->db->prepare("SELECT v.vil_nom AS vil_nom1, v2.vil_nom AS vil_nom2, pro_date, pro_time, pro_place, p2.per_num AS per_num, CONCAT(per_prenom, ' ', per_nom) AS per_nom FROM propose JOIN parcours p on propose.par_num = p.par_num JOIN ville v on p.vil_num1 = v.vil_num JOIN ville v2 on vil_num2 = v2.vil_num JOIN personne p2 on propose.per_num = p2.per_num WHERE v.vil_num = " . $ville1 . " AND v2.vil_num = " . $ville2 . " AND pro_time >= '" . $heure . "' AND pro_date BETWEEN ADDDATE('" . $date . "', -" . $precision . ") AND ADDDATE('" . $date . "', " . $precision . ")");
        $requete->execute();
        while ($trajet = $requete->fetch(PDO::FETCH_ASSOC))
            $listeTrajet[] = new Propose($trajet);
        return $listeTrajet;
    }

}
