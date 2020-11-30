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

    #Ajout d'un étudiant dans la BD
    public function add($etudiant) {
        $requete = $this->db->prepare('INSERT INTO etudiant VALUES (:numero, :departement, :division)');
        $requete->bindValue(':numero', $etudiant->getNumero());
        $requete->bindValue(':departement', $etudiant->getDepartement());
        $requete->bindValue(':division', $etudiant->getDivision());
        $requete->execute();
    }

    #Mise à jour des informations d'un étudiant dans la BD
    public function update($id,$etudiant){
        $requete = $this->db->prepare('UPDATE etudiant SET dep_num=:departement, div_num=:division WHERE per_num='.$id);
        $requete->bindValue(':departement', $etudiant->getDepartement());
        $requete->bindValue(':division', $etudiant->getDivision());
        $requete->execute();
    }

    #Affichage d'un étudiant après recherche par son identifiant
    public function getEtudiantFromId($id) {
        $requete = $this->db->prepare('SELECT per_num, dep_num, div_num FROM etudiant WHERE per_num = ' . $id);
        $requete->execute();
        return $requete->fetch(PDO::FETCH_ASSOC);
    }

    #Suppression d'un étudiant dans la BD
    public function delete($id) {
        $requete = $this->db->prepare('DELETE FROM etudiant WHERE per_num = ' . $id);
        $requete->execute();
    }

    #Vérifie si la personne, recherchée par son identifiant, est dans la table étudiant
    public function getIsEtudiant($id){
        $requete = "SELECT * FROM etudiant WHERE per_num=$id ";
        $resultat = $this->db->query($requete);
        $ligne = $resultat->rowCount();
        return $ligne!==0;
    }

}
