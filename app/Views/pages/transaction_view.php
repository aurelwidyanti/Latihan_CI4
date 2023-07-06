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
    <th scope="col">Tanggal</th>
	<th scope="col">Username</th>
	<th scope="col">Total Harga</th>    
	<th scope="col">Ongkos Kirim</th>    
	<th scope="col">Status</th> 
	<th scope="col"></th> 
	</tr>
</thead>
<tbody>
	<?php foreach($transaksis as $index=>$transaksi): ?>
	<tr>
	<th scope="row"><?php echo $index+1?></th>
	<td><?php echo $transaksi['created_date'] ?></td> 
	<td><?php echo $transaksi['username'] ?></td> 
	<td><?php echo $transaksi['total_harga'] ?></td> 
	<td><?php echo $transaksi['ongkir'] ?></td> 
	<td>
	<?php 
    if ($transaksi['status']==0){
        echo 'Diproses';
    } else if($transaksi['status']==1) {
        echo 'Dikirim';
    } else {
        echo 'Selesai';
    }
    ?>
	</td>

	<td>
		<button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#editStatus-<?= $transaksi['id'] ?>">
			Edit
		</button>
		<a href="<?= base_url('transaksi/delete/'.$transaksi['id']) ?>" class="btn btn-danger" onclick="return confirm('Yakin hapus data ini ?')">
			Delete
		</a>
	</td>
	</tr>
	<!-- Edit Modal Begin -->
	<div class="modal fade" id="editStatus-<?= $transaksi['id'] ?>" tabindex="-1">
		<div class="modal-dialog modal-dialog-centered">
			<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Edit Data</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form action="<?= base_url('transaksi/edit/'.$transaksi['id']) ?>" method="post">
			<?= csrf_field(); ?>
			<div class="modal-body">
                 <div class="form-group">
					<label for="tanggal">Tanggal</label>
					<input type="date" name="tanggal" class="form-control" id="created_date" value="<?= $transaksi['created_date'] ?>" required>
				</div>
				<div class="form-group">
					<label for="name">Username</label>
					<input type="text" name="username" class="form-control" id="username" value="<?= $transaksi['username'] ?>" required>
				</div>
                <div class="form-group">
					<label for="total_harga">Total Harga</label>
					<input type="text" name="total_harga" class="form-control" id="total_harga" value="<?= $transaksi['total_harga'] ?>" required>
				</div>
				
				<?php echo form_hidden('editStatus',1) ?>
				<label for="status">Status</label>
				<select name="status" class="form-select" aria-label="status">
                    <option <?php if($transaksi['status']=='0'){echo "selected";}else{ echo "";} ?> value="0">Diproses</option>
                    <option <?php if($transaksi['status']=='1'){echo "selected";}else{ echo "";} ?> value="1">Dikirim</option>
                    <option <?php if($transaksi['status']=='2'){echo "selected";}else{ echo "";} ?> value="2">Selesai</option>
                </select>
			
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
<?= $this->endSection() ?>