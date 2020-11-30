<?php


class FonctionManager
{
    private $db;

    /**
     * FonctionManager constructor.
     * @param $db
     */
    public function __construct($db)
    {
        $this->db = $db;
    }

    #Affichage de toutes les fonctions de la BD
    public function getAllFonction() {
        $listeFonction = array();
        $requete = $this->db->prepare('SELECT fon_num, fon_libelle FROM fonction');
        $requete->execute();
        while ($fonction = $requete->fetch(PDO::FETCH_ASSOC))
            $listeFonction[] = new Fonction($fonction);
        return $listeFonction;
    }


}
