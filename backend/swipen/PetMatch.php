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

    public static function insertMatch($conn, $gebruiker_id, $dier_id) {
        $stmt = $conn->prepare("INSERT INTO match (gebruiker_id, dier_id) VALUES (:gebruiker_id, :dier_id)");
        $stmt->bindParam(':gebruiker_id', $gebruiker_id, PDO::PARAM_INT);
        $stmt->bindParam(':dier_id', $dier_id, PDO::PARAM_INT);
        if ($stmt->execute()) {
            return $conn->lastInsertId();
        } else {
            throw new Exception("Failed to insert match.");
        }
    }
}