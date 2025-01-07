// --- Globalne zmienne ---
var computed = false; // Zmienna informująca o wykonaniu obliczeń
var decimal = 0; // Zmienna śledząca obecność znaku dziesiętnego w liczbie

function convert(entryform, from, to) {
    // Pobranie indeksów wybranych jednostek
    convertfrom = from.selectedIndex;
    convertto = to.selectedIndex;
    
    // Wykonanie obliczeń konwersji
    entryform.display.value = (entryform.input.value * from[convertfrom].value / to[convertto].value);
}

function addChar(input, character) {
    // Sprawdzenie, czy znak to kropka i czy nie jest już obecna w liczbie
    if ((character == '.' && decimal == 0) || character != '.') {
        // Dodanie znaku lub nadpisanie istniejącej wartości
        (input.value == "" || input.value == "0") ? input.value = character : input.value += character;
        
        // Wywołanie funkcji konwersji po dodaniu znaku
        convert(input.form, input.form.measure1, input.form.measure2);
        computed = true; // Ustawienie flagi informującej o obliczeniach
        
        // Sprawdzenie, czy dodano kropkę dziesiętną
        if (character == '.') {
            decimal = 1;
        }
    }
}

/**
 * Funkcja do otwierania nowego okna przeglądarki.
 */
function openvothcom() {
    window.open("", "Display window", "toolbar=no,directories=no,menubar=no");
}

/**
 * Funkcja do czyszczenia pól formularza.
 * @param {HTMLFormElement} form - Formularz, który ma zostać wyczyszczony.
 */
function clear(form) {
    form.input.value = 0; // Ustawienie wartości wejściowej na 0
    form.display.value = 0; // Ustawienie wartości wyjściowej na 0
    decimal = 0; // Resetowanie zmiennej dla znaku dziesiętnego
}

/**
 * Funkcja do zmiany tła dokumentu.
 * @param {string} hexNumber - Kolor w formacie heksadecymalnym (np. "#FF5733").
 */
function changeBackground(hexNumber) {
    document.bgColor = hexNumber; // Zmiana koloru tła strony
}