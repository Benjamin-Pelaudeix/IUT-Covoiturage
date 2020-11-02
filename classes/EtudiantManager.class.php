<?php


class EtudiantManager
{
    private $db;

    /**
     * EtudiantManager constructor.
     * @param $db
     */
    public function __construct($db)
    {
        $this->db = $db;
    }

    public function add($etudiant) {
        $requete = $this->db->prepare('INSERT INTO etudiant VALUES (:numero, :departement, :division)');
        $requete->bindValue(':numero', $etudiant->getNumero());
        $requete->bindValue(':departement', $etudiant->getDepartement());
        $requete->bindValue(':division', $etudiant->getDivision());
        $requete->execute();
    }

    public function getEtudiantFromId($id) {
        $requete = $this->db->prepare('SELECT per_num, dep_num, div_num FROM etudiant WHERE per_num = ' . $id);
        $requete->execute();
        return $requete->fetch(PDO::FETCH_ASSOC);
    }

}
