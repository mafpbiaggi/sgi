<?php
class MovimentacaoHistorico extends SecretariaAppModel
{
    public $useTable = 'movimentacao_historico';

    public $belongsTo = array(
        'HistoricoMembro' => array(
            'className' => 'Secretaria.HistoricoMembro',
            'foreignKey' => 'historico_id',
        ),
        'User' => array(
            'className' => 'User',
            'foreignKey' => 'user_id',
            'fields' => array(
                'User.id',
                'User.nome',
            ),
        ),
    );
}
