<?php
// CalcResult.class.php
class CalcResult {
    public $monthlyPayment;

    public function __construct($monthlyPayment) {
        $this->monthlyPayment = round($monthlyPayment, 2);
    }
}
?>
