
<?php 
	$nip = $userRow['username'];
    $setcl = $DB_connect->prepare("SELECT * FROM bio_teach_ci
    							   WHERE nip = $nip");
    $setcl->execute();
    $resper = $setcl->fetch(PDO::FETCH_ASSOC); 
    $no = 1;

    $setcl2 = $DB_connect->prepare("SELECT * FROM exper_teach_ci
    							   WHERE nip = $nip ORDER BY exp_work_year_f DESC");
    $setcl2->execute();
    $resexp = $setcl2->fetchAll(PDO::FETCH_ASSOC); 

    $setcl3 = $DB_connect->prepare("SELECT * FROM edu_teach_ci
    							   WHERE nip = $nip");
    $setcl3->execute();
    $resedu = $setcl3->fetchAll(PDO::FETCH_ASSOC);
?>

<h1 class="text-light">Info</h1>
<h4 class="text-light">Silahkan pilih info yang anda ingin lihat</h4>
<hr class="thin bg-grayLighter">

<div id="loadpage">
<div class="cell auto-size bg-white" id="inpribadi">
<a href="?page=info" class="pagination no-border" id="backinpri"><h3><span class="mif-arrow-left"></span></h3></a>

<div class="accordion" data-role="accordion">
    <div class="frame">
        <div class="heading"><span class="icon mif-user"></span><h4>Info Pribadi guru</h4></div>
        <div class="content">
        	<div class="grid">
			    <div class="row padding20">
			        <div class="cell colspan4">
			        <h4>
			        	<span class="mif-user"> Nama</span>
			        	<br><br>
			        	<span class="mif-home"> Alamat</span>
			        	<br><br>
			        	<span class="mif-location-city"> Tempat Tanggal Lahir</span>
			        	<br><br>
			        	<span class="mif-male mif-female"> Jenis Kelamin</span>
			        	<br><br>
			        	<span class="mif-heart"> Agama</span>
			        	<br><br>
			        	<span class="mif-mobile"> Telp/HP</span>
			        	<br><br>
			        	<span class="mif-favorite"> Status Pernikahan</span>
			        </h4>
			        <br><br>
			        <button onclick="showDialog('#dialog')" class="button primary">Edit data anda disini</button>
			        </div>
			        <div class="cell colspan5">
			        <h4>
			        	: <?php echo $resper['nama']; ?>
			        	<br><br>
			        	: <?php echo $resper['alamat']; ?>
			        	<br><br>
			        	: <?php echo $resper['ttl']; ?>
			        	<br><br>
			        	: <?php echo $resper['jk']; ?>
			        	<br><br>
			        	: <?php echo $resper['agama']; ?>
			        	<br><br>
			        	: <?php echo $resper['telp']; ?>
			        	<br><br>
			        	: <?php echo $resper['status_k']; ?>
			        </h4>
			        </div>
			        <div class="cell colspan3">
			        <h5>
			        	<img id="img" src="<?php echo $resper['teach_photo']; ?>" alt="Gambar anda"  style="height: 200px; width:200px;">
			        	<br><br>
			        	Pilih foto anda disini
			        	<br>
			        	<form method="post" action="?page=s_poto_bio" enctype="multipart/form-data">
			        	<input type="hidden" name="nip" value="<?php echo $resper['nip']; ?>">
			        	<input type="hidden" name="nama" value="<?php echo $resper['nama']; ?>">
				        	<div class="input-control text">
							    <input type="file" style="height: 100%;" name="poto" onchange="readURL(this);" required>
							</div>
							<button class="button primary" name="upload">Upload foto</button>
						</form>
			        </h5>
			        </div>
			    </div>
			</div>
        </div>
    </div>
    <div class="frame">
        <div class="heading"><span class="icon mif-school"></span><h4>Data Pendidikan Guru</h4></div>
        <div class="content">
        	<div class="grid">
			    <div class="row padding20">
			        <div class="cell colspan6">
			        <h4>
			        	<span class="mif-user"> Pengalaman Kerja</span>
			        	<hr class="bg-grayLighter">
			        </h4>
			        	<?php 			        	
			        	foreach ($resexp as $resexp) { 
			        	?>
			        	<div class="row">
			        		<div class="cell colspan4">
			        			<?php 
			        			if ($resexp['exp_work_year_e']!='0000-00-00') {
			        				echo $resexp['exp_work_year_f']." - ".$resexp['exp_work_year_e'];

			        			}
			        			else{
			        			 	echo $resexp['exp_work_year_f']." - Present";}?>
				        	</div>
				        	<div class="cell colspan6">
				        		<strong><?php echo $resexp['exp_last_grade'] ?></strong>
				        		<br>
				        		<?php echo $resexp['exp_work_plc'] ?>
				        		<br>
				        		<?php echo $resexp['exp_out_cause'] ?>
				        	</div>
				        	<div class="cell colspan2">
				        		<a href="#" onclick="showDialog('#<?php echo $resexp['id_exp']; ?>')"><span class="mif-pencil"></span></a>
				        		<a href="#"><span class="mif-bin"></span></a>
				        	</div>
			        	</div>			
			        	<?php }?>        	
			        <br><br>
			        <button onclick="showDialog('#dialogexp')" class="button primary">Tambah pengalaman</button>
			        </div>
			        <div class="cell colspan6">
			        <h4>
			        	<span class="mif-school"> Data pendidikan</span>
			        	<hr class="thin bg-grayLighter">
			        </h4>
			        	<?php 			        	
			        	foreach ($resedu as $resedu) { 
			        	?>
			        	<div class="row">
			        		<div class="cell colspan4">
			        			<?php echo substr($resedu['edu_start'],0,4) ." - ".substr($resedu['edu_end'],0,4);?>
				        	</div>
				        	<div class="cell colspan6">
				        		<strong><?php echo $resedu['edu_plc'] ?></strong>
				        		<br>
				        		<?php echo $resedu['edu_type'] ?>
				        		<br>
				        		<strong>Major : </strong><?php echo $resedu['edu_major'] ?>
				        		<br>
				        		<strong>CGPA : </strong><?php echo $resedu['edu_cgpa'] ?>
				        	</div>
				        	<div class="cell colspan2">
				        		<a href="#"><span class="mif-pencil"></span></a>
				        		<a href="#"><span class="mif-bin"></span></a>
				        	</div>
			        	</div>
			        	<?php } ?>
			        	 <button onclick="showDialog('#dialogedu')" class="button primary">Tambah pendidikan</button>
			        <br><br>
			        </div>
			    </div>
			</div>
        </div>
    </div>
</div>

	
</div>
</div>

<!-- Dialog -->

<div id="dialog" data-role="dialog" data-type="info" data-overlay="true" data-overlay-color="op-dark" 
                                    class="Dialog padding20" data-close-button="true" data-width="300" data-height="460">
                                        <h3 class="align-center">DAFTAR GURU BARU</h3>
                                        <hr class="thin bg-grayLighter">
                                        <form method="post" id="updatebio" action="?page=s_bio" style="width: 368px;">
                                        <input type="hidden" name="nip" value="<?php echo $resper['nip']; ?>">
                                        <div class="input-control text">
										Alamat
										    <textarea name="alamat"><?php echo $resper['alamat']; ?></textarea>
										</div>
                                        <br><br><br><br><br><br>
                                            <div class="input-control text">
                                                Agama
                                                <select name="agama">
                                                	<option><?php echo $resper['agama']; ?></option>
                                                	<option disabled="true">----------------------</option>
                                                	<option>Islam</option>
                                                	<option>Katolik</option>
                                                	<option>Protestan</option>
                                                	<option>Hindu</option>
                                                	<option>Budha</option>
                                                	<option>Lain - Lain</option>
                                                </select>                                                
                                            </div>
                                        <br><br>                                               
                                            <div class="input-control text">
                                                Telp / HP
                                                <input type="number" id="nuptk" name="hp" value="<?php echo $resper['telp']; ?>">                                                
                                            </div>
                                        <br><br>
                                        <div class="input-control text">
                                                Status Pernikahan
                                                <select name="nikah">
                                                <option><?php echo $resper['status_k']; ?></option>
                                                	<option disabled="true">----------------------</option>                                                	
                                                	<option>Sudah Menikah</option>
                                                	<option>Belum Menikah</option>
                                                </select>                                                 
                                            </div>
                                        <br><br>
                                         <button name="btn-sub-bio" id="btn-sub-bio" class="button primary fixed-bottom">Proses</button>
                                        </form>
                                    </div>

<div id="dialogexp" data-role="dialog" data-type="info" data-overlay="true" data-overlay-color="op-dark" 
                                    class="Dialog padding20" data-close-button="true" data-width="300" data-height="500">
                                        <h3 class="align-center">DAFTAR PENGALAMAN</h3>
                                        <hr class="thin bg-grayLighter">
                                        <form method="post" id="updateexp" style="width: 368px;">
                                        <input type="hidden" name="nip" value="<?php echo $resper['nip']; ?>">
                                        	<div class="input-control text">
                                                Nama Instansi
                                                <input type="text" id="nuptk" name="namins">                                                
                                            </div>
                                            <br><br>
                                            <div class="input-control text" data-role="datepicker" data-format="yyyy-mm-dd">
                                                Tanggal Awal Kerja
                                                <input type="text" id="nuptk" name="tglawal">                                                
                                            </div>
                                            <br><br>
                                            <div class="input-control text" data-role="datepicker" data-format="yyyy-mm-dd">
                                                Tanggal Akhir Kerja
                                                <input type="text" id="nuptk" name="tglakhir">                                                
                                            </div>
                                            <br><br>
                                            <div class="input-control text">
                                               Posisi Terakhir
                                                <input type="text" id="nuptk" name="lpos">                                                
                                            </div>
                                            <br><br>
                                            <div class="input-control text">
                                                Alasan berhenti
                                                <input type="text" id="nuptk" name="alasan">                                                
                                            </div>
                                        <br><br>
                                        <div class="input-control text">
                                         <button name="btn-sub-exp" id="btn-sub-exp" class="button primary fixed-bottom">Proses</button>
                                        </div>
                                        </form>
                                    </div>

<div id="dialogedu" data-role="dialog" data-type="info" data-overlay="true" data-overlay-color="op-dark" 
                                    class="Dialog padding20" data-close-button="true" data-width="300" data-height="580">
                                        <h3 class="align-center">DAFTAR PENDIDIKAN</h3>
                                        <hr class="thin bg-grayLighter">
                                        <form method="post" id="saveedu" style="width: 368px;">
                                        <input type="hidden" name="nip" value="<?php echo $resper['nip']; ?>">
                                        	<div class="input-control text">
                                                Nama Instansi Pendidikan
                                                <input type="text" id="nuptk" name="namins">                                                
                                            </div>
                                            <br><br>
                                            <div class="input-control text" data-role="datepicker" data-format="yyyy-mm-dd">
                                                Tanggal Awal Pendidikan
                                                <input type="text" id="nuptk" name="tglawal">                                                
                                            </div>
                                            <br><br>
                                            <div class="input-control text" data-role="datepicker" data-format="yyyy-mm-dd">
                                                Tanggal Akhir Pendidikan
                                                <input type="text" id="nuptk" name="tglakhir">                                                
                                            </div>
                                            <br><br>
                                            <div class="input-control text">
                                               Tingkat Pendidikan
                                                <select name="grade">
                                                	<option>Silahkan Pilih salah satu</option>
                                                	<option disabled="true">-----------------------</option>
                                                	<option>SD</option>
                                                	<option>SMP</option>
                                                	<option>SMA</option>
                                                	<option>D1</option>
                                                	<option>D2</option>
                                                	<option>D3</option>
                                                	<option>S1 / D4</option>
                                                	<option>S2</option>
                                                	<option>S3</option>
                                                	<option>Kursus / Pelatihan</option>
                                                </select>                                                
                                            </div>
                                            <br><br>
                                            <div class="input-control text">
                                                Jurusan
                                                <input type="text" id="nuptk" name="jurusan">                                                
                                            </div>
                                            <br><br>
                                            <div class="input-control text">
                                                Rata - Rata Raport / IPK
                                                <input type="text" id="nuptk" name="ipk">                                                
                                            </div>
                                        <br><br>
                                        <div class="input-control text">
                                         <button name="btn-sub-edu" id="btn-sub-edu" class="button primary fixed-bottom">Proses</button>
                                        </div>
                                        </form>
                                    </div>                                   

<!-- dialog edit -->
<?php 
 $setcl4 = $DB_connect->prepare("SELECT * FROM exper_teach_ci
    							   WHERE nip = $nip");
    $setcl4->execute();
    $resexp3 = $setcl4->fetchAll(PDO::FETCH_ASSOC);
foreach ($resexp3 as $resexp3) {
?>
<div id="<?php echo $resexp3['id_exp']; ?>" data-role="dialog" data-type="info" data-overlay="true" data-overlay-color="op-dark" 
                                    class="Dialog padding20" data-close-button="true" data-width="300" data-height="500">
                                        <h3 class="align-center">EDIT PENGALAMAN</h3>
                                        <hr class="thin bg-grayLighter">
                                        <form method="post" id="updateexp" style="width: 368px;">
                                        <input type="hidden" name="nip" value="<?php echo $resper['nip']; ?>">
                                        	<div class="input-control text">
                                                Nama Instansi
                                                <input type="text" id="nuptk" name="namins" value="<?php echo $resexp3['exp_work_plc']; ?>">                                                
                                            </div>
                                            <br><br>
                                            <div class="input-control text" data-role="datepicker" data-format="yyyy-mm-dd">
                                                Tanggal Awal Kerja
                                                <input type="text" id="nuptk" name="tglawal" value="<?php echo $resexp3['exp_work_year_f'] ?>">                                                
                                            </div>
                                            <br><br>
                                            <div class="input-control text" data-role="datepicker" data-format="yyyy-mm-dd">
                                                Tanggal Akhir Kerja
                                                <input type="text" id="nuptk" name="tglakhir" value="<?php echo $resexp3['exp_work_year_e'] ?>">                                                
                                            </div>
                                            <br><br>
                                            <div class="input-control text">
                                               Posisi Terakhir
                                                <input type="text" id="nuptk" name="lpos" value="<?php echo $resexp3['exp_last_grade'] ?>">                                                
                                            </div>
                                            <br><br>
                                            <div class="input-control text">
                                                Alasan berhenti
                                                <input type="text" id="nuptk" name="alasan" value="<?php echo $resexp3['exp_out_cause']  ?>">                                                
                                            </div>
                                        <br><br>
                                        <div class="input-control text">
                                         <button name="btn-sub-exp" id="btn-sub-exp" class="button primary fixed-bottom">Proses</button>
                                        </div>
                                        </form>
                                    </div>
<?php } ?>                 