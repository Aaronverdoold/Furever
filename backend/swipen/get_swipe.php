<?php
require_once '../database-connect/dbconnect.php';
require_once 'Swipe.php';
require_once './PetMatch.php';

header('Content-Type: application/json');
$data = json_decode(file_get_contents('php://input'), true);

if ($_SERVER['REQUEST_METHOD'] === 'POST' && $data) {
    $gebruiker_id = (int)$data['gebruiker_id'];
    $dier_id = (int)$data['dier_id'];
    $richting = $data['richting'];

    try {
        $conn = dbconnection();
        $id = Swipe::insertSwipe($conn, $gebruiker_id, $dier_id, $richting);
        echo json_encode(['success' => true, 'id' => $id]);
    } catch (Exception $e) {
        echo json_encode(['success' => false, 'error' => $e->getMessage()]);
    }
} else {
    echo json_encode(['success' => false, 'error' => 'Invalid request']);
}

if ($richting === 'right') {
    $stmt = $conn->prepare("SELECT * FROM swipe WHERE gebruiker_id = :shelter_id AND dier_id = :dier_id AND richting = 'right'");
    $stmt->bindParam(':shelter_id', $shelter_id, PDO::PARAM_INT);
    $stmt->bindParam(':dier_id', $dier_id, PDO::PARAM_INT);
    $stmt->execute();
    if ($stmt->fetch()) {
        PetMatch::insertMatch($conn, $gebruiker_id, $dier_id);
    }
}