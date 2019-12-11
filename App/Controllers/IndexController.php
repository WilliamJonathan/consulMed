<?php

namespace App\Controllers;

//os recursos do miniframework
use MF\Controller\Action;
use MF\Model\Container;

class IndexController extends Action {

	public function validartoken() {
		$usuario = Container::getModel('Usuario');
		$usuario->gerarToken();
		
	}

	public function index() {

		$this->render('index');

	}

	public function inscreverse() {

		$this->view->usuario = array(
				'nome_fantasia' => '',
				'email' => '',
				'cnpj' => '',
				'ocupacao' => '',
				'cep' => '',
				'rua' => '',
				'cidade' => '',
				'uf' => '',
				'senha' => '',
			);

		$this->view->erroCadastro = false;
		$this->render('inscreverse');
	}

	public function registrar() {
		//recebe dados do formulario
		$usuario = Container::getModel('Usuario');

		/*$usuario->__set('nome_fantasia', $_POST['nome_fantasia']);
		$usuario->__set('email', $_POST['email']);
		$usuario->__set('cnpj', $_POST['cnpj']);
		$usuario->__set('ocupacao', $_POST['ocupacao']);
		$usuario->__set('cep', $_POST['cep']);
		$usuario->__set('rua', $_POST['rua']);
		$usuario->__set('cidade', $_POST['cidade']);
		$usuario->__set('uf', $_POST['uf']);
		$usuario->__set('senha', md5($_POST['senha']));*/

		//&& count($usuario->getUsuariosEmail()) == 0
		if ($usuario->validarCadastro()) {
				$usuario->cadastrarCli();
				//$usuario->salvar();
				$this->render('cadastro');
			
		}else{
			$this->view->usuario = array(
				'nome_fantasia' => $_POST['nome_fantasia'],
				'email' => $_POST['email'],
				'cnpj' => $_POST['cnpj'],
				'ocupacao' => $_POST['ocupacao'],
				'cep' => $_POST['cep'],
				'rua' => $_POST['rua'],
				'cidade' => $_POST['cidade'],
				'uf' => $_POST['uf'],
				'senha' => $_POST['senha'],
			);

			$this->view->erroCadastro = true;

			$this->render('inscreverse');
		}
	}

	public function entrar() {
		//echo 'Cheguei aqui';
		
		$this->view->login = '';

		$this->view->login = isset($_GET['login']) ? $_GET['login'] : '';
		$this->render('entrar');
	}

}


?>