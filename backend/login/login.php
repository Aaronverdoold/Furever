<?php
include './../database-connect/dbconnect.php';
include 'session.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = trim($_POST['email']);
    $wachtwoord = $_POST['wachtwoord'];

    if (empty($email) || empty($wachtwoord)) {
        echo json_encode(['success' => false, 'message' => 'Email and password are required.']);
        exit();
    }

    $conn = dbconnection();

    // Join gebruiker and profiel to get the photo
    $query = "SELECT g.*, p.foto AS profiel_foto 
              FROM gebruiker g 
              LEFT JOIN profiel p ON g.profiel = p.id 
              WHERE g.email = :email";
    $stmt = $conn->prepare($query);

    try {
        $stmt->execute([':email' => $email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$user) {
            echo json_encode(['success' => false, 'message' => 'No user found with this email.']);
            exit();
        }

        if (!password_verify($wachtwoord, $user["wachtwoord"])) {
            echo json_encode(['success' => false, 'message' => 'Incorrect password.']);
            exit();
        }

        logSession($user["naam"], $user["email"]);

        echo json_encode([
            'success' => true,
            'role' => 'user',
            'naam' => $user["naam"],
            'profiel_foto' => $user["profiel_foto"] ?? null,
            'redirect' => '../../frontend/home-page/home.html'
        ]);
        exit();

    } catch (PDOException $e) {
        echo json_encode(['success' => false, 'message' => 'Server error.']);
        exit();
    }
}
?>