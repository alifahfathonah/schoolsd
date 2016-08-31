<?php 


$tglf = $_POST['tglf'];
$tgle = $_POST['tgle'];
$int = $_POST['int'];
$jamf = $_POST['jamfirst'];
$jame = $_POST['jamend'];
$day = $_POST['day'];

if ($day == 1) {
	$hari = 'Senin';
}
elseif ($day == 2) {
	$hari = 'Selasa';
}
elseif ($day == 3) {
	$hari = 'Rabu';
}
elseif ($day == 4) {
	$hari = 'Kamis';
}
elseif ($day == 5) {
	$hari = 'Jumat';
}
elseif ($day == 6) {
	$hari = 'Sabtu';
}
else{
	$hari = 'Minggu';
}


$start    = new DateTime($jamf);
$end1      = new DateTime($jame);
$end	  = $end1->modify('+1 minute');
$interval = new DateInterval('PT'.$int.'M');
$period   = new DatePeriod($start, $interval, $end);

$setcl = $DB_connect->query("SELECT * FROM class_ci WHERE grade_kls = 'Kelas I'");
$setcl->execute();
$kls1 = $setcl->fetchall(PDO::FETCH_ASSOC);

$rows = $DB_connect->query("SELECT count(nm_kls) FROM class_ci WHERE grade_kls = 'Kelas I'")->fetchColumn();

$setcl = $DB_connect->query("SELECT * FROM class_ci WHERE grade_kls = 'Kelas II'");
$setcl->execute();
$kls2 = $setcl->fetchall(PDO::FETCH_ASSOC);

$rows2 = $DB_connect->query("SELECT count(nm_kls) FROM class_ci WHERE grade_kls = 'Kelas II'")->fetchColumn();

$setcl = $DB_connect->query("SELECT * FROM class_ci WHERE grade_kls = 'Kelas III'");
$setcl->execute();
$kls3 = $setcl->fetchall(PDO::FETCH_ASSOC);

$rows3 = $DB_connect->query("SELECT count(nm_kls) FROM class_ci WHERE grade_kls = 'Kelas III'")->fetchColumn();

$setcl = $DB_connect->query("SELECT * FROM class_ci WHERE grade_kls = 'Kelas IV'");
$setcl->execute();
$kls4 = $setcl->fetchall(PDO::FETCH_ASSOC);

$rows4 = $DB_connect->query("SELECT count(nm_kls) FROM class_ci WHERE grade_kls = 'Kelas IV'")->fetchColumn();

$setcl = $DB_connect->query("SELECT * FROM class_ci WHERE grade_kls = 'Kelas V'");
$setcl->execute();
$kls5 = $setcl->fetchall(PDO::FETCH_ASSOC);

$rows5 = $DB_connect->query("SELECT count(nm_kls) FROM class_ci WHERE grade_kls = 'Kelas V'")->fetchColumn();

$setcl = $DB_connect->query("SELECT * FROM class_ci WHERE grade_kls = 'Kelas VI'");
$setcl->execute();
$kls6 = $setcl->fetchall(PDO::FETCH_ASSOC);

$rows6 = $DB_connect->query("SELECT count(nm_kls) FROM class_ci WHERE grade_kls = 'Kelas VI'")->fetchColumn();

$setcl = $DB_connect->prepare("SELECT DISTINCT grade_kls FROM class_ci ORDER BY grade_kls");
$setcl->execute();
$grade = $setcl->fetchAll(PDO::FETCH_ASSOC);

$setcl = $DB_connect->prepare("SELECT DISTINCT grade_kls FROM class_ci ORDER BY grade_kls");
$setcl->execute();
$grade2 = $setcl->fetchAll(PDO::FETCH_ASSOC); 
 ?>
 <script>
    $(function(){
        $("#select").select2();
    });
</script>

