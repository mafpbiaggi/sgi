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
			
			$ata = $this->request->data['Membro']['ataadmissao'];
			$tipo = $this->request->data['Membro']['tipo'];
			$associated = $this->addMovimentacaoHistorico($ata, $tipo);
			
			if ($this->Membro->saveAll($this->request->data, $associated)) {
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
			throw new NotFoundException(__('Membro inválido.'));
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

			$result_tipo = $this->Membro->find('first', array('conditions' => array('Membro.id' => $id), 'fields' => 'Membro.tipo', 'recursive' => -1));
			$tipo_antigo = $result_tipo['Membro']['tipo'];
			$tipo_novo = $this->request->data['Membro']['tipo'];
			
			$associated = "";
			if ($tipo_novo != $tipo_antigo) {
				$ata = $this->request->data['Membro']['ataadmissao'];
				$associated = $this->addMovimentacaoHistorico($ata, $tipo_novo, $tipo_antigo, $id);
			}

			if ($this->Membro->saveAll($this->request->data, $associated)) {
				$this->Session->setFlash(__('Membro editado com sucesso.'));
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
			
			$historico = $this->getMovimentacaoHistorico($id);
			$movimentacoes = $historico['MovimentacaoHistorico'];

			$this->set('cargos', $cargos);
			$this->set('profissoes', $profissoes);
			$this->set('parentes', $parentes);
			$this->set('relacionamentos', $relacionamentos);
			$this->set('movimentacoes', $movimentacoes);

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
			$this->Session->setFlash(__('Membro deletado com sucesso.'));
		}
		$this->Session->setFlash(__('O Membro não pôde ser deletado.'));
	}

	private function addMovimentacaoHistorico($ata, $tipo_novo, $tipo_antigo = null, $id = null)
	{
		$this->request->data['HistoricoMembro'] = array(
			'id' => $this->getHistoricoId($id),
			'modified' => date("Y-m-d H:i:s"),
			'MovimentacaoHistorico' => array(
				array(
					'ataadmissao' => $ata,
					'tipo_antigo' => $tipo_antigo,
					'tipo_novo' => $tipo_novo,
					'user_id' => $this->Auth->user('id'),
				),
			),
		);

		return array(
			'associated' => array(
				'HistoricoMembro',
				'HistoricoMembro.MovimentacaoHistorico',
			),
			'deep' => true,
		);
	}

	private function getMovimentacaoHistorico($membro_id)
	{
		return $this->Membro->HistoricoMembro->find('first', array(
				'conditions' => array('HistoricoMembro.membro_id' => $membro_id),
				'contains' => 'HistoricoMembro.MovimentacaoHistorico',
				'recursive' => 2,
			)
		);
	}

	private function getHistoricoId($membro_id = null)
	{
		$historico = $this->Membro->HistoricoMembro->find('first', array(
				'conditions' => array('HistoricoMembro.membro_id' => $membro_id),
				'fields' => 'HistoricoMembro.id',
				'recursive' => -1,
			)
		);
		return $historico['HistoricoMembro']['id'];
	}
}
