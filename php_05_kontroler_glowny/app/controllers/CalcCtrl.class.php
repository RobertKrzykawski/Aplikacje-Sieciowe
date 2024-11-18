<?php
// CalcCtrl.class.php
namespace app\controllers;

use app\forms\CalcForm;
use app\transfer\CalcResult;

/** Kontroler kalkulatora
 * @author Robert Krzykawski
 *
 */

class CalcCtrl {
    private $form;
    private $result;

    public function __construct() {
        $this->form = new CalcForm();
        $this->result = new CalcResult();
    }

    public function getParams(){
		$this->form->amount = getFromRequest('amount');
        $this->form->interest = getFromRequest('interest');
        $this->form->years = getFromRequest('years'); 
	}

    public function validate() {
        if ( ! (isset($this->form->amount) && isset($this->form->interest) && isset($this->form->years))) {
            return false;
        }

        // Trim inputs to avoid spaces causing validation issues
        $this->form->amount = trim($this->form->amount);
        $this->form->years = trim($this->form->years);
        $this->form->interest = trim($this->form->interest);

        if ( $this->form->amount == "") {
            getMessages()->addError('Nie podano kwoty kredytu.');
        }
        if ( $this->form->years == "") {
            getMessages()->addError('Nie podano liczby lat.');
        }
        if (  $this->form->interest == "") {
            getMessages()->addError('Nie podano oprocentowania.');
        }

        //nie ma sensu walidować dalej gdy brak parametrów
        if (! getMessages()->isError()) {

        // sprawdzenie, czy $x i $y są liczbami całkowitymi
            if (! is_numeric( $this->form->amount )) {
                getMessages()->addError('Wprowadzona wartość dla kwoty nie jest liczbą.');
            }

            if (! is_numeric( $this->form->years )) {
                getMessages()->addError('Wprowadzona ilość lat nie jest liczbą.');
            }	
            if (! is_numeric( $this->form->interest )) {
                getMessages()->addError('Wprowadzone oprocentowanie nie jest liczbą.');
            } 
        }

     return ! getMessages()->isError();
    }

    public function process(){

		$this->getParams();
		
		if ($this->validate()) {
				
                        $this->form->amount = floatval($this->form->amount);
                        $this->form->years = floatval($this->form->years);
                        $this->form->interest = floatval($this->form->interest);
                        getMessages()->addInfo('Parametry poprawne.');
                      
                        $this->result->result = round((($this->form->amount * ($this->form->interest/100)) + $this->form->amount)/ ($this->form->years * 12),2);
                        $this->result->total =  $this->result->result * $this->form->years * 12;
                        
                        getMessages()->addInfo('Wykonano obliczenia.');
                }
                            
		$this->generateView();
	}

    public function generateView(){
		
		getSmarty()->assign('page_title','Kalkulator kredytowy');
        getSmarty()->assign('page_description','Obliczanie miesięcznej raty kredytu.');
        getSmarty()->assign('page_header','Kalkulator');	
		getSmarty()->assign('form',$this->form);
		getSmarty()->assign('res',$this->result);
		getSmarty()->display('CalcView.html');
	}
}
?>
