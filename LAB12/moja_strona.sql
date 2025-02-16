-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 14, 2025 at 08:48 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `moja_strona`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `matka` int(11) DEFAULT 0,
  `nazwa` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `matka`, `nazwa`) VALUES
(17, 1, 'Rakieta');

-- --------------------------------------------------------

--
-- Table structure for table `page_list`
--

CREATE TABLE `page_list` (
  `id` int(1) NOT NULL,
  `page_title` varchar(255) NOT NULL,
  `page_content` text NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `page_list`
--

INSERT INTO `page_list` (`id`, `page_title`, `page_content`, `status`) VALUES
(1, 'Glowna', '<div id=\"zegarek\"></div>\r\n<div id=\"data\"></div>\r\n	\r\n<main>\r\n	<section>\r\n		<h2>Witamy na stronie o historii lotów kosmicznych</h2>\r\n		<a>Ta strona przedstawia początki pierwszych podróży w kosmos, aż po dzisiejsze misje kosmiczne</a>\r\n		<div class=\"zdjecia\">\r\n			<img src=\"img\\000GDQUBGMQSTRCH-C461-F4.jpg\" alt=\"Zdjęcie 1\">\r\n			<img src=\"img\\265b5693.jpg\" alt=\"Zdjęcie 2\">\r\n			<img src=\"img\\1000_470_matched__p19les_fa67b45bcb6910da5fce1aa23212da83.jpg\" alt=\"Zdjęcie 3\">\r\n			<img src=\"img\\lot-w-kosmos.jpg\" alt=\"Zdjęcie 4\">\r\n			<img src=\"img\\aaa.jpg\" alt=\"Zdjęcie 5\">\r\n			<img src=\"img\\rakieta-spacex.jpg\" alt=\"Zdjęcie 6\">\r\n			<img src=\"img\\space-shuttle-g316e60b66_1280-768x512.png\" alt=\"Zdjęcie 7\">\r\n			<img src=\"img\\ccc.jpg\" alt=\"Zdjęcie 8\">\r\n			<img src=\"img\\v-2.jpg\" alt=\"Zdjęcie 9\">\r\n			<img src=\"img\\original.jpg\" alt=\"Zdjęcie 10\">\r\n			<img src=\"img\\qrhmol-gfh.jpg\" alt=\"Zdjęcie 11\">\r\n			<img src=\"img\\ddd.jpg\" alt=\"Zdjęcie 12\">\r\n			<img src=\"img\\d2c346dd99d12acf8f1ff0d7e905fbdd.jpg\" alt=\"Zdjęcie 13\">\r\n			<img src=\"img\\1.jpg\" alt=\"Zdjęcie 14\">\r\n			<img src=\"img\\282dcd86-6bbb-489b-a459-e5faec0374a2.jpg\" alt=\"Zdjęcie 15\">\r\n		</div>\r\n	</section>\r\n</main>\r\n\r\n<div class=\"kolorki\">\r\n\r\n<form method=\"POST\" name=\"background\">\r\n        <input type=\"button\" value=\"Żółty\" onclick=\"changeBackground(\'#FFFF00\')\">\r\n        <input type=\"button\" value=\"Czarny\" onclick=\"changeBackground(\'#000000\')\">\r\n        <input type=\"button\" value=\"Biały\" onclick=\"changeBackground(\'#FFFFFF\')\">\r\n        <input type=\"button\" value=\"Zielony\" onclick=\"changeBackground(\'#00FF00\')\">\r\n        <input type=\"button\" value=\"Niebieski\" onclick=\"changeBackground(\'#0000FF\')\">\r\n        <input type=\"button\" value=\"Pomarańczowy\" onclick=\"changeBackground(\'#FF8000\')\">\r\n        <input type=\"button\" value=\"Szary\" onclick=\"changeBackground(\'#C0C0C0\')\">\r\n        <input type=\"button\" value=\"Czerwony\" onclick=\"changeBackground(\'#FF0000\')\">\r\n        <input type=\"button\" value=\"Podstawowy\" onclick=\"changeBackground(\'#FFFFFF\')\">\r\n   </form>\r\n</div>\r\n\r\n\r\n<div id=\"animacje-kontener\">\r\n\r\n<div id=\"animacjaTestowa1\" class=\"test-block\" >Kliknij by powiększyć</div>\r\n\r\n    <script>\r\n        $(\'#animacjaTestowa1\').on(\'click\', function() {\r\n            $(this).animate({\r\n                width: \"500px\",\r\n                opacity: 0.4,\r\n                fontSize: \"3em\",\r\n                borderWidth: \"10px\"\r\n            }, 1500);\r\n        });\r\n    </script>\r\n\r\n<div id=\"animacjaTestowa2\" class=\"test-block\">Kliknij by rozszerzyć</div> \r\n\r\n <script>\r\n\r\n $(\"#animacjaTestowa2\").on({\"mouseover\" : function() {\r\n    $(this).animate({\r\n    width: 550\r\n      }, 1000);\r\n     },\r\n    \"mouseout\" : function() {\r\n    $(this).animate({\r\n    width: 350\r\n   }, 5000);\r\n }\r\n});\r\n\r\n</script>\r\n\r\n<div id=\"animacjaTestowa3\" class=\"test-block\">Kliknij, by powiększać</div>\r\n\r\n    <script>\r\n        $(\'#animacjaTestowa3\').on(\'click\', function() {\r\n            if (!$(this).is(\':animated\')) {\r\n                $(this).animate({\r\n                    width: \"+=\" + 50,\r\n                    height: \"+=\" + 10,\r\n                    duration: 3000 \r\n                });\r\n            }\r\n        });\r\n  	</script>\r\n\r\n</div>\r\n\r\n', 1),
(2, 'Filmy', '<div id=\"zegarek\"></div>\r\n<div id=\"data\"></div>\r\n\r\n  <main>\r\n        <section>\r\n            <h2>Wybrane filmy o historii lotów kosmicznych</h2>\r\n            <div class=\"vid1\">\r\n                <div class=\"video\">\r\n                    <h3>Apollo: Największe Osiągnięcie Ludzkości</h3>\r\n                    <iframe width=\"560\" height=\"315\" src=\"https://www.youtube.com/embed/Ft5Xketg7tA\" \r\n                            title=\"Apollo: Największe Osiągnięcie Ludzkości\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture\" allowfullscreen></iframe>\r\n                </div>\r\n\r\n                <div class=\"vid2\">\r\n                    <h3>Apollo Program: Tragedy and Triumph</h3>\r\n                    <iframe width=\"560\" height=\"315\" src=\"https://www.youtube.com/embed/55Jas5HrzcQ\"\r\n                            title=\"Apollo Program: Tragedy and Triumph\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture\" allowfullscreen></iframe>\r\n                </div>\r\n                \r\n                <div class=\"vid3\">\r\n                    <h3>5 NAJWAŻNIEJSZYCH momentów w historii lotów kosmicznych</h3>\r\n                    <iframe width=\"560\" height=\"315\" src=\"https://www.youtube.com/embed/rrOgZnBrjXs\" \r\n                            title=\"5 NAJWAŻNIEJSZYCH momentów w historii lotów kosmicznych\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture\" allowfullscreen></iframe>\r\n                </div>\r\n            </div>\r\n        </section>\r\n    </main>', 1),
(3, 'Apollo', '<div id=\"zegarek\"></div>\r\n<div id=\"data\"></div>\r\n\r\n<main>\r\n	<section>\r\n		<h2>Program apollo</h2>\r\n\r\n			<p>\r\n				Program Apollo – seria amerykańskich lotów kosmicznych przygotowywanych od roku 1961 i zrealizowanych w latach 1966–1972. Celem programu było lądowanie człowieka na Księżycu, a następnie jego bezpieczny powrót na Ziemię. Zadanie zostało zrealizowane w 1969 roku, w czasie misji Apollo 11. Program był kontynuowany do roku 1972 w celu przeprowadzenia dokładniejszej naukowej eksploracji Księżyca: Amerykanie lądowali na Księżycu sześciokrotnie. Całkowity koszt programu wyniósł 25,4 miliarda dolarów. Ilość pozyskanego i dostarczonego na Ziemię materiału to 381,7 kg (ponad dwa tysiące próbek). Lądowanie człowieka na Księżycu wymagało zaledwie sześciu lotów próbnych. Nazwa programu pochodziła od Apollo, syna Zeusa i Leto.\r\n\r\n				</p>\r\n\r\n				<br>\r\n				<p>\r\n				Dla tego jeszcze niesprecyzowanego projektu wybrano już nazwę. Abe Silverstein, szef biura Programów Lotów Kosmicznych, który rok wcześniej wymyślił nazwę Merkury, zaproponował nazwę Apollo. Podobnie jak w przypadku większości amerykańskich programów kosmicznych, nazwa została zaczerpnięta ze starożytnej mitologii. W mitologii greckiej Apollo, opiekun muzyki, medycyny \r\n				i wiedzy, często był utożsamiany z Heliosem, którego rydwan z konnym zaprzęgiem wiózł słońce po niebie.\r\n				</p>\r\n\r\n				<br>\r\n\r\n				<p>Program został opracowany w 1961 roku na zlecenie NASA. Zakładał, że pierwsze lądowanie człowieka na Księżycu powinno nastąpić w latach 1968–1970. Przed przystąpieniem do jego realizacji przeprowadzono szerokie badania powierzchni Księżyca i jego otoczenia za pomocą sond księżycowych: Ranger, Surveyor i satelitów Księżyca – Lunar Orbiter. Program Apollo był trzecim (po programie Mercury oraz programie Gemini) programem amerykańskich lotów kosmicznych z udziałem ludzi. Apollo został zlecony przez administrację prezydenta Eisenhowera w celu rozszerzenia załogowych lotów kosmicznych rozpoczętych przez program Mercury. Następnie został przeobrażony przez prezydenta Kennedy’ego w program lotów i lądowania na Księżycu. \r\n			</p>\r\n\r\n			<br>\r\n\r\n		<div class=\"zdjecia\">\r\n			<img src=\"img/apollo.jpg\" alt=\"Zdjęcie 1\">\r\n			<img src=\"img/apollo11.png\" alt=\"Zdjęcie 2\">\r\n		</div>\r\n	</section>\r\n</main>\r\n\r\n', 1),
(4, 'Kontakt', '<div id=\"zegarek\"></div>\r\n<div id=\"data\"></div>\r\n\r\n<main>\r\n    <div class=\"content\">\r\n        <h2>Skontaktuj się z nami</h2>\r\n        <form action=\"mailto:twojemail@example.com\" method=\"POST\" enctype=\"text/plain\">\r\n            <label for=\"name\">Imię:</label><br>\r\n            <input type=\"text\" id=\"name\" name=\"name\" required><br><br>\r\n\r\n            <label for=\"email\">Adres e-mail:</label><br>\r\n            <input type=\"email\" id=\"email\" name=\"email\" required><br><br>\r\n\r\n            <label for=\"message\">Wiadomość:</label><br>\r\n            <textarea id=\"message\" name=\"message\" rows=\"4\" required>', 0),
(5, 'PierwszeLoty', '<div id=\"zegarek\"></div>\r\n<div id=\"data\"></div>\r\n\r\n<main>\r\n	<section>\r\n		<h2>Pierwsze loty w kosmos</h2>\r\n\r\n			<p>\r\n			12 kwietnia 1961 roku radziecki kosmonauta i pilot wojskowy Jurij Gagarin jako pierwszy człowiek w historii okrążył Ziemię w przestrzeni kosmicznej.\r\n			</p>\r\n			<p>Lot trwał 108 minut. Lecąc z prędkością ponad 27 tysięcy kilometrów na godzinę, Jurij Gagarin przeleciał nad Pacyfikiem, Południową Ameryką, Atlantykiem i nad Afryką. Statek Wostok 1 był kierowany wyłącznie z Ziemi, a kosmonauta mógł przejąć kontrolę tylko w ostateczności, wprowadzając specjalny kod. </p>\r\n\r\n			<br>\r\n\r\n			<p>W czasie lotu Jurij Gagarin gwizdał melodię pieśni \"Ojczyzna słyszy, Ojczyzna wie\". Pierwsze słowa, jakie wypowiedział, będąc na orbicie okołoziemskiej, brzmiały: \"Ach, jak pięknie\".</p>\r\n			<p>W trakcie lotu oddalił się od Ziemi na 327 kilometrów więcej, niż planowano, bo zaciął się silnik napędowy. Rekord wysokości lotu ustanowiony przez Jurija Gagarina utrzymał się potem przez wiele lat.</p>\r\n\r\n			<br>\r\n\r\n			<p>Pierwszy orbitalny lot wokół Ziemi był triumfem radzieckiego programu kosmicznego, ale też triumfem radzieckiej propagandy, która przez wiele lat ukrywała przed całym światem fakt, że Jurij Gagarin nie wrócił na Ziemię we wnętrzu kosmicznego pojazdu, lecz katapultował się z niego na wysokości 7 km. Rosjanie obawiali się, że Międzynarodowa Federacja Lotnicza nie uzna lotu, który skończył się lądowaniem na spadochronie.</p>\r\n			<p>Radziecki sukces ogłoszony światu w okresie \"zimnej wojny\" zmobilizował Stany Zjednoczone do realizacji programu Apollo.</p>\r\n\r\n			<br>\r\n\r\n			<p>Po powrocie Gagarin stał się bohaterem Związku Radzieckiego i symbolem przewagi ZSRR nad Stanami Zjednoczonymi w wyścigu kosmicznym.</p>\r\n\r\n			<br>\r\n\r\n			<p>Nawet najzagorzalsi antykomuniści darzyli go sympatią, bo był to prosty rosyjski chłopak, który zapisał się w historii ludzkości - mówił prof. Paweł Wieczorkiewicz w audycji Arkadiusza Ekierta z cyklu \"Piękny i bestia\". </p>\r\n		\r\n	</section>\r\n</main>', 1),
(6, 'PromyKosmiczne', '<div id=\"zegarek\"></div>\r\n<div id=\"data\"></div>\r\n	\r\n<main>\r\n	<section>\r\n		<h2>Historia wahadłowców</h2>\r\n\r\n			<p>\r\n				Do czynnej służby trafiły jedynie trzy typy promów – amerykańskie Space Shuttle w ramach programu Space Transportation System (STS) i wojskowe bezzałogowe X-37B, oraz radzieckie promy programu Buran. \r\n\r\n				</p>\r\n\r\n				<br>\r\n				<p>\r\n				Pierwszym w historii astronautyki wahadłowcem był amerykański statek kosmiczny Columbia (pierwszy lot 12–14 kwietnia 1981), następnie zostały wprowadzone do eksploatacji amerykańskie wahadłowce: Challenger (uległ katastrofie 28 stycznia 1986), Discovery, Atlantis i Endeavour. Loty wahadłowców wznowiono w lipcu 2005 (STS-114) po przerwie spowodowanej katastrofą Columbii w 2003 (STS-107). \r\n				</p>\r\n\r\n				<br>\r\n\r\n				<p>Promy radzieckie wykonały zaledwie jeden lot przed zawieszeniem, a następnie zakończeniem programu ich budowy. 15 listopada 1988 odbył swój inauguracyjny (bezzałogowy) i jedyny lot kosmiczny po orbicie okołoziemskiej radziecki wahadłowiec Buran, wyniesiony w przestrzeń kosmiczną przez rakietę nośną Energia. \r\n			</p>\r\n\r\n			<br>\r\n\r\n			<p>Amerykańska agencja NASA korzystała z promów kosmicznych do 2011. Ich głównym zadaniem było w ostatnich latach dostarczanie załóg, zaopatrzenia i elementów konstrukcyjnych Międzynarodowej Stacji Kosmicznej. Do tego celu ma być wykorzystany w przyszłości statek Orion lub podobne konstrukcje firmy Boeing lub SpaceX, które jednak nie mają charakteru samolotu kosmicznego i lądować mają na spadochronach jak statki Apollo lub Sojuz.\r\n			</p>\r\n\r\n			<br>\r\n\r\n			<p>Siły Powietrzne Stanów Zjednoczonych wykorzystują dwa egzemplarze bezzałogowego niewielkiego wahadłowca X-37B wyprodukowanego przez przedsiębiorstwo Boeing. Są one przystosowane do wielomiesięcznej pracy na orbicie. Od 2010 odbyły się cztery wielomiesięczne loty tych statków. 9 września 2017 X-37B znalazł się piąty raz na orbicie. Po raz pierwszy wyniosła go rakieta Falcon 9 należąca do prywatnej firmy SpaceX.  \r\n			</p>\r\n\r\n			<br>\r\n\r\n		<div class=\"zdjecia\">\r\n			<img src=\"img/spacex.jpg\" alt=\"Zdjęcie 1\" style=\"width: 400px; height: 300px;\">\r\n		</div>\r\n		\r\n	</section>\r\n</main>\r\n', 1),
(7, 'StacjeKosmiczne', '<div id=\"zegarek\"></div>\r\n<div id=\"data\"></div>\r\n\r\n<main>\r\n	<section>\r\n		<h2>Pierwsza stacja kosmiczna</h2>\r\n\r\n	 <div class=\"tabela\" style = \"background-color: #fff;\">\r\n        <table style = \"background-color: #fff; border: 2px; border-color: black;\">\r\n            <tr>\r\n                <td>\r\n                   <a>Międzynarodowa Stacja Kosmiczna, MSK (ang. International Space Station, ISS; ros. Международная Космическая Станция, МКС; trb.: Mieżdunarodnaja Kosmiczeskaja Stancyja, MKS) – pierwsza stacja kosmiczna wybudowana z założenia przy współudziale wielu państw. Składa się z 16 głównych modułów (docelowo ma ich liczyć 17) i umożliwia jednoczesne przebywanie siedmiorga członków stałej załogi (trojga do roku 2009, do 2020 w praktyce sześciorga ze względu na ograniczenia transportowe). Pierwsze moduły stacji zostały wyniesione na orbitę okołoziemską i połączone ze sobą w 1998 roku. Pierwsza stała załoga zamieszkała na niej w roku 2000.</a> \r\n                <td>\r\n                	<div class=\"zdjecia\">\r\n					<img src=\"https://bi.im-g.pl/im/fe/af/15/z22740990AMP,Miedzynarodowa-Stacja-Kosmiczna--ISS-.jpg\" label = \"stacja\" alt=\"Stacja\" style=\"width: 900px; height: 600px;\">\r\n					</div>\r\n                	                	\r\n                	</div>\r\n                </td>\r\n                <td></td>\r\n            </tr>\r\n            <tr style=\"background-color: #fff\">\r\n                <td colspan=\"2\">\r\n                	<br><br>\r\n                    <a>Źródłem zasilania MSK są ogniwa słoneczne, transportem ludzi i materiałów do 19 lipca 2011 zajmowały się amerykańskie wahadłowce programu STS (od lutego 2003 do 26 lipca 2005 wstrzymane z powodu katastrofy promu Columbia) oraz rosyjskie statki kosmiczne Sojuz i Progress. Po zakończeniu amerykańskiego programu wahadłowców w 2011 roku, przewoźnikiem astronautów stały się rosyjskie rakiety Sojuz i od 2020 roku amerykański statek Crew Dragon amerykańskiej firmy SpaceX.</a>\r\n                </td>\r\n              </tr>\r\n               <tr style=\"background-color: #fff\">\r\n                <td colspan=\"2\">\r\n                	                    <a>Na stacji znajduje się sprzęt radiowy na potrzeby krótkofalarstwa (projekt ARISS). Ma ona także przydzielone własne znaki wywoławcze: amerykańskie NN1SS oraz NA1SS, rosyjski RZ3DZR oraz niemiecki DL0ISS.\r\n                    	<br><br>\r\n					Administracja prezydenta USA George’a W. Busha planowała wstrzymać finansowanie stacji po 2015 roku, co skutkowałoby zdjęciem stacji z orbity na początku 2016 roku. Późniejsza administracja Obamy przedłużyła jednak finansowanie do 2020 roku, a potencjalnie nawet do 2028.\r\n					<br><br>\r\n					Panele ogniw słonecznych stacji odbijają tyle światła słonecznego, że jest widoczna z Ziemi jako obiekt poruszający się po niebie (w perygeum przy 100% oświetleniu) z jasnością do -5,1 lub -5,9 magnitudo.</a>\r\n					<br><br>\r\n                </td>\r\n              </tr>\r\n        </table>\r\n    </div>\r\n		\r\n	</section>\r\n</main>', 1),
(8, 'sklep', '<div id=\"zegarek\"></div>\r\n<div id=\"data\"></div>\r\n\r\n<h2 style=\"text-align: center;\">SKLEP</h2>\r\n', 1);

-- --------------------------------------------------------

--
-- Table structure for table `produkty`
--

CREATE TABLE `produkty` (
  `id` int(11) NOT NULL,
  `tytul` varchar(255) NOT NULL,
  `opis` text NOT NULL,
  `data_utworzenia` date NOT NULL,
  `data_modyfikacji` date DEFAULT NULL,
  `data_wygasniecia` date NOT NULL DEFAULT current_timestamp(),
  `cena_netto` decimal(10,2) NOT NULL,
  `podatek_vat` decimal(5,2) NOT NULL,
  `ilosc_magazyn` int(11) NOT NULL,
  `status_dostepnosci` tinyint(4) NOT NULL,
  `kategoria` varchar(100) DEFAULT NULL,
  `gabaryt_produktu` varchar(100) DEFAULT NULL,
  `zdjecie` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `produkty`
--

INSERT INTO `produkty` (`id`, `tytul`, `opis`, `data_utworzenia`, `data_modyfikacji`, `data_wygasniecia`, `cena_netto`, `podatek_vat`, `ilosc_magazyn`, `status_dostepnosci`, `kategoria`, `gabaryt_produktu`, `zdjecie`) VALUES
(13, 'Rakieta', 'test', '2025-01-14', NULL, '0000-00-00', 12000.00, 23.00, 1, 1, '17', '10', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTj41xracsWRGtLs5RxVr-DKlgzmDaQY74qNA&amp;s');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `page_list`
--
ALTER TABLE `page_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `produkty`
--
ALTER TABLE `produkty`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `page_list`
--
ALTER TABLE `page_list`
  MODIFY `id` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `produkty`
--
ALTER TABLE `produkty`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
