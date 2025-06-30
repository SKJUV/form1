<?php

class personne{
    private $nom;
    private $prenom;
    private $age;
    private $habitat;

    function __construct($nom, $prenom, $age, $habitat) {
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->age = $age;
        $this->habitat = $habitat;
    }

    function getNom() {
        return $this->nom;
    }

    function getPrenom() {
        return $this->prenom;
    }

    function getAge() {
        return $this->age;
    }

    function getHabitat() {
        return $this->habitat;
    }
    function exister() {
        return 'j\'existe'.'et je m\'appelle '.$this->getPrenom().' '.$this->getNom().' et j\'ai '.$this->getAge().' ans et j\'habite à '.$this->getHabitat();
    }
}
