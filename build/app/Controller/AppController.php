<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

App::uses('Controller', 'Controller');
App::uses('BaseValidator', 'Validator');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {
	public $components = array(
		'Session',
        'Auth'
    );
    public $pluginT;
	public $controllerT;
	public $actionT;

    public function beforeFilter() {
    	umask(0);
        if ($this->request->isAjax()) {
            $this->layout = false;
        }
    	$this->Auth->allow(array('login', 'logout', 'teste', 'addUser'));

    	$this->pluginT = array(
			'Patrimonio' => 'Patrimônio',
		);

		$this->controllerT = array(
			'Pages' => 'Inicial',
			'Users' => 'Usuários',
			'Relatorios' => 'Relatórios',
			'TipoBem' => 'Tipo de Bem',
			'Calendarios' => 'Eventos',
			'Congregacaos' => 'Congregações',
			'Profissaos' => 'Profissões',
			'Tiporelacionamentos' => 'Tipo de Relacionamentos',
		);

		$this->actionT = array(
			'add' => 'Cadastrar',
			'delete' => 'Deletar',
			'edit' => 'Editar',
			'index' => 'Home',
			'view' => 'Visualizar',
			'movimentacao_bens' => 'Movimentação de Bens',
			'permissao_padrao' => 'Permissões Padrão',
		);

        $this->set('pluginT', $this->pluginT);
		$this->set('controllerT', $this->controllerT);
		$this->set('actionT', $this->actionT);

        $this->loadModel('Permission');
		$acesso = $this->request->params;
		$user_id = $this->Session->read('Auth.User.id');

		$actionAllow = array(
			'login',
			'logout',
		);

		$controllerAllow = array(
			'tipo_bem',
			'departamento',
			'autores',
			'categorias',
			'editoras',
			'tipos',
			'tiporelacionamentos',
			'pages'

		);

		if (!empty($user_id) && (!in_array($acesso['action'], $actionAllow)) && (!in_array($acesso['controller'], $controllerAllow))) {
			if(is_null($acesso['plugin'])){
				$acesso['plugin'] = '';
			}

			$id = $this->Session->read('Auth.User.id');

			$plugin = $this->plugin;
			$controller = $this->name;
			$action = $acesso['action'];

			if (empty($plugin)) { 
				$plugin = '';
			}

			$permissao = $this->Permission->find(
				'first', 
				array(
					'conditions' => array(
						'controller' => $controller, 
						'action' => $action, 
						'plugin' => $plugin, 
						'user_id' => $id
					)
				)
			);

			if (((empty($permissao))  || ($permissao['Permission']['allowed'] == 0)) && $action != 'addUser') {
				throw new ForbiddenException('Acesso negado. Consulte o responsável pelas permissões no sistema.');
			}
		}

    	$this->loadModel('User');
    	$user = $this->User->read(null, $this->Session->read('Auth.User.id'));
    	
    	$this->Session->write('User', $user['User']);
	}
}
