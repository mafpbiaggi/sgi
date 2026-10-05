<div class="col-md-12">
<?php
		echo $this->Form->create('Ata', array('type' => 'file', 'role' => 'form', 'class' => 'formModal'));
		echo $this->Form->input('num', array('label' => 'Número', 'type' => 'text', 'class' => 'form-control', 'div' => array('class' => 'form-group col-md-12')));
		echo $this->Form->input('data', array('label' => 'Data', 'type' => 'text', 'class' => 'form-control', 'div' => array('class' => 'form-group col-md-12')));
		echo $this->Form->input('file.', array('type' => 'file', 'multiple', 'class' => 'btn btn-default ', 'div' => array('class' => 'form-group col-md-12')));
	?>

	<div class="form-group col-md-2">	
		<button data-dismiss="modal" class="btn btn-default form-control" type="button">Cancelar</button>
	</div>
	
	<?php
		echo $this->Form->input('Salvar', array('type' => 'submit', 'label' => false, 'class' => 'btn btn-success form-control', 'div' => array('class' => 'form-group col-md-4')));
		echo $this->Form->end(); 
	?>
</div>