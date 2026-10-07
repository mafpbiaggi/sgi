<?php
class Membro extends SecretariaAppModel {
	public $belongsTo = array(
		'Secretaria.Estado',
		'Secretaria.Profissao',
		'Secretaria.Cargo',
		'Secretaria.Escolaridade',
	);

	public $hasOne = array(
		'Endereco' => array(
			'className' => 'Secretaria.Endereco',
			'foreignKey' => 'membro_id',
			'dependent' => true,
		),
		'HistoricoMembro' => array(
			'className' => 'Secretaria.HistoricoMembro',
			'foreignKey' => 'membro_id',
			'dependent' => true,
		),
	);

	public $all = false;

	public $hasMany = array(
		'Secretaria.Relacionamento',
		'Secretaria.Movimentacaoata',
	);

	public function beforeFind($queryData){
		$queryData = parent::beforeFind($queryData);
		return $queryData;
	}
}
