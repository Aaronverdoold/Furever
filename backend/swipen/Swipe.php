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

    public static function insertSwipe($conn, $gebruiker_id, $dier_id, $richting) {
        $stmt = $conn->prepare("INSERT INTO swipe (gebruiker_id, dier_id, richting) VALUES (:gebruiker_id, :dier_id, :richting)");
        $stmt->bindParam(':gebruiker_id', $gebruiker_id, PDO::PARAM_INT);
        $stmt->bindParam(':dier_id', $dier_id, PDO::PARAM_INT);
        $stmt->bindParam(':richting', $richting);

        if ($stmt->execute()) {
            return $conn->lastInsertId();
        } else {
            throw new Exception("Failed to insert swipe.");
        }
    }
}