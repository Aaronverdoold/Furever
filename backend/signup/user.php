<?php

class User {
    private $conn;

    public function __construct($dbconnection) {
        $this->conn = $dbconnection;
    }

    public function createProfile($bio, $foto, $voorkeuren) {
        try {
            $stmt = $this->conn->prepare("INSERT INTO profiel (bio, foto, voorkeuren) VALUES (:bio, :foto, :voorkeuren)");
            $stmt->bindParam(':bio', $bio);
            $stmt->bindParam(':foto', $foto);
            $stmt->bindParam(':voorkeuren', $voorkeuren);

            if ($stmt->execute()) {
                return $this->conn->lastInsertId();
            } else {
                throw new Exception("Failed to create profile.");
            }
        } catch (Exception $e) {
            die("Error: " . $e->getMessage());
        }
    }

    public function createUser($naam, $email, $wachtwoord, $profiel) {
        try {
            $hashPassword = password_hash($wachtwoord, PASSWORD_DEFAULT);

            $stmt = $this->conn->prepare("INSERT INTO gebruiker (naam, email, wachtwoord, profiel) VALUES (:naam, :email, :wachtwoord, :profiel)");
            $stmt->bindParam(':naam', $naam);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':wachtwoord', $hashPassword);
            $stmt->bindParam(':profiel', $profiel);

            if ($stmt->execute()) {
                return $this->conn->lastInsertId();
            } else {
                throw new Exception("Failed to create user.");
            }
        } catch (Exception $e) {
            die("Error: " . $e->getMessage());
        }
    }
}