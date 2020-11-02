<?php


class Parcours
{
    private $numero;
    private $ville1;
    private $ville2;
    private $kilometrage;

    public function __construct(array $valeurs) {
        if (!empty($valeurs))
            $this->affecte($valeurs);
    }

    public function affecte(array $donnees) {
        foreach ($donnees as $attribut => $valeur) {
            switch ($attribut) {
                case 'par_num':
                    $this->setNumero($valeur);
                    break;
                case 'par_km':
                    $this->setKilometrage($valeur);
                    break;
                case 'vil_num1':
                    $this->setVille1($valeur);
                    break;
                case 'vil_num2':
                    $this->setVille2($valeur);
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
    public function getVille1()
    {
        return $this->ville1;
    }

    /**
     * @param mixed $ville1
     */
    public function setVille1($ville1)
    {
        $this->ville1 = $ville1;
    }

    /**
     * @return mixed
     */
    public function getVille2()
    {
        return $this->ville2;
    }

    /**
     * @param mixed $ville2
     */
    public function setVille2($ville2)
    {
        $this->ville2 = $ville2;
    }

    /**
     * @return mixed
     */
    public function getKilometrage()
    {
        return $this->kilometrage;
    }

    /**
     * @param mixed $kilometrage
     */
    public function setKilometrage($kilometrage)
    {
        $this->kilometrage = $kilometrage;
    }
}
