<?php


class Personne
{
    private $numero;
    private $nom;
    private $prenom;
    private $telephone;
    private $mail;
    private $login;
    private $password;
    private $departement;
    private $ville;
    private $telephonePro;
    private $fonction;

    public function __construct(array $valeurs) {
        if (!empty($valeurs))
            $this->affecte($valeurs);
    }

    public function affecte(array $donnees) {
        foreach ($donnees as $attribut => $valeur) {
            switch ($attribut) {
                case 'per_num':
                    $this->setNumero($valeur);
                    break;
                case 'per_nom':
                    $this->setNom($valeur);
                    break;
                case 'per_prenom':
                    $this->setPrenom($valeur);
                    break;
                case 'per_tel':
                    $this->setTelephone($valeur);
                    break;
                case 'per_mail':
                    $this->setMail($valeur);
                    break;
                case 'per_login':
                    $this->setLogin($valeur);
                    break;
                case 'per_pwd':
                    $this->setPassword($valeur);
                    break;
                case 'dep_nom':
                    $this->setDepartement($valeur);
                    break;
                case 'vil_nom':
                    $this->setVille($valeur);
                    break;
                case 'sal_telprof':
                    $this->setTelephonePro($valeur);
                    break;
                case 'fon_libelle':
                    $this->setFonction($valeur);
                    break;
            }
        }
    }

    /**
     * @return mixed
     */
    public function getNumero()
    {
        return $this->numero;
    }

    /**
     * @param mixed $numero
     */
    public function setNumero($numero)
    {
        $this->numero = $numero;
    }

    /**
     * @return mixed
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * @param mixed $nom
     */
    public function setNom($nom)
    {
        $this->nom = $nom;
    }

    /**
     * @return mixed
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * @param mixed $prenom
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;
    }

    /**
     * @return mixed
     */
    public function getTelephone()
    {
        return $this->telephone;
    }

    /**
     * @param mixed $telephone
     */
    public function setTelephone($telephone)
    {
        $this->telephone = $telephone;
    }

    /**
     * @return mixed
     */
    public function getMail()
    {
        return $this->mail;
    }

    /**
     * @param mixed $mail
     */
    public function setMail($mail)
    {
        $this->mail = $mail;
    }

    /**
     * @return mixed
     */
    public function getLogin()
    {
        return $this->login;
    }

    /**
     * @param mixed $login
     */
    public function setLogin($login)
    {
        $this->login = $login;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    /**
     * @return mixed
     */
    public function getDepartement()
    {
        return $this->departement;
    }

    /**
     * @param mixed $departement
     */
    public function setDepartement($departement)
    {
        $this->departement = $departement;
    }

    /**
     * @return mixed
     */
    public function getVille()
    {
        return $this->ville;
    }

    /**
     * @param mixed $ville
     */
    public function setVille($ville)
    {
        $this->ville = $ville;
    }

    /**
     * @return mixed
     */
    public function getTelephonePro()
    {
        return $this->telephonePro;
    }

    /**
     * @param mixed $telephonePro
     */
    public function setTelephonePro($telephonePro)
    {
        $this->telephonePro = $telephonePro;
    }

    /**
     * @return mixed
     */
    public function getFonction()
    {
        return $this->fonction;
    }

    /**
     * @param mixed $fonction
     */
    public function setFonction($fonction)
    {
        $this->fonction = $fonction;
    }
}
