<?php
require('cfg.php');

// Obsługa akcji (dodawanie, edytowanie, usuwanie produktów)
if (isset($_GET['action'])) {
    switch ($_GET['action']) {
        case 'add':
            include 'product_add.php';
            break;
        case 'edit':
            include 'product_edit.php';
            break;
        case 'delete':
            include 'product_delete.php';
            break;
        default:
            echo '<p>Nieznana akcja.</p>';
    }
    exit;
}

// Wyświetlanie listy produktów
echo '<h2>Produkty</h2>';
echo '<a href="?action=add_product">Dodaj nowy produkt</a><br><br>';

$query = "SELECT * FROM products";
$result = mysqli_query($link, $query);

echo '<table border="1">';
echo '<tr><th>ID</th><th>Tytuł</th><th>Cena</th><th>Akcje</th></tr>';
while ($row = mysqli_fetch_assoc($result)) {
    echo '<tr>';
    echo '<td>' . $row['id'] . '</td>';
    echo '<td>' . htmlspecialchars($row['title']) . '</td>';
    echo '<td>' . $row['price'] . '</td>';
    echo '<td>
        <a href="?action=edit_product&id=' . $row['id'] . '">Edytuj</a> |
        <a href="?action=delete_product&id=' . $row['id'] . '" onclick="return confirm(\'Czy na pewno chcesz usunąć?\')">Usuń</a>
    </td>';
    echo '</tr>';
}
echo '</table>';
?>
