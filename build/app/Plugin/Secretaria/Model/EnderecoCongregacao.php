<?php
class EnderecoCongregacao extends SecretariaAppModel
{
	public $useTable = 'enderecos_congregacoes';

	public $belongsTo = array(
		'Congregacao' => array(
			'className' => 'Secretaria.Congregacao',
            'foreignKey' => 'congregacao_id',
			'dependent' => true,
		),
	);
}
