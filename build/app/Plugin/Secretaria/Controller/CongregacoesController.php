<?php
class CongregacoesController extends SecretariaAppController
{
	public $uses = array('Secretaria.Congregacao');

	private function sanitize()
	{
		$validator = new BaseValidator;

		$resultCongregacao = $validator->sanitizeFields($this->request->data['Congregacao']);
		$resultEndereco = $validator->sanitizeFields($this->request->data['EnderecoCongregacao']);
		$resultContato = $validator->sanitizeFields($this->request->data['Contato']);

		$this->request->data['Congregacao'] = $resultCongregacao;
		$this->request->data['EnderecoCongregacao'] = $resultEndereco;
		$this->request->data['Contato'] = $resultContato;
	}

	public function index()
	{
		$filtro = isset($this->request->data['filtro']) ? trim($this->request->data['filtro']) : '';

		$conditions = array();
		if (!empty($filtro)) {
			$includes = array('nome', 'email');
			$fields = $this->Congregacao->schema();

			foreach ($fields as $key => $value) {
				if (in_array($key, $includes)) {
					$conditions['OR']['Congregacao.' . $key . ' LIKE'] = '%' . $filtro . '%';
				}
			}
		}

		$congregacoes = $this->paginate($conditions);
		$this->set('congregacoes', $congregacoes);
	}

	public function add()
	{
		if ($this->request->is('post') || $this->request->is('put')) {
			$this->sanitize();

			$this->Congregacao->create();
			if ($this->Congregacao->saveAll($this->request->data)) {
				json_encode('Congregação cadastrada com sucesso.');

			} else {
				json_encode('Erro ao cadastrar congregação.');
			}
		}
	}

	public function edit($id = null)
	{
		$this->Congregacao->id = $id;
		if (!$this->Congregacao->exists()) {
			throw new NotFoundException(__('Congregacao inválida.'));
		}
		
		if ($this->request->is('post') || $this->request->is('put')) {
			$this->request->data['Congregacao']['id'] = $id;
			$this->request->data['Contato']['id'] = $this->getContato($id);
			$this->request->data['EnderecoCongregacao']['id'] = $this->getEndereco($id);
			$this->sanitize();

			if ($this->Congregacao->saveAll($this->request->data)) {
				json_encode('Congregação editada com sucesso.');
			} else {
				json_encode('Erro ao editar congregação.');
			}
		}
		$this->request->data = $this->Congregacao->read(null, $id);
	}

	public function delete($id = null)
	{
		if (!$this->request->is('post') || empty($id)) {
			throw new MethodNotAllowedException();
		}

		$this->Congregacao->id = $id;
		if (!$this->Congregacao->exists()) {
			throw new NotFoundException(__('Congregacao inválida.'));
		}

		if ($this->Congregacao->delete()) {
			json_encode('Congregação deletada com sucesso.');
		} else {
			json_encode('Erro ao deletar congregação.');
		}
	}

	private function getContato($congregacao_id = null)
	{
		$contato = $this->Congregacao->Contato->find('first', array(
				'conditions' => array('Contato.congregacao_id' => $congregacao_id),
				'fields' => 'Contato.id',
				'recursive' => -1,
			)
		);

		return $contato['Contato']['id'];
	}

	private function getEndereco($congregacao_id = null)
	{
		$endereco = $this->Congregacao->EnderecoCongregacao->find('first', array(
				'conditions' => array('EnderecoCongregacao.congregacao_id' => $congregacao_id),
				'fields' => 'EnderecoCongregacao.id',
				'recursive' => -1,
			)
		);

		return $endereco['EnderecoCongregacao']['id'];
	}
}
