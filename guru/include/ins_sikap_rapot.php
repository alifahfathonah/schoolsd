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

<h1 class="text-light">Nilai Sikap</h1>
<h4 class="text-light">Ini adalah rapot <?php echo $resper2['nam_stu']; ?> Silah kan tambahkan penilaian sikap</h4>
<hr class="thin bg-grayLighter">
									<div class="grid">
                                        		<div class="row">
                                        			<div class="cell colspan4">
                                        				<button class="add_field_button button primary"><span class="mif-plus"></span>Tambah aspek</button>
                                        			</div>
                                        		</div>
                                        </div>
										<form method="post" action="?page=s_sikap" style="width: 368px;">
                                        <input type="hidden" name="nis" value="<?php echo $id; ?>">
                                        <div class="input_fields_wrap">
                                        </div>
                                        	<div class="grid">
                                        		<div class="row">
                                        			<div class="cell colspan4">
                                        				<div class="input-control text">
                                                			Aspek
			                                                <input type="text" id="aspek" name="aspek[]">                                                
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
                                        				<div class="input-control text">
			                                                Deskripsi
			                                                <textarea name="ket[]"></textarea>                                                
			                                            </div>
                                        			</div>
                                        		</div>
                                        	</div>
                                        	<br><br><br><br><br><br><br><br>
                                        	<button class="button primary">Simpan</button>
                                        </form>
                                        </div>