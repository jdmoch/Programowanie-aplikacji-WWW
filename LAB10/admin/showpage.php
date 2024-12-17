<?php

// Wczytanie konfiguracji połączenia z bazą danych
require('cfg.php');

function PokazPodstrone($id) {
    // Użycie globalnego obiektu połączenia z bazą danych
    global $link;
    
    // Oczyszczanie i zabezpieczanie danych wejściowych
    $id_clear = htmlspecialchars($id);

    // Przygotowanie zapytania SQL do pobrania danych podstrony na podstawie ID
    $query = "SELECT * FROM page_list WHERE id='$id_clear' LIMIT 1";
    // Wykonanie zapytania SQL
    $result = mysqli_query($link, $query);

    // Pobranie pierwszego wiersza wyniku zapytania
    $row = mysqli_fetch_array($result);

    // Sprawdzenie, czy podstrona o podanym ID istnieje
    if (empty($row['id'])) {
        // Jeśli strona nie istnieje, ustawienie komunikatu błędu
        $web = '[nie_znaleziono_strony]';
    } else {
        // Jeśli strona istnieje, przypisanie jej treści do zmiennej
        $web = $row['page_content'];
    }

    // Zwracanie treści podstrony lub komunikatu o błędzie
    return $web;
}

?>
