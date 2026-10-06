<?php
class MembrosController extends SecretariaAppController
{
	private function sanitize()
	{
		$validator = new BaseValidator;

		$resultMembro = $validator->validateAllFields($this->request->data['Membro']);
		$resultEndereco = $validator->validateAllFields($this->request->data['Endereco']);
		
		$this->request->data['Membro'] = $resultMembro['sanitized'];
		$this->request->data['Endereco'] = $resultEndereco['sanitized'];
	}

	public function index()
	{
		$this->Membro->recursive = -1;

		$statusMap = array(
			'ativos' => '1',
			'rol_separado' => '2',
			'demitidos' => '0',
		);

		$filtro = isset($this->request->data['filtro']) ? trim($this->request->data['filtro']) : '';

		$searchConditions = array();
		if (!empty($filtro)) {
			$includes = array('nome', 'email');
			$fields = $this->Membro->schema();

			foreach ($fields as $key => $value) {
				if (in_array($key, $includes)) {
					$searchConditions['OR']['Membro.' . $key . ' LIKE'] = '%' . $filtro . '%';
				}
			}
		}

		$resultados = array();
		foreach ($statusMap as $group => $situacao) {
			$conditions = array(
				'Membro.situacao' => $situacao,
			);

			if (!empty($searchConditions)) {
				$conditions = array_merge($conditions, $searchConditions);
			}

			$resultados[$group] = array(
				'dados' => $this->Membro->find('all', array('conditions' => $conditions)),
				'total' => $this->Membro->find('count', array('conditions' => $conditions)),
			);
		}
		$this->set('resultados', $resultados);
	}

	public function add()
	{
		$this->Membro->create();
		if ($this->request->is('post') || $this->request->is('put')) {
			$this->sanitize();

			$this->request->data['Membro']['datamembro'] = implode('-', array_reverse(explode('/', $this->request->data['Membro']['datamembro'])));
			$this->request->data['Membro']['datanascimento'] = implode('-', array_reverse(explode('/', $this->request->data['Membro']['datanascimento'])));
			$this->request->data['Membro']['datacasamento'] = implode('-', array_reverse(explode('/', $this->request->data['Membro']['datacasamento'])));
			$this->request->data['Membro']['databatismo'] = implode('-', array_reverse(explode('/', $this->request->data['Membro']['databatismo'])));
			$this->request->data['Membro']['dataprofe'] = implode('-', array_reverse(explode('/', $this->request->data['Membro']['dataprofe'])));

			if ($_FILES['arquivo']['tmp_name'] != null) {
				// Pasta onde o arquivo vai ser salvo
				$uploaddir = WWW_ROOT . 'files/profile/';

				// Nome do arquivo editado
				$uploadfile = $uploaddir . 'photo_' . time() . '.png';
				$showfile = '/app/webroot/files/profile/photo_' . time() . '.png';

				// Salvar o caminho no banco de dados
				$this->request->data['Membro']['foto_caminho'] = $uploadfile;
				$this->request->data['Membro']['foto_exibicao'] = $showfile;

				// Salvar o arquivo no diretório (upload efetivo)
				move_uploaded_file($_FILES['arquivo']['tmp_name'], $uploadfile);
			}

			if ($this->Membro->saveAll($this->request->data)) {
				json_encode('Membro Salvo com Sucesso!');
			} else {
				json_encode('Membro Não Salvo!');
			}
		} else {
			$profissoes = $this->Membro->Profissao->find('list', array('fields' => array('id', 'descricao')));
			$cargos = $this->Membro->Cargo->find('list', array('fields' => array('id', 'nome')));
			$parentes = $this->Membro->find('list', array('fields' => array('id', 'nome')));
			$this->loadModel('Secretaria.Tiporelacionamento');
			$relacionamentos = $this->Tiporelacionamento->find('list', array('fields' => array('id', 'descricao')));
			$escolaridades = $this->Membro->Escolaridade->find('list', array('fields' => array('id', 'descricao')));
			$this->set('escolaridades', $escolaridades);
			$this->set('relacionamentos', $relacionamentos);
			$this->set('parentes', $parentes);
			$this->set('cargos', $cargos);
			$this->set('profissoes', $profissoes);
		}
	}

