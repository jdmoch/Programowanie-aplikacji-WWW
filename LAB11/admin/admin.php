<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tu pracuje Admin</title>
</head>
<body>
<?php

// Rozpoczęcie sesji, aby przechowywać informacje o zalogowanym użytkowniku
session_start();

// Dołączenie pliku konfiguracyjnego z danymi połączenia do bazy danych
require('cfg.php');



// Funkcja wyświetlająca formularz logowania
function FormularzLogowania() {
    $wynik = '
    <div class="login-wrapper">
    <h1 class="heading">Panel CMS:</h1>
    <form class="formularz_logowania" method="POST" name="LoginForm" enctype="multipart/form-data" action="'.htmlspecialchars($_SERVER['REQUEST_URI']).'">
    <table class="logowanie">
    <tr><td class="log4_t">[login]</td><td><input type="text" name="login_email" class="logowanie"/></td></tr>
    <tr><td class="log4_t">[haslo]</td><td><input type="password" name="login_pass" class="logowanie"/></td></tr>
    <tr><td><br/></td><td><input type="submit" name="xl_submit" class="logowanie" value="Zaloguj"/></td></tr>
    </table>
    </form>
    </div>';
    return $wynik; // Zwracanie wygenerowanego formularza
}

// Funkcja wyświetlająca listę podstron
function ListaPodstron() {
    global $link; // Globalna zmienna połączenia z bazą danych

    // Nagłówek i początkowa część tabeli z listą podstron
    $wynik = '<h3>Podstrony:</h3><table class="tabela_akcji"><tr><th>ID</th><th>Tytuł podstrony</th><th>Akcje</th></tr>';
    $wynik .= '<a href="'.htmlspecialchars($_SERVER['PHP_SELF']).'?action=dodaj">Dodaj podstronę</a><br /><br />';

    // Przygotowanie i wykonanie zapytania SQL, aby pobrać wszystkie podstrony
    $query = "SELECT id, page_title FROM page_list";
    $stmt = $link->prepare($query);
    $stmt->execute();
    $result = $stmt->get_result();

    // Sprawdzenie, czy wynik zawiera jakieś wiersze
    if ($result->num_rows > 0) {
        // Iteracja po wynikach zapytania
        while ($row = $result->fetch_assoc()) {
            $id = $row['id'];
            $page_title = htmlspecialchars($row['page_title']); // Ochrona przed XSS

            // Dodanie wiersza do tabeli z ID, tytułem i linkami do edycji oraz usunięcia
            $wynik .= '<tr><td>' . $id . '</td><td>' . $page_title . '</td>';
            $wynik .= '<td><a href="'.htmlspecialchars($_SERVER['PHP_SELF']).'?action=edytuj&id='.$id.'">Edytuj</a> | ';
            $wynik .= '<a href="'.htmlspecialchars($_SERVER['PHP_SELF']).'?action=usun&id='.$id.'">Usuń</a></td></tr>';
        }
    } else {
        // Jeżeli brak wyników, wyświetl komunikat
        $wynik .= '<tr><td colspan="3">Brak podstron do wyświetlenia.</td></tr>';
    }

    $wynik .= '</table>'; // Zamknięcie tabeli
    echo $wynik; // Wyświetlenie tabeli

    // Sprawdzenie, czy istnieje akcja (np. edytowanie, usuwanie, dodawanie)
    if (isset($_GET['action'])) {
        if ($_GET['action'] === 'edytuj' && isset($_GET['id'])) {
            echo EdytujPodstrone(); // Wywołanie funkcji edytowania podstrony
        } else if ($_GET['action'] === 'usun' && isset($_GET['id'])) {
            echo UsunPodstrone(); // Wywołanie funkcji usunięcia podstrony
        } else if ($_GET['action'] === 'dodaj') {
            echo DodajNowaPodstrone(); // Wywołanie funkcji dodawania nowej podstrony
        }
    }
}

