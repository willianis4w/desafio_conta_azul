<?php if (isset($_GET['inserido'])): ?>
	<div class="alert alert-success alert-dismissible" role="alert">
		<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		Registro inserido com sucesso!
	</div>
<?php endif ?>

<h1 class="text-center text-uppercase">Recados</h1>

<?php if (count($messages) > 0 ): ?>

	<div class="message-btns">

		<?php if ($approved): ?>
			<a href="<?php echo URL ?>" class="btn btn-info">Ver todos</a>
		<?php else: ?>
			<a href="<?php echo URL ?>?aprovados" class="btn btn-info">Ver aprovados</a>
		<?php endif ?>

		<a href="<?php echo URL ?>home/adicionar_recado" class="btn btn-success pull-right">
			<span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Adicionar recado
		</a>

	</div>

	<?php if (isset($_GET['aprovados'])): ?>
		<div class="message-filter">
			<form class="form-inline" action="<?php echo URL ?>?aprovados" method="post">
				<div class="form-group">
					<label for="filter_date_from">Filtrar pro data <span class="glyphicon glyphicon-play"></span> de: </label>
					<input type="text" value="<?php echo (!$filter_date_from) ? '' : $filter_date_from_formatted ?>" class="form-control" data-picker-date-from id="filter_date_from" name="filter_date_from" required />
				</div>
				<div class="form-group">
					<label for="filter_date_to">até: </label>
					<input type="text" value="<?php echo (!$filter_date_to) ? '' : $filter_date_to_formatted ?>" class="form-control" data-picker-date-to id="filter_date_to" name="filter_date_to" required />
				</div>
				<button type="submit" class="btn btn-primary">Filtrar</button>
			</form>
		</div>
	<?php endif ?>


<?php endif ?>