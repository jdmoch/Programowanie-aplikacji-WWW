<?php

// Konfiguracja połączenia z bazą danych
$dbhost = 'localhost';   // Host bazy danych 
$dbuser = 'root';         // Nazwa użytkownika bazy danych
$dbpass = '';             // Hasło użytkownika bazy danych
$baza = 'moja_strona';    // Nazwa bazy danych

// Dane logowania dla panelu administracyjnego
$login = 'admin';         // Login administratora
$pass = 'admin';          // Hasło administratora

// Nawiązywanie połączenia z bazą danych
$link = mysqli_connect($dbhost, $dbuser, $dbpass);

// Sprawdzenie, czy połączenie z bazą danych powiodło się
if (!$link) {
    // Jeśli połączenie się nie powiodło, wyświetla komunikat
    echo '<b>przerwane połączenie</b>';
}

// Wybieranie konkretnej bazy danych
if (!mysqli_select_db($link, $baza)) {
    // Jeśli nie udało się wybrać bazy danych, wyświetla komunikat
    echo 'nie wybrano bazy';
}
?>
