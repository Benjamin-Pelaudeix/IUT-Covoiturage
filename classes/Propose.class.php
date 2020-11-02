<?php


class Propose
{
    private $numeroParcours;
    private $numeroPersonne;
    private $nomPersonne;
    private $numeroVilleDepart;
    private $villeDepart;
    private $villeArrivee;
    private $date;
    private $heure;
    private $nombrePlaces;
    private $sens;

    public function __construct(array $valeurs) {
        if (!empty($valeurs))
            $this->affecte($valeurs);
    }

    public function affecte(array $donnees) {
        foreach ($donnees as $attribut => $valeur) {
            switch ($attribut) {
                case 'par_num':
                    $this->setNumeroParcours($valeur);
                    break;
                case 'per_num':
                    $this->setNumeroPersonne($valeur);
                    break;
                case 'per_nom':
                    $this->setNomPersonne($valeur);
                    break;
                case 'vil_num1':
                    $this->setNumeroVilleDepart($valeur);
                    break;
                case 'vil_nom1':
                    $this->setVilleDepart($valeur);
                    break;
                case 'vil_nom2':
                    $this->setVilleArrivee($valeur);
                    break;
                case 'pro_date':
                    $this->setDate($valeur);
                    break;
                case 'pro_time':
                    $this->setHeure($valeur);
                    break;
                case 'pro_place':
                    $this->setNombrePlaces($valeur);
                    break;
                case 'pro_sens':
                    $this->setSens($valeur);
                    break;
            }
        }
    }

    /**
     * @return mixed
     */
    public function getNumeroParcours()
    {
        return $this->numeroParcours;
    }

    /**
     * @param mixed $numeroParcours
     */
    public function setNumeroParcours($numeroParcours)
    {
        $this->numeroParcours = $numeroParcours;
    }

    /**
     * @return mixed
     */
    public function getNumeroPersonne()
    {
        return $this->numeroPersonne;
    }

    /**
     * @param mixed $numeroPersonne
     */
    public function setNumeroPersonne($numeroPersonne)
    {
        $this->numeroPersonne = $numeroPersonne;
    }

    /**
     * @return mixed
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param mixed $date
     */
    public function setDate($date)
    {
        $this->date = $date;
    }

    /**
     * @return mixed
     */
    public function getHeure()
    {
        return $this->heure;
    }

    /**
     * @param mixed $heure
     */
    public function setHeure($heure)
    {
        $this->heure = $heure;
    }

    /**
     * @return mixed
     */
    public function getNombrePlaces()
    {
        return $this->nombrePlaces;
    }

    /**
     * @param mixed $nombrePlaces
     */
    public function setNombrePlaces($nombrePlaces)
    {
        $this->nombrePlaces = $nombrePlaces;
    }

    /**
     * @return mixed
     */
    public function getSens()
    {
        return $this->sens;
    }

    /**
     * @param mixed $sens
     */
    public function setSens($sens)
    {
        $this->sens = $sens;
    }

    /**
     * @return mixed
     */
    public function getNomPersonne()
    {
        return $this->nomPersonne;
    }

    /**
     * @param mixed $nomPersonne
     */
    public function setNomPersonne($nomPersonne)
    {
        $this->nomPersonne = $nomPersonne;
    }

    /**
     * @return mixed
     */
    public function getNumeroVilleDepart()
    {
        return $this->numeroVilleDepart;
    }

    /**
     * @param mixed $numeroVilleDepart
     */
    public function setNumeroVilleDepart($numeroVilleDepart)
    {
        $this->numeroVilleDepart = $numeroVilleDepart;
    }

    /**
     * @return mixed
     */
    public function getVilleDepart()
    {
        return $this->villeDepart;
    }

    /**
     * @param mixed $villeDepart
     */
    public function setVilleDepart($villeDepart)
    {
        $this->villeDepart = $villeDepart;
    }

    /**
     * @return mixed
     */
    public function getVilleArrivee()
    {
        return $this->villeArrivee;
    }

    /**
     * @param mixed $villeArrivee
     */
    public function setVilleArrivee($villeArrivee)
    {
        $this->villeArrivee = $villeArrivee;
    }
}
