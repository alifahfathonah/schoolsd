<h1 class="text-light">Anda dapat melihat jadwal pelajaran disini</span></h1>
<hr class="thin bg-grayLighter">

<?php 

$setcl = $DB_connect->query("SELECT DISTINCT jad_day FROM class_ci 
							 INNER JOIN studen_ci ON class_ci.id_kls = studen_ci.id_kls 
							 INNER JOIN reg_teach_ci ON class_ci.id_kls = reg_teach_ci.id_kls 
							 INNER JOIN schedule_teach_ci ON reg_teach_ci.id_reg = schedule_teach_ci.kls
							 WHERE nis = '".$userRow['username']."'");
$setcl->execute();
$murid = $setcl->fetchAll(PDO::FETCH_ASSOC);

$countrowday = $DB_connect->query("SELECT DISTINCT jad_day FROM class_ci 
							 INNER JOIN studen_ci ON class_ci.id_kls = studen_ci.id_kls 
							 INNER JOIN reg_teach_ci ON class_ci.id_kls = reg_teach_ci.id_kls 
							 INNER JOIN schedule_teach_ci ON reg_teach_ci.id_reg = schedule_teach_ci.kls
							 WHERE nis = '".$userRow['username']."'")->fetchColumn();

$setcl = $DB_connect->query("SELECT * FROM studen_ci 
							 INNER JOIN class_ci ON studen_ci.id_kls = class_ci.id_kls
							 WHERE nis = '".$userRow['username']."'");
$setcl->execute();
$getid = $setcl->fetch(PDO::FETCH_ASSOC);


		$setcl = $DB_connect->query("SELECT jam FROM schedule_teach_ci
									 INNER JOIN studen_ci ON schedule_teach_ci.id_kls = studen_ci.id_kls
							 		 WHERE nis = '".$userRow['username']."' GROUP BY jam ORDER BY jam");
		$setcl->execute();
		$day = $setcl->fetchAll(PDO::FETCH_ASSOC);
$no = 1;



echo "";
?>

<table class="datatable align-center" id="tab-class" data-role="datatable">
	<thead>
		<tr>
			<th rowspan="2">No</th>
			<th rowspan="2">Jam</th>
			<th colspan="<?php echo $countrowday; ?>">Hari</th>
		</tr>
		<tr>
		<?php foreach ($murid as $murid) { 	

			if ($murid['jad_day'] == 1) {
						$hari = 'Senin';
					}
			elseif ($murid['jad_day'] == 2) {
						$hari = 'Selasa';
					}
			elseif ($murid['jad_day'] == 3) {
						$hari = 'Rabu';
					}
			elseif ($murid['jad_day'] == 4) {
						$hari = 'Kamis';
					}
			elseif ($murid['jad_day'] == 5) {
						$hari = 'Jumat';
					}
			elseif ($murid['jad_day'] == 6) {
						$hari = 'Sabtu';
					}
			else  	{
						$hari = 'Minggu';
					}

		?>
		<th><?php echo $hari; ?></th>
		<?php } ?>
		</tr>
	</thead>
	<tbody class="align-left">
	<?php foreach ($day as $day) { 

		$setcl = $DB_connect->query("SELECT teacher_ci.id_guru,teacher_ci.nama,teacher_ci.jk,teacher_ci.teach_photo,agama,telp,teacher_ci.ttl,kls,jam,nam_pel FROM schedule_teach_ci 
							 LEFT OUTER JOIN reg_teach_ci ON schedule_teach_ci.kls = reg_teach_ci.id_reg
							 LEFT OUTER JOIN matpel_ci ON reg_teach_ci.id_matpel = matpel_ci.id_matpel
							 LEFT OUTER JOIN teacher_ci ON reg_teach_ci.id_guru = teacher_ci.id_guru
							 LEFT OUTER JOIN bio_teach_ci ON teacher_ci.id_bio = bio_teach_ci.id_bio
							 WHERE jam = '".$day['jam']."' AND schedule_teach_ci.id_kls =  '".$getid['id_kls']."'
							 ORDER BY jad_day");
		$setcl->execute();
		$jam2 = $setcl->fetchAll(PDO::FETCH_ASSOC);
		 ?>
		<tr>
			<td><?php echo $no++; ?></td>
			<td><?php echo $day['jam']; ?></td>
		<?php foreach ($jam2 as $jam2) { 

					if ($jam2['kls'] === 'Upacara Bendera' ) {
						$t = 'Upacara';
						echo "<td bgcolor='#00ff00'>".$t."</td>";
					}
					elseif ($jam2['kls'] === 'Istirahat' ) {
						$t = 'Istirahat';
						echo "<td bgcolor='#ffff00'>".$t."</td>";
					}
					elseif ($jam2['kls'] === 'Libur' ) {
						$t = 'Libur';
						echo "<td bgcolor='#FF0000'>".$t."</td>";
					}
					else{
						$t = $jam2['nam_pel'];
					?>
						<td><?php echo $t; ?><button class="button cycle-button" onclick="showDialog('#dialog<?php echo $jam2['id_guru'] ?>')"><span class="mif-zoom-in"></span></button></td>
					<?php } ?>
			<div id="dialog<?php echo $jam2['id_guru']; ?>" data-role="dialog" data-type="info" data-overlay="true" data-overlay-color="op-dark" class="Dialog padding20" data-close-button="true" data-width="550" data-height="270">
	                    <h3 class="align-center">Profil <?php echo $jam2['nama']; ?></h3>
	                    <hr class="thin bg-grayLighter">
	                    <div class="grid">
						    <div class="row">
						        <div class="cell colspan3">
						        	Tanggal Lahir
						        	<br><br>
						        	Jenis Kelamin
						        	<br><br>
						        	Agama
						        	<br><br>
						        	Telepon
						        </div>
						        <div class="cell colspan1">
						        	:
						        	<br><br>
						        	:
						        	<br><br>
						        	:
						        	<br><br>
						        	:
						        </div>
						        <div class="cell colspan4">
						        	<?php echo date('d M Y', strtotime($jam2['ttl'])); ?>
						        	<br><br>
						        	<?php echo $jam2['jk']; ?>
						        	<br><br>
						        	<?php echo $jam2['agama']; ?>
						        	<br><br>
						        	<?php echo $jam2['telp']; ?>
						        </div>
						        <div class="cell colspan4">
						        	<img src="<?php echo $jam2['teach_photo']; ?>" alt="Gambar anda"  style="height: 200px; width:200px;">
						        </div>
						    </div>
						</div>
	                    
	        </div>
		<?php } ?>
		</tr>
	<?php } ?>
	</tbody>
</table>