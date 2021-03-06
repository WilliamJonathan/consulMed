<?php 

namespace App\Controllers;

//os recursos do miniframework
use MF\Controller\Action;
use MF\Model\Container;

class AuthController extends Action {

	public function autenticar() {
		$usuario = Container::getModel('Usuario');
		
		$usuario->autenticar();

	}

	public function sair() {
		session_start();
		session_destroy();
		header('Location: /');
	}
}
?>