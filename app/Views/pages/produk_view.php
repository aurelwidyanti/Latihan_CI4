<?= $this->extend('components/layout') ?>
<?= $this->section('content') ?>
<?php
if(session()->getFlashData('success')){
?> 
<div class="alert alert-info alert-dismissible fade show" role="alert">
	<?= session()->getFlashData('success') ?>
	<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
<?php
}
?>
<?php
if(session()->getFlashData('failed')){
?> 
<div class="alert alert-danger alert-dismissible fade show" role="alert">
	<?= session()->getFlashData('failed') ?>
	<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
<?php
}
?>
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addModal">
Add Data
</button>
<!-- Table with stripped rows -->
<table class="table datatable">
<thead>
	<tr>
	<th scope="col">#</th>
	<th scope="col">Name</th>
	<th scope="col">Price</th>
	<th scope="col">Stok</th> 
	<th scope="col">Photo</th> 
	<th scope="col"></th> 
	</tr>
</thead>
<tbody>
	<?php foreach($produks as $index=>$produk): ?>
	<tr>
	<th scope="row"><?php echo $index+1?></th>
	<td><?php echo $produk['nama'] ?></td> 
	<td><?php echo $produk['hrg'] ?></td> 
	<td><?php echo $produk['stok'] ?></td> 
	<td><img src="<?php echo base_url()."public/img/".$produk['foto'] ?>" width="100px"></td> 
	<td>
		<button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#editModal-<?= $produk['id'] ?>">
			Edit
		</button>
		<a href="<?= base_url('produk/delete/'.$produk['id']) ?>" class="btn btn-danger" onclick="return confirm('Yakin hapus data ini ?')">
			Delete
		</a>
	</td>
	</tr>
	<!-- Edit Modal Begin -->
	<div class="modal fade" id="editModal-<?= $produk['id'] ?>" tabindex="-1">
		<div class="modal-dialog modal-dialog-centered">
			<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Edit Data</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form action="<?= base_url('produk/edit/'.$produk['id']) ?>" method="post" enctype="multipart/form-data">
			<?= csrf_field(); ?>
			<div class="modal-body">
				<div class="form-group">
					<label for="name">Name</label>
					<input type="text" name="nama" class="form-control" id="nama" value="<?= $produk['nama'] ?>" required>
				</div>
				<div class="form-group">
					<label for="name">Price</label>
					<input type="text" name="hrg" class="form-control" id="hrg" value="<?= $produk['hrg'] ?>" required>
				</div>
				<div class="form-group">
					<label for="name">Stok</label>
					<input type="text" name="stok" class="form-control" id="stok" value="<?= $produk['stok'] ?>" required>
				</div>
				<div class="form-group">
					<label for="name">Keterangan</label>
					<input type="text" name="keterangan" class="form-control" id="keterangan" value="<?= $produk['keterangan'] ?>" required>
				</div>
				<img src="<?php echo base_url()."public/img/".$produk['foto'] ?>" width="100px">
				<div class="form-check">
					<input class="form-check-input" type="checkbox" id="check" name="check" value="1">
					<label class="form-check-label" for="check">
					Checklist if you want to change the photo.
					</label>
				</div>
				<div class="form-group">
					<label for="name">Photo</label>
					<input type="file" class="form-control" id="foto" name="foto">
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
				<button type="submit" class="btn btn-primary">Save</button>
			</div>
			</form>
			</div>
		</div>
	</div>
	<!-- Edit Modal End -->
	<?php endforeach ?>   
</tbody>
</table>
<!-- End Table with stripped rows -->
<!-- Add Modal Begin -->
<div class="modal fade" id="addModal" tabindex="-1">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
		<div class="modal-header">
			<h5 class="modal-title">Add Data</h5>
			<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
		</div>
		<form action="<?= base_url('produk') ?>" method="post" enctype="multipart/form-data">
		<?= csrf_field(); ?>
		<div class="modal-body">
			<div class="form-group">
				<label for="name">Name</label>
				<input type="text" name="nama" class="form-control" id="nama" required>
			</div>
			<div class="form-group">
				<label for="name">Price</label>
				<input type="text" name="hrg" class="form-control" id="hrg" required>
			</div>
			<div class="form-group">
				<label for="name">Stok</label>
				<input type="text" name="stok" class="form-control" id="stok" required>
			</div>
			<div class="form-group">
				<label for="name">Keterangan</label>
				<input type="text" name="keterangan" class="form-control" id="keterangan" required>
			</div>
			<div class="form-group">
				<label for="name">Photo</label>
				<input type="file" class="form-control" id="foto" name="foto">
			</div>
		</div>
		<div class="modal-footer">
			<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
			<button type="submit" class="btn btn-primary">Save</button>
		</div>
		</form>
		</div>
	</div>
</div>
<!-- Add Modal End -->
<?= $this->endSection() ?>