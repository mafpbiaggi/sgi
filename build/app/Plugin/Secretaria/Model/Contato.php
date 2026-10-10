<?php
class Contato extends SecretariaAppModel
{
	public $belongsTo = array(
		'Congreagacao' => array(
			'className' => 'Secretaria.Congregacao',
			'foreignKey' => 'congregacao_id',
			'dependent' => true,
		),
	);
}
