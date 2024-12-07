<?php


// Wysyłanie wiadomości kontaktowej.


function WyslijMailKontakt($odbiorca) {
    // Sprawdzenie, czy wszystkie wymagane pola są wypełnione
    if (empty($_POST['email']) || empty($_POST['title']) || empty($_POST['content'])) {
        // Wyświetlenie komunikatu o niewypełnionych polach
        echo '[niewypelnione_pole]';
        // Wywołanie funkcji do wyświetlenia formularza kontaktowego
        echo PokazKontakt();
    } else {
        // Przypisanie danych wejściowych do zmiennych
        $mail['sender'] = htmlspecialchars($_POST['email'], ENT_QUOTES, 'UTF-8');
        $mail['subject'] = htmlspecialchars($_POST['title'], ENT_QUOTES, 'UTF-8');
        $mail['body'] = htmlspecialchars($_POST['content'], ENT_QUOTES, 'UTF-8');
        $mail['recipient'] = $odbiorca;

        // Tworzenie nagłówków wiadomości e-mail
        $header  = "From: Formularz kontaktowy <" . $mail['sender'] . ">\n";
        $header .= "MIME-Version: 1.0\nContent-Type: text/plain; charset=utf-8\nContent-Transfer-Encoding: 8bit\n";
        $header .= "X-Sender: <" . $mail['sender'] . ">\n";
        $header .= "X-Mailer: PHP/" . phpversion() . "\n";
        $header .= "X-Priority: 3\n";
        $header .= "Return-Path: <" . $mail['sender'] . ">\n";

        // Wysłanie wiadomości e-mail
        mail($mail['recipient'], $mail['subject'], $mail['body'], $header);

        // Wyświetlenie komunikatu o wysłanej wiadomości
        echo '[wiadomosc_wyslana]';
    }
}


// Wysyłanie wiadomości z przypomnieniem hasła.

function PrzypomnijHaslo($odbiorca) {
    // Sprawdzenie, czy pole z adresem e-mail jest wypełnione
    if (empty($_POST['email_recov'])) {
        // Wyświetlenie komunikatu o niewypełnionym polu
        echo '[niewypelnione_pole]';
        // Wywołanie funkcji do wyświetlenia formularza przypomnienia hasła
        echo PokazKontaktHaslo();
    } else {
        // Przypisanie danych wejściowych do zmiennych
        $mail['sender'] = htmlspecialchars($_POST['email_recov'], ENT_QUOTES, 'UTF-8');
        $mail['subject'] = "Password Recovery";
        $mail['body'] = "Password = Admin"; // Upewnij się, że hasło jest odpowiednio zabezpieczone w prawdziwej aplikacji
        $mail['recipient'] = $odbiorca;

        // Tworzenie nagłówków wiadomości e-mail
        $header  = "From: Formularz kontaktowy <" . $mail['sender'] . ">\n";
        $header .= "MIME-Version: 1.0\nContent-Type: text/plain; charset=utf-8\nContent-Transfer-Encoding: 8bit\n";
        $header .= "X-Sender: <" . $mail['sender'] . ">\n";
        $header .= "X-Mailer: PHP/" . phpversion() . "\n";
        $header .= "X-Priority: 3\n";
        $header .= "Return-Path: <" . $mail['sender'] . ">\n";

        // Wysłanie wiadomości e-mail
        mail($mail['recipient'], $mail['subject'], $mail['body'], $header);

        // Wyświetlenie komunikatu o wysłanej wiadomości
        echo '[haslo_wyslane]';
    }
}


// Wyświetla formularz kontaktowy.

function PokazKontakt() {
    $wynik = '
    <div class="form_email">
        <form method="post" name="LoginForm" enctype="multipart/form-data" action="' . htmlspecialchars($_SERVER['REQUEST_URI'], ENT_QUOTES, 'UTF-8') . '">
            <table class="form_email">
                <tr>
                    <td class="log4_t">Email: </td>
                    <td><input type="text" name="email" class="form_email" /></td>
                </tr>
                <tr>
                    <td class="log4_t">Tytuł: </td>
                    <td><input type="text" name="title" class="form_email" /></td>
                </tr>
                <tr>
                    <td class="log4_t">Zawartość: </td>
                    <td><textarea name="content" class="form_email"></textarea></td>
                </tr>
                <tr>
                    <td></td>
                    <td><input type="submit" name="x1_submit" class="form_email" value="Wyślij" /></td>
                </tr>
            </table>
        </form>
    </div>
    ';
    return $wynik;
}

// Wyświetla formularz przypomnienia hasła.

function PokazKontaktHaslo() {
    $wynik = '
    <div class="form_passrecov">
        <form method="post" name="LoginForm" enctype="multipart/form-data" action="' . htmlspecialchars($_SERVER['REQUEST_URI'], ENT_QUOTES, 'UTF-8') . '">
            <table class="form_passrecov">
                <tr>
                    <td class="log4_t">Email: </td>
                    <td><input type="text" name="email_recov" class="form_passrecov" /></td>
                </tr>
                <tr>
                    <td></td>
                    <td><input type="submit" name="x1_submit" class="form_passrecov" value="Wyślij" /></td>
                </tr>
            </table>
        </form>
    </div>
    ';
    return $wynik;
}
?>
