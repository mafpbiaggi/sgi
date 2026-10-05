<div class="col-lg-12">
    <section class="panel">
        <header class="panel-heading">
            Relatório de Membros
        </header>
        <div class="panel-body">
        	<?php 
			echo $this->Form->create('Relatorio', array('role' => 'form', 'class' => 'formModal'));
			
			$options = array('1' => 'Comungante', '3' => 'Não Comungante', '2' => 'Rol Separado', '0' => 'Demitido');
			echo $this->Form->input('ativo', array('class' => 'form-control', 'label' => 'Situação:', 'options' => $options, 'div' => array('class' => 'form-group col-md-4')));
			
			echo $this->Form->input('datamembro', array('class' => 'form-control datepicker', 'label' => 'Tournou-se membro em:', 'div' => array('class' => 'form-group col-md-4')));
			echo $this->Form->input('nome', array('class' => 'form-control', 'label' => 'Nome:', 'div' => array('class' => 'form-group col-md-4')));
			echo $this->Form->input('sexo', array('class' => 'form-control', 'label' => 'Sexo:', 'options' => array('' => 'Todos', '1' => 'Masculino', '2' => 'Feminino'), 'div' => array('class' => 'form-group col-md-4')));
			echo $this->Form->input('estadocivil', array('class' => 'form-control', 'label' => 'Estado Civil:', 'options' => array('' => 'Todos', '1' => 'Solteiro(a)', '2' => 'Casado(a)', '3' => 'Viúvo(a)', '4' => 'Divorciado(a)'), 'div' => array('class' => 'form-group col-md-4')));
			echo $this->Form->input('mes', array('class' => 'form-control', 'label' => 'Mês de Aniversário:', 'options' => array ('' => 'Todos', '01' => 'Janeiro', '02' => 'Fevereiro', '03' => 'Março', '04' => 'Abril', '05' => 'Maio', '06' => 'Junho', '07' => 'Julho', '08' => 'Agosto', '09' => 'Setembro', '10' => 'Outubro', '11' => 'Novembro', '12' => 'Dezembro'), 'div' => array('class' => 'form-group col-md-4')));

			echo $this->Form->input('Gerar Relatório', array('type' => 'submit', 'label' => false , 'class' => 'btn btn-success form-control', 'div' => array('class' => 'form-group col-md-4'), 'id' => 'salvar_dados')); 
		?>
        </div>
    </section>
</div>
<script type="text/javascript">
	$(document).ready(function() {
		$(".datepicker").datepicker({
			format: "yyyy-mm-dd"
		});
	});
</script>
