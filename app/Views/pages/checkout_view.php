<?= $this->extend('components/layout') ?>
		<?= $this->section('content') ?>
		<?php $session = session(); ?>
		<div class="row">
			<div class="col-lg-6">
				<!-- Vertical Form --> 
				<?= form_open('/keranjang/buy','class="row g-3"') ?>
				<?= form_hidden('username', $session->get('username')) ?>
				<?= form_input(['type' => 'hidden', 'name' => 'total_harga', 'id' => 'total_harga', 'value' => '']) ?>
					<div class="col-12">
						<label for="nama" class="form-label">Name</label>
						<input type="text" class="form-control" id="nama" value="<?php echo $session->get('username')?>">
					</div>
					<div class="col-12">
						<label for="alamat" class="form-label">Address</label>
						<input type="text" class="form-control" id="alamat" name="alamat">
					</div>
					<div class="col-12">
						<label for="provinsi" class="form-label">Province</label> 
						<select class="form-select" id="provinsi">
							<option>Please select your province.</option> 
							<?php foreach($provinsi as $p): ?>
								<option value="<?= $p->province_id ?>"><?= $p->province ?></option>
							<?php endforeach ?>
						</select>
					</div> 
					<div class="col-12">
						<label for="kabkota" class="form-label">Regency/City</label> 
						<select class="form-select" id="kabupaten">
							<option>Please select your regency/city.</option> 
						</select>
					</div> 
					<div class="col-12">
						<label for="layanan" class="form-label">Delivery Service</label> 
						<select class="form-select" id="service">
							<option>Please select delivery service.</option> 
						</select>
					</div> 
					<div class="col-12">
						<label for="ongkir" class="form-label">Ongkir</label>
						<input type="text" class="form-control" id="ongkir" name="ongkir" readonly>
					</div>
			</div>
			<div class="col-lg-6">
				<!-- Vertical Form -->
					<div class="col-12">
						<!-- Default Table -->
						<table class="table">
							<thead>
							<tr> 
								<th scope="col">Name</th>
								<th scope="col">Price</th>
								<th scope="col">Qty</th>
								<th scope="col">Sub Total</th>
							</tr>
							</thead>
							<tbody>
							<?php
							$i = 1;
							if (!empty($items)) :
								foreach ($items as $index => $item) :
							?>
							<tr> 
								<td><?php echo $item['name'] ?></td>
								<td><?php echo number_to_currency($item['price'], 'IDR') ?></td>
								<td><?php echo $item['qty'] ?></td>
								<td><?php echo number_to_currency($item['price']*$item['qty'], 'IDR') ?></td>
							</tr> 
							<?php
								endforeach;
							endif;
							?>
							<tr>
								<td colspan="2"></td>
								<td>Sub Total</td>
								<td><?php echo number_to_currency($total, 'IDR')?></td>
							</tr>
							<tr>
								<td colspan="2"></td>
								<td>Total</td>
								<td><span id="total"><?php echo number_to_currency($total, 'IDR')?></span></td>
							</tr>
							</tbody>
						</table>
						<!-- End Default Table Example -->
					</div>  
					<div class="text-center">
						<button type="submit" class="btn btn-primary">Checkout</button> 
					</div>
				</form><!-- Vertical Form -->
			</div>
		</div>
		<?= $this->endSection() ?>
		<?= $this->section('script') ?>
		<script>
			$('document').ready(function(){ 
				var ongkir = 0;
				$("#provinsi").on('change', function(){
					$("#kabupaten").empty();
					var id_province = $(this).val();
					$.ajax({
						url : "<?= site_url('keranjang/getcity') ?>",
						type : 'GET',
						data : {
							'id_province': id_province,
						},
						dataType : 'json',
						success : function(data){
							console.log(data);
							var results = data["rajaongkir"]["results"];
							for(var i=0; i<results.length; i++)
							{
								$("#kabupaten").append($('<option>',{
									value : results[i]["city_id"],
									text : results[i]['city_name']
								}));
							}
						},
						
					});
				});

				$("#kabupaten").on('change', function(){
					var id_city = $(this).val();
					$.ajax({
						url : "<?= site_url('keranjang/getcost') ?>",
						type : 'GET',
						data : {
							'origin': 399,
							'destination' : id_city,
							'weight' : 1000,
							'courier' : 'jne'
						},
						dataType : 'json',
						success : function(data){
							console.log(data);
							var results = data["rajaongkir"]["results"][0]["costs"];
							for(var i = 0; i<results.length; i++)
							{
								var text = results[i]["description"]+"("+results[i]["service"]+")";
								$("#service").append($('<option>',{
									value : results[i]["cost"][0]["value"],
									text : text,
									etd : results[i]["cost"][0]["etd"]
								}));
							}
						},
						
					});
				});

				$("#service").on('change', function(){
					var estimasi = $('option:selected', this).attr('etd');
					ongkir = parseInt($(this).val());
					var total = ongkir + <?= $total ?>;
					$("#ongkir").val(ongkir); 
					$("#total").html("IDR " + total.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,'));
					$("#total_harga").val(total);
				}); 
			});
		</script>
		<?= $this->endSection() ?>