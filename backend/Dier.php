<?php

class Dier {
    public int $id;
    public string $naam;
    public string$soort;
    public string $ras;
    public int $leeftijd;
    public Asiel $asiel;
    public string $beschrijving;

    public function __construct($id, $naam, $soort, $ras, $leeftijd, $asiel, $beschrijving) {
        $this->id = $id;
        $this->naam = $naam;
        $this->soort = $soort;
        $this->ras = $ras;
        $this->leeftijd = $leeftijd;
        $this->asiel = $asiel;
        $this->beschrijving = $beschrijving;
    }
}




