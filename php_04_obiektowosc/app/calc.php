<?php
// calc.php
require_once dirname(__FILE__) . '/../config.php';

require_once $config->root_path.'/app/CalcCtrl.class.php';

$calcCtrl = new CalcCtrl();
list($messages, $result) = $calcCtrl->process();

$smarty = new Smarty();
$smarty->assign('app_url', $config->app_url);
$smarty->assign('root_path', $config->root_path);
$smarty->assign('page_title', 'Projekt kalkulatora kredytowego - Obiektowy PHP z szablonami Smarty');
$smarty->assign('page_description', 'Profesjonalne szablonowanie oparte na bibliotece Smarty oraz funkcjonalność aplikacji zamknięta w metodach różnych obiektów');
$smarty->assign('page_header', 'Szablony Smarty oraz OOP');
$smarty->assign('amount', $calcCtrl->form->amount);
$smarty->assign('years', $calcCtrl->form->years);
$smarty->assign('interest', $calcCtrl->form->interest);
$smarty->assign('messages', $messages ?? []);
$smarty->assign('result', $result ? $result->monthlyPayment : null);
$smarty->display($config->root_path . '/app/calc.html');
?>
