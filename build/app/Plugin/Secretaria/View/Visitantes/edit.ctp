<?php
echo $this->Form->create('Visitante', array('role' => 'form', 'class' => 'desable-form formModal'));
echo $this->element('desbloquearForm');

echo $this->Form->input('dataVisita', array('label' => 'Data da Visita', 'type' => 'text', 'class' => 'form-control', 'div' => array('class' => 'form-group col-md-3'), 'required' => 'required'));
echo $this->Form->input('nome', array('label' => 'Nome', 'class' => 'form-control', 'div' => array('class' => 'form-group col-md-9'), 'required' => 'required'));
echo $this->Form->input('idade', array('label' => 'Idade', 'class' => 'form-control', 'div' => array('class' => 'form-group col-md-3'), 'required' => 'required'));
echo $this->Form->input('telefone', array('label' => 'Telefone', 'class' => 'form-control', 'div' => array('class' => 'form-group col-md-3')));
echo $this->Form->input('email', array('label' => 'E-mail', 'class' => 'form-control', 'div' => array('class' => 'form-group col-md-6')));
echo $this->Form->input('frequentaIgreja', array('label' => 'Frequenta Igreja?', 'class' => 'form-control', 'div' => array('class' => 'form-group col-md-6')));
echo $this->Form->input('pedidoOracao', array('label' => 'Pedido de Oração', 'class' => 'form-control', 'div' => array('class' => 'form-group col-md-6')));

$options = array('INDICACAO' => 'Indicação', 'CONVITE' => 'Convite', 'MORO_PERTO' => 'Moro perto', 'REDES_SOCIAIS' => 'Redes Sociais', 'OUTRO' => 'Outro');
echo $this->Form->input('origem', array('id' => 'origem','label' => 'Origem' ,'class' => 'form-control', 'options' => $options, 'required', 'div' => array('class' => 'form-group col-md-2'))); 
echo $this->Form->input('redesSociaisComp', array('id' => 'redesSociaisComp' ,'label' => 'Qual rede social?', 'class' => 'form-control', 'disabled' => 'disabled','div' => array('class' => 'form-group col-md-5')));
echo $this->Form->input('outroComp', array('id' => 'outroComp', 'label' => 'Qual outra origem?', 'class' => 'form-control', 'disabled' => 'disabled', 'div' => array('class' => 'form-group col-md-5')));

echo $this->element('modal/controleForm');
echo $this->element('botoesForm');
echo $this->Form->end();
?>

<script type="text/javascript" src="/js/toggleFieldVisitante.js"></script>
