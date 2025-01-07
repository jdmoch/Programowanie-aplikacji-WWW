<?php

// Dodanie strony
// Włączenie konfiguracji bazy danych
require('./cfg.php');

// Sprawdzenie, czy formularz został wysłany i czy wszystkie wymagane dane są dostępne
if (isset($_POST['page_title']) && isset($_POST['page_content'])) {
    // Oczyszczenie danych wejściowych
    $page_title = htmlspecialchars($_POST['page_title'], ENT_QUOTES, 'UTF-8');
    $page_content = htmlspecialchars($_POST['page_content'], ENT_QUOTES, 'UTF-8');
    $page_is_active = isset($_POST['page_is_active']) ? 1 : 0;

    // Przygotowanie zapytania SQL z użyciem przygotowanych zapytań (prepared statements)
    $stmt = $link->prepare("INSERT INTO page_list (page_title, page_content, status) VALUES (?, ?, ?)");
    if ($stmt) {
        // Powiązanie parametrów
        $stmt->bind_param("ssi", $page_title, $page_content, $page_is_active);

        // Wykonanie zapytania
        if ($stmt->execute()) {
            // Przekierowanie na stronę admin.php po udanym dodaniu strony
            header('Location: ./admin.php');
            exit();
        } else {
            // Obsługa błędu, jeśli zapytanie się nie powiodło
            echo "Błąd podczas dodawania strony: " . $stmt->error;
        }

        // Zamknięcie zapytania
        $stmt->close();
    } else {
        // Obsługa błędu, jeśli przygotowanie zapytania się nie powiodło
        echo "Błąd przygotowania zapytania: " . $link->error;
    }
} else {
    // Komunikat, jeśli formularz nie został wysłany poprawnie
    echo "Wszystkie pola muszą być wypełnione.";
}

// Zamknięcie połączenia z bazą danych
$link->close();
?>
