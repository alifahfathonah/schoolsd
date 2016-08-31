<?php  
	$id = $_GET['id'];
	$kls = $_GET['kls'];

	$setcl = $DB_connect->prepare("SELECT * FROM studen_ci WHERE id_stu = '$id'");	

	$setcl->execute();
	$resper2 = $setcl->fetch(PDO::FETCH_ASSOC);
	$no = 1;

	$setcl = $DB_connect->prepare("SELECT * FROM reg_teach_ci 
                                 INNER JOIN teacher_ci ON reg_teach_ci.id_guru = teacher_ci.id_guru
                                 INNER JOIN class_ci ON reg_teach_ci.id_kls = class_ci.id_kls
                                 INNER JOIN matpel_ci ON reg_teach_ci.id_matpel = matpel_ci.id_matpel
                                 WHERE class_ci.id_kls = '".$kls."'
                                 ORDER BY grade_kls");
    $setcl->execute();
    $resper3 = $setcl->fetchAll(PDO::FETCH_ASSOC);

    		
			


?>

<h1 class="text-light">Rapot</h1>
<h4 class="text-light">Ini adalah rapot <?php echo $resper2['nam_stu']; ?></h4>
<hr class="thin bg-grayLighter">
<a href="?page=in_rapot&kls=<?php echo $kls; ?>" class="pagination no-border" id="backinpri"><h3><span class="mif-arrow-left"></span></h3></a>
<a href="?page=ins_sikap_rapot&kls=<?php echo $kls; ?>&id=<?php echo $id; ?>" class="button primary"><span class="mif-plus"></span> Tambah nilai lainnya</a>

<table class="datatable" id="tab-class" data-role="datatable">
	<thead>
		<tr>
			<th>No</th>
			<th>Mata Pelajaran</th>
			<th>KKM</th>
			<th>Rata - Rata Ulangan</th>
			<th>Rata - Rata Tugas</th>
			<th>UTS</th>
			<th>UAS</th>
			<th>Hasil</th>
			<th>Lihat detil materi</th>
		</tr>
	</thead>
	<tbody>
	<?php foreach ($resper3 as $resper3) {

		$setcl = $DB_connect->prepare("SELECT sum(kkm) as kkm FROM stu_nilai_ci WHERE id_reg = '".$resper3['id_reg']."'");
		$setcl->execute();
		$resper4 = $setcl->fetch(PDO::FETCH_ASSOC);


		$setcl = $DB_connect->prepare("SELECT sum(nilai_aktual) as nilai FROM stu_nilai_ci WHERE id_reg = '".$resper3['id_reg']."'");
		$setcl->execute();
		$resper5 = $setcl->fetch(PDO::FETCH_ASSOC);

			


		$rows3 = $DB_connect->query("SELECT count(id_reg) FROM stu_nilai_ci WHERE id_reg = '".$resper3['id_reg']."'")->fetchColumn();
			
			if (empty($rows3)) {
				$sumw = '0';
			}
			else
			{
			$sumw = $resper4['kkm'] / $rows3;
			}


			

			
			$rows5 = $DB_connect->query("SELECT DISTINCT count(nilai_aktual) FROM stu_nilai_ci WHERE id_stu = '".$id."' AND tipe_nilai = 1 AND id_reg = '".$resper3['id_reg']."' ")->fetchColumn();


			$setcl = $DB_connect->query("SELECT sum(nilai_aktual)/ $rows5 as sumtugas FROM studen_ci
										  INNER JOIN stu_nilai_ci ON stu_nilai_ci.id_stu = studen_ci.id_stu
										  WHERE stu_nilai_ci.id_stu = '".$id."' AND tipe_nilai = 1  AND id_reg = '".$resper3['id_reg']."'");
			$setcl->execute();
			$hasilulg = $setcl->fetch(PDO::FETCH_ASSOC);

			if (empty($hasilulg['sumtugas'])) {
				$ulg = '0';
			}
			else
			{
			$ulg = $hasilulg['sumtugas'];
			}



			$rows5 = $DB_connect->query("SELECT DISTINCT count(nilai_aktual) FROM stu_nilai_ci WHERE id_stu = '".$id."' AND tipe_nilai = 2 AND id_reg = '".$resper3['id_reg']."'")->fetchColumn();


			$setcl = $DB_connect->query("SELECT sum(nilai_aktual)/ $rows5 as sumtugas FROM studen_ci
										  INNER JOIN stu_nilai_ci ON stu_nilai_ci.id_stu = studen_ci.id_stu
										  WHERE stu_nilai_ci.id_stu = '".$id."' AND tipe_nilai = 2  AND id_reg = '".$resper3['id_reg']."'");
			$setcl->execute();
			$hasiltgs = $setcl->fetch(PDO::FETCH_ASSOC);

			if (empty($hasiltgs['sumtugas'])) {
				$tgs = '0';
			}
			else
			{
			$tgs = $hasiltgs['sumtugas'];
			}



			$setcl = $DB_connect->query("SELECT nilai_aktual FROM studen_ci
										  INNER JOIN stu_nilai_ci ON stu_nilai_ci.id_stu = studen_ci.id_stu
										  WHERE stu_nilai_ci.id_stu = '".$id."' AND tipe_nilai = 3  AND id_reg = '".$resper3['id_reg']."'");
			$setcl->execute();
			$hasiluts = $setcl->fetch(PDO::FETCH_ASSOC);

			if (empty($hasiluts['nilai_aktual'])) {
				$uts = '0';
			}
			else
			{
			$uts = $hasiluts['nilai_aktual'];
			}



			$setcl = $DB_connect->query("SELECT nilai_aktual FROM studen_ci
										  INNER JOIN stu_nilai_ci ON stu_nilai_ci.id_stu = studen_ci.id_stu
										  WHERE stu_nilai_ci.id_stu = '".$id."' AND tipe_nilai = 4  AND id_reg = '".$resper3['id_reg']."'");
			$setcl->execute();
			$hasiluas = $setcl->fetch(PDO::FETCH_ASSOC);

			if (empty($hasiluas['nilai_aktual'])) {
				$uas = '0';
			}
			else
			{
			$uas = $hasiluas['nilai_aktual'];
			}


			$rumrapot = $ulg+$tgs+$uts+($uas*2);
			$totrapot = $rumrapot / 4;
		?>
		<tr>
			<td><?php echo $no++; ?></td>
			<td><?php echo $resper3['nam_pel']; ?></td>
			<td><?php echo $sumw; ?></td>
			<td><?php echo $ulg; ?></td>
			<td><?php echo $tgs; ?></td>
			<td><?php echo $uts; ?></td>
			<td><?php echo $uas; ?></td>
			<td><?php echo number_format($totrapot); ?></td>
			<td><button class="button primary" onclick="showDialog('#<?php echo $resper3['id_matpel']; ?>')"><span class = "mif-profile"></span></button></td>
		</tr>

		<div id="<?php echo $resper3['id_matpel']; ?>" data-role="dialog" data-type="info" data-overlay="true" data-overlay-color="op-dark" 
                                    class="Dialog padding20" data-close-button="true" data-width="850" data-height="500">
            
                                        <h3 class="align-center">ISI NILAI SIKAP</h3>
                                        <hr class="thin bg-grayLighter">
                                        <div class="grid">
                                        		<div class="row">
                                        			<div class="cell colspan4">
                                        				<button class="add_field_button">Add More Fields</button>
                                        			</div>
                                        		</div>
                                        </div>
                                        <div  style="overflow:auto;">
                                        <form method="post" id="updateexp" style="width: 368px;">
                                        <input type="hidden" name="nip[]" value="<?php echo $id; ?>">
                                        <div class="input_fields_wrap">
                                        </div>
                                        	<div class="grid">
                                        		<div class="row">
                                        			<div class="cell colspan4">
                                        				<div class="input-control text">
                                                			Aspek
			                                                <input type="text" id="aspek[]" name="aspek">                                                
			                                            </div>			
			                                            
                                        			</div>
                                        			<div class="cell colspan4">
                                        				<div class="input-control text">
			                                                Nilai
			                                                <select name="nilai[]">
			                                                	<option value="">----Silahkan Pilih----</option>
			                                                	<option disabled="true">-----------</option>
			                                                	<option>A</option>
			                                                	<option>B</option>
			                                                	<option>C</option>
			                                                	<option>D</option>
			                                                	<option>E</option>
			                                                </select>                                                
			                                            </div>
                                        			</div>
                                        			<div class="cell colspan4"> 
                                        				<div class="input-control textarea">
			                                                Deskripsi
			                                                <textarea></textarea>                                                
			                                            </div>
                                        			</div>
                                        		</div>
                                        	</div>
                                        </div>
                                        
                                        </form>
                                        </div>
                                    </div>
	<?php } ?>
	</tbody>
</table>