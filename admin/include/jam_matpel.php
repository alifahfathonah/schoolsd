
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

$rows6 = $DB_connect->query("SELECT count(nm_kls) FROM class_ci WHERE grade_kls = 'Kelas VI'")->fetchColumn();

$setcl = $DB_connect->prepare("SELECT DISTINCT grade_kls FROM class_ci ORDER BY grade_kls");
$setcl->execute();
$grade = $setcl->fetchAll(PDO::FETCH_ASSOC);

$setcl = $DB_connect->prepare("SELECT DISTINCT grade_kls FROM class_ci ORDER BY grade_kls");
$setcl->execute();
$grade2 = $setcl->fetchAll(PDO::FETCH_ASSOC); 
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

                                    <input type="text" name="day" value="<?php echo date('N', strtotime(date('l'))); ?>" hidden/>
	                                    <a href="#" class="button primary" onclick="showDialog('#dialogjadwal')"><span class="mif-plus"></span> Tambah Baru</button></a>
	                                    <a href="?page=del_jadwal" class="button danger"><span class="mif-minus"></span> Hapus Data</a>
                                    <!-- Tile with image container -->
                                    
                                    <div class="grid">
                                    	<div class="row">
								            <div class="cell colspan12">
												<div class="accordion" data-role="accordion">
												    <div class="frame" style="overflow:auto">
												        <div class="heading"><h3>Jadwal Guru Hari Ini<span class="mif-calendar icon"></span></h3></div>
												        <div class="content" style="overflow:auto">
												        <?php 
												        	$setcl = $DB_connect->query("SELECT DISTINCT jad_start,jad_end FROM schedule_teach_ci WHERE tipe_jadwal = 1");
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
																$day = $qday['jad_day'];

												         ?>
												        	<table id="tab-class" data-role="datatable">
												        		<thead>
								                            		<tr>
								                            			<th rowspan="2">Jam</th>
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
												        		
												        		<?php 
												        			$nowday = date('N', strtotime(date('l')));
												        			$setcl = $DB_connect->prepare("SELECT DISTINCT jam FROM schedule_teach_ci 
												        				 						   INNER JOIN class_ci ON schedule_teach_ci.id_kls = class_ci.id_kls
												        										   WHERE jad_day = '$nowday'
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
																		                                   AND jad_day = '$nowday'
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
																				    	<span class="tile-label"><?php echo $resreg2['nama']; ?></span>
																				        <span class="tile-badge bg-darkRed">5</span>
																				    </div>
																				</div>	
																			</td>
																			<?php } }}?>
																		</tr>
																		<?php } ?>
												        		</tbody>
												        	</table>
												        		
																	
												        	
												        </div>
												    </div>


												    <?php 
												    	$setcl = $DB_connect->prepare("SELECT 
												    								  (SELECT group_concat(DISTINCT jad_start) FROM schedule_teach_ci WHERE tipe_jadwal = 1) as a,
																					  (SELECT group_concat(DISTINCT jad_end) FROM schedule_teach_ci WHERE tipe_jadwal = 1) as b
																				       ");
														$setcl->execute();
														$resreg3 = $setcl->fetchAll(PDO::FETCH_ASSOC);

														$setcl = $DB_connect->prepare("SELECT 
												    								  (SELECT group_concat(DISTINCT jad_start) FROM schedule_teach_ci WHERE tipe_jadwal = 1) as a,
																					  (SELECT group_concat(DISTINCT jad_end) FROM schedule_teach_ci WHERE tipe_jadwal = 1) as b
																				       ");
														$setcl->execute();
														$resreg4 = $setcl->fetchAll(PDO::FETCH_ASSOC);

														$setcl = $DB_connect->prepare("SELECT 
												    								  (SELECT group_concat(DISTINCT jad_start) FROM schedule_teach_ci WHERE tipe_jadwal = 1) as a,
																					  (SELECT group_concat(DISTINCT jad_end) FROM schedule_teach_ci WHERE tipe_jadwal = 1) as b
																				       ");
														$setcl->execute();
														$resreg7 = $setcl->fetchAll(PDO::FETCH_ASSOC);

														$setcl = $DB_connect->prepare("SELECT * FROM class_ci ORDER BY grade_kls");
														$setcl->execute();
														$resreg5 = $setcl->fetchAll(PDO::FETCH_ASSOC);

														$setcl = $DB_connect->prepare("SELECT * FROM class_ci ORDER BY grade_kls");
														$setcl->execute();
														$resreg6 = $setcl->fetchAll(PDO::FETCH_ASSOC);
												     ?>

												    <div class="frame" style="overflow:auto">
												        <div class="heading"><h3>Setting Jadwal Kegiatan<span class="mif-calendar icon"></span></h3></div>
												        	<div class="content" style="overflow:auto">
												        	<form method="post" action="?page=s_event_jad">
												        		<div class="input-control text">
						                                                Pilih Durasi Jadwal
						                                                <select name="dur" required>
							                                                <?php foreach ($resreg3 as $resreg3) {
							                                                	if (empty($resreg3['a'] && $resreg3['b'])) {
							                                                ?>
							                                                	<option value="">Anda belum buat data</option>
							                                                	
							                                                <?php } else { ?>
							                                                	<option value="<?php echo $resreg3['a'].",".$resreg3['b']; ?>"><?php echo date("M Y", strtotime($resreg3['a']))." - ".date("M Y", strtotime($resreg3['b'])); ?></option>
							                                                <?php } }?>
						                                                </select>                                                
						                                        </div>
						                                        <br><br>
						                                        <div class="input-control text">
						                                                Pilih Partisipan Kelas
						                                                <select name="partisipan">
						                                                	<option value='
						                                                	<?php 
						                                                		foreach ($resreg6 as $resreg6) {
						                                                			echo $resreg6["id_kls"].",";
						                                                		} 
						                                                	?>'>
						                                                		Semua Kelas
						                                                	</option>
						                                                <?php foreach ($resreg5 as $resreg5) { ?>
							                                                <option value="<?php echo $resreg5['id_kls']; ?>"><?php echo $resreg5['grade_kls']." - ".$resreg5['nm_kls']; ?></option>
							                                            <?php } ?>
						                                                </select>                                                
						                                        </div>
						                                        <br><br>
						                                        <div class="input-control text">
						                                                Pilih Tipe Jadwal
						                                                <select name="tipe">
							                                                <option value="2">Hari Libur</option>
							                                                <option value="3">Event Sekolah</option>
							                                                <option value="4">Ujian</option>
							                                                <option value="5">Pembagian Raport</option>
						                                                </select>                                                
						                                        </div>
						                                        <br><br><br>
						                                        <div class="input-control text" id="fdate" data-role="datepicker" data-format="yyyy-mm-dd">
					                                                <label for="day">Tanggal Awal</label>
					                                               	<input type="text" name="tglf">                                          
				                                            	</div>
				                                            	<br><br>
				                                            	<div class="input-control text" id="ldate" data-role="datepicker" data-format="yyyy-mm-dd">
					                                                <label for="day">Tanggal Akhir</label>
					                                               	<input type="text" name="tgle">                               
				                                            	</div>
				                                            	<br><br>
						                                        <div class="input-control text">
						                                                Keterangan
						                                                <textarea name="ket"></textarea>                                                
						                                        </div>
						                                        <br><br><br><br><br><br><br><br>
						                                         <button name="sub" class="button primary fixed-bottom">Proses</button>
												        		</form>
												        	</div>
												        </div>
							
												    <div class="frame" style="overflow:auto">
												        <div class="heading"><h3>Lihat Jadwal Guru Hari Lain<span class="mif-calendar icon"></span></h3></div>
												        	<div class="content" style="overflow:auto">
												        		 <form method="post" action="?page=l_jam_matpel"> 
                                        
						                                            <div class="input-control text">
						                                                Pilih Durasi Jadwal
						                                                <select name="dur" required>
							                                                <?php foreach ($resreg7 as $resreg7) {
							                                                	if (empty($resreg7['a'] && $resreg7['b'])) {
							                                                ?>
							                                                	<option value="">Anda belum buat data</option>
							                                                	
							                                                <?php } else { ?>
							                                                	<option value="<?php echo $resreg3['a'].",".$resreg3['b']; ?>"><?php echo date("M Y", strtotime($resreg3['a']))." - ".date("M Y", strtotime($resreg3['b'])); ?></option>
							                                                <?php } }?>
						                                                </select>                                                
						                                            </div>
						                                            <br><br>
						                             <?php 
						                             	$setcl = $DB_connect->prepare("SELECT DISTINCT jad_day FROM schedule_teach_ci
																				       ");
														$setcl->execute();
														$resreg4 = $setcl->fetchAll(PDO::FETCH_ASSOC);
						                              ?>
						                                               
							                                                <?php foreach ($resreg4 as $resreg4) {
							                                                	if ($resreg4['jad_day'] == 1) {
							                                                		$hari = 'Senin';
							                                                	}
							                                                	elseif ($resreg4['jad_day'] == 2) {
							                                                		$hari = 'Selasa';
							                                                	}
							                                                	elseif ($resreg4['jad_day'] == 3) {
							                                                		$hari = 'Rabu';
							                                                	}
							                                                	elseif ($resreg4['jad_day'] == 4) {
							                                                		$hari = 'Kamis';
							                                                	}
							                                                	elseif ($resreg4['jad_day'] == 5) {
							                                                		$hari = 'Jumat';
							                                                	}
							                                                	elseif ($resreg4['jad_day'] == 6) {
							                                                		$hari = 'Sabtu';
							                                                	}
							                                                	else {
							                                                		$hari = 'Minggu';
							                                                	}
							                                                ?>
							                                                <label class="input-control radio">
																			    <input type="radio" name="day" value="<?php echo $resreg4['jad_day']; ?>">
																			    <span class="check"></span>
																			    <span class="caption"><?php echo $hari; ?></span>
																			</label>
							                                                <?php } ?>
						                                                </select>                                                
						                           
						                                        <br><br>
						                                         <button name="btn-sub-nampel" class="button primary fixed-bottom">Proses</button>
						                                         
						                                        </form>
												    		</div>
												    </div>
												</div>
											</div>
								            </div>						            
							            </div>
							        </div>

                        </div>
		                </div>
		            </div>
		        </div>
        </div>
        </div>
        </div>
        </div>


<div id="dialogjadwal" data-role="dialog" data-type="info" data-overlay="true" data-overlay-color="op-darker" 
                                    class="Dialog padding20" data-close-button="true" data-width="300" data-height="550">
                                        <h3 class="align-center">DAFTAR JADWAL</h3>
                                        <hr class="bg-grayLighter">
                                        <form method="post" action="?page=in_jam_matpel">
                                        <div class="grid">
	                                    	<div class="row">
	                                    		<div class="cell colspan12 padding10"> 
			                                                <div class="input-control text" id="fdate" data-role="datepicker" data-format="yyyy-mm-dd">
				                                                <label for="day">Tanggal Awal</label>
				                                               	<input type="text" name="tglf">                                          
			                                            	</div>
			                                            	<br><br>
			                                            	<div class="input-control text" id="ldate" data-role="datepicker" data-format="yyyy-mm-dd">
				                                                <label for="day">Tanggal Akhir</label>
				                                               	<input type="text" name="tgle">                               
			                                            	</div>
			                                            	<br><br>
			                                            	<div class="input-control select">
				                                                <label for="day">Pilih Hari</label>
				                                               	<select name="day">
				                                               		<option value="1">Senin</option>
				                                               		<option value="2">Selasa</option>
				                                               		<option value="3">Rabu</option>
				                                               		<option value="4">Kamis</option>
				                                               		<option value="5">Jumat</option>
				                                               		<option value="6">Sabtu</option>
				                                               		<option value="7">Minggu</option>
				                                               	</select>                               
			                                            	</div>
			                                            	<br><br>
			                                            	<div class="input-control text" id="fdate">
				                                                <label for="day">Interval</label>
				                                               	<input type="number" name="int" placeholder="Dalam Menit" >                                          
			                                            	</div>
			                                            	<br><br>
			                                            	<div class="input-control text" id="fdate">
				                                                <label for="day">Jam Masuk Sekolah</label>
				                                               	<input type="time" name="jamfirst">                                          
			                                            	</div>			                                            	
			                                            	<br><br>
			                                            	<div class="input-control text" id="fdate">
				                                                <label for="day">Jam Pulang Sekolah</label>
				                                               	<input type="time" name="jamend">  
				                                            <br><br> 
				                                               	<div class="input-control">
		                                        					<button name="btn-sub-jad" id="btn-sub-jad" class="button primary fixed-bottom">Proses</button>
		                                        				</div>                                         
			                                            	</div>
			                                            	
			                                            	                                  
		                                            </div>
		                                        </div>
		                                    </div>	                                       
                                        </form>
                                    </div>