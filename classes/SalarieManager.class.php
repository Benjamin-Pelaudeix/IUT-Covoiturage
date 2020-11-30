<?php


class SalarieManager
{
    private $db;

    /**
     * SalarieManager constructor.
     * @param $db
     */
    public function __construct($db)
    {
        $this->db = $db;
    }

    #Ajout d'un salarié dans la base
    public function add($salarie) {
        $requete = $this->db->prepare('INSERT INTO salarie VALUES (:numero, :telephone, :fonction)');
        $requete->bindValue(':numero', $salarie->getNumero());
        $requete->bindValue(':telephone', $salarie->getTelephonePro());
        $requete->bindValue(':fonction', $salarie->getFonction());
        $requete->execute();
    }

    #Affichage d'un salarié recherché par son identifiant
    public function getSalarieFromId($id) {
        $requete = $this->db->prepare('SELECT per_num, sal_telprof, fon_num FROM salarie WHERE per_num = ' . $id);
        $requete->execute();
        return $requete->fetch(PDO::FETCH_ASSOC);
    }

    #Mise à jour des informations d'un salarié
    public function update($salarie, $id) {
        $requete = $this->db->prepare("UPDATE salarie SET sal_telprof = :tel, fon_num = :fonction WHERE per_num = $id");
        $requete->bindValue(':tel', $salarie->getTelephonePro());
        $requete->bindValue(':fonction', $salarie->getFonction());
        $requete->execute();
    }

    #Suppression d'un salarié en BD
    public function delete($id) {
        $requete = $this->db->prepare('DELETE FROM salarie WHERE per_num = ' . $id);
        $requete->execute();
    }

}
