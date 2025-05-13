<?php

require_once "../database-connect/dbconnect.php";
require_once "../signup/user.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $naam = $_POST['naam'];
    $email = $_POST['email'];
    $wachtwoord = $_POST['wachtwoord'];
    $bio = $_POST['bio'];
    $voorkeuren = $_POST['voorkeuren'];

    $foto = null;
    $uploadDir = '../../uploads/';
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

    if (isset($_FILES['foto']) && $_FILES['foto']['error'] === UPLOAD_ERR_OK) {
        $fotoName = basename($_FILES['foto']['name']);
        $uploadFile = $uploadDir . $fotoName;

        if (move_uploaded_file($_FILES['foto']['tmp_name'], $uploadFile)) {
            $foto = $fotoName; // Save the file name to the database
        } else {
            die("Failed to upload image.");
        }
    }

    if (!$naam || !$email || !$wachtwoord) {
        die("Fill the fields in !!");
    }

    try {
        $dbconnection = dbconnection();
        $user = new User($dbconnection);

        $profiel = $user->createProfile($bio, $foto, $voorkeuren);
        $user_id = $user->createUser($naam, $email, $wachtwoord, $profiel);

        header("Location: ../../frontend/home-page/home.html");
        exit;

    } catch (PDOException $e) {
        die("Sign up failed: " . $e->getMessage());
    }
} else {
    die("Invalid request method.");
}