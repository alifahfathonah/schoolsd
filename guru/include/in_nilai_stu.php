<?php 
$reg = $_POST['reg'][0];
$now = date('Y-m-d');
$setcl = $DB_connect->query("SELECT DISTINCT jad_start,jad_end,jam,interfal FROM schedule_teach_ci WHERE kls = '$reg'");
$setcl->execute();
$qjad = $setcl->fetch(PDO::FETCH_ASSOC);

$start = $qjad['jad_start'];
$end = $qjad['jad_end'];

$range = range($start, $end);
$now = date('Y-m-d');

if ($now > $end) {
	echo "Expired! Mohon konfirmasi bagian kurikulum";
}
elseif ($now < $start) {
	echo "Belum Mulai Jadwal! Jadwal baru dimulai pada tanggal ".$start;
}
else{
		$materi = $_POST['materi'];
		$tipe = $_POST['tipe'];
		if ($tipe == 5) {
			echo "blaa";
		}
		elseif ($materi == '') {
			
			echo "<script>alert('Maaf anda tidak memilih materi apapun');window.location = '?page=nilai_stu';</script>";
		}
		else{	
			if ($tipe == 2) {
				$id_kls = $_POST['kls'][0];
				
				$setcl2 = $DB_connect->prepare("SELECT * FROM studen_ci
												INNER JOIN stu_absen_ci ON studen_ci.id_stu = stu_absen_ci.id_stu 
				                                WHERE id_reg = '$reg' AND materi = '$materi'");
				$setcl2->execute();
				$resper = $setcl2->fetchAll(PDO::FETCH_ASSOC);

				$no = 1;

				?>

				<h1 class="text-light">Nilai</h1>
				<h4 class="text-light">Silahkan pilih murid yang akan ditambah nilainya</h4>
				<hr class="thin bg-grayLighter">

				<div class="cell auto-size bg-white" id="inpribadi">
					<form method="post" action="?page=s_nilai">
						
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
									<th style="border-right: thin solid grey;border-top: thin solid grey;">Status Absensi</th>
									<th style="border-right: thin solid grey;border-top: thin solid grey;">Nilai</th>
									
								</tr>
							</thead>
							<tbody>
							<?php foreach ($resper as $resper) {

								$setcl2 = $DB_connect->prepare("SELECT * FROM stu_nilai_ci
												INNER JOIN stu_absen_ci ON stu_nilai_ci.id_absen = stu_absen_ci.id_absen 
				                                WHERE stu_nilai_ci.id_reg = '$reg' AND materi = '$materi'");
								$setcl2->execute();
								$resper2 = $setcl2->fetch(PDO::FETCH_ASSOC);

											if ($resper['jk'] == 'P') {
												$jk = 'Perempuan';
											}
											else{
												$jk = "Laki - Laki";
											}

											if ($resper['kd_absen'] == '1') {
												$absen = 'Hadir';
											}
											elseif ($resper['kd_absen'] == '2') {
												$absen = 'Sakit';
											}
											elseif ($resper['kd_absen'] == '3') {
												$absen = 'Izin';
											}
											else {
												$absen = 'Alpha';
											}
											?>
											<tr>
												<td style="border-right: thin solid grey;border-bottom: thin solid grey;border-left: thin solid grey;"><?php echo $no++; ?></td>
												<td style="border-right: thin solid grey;border-bottom: thin solid grey;border-left: thin solid grey;"><?php echo $resper['nam_stu']; ?><input name="stu[]" value="<?php echo $resper['id_stu']; ?>" hidden></td>
												<td style="border-right: thin solid grey;border-bottom: thin solid grey;border-left: thin solid grey;"><?php echo $jk; ?></td>
												<td style="border-right: thin solid grey;border-bottom: thin solid grey;border-left: thin solid grey;"><?php echo $resper['nis']; ?><input name="absen[]" value="<?php echo $resper['id_absen']; ?>" hidden></td>
												<td style="border-right: thin solid grey;border-bottom: thin solid grey;border-left: thin solid grey;"><?php echo $absen; ?></td>
												<td style="border-right: thin solid grey;border-bottom: thin solid grey;border-left: thin solid grey;">
														<?php if ($resper['kd_absen'] == '1') {?>
																<div class="input-control text">
																	<input type="number" name="nilai[]">
																</div>
														<?php } else {?>
															<div class="input-control text">
																<input type="text" name="nilai[]" readonly="true" value="0">
															</div>
														<?php } ?>
																
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
					    Keterangan Nilai Tugas
					    <textarea name="ket" required></textarea>
					</div>
				<br><br><br><br>
					<button class="button primary"><span class="mif-plus"></span> Tambah Baru</button>
				</div>
			<?php
			} else {
				$id_kls = $_POST['kls'][0];
				
				$setcl2 = $DB_connect->prepare("SELECT * FROM studen_ci
												INNER JOIN stu_absen_ci ON studen_ci.id_stu = stu_absen_ci.id_stu 
				                                WHERE id_reg = '$reg' AND materi = '$materi'");
				$setcl2->execute();
				$resper = $setcl2->fetchAll(PDO::FETCH_ASSOC);

				$no = 1;

				?>

				<h1 class="text-light">Nilai</h1>
				<h4 class="text-light">Silahkan pilih murid yang akan ditambah nilainya</h4>
				<hr class="thin bg-grayLighter">

				<div class="cell auto-size bg-white" id="inpribadi">
					<form method="post" action="?page=s_nilai">
						
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
									<th style="border-right: thin solid grey;border-top: thin solid grey;">Status Absensi</th>
									<th style="border-right: thin solid grey;border-top: thin solid grey;">Nilai</th>
									
								</tr>
							</thead>
							<tbody>
							<?php foreach ($resper as $resper) {

								$setcl2 = $DB_connect->prepare("SELECT * FROM stu_nilai_ci
												INNER JOIN stu_absen_ci ON stu_nilai_ci.id_absen = stu_absen_ci.id_absen 
				                                WHERE stu_nilai_ci.id_reg = '$reg' AND materi = '$materi'");
								$setcl2->execute();
								$resper2 = $setcl2->fetch(PDO::FETCH_ASSOC);

											if ($resper['jk'] == 'P') {
												$jk = 'Perempuan';
											}
											else{
												$jk = "Laki - Laki";
											}

											if ($resper['kd_absen'] == '1') {
												$absen = 'Hadir';
											}
											elseif ($resper['kd_absen'] == '2') {
												$absen = 'Sakit';
											}
											elseif ($resper['kd_absen'] == '3') {
												$absen = 'Izin';
											}
											else {
												$absen = 'Alpha';
											}
											?>
											<tr>
												<td style="border-right: thin solid grey;border-bottom: thin solid grey;border-left: thin solid grey;"><?php echo $no++; ?></td>
												<td style="border-right: thin solid grey;border-bottom: thin solid grey;border-left: thin solid grey;"><?php echo $resper['nam_stu']; ?><input name="stu[]" value="<?php echo $resper['id_stu']; ?>" hidden></td>
												<td style="border-right: thin solid grey;border-bottom: thin solid grey;border-left: thin solid grey;"><?php echo $jk; ?></td>
												<td style="border-right: thin solid grey;border-bottom: thin solid grey;border-left: thin solid grey;"><?php echo $resper['nis']; ?><input name="absen[]" value="<?php echo $resper['id_absen']; ?>" hidden></td>
												<td style="border-right: thin solid grey;border-bottom: thin solid grey;border-left: thin solid grey;"><?php echo $absen; ?></td>
												<td style="border-right: thin solid grey;border-bottom: thin solid grey;border-left: thin solid grey;">
													<?php if (empty($resper2['id_absen']) || $resper2['tipe_nilai'] == 2) {
															if ($resper['kd_absen'] == '1') {?>
																<div class="input-control text">
																	<input type="number" name="nilai[]">
																</div>
														<?php } else {?>
															<div class="input-control text">
																<input type="text" name="nilai[]" readonly="true" value="0">
															</div>
														<?php }
													} else {?>
														Maaf anda sudah input nilai untuk materi ini
													<?php } ?>
												</td>
											</tr>
						<?php } ?>
						</tbody>
				</table>

				<br><br>
				<div class="align-right"><span>*Note : Gunakan titik ( . ) untuk nilai koma</span></div>
				
				<br><br><br><br>

				<input type="text" name="ket" hidden>
				<?php if (empty($resper2['id_absen']) || $resper2['tipe_nilai'] == 2) { ?>
					<button class="button primary"><span class="mif-plus"></span> Tambah Baru</button>
				<?php } else { ?>
					<button class="button" disabled><span class="mif-plus"></span> Tambah Baru</button>
				<?php } ?>
				</form>
				</div>
		<?php }
	}
} ?>

