<?php


class Ville
{
    private $numero;
    private $nom;

    public function __construct(array $valeurs) {
        if (!empty($valeurs))
            $this->affecte($valeurs);
    }

    public function affecte(array $donnees) {
        foreach ($donnees as $attribut => $valeur) {
            switch ($attribut) {
                case 'vil_num':
                    $this->setNumero($valeur);
                    break;
                case 'vil_nom':
                    $this->setNom($valeur);
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
}
