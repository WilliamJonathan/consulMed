<?php 

namespace App\Models;

use MF\Model\Model;

class Usuario extends Model {

	private $id;
	private $nome_fantasia;
	private $email;
	private $cnpj;
	private $ocupacao;
	private $cep;
	private $rua;
	private $bairro;
	private $cidade;
	private $uf;
	private $senha;
	private $token;
	private $num_local;

	public function __get($atributo) {
		return $this->$atributo;
	}

	public function __set($atributo, $valor) {
		$this->$atributo = $valor;
	}

	//verifica cadastro valido
	public function validarCadastro() {
		$valido = true;

		if ( !isset($_POST['nome_fantasia']) || strlen($_POST['nome_fantasia']) < 3) {
			$valido = false;
		}

		if (!isset($_POST['email']) || strlen($_POST['email']) < 3) {
			$valido = false;
		}

		if (!isset($_POST['cnpj']) || strlen($_POST['cnpj']) < 3) {
			$valido = false;
		}

		if (!isset($_POST['ocupacao']) || strlen($_POST['ocupacao']) < 3) {
			$valido = false;
		}

		if (!isset($_POST['cep']) || strlen($_POST['cep']) < 3) {
			$valido = false;
		}

		if (!isset($_POST['rua']) || strlen($_POST['rua']) < 3) {
			$valido = false;
		}

		if (!isset($_POST['bairro']) || strlen($_POST['bairro']) < 3) {
			$valido = false;
		}

		if (!isset($_POST['cidade']) || strlen($_POST['cidade']) < 3) {
			$valido = false;
		}

		if (!isset($_POST['uf']) || strlen($_POST['uf']) < 2) {
			$valido = false;
		}

		if (!isset($_POST['senha']) || strlen($_POST['senha']) < 3) {
			$valido = false;
		}

		if (!isset($_POST['num_local']) || strlen($_POST['num_local']) <= 0) {
			$valido = false;
		}

		/*
		if (strlen($this->__get('senha')) < 3) {
			$valido = false;
		}*/

		return $valido;
	}

	//recupera email usuarios e verifica se já existe
	/*public function getUsuariosEmail() {
		$query = "select nome_fantasia, email from usuariosclinica where email = :email";
		$stmt = $this->db->prepare($query);
		$stmt->bindValue(':email', $this->__get('email'));
		$stmt->execute();

		return $stmt->fetchAll(\PDO::FETCH_ASSOC);
	}*/

	/*public function gerarToken() {
		$usuario = array(
				'email' => $_POST['email'],
				'senha' => $_POST['senha'],
			);
		
		$url = 'http://192.168.15.142:8888/public/api/v1/clinica/gerar/token';
		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $usuario);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$resposta = json_decode(curl_exec($ch));
		//var_dump($resposta);
		foreach ($resposta as $key => $value) {
			if ($value == 'erro') {
			echo 'deu ruim';
			}else{
			//var_dump($resposta);
			$usuario = array(
				'email' => $_POST['email'],
				'token' => $value,
			);

			$url = 'http://192.168.15.142:8888/public/api/v1/usuarioclinica/adiciona/token';
			$ch = curl_init($url);
			curl_setopt($ch, CURLOPT_POST, true);
			//curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PATCH');
			curl_setopt($ch, CURLOPT_POSTFIELDS, $usuario);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			$chave = json_decode(curl_exec($ch));
			//echo $value;
			//var_dump($chave);
			}
		}		
	}*/


	public function autenticar() {
		$usuario = array('email' => $_POST['email'], 'senha' => $_POST['senha']);

		//recupera token de usuario para autenticar
		$url = 'http://192.168.15.142:8888/public/api/v1/usuarioclinica/lista/token';
		$ch = curl_init($url);
		/*curl_setopt($ch, CURLOPT_HTTPHEADER, array(
						'X-Token:'.$token
		));*/
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $usuario);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$resposta = json_decode(curl_exec($ch));
		foreach ($resposta as $key => $value);
		if ($value == 'erro') {
			header('Location: /entrar?login=erro');
		}else{
			//var_dump($resposta);
			foreach ($resposta as $key => $value) {
				$token = $value->token;
			}
			//var_dump($token);
			//autentica usuario e envia para timeline
			//$token = '';
			$url = 'http://192.168.15.142:8888/public/api/v1/autentica/login';
			$ch = curl_init($url);
			curl_setopt($ch, CURLOPT_HTTPHEADER, array(
							'X-Token:'.$token
			));
			curl_setopt($ch, CURLOPT_POST, true);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $usuario);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			$resposta = json_decode(curl_exec($ch));
			if ($resposta == null) {
				header('Location: /timeline');
			}else{
				foreach ($resposta as $key => $value){
					if ($value == 'erro') {
						header('Location: /entrar?login=erro');
					}else{
						session_start();
						//var_dump($value);
						$_SESSION['id'] = $value->id;
						$_SESSION['nome_fantasia'] = $value->nome_fantasia;
						$_SESSION['token'] = $value->token;

						header('Location: /timeline');
					}
				}
			}
		}
	}


	public function cadastrarCli() {

		$cnpj = trim($_POST['cnpj']);
		$cnpj = str_replace('.', '', $cnpj);
		$cnpj = str_replace('.', '', $cnpj);
		$cnpj = str_replace('/', '', $cnpj);
		$cnpj = str_replace('-', '', $cnpj);

		$cep = trim($_POST['cep']);
		$cep = str_replace('-', '', $cep);

		$usuario = array(
			'nome_fantasia' => $_POST['nome_fantasia'],
			'email' => $_POST['email'],
			'cnpj' => $cnpj,
			'ocupacao' => $_POST['ocupacao'],
			'cep' => $cep,
			'rua' => $_POST['rua'],
			'num_local' => $_POST['num_local'],
			'bairro' => $_POST['bairro'],
			'cidade' => $_POST['cidade'],
			'uf' => $_POST['uf'],
			'senha' => md5($_POST['senha'])
		);
		
		$url = 'http://192.168.15.142:8888/public/api/v1/usuarioclinica/adiciona';
		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $usuario);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$resposta = json_decode(curl_exec($ch));

		/*echo '<pre>';
		print_r(json_encode($usuario));
		echo '</pre>';*/
		
		$usuariotoken = array(
				'email' => $_POST['email'],
				'senha' => $_POST['senha'],
			);
		
		$url = 'http://192.168.15.142:8888/public/api/v1/clinica/gerar/token';
		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $usuariotoken);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$respostatoken = json_decode(curl_exec($ch));
		//var_dump($resposta);
		foreach ($respostatoken as $key => $value) {
			if ($value == 'erro') {
			echo 'deu ruim';
			}else{
			//var_dump($resposta);
			$usuariotoken = array(
				'email' => $_POST['email'],
				'token' => $value,
			);

			$url = 'http://192.168.15.142:8888/public/api/v1/usuarioclinica/adiciona/token';
			$ch = curl_init($url);
			curl_setopt($ch, CURLOPT_POST, true);
			//curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PATCH');
			curl_setopt($ch, CURLOPT_POSTFIELDS, $usuariotoken);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			$chave = json_decode(curl_exec($ch));
			//echo $value;
			//var_dump($chave);
			}
		}
		
	}

	
	//info usuarios
	public function getInfoUsuarios() {
		$query = "select id from usuariosclinica where id = :id";
		$stmt = $this->db->prepare($query);
		$stmt->bindValue(':id', $this->__get('id'));
		$stmt->execute();

		return $stmt->fetch(\PDO::FETCH_ASSOC);
	}
	
}

?>