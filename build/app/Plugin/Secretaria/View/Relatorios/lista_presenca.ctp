<div class="col-lg-12">
    <section class="panel">
        <header class="panel-heading">
            Lista de Presença de Assembléias
        </header>
        <div class="panel-body">
        <?php
            echo $this->Form->create('Relatorio', array('role' => 'form', 'class' => 'formModal', 'target' => '_blank'));
			echo $this->Form->input('Gerar', array('type' => 'submit', 'label' => false , 'class' => 'btn btn-success form-control', 'div' => array('class' => 'form-group col-md-3'))); 
            echo $this->Form->end(); 
        ?>
        </div>
    </section>
</div>
