<?php

class Dier {
    public int $id;
    public string $naam;
    public string $soort;
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

    public static function insertDier($conn, $naam, $soort, $ras, $leeftijd, $asiel_id, $beschrijving)
    {
        $stmt = $conn->prepare("INSERT INTO dier (naam, soort, ras, leeftijd, asiel_id, beschrijving) VALUES (:naam, :soort, :ras, :leeftijd, :asiel_id, :beschrijving)");
        $stmt->bindParam(':naam', $naam);
        $stmt->bindParam(':soort', $soort);
        $stmt->bindParam(':ras', $ras);
        $stmt->bindParam(':leeftijd', $leeftijd, PDO::PARAM_INT);
        $stmt->bindParam(':asiel_id', $asiel_id, PDO::PARAM_INT);
        $stmt->bindParam(':beschrijving', $beschrijving);

        if ($stmt->execute()) {
            return $conn->lastInsertId();
        } else {
            throw new Exception("Failed to insert dier.");
        }
    }
}




