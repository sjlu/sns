<div class="container">
	<div id="buttons">
		<a class="btn btn-large" href="<?= base_url('/logout') ?>">Logout</a>
	</div>
	<div class="row">
		<div class="span6">
			<h3>Keys</h3>
			<table id="keys" class="table table-bordered table-hover">
				<tbody>
					<? foreach ($keys as $k): ?>
						<tr>
							<td>
								<h5><?= $k['key'] ?></h5>
							</td>
							<td> 
								<a class="btn btn-danger" href="<?= base_url('/admin/delete_key/' . $k['key']) ?>"><i class="icon-trash"></i></a>
							</td>
						</tr>
					<? endforeach; ?>
				</tbody>
			</table>
			<a class="btn btn-primary pull-right pull-bottom" href="<?= base_url('/admin/create_key') ?>">
				<i class="icon-plus"></i> Add Key
			</a>
         <br />
			<h3>Devices</h3>
			<table id="devices" class="table table-bordered table-hover">
				<tbody>
					<? foreach ($devices as $d): ?>
						<tr>
							<td>
								<h5><?= $d['duid'] ?></h5>
							</td>
							<td>

							</td>
						</tr>
					<? endforeach; ?>
				</tbody>
			</table>
		</div>

		<div id="notifications" class="span6">
			<h3>Notifications</h3>
				<table class="table table-bordered table-hover">
					<tbody>
						<? foreach ($notifications as $n): ?>
							<tr>
								<td>
									<h4><?= $n['subject'] ?></h4>
									<p><?= $n['message'] ?></p>
								</td>
							</tr>
						<? endforeach; ?>
					</tbody>
				</table>
		</div>
	</div>
</div>
