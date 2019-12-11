<?php 

namespace App\Controllers;

//os recursos do miniframework
use MF\Controller\Action;
use MF\Model\Container;

class ConsultaController extends Action {

	public function agendar_consulta() {
		$acao = $_GET['acao'];
		//require 'timeline2.php';
		echo 'consulta marcada';
		echo '<br> <br> <br>';
		echo $acao;
			 
	}
}
?>