// Funkcja do edytowania podstrony
function EdytujPodstrone() {
    global $link; // Globalna zmienna połączenia z bazą danych

    // Sprawdzenie, czy przekazano ID podstrony
    if (isset($_GET['id'])) {
        $id = (int)$_GET['id']; // Rzutowanie ID na typ całkowity
    } else {
        echo "Brak podstrony z tym ID";
        exit; // Zakończenie skryptu, jeśli ID jest nieprawidłowe
    }

    // Przygotowanie i wykonanie zapytania SQL, aby pobrać dane podstrony
    $query = "SELECT page_title, page_content, status FROM page_list WHERE id = ?";
    $stmt = $link->prepare($query);
    $stmt->bind_param("i", $id); // Powiązanie parametru jako liczby całkowitej
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc(); // Pobranie danych podstrony
        $page_title = htmlspecialchars($row['page_title']); // Ochrona przed XSS
        $page_content = htmlspecialchars($row['page_content']); // Ochrona przed XSS
        $page_is_active = $row['status']; // Sprawdzenie, czy podstrona jest aktywna

        // Generowanie formularza do edytowania podstrony
        $wynik = '<h3>Edycja Podstrony o id: '.$id.'</h3>';
        $wynik .= '<form method="POST" action="zapiszEdytowany.php?id='.$id.'">';
        $wynik .= '<input class="tytul" type="text" name="page_title" value="'.$page_title.'"><br />';
        $wynik .= '<textarea class="tresc" rows=20 cols=100 name="page_content">'.$page_content.'</textarea><br />';
        $wynik .= 'Podstrona aktywna: <input class="aktywna" type="checkbox" name="page_is_active" value="1"'.($page_is_active == 1 ? ' checked="checked"' : '').'><br />';
        $wynik .= '<input class="zapisz" type="submit" name="zapisz" value="zapisz"></form>';

        return $wynik; // Zwracanie wygenerowanego formularza
    } else {
        echo "Brak podstrony z tym ID";
        exit; // Zakończenie skryptu, jeśli podstrona nie istnieje
    }
}

// Funkcja do dodawania nowej podstrony
function DodajNowaPodstrone() {
    // Generowanie formularza do dodawania nowej podstrony
    $wynik = '<h3>Dodaj podstronę:</h3>';
    $wynik .= '<form method="POST" action="dodajStrone.php">';
    $wynik .= 'Tytuł: <input class="tytul" type="text" name="page_title" value=""><br /> <br />';
    $wynik .= 'Treść: <textarea class="tresc" rows=20 cols=100 name="page_content"></textarea><br /> <br />';
    $wynik .= 'Podstrona aktywna: <input class="aktywna" type="checkbox" name="page_is_active" value="1"><br /> <br />';
    $wynik .= '<input class="zapisz" type="submit" value="Dodaj"></form>';
    return $wynik; // Zwracanie wygenerowanego formularza
}

// Funkcja do usuwania podstrony
function UsunPodstrone() {
    global $link; // Globalna zmienna połączenia z bazą danych

    // Sprawdzenie, czy przekazano ID podstrony
    if (isset($_GET['id'])) {
        $id = (int)$_GET['id']; // Rzutowanie ID na typ całkowity
    } else {
        echo "Brak podstrony z tym ID";
        exit; // Zakończenie skryptu, jeśli ID jest nieprawidłowe
    }

    // Przygotowanie i wykonanie zapytania SQL do usunięcia podstrony
    $query = "DELETE FROM page_list WHERE id = ? LIMIT 1";
    $stmt = $link->prepare($query);
    $stmt->bind_param("i", $id); // Powiązanie parametru jako liczby całkowitej
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        echo "Usunięto podstronę";
        header("Location: admin.php"); // Przekierowanie po usunięciu
        exit;
    } else {
        echo "Błąd usuwania podstrony";
        exit; // Zakończenie skryptu, jeśli usunięcie nie powiodło się
    }
}

// Sprawdzenie, czy użytkownik jest zalogowany
if (isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true) {
    echo '<h1>Tu pracuje Admin</h1>';
    echo '<br><a href="?action=products">Zarządzaj produktami</a>';
    echo '<br><a href="?action=manage_categories">Zarządzaj kategoriami</a>';
    echo '<br><a href="wylogowanie.php">Wyloguj</a>';
    echo ListaPodstron(); // Wywołanie funkcji wyświetlającej listę podstron
} else {
    echo FormularzLogowania(); // Wywołanie funkcji wyświetlającej formularz logowania
}

