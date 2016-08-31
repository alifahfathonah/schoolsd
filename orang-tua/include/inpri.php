
<?php 
	$nis = $userRow['username'];
    $setcl = $DB_connect->prepare("SELECT * FROM studen_ci
                                   INNER JOIN bio_studen_ci ON studen_ci.id_bio_stu = bio_studen_ci.id_stu_bio
    							   WHERE studen_ci.nis = '$nis'");
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
    <div class="frame active">
        <div class="heading"><span class="icon mif-user"></span><h4>Info Pribadi anak</h4></div>
        <div class="content">
        	<div class="grid">
			    <div class="row padding20">
			        <div class="cell colspan9">
                        <table class="align-left">
                            <tr><th><h4><span class="mif-user"> Nama </span></h4></th><th> :</th><th><?php echo $resper['nam_stu']; ?></th></tr>
                            <tr><th><h4><span class="mif-home"> Alamat </span></h4></th><th> :</th><th><?php echo $resper['alamat']; ?></th></tr>
                            <tr><th><h4><span class="mif-location-city"> Tempat Lahir </span></h4></th><th> :</th><th><?php echo $resper['tmp_lahir']; ?></th></tr>
                            <tr><th><h4><span class="mif-calendar"> Tanggal Lahir </span></h4></th><th> :</th><th><?php echo $resper['tgl_lhr']; ?></th></tr>
                            <tr><th><h4><span class="mif-male mif-female"> Jenis Kelamin </span></h4></th><th> :</th><th><?php echo $resper['jk']; ?></th></tr>
                            <tr><th><h4><span class="mif-heart"> Agama </span></h4></th><th> :</th><th><?php echo $resper['agama']; ?></th></tr>
                            <tr><th><h4><span class="mif-mobile"> Telp/HP </span></h4></th><th> :</th><th><?php echo $resper['telp']; ?></th></tr>
                            <tr><th><h4><span class="mif-users"> Anak Ke- </span></h4></th><th> :</th><?php echo $resper['anak_ke']; ?></tr>
                            <tr><th><h4><span class="mif-organization"> Jumlah Saudara </span></h4></th><th> :</th><th><?php echo $resper['sdr_anak']; ?></th></tr>
                            <tr><th><h4><span class="mif-earth"> Bahasa </span></h4></th><th> :</th><th><?php echo $resper['bhs']; ?></th></tr>
                            <tr><th><h4><span class="mif-user-check"> Status Anak </span></h4></th><th> :</th><th><?php echo $resper['stat_anak']; ?></th></tr>
                            <tr><th><h4><span class="mif-home"> Tinggal Dengan </span></h4></th><th> :</th><th><?php echo $resper['stay_with']; ?></th></tr>
                            <tr><th><h4><span class="mif-map"> Jarak Ke Sekolah </span></h4></th><th> :</th><th><?php echo $resper['jrk_sklh']; ?></th></tr>
                            <tr><th><h4><span class="mif-automobile"> Transportasi </span></h4></th><th> :</th><th><?php echo $resper['transport']; ?></th></tr>
                            <tr><th><h4><span class="mif-heartbeat"> Gol Darah </span></h4></th><th> :</th></tr>
                            <tr><th><h4><span class="mif-thermometer2"> Penyakit yang diderita </span></h4></th><th> :</th><th><?php echo $resper['gol_drh']; ?></th></tr>
                            <tr><th><h4><span class="mif-list-numbered"> Tinggi </span></h4></th><th> :</th><th><?php echo $resper['tinggi']; ?></th></tr>
                            <tr><th><h4><span class="mif-meter"> Berat </span></h4></th><th> :</th><th><?php echo $resper['berat']; ?></th></tr>
                        </table>
			        <br><br>
			        <button onclick="showDialog('#dialog')" class="button primary">Edit data anda disini</button>
			        </div>
			        
			        <div class="cell colspan3">
			        <h5>
			        	<img id="img" src="<?php echo $resper['stu_photo']; ?>" alt="Gambar anda"  style="height: 200px; width:200px;">
			        	<br><br>
			        	Pilih foto anda disini
			        	<br>
			        	<form method="post" action="?page=s_poto_bio_stu" enctype="multipart/form-data">
			        	<input type="hidden" name="id" value="<?php echo $resper['id_stu_bio']; ?>">
                        <input type="hidden" name="nis" value="<?php echo $resper['nis']; ?>">
			        	<input type="hidden" name="nama" value="<?php echo $resper['nam_stu']; ?>">
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
    
	
</div>
</div>

<!-- Dialog -->

<div id="dialog" data-role="dialog" data-type="info" data-overlay="true" data-overlay-color="op-dark" 
                                    class="Dialog padding20" data-close-button="true" data-width="700" data-height="560">
                                        <h3 class="align-center">DAFTAR BIODATA ANAK</h3>
                                        <hr class="thin bg-grayLighter">
                                        <form method="post" action="?page=s_bio_stu" style="width: 368px;">
                                        <input type="hidden" name="id" value="<?php echo $resper['id_stu_bio']; ?>">
                                        <div class="row">
                                            <div class="cell colspan3">
                                                <div class="input-control text">
        										Alamat
        										    <textarea name="alamat"><?php echo $resper['alamat']; ?></textarea>
        										</div>
                                                <br><br><br><br><br><br>
                                                <div class="input-control text">
                                                        Tempat Lahir
                                                        <input type="text" id="nuptk" name="templhr" value="<?php echo $resper['tmp_lahir']; ?>">                                               
                                                    </div>
                                                <br><br>
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
                                                        <input type="number" id="nuptk" name="telp" value="<?php echo $resper['telp']; ?>">                                                
                                                    </div>
                                                <br><br>
                                            </div>

                                            <div class="cell colspan1">
                                            </div>
                                            <div class="cell colspan3">
                                                <div class="input-control text">
                                                Anak Ke-
                                                    <input type="number" id="nuptk" name="anakke" value="<?php echo $resper['anak_ke']; ?>">  
                                                </div>
                                                <br><br>
                                                <div class="input-control text">
                                                Jumlah Saudara
                                                    <input type="number" id="nuptk" name="jumsau" value="<?php echo $resper['sdr_anak']; ?>">  
                                                </div>
                                                <br><br>
                                                    <div class="input-control text">
                                                        Status Anak
                                                        <input type="text" id="nuptk" name="statanak" value="<?php echo $resper['stat_anak']; ?>">                                               
                                                    </div>
                                                <br><br>                                               
                                                    <div class="input-control text">
                                                        Bahasa
                                                        <input type="text" id="nuptk" name="bahasa" value="<?php echo $resper['bhs']; ?>">                                                
                                                    </div>
                                                <br><br>
                                                <div class="input-control text">
                                                        Tinggal Dengan
                                                        <input type="text" id="nuptk" name="tgldg" value="<?php echo $resper['stay_with']; ?>">
                                                    </div>
                                                <br><br>
                                                <div class="input-control text">
                                                        Kewarganegaraan
                                                        <input type="text" id="nuptk" name="kwrg" value="<?php echo $resper['kwrga']; ?>">
                                                    </div>
                                                <br><br>
                                                
                                            </div>
                                            <div class="cell colspan1">
                                            </div>
                                            <div class="cell colspan3">
                                                <div class="input-control text">
                                                Jarak Kesekolah
                                                    <input type="number" id="nuptk" name="jarak" value="<?php echo $resper['jrk_sklh']; ?>">  
                                                </div>
                                                <br><br>
                                                <div class="input-control text">
                                                Transportasi
                                                    <input type="text" id="nuptk" name="trans" value="<?php echo $resper['transport']; ?>">  
                                                </div>
                                                <br><br>
                                                    <div class="input-control text">
                                                        Gol Darah
                                                        <input type="text" id="nuptk" name="goldrh" value="<?php echo $resper['gol_drh']; ?>">                                              
                                                    </div>
                                                <br><br>                                               
                                                    <div class="input-control text">
                                                        Penyakit yg diderita
                                                        <input type="text" id="nuptk" name="disease" value="<?php echo $resper['disease']; ?>">                                                
                                                    </div>
                                                <br><br>
                                                <div class="input-control text">
                                                        Tinggi
                                                        <input type="number" id="nuptk" name="tinggi" value="<?php echo $resper['tinggi']; ?>">                                                 
                                                    </div>
                                                <br><br>
                                                <div class="input-control text">
                                                        Berat
                                                        <input type="number" id="nuptk" name="berat" value="<?php echo $resper['berat']; ?>">                                                 
                                                    </div>
                                                <br><br>
                                                
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="cell colspan12">
                                            <hr class="thin bg-grayLighter">
                                                <div class="input-control text">
                                                    <button name="btn-sub-bio" class="button primary fixed-bottom">Proses</button>
                                                </div>
                                            </div>
                                        </div>
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

