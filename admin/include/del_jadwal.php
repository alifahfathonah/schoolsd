 <div id="loadpage">
<div class="page-content"  style="overflow:auto">
        <div class="flex-grid no-responsive-future" style="height: 100%;">
            <div class="row" style="height: 100%">
                <div class="flex-grid no-responsive-future" style="height: 100%;">
		            <div class="row" style="height: 100%">
		                <div class="cell auto-size bg-white padding40" id="cell-content">
                        <div id="tes">
                            <h1 class="align-center">Hapus Jadwal</h1>
                            <h5 class="align-center">Anda bisa hapus jadwal pelajaran di sekolah</h5>
                                <hr class="thin bg-grayLighter">

                                 <?php 
												    	$setcl = $DB_connect->prepare("SELECT 
												    								  (SELECT group_concat(DISTINCT jad_start) FROM schedule_teach_ci WHERE tipe_jadwal = 1) as a,
																					  (SELECT group_concat(DISTINCT jad_end) FROM schedule_teach_ci WHERE tipe_jadwal = 1) as b
																				       ");
														$setcl->execute();
														$resreg3 = $setcl->fetchAll(PDO::FETCH_ASSOC);
												     ?>
												   	 <form method="post" action="?page=l_jam_matpel"> 
                                        
						                                            <div class="input-control text">
						                                                Pilih Durasi Jadwal
						                                                <select name="dur">
							                                                <?php foreach ($resreg3 as $resreg3) {?>
							                                                	<option value="<?php echo $resreg3['a'].",".$resreg3['b']; ?>"><?php echo date("M Y", strtotime($resreg3['a']))." - ".date("M Y", strtotime($resreg3['b'])); ?></option>
							                                                <?php } ?>
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
						                                         <button name="btn-sub-nampel" class="button danger fixed-bottom">Hapus</button>
						                                         
						                                        </form>