<script type="text/javascript">
	var urlApagaRegChecked = '<?php echo $this->Html->url(array("plugin" => "secretaria", "controller" => "congregacoes", "action" => "delete")); ?>';
</script>

<?php echo $this->Html->script('index'); ?>
<div class="col-md-12">
	<ul class="breadcrumb">
		<li><a href="#"><i class="fa fa-home"></i> Home</a></li>
		<li><a href="#">Secretaria</a></li>
		<li class="active">Congregações</li>
	</ul>
</div>

<?php echo $this->element('menuRoll'); ?>
<div class="col-lg-12 menuRollNext">
	<section class="panel">
		<header class="panel-heading">
			Gerenciar congregações
		</header>
		<div class="panel-body">
			<table class="table table-bordered table-striped table-condensed" id="tableData">
				<tr>
					<th class="col-md-1"><input type="checkbox" onclick="MarcarTodos('tableData', this.checked);"></th>
					<th>Congregação</th>
					<th>Contato</th>
					<th>Telefone</th>
					<th>E-mail</th>
				</tr >
				<?php foreach ($congregacoes as $congregacao) { ?>
					<tr class="tr-visitantes-click" id="<?php echo 'dados_' . $congregacao['Congregacao']['id']; ?>">
						<td><input type="checkbox" value="<?php echo $congregacao['Congregacao']['id']; ?>"></td>
						<td onclick="modalLoad('<?php echo $this->Html->url(array('action' => 'edit', $congregacao['Congregacao']['id'])); ?>');"><?php echo $congregacao['Congregacao']['nome']; ?></td>
						<td onclick="modalLoad('<?php echo $this->Html->url(array('action' => 'edit', $congregacao['Congregacao']['id'])); ?>');"><?php echo $congregacao['Contato']['nome']; ?></td>
						<td onclick="modalLoad('<?php echo $this->Html->url(array('action' => 'edit', $congregacao['Congregacao']['id'])); ?>');"><?php echo $congregacao['Contato']['telefone']; ?></td>
						<td onclick="modalLoad('<?php echo $this->Html->url(array('action' => 'edit', $congregacao['Congregacao']['id'])); ?>');"><?php echo $congregacao['Contato']['email']; ?></td>
					</tr>
				<?php } ?>
			</table>
		</div>
	</section>
</div>

<?php
	echo $this->element('modal/modalEdit');
	echo $this->element('modal/modalExcluir');
?>
