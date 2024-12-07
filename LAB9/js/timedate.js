// --- Globalne zmienne ---
var timerID = null; // ID timera, używane do zarządzania funkcją setTimeout()
var timerRunning = false; // Flaga informująca, czy zegar jest aktualnie uruchomiony

/**
 * Funkcja do pobierania dzisiejszej daty i wyświetlania jej w elemencie o id "data".
 */
function gettheDate() {
    // Tworzenie obiektu Date reprezentującego dzisiejszą datę
    var Todays = new Date();
    
    // Tworzenie łańcucha znaków w formacie "dd/mm/yy"
    var TheDate = Todays.getDate() + "/" + (Todays.getMonth() + 1) + "/" + (Todays.getYear() - 100);
    
    // Ustawianie wygenerowanej daty w elemencie HTML o id "data"
    document.getElementById("data").innerHTML = TheDate;
}

/**
 * Funkcja do zatrzymania zegara.
 */
function stopclock() {
    // Sprawdzenie, czy zegar jest aktualnie uruchomiony
    if (timerRunning) {
        clearTimeout(timerID); // Zatrzymanie aktualnego timera
    }
    timerRunning = false; // Ustawienie flagi na false, aby wskazać, że zegar jest zatrzymany
}

/**
 * Funkcja do uruchomienia zegara.
 */
function startclock() {
    // Zatrzymanie zegara przed uruchomieniem nowego
    stopclock();
    
    // Pobranie dzisiejszej daty
    gettheDate();
    
    // Uruchomienie funkcji wyświetlającej aktualny czas
    showtime();
}

/**
 * Funkcja do wyświetlania aktualnego czasu.
 */
function showtime() {
    // Pobranie bieżącego czasu
    var now = new Date();
    var hours = now.getHours();
    var minutes = now.getMinutes();
    
    // Formatowanie godziny w 12-godzinnym formacie
    var timevalue = "" + ((hours > 12) ? hours - 12 : hours);
    timevalue += ((minutes < 10) ? ":0" : ":") + minutes; // Dodanie minuty z wiodącym zerem, jeśli konieczne
    timevalue += (hours >= 12) ? " P.M." : " A.M."; // Dodanie oznaczenia AM/PM
    
    // Ustawienie wyświetlania aktualnego czasu w elemencie o id "zegarek"
    document.getElementById("zegarek").innerHTML = timevalue;
    
    // Ustawienie wywołania funkcji showtime() co 1000 ms 
    timerID = setTimeout(showtime, 1000);
    timerRunning = true; // Ustawienie flagi na true, aby wskazać, że zegar jest uruchomiony
}
