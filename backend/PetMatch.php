<?php

class PetMatch {
    public $id;
    public User $gebruiker;
    public Dier $dier;

    public function __construct($id, $gebruiker, $dier) {
        $this->id = $id;
        $this->gebruiker = $gebruiker;
        $this->dier = $dier;

    }
}