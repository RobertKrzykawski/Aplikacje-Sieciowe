<?php
require_once dirname(__FILE__) . '/../config.php';

// KONTROLER strony kalkulatora

// Ochrona kontrolera - przerywa przetwarzanie, jeśli użytkownik jest niezalogowany
include _ROOT_PATH . '/app/security/check.php';

// Funkcja do pobierania parametrów
function getParams(&$amount, &$years, &$interest) {
    $amount = $_REQUEST['amount'] ?? null;
    $years = $_REQUEST['years'] ?? null;
    $interest = $_REQUEST['interest'] ?? null;
}

// Funkcja do walidacji parametrów
function validate(&$amount, &$years, &$interest, &$messages) {
    if (!$amount || !$years || !$interest) {
        // W przypadku braku danych, nie wykonujemy obliczeń
        return false;
    }

    if ($amount === "") $messages[] = 'Nie podano kwoty';
    if ($years === "") $messages[] = 'Nie podano liczby lat';
    if ($interest === "") $messages[] = 'Nie podano oprocentowania';

    // Zakończ walidację, jeśli brakuje parametrów
    if (!empty($messages)) return false;

    // Sprawdzenie poprawności liczbowej parametrów
    if (!is_numeric($amount) || $amount <= 0) {
        $messages[] = 'Kwota kredytu nie jest poprawną liczbą dodatnią';
    }

    if (!is_numeric($years) || $years <= 0 || intval($years) != $years) {
        $messages[] = 'Liczba lat nie jest poprawną liczbą całkowitą dodatnią';
    }

    if (!is_numeric($interest) || $interest < 0) {
        $messages[] = 'Oprocentowanie nie jest poprawną wartością';
    }

    return empty($messages);
}

// Funkcja do przetwarzania danych i obliczania raty kredytu
function process(&$amount, &$years, &$interest, &$messages, &$result) {
    global $role;

    // Konwersja parametrów
    $amount = floatval($amount);
    $years = intval($years);
    $interest = floatval($interest);

    $months = 12;
    $totalMonths = $years * $months;
    $monthlyRate = $interest / 100 / $months;

    // Obliczenie raty kredytu
    if ($interest < 2 && $role != 'admin') {
        $messages[] = 'Ta opcja jest dostępna tylko dla administratora';
        return;
    }

    $result = $amount * pow(1 + $monthlyRate, $totalMonths) * $monthlyRate / (pow(1 + $monthlyRate, $totalMonths) - 1);
    $result = round($result, 2);
}

// Inicjalizacja zmiennych
$amount = null;
$years = null;
$interest = null;
$result = null;
$messages = [];

// Pobieranie parametrów i przetwarzanie, jeśli walidacja się powiedzie
getParams($amount, $years, $interest);
if (validate($amount, $years, $interest, $messages)) {
    process($amount, $years, $interest, $messages, $result);
}

// Wywołanie widoku z przekazaniem zmiennych
include 'calc_view.php';
