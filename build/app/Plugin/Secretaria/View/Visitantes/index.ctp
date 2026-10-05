<script type="text/javascript">
	var urlApagaRegChecked = '<?php echo $this->Html->url(array("plugin" => "secretaria", "controller" => "visitantes", "action" => "delete")); ?>';
</script>
<?php echo $this->Html->script('index'); ?>

<div class="col-md-12">
	<ul class="breadcrumb">
		<li><a href="#"><i class="fa fa-home"></i> Home</a></li>
		<li><a href="#">Secretaria</a></li>
		<li class="active">Visitantes</li>
	</ul>
</div>

<?php echo $this->element('menuRoll'); ?>
<div class="col-lg-12 menuRollNext">
	<section class="panel">
		<header class="panel-heading">
			Gerenciar Visitantes
		</header>
		<div class="panel-body">
			<table class="table table-striped table-bordered" id="tableData">
				<thead>
					<tr>
						<th><input type="checkbox" onclick="MarcarTodos('tableData', this.checked);"></th>
						<th>Data da Visita</th>
						<th>Nome</th>
						<th>Telefone</th>
						<th>E-mail</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($visitantes as $visitante) { ?>
						<tr class="tr-visitantes-click" id="<?php echo 'dados_' . $visitante['Visitante']['id']; ?>">
							<td><input type="checkbox" value="<?php echo $visitante['Visitante']['id']; ?>"></td>
							<td onclick="modalLoad('<?php echo $this->Html->url(array('action' => 'edit', $visitante['Visitante']['id'])); ?>');"><?php echo date("d/m/Y", strtotime($visitante['Visitante']['dataVisita'])); ?></td>
							<td onclick="modalLoad('<?php echo $this->Html->url(array('action' => 'edit', $visitante['Visitante']['id'])); ?>');"><?php echo $visitante['Visitante']['nome']; ?></td>
							<td onclick="modalLoad('<?php echo $this->Html->url(array('action' => 'edit', $visitante['Visitante']['id'])); ?>');"><?php echo $visitante['Visitante']['telefone']; ?></td>
							<td onclick="modalLoad('<?php echo $this->Html->url(array('action' => 'edit', $visitante['Visitante']['id'])); ?>');"><?php echo $visitante['Visitante']['email']; ?></td>
						</tr>
					<?php } ?>
				</tbody>
			</table>
		</div>
	</section>
</div>

<?php
echo $this->element('modal/modalEdit');
echo $this->element('modal/modalExcluir');
?>
