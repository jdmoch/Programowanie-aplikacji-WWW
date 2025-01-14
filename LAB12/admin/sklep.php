<?php

session_start();
include('cfg.php'); // połączenie z bazą danych

// obsługa formularzy
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['add_to_cart'])) {
        dodajDoKoszyka(
            $_POST['product_id'],
            $_POST['product_name'],
            (float)$_POST['price_netto'],
            (float)$_POST['vat'],
            (int)$_POST['quantity']
        );
    } elseif (isset($_POST['remove_product'])) {
        usunZKoszyka($_POST['product_id']);
    } elseif (isset($_POST['update_quantity'])) {
        zaktualizujIloscWKoszyku($_POST['product_id'], (int)$_POST['new_quantity']);
    }
}

// funkcja wyświetlająca produkty
function pokazProdukty() {
    global $db;
    $query = "SELECT * FROM `produkty` WHERE status_dostepnosci = 1 AND (data_wygasniecia IS NULL OR data_wygasniecia > CURDATE())";
    $result = $db->query($query);

    while ($row = $result->fetch_assoc()) {
        echo "<div class='product'>";
        echo "<h3>" . htmlspecialchars($row['tytul']) . "</h3>";
        echo "<p>Opis: " . htmlspecialchars($row['opis']) . "</p>";
        echo "<p>Data utworzenia: " . htmlspecialchars($row['data_utworzenia']) . "</p>";
        echo "<p>Cena netto: " . number_format($row['cena_netto'], 2) . " PLN</p>";
        echo "<p>VAT: " . number_format($row['podatek_vat'], 2) . "%</p>";
        echo "<p>Kategoria: " . htmlspecialchars($row['kategoria']) . "</p>";
        echo "<p>Gabaryt: " . htmlspecialchars($row['gabaryt_produktu']) . "</p>";
        echo "<p>Zdjęcie: <img src='" . htmlspecialchars($row['zdjecie']) . "' alt='Zdjęcie produktu' style='width: 100px; height: auto;'></p>";

        echo "<form method='POST'>
                <input type='hidden' name='product_id' value='" . $row['id'] . "'>
                <input type='hidden' name='product_name' value='" . htmlspecialchars($row['tytul']) . "'>
                <input type='hidden' name='price_netto' value='" . $row['cena_netto'] . "'>
                <input type='hidden' name='vat' value='" . $row['podatek_vat'] . "'>
                <input type='number' name='quantity' value='1' min='1' max='" . $row['ilosc_magazyn'] . "'>
                <button type='submit' name='add_to_cart'>Dodaj do koszyka</button>
              </form>";
        echo "</div>";
    }
}

// funkcja dodająca produkt do koszyka
function dodajDoKoszyka($productId, $productName, $priceNetto, $vat, $quantity) {
    $priceBrutto = $priceNetto * (1 + $vat / 100);
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

    $_SESSION['cart'][$productId] = [
        'name' => $productName,
        'priceNetto' => $priceNetto,
        'priceBrutto' => $priceBrutto,
        'vat' => $vat,
        'quantity' => $quantity,
    ];
    echo "<p class='success'>Produkt dodany do koszyka.</p>";
}

// funkcja aktualizująca ilość produktu w koszyku
function zaktualizujIloscWKoszyku($productId, $newQuantity) {
    if (!isset($_SESSION['cart'][$productId])) {
        echo "<p class='error'>Produkt nie znajduje się w koszyku.</p>";
        return;
    }

    if ($newQuantity <= 0) {
        usunZKoszyka($productId);
        return;
    }

    $_SESSION['cart'][$productId]['quantity'] = $newQuantity;
    echo "<p class='success'>Zaktualizowano ilość produktu.</p>";
}

// funkcja usuwająca produkt z koszyka
function usunZKoszyka($productId) {
    if (isset($_SESSION['cart'][$productId])) {
        unset($_SESSION['cart'][$productId]);
        if (empty($_SESSION['cart'])) {
            unset($_SESSION['cart']);
        }
        echo "<p class='success'>Produkt usunięty z koszyka.</p>";
    }
}

// funkcja wyświetlająca koszyk
function pokazKoszyk() {
    if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
        echo "<p>Koszyk jest pusty.</p>";
        return;
    }

    $total = 0;
    echo "<table border='1'>";
    echo "<tr>
            <th>Tytuł</th>
            <th>Cena netto</th>
            <th>VAT</th>
            <th>Cena brutto</th>
            <th>Ilość</th>
            <th>Wartość</th>
            <th>Akcje</th>
          </tr>";

    foreach ($_SESSION['cart'] as $productId => $product) {
        $subtotal = $product['priceBrutto'] * $product['quantity'];
        $total += $subtotal;
        echo "<tr>
                <td>" . htmlspecialchars($product['name']) . "</td>
                <td>" . number_format($product['priceNetto'], 2) . " PLN</td>
                <td>" . number_format($product['vat'], 2) . "%</td>
                <td>" . number_format($product['priceBrutto'], 2) . " PLN</td>
                <td>
                    <form method='POST'>
                        <input type='hidden' name='product_id' value='$productId'>
                        <input type='number' name='new_quantity' value='" . $product['quantity'] . "' min='0'>
                        <button type='submit' name='update_quantity'>Aktualizuj</button>
                    </form>
                </td>
                <td>" . number_format($subtotal, 2) . " PLN</td>
                <td>
                    <form method='POST'>
                        <input type='hidden' name='product_id' value='$productId'>
                        <button type='submit' name='remove_product'>Usuń</button>
                    </form>
                </td>
              </tr>";
    }
    echo "<tr><td colspan='5'>Łączna wartość</td><td colspan='2'>" . number_format($total, 2) . " PLN</td></tr>";
    echo "</table>";
}
?>

<style>

    .container {
        width: 80%;
        margin: 0 auto;
        padding-top: 20px;
    }

    .product {
        background-color: #fff;
        border: 1px solid #ddd;
        padding: 15px;
        margin-bottom: 20px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    .product h3 {
        color: #333;
        font-size: 1.5em;
    }

    .product p {
        font-size: 1em;
        color: #555;
    }

    .product img {
        max-width: 100px;
        height: auto;
        margin-bottom: 10px;
    }

</style>