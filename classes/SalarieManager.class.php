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

    public function add($salarie) {
        $requete = $this->db->prepare('INSERT INTO salarie VALUES (:numero, :telephone, :fonction)');
        $requete->bindValue(':numero', $salarie->getNumero());
        $requete->bindValue(':telephone', $salarie->getTelephonePro());
        $requete->bindValue(':fonction', $salarie->getFonction());
        $requete->execute();
    }

    public function getSalarieFromId($id) {
        $requete = $this->db->prepare('SELECT per_num, sal_telprof, fon_num FROM salarie WHERE per_num = ' . $id);
        $requete->execute();
        return $requete->fetch(PDO::FETCH_ASSOC);
    }

    public function update($salarie, $id) {
        $requete = $this->db->prepare("UPDATE salarie SET sal_telprof = :tel, fon_num = :fonction WHERE per_num = $id");
        $requete->bindValue(':tel', $salarie->getTelephonePro());
        $requete->bindValue(':fonction', $salarie->getFonction());
        $requete->execute();
    }

    public function delete($id) {
        $requete = $this->db->prepare('DELETE FROM salarie WHERE per_num = ' . $id);
        $requete->execute();
    }

    /**********RAJOUT_VAL********************/
    public function getIsSalarie($id){
        $requete = "SELECT * FROM salarie WHERE per_num=$id ";
        $resultat = $this->db->query($requete);
        $ligne = $resultat->rowCount();
        return $ligne!==0;
    }

}
