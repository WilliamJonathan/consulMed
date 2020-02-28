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
				'telefone' => '',
				'cnpj' => '',
				'ocupacao' => '',
				'cep' => '',
				'rua' => '',
				'num_local' => '',
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

		if ($usuario->validarCadastro()) {
			$usuario->cadastrarCli();
			//$usuario->salvar();
			$this->render('index');
			
		}else{
			$this->view->usuario = array(
				'nome_fantasia' => $_POST['nome_fantasia'],
				'email' => $_POST['email'],
				'telefone' => $_POST['telefone'],
				'cnpj' => $_POST['cnpj'],
				'ocupacao' => $_POST['ocupacao'],
				'cep' => $_POST['cep'],
				'rua' => $_POST['rua'],
				'num_local' => $_POST['num_local'],
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