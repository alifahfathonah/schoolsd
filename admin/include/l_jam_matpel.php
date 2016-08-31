
<?php 
$setcl = $DB_connect->prepare("SELECT * FROM reg_teach_ci 
                               INNER JOIN teacher_ci ON reg_teach_ci.id_guru = teacher_ci.id_guru
                               INNER JOIN class_ci ON reg_teach_ci.id_kls = class_ci.id_kls
                               INNER JOIN matpel_ci ON reg_teach_ci.id_matpel = matpel_ci.id_matpel");
$setcl->execute();
$resreg = $setcl->fetchall(PDO::FETCH_ASSOC); 
$no=1;

$setcl = $DB_connect->query("SELECT * FROM class_ci WHERE grade_kls = 'Kelas I' ORDER BY nm_kls");
$setcl->execute();
$kls1 = $setcl->fetchall(PDO::FETCH_ASSOC);

$rows = $DB_connect->query("SELECT count(nm_kls) FROM class_ci WHERE grade_kls = 'Kelas I'")->fetchColumn();

$setcl = $DB_connect->query("SELECT * FROM class_ci WHERE grade_kls = 'Kelas II' ORDER BY nm_kls");
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

$setcl = $DB_connect->prepare("SELECT 
								(SELECT group_concat(DISTINCT grade_kls) FROM class_ci) as grade
                		     ");
$setcl->execute();
$grade = $setcl->fetchAll(PDO::FETCH_ASSOC);

$rows6 = $DB_connect->query("SELECT count(nm_kls) FROM class_ci WHERE grade_kls = 'Kelas VI'")->fetchColumn();
 ?>
 <div id="loadpage">
<div class="page-content"  style="overflow:auto">
        <div class="flex-grid no-responsive-future" style="height: 100%;">
            <div class="row" style="height: 100%">
                <div class="flex-grid no-responsive-future" style="height: 100%;">
		            <div class="row" style="height: 100%">
		                <div class="cell auto-size bg-white padding40" id="cell-content">
                        <div id="tes">
                            <h1 class="align-center">Set Jadwal</h1>
                            <h5 class="align-center">Anda bisa set jadwal pelajaran di sekolah</h5>
                                <hr class="thin bg-grayLighter">
 <?php
 $dur = explode(",", $_POST['dur']);
 $day = $_POST['day']; 

 $jada = $dur[0];
 $jade = $dur[1];
												        	$setcl = $DB_connect->query("SELECT DISTINCT jad_start,jad_end FROM schedule_teach_ci");
															$setcl->execute();
															$qjad = $setcl->fetch(PDO::FETCH_ASSOC);

															$start = $qjad['jad_start'];
															$end = $qjad['jad_end'];

															$range = range($start, $end);
															$now = date('Y-m-d');

															if ($now > $end) {
																echo "Expired";
															}
															elseif ($now < $start) {
																echo "Belum";
															}
															else{
																$setcl = $DB_connect->query("SELECT DISTINCT jad_day FROM schedule_teach_ci ORDER BY jad_day");
																$setcl->execute();
																$qday = $setcl->fetch(PDO::FETCH_ASSOC);
																$nowday = date('N', strtotime(date('l')));
																$day2 = $qday['jad_day'];


												         ?>
												        	<table id="tab-class" data-role="datatable">
												        		<thead>
								                            		<tr>
								                            			<th>Jam</th>
								                            			<th colspan="<?php echo $rows; ?>">Kelas I</th>
								                            			<th colspan="<?php echo $rows2; ?>">Kelas II</th>
								                            			<th colspan="<?php echo $rows3; ?>">Kelas III</th>
								                            			<th colspan="<?php echo $rows4; ?>">Kelas IV</th>
								                            			<th colspan="<?php echo $rows5; ?>">Kelas V</th>
								                            			<th colspan="<?php echo $rows6; ?>">Kelas VI</th>
								                            		</tr>
								                            	</thead>	
												        		<tbody>
												        		
												        		<?php 
												        			$nowday = date('N', strtotime(date('l')));
												        			$setcl = $DB_connect->prepare("SELECT DISTINCT jam FROM schedule_teach_ci 
												        				 						   INNER JOIN class_ci ON schedule_teach_ci.id_kls = class_ci.id_kls
												        										   WHERE jad_day = '$day'
												        										   ORDER BY jam");
														        	$setcl->execute();
														        	$ressch = $setcl->fetchall(PDO::FETCH_ASSOC);
														        	$no = 1;

														        	
														        	foreach ($ressch as $ressch) {?>
												        			<tr>
												        				<td><?php echo $ressch['jam']; ?></td>
												        				<!-- Kelas 1 -->
												        				<?php 
												        					$setcl = $DB_connect->prepare("SELECT * FROM schedule_teach_ci 
																		                                   LEFT OUTER JOIN reg_teach_ci ON schedule_teach_ci.kls = reg_teach_ci.id_reg
																		                                   LEFT OUTER JOIN class_ci ON schedule_teach_ci.id_kls = class_ci.id_kls
																		                                   WHERE jam = '".$ressch['jam']."'
																		                                   AND jad_day = '$day'
																		                                   ORDER BY grade_kls ASC");
												        					$setcl->execute();
												        					$resreg1 = $setcl->fetchall(PDO::FETCH_ASSOC);
												        				foreach ($resreg1 as $resreg1) {
													        				if ($resreg1['kls'] == 'Libur') { ?>
													        				<td>
														        				<div class="tile bg-red fg-white">
																				    <div class="tile-content iconic">
																				    	<span class="icon mif-home"></span>
																				    	<span class="tile-label">Libur</span>
																				    </div>
																				</div>	
																			</td>
													        				<?php 
													        					}
													        				elseif ($resreg1['kls'] == 'Upacara Bendera') {?>
													        					<td>
														        				<div class="tile bg-green fg-white">
																				    <div class="tile-content iconic">
																				    	<span class="icon mif-organization"></span>
																				    	<span class="tile-label">Upacara</span>
																				    </div>
																				</div>	
																			</td>
													        				<?php 
													        					}
													        					else{
													        						$setcl = $DB_connect->prepare("SELECT * FROM reg_teach_ci 
																				                                   INNER JOIN teacher_ci ON reg_teach_ci.id_guru = teacher_ci.id_guru
																				                                   INNER JOIN class_ci ON reg_teach_ci.id_kls = class_ci.id_kls
																				                                   INNER JOIN matpel_ci ON reg_teach_ci.id_matpel = matpel_ci.id_matpel
																				                                   WHERE id_reg = '".$resreg1['kls']."'
																				                                   ");
														        					$setcl->execute();
														        					$resreg2 = $setcl->fetch(PDO::FETCH_ASSOC);
													        				?>
													        				<td>
														        				<div class="tile bg-cyan fg-white">
																				    <div class="tile-content iconic">
																				    	<span><?php echo $resreg2['nm_kls']; ?></span>
																				    	<span class="icon mif-school"></span>
																				    	<span class="tile-label"><?php echo $resreg2['nam_pel']; ?></span>
																				        <span class="tile-badge bg-darkRed">5</span>
																				    </div>
																				</div>	
																			</td>
																			<?php } }}?>
																		</tr>
																		<?php } ?>
												        		</tbody>
												        	</table>
												        		
																	