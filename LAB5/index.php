<!DOCTYPE html>
<html>
<head>
	<script src="js/kolorujtlo.js" type="text/javascript"></script>
	<script src="js/timedate.js" type="text/javascript" ></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="Author" content="Jakub Dmochowski">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<title>Historia lotów kosmicznych</title>
</head>
<body onload="startclock()">
	<div id="zegarek"></div>
	<div id="data"></div>
	<header>
		<h1>Historia Lotów Kosmicznych</h1>
		<nav>
			<ul>
			<li><a href="index.php?idp=glowna">Strona Główna</a></li>
        	<li><a href="index.php?idp=pierwszeloty">Pierwsze Loty</a></li>
        	<li><a href="index.php?idp=apollo">Program Apollo</a></li>
        	<li><a href="index.php?idp=promykosmiczne">Era Promów Kosmicznych</a></li>
        	<li><a href="index.php?idp=stacjekosmiczne">Międzynarodowa Stacja Kosmiczna</a></li>
        	<li><a href="index.php?idp=kontakt">Kontakt</a></li>
            <li><a href="index.php?idp=filmy">Filmy</a></li>
            </ul>
		</nav>	
	</header>


<?php
error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);

    if (empty($_GET['idp'])) {
        $strona = './html/glowna.html';
    } 
    elseif ($_GET['idp'] == 'apollo') {
        $strona = './html/apollo.html';
    } 
    elseif ($_GET['idp'] == 'kontakt') {
        $strona = './html/kontakt.html';
    } 
    elseif ($_GET['idp'] == 'pierwszeloty') {
        $strona = './html/pierwszeloty.html';
    }
    elseif ($_GET['idp'] == 'promykosmiczne') {
			$strona = './html/promykosmiczne.html';
    }
    elseif ($_GET['idp'] == 'stacjekosmiczne') {
        $strona = './html/stacjekosmiczne.html';
    }
     elseif ($_GET['idp'] == 'filmy') {
        $strona = './html/filmy.html';
    }
    else {
        $strona = './html/glowna.html';
    }

    if (file_exists($strona)) {
        include($strona);
    } else {
        echo 'Strony nie ma';
    }

 $nr_indeksu = '169236';
 $nrGrupy = '1';

 echo'Jakub Dmochowski'.$nr_indeksu.' Grupa '.$nrGrupy.' <br /><br />';
?>

</body>
</html>