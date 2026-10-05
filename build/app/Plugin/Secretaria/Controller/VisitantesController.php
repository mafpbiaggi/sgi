<?php
class VisitantesController extends SecretariaAppController
{
	private function sanitize()
	{
		$validator = new BaseValidator;

		$result = $validator->validateAllFields($this->request->data['Visitante']);
		$this->request->data['Visitante'] = $result['sanitized'];
	}

	public function index()
	{
		$this->Visitante->recursive = -1;

		$conditions = array();
		if (!empty($this->request->data['filtro']))	{
			$excludes = array('created', 'modified', 'church_id', 'user_id');
			
			$fields = $this->Visitante->schema();
			foreach ($fields as $key => $value) {
				if (!in_array($key, $excludes)) {
					$conditions['OR']['Visitante.'.$key.' LIKE '] = '%'.$this->request->data['filtro'].'%';
				}
			}
		}

		$visitantes = $this->Visitante->find('all', array('conditions' => $conditions));
		$this->set('visitantes', $visitantes);
	}

	public function add()
	{
		if ($this->request->is('post') || $this->request->is('put')) {
			if (!empty($this->request->data['Visitante']['dataVisita'])) {
				$this->request->data['Visitante']['dataVisita'] = implode('-', array_reverse(explode('/', $this->request->data['Visitante']['dataVisita'])));
			}

			$this->Visitante->create();
			$this->sanitize();

			if ($this->Visitante->saveAll($this->request->data)) {
				$this->Session->setFlash('Visitante cadastrado com sucesso!');
			
			} else {
				$this->Session->setFlash('Não foi possível cadastrar o Visitante');
			}
		}
	}

	public function edit($id = null)
	{
		$this->Visitante->id = $id;
		if (!$this->Visitante->exists()) {
			throw new NotFoundException(__('Visitante inválido.'));
		}

		if ($this->request->is('post') || $this->request->is('put')) {
			if (!empty($this->request->data['Visitante']['dataVisita'])) {
				$this->request->data['Visitante']['dataVisita'] = implode('-', array_reverse(explode('/', $this->request->data['Visitante']['dataVisita'])));
			}

			$this->sanitize();
			if ($this->Visitante->saveAll($this->request->data)) {
				$this->Session->setFlash('Visitante editado com sucesso!');
			} else {
				$this->Session->setFlash('Erro ao editar visitante.');
			}

		} else {
			$this->request->data = $this->Visitante->read(null, $id);

			$dataVisita = $this->request->data['Visitante']['dataVisita'];

			$dataVisita = explode(' ', $dataVisita);
			$dataVisita = explode('-', $dataVisita[0]);

			$this->request->data['Visitante']['dataVisita'] = $dataVisita[2]."/".$dataVisita[1]."/".$dataVisita[0];
		}
	}

	public function delete($id = null)
	{
		if (!$this->request->is('post') || empty($id)) {
			throw new MethodNotAllowedException();
		}
		$this->request->data = $this->Visitante->read(null, $id);
		$this->Visitante->id = $id;
		if (!$this->Visitante->exists()) {
			throw new NotFoundException(__('Visitante inválido.'));
		}
		if ($this->Visitante->delete()) {
			$this->Session->setFlash(__('Visitante deletado com sucesso.'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('O Visitante não pôde ser deletado.'));
		$this->redirect(array('action' => 'index'));
	}
}
