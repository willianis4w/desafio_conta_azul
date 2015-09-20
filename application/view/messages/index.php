<div class="row">

	<div class="col-xs-12">

		<?php require APP . 'view/messages/header.php'; ?>

		<?php if (count($messages) > 0 ): ?>

			<?php require APP . 'view/messages/table.php'; ?>

		<?php else: ?>

			<?php require APP . 'view/messages/noRegisters.php'; ?>

		<?php endif ?>

		<?php require APP . 'view/messages/pagination.php'; ?>

	</div>

</div>