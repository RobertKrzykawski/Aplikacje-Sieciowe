<?php
// CalcCtrl.class.php
require_once $conf->root_path.'/lib/smarty/Smarty.class.php';
require_once $conf->root_path.'/lib/Messages.class.php';
require_once $conf->root_path.'/app/CalcForm.class.php';
require_once $conf->root_path.'/app/CalcResult.class.php';

class CalcCtrl {
    private $form;
    private $result;

    public function __construct(){
		//stworzenie potrzebnych obiektów
		$this->messages = new Messages();
		$this->form = new CalcForm();
		$this->result = new CalcResult();
	}

    public function getParams(){
		$this->form->amount = isset($_REQUEST ['amount']) ? $_REQUEST ['amount'] : null;
		$this->form->years = isset($_REQUEST ['years']) ? $_REQUEST ['years'] : null;
		$this->form->interest = isset($_REQUEST ['interest']) ? $_REQUEST ['interest'] : null;
	}

    public function validate() {

        if ( ! (isset($this->form->amount) && isset($this->form->interest) && isset($this->form->years))) {
            // sytuacja wystąpi kiedy np. kontroler zostanie wywołany bezpośrednio - nie z formularza
            // teraz zakładamy, ze nie jest to błąd. Po prostu nie wykonamy obliczeń
            return false;
        }

        if ( $this->form->amount == "") {
            $this->messages->addError('Nie podano kwoty kredytu.');
        }
        if ( $this->form->years == "") {
            $this->messages->addError('Nie podalno liczby lat.');
        }
        if (  $this->form->interest == "") {
            $this->messages->addError('Nie podano oprocentowania.');
        }

        if (! $this->messages->isError()) {
            if (! is_numeric( $this->form->amount )) {
                $this->messages->addError('Wprowadzona wartość dla kwoty nie jest liczbą.');
            }

            if (! is_numeric( $this->form->years )) {
                $this->messages->addError('Wprowadzona ilość lat nie jest liczbą.');
            }	
            if (! is_numeric( $this->form->interest )) {
                $this->messages->addError('Wprowadzone oprocentowanie nie jest liczbą.');
            } 
        }

        return ! $this->messages->isError();
    }

    public function process() {

        $this->getparams();

        if ($this->validate()) {
					
            $this->form->amount = floatval($this->form->amount);
            $this->form->years = floatval($this->form->years);
            $this->form->interest = floatval($this->form->interest);
            $this->messages->addInfo('Parametry poprawne.');
          
            $this->result->result = round((($this->form->amount * ($this->form->interest/100)) + $this->form->amount)/ ($this->form->years * 12),2);
            $this->result->total =  $this->result->result * $this->form->years * 12;
            
            $this->messages->addInfo('Wykonano obliczenia.');
    }

        $this->generateView();
    }

    public function generateView(){
		global $conf;
		
		$smarty = new Smarty();
		$smarty->assign('conf',$conf);
		
		$smarty->assign('page_title', 'Projekt kalkulatora kredytowego - Obiektowy PHP z szablonami Smarty');
        $smarty->assign('page_description', 'Profesjonalne szablonowanie oparte na bibliotece Smarty oraz funkcjonalność aplikacji zamknięta w metodach różnych obiektów');
        $smarty->assign('page_header', 'Szablony Smarty oraz OOP'); 

        $smarty->assign('messages', $this->messages);
        $smarty->assign('form', $this->form);
        $smarty->assign('result', $this->result);
		
		$smarty->display($conf->root_path.'/app/CalcView.html');
	}
}
?>
