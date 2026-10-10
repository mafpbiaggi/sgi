<?php
class Congregacao extends SecretariaAppModel
{
	public $useTable = 'congregacoes';

	public $hasOne = array(
		'EnderecoCongregacao' => array(
			'className' => 'Secretaria.EnderecoCongregacao',
			'foreignKey' => 'congregacao_id',
			'dependent' => true,
		),
		'Contato' => array(
			'className' => 'Secretaria.Contato',
			'foreignKey' => 'congregacao_id',
			'dependent' => true,
		),
	);
}
