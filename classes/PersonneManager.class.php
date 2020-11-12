<?php


class PersonneManager
{
    private $db;

    /**
     * PersonneManager constructor.
     * @param $db
     */
    public function __construct($db)
    {
        $this->db = $db;
    }

    public function add($personne) {
        $requete = $this->db->prepare('INSERT INTO personne (per_nom, per_prenom, per_tel, per_mail, per_login, per_pwd) VALUES (:nom, :prenom, :telephone, :mail, :login, :password)');
        $requete->bindValue(':nom', $personne->getNom());
        $requete->bindValue(':prenom', $personne->getPrenom());
        $requete->bindValue(':telephone', $personne->getTelephone());
        $requete->bindValue(':mail', $personne->getMail());
        $requete->bindValue(':login', $personne->getLogin());
        $requete->bindValue(':password', $personne->getPassword());
        $requete->execute();
    }

    public function getLastAddedPersonne() {
        $requete = $this->db->prepare('SELECT per_num, per_nom, per_prenom, per_tel, per_mail, per_login, per_pwd FROM personne ORDER BY per_num DESC LIMIT 1');
        $requete->execute();
        return $requete->fetch(PDO::FETCH_ASSOC);
    }

    public function getAllPersonne() {
        $listePersonne = array();
        $requete = $this->db->prepare('SELECT per_num, per_nom, per_prenom, per_tel, per_mail, per_login, per_pwd FROM personne');
        $requete->execute();
        while ($personne = $requete->fetch(PDO::FETCH_ASSOC))
            $listePersonne[] = new Personne($personne);
        return $listePersonne;
    }

    public function getPersonneFromId($id) {
        $requete = $this->db->prepare('SELECT personne.per_num, per_nom, per_prenom, per_tel, per_mail, per_login, per_pwd, AVG(avi_note) AS avi_note, avi_comm FROM personne JOIN avis a on personne.per_num = a.per_num WHERE personne.per_num = ' . $id .' GROUP BY personne.per_num');
        $requete->execute();
        return $requete->fetch(PDO::FETCH_ASSOC);
    }

    public function getPersonneFromLoginPwd($login, $password) {
        $requete = $this->db->prepare("SELECT per_num, per_nom, per_prenom, per_tel, per_mail, per_login, per_pwd FROM personne WHERE per_login = '" . $login . "' AND per_pwd = '" . $password . "'");
        $requete->execute();
        return $requete->fetch(PDO::FETCH_ASSOC);
    }

    public function getPersonneAsEtudiant($id) {
        $requete = $this->db->prepare('SELECT personne.per_num, per_nom, per_prenom, per_tel, per_mail, per_login, per_pwd, d.dep_nom AS dep_nom, v.vil_nom AS vil_nom FROM personne JOIN etudiant e on personne.per_num = e.per_num JOIN departement d on e.dep_num = d.dep_num JOIN ville v on d.vil_num = v.vil_num WHERE personne.per_num = ' . $id);
        $requete->execute();
        return $requete->fetch(PDO::FETCH_ASSOC);
    }

    public function getPersonneAsSalarie($id) {
        $requete = $this->db->prepare('SELECT personne.per_num, per_nom, per_prenom, per_tel, per_mail, per_login, per_pwd, sal_telprof, f.fon_libelle AS fon_libelle FROM personne JOIN salarie s on personne.per_num = s.per_num JOIN fonction f on s.fon_num = f.fon_num WHERE personne.per_num = ' . $id);
        $requete->execute();
        return $requete->fetch(PDO::FETCH_ASSOC);
    }

    public function update($id, Personne $personne) {
        $requete = $this->db->prepare("UPDATE personne SET per_nom = '". $personne->getNom() ."', per_prenom = '". $personne->getPrenom() ."', per_tel = '". $personne->getTelephone() ."', per_mail = '". $personne->getMail() ."', per_login = '". $personne->getLogin() ."', per_pwd = '". $personne->getPassword() ."' WHERE per_num = ". $id);
        $requete->execute();
    }

    public function delete($id) {
        $requete = $this->db->prepare('DELETE FROM personne WHERE per_num = ' . $id);
        $requete->execute();
    }

}
