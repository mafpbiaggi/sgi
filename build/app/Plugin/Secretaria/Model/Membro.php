<?php
class Membro extends SecretariaAppModel {
	public $belongsTo = array(
		'Secretaria.Profissao',
		'Secretaria.Cargo',
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
