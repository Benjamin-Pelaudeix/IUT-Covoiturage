<?php


class DivisionManager
{
    private $db;

    /**
     * DivisiionManager constructor.
     * @param $db
     */
    public function __construct($db)
    {
        $this->db = $db;
    }

    public function getAllDivision() {
        $listeDivision = array();
        $requete = $this->db->prepare('SELECT div_num, div_nom FROM division');
        $requete->execute();
        while ($division = $requete->fetch(PDO::FETCH_ASSOC))
            $listeDivision[] = new Division($division);
        return $listeDivision;
    }

}
