<?php
// CalcForm.class.php
class CalcForm {
    public $amount;
    public $years;
    public $interest;

    public function __construct($amount = null, $years = null, $interest = null) {
        $this->amount = $amount;
        $this->years = $years;
        $this->interest = $interest;
    }

    public function validate() {
        $messages = [];

		// Trim inputs to avoid spaces causing validation issues
		$this->amount = trim($this->amount);
        $this->years = trim($this->years);
        $this->interest = trim($this->interest);

        if (!isset($this->amount, $this->years, $this->interest)) {
            $messages[] = 'Błędne wywołanie aplikacji. Brak jednego z parametrów.';
        } else {
            if ($this->amount === '') {
                $messages[] = 'Nie podano kwoty kredytu';
            }
            if ($this->years === '') {
                $messages[] = 'Nie podano liczby lat';
            }
            if ($this->interest === '') {
                $messages[] = 'Nie podano oprocentowania';
            }

            if (empty($messages)) {
                if (!is_numeric($this->amount) || $this->amount <= 0) {
                    $messages[] = 'Kwota kredytu nie jest poprawną liczbą dodatnią';
                }
                if (!is_numeric($this->years) || $this->years <= 0 || intval($this->years) != $this->years) {
                    $messages[] = 'Liczba lat nie jest poprawną liczbą całkowitą dodatnią';
                }
                if (!is_numeric($this->interest) || $this->interest < 0) {
                    $messages[] = 'Oprocentowanie nie jest poprawną wartością';
                }
            }
        }

        return $messages;
    }
}
?>
