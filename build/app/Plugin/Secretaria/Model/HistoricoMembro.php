<?php
class HistoricoMembro extends SecretariaAppModel
{
	public $hasMany = array(
		'MovimentacaoHistorico' => array(
            'className' => 'Secretaria.MovimentacaoHistorico',
            'foreignKey' => 'historico_id',
            'dependent' => true,
        ),
	);
}
