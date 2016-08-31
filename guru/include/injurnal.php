<?php 

$id_kls = $_POST['kls'][0];
$reg = $_POST['reg'][0];

$setcl2 = $DB_connect->prepare("SELECT * FROM reg_teach_ci 
                                 INNER JOIN teacher_ci ON reg_teach_ci.id_guru = teacher_ci.id_guru
                                 INNER JOIN class_ci ON reg_teach_ci.id_kls = class_ci.id_kls
                                 INNER JOIN matpel_ci ON reg_teach_ci.id_matpel = matpel_ci.id_matpel
                                 WHERE id_reg = '$reg'");
$setcl2->execute();
$resper2 = $setcl2->fetch(PDO::FETCH_ASSOC);
$now = date('d M Y');
 ?>
<h1 class="text-light">Input Absen <?php echo $resper2['grade_kls']." ".$resper2['nm_kls']; ?></h1>
<h4 class="text-light">Silahkan anda masukan data absensi siswa <?php echo $now; ?></h4>
<h4 class="text-light">Mata pelajaran <b><?php echo $resper2['nam_pel']; ?></b></h4>
<hr class="thin bg-grayLighter">
<div class="cell auto-size bg-white" id="inpribadi">
<a href="?page=jurnal" class="pagination no-border" id="backinpri"><h3><span class="mif-arrow-left"></span></h3></a>
<?php 

$setcl = $DB_connect->query("SELECT DISTINCT jad_start,jad_end,jam,interfal FROM schedule_teach_ci WHERE kls = '$reg' AND tipe_jadwal =1");
$setcl->execute();
$qjad = $setcl->fetch(PDO::FETCH_ASSOC);

$start = $qjad['jad_start'];
$end = $qjad['jad_end'];

$range = range($start, $end);
$now = date('Y-m-d');

if (empty($qjad['jad_start']) || empty($qjad['jad_end'])){
	echo "Belum dijadwalkan";
}
elseif ($now > $end) {
	echo "Expired! Mohon konfirmasi bagian kurikulum";
}
elseif ($now < $start) {
	echo "Belum Mulai Jadwal! Jadwal baru dimulai pada tanggal ".$start;
}
else{
			$jamskr = new DateTime();
			$jamdb = strtotime($qjad['jam']);
			$interval = $qjad['interfal'];
			$jamsls = date("H:i", strtotime('+'.$interval.' minutes', $jamdb));

			$jamb = $qjad['jam'];

			$mulai = new DateTime($jamskr->format('Y-m-d').'' .$jamb.'',new DateTimeZone('Asia/Jakarta'));
			$end = new DateTime($jamskr->format('Y-m-d').'' .$jamsls.'',new DateTimeZone('Asia/Jakarta'));

			#if (($jamskr >= $mulai) && ($jamskr <= $end)) {

			$nowday = date('N', strtotime(date('l'))); 
			$setcl = $DB_connect->query("SELECT * FROM schedule_teach_ci WHERE kls = '$reg' AND jad_day = '$nowday'");
			$setcl->execute();
			$resper2 = $setcl->fetch(PDO::FETCH_ASSOC);

			$lastmonth = date('Y-m-t'); 

			if ($nowday == $resper2['jad_day']) {

					$setcl = $DB_connect->prepare("SELECT * FROM studen_ci WHERE id_kls = '$id_kls'");
					$setcl->execute();
					$resper = $setcl->fetchAll(PDO::FETCH_ASSOC);
					$no = 1;

					$setcl3 = $DB_connect->prepare("SELECT DISTINCT tgl_input FROM stu_absen_ci WHERE id_reg = '$reg' AND tgl_input='$now'");
					$setcl3->execute();
					$resper3 = $setcl3->fetch(PDO::FETCH_ASSOC);


						if ($now == $resper3['tgl_input']) {
							echo "Anda sudah input absen untuk hari ini";
						}
						else{
					 	?>
							 <span>Jam</span>
							 <br>

							 <form method="post" action="?page=s_absen">
							 <div class="times countdown" data-role="times" data-blink="false" style="font-size: 20px"></div>
							 <input value="<?php echo $now; ?>" name="tgl" hidden/>
							 <input value="<?php echo $reg; ?>" name="reg" hidden/>
							 <table class="datatable align-center" id="tab-class" data-role="datatable" data-dt_scrolly="30%">
								<thead>
									<tr>
										<th rowspan="2" style="border-right: thin solid grey;border-top: thin solid grey;border-left: thin solid grey;">No</th>
										<th rowspan="2" style="border-right: thin solid grey;border-top: thin solid grey;">Nama Siswa</th>
										<th rowspan="2" style="border-right: thin solid grey;border-top: thin solid grey;">Jenis Kelamin</th>
										<th rowspan="2" style="border-right: thin solid grey;border-top: thin solid grey;">No Induk</th>
										<th colspan="4" style="border-right: thin solid grey;border-top: thin solid grey;">Absensi</th>
									</tr>
									<tr>
										<th style="border-right: thin solid grey;border-top: thin solid grey;">Hadir</th>
										<th style="border-right: thin solid grey;border-top: thin solid grey;">Sakit</th>
										<th style="border-right: thin solid grey;border-top: thin solid grey;">Izin</th>
										<th style="border-right: thin solid grey;border-top: thin solid grey;">Alpha</th>
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
										<td style="border-right: thin solid gre	y;border-bottom: thin solid grey;border-left: thin solid grey;"><?php echo $no++; ?></td>
										<td style="border-right: thin solid grey;border-bottom: thin solid grey;border-left: thin solid grey;"><?php echo $resper['nam_stu']; ?><input name="stu[]" value="<?php echo $resper['id_stu']; ?>" hidden></td>
										<td style="border-right: thin solid grey;border-bottom: thin solid grey;border-left: thin solid grey;"><?php echo $jk; ?></td>
										<td style="border-right: thin solid grey;border-bottom: thin solid grey;border-left: thin solid grey;"><?php echo $resper['nis']; ?></td>
										<td style="border-right: thin solid grey;border-bottom: thin solid grey;border-left: thin solid grey;">
											<label class="input-control radio small-check">
											    <input type="radio" name="radio<?php echo $resper['id_stu']; ?>" value="1">
											    <span class="check"></span>
											</label>
										</td>
										<td style="border-right: thin solid grey;border-bottom: thin solid grey;border-left: thin solid grey;">
											<label class="input-control radio small-check">
											    <input type="radio" name="radio<?php echo $resper['id_stu']; ?>" value="2">
											    <span class="check"></span>
											</label>
										</td>
										<td style="border-right: thin solid grey;border-bottom: thin solid grey;border-left: thin solid grey;">
											<label class="input-control radio small-check">
											    <input type="radio" name="radio<?php echo $resper['id_stu']; ?>" value="3">
											    <span class="check"></span>
											</label>
										</td>
										<td style="border-right: thin solid grey;border-bottom: thin solid grey;border-left: thin solid grey;">
											<label class="input-control radio small-check">
											    <input type="radio" name="radio<?php echo $resper['id_stu']; ?>" value="4" checked>
											    <span class="check"></span>
											</label>
										</td>
									</tr>
								<?php } ?>
							</tbody>
					</table>

					<div class="input-control textarea"
					    data-role="input" style="height:20%;width:50%">
					    Materi Hari ini
					    <textarea name="materi"></textarea>
					</div>

					<br><br>

					<button class="button primary"><span class="mif-plus"></span> Tambah Baru</button>

					</form>
					<?php 
							
						}
			}
			elseif ($now == $lastmonth) { 

					$setcl3 = $DB_connect->prepare("SELECT DISTINCT materi FROM stu_absen_ci WHERE id_reg = '$reg'");
					$setcl3->execute();
					$resper3 = $setcl3->fetchAll(PDO::FETCH_ASSOC);

					$rows4 = $DB_connect->query("SELECT count(nm_kls) FROM class_ci WHERE grade_kls = 'Kelas IV'")->fetchColumn();

						?>
						<h3>Silahkan anda dapat mengedit absensi setiap akhir bulan</h3>
						<br>
						<form method="post" action="?page=e_absensi">
						<div class="input-control text">
						Pilih Tanggal Input Absen
							<select>
							<?php foreach ($resper3 as $resper3) {
								$setcl3 = $DB_connect->prepare("SELECT DISTINCT tgl_input FROM stu_absen_ci WHERE materi = '".$resper3['materi']."'");
								$setcl3->execute();
								$resper4 = $setcl3->fetch(PDO::FETCH_ASSOC);
							?>
								<option><?php echo $resper4['tgl_input']." Materi (".$resper3['materi'].")"; ?></option>
							<?php } ?>
							</select>
						</div>
						<br><br>
						<button class="button primary">Proses</button>
						<br><br>

						</form>
								<?php

								if ($nowday == $resper2['jad_day']) {

								$setcl = $DB_connect->prepare("SELECT * FROM studen_ci WHERE id_kls = '$id_kls'");
								$setcl->execute();
								$resper = $setcl->fetchAll(PDO::FETCH_ASSOC);
								$no = 1;

								$setcl2 = $DB_connect->prepare("SELECT tgl_input FROM stu_absen_ci WHERE id_reg = '$reg'");
								$setcl2->execute();
								$resper2 = $setcl2->fetch(PDO::FETCH_ASSOC);

									if ($now == $resper2['tgl_input']) {
										echo "Anda sudah input absen untuk hari ini";
									}
									else{
								 ?>
										 <span>Jam</span>
										 <br>

										 <form method="post" action="?page=s_absen">
										 <div class="times countdown" data-role="times" data-blink="false" style="font-size: 20px"></div>
										 <input value="<?php echo $now; ?>" name="tgl" hidden/>
										 <input value="<?php echo $reg; ?>" name="reg" hidden/>
										 <table class="datatable align-center" id="tab-class" data-role="datatable" data-dt_scrolly="30%">
											<thead>
												<tr>
													<th rowspan="2" style="border-right: thin solid grey;border-top: thin solid grey;border-left: thin solid grey;">No</th>
													<th rowspan="2" style="border-right: thin solid grey;border-top: thin solid grey;">Nama Siswa</th>
													<th rowspan="2" style="border-right: thin solid grey;border-top: thin solid grey;">Jenis Kelamin</th>
													<th rowspan="2" style="border-right: thin solid grey;border-top: thin solid grey;">No Induk</th>
													<th colspan="4" style="border-right: thin solid grey;border-top: thin solid grey;">Absensi</th>
												</tr>
												<tr>
													<th style="border-right: thin solid grey;border-top: thin solid grey;">Hadir</th>
													<th style="border-right: thin solid grey;border-top: thin solid grey;">Sakit</th>
													<th style="border-right: thin solid grey;border-top: thin solid grey;">Izin</th>
													<th style="border-right: thin solid grey;border-top: thin solid grey;">Alpha</th>
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
														<label class="input-control radio small-check">
														    <input type="radio" name="radio<?php echo $resper['id_stu']; ?>" value="1">
														    <span class="check"></span>
														</label>
													</td>
													<td style="border-right: thin solid grey;border-bottom: thin solid grey;border-left: thin solid grey;">
														<label class="input-control radio small-check">
														    <input type="radio" name="radio<?php echo $resper['id_stu']; ?>" value="2">
														    <span class="check"></span>
														</label>
													</td>
													<td style="border-right: thin solid grey;border-bottom: thin solid grey;border-left: thin solid grey;">
														<label class="input-control radio small-check">
														    <input type="radio" name="radio<?php echo $resper['id_stu']; ?>" value="3">
														    <span class="check"></span>
														</label>
													</td>
													<td style="border-right: thin solid grey;border-bottom: thin solid grey;border-left: thin solid grey;">
														<label class="input-control radio small-check">
														    <input type="radio" name="radio<?php echo $resper['id_stu']; ?>" value="4" checked>
														    <span class="check"></span>
														</label>
													</td>
												</tr>
										<?php } ?>
										</tbody>
								</table>

								<div class="input-control textarea"
								    data-role="input" style="height:20%;width:50%">
								    Materi Hari ini
								    <textarea name="materi"></textarea>
								</div>

								<br><br>

								<button class="button primary"><span class="mif-plus"></span> Tambah Baru</button>

								</form>
				<?php
								}
											}
								else{
									echo "<br>Maaf tidak ada Jam pelajaran anda hari ini";
								}
			}
			else{
				echo "<br>Maaf tidak ada Jam pelajaran anda hari ini";
			}
}

?>
