<!DOCTYPE html>
<html lang="pl">
<head>
    <!-- Metadane strony -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Jakub Dmochowski">
    <title>Historia lotów kosmicznych</title>

    <!-- Łączenie stylów i skryptów -->
    <link rel="stylesheet" type="text/css" href="css/stylee.css">
    <script src="js/kolorujtlo.js" type="text/javascript"></script>
    <script src="js/timedate.js" type="text/javascript"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body onload="startclock()">
    <!-- Zegar i data -->
    <div id="zegarek"></div>
    <div id="data"></div>

    <!-- Przycisk logowania -->
    <div class="login-a">
        <a href="admin/admin.php" class="login-b">Zaloguj się</a>
    </div>

    <!-- Nagłówek i nawigacja -->
    <header>
        <h1>Historia Lotów Kosmicznych</h1>
        <nav>
            <ul>
                <li><a href="index.php?idp=1">Strona Główna</a></li>
                <li><a href="index.php?idp=5">Pierwsze Loty</a></li>
                <li><a href="index.php?idp=3">Program Apollo</a></li>
                <li><a href="index.php?idp=6">Era Promów Kosmicznych</a></li>
                <li><a href="index.php?idp=7">Międzynarodowa Stacja Kosmiczna</a></li>
                <li><a href="index.php?idp=4">Kontakt</a></li>
                <li><a href="index.php?idp=2">Filmy</a></li>
            </ul>
        </nav>
    </header>

    <!-- Główna sekcja treści -->
    <?php
    include('./admin/cfg.php');
    include('./admin/showpage.php');
    include('./admin/contact.php');

    // Obsługa zakładek strony
    $strona_id = isset($_GET['idp']) ? intval($_GET['idp']) : 1;

    if ($strona_id === 4) {
        echo "<h1>Kontakt</h1>";
        echo PokazKontakt();

        // Obsługa wysyłki formularza kontaktowego
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['x1_submit'])) {
            WyslijMailKontakt("169236@student.uwm.edu.pl");
        }

        echo "<br><a href='index.php?idp=4&reset=1'>Odzyskanie hasła</a>";

        if (isset($_GET['reset'])) {
            echo "<h1>Odzyskanie Hasła</h1>";
            echo PokazKontaktHaslo();

            if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['email_recov'])) {
                PrzypomnijHaslo("164455@student.uwm.edu.pl");
            }
        }
    } else {
        $tresc_strony = PokazPodstrone($strona_id);
        if ($tresc_strony === '[nie_znaleziono_strony]') {
            echo "<p>Strony nie ma</p><br><br>";
        } else {
            echo $tresc_strony;
        }
    }

    // Stopka z informacjami
    $nr_indeksu = '169236';
    $nrGrupy = '1';
    echo "<footer>";
    echo "Jakub Dmochowski $nr_indeksu Grupa $nrGrupy v1.8 <br><br>";
    echo "</footer>";
    ?>
</body>
</html>
