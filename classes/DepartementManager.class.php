<?php


class DepartementManager
{
    private $db;

    /**
     * DepartementManager constructor.
     * @param $db
     */
    public function __construct($db)
    {
        $this->db = $db;
    }

    public function getAllDepartement() {
        $listeDepartement = array();
        $requete = $this->db->prepare('SELECT dep_num, dep_nom, vil_num FROM departement');
        $requete->execute();
        while ($departement = $requete->fetch(PDO::FETCH_ASSOC))
            $listeDepartement[] = new Departement($departement);
        return $listeDepartement;
    }

}
