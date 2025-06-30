<?php

require 'personne.php';

class citoyen extends personne {
    private $pays;
    private $ville;

    function __construct($nom, $prenom, $age, $habitat, $pays, $ville) {
        parent::__construct($nom, $prenom, $age, $habitat);
        $this->pays = $pays;
        $this->ville = $ville;
    }

    function getPays() {
        return $this->pays;
    }

    function getVille() {
        return $this->ville;
    }

    function citoyenneté() {
        return parent::exister() . ' et je suis citoyen de ' . $this->getPays() . ', dans la ville de ' . $this->getVille();
    }
}

