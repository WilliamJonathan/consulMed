<?php 

namespace App\Controllers;

//os recursos do miniframework
use MF\Controller\Action;
use MF\Model\Container;

class AppController extends Action {

	public function timeline() {

		//$_SESSION['dataTeste'] = $_POST['data_e_hora'];

		$this->validarAutenticacao();
			
		$this->render('timeline2');
	
	}

		public function consultas_confirmadas() {
		
		$this->validarAutenticacao();

		$usuario = Container::getModel('Usuario');
		$usuario->__set('id', $_SESSION['id']);

		$this->view->info_usuario = $usuario->getInfoUsuarios();

		$this->render('consultas_confirmadas');
	}

	public function consultas_atendidas() {
		
		$this->validarAutenticacao();

		$usuario = Container::getModel('Usuario');
		$usuario->__set('id', $_SESSION['id']);

		$this->view->info_usuario = $usuario->getInfoUsuarios();

		$this->render('consultas_atendidas');
	}

	public function consultas_pendentes() {
		
		$this->validarAutenticacao();

		//$usuario = Container::getModel('Usuario');
		//$usuario->__set('id', $_SESSION['id']);

		//$this->view->info_usuario = $usuario->getInfoUsuarios();

		$this->render('consultas_pendentes');
	}

	public function validarAutenticacao() {

		session_start();

		if (!isset($_SESSION['id']) || $_SESSION['id'] == '' || !isset($_SESSION['nome_fantasia']) || $_SESSION['id'] == '') {
			header('Location: /?login=erro');
		}else{
			
		}
	}

}
?>