	public function edit($id = null)
	{
		$this->Membro->id = $id;
		if (!$this->Membro->exists()) {
			throw new NotFoundException(__('Membro inválidó.'));
		}

		if ($this->request->is('post') || $this->request->is('put')) {
			$this->sanitize();

			$this->request->data['Membro']['datamembro'] = implode('-', array_reverse(explode('/', $this->request->data['Membro']['datamembro'])));
			$this->request->data['Membro']['datanascimento'] = implode('-', array_reverse(explode('/', $this->request->data['Membro']['datanascimento'])));
			$this->request->data['Membro']['datacasamento'] = implode('-', array_reverse(explode('/', $this->request->data['Membro']['datacasamento'])));
			$this->request->data['Membro']['databatismo'] = implode('-', array_reverse(explode('/', $this->request->data['Membro']['databatismo'])));
			$this->request->data['Membro']['dataprofe'] = implode('-', array_reverse(explode('/', $this->request->data['Membro']['dataprofe'])));

			// Apagar arquivo anterior antes de substituir
			if ($_FILES['arquivo']['name'] != null) {
				unlink($this->request->data['Membro']['arquivo']);

				// Pasta onde o arquivo vai ser salvo
				$uploaddir = WWW_ROOT . 'files/profile/';

				// Nome do arquivo editado
				$uploadfile = $uploaddir . 'photo_' . time() . '.png';
				$showfile = '/app/webroot/files/profile/photo_' . time() . '.png';

				// Salvar o caminho no banco de dados
				$this->request->data['Membro']['foto_caminho'] = $uploadfile;
				$this->request->data['Membro']['foto_exibicao'] = $showfile;

				// Salvar o arquivo no diretório (upload efetivo)
				move_uploaded_file($_FILES['arquivo']['tmp_name'], $uploadfile);
			}

			if ($this->Membro->saveAll($this->request->data)) {
				echo 'Membro Salvo com Sucesso!';
			} else {
				echo 'Membro Não Salvo!';
			}
		} else {
			$this->loadModel('Secretaria.Tiporelacionamento');
		
			$this->request->data = $this->Membro->read(null, $id);
			$profissoes = $this->Membro->Profissao->find('list', array('fields' => array('id', 'nome')));
			$cargos = $this->Membro->Cargo->find('list', array('fields' => array('id', 'nome')));
			$parentes = $this->Membro->find('list', array('fields' => array('id', 'nome')));
			$relacionamentos = $this->Tiporelacionamento->find('list', array('fields' => array('id', 'descricao')));
			$escolaridades = $this->Membro->Escolaridade->find('list', array('fields' => array('id', 'descricao')));

			$this->set('cargos', $cargos);
			$this->set('profissoes', $profissoes);
			$this->set('parentes', $parentes);
			$this->set('relacionamentos', $relacionamentos);
			$this->set('escolaridades', $escolaridades);

			$this->request->data['Membro']['datamembro'] = implode('/', array_reverse(explode('-', $this->request->data['Membro']['datamembro'])));
			$this->request->data['Membro']['datanascimento'] = implode('/', array_reverse(explode('-', $this->request->data['Membro']['datanascimento'])));
			$this->request->data['Membro']['datacasamento'] = implode('/', array_reverse(explode('-', $this->request->data['Membro']['datacasamento'])));
			$this->request->data['Membro']['databatismo'] = implode('/', array_reverse(explode('-', $this->request->data['Membro']['databatismo'])));
			$this->request->data['Membro']['dataprofe'] = implode('/', array_reverse(explode('-', $this->request->data['Membro']['dataprofe'])));
		}
	}

	public function delete($id = null)
	{
		$this->autoRender = false;
		if (!$this->request->is('post') || empty($id)) {
			throw new MethodNotAllowedException();
		}

		$this->request->data = $this->Membro->read(null, $id);
		$this->Membro->id = $id;

		if (!$this->Membro->exists()) {
			throw new NotFoundException(__('Membro inválido.'));
		}
		if ($this->Membro->delete()) {
			unlink($this->request->data['Membro']['foto_caminho']);
			$this->Endereco->delete();
			$this->Session->setFlash(__('Membro deletado com sucesso.'));
		}
		$this->Session->setFlash(__('O Membro não pôde ser deletado.'));
	}
}
