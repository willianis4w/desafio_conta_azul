<div class="table-responsive">
	<table class="table table-hover table-messages">
		<thead>
			<tr>
				<th>Data</th>
				<th>Nome</th>
				<th>E-mail</th>
				<th>Título</th>
				<th>Texto</th>
				<th>Aprovado</th>
				<th></th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($messages as $message): ?>
				<tr>
					<td class="message-date">
						<a data-toggle="modal" href="#" data-id="<?php echo $message->id ?>" class="view-message" data-target="#modalViewMessage">
							<small><?php echo $message->data_envio_formatted; ?></small>
						</a>
					</td>
					<td>
						<?php echo $message->nome ?>
					</td>
					<td>
						<?php echo $message->email ?>
					</td>
					<td>
						<?php echo $message->titulo ?>
					</td>
					<td>
						<?php
							echo strlen($message->texto) >= 90 ? substr($message->texto, 0, 80) . '... <a data-toggle="modal" href="#" data-id="' . $message->id . '" class="view-message" data-target="#modalViewMessage">Veja o texto completo</a>' : $message->texto;
						?>
					</td>
					<td>
						<input data-id="<?php echo $message->id ?>" type="checkbox" name="aprovado" <?php echo ($message->aprovado === '1') ? 'checked' : '' ?> />
					</td>
					<td>
						<a title="Remover recado" class="remove-message btn btn-danger" href="<?php echo URL ?>home/remove_recado" data-id="<?php echo $message->id ?>">
							<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
						</a>
					</td>
				</tr>
			<?php endforeach ?>
		</tbody>
	</table>
</div>