<div class="page-content">
        <div class="flex-grid no-responsive-future" style="height: 100%;">
            <div class="row" style="height: 100%;">
                <div class="flex-grid no-responsive-future" style="height: 100%;">
		            <div class="row">
                        <div class="cell auto-size bg-white padding20" id="cell-content">
                        
                            <h1 class="align-center">Tambahkan Jadwal Hari <?php echo $hari; ?></h1>
                            <h5 class="align-center">Silahkan tambahkan data jadwal anda</h5>
                            <h5 class="align-center">Dari Bulan <?php echo date('M-Y',strtotime($tglf)); ?> Hingga <?php echo date('M-Y',strtotime($tgle)); ?></h5>
                                <hr class="thick bg-grayLighter">
                            <div id="tes" style="overflow:true;">
                            <form method="post" action="?page=s_sch_guru">
                            <table class="cell-border" id="tab-class" data-role="datatable" data-paging="false" data-dt_scrollx="50%" style="font-size:12px;width:auto;">
                            	<thead>
                            		<tr>
                            			<th rowspan="2" style="border-right: thin solid grey;">Jam</th>
                            			<?php foreach ($grade as $grade) {
                            				$rows = $DB_connect->query("SELECT count(nm_kls) FROM class_ci WHERE grade_kls = '".$grade['grade_kls']."'")->fetchColumn();
                            			 ?>
                            			<th colspan="<?php echo $rows; ?>" style="border-right: thin solid grey;"><?php echo $grade['grade_kls']; ?></th>
                            			<?php } ?>
                            		</tr>
                            		<tr>
                            		<?php foreach ($grade2 as $grade2) { 
                            			$setcl = $DB_connect->query("SELECT * FROM class_ci WHERE grade_kls = '".$grade2['grade_kls']."'");
										$setcl->execute();
										$kls = $setcl->fetchall(PDO::FETCH_ASSOC);
										foreach ($kls as $kls) {
                            		?>
                            			<th style="border-right: thin solid grey;border-top: thin solid grey;"><?php echo $kls['nm_kls']; ?></th>
                            		<?php } }?>
                            		</tr>
                            	</thead>	
                            	<tbody>
                            	<input type="text" name="day" value="<?php echo $day; ?>" hidden>
                            	<input type="text" name="tglf" value="<?php echo $tglf; ?>" hidden>
                            	<input type="text" name="tgle" value="<?php echo $tgle; ?>" hidden>
                            	<input type="text" name="int" value="<?php echo $int; ?>" hidden>
                            	     <?php foreach ($period as $dt){ ?>
									    <tr>
									    	<td style="border-right: thin solid grey;"><?php echo $dt->format('H:i');?></td>
									    	
									    	<!-- Kelas I -->
									    	<?php
									    		$setcl = $DB_connect->query("SELECT nm_kls,id_kls FROM class_ci WHERE grade_kls = 'Kelas I'");
												$setcl->execute();
												$kls11 = $setcl->fetchall(PDO::FETCH_ASSOC);
									    	
									    	foreach ($kls11 as $kls11) { ?>
									    	<td style="border-right: thin solid grey;">
										    	<?php 
                            						$setcl = $DB_connect->query("SELECT nama,nam_pel,grade_kls,nm_kls,id_reg FROM reg_teach_ci 
												                                 INNER JOIN teacher_ci ON reg_teach_ci.id_guru = teacher_ci.id_guru
												                                 INNER JOIN class_ci ON reg_teach_ci.id_kls = class_ci.id_kls
												                                 INNER JOIN matpel_ci ON reg_teach_ci.id_matpel = matpel_ci.id_matpel
												                                 WHERE grade_kls = 'Kelas I' AND nm_kls = '".$kls11['nm_kls']."'");
														    $setcl->execute();
														    $showreg = $setcl->fetchall(PDO::FETCH_ASSOC);
										    	 ?>
										    	<div class="input-control select" data-role="select">
										    	<input type="text" name="colkls[]" value="<?php echo $kls11['id_kls']; ?>" hidden>
										    	<input name="time[]" type="text" value="<?php echo $dt->format('H:i');?>" hidden>
										    		<select name="kls1[]" id="kls1" hidden>
										    		<option>Libur</option>
										    		<option>Upacara Bendera</option>
										    		<option>Istirahat</option>
										    			<?php foreach ($showreg as $showreg){ ?>
										    						<option value="<?php echo $showreg['id_reg']; ?>"><?php echo $showreg['nama']." - ".$showreg['nam_pel']; ?></option>
										    			<?php }?>
										    		</select>
										    	</div>
									    	</td>
									    	<?php  }?>	

									    	<!-- Kelas II -->
									    	<?php
									    		$setcl = $DB_connect->query("SELECT nm_kls,id_kls FROM class_ci WHERE grade_kls = 'Kelas II'");
												$setcl->execute();
												$kls12 = $setcl->fetchall(PDO::FETCH_ASSOC);
									    	
									    	foreach ($kls12 as $kls12) { ?>
									    	<td style="border-right: thin solid grey;">
										    	<?php 
                            						$setcl = $DB_connect->query("SELECT nama,nam_pel,grade_kls,nm_kls,id_reg FROM reg_teach_ci 
												                                 INNER JOIN teacher_ci ON reg_teach_ci.id_guru = teacher_ci.id_guru
												                                 INNER JOIN class_ci ON reg_teach_ci.id_kls = class_ci.id_kls
												                                 INNER JOIN matpel_ci ON reg_teach_ci.id_matpel = matpel_ci.id_matpel
												                                 WHERE grade_kls = 'Kelas II' AND nm_kls = '".$kls12['nm_kls']."'");
														    $setcl->execute();
														    $showreg = $setcl->fetchall(PDO::FETCH_ASSOC);
										    	 ?>
										    	<div class="input-control select" data-role="select">
										    	<input type="text" name="colkls[]" value="<?php echo $kls12['id_kls']; ?>" hidden>
										    	<input name="time[]" type="text" value="<?php echo $dt->format('H:i');?>" hidden>
										    		<select name="kls1[]" id="kls1" hidden>
										    		<option>Libur</option>
										    		<option>Upacara Bendera</option>
										    		<option>Istirahat</option>
										    			<?php foreach ($showreg as $showreg){ ?>
										    						<option value="<?php echo $showreg['id_reg']; ?>"><?php echo $showreg['nama']." - ".$showreg['nam_pel']; ?></option>
										    			<?php }?>
										    		</select>
										    	</div>
									    	</td>
									    	<?php  }?>		

									    	<!-- Kelas III -->
									    	<?php
									    		$setcl = $DB_connect->query("SELECT nm_kls,id_kls FROM class_ci WHERE grade_kls = 'Kelas III'");
												$setcl->execute();
												$kls13 = $setcl->fetchall(PDO::FETCH_ASSOC);
									    	
									    	foreach ($kls13 as $kls13) { ?>
									    	<td style="border-right: thin solid grey;">
										    	<?php 
                            						$setcl = $DB_connect->query("SELECT nama,nam_pel,grade_kls,nm_kls,id_reg FROM reg_teach_ci 
												                                 INNER JOIN teacher_ci ON reg_teach_ci.id_guru = teacher_ci.id_guru
												                                 INNER JOIN class_ci ON reg_teach_ci.id_kls = class_ci.id_kls
												                                 INNER JOIN matpel_ci ON reg_teach_ci.id_matpel = matpel_ci.id_matpel
												                                 WHERE grade_kls = 'Kelas III' AND nm_kls = '".$kls13['nm_kls']."'");
														    $setcl->execute();
														    $showreg = $setcl->fetchall(PDO::FETCH_ASSOC);
										    	 ?>
										    	<div class="input-control select" data-role="select">
										    	<input type="text" name="colkls[]" value="<?php echo $kls13['id_kls']; ?>" hidden>
										    	<input name="time[]" type="text" value="<?php echo $dt->format('H:i');?>" hidden>
										    		<select name="kls1[]" id="kls1" hidden>
										    		<option>Libur</option>
										    		<option>Upacara Bendera</option>
										    		<option>Istirahat</option>
										    			<?php foreach ($showreg as $showreg){ ?>
										    						<option value="<?php echo $showreg['id_reg']; ?>"><?php echo $showreg['nama']." - ".$showreg['nam_pel']; ?></option>
										    			<?php }?>
										    		</select>
										    	</div>
									    	</td>
									    	<?php  }?>		

									    	<!-- Kelas IV -->
									    	<?php
									    		$setcl = $DB_connect->query("SELECT nm_kls,id_kls FROM class_ci WHERE grade_kls = 'Kelas IV'");
												$setcl->execute();
												$kls14 = $setcl->fetchall(PDO::FETCH_ASSOC);
									    	

									    	foreach ($kls14 as $kls14) { ?>
									    	<td style="border-right: thin solid grey;">
										    	<?php 
                            						$setcl = $DB_connect->query("SELECT nama,nam_pel,grade_kls,nm_kls,id_reg FROM reg_teach_ci 
												                                 INNER JOIN teacher_ci ON reg_teach_ci.id_guru = teacher_ci.id_guru
												                                 INNER JOIN class_ci ON reg_teach_ci.id_kls = class_ci.id_kls
												                                 INNER JOIN matpel_ci ON reg_teach_ci.id_matpel = matpel_ci.id_matpel
												                                 WHERE grade_kls = 'Kelas IV' AND nm_kls = '".$kls14['nm_kls']."'");
														    $setcl->execute();
														    $showreg = $setcl->fetchall(PDO::FETCH_ASSOC);
										    	 ?>
										    	<div class="input-control select" data-role="select">
										    	<input type="text" name="colkls[]" value="<?php echo $kls14['id_kls']; ?>" hidden>
										    	<input name="time[]" type="text" value="<?php echo $dt->format('H:i');?>" hidden>
										    		<select name="kls1[]" id="kls1" hidden>
										    		<option>Libur</option>
										    		<option>Upacara Bendera</option>
										    		<option>Istirahat</option>
										    			<?php foreach ($showreg as $showreg){ ?>
										    						<option value="<?php echo $showreg['id_reg']; ?>"><?php echo $showreg['nama']." - ".$showreg['nam_pel']; ?></option>
										    			<?php }?>
										    		</select>
										    	</div>
									    	</td>
									    	<?php } ?>

									    	<!-- Kelas V -->
									    	<?php
									    		$setcl = $DB_connect->query("SELECT nm_kls,id_kls FROM class_ci WHERE grade_kls = 'Kelas V'");
												$setcl->execute();
												$kls15 = $setcl->fetchall(PDO::FETCH_ASSOC);

												
									    	foreach ($kls15 as $kls15) { ?>
									    	<td style="border-right: thin solid grey;">
										    	<?php 
                            						$setcl = $DB_connect->query("SELECT nama,nam_pel,grade_kls,nm_kls,id_reg FROM reg_teach_ci 
												                                 INNER JOIN teacher_ci ON reg_teach_ci.id_guru = teacher_ci.id_guru
												                                 INNER JOIN class_ci ON reg_teach_ci.id_kls = class_ci.id_kls
												                                 INNER JOIN matpel_ci ON reg_teach_ci.id_matpel = matpel_ci.id_matpel
												                                 WHERE grade_kls = 'Kelas V' AND nm_kls = '".mysql_escape_string($kls15['nm_kls'])."'");
														    $setcl->execute();
														    $showreg = $setcl->fetchall(PDO::FETCH_ASSOC);
										    	 ?>
										    	<div class="input-control select" data-role="select">
										    	<input type="text" name="colkls[]" value="<?php echo $kls15['id_kls']; ?>" hidden>
										    	<input name="time[]" type="text" value="<?php echo $dt->format('H:i');?>" hidden>
										    		<select name="kls1[]" id="kls1" hidden>
										    		<option>Libur</option>
										    		<option>Upacara Bendera</option>
										    		<option>Istirahat</option>
										    			<?php foreach ($showreg as $showreg){ ?>
										    						<option value="<?php echo $showreg['id_reg']; ?>"><?php echo $showreg['nama']." - ".$showreg['nam_pel']; ?></option>
										    			<?php }?>
										    		</select>
										    	</div>
									    	</td>
									    	<?php  }?>

									    	<!-- Kelas VI -->
									    	<?php
									    		$setcl = $DB_connect->query("SELECT nm_kls,id_kls FROM class_ci WHERE grade_kls = 'Kelas VI'");
												$setcl->execute();
												$kls16 = $setcl->fetchall(PDO::FETCH_ASSOC);
									    	
									    	foreach ($kls16 as $kls16) { ?>
									    	<td style="border-right: thin solid grey;">
										    	<?php 
                            						$setcl = $DB_connect->query("SELECT nama,nam_pel,grade_kls,nm_kls,id_reg FROM reg_teach_ci 
												                                 INNER JOIN teacher_ci ON reg_teach_ci.id_guru = teacher_ci.id_guru
												                                 INNER JOIN class_ci ON reg_teach_ci.id_kls = class_ci.id_kls
												                                 INNER JOIN matpel_ci ON reg_teach_ci.id_matpel = matpel_ci.id_matpel
												                                 WHERE grade_kls = 'Kelas VI' AND nm_kls = '".$kls16['nm_kls']."'");
														    $setcl->execute();
														    $showreg = $setcl->fetchall(PDO::FETCH_ASSOC);
										    	 ?>
										    	<div class="input-control select" data-role="select">
										    	<input type="text" name="colkls[]" value="<?php echo $kls16['id_kls']; ?>" hidden>
										    	<input name="time[]" type="text" value="<?php echo $dt->format('H:i');?>" hidden>
										    		<select name="kls1[]" id="kls1" hidden>
										    		<option>Libur</option>
										    		<option>Upacara Bendera</option>
										    		<option>Istirahat</option>
										    			<?php foreach ($showreg as $showreg){ ?>
										    						<option value="<?php echo $showreg['id_reg']; ?>"><?php echo $showreg['nama']." - ".$showreg['nam_pel']; ?></option>
										    			<?php }?>
										    		</select>
										    	</div>
									    	</td>
									    	<?php }?>

									    </tr>									    
									<?php } ?>
                            	</tbody>
                            </table>
                            </div>
                                <br>
                                    <button name="btn-sub-jadwal" id="btn-sub-jadwal" class="button primary">Proses</button>
                                    <a class="button warning" href="?page=jam_matpel">Batal</a>
                                </form>
                        	</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</div>