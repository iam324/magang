<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

/**
 * Generates a CSRF token, stores it in the session, and returns it.
 */
function generate_csrf_token() {
    if (empty($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf_token'];
}

/**
 * Validates a given CSRF token against the one in the session.
 * Unsets the token after validation to make it single-use per request.
 */
function validate_csrf_token($token) {
    if (!isset($token) || !isset($_SESSION['csrf_token'])) {
        return false;
    }

    $session_token = $_SESSION['csrf_token'];
    // Unset token after first use
    unset($_SESSION['csrf_token']); 

    return hash_equals($session_token, $token);
}
?>