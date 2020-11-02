<?php


class Salarie
{
    private $numero;
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
                case 'sal_telprof':
                    $this->setTelephonePro($valeur);
                    break;
                case 'fon_num':
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
