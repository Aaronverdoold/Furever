<?php

class Asiel {
    public int $id;
    public string $naam;
    public string $locatie;
    public string $contactgegevens;
    public Dier $dieren;

    public function __construct($id, $naam, $locatie, $contactgegevens) {
        $this->id = $id;
        $this->naam = $naam;
        $this->locatie = $locatie;
        $this->contactgegevens = $contactgegevens;
        $this->dieren = [];
    }
}