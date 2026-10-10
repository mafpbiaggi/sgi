<?php echo $this->Form->create('Congregacao', array('role' => 'form', 'class' => 'formModal')); ?>
<div class="col-md-12">
	<div class="row">
		<?php
			echo $this->Form->input('nome', array('label' => 'Denominação', 'type' => 'text', 'class' => 'form-control', 'div' => array('class' => 'form-group col-md-8')));
			echo $this->Form->input('cnpj', array('label' => 'CNPJ ', 'type' => 'text', 'class' => 'cnpj', 'class' => 'form-control', 'div' => array('class' => 'form-group col-md-4')));
		?>
	</div>

	<div class="row">
		<?php
			echo $this->Form->input('Contato.nome', array('label' => 'Contato', 'type' => 'text', 'class' => 'form-control', 'div' => array('class' => 'form-group col-md-3')));
			echo $this->Form->input('Contato.email', array('label' => 'E-mail', 'class' => 'form-control', 'div' => array('class' => 'form-group col-md-3')));
			echo $this->Form->input('Contato.telefone', array('label' => 'Telefone', 'class' => 'telefone', 'class' => 'form-control', 'div' => array('class' => 'form-group col-md-3')));
			echo $this->Form->input('Contato.celular', array('label' => 'Celular', 'class' => 'celular', 'class' => 'form-control', 'div' => array('class' => 'form-group col-md-3')));
		?>
	</div>

	<div class="row">
		<?php
            echo $this->Form->input('EnderecoCongregacao.cep', array('id' => 'cep', 'onblur' => 'pesquisacep(this.value);' ,'type' => 'text', 'label' => 'CEP', 'class' => 'form-control','div' => array('class' => 'form-group col-md-3'), 'required' => 'required'));
            echo $this->Form->input('EnderecoCongregacao.logradouro', array('id' => 'rua','type' => 'text', 'label' => 'Logradouro', 'class' => 'form-control', 'div' => array('class' => 'form-group col-md-6'), 'required' => 'required', 'readonly' => 'readonly'));
            echo $this->Form->input('EnderecoCongregacao.numero', array('id' => 'numero', 'type' => 'text', 'label' => 'Número', 'class' => 'form-control', 'div' => array('class' => 'form-group col-md-1'), 'required' => 'required'));
            echo $this->Form->input('EnderecoCongregacao.complemento', array('type' => 'text', 'label' => 'Complemento', 'class' => 'form-control', 'div' => array('class' => 'form-group col-md-2')));
            echo $this->Form->input('EnderecoCongregacao.bairro', array('id' => 'bairro', 'type' => 'text', 'label' => 'Bairro', 'class' => 'form-control', 'div' => array('class' => 'form-group col-md-3'), 'required' => 'required', 'readonly' => 'readonly'));
            echo $this->Form->input('EnderecoCongregacao.cidade', array('id' => 'cidade', 'type' => 'text', 'label' => 'Cidade', 'class' => 'form-control', 'div' => array('class' => 'form-group col-md-7'), 'required' => 'required', 'readonly' => 'readonly'));
            echo $this->Form->input('EnderecoCongregacao.estado', array('id' => 'uf', 'type' => 'text', 'label' => 'Estado', 'class' => 'form-control', 'div' => array('class' => 'form-group col-md-2'), 'required' => 'required', 'readonly' => 'readonly'));
		?>
	</div>

	<div class="row">
		<div class="form-group col-md-2">
			<button data-dismiss="modal" class="btn btn-default form-control" type="button">Cancelar</button>
		</div>
		<?php echo $this->Form->input('Adicionar', array('type' => 'submit', 'label' => false, 'class' => 'btn btn-success form-control', 'div' => array('class' => 'form-group col-md-3'))); ?>
	</div>
</div>
<?php echo $this->Form->end(); ?>

<script type="text/javascript" src="/js/cep.js"></script>
