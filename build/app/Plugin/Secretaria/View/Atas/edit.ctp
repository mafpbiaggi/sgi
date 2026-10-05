<div class="col-md-12">
<?php
	echo $this->Form->create(array('Ata', 'role' => 'form', 'class' => 'desable-form formModal'));

	// destravar o form
	echo $this->element('desbloquearForm');

	echo $this->Form->input('id', array('type' => 'hidden'));
	echo $this->Form->input('num', array('label' => 'Número', 'type' => 'text', 'class' => 'form-control', 'div' => array('class' => 'form-group col-md-12')));
	echo $this->Form->input('data', array('label' => 'Data', 'type' => 'text', 'class' => 'form-control', 'div' => array('class' => 'form-group col-md-12')));
	?>
	<div class="col-md-12 form-group">
		<p>Arquivos da Ata</p>
		<?php
		foreach ($this->request->data['AtaArquivo'] as $key => $file) {
			echo $this->Html->link($file['nome'], array('action' => 'download', $file['id'], $this->request->data['Ata']['id'].'-'.$key), array('download', 'class' => 'btn btn-success'));
			echo '<br/><br />';
		}
?>
</div>
	<?php 

        // modal com confirmação de alteração de cadastro
        echo $this->element('modal/controleForm');

        // botoões do formulário
        echo $this->element('botoesForm');

        echo $this->Form->end(); 
    ?>
</div>
