<?php

class Swipe {
    public int $id;
    public User $gebruiker;
    public Dier $dier;
    public string $richting;

    public function __construct($id, $gebruiker, $dier, $richting) {
        $this->id = $id;
        $this->gebruiker = $gebruiker;
        $this->dier = $dier;
        $this->richting = $richting;

    }
}