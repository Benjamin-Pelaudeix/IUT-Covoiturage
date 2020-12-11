<?php


class Departement
{
    private $numero;
    private $nom;
    private $ville;

    public function __construct(array $valeurs) {
                    if (!empty($valeurs))
                        $this->affecte($valeurs);
                }

    public function affecte(array $donnees) {
                    foreach ($donnees as $attribut => $valeur) {
                        switch ($attribut) {
                            case 'dep_num':
                                $this->setNumero($valeur);
                                break;
                            case 'dep_nom':
                                $this->setNom($valeur);
                                break;
                            case 'vil_num':
                                $this->setVille($valeur);
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
}
