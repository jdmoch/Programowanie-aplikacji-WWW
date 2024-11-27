<!DOCTYPE html>
<html>
<head>
	<script src="js/kolorujtlo.js" type="text/javascript"></script>
	<script src="js/timedate.js" type="text/javascript" ></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="Author" content="Jakub Dmochowski">
	<link rel="stylesheet" type="text/css" href="css/stylee.css">
	<title>Historia lotów kosmicznych</title>
</head>
<body onload="startclock()">
	<div id="zegarek"></div>
	<div id="data"></div>
	<div class="login-a"><a href="admin/admin.php" class="login-b">Zaloguj się</a></div>
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

<?php
include('./admin/cfg.php');
include('./admin/showpage.php');
include('./admin/contact.php');

// Obsługa zakładek
if (empty($_GET['idp'])) {
    $strona_id = 1; 
} else {
    $strona_id = $_GET['idp'];
}

if ($strona_id == 4) {
    echo "<h1>Kontakt</h1>";
    echo PokazKontakt();
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
        echo "Strony nie ma<br><br>";
    } else {
        echo $tresc_strony;
    }
}

$nr_indeksu = '169236';
$nrGrupy = '1';
echo "<footer>";
echo "Jakub Dmochowski $nr_indeksu Grupa $nrGrupy v1.7 <br><br>";
echo "</footer>";
?>

</body>
</html>