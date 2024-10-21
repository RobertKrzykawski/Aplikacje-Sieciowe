<?php
// KONTROLER strony kalkulatora
require_once dirname(__FILE__) . '/../config.php';

// Pobranie parametrów
$amount = $_REQUEST['amount'] ?? null;
$years = $_REQUEST['years'] ?? null;
$interest = $_REQUEST['interest'] ?? null;

// Inicjalizacja tablicy na komunikaty
$messages = [];

// Walidacja parametrów
if (!isset($amount, $years, $interest)) {
    $messages[] = 'Błędne wywołanie aplikacji. Brak jednego z parametrów.';
} else {
    if ($amount === '') {
        $messages[] = 'Nie podano kwoty kredytu';
    }
    if ($years === '') {
        $messages[] = 'Nie podano liczby lat';
    }
    if ($interest === '') {
        $messages[] = 'Nie podano oprocentowania';
    }

    // Walidacja wartości liczbowych
    if (empty($messages)) {
        if (!is_numeric($amount) || $amount <= 0) {
            $messages[] = 'Kwota kredytu nie jest poprawną liczbą dodatnią';
        }
        if (!is_numeric($years) || $years <= 0 || intval($years) != $years) {
            $messages[] = 'Liczba lat nie jest poprawną liczbą całkowitą dodatnią';
        }
        if (!is_numeric($interest) || $interest < 0) {
            $messages[] = 'Oprocentowanie nie jest poprawną wartością';
        }
    }
}

// Obliczanie raty, jeżeli nie ma błędów
if (empty($messages)) {
    $amount = floatval($amount);
    $years = intval($years);
    $interest = floatval($interest) / 100; // Konwersja procent na format dziesiętny

    $months = 12;
    $totalMonths = $years * $months;

    // Oprocentowanie 0%: prosta rata kapitałowa
    if ($interest == 0) {
        $R = $amount / $totalMonths;
    } else {
        $monthlyRate = $interest / $months;
        // Wzór na miesięczną ratę przy oprocentowaniu > 0
        $R = $amount * pow(1 + $monthlyRate, $totalMonths) * $monthlyRate / (pow(1 + $monthlyRate, $totalMonths) - 1);
    }

    $result = round($R, 2); // Zaokrąglenie do 2 miejsc po przecinku
}

include 'calc_view.php';