// Sprawdzenie, czy formularz logowania został przesłany
if (isset($_POST['login_email']) && isset($_POST['login_pass'])) {
    $formLogin = $_POST['login_email']; // Pobranie loginu z formularza
    $formPass = $_POST['login_pass']; // Pobranie hasła z formularza

    // Sprawdzenie poprawności danych logowania
    if ($formLogin === $login && $formPass === $pass) {
        $_SESSION['admin_logged_in'] = true; // Ustawienie sesji jako zalogowana
        header("Location: admin.php"); // Przekierowanie na stronę admina
        exit;
    } else {
        echo 'Wpisz hasło jeszcze raz albo login';
        echo FormularzLogowania(); // Ponowne wyświetlenie formularza logowania
    }
}

// Funkcja do wyświetlania zarządzania kategoriami
function PokazZarzadzanieKategoriami() {
    global $link;

    echo '<h2>Zarządzanie kategoriami</h2>';

    // Wyświetlenie listy kategorii
    $query = "SELECT id, matka, nazwa FROM categories ORDER BY matka, id";
    $result = $link->query($query);

    echo '<ul>';
    while ($row = $result->fetch_assoc()) {
        echo '<li>ID: ' . $row['id'] . ' - ' . htmlspecialchars($row['nazwa']) . ' (Matka: ' . $row['matka'] . ') 
            <a href="?action=edit&id=' . $row['id'] . '">Edytuj</a> 
            <a href="?action=delete&id=' . $row['id'] . '">Usuń</a></li>';
    }
    echo '</ul>';

    echo '<a href="?action=add">Dodaj nową kategorię</a>';
}

// Obsługa akcji (dodawanie, edytowanie, usuwanie kategorii)
$action = isset($_GET['action']) ? $_GET['action'] : '';
switch ($action) {
    case 'add':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $matka = intval($_POST['mother']);
            $nazwa = htmlspecialchars($_POST['name']);
            $query = "INSERT INTO categories (matka, nazwa) VALUES (?, ?)";
            $stmt = $link->prepare($query);
            $stmt->bind_param('is', $matka, $nazwa);
            $stmt->execute();
            header("Location: admin.php?action=manage_categories");
            exit;
        }

        echo '<h2>Dodaj kategorię</h2>';
        echo '<form method="POST">
            Matka: <input type="text" name="mother" value="0"><br><br>
            Nazwa: <input type="text" name="name" required><br><br>
            <input type="submit" value="Dodaj">
        </form>';
        break;

    case 'edit':
        $id = isset($_GET['id']) ? intval($_GET['id']) : 0;
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $matka = intval($_POST['mother']);
            $nazwa = htmlspecialchars($_POST['name']);
            $query = "UPDATE categories SET matka = ?, nazwa = ? WHERE id = ?";
            $stmt = $link->prepare($query);
            $stmt->bind_param('isi', $matka, $nazwa, $id);
            $stmt->execute();
            header("Location: admin.php?action=manage_categories");
            exit;
        }

        $query = "SELECT matka, nazwa FROM categories WHERE id = ?";
        $stmt = $link->prepare($query);
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        echo '<h2>Edytuj kategorię</h2>';
        echo '<form method="POST">
            Matka: <input type="text" name="mother" value="' . $row['matka'] . '"><br><br>
            Nazwa: <input type="text" name="name" value="' . htmlspecialchars($row['nazwa']) . '" required><br><br>
            <input type="submit" value="Zapisz">
        </form>';
        break;

    case 'delete':
        $id = isset($_GET['id']) ? intval($_GET['id']) : 0;
        $query = "DELETE FROM categories WHERE id = ?";
        $stmt = $link->prepare($query);
        $stmt->bind_param('i', $id);
        $stmt->execute();
        header("Location: admin.php?action=manage_categories");
        exit;

    case 'manage_categories':
    default:
        PokazZarzadzanieKategoriami();
        break;
}

