<?php
require('./cfg.php');

if (isset($_POST['page_title'], $_POST['page_content'], $_GET['id'])) {
    $page_title = mysqli_real_escape_string($link, $_POST['page_title']);
    $page_content = mysqli_real_escape_string($link, $_POST['page_content']);
    $page_is_active = isset($_POST['page_is_active']) ? 1 : 0;
    $id = intval($_GET['id']); // Konwersja ID na liczbę całkowitą

    $query = "UPDATE page_list SET page_title = '$page_title', page_content = '$page_content', status = $page_is_active WHERE id = $id LIMIT 1";
    $result = mysqli_query($link, $query);

    if ($result) {
        echo "Zaktualizowano podstronę";
        header("Location: ./admin.php");
        exit;
    } else {
        echo "Błąd aktualizacji podstrony: " . mysqli_error($link);
    }
} else {
    echo "Nie przesłano wymaganych danych.";
}
?>