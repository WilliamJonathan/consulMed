<?php

namespace App;

use MF\Init\Bootstrap;

class Route extends Bootstrap {

	protected function initRoutes() {

		$routes['home'] = array(
			'route' => '/',
			'controller' => 'indexController',
			'action' => 'index'
		);

		$routes['inscreverse'] = array(
			'route' => '/inscreverse',
			'controller' => 'indexController',
			'action' => 'inscreverse'
		);

		$routes['registrar'] = array(
			'route' => '/registrar',
			'controller' => 'indexController',
			'action' => 'registrar'
		);

		$routes['autenticar'] = array(
			'route' => '/autenticar',
			'controller' => 'AuthController',
			'action' => 'autenticar'
		);

		$routes['timeline'] = array(
			'route' => '/timeline',
			'controller' => 'AppController',
			'action' => 'timeline'
		);

		$routes['sair'] = array(
			'route' => '/sair',
			'controller' => 'AuthController',
			'action' => 'sair'
		);

		$routes['tweet'] = array(
			'route' => '/tweet',
			'controller' => 'AppController',
			'action' => 'tweet'
		);

		$routes['remover_tweet'] = array(
			'route' => '/remover_tweet',
			'controller' => 'AppController',
			'action' => 'remover_tweet'
		);

		$routes['quem_seguir'] = array(
			'route' => '/quem_seguir',
			'controller' => 'AppController',
			'action' => 'quemSeguir'
		);

		$routes['acao'] = array(
			'route' => '/acao',
			'controller' => 'AppController',
			'action' => 'acao'
		);

		$routes['entrar'] = array(
			'route' => '/entrar',
			'controller' => 'IndexController',
			'action' => 'entrar'
		);

		$routes['consultas_confirmadas'] = array(
			'route' => '/consultas_confirmadas',
			'controller' => 'AppController',
			'action' => 'consultas_confirmadas'
		);

		$routes['consultas_atendidas'] = array(
			'route' => '/consultas_atendidas',
			'controller' => 'AppController',
			'action' => 'consultas_atendidas'
		);

		$routes['consultas_pendentes'] = array(
			'route' => '/consultas_pendentes',
			'controller' => 'AppController',
			'action' => 'consultas_pendentes'
		);

		$routes['validartoken'] = array(
			'route' => '/validartoken',
			'controller' => 'IndexController',
			'action' => 'validartoken'
		);

		$routes['agendar_consulta'] = array(
			'route' => '/agendar_consulta',
			'controller' => 'ConsultaController',
			'action' => 'agendar_consulta'
		);

		$this->setRoutes($routes);
	}

}

?>