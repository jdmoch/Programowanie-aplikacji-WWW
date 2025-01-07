<?php

session_start(); // Rozpoczyna sesję, aby mieć dostęp do zmiennych sesyjnych

// Sprawdzenie, czy użytkownik jest zalogowany
if (isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true) {
    // Jeśli użytkownik jest zalogowany, kończymy sesję
    session_destroy();
    
    // Przekierowanie na stronę logowania po wylogowaniu
    header('Location: ./admin.php');
} else {
    // Jeśli użytkownik nie jest zalogowany, przekierowanie na stronę logowania
    header('Location: ./admin.php');
}
?>
