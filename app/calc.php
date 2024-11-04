<?php
// KONTROLER strony kalkulatora
require_once dirname(__FILE__) . '/../config.php';

//załaduj Smarty
require_once _ROOT_PATH . '/lib/smarty/Smarty.class.php';

// Pobranie parametrów
$amount = $_REQUEST['amount'] ?? null;
$years = $_REQUEST['years'] ?? null;
$interest = $_REQUEST['interest'] ?? null;

// Inicjalizacja tablicy na komunikaty
$messages = [];

$hide_intro = true;

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

$hide_intro = false;

$smarty = new Smarty();

$smarty->assign('app_url', _APP_URL);
$smarty->assign('root_path', _ROOT_PATH);
$smarty->assign('page_title', 'Projekt kalkulatora kredytowego z szablonowaniem');
$smarty->assign('page_description', 'Profesjonalne szablonowanie oparte na bibliotece Smarty');
$smarty->assign('page_header', 'Szablony Smarty');

$smarty->assign('hide_intro', $hide_intro);

$smarty->assign('amount', $amount);
$smarty->assign('years', $years);
$smarty->assign('interest', $interest);
$smarty->assign('messages', $messages ?? []);
$smarty->assign('result', $result ?? null);

// 5. Wywołanie szablonu
$smarty->display(_ROOT_PATH . '/app/calc.html');
