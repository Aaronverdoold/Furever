<?php
require_once '../database-connect/dbconnect.php';
require_once './Dier.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $naam = $_POST['naam'];
    $soort = $_POST['soort'];
    $ras = $_POST['ras'];
    $leeftijd = (int)$_POST['leeftijd'];
    $asiel_id = (int)$_POST['asiel_id'];
    $beschrijving = $_POST['beschrijving'];

    try {
        $conn = dbconnection();
        $id = Dier::insertDier($conn, $naam, $soort, $ras, $leeftijd, $asiel_id, $beschrijving);
        echo json_encode(['success' => true, 'id' => $id]);
    } catch (Exception $e) {
        echo json_encode(['success' => false, 'error' => $e->getMessage()]);
    }
} else {
    echo json_encode(['success' => false, 'error' => 'Invalid request']);
}