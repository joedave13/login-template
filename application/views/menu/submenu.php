<!-- Begin Page Content -->
<div class="container-fluid">

	<!-- Page Heading -->
	<h1 class="h3 mb-4 text-gray-800">
		<?php echo $title; ?>
	</h1>

	<div class="row">
		<div class="col-lg">
			<?php if (validation_errors()) { ?>
			<div class="alert alert-danger" role="alert">
				<?php echo validation_errors(); ?>
			</div>
			<?php } ?>
			<?php echo $this->session->flashdata('message'); ?>

			<a href="" class="btn btn-primary mb-3" data-toggle="modal" data-target="#newSubmenuModal">Add New Submenu</a>

			<table class="table table-hover">
				<thead>
					<tr>
						<th scope="col">#</th>
						<th scope="col">Title</th>
						<th scope="col">Menu</th>
						<th scope="col">URL</th>
						<th scope="col">Icon</th>
						<th scope="col">Active</th>
						<th scope="col">Action</th>
					</tr>
				</thead>
				<tbody>
					<?php $i = 1; foreach ($subMenu as $key) { ?>
					<tr>
						<th scope="row">
							<?php echo $i; ?>
						</th>
						<td>
							<?php echo $key['title']; ?>
						</td>
						<td>
							<?php echo $key['menu']; ?>
						</td>
						<td>
							<?php echo $key['url']; ?>
						</td>
						<td>
							<?php echo $key['icon']; ?>
						</td>
						<td>
							<?php echo $key['is_active']; ?>
						</td>
						<td>
							<a href="" class="badge badge-success">Edit</a>
							<a href="" class="badge badge-danger">Delete</a>
						</td>
					</tr>
					<?php $i++; } ?>
				</tbody>
			</table>
		</div>
	</div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<!-- Modal -->
<div class="modal fade" id="newSubmenuModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
 aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Add New Sub Menu</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form action="<?php echo base_url('menu/addSubMenu'); ?>" method="post">
				<div class="modal-body">
					<div class="form-group">
						<input type="text" class="form-control" id="title" name="title" placeholder="Submenu Title">
					</div>
					<div class="form-group">
						<select name="menu_id" id="menu_id" class="form-control">
							<option value="">--SELECT MENU--</option>
							<?php foreach ($menu as $key) { ?>
							<option value="<?php echo $key['id'] ?>">
								<?php echo $key['menu'] ?>
							</option>
							<?php } ?>
						</select>
					</div>
					<div class="form-group">
						<input type="text" class="form-control" id="url" name="url" placeholder="URL">
					</div>
					<div class="form-group">
						<input type="text" class="form-control" id="icon" name="icon" placeholder="Icon">
					</div>
					<div class="form-group">
						<div class="form-check">
							<input class="form-check-input" type="checkbox" value="1" id="is_active" name="is_active" checked>
							<label class="form-check-label" for="is_active">
								Sub Menu Is Active
							</label>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					<button type="submit" class="btn btn-primary">Add</button>
				</div>
			</form>
		</div>
	</div>
</div>
