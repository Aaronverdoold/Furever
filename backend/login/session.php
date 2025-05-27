<?php
require_once 'SessionManager.php';

function logSession($naam, $email) {
    SessionManager::login($naam, $email);
}

function isLoggedIn() {
    return SessionManager::isLoggedIn();
}

function getCurrentUsername() {
    return SessionManager::getCurrentUsername();
}

function logoutSession() {
    SessionManager::logout();
}
?>