function PokazProdukty() {
    global $link;

    echo '<h2>Produkty:</h2>';
    echo '<a href="?action=add_product">Dodaj produkt</a><br><br>';

    $query = "SELECT id, tytul, cena_netto, status_dostepnosci FROM produkty ORDER BY id";
    $result = $link->query($query);

    if ($result->num_rows > 0) {
        echo '<table>';
        echo '<tr><th>ID</th><th>Tytuł</th><th>Cena netto</th><th>Dostępność</th><th>Akcje</th></tr>';
        while ($row = $result->fetch_assoc()) {
            echo '<tr>';
            echo '<td>' . $row['id'] . '</td>';
            echo '<td>' . htmlspecialchars($row['tytul']) . '</td>';
            echo '<td>' . $row['cena_netto'] . ' zł</td>';
            echo '<td>' . ($row['status_dostepnosci'] ? 'Dostępny' : 'Niedostępny') . '</td>';
            echo '<td><a href="?action=edit_product&id=' . $row['id'] . '">Edytuj</a> | 
                  <a href="?action=delete_product&id=' . $row['id'] . '">Usuń</a></td>';
            echo '</tr>';
        }
        echo '</table>';
    } else {
        echo 'Brak produktów do wyświetlenia.';
    }
}

function DodajProdukt() {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        global $link;

        $tytul = htmlspecialchars($_POST['tytul']);
        $opis = htmlspecialchars($_POST['opis']);
        $data_utworzenia = date('Y-m-d'); // Bieżąca data
        $data_wygasniecia = $_POST['data_wygasniecia'];
        $cena_netto = floatval($_POST['cena_netto']);
        $podatek_vat = floatval($_POST['podatek_vat']);
        $ilosc_magazyn = intval($_POST['ilosc_magazyn']);
        $status_dostepnosci = isset($_POST['status_dostepnosci']) ? 1 : 0;
        $kategoria = htmlspecialchars($_POST['kategoria']);
        $gabaryt_produktu = htmlspecialchars($_POST['gabaryt_produktu']);
        $zdjecie = htmlspecialchars($_POST['zdjecie']);

        $query = "INSERT INTO produkty 
                  (tytul, opis, data_utworzenia, data_wygaśnięcia, cena_netto, podatek_vat, ilosc_magazyn, status_dostepnosci, kategoria, gabaryt_produktu, zdjecie)
                  VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $link->prepare($query);
        $stmt->bind_param('sssddddisss', $tytul, $opis, $data_utworzenia, $data_wygasniecia, $cena_netto, $podatek_vat, $ilosc_magazyn, $status_dostepnosci, $kategoria, $gabaryt_produktu, $zdjecie);
        $stmt->execute();

        header("Location: admin.php?action=products");
        exit;
    }

    echo '<h2>Dodaj produkt</h2>';
    echo '<form method="POST">';
    echo 'Tytuł: <input type="text" name="tytul" required><br><br>';
    echo 'Opis: <textarea name="opis" rows="5" cols="50"></textarea><br><br>';
    echo 'Data wygaśnięcia: <input type="date" name="data_wygasniecia"><br><br>';
    echo 'Cena netto: <input type="text" name="cena_netto" required><br><br>';
    echo 'Podatek VAT (%): <input type="text" name="podatek_vat" required><br><br>';
    echo 'Ilość w magazynie: <input type="number" name="ilosc_magazyn" required><br><br>';
    echo 'Dostępny: <input type="checkbox" name="status_dostepnosci"><br><br>';
    echo 'Kategoria: <input type="text" name="kategoria"><br><br>';
    echo 'Gabaryt produktu: <input type="text" name="gabaryt_produktu"><br><br>';
    echo 'Link do zdjęcia: <input type="text" name="zdjecie"><br><br>';
    echo '<input type="submit" value="Dodaj">';
    echo '</form>';
}

