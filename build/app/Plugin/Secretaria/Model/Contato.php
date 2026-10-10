<?php
class Contato extends SecretariaAppModel
{
	public $belongsTo = array(
		'Congregacao' => array(
			'className' => 'Secretaria.Congregacao',
			'foreignKey' => 'congregacao_id',
			'dependent' => true,
		),
	);
}
