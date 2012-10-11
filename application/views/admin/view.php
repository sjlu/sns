<div class="container">
	<div id="buttons">
		<a class="btn btn-large" href="<?= base_url('/logout') ?>">Logout</a>
	</div>
	<h3>Keys</h3>
		<table class="table table-bordered table-hover">
			<tbody>
				<? foreach ($keys as $k): ?>
					<tr>
						<td>
							<h4><?= $k['key'] ?></h4>
						</td>
						<td>
						</td>
					</tr>
				<? endforeach; ?>
			</tbody>
		</table>
	<a class="btn btn-primary pull-right pull-bottom" href="<?= base_url('/admin/create_key') ?>">
		<i class="icon-plus"></i> Add Key
	</a>
</div>