function EdytujProdukt() {
    global $link;

    $id = intval($_GET['id']);
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $tytul = htmlspecialchars($_POST['tytul']);
        $opis = htmlspecialchars($_POST['opis']);
        $data_modyfikacji = date('Y-m-d'); // Bieżąca data
        $data_wygasniecia = $_POST['data_wygasniecia'];
        $cena_netto = floatval($_POST['cena_netto']);
        $podatek_vat = floatval($_POST['podatek_vat']);
        $ilosc_magazyn = intval($_POST['ilosc_magazyn']);
        $status_dostepnosci = isset($_POST['status_dostepnosci']) ? 1 : 0;
        $kategoria = htmlspecialchars($_POST['kategoria']);
        $gabaryt_produktu = htmlspecialchars($_POST['gabaryt_produktu']);
        $zdjecie = htmlspecialchars($_POST['zdjecie']);

        $query = "UPDATE produkty SET 
                  tytul = ?, opis = ?, data_modyfikacji = ?, data_wygaśnięcia = ?, cena_netto = ?, podatek_vat = ?, ilosc_magazyn = ?, status_dostepnosci = ?, kategoria = ?, gabaryt_produktu = ?, zdjecie = ?
                  WHERE id = ?";
        $stmt = $link->prepare($query);
        $stmt->bind_param('sssddddisssi', $tytul, $opis, $data_modyfikacji, $data_wygasniecia, $cena_netto, $podatek_vat, $ilosc_magazyn, $status_dostepnosci, $kategoria, $gabaryt_produktu, $zdjecie, $id);
        $stmt->execute();

        header("Location: admin.php?action=products");
        exit;
    }

    $query = "SELECT tytul, opis, data_wygaśnięcia, cena_netto, podatek_vat, ilosc_magazyn, status_dostepnosci, kategoria, gabaryt_produktu, zdjecie FROM produkty WHERE id = ?";
    $stmt = $link->prepare($query);
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    echo '<h2>Edytuj produkt</h2>';
    echo '<form method="POST">';
    echo 'Tytuł: <input type="text" name="tytul" value="' . htmlspecialchars($row['tytul']) . '" required><br><br>';
    echo 'Opis: <textarea name="opis" rows="5" cols="50">' . htmlspecialchars($row['opis']) . '</textarea><br><br>';
    echo 'Data wygaśnięcia: <input type="date" name="data_wygasniecia" value="' . $row['data_wygaśnięcia'] . '"><br><br>';
    echo 'Cena netto: <input type="text" name="cena_netto" value="' . $row['cena_netto'] . '" required><br><br>';
    echo 'Podatek VAT (%): <input type="text" name="podatek_vat" value="' . $row['podatek_vat'] . '" required><br><br>';
    echo 'Ilość w magazynie: <input type="number" name="ilosc_magazyn" value="' . $row['ilosc_magazyn'] . '" required><br><br>';
    echo 'Dostępny: <input type="checkbox" name="status_dostepnosci" ' . ($row['status_dostepnosci'] ? 'checked' : '') . '><br><br>';
    echo 'Kategoria: <input type="text" name="kategoria" value="' . htmlspecialchars($row['kategoria']) . '"><br><br>';
    echo 'Gabaryt produktu: <input type="text" name="gabaryt_produktu" value="' . htmlspecialchars($row['gabaryt_produktu']) . '"><br><br>';
    echo 'Link do zdjęcia: <input type="text" name="zdjecie" value="' . htmlspecialchars($row['zdjecie']) . '"><br><br>';
    echo '<input type="submit" value="Zapisz">';
    echo '</form>';
}


function UsunProdukt() {
    global $link;

    $id = intval($_GET['id']);
    $query = "DELETE FROM produkty WHERE id = ?";
    $stmt = $link->prepare($query);
    $stmt->bind_param('i', $id);
    $stmt->execute();

    header("Location: admin.php?action=products");
    exit;
}

if (isset($_GET['action'])) {
    switch ($_GET['action']) {
        case 'products':
            PokazProdukty();
            break;
        case 'add_product':
            DodajProdukt();
            break;
        case 'edit_product':
            EdytujProdukt();
            break;
        case 'delete_product':
            UsunProdukt();
            break;
        // Inne case...
    }
}


?>

</body>
</html>
