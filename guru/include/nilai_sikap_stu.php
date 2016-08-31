<?php 
$reg = $_GET['tch'];
$kls = $_GET['kls'];
$setcl2 = $DB_connect->prepare("SELECT * FROM studen_ci
				                WHERE id_kls = '$kls'");
				$setcl2->execute();
				$resper = $setcl2->fetchAll(PDO::FETCH_ASSOC);
$no = 1;
 ?>
<h1 class="text-light">Nilai</h1>
<h4 class="text-light">Silahkan pilih kelas yang akan anda tambah nilainya</h4>
<hr class="thin bg-grayLighter">

<form method="post" action="?page=s_sikap">
						
						<div class="input-control text">
						    Masukan KKM
						    <input type="text" name="kkm" required>
						</div>
						<br><br>
						 <input value="<?php echo $now; ?>" name="tgl" hidden/>
						 <input value="<?php echo $reg; ?>" name="reg" hidden/>
						 <input value="<?php echo $_POST['tipe']; ?>" name="tipe" hidden/>
						 <table class="datatable align-center" id="tab-class" data-role="datatable">
							<thead>
								<tr>
									<th style="border-right: thin solid grey;border-top: thin solid grey;border-left: thin solid grey;">No</th>
									<th style="border-right: thin solid grey;border-top: thin solid grey;">Nama Siswa</th>
									<th style="border-right: thin solid grey;border-top: thin solid grey;">Jenis Kelamin</th>
									<th style="border-right: thin solid grey;border-top: thin solid grey;">No Induk</th>
									<th style="border-right: thin solid grey;border-top: thin solid grey;">Nilai</th>
									
								</tr>
							</thead>
							<tbody>
							<?php foreach ($resper as $resper) {

								
											if ($resper['jk'] == 'P') {
												$jk = 'Perempuan';
											}
											else{
												$jk = "Laki - Laki";
											}

											
											?>
											<tr>
												<td style="border-right: thin solid grey;border-bottom: thin solid grey;border-left: thin solid grey;"><?php echo $no++; ?></td>
												<td style="border-right: thin solid grey;border-bottom: thin solid grey;border-left: thin solid grey;"><?php echo $resper['nam_stu']; ?><input name="stu[]" value="<?php echo $resper['id_stu']; ?>" hidden></td>
												<td style="border-right: thin solid grey;border-bottom: thin solid grey;border-left: thin solid grey;"><?php echo $jk; ?></td>
												<td style="border-right: thin solid grey;border-bottom: thin solid grey;border-left: thin solid grey;"><?php echo $resper['nis']; ?></td>
												<td style="border-right: thin solid grey;border-bottom: thin solid grey;border-left: thin solid grey;">
						
																<div class="input-control text">
																	<input type="number" name="nilai[]">
																</div>
												</td>
											</tr>
						<?php } ?>
						</tbody>
				</table>

				<br><br>
				<div class="align-right"><span>*Note : Gunakan titik ( . ) untuk nilai koma</span></div>
				
				<br><br>

					<div class="input-control textarea"
					    data-role="input" style="height:20%;width:50%">
					    Keterangan
					    <textarea name="ket" required></textarea>
					</div>
				<br><br><br><br>
					<button class="button primary"><span class="mif-plus"></span> Tambah Baru</button>
				</div>