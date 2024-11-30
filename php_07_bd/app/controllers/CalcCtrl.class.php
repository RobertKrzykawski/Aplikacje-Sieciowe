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

    public function action_calcCompute(){

		$this->getParams();
		
		if ($this->validate()) {
				
            $this->form->amount = floatval($this->form->amount);
            $this->form->years = floatval($this->form->years);
            $this->form->interest = floatval($this->form->interest);
            
            if (inRole('admin')){
                $this->result->result = round((($this->form->amount * ($this->form->interest/100)) + $this->form->amount)/ ($this->form->years * 12),2);
                $this->result->total =  $this->result->result * $this->form->years * 12;
                getMessages()->addInfo('Wykonano obliczenia.');
                $this->toDB();
            }
            if (inRole('user') && $this->form->amount <= 4000){
                $this->result->result = round((($this->form->amount * ($this->form->interest/100)) + $this->form->amount)/ ($this->form->years * 12),2);
                $this->result->total =  $this->result->result * $this->form->years * 12;
                getMessages()->addInfo('Wykonano obliczenia.');
                $this->toDB();
            }
            if (inRole('user') && $this->form->amount > 4000){
                getMessages()->addError('Tylko administrator może obliczyć ratę dla kwoty powyżej 4000 zł!');
            }
        }                  
		$this->generateView();
	}

    public function toDB(){
        try { 
            $database = new \Medoo\Medoo([
                'type' => 'mysql',
                'host' => 'localhost',
                'database' => 'kredyt',
                'username' => 'root',
                'password' => '',
                'charset' => 'utf8',
                'collation' => 'utf8_polish_ci',
                'port' => 3306,
                'option' => [
                    \PDO::ATTR_CASE => \PDO::CASE_NATURAL,
                    \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION
                ],    
                
        ]);
            
            $database->insert("wynik",[
                "kwota" => $this->form->amount,
                "lat" => $this->form->years,
                "procent" => $this->form->interest,
                "rata" => $this->result->result,
                "total" => $this->result->total,
                "data" => date("Y-m-d H:i:s")
            ]);
            getMessages()->addInfo('Obliczenia zapisano do historii.');
        } catch (\PDOException $ex) {
            getMessages()->addError("DB Error: ".$ex->getMessage());

        }
    }

    public function action_calcKomunikat(){
		getMessages()->addInfo('Jesteś zalogowany. Wprowadź dane.');
		$this->generateView();
	}

    public function generateView(){
		
		getSmarty()->assign('user',unserialize($_SESSION['user']));
		getSmarty()->assign('page_title','Kalkulator kredytowy');
        getSmarty()->assign('page_description','Obliczanie miesięcznej raty kredytu.');
        getSmarty()->assign('page_header','Kalkulator');	
		getSmarty()->assign('form',$this->form);
		getSmarty()->assign('res',$this->result);
		getSmarty()->display('CalcView.html');
	}
}