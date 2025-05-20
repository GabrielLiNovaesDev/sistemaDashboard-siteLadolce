<?php


session_start();//Início da sessão, AMTES de qualuqer saída

//Carregar as configurações iniciais da aplicação
require_once('../config/config.php');


//Carregar a rota (url da aplicação)
$nucleo = new Rotas();
$nucleo -> executar();