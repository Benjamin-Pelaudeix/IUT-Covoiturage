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

    public function delete($id) {
        $requete = $this->db->prepare('DELETE FROM salarie WHERE per_num = ' . $id);
        $requete->execute();
    }

}
