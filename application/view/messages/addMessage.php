<div class="row">

	<div class="col-xs-12 col-md-offset-2 col-md-8">

		<h1 class="text-center text-uppercase title-add-message">Adicionar recado</h1>

		<form action="<?php echo URL ?>home/registrar_recado" class="form-horizontal form-add-message" method="post">
			<div class="form-group">
				<label for="data_envio" class="col-sm-2 control-label">Data:</label>
				<div class="col-sm-10">
					<input type="text" class="form-control" id="data_envio" data-picker name="data_envio" placeholder="clique para abrir o calendário" required />
				</div>
			</div>
			<div class="form-group">
				<label for="nome" class="col-sm-2 control-label">Nome:</label>
				<div class="col-sm-10">
					<input type="text" class="form-control" id="nome" name="nome" required maxlength="255" />
				</div>
			</div>
			<div class="form-group">
				<label for="email" class="col-sm-2 control-label">E-mail:</label>
				<div class="col-sm-10">
					<input type="email" class="form-control" id="email" name="email" required maxlength="255" />
				</div>
			</div>
			<div class="form-group">
				<label for="titulo" class="col-sm-2 control-label">Título:</label>
				<div class="col-sm-10">
					<input type="text" class="form-control" id="titulo" name="titulo" required maxlength="255" />
				</div>
			</div>
			<div class="form-group">
				<label for="texto" class="col-sm-2 control-label">Texto:</label>
				<div class="col-sm-10">
					<textarea class="form-control" name="texto" id="texto" rows="5" required></textarea>
				</div>
			</div>
			<div class="form-group">
				<label for="aprovado" class="col-sm-2 control-label">Aprovado?</label>
				<div class="col-sm-10">
					<div class="checkbox">
						<label>
							<input type="checkbox" id="aprovado" name="aprovado" checked />
						</label>
					</div>
				</div>
			</div>
			<div class="form-group">
				<div class="col-sm-offset-2 col-sm-10">
					<button type="submit" class="btn btn-success pull-right">
						<span class="glyphicon glyphicon-ok" aria-hidden="true"></span> Adicionar recado
					</button>
				</div>
			</div>
		</form>

		<div class="row">
			<a href="<?php echo URL ?>" class="btn btn-default">
				<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> Voltar
			</a>
		</div>

	</div>

</div>