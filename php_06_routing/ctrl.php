<?php
require_once 'init.php';

getRouter()->setDefaultRoute('calcKomunikat'); // akcja domyślna
getRouter()->setLoginRoute('login'); // akcja gdy brak dostępu

getRouter()->addRoute('calcKomunikat', 'CalcCtrl',  ['user','admin']); // calcKomunikat >> CalcCtrl.php >> action_calcKomunikat()
getRouter()->addRoute('calcCompute', 'CalcCtrl',  ['user','admin']);
getRouter()->addRoute('login', 'LoginCtrl');
getRouter()->addRoute('logout', 'LoginCtrl', ['user','admin']);

getRouter()->go(); 
