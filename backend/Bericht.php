<?php

class Bericht {
    public int $id;
    public User $afzender;
    public Asiel $ontvanger;
    public string $inhoud;
    public DateTime $verzendTijd;

    public function __construct($id, $afzender, $ontvanger, $inhoud, $verzendTijd) {
        $this->id = $id;
        $this->afzender = $afzender;
        $this->ontvanger = $ontvanger;
        $this->inhoud = $inhoud;
        $this->verzendTijd = $verzendTijd;
    }
}