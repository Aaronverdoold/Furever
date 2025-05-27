<?php
class SessionManager {
    public static function start() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    public static function login($naam, $email) {
        self::start();
        $_SESSION['loggedin'] = true;
        $_SESSION['naam'] = $naam;
        $_SESSION['email'] = $email;
    }

    public static function logout() {
        self::start();
        session_unset();
        session_destroy();
    }

    public static function isLoggedIn() {
        self::start();
        return isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true;
    }

    public static function getCurrentUsername() {
        self::start();
        return $_SESSION['naam'] ?? null;
    }
}
?>