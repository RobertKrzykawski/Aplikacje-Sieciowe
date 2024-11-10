<?php
// CalcCtrl.class.php
require_once $config->root_path.'/lib/smarty/Smarty.class.php';
require_once $config->root_path.'/lib/Messages.class.php';
require_once $config->root_path.'/app/CalcForm.class.php';
require_once $config->root_path.'/app/CalcResult.class.php';


/** Kontroler kalkulatora
 * @author Robert Krzykawski
 *
 */

class CalcCtrl {
    public $form;
    private $result;
    private $config;

    public function __construct() {
        $this->config = $config;
        $this->form = new CalcForm(
            $_REQUEST['amount'] ?? null,
            $_REQUEST['years'] ?? null,
            $_REQUEST['interest'] ?? null
        );
    }

    public function process() {
        $messages = $this->form->validate();

        if (empty($messages)) {
            try {
                $this->calculateMonthlyPayment();
            } catch (Exception $e) {
                $messages[] = 'Wystąpił błąd podczas obliczeń: ' . $e->getMessage();
                $this->result = null;
            }
        } else {
            $this->result = null;
        }

        return [$messages, $this->result];
    }

	private function calculateMonthlyPayment() {
        $amount = (float) $this->form->amount;
        $years = (int) $this->form->years;
        $interest = (float) $this->form->interest / 100;

        $months = 12;
        $totalMonths = $years * $months;

        if ($interest == 0) {
            $monthlyPayment = $amount / $totalMonths;
        } else {
            $monthlyRate = $interest / $months;
            $monthlyPayment = $amount * pow(1 + $monthlyRate, $totalMonths) * $monthlyRate / (pow(1 + $monthlyRate, $totalMonths) - 1);
        }

        $this->result = new CalcResult($monthlyPayment);
    }
}
?>
