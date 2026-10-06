<script type="text/javascript">
	var urlApagaRegChecked = '<?php echo $this->Html->url(array("plugin" => "secretaria", "controller" => "membros", "action" => "delete")); ?>';
</script>

<?php echo $this->Html->script('index'); ?>
<div class="col-md-12">
	<!--breadcrumbs start -->
	<ul class="breadcrumb">
		<li><a href="#"><i class="fa fa-home"></i> Home</a></li>
		<li><a href="#">Secretaria</a></li>
		<li class="active">Membros</li>
	</ul>
	<!--breadcrumbs end -->
</div>

<?php
	// form flutuante (menuRoll)
	echo $this->element('menuRoll');
?>

<div class="col-lg-12 menuRollNext">
	<section class="panel">
		<header class="panel-heading">
			Gerenciar membros
		</header>

		<ul class="nav nav-tabs">
			<li id="tabComungantes" class="active">
				<a class="nav-link" data-toggle="tab" href="#tab1">Comungantes</a>
			</li>
			<li id="tabNaoComungantes" class="nav-item">
				<a class="nav-link" data-toggle="tab" href="#tab2">Não Comungantes</a>
			</li>
			<li id="tabRolSeparado" class="nav-item">
				<a class="nav-link" data-toggle="tab" href="#tab3">Rol Separado</a>
			</li>
			<li id="tabExcluidos" class="nav-item">
				<a class="nav-link" data-toggle="tab" href="#tab4">Demitidos</a>
			</li>
		</ul>

		<div class="tab-content">
			<div class="tab-pane active" id="tab1">
				<div class="panel-body">
					<table class="table table-bordered table-striped table-condensed" id="tableData">
						<thead>
							<tr>
								<!-- CAMPO QUE CHECA TODOS OS CHECKBOX -->
								<th><input type="checkbox" onclick="MarcarTodos('tableData', this.checked);"></th>
								<th>Ordem</th>
								<th>Nome</th>
								<th>Data de Nascimento</th>
								<th>Celular</th>
								<th>E-mail</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach ($resultados['comungantes']['dados'] as $membro) { ?>
								<tr class="tr-visitantes-click" id="<?php echo 'dados_' . $membro['Membro']['id']; ?>">
									<td><input type="checkbox" value="<?php echo $membro['Membro']['id']; ?>"></td>
									<td onclick="modalLoad('<?php echo $this->Html->url(array('action' => 'edit', $membro['Membro']['id'])); ?>');"><?php echo $membro['Membro']['ordemadmissao']; ?></td>
									<td onclick="modalLoad('<?php echo $this->Html->url(array('action' => 'edit', $membro['Membro']['id'])); ?>');"><?php echo $membro['Membro']['nome']; ?></td>
									<td onclick="modalLoad('<?php echo $this->Html->url(array('action' => 'edit', $membro['Membro']['id'])); ?>');"><?php echo date("d/m/Y", strtotime($membro['Membro']['datanascimento'])) ?></td>
									<td onclick="modalLoad('<?php echo $this->Html->url(array('action' => 'edit', $membro['Membro']['id'])); ?>');"><?php echo $membro['Membro']['cel']; ?></td>
									<td onclick="modalLoad('<?php echo $this->Html->url(array('action' => 'edit', $membro['Membro']['id'])); ?>');"><?php echo $membro['Membro']['email']; ?></td>
								</tr>
							<?php } ?>
							<label>Total de Membros</label>
							<input type="text" class="form-control form-group col-md-12" value="<?php echo $resultados['comungantes']['total']; ?>" readonly />
						</tbody>
					</table>
				</div>
			</div>

			<div class="tab-pane" id="tab2">
				<div class="panel-body">
					<table class="table table-bordered table-striped table-condensed" id="tableData">
						<thead>
							<tr>
								<!-- CAMPO QUE CHECA TODOS OS CHECKBOX -->
								<th><input type="checkbox" onclick="MarcarTodos('tableData', this.checked);"></th>
								<th>Ordem</th>
								<th>Nome</th>
								<th>Data de Nascimento</th>
								<th>Celular</th>
								<th>E-mail</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach ($resultados['n_comungantes']['dados'] as $membro) { ?>
								<tr class="tr-visitantes-click" id="<?php echo 'dados_' . $membro['Membro']['id']; ?>">
									<td><input type="checkbox" value="<?php echo $membro['Membro']['id']; ?>"></td>
									<td onclick="modalLoad('<?php echo $this->Html->url(array('action' => 'edit', $membro['Membro']['id'])); ?>');"><?php echo $membro['Membro']['ordemadmissao']; ?></td>
									<td onclick="modalLoad('<?php echo $this->Html->url(array('action' => 'edit', $membro['Membro']['id'])); ?>');"><?php echo $membro['Membro']['nome']; ?></td>
									<td onclick="modalLoad('<?php echo $this->Html->url(array('action' => 'edit', $membro['Membro']['id'])); ?>');"><?php echo date("d/m/Y", strtotime($membro['Membro']['datanascimento'])) ?></td>
									<td onclick="modalLoad('<?php echo $this->Html->url(array('action' => 'edit', $membro['Membro']['id'])); ?>');"><?php echo $membro['Membro']['cel']; ?></td>
									<td onclick="modalLoad('<?php echo $this->Html->url(array('action' => 'edit', $membro['Membro']['id'])); ?>');"><?php echo $membro['Membro']['email']; ?></td>
								</tr>
							<?php } ?>
							<label>Total de Membros</label>
							<input type="text" class="form-control form-group col-md-12" value="<?php echo $resultados['n_comungantes']['total']; ?>" readonly />
						</tbody>
					</table>
				</div>
			</div>

			<div class="tab-pane" id="tab3">
				<div class="panel-body">
					<table class="table table-bordered table-striped table-condensed" id="tableData">
						<thead>
							<tr>
								<!-- CAMPO QUE CHECA TODOS OS CHECKBOX -->
								<th><input type="checkbox" onclick="MarcarTodos('tableData', this.checked);"></th>
								<th>Ordem</th>
								<th>Nome</th>
								<th>Data de Nascimento</th>
								<th>Celular</th>
								<th>E-mail</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach ($resultados['rol_separado']['dados'] as $membro) { ?>
								<tr class="tr-visitantes-click" id="<?php echo 'dados_' . $membro['Membro']['id']; ?>">
									<td><input type="checkbox" value="<?php echo $membro['Membro']['id']; ?>"></td>
									<td onclick="modalLoad('<?php echo $this->Html->url(array('action' => 'edit', $membro['Membro']['id'])); ?>');"><?php echo $membro['Membro']['ordemadmissao']; ?></td>
									<td onclick="modalLoad('<?php echo $this->Html->url(array('action' => 'edit', $membro['Membro']['id'])); ?>');"><?php echo $membro['Membro']['nome']; ?></td>
									<td onclick="modalLoad('<?php echo $this->Html->url(array('action' => 'edit', $membro['Membro']['id'])); ?>');"><?php echo date("d/m/Y", strtotime($membro['Membro']['datanascimento'])) ?></td>
									<td onclick="modalLoad('<?php echo $this->Html->url(array('action' => 'edit', $membro['Membro']['id'])); ?>');"><?php echo $membro['Membro']['cel']; ?></td>
									<td onclick="modalLoad('<?php echo $this->Html->url(array('action' => 'edit', $membro['Membro']['id'])); ?>');"><?php echo $membro['Membro']['email']; ?></td>
								</tr>
							<?php } ?>
							<label>Total de Membros</label>
							<input type="text" class="form-control form-group col-md-12" value="<?php echo $resultados['rol_separado']['total']; ?>" readonly />
						</tbody>
					</table>
				</div>
			</div>

			<div class="tab-pane" id="tab4">
				<div class="panel-body">
					<table class="table table-bordered table-striped table-condensed" id="tableData">
						<thead>
							<tr>
								<!-- CAMPO QUE CHECA TODOS OS CHECKBOX -->
								<th><input type="checkbox" onclick="MarcarTodos('tableData', this.checked);"></th>
								<th>Ordem</th>
								<th>Nome</th>
								<th>Data de Nascimento</th>
								<th>Celular</th>
								<th>E-mail</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach ($resultados['demitidos']['dados'] as $membro) { ?>
								<tr class="tr-visitantes-click" id="<?php echo 'dados_' . $membro['Membro']['id']; ?>">
									<td><input type="checkbox" value="<?php echo $membro['Membro']['id']; ?>"></td>
									<td onclick="modalLoad('<?php echo $this->Html->url(array('action' => 'edit', $membro['Membro']['id'])); ?>');"><?php echo $membro['Membro']['ordemadmissao']; ?></td>
									<td onclick="modalLoad('<?php echo $this->Html->url(array('action' => 'edit', $membro['Membro']['id'])); ?>');"><?php echo $membro['Membro']['nome']; ?></td>
									<td onclick="modalLoad('<?php echo $this->Html->url(array('action' => 'edit', $membro['Membro']['id'])); ?>');"><?php echo date("d/m/Y", strtotime($membro['Membro']['datanascimento']))?></td>
									<td onclick="modalLoad('<?php echo $this->Html->url(array('action' => 'edit', $membro['Membro']['id'])); ?>');"><?php echo $membro['Membro']['cel']; ?></td>
									<td onclick="modalLoad('<?php echo $this->Html->url(array('action' => 'edit', $membro['Membro']['id'])); ?>');"><?php echo $membro['Membro']['email']; ?></td>
								</tr>
							<?php } ?>
							<label>Total de Membros</label>
							<input type="text" class="form-control form-group col-md-12" value="<?php echo $resultados['demitidos']['total']; ?>" readonly />
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</section>
</div>

<?php
// modal de edit dos cadastros
echo $this->element('modal/modalEdit');

// modal de confirmação de exclusão dos cadastros
echo $this->element('modal/modalExcluir');
?>