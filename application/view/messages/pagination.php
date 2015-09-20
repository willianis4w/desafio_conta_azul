<?php if(!isset($_POST['filter_date_from'])): ?>

	<?php if( count($total_pages) > 0 ): ?>

		<nav>
			<ul class="pagination">
				<?php for( $i = 1; $i <= $total_pages; $i++ ): ?>
					<li class="<?php echo ($page == $i) ? 'active' : '' ?>">

						<?php if (isset($approved)): ?>
							<a href="<?php echo URL . '?aprovados&page=' . $i ?>"><?php echo $i ?></a>
						<?php else: ?>
							<a href="<?php echo URL . '?page=' . $i ?>"><?php echo $i ?></a>
						<?php endif ?>

					</li>
				<?php endfor ?>
			</ul>
		</nav>

	<?php endif ?>

<?php endif ?>