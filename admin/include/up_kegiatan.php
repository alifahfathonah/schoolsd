<?php 
             $setcl3 = $DB_connect->prepare("SELECT * FROM konten_web_act_photo");
            $setcl3->execute();
            $respto = $setcl3->fetchAll(PDO::FETCH_ASSOC);
         ?>
<div id="loadpage">
<div class="page-content" >
        <div class="flex-grid no-responsive-future" style="height: 100%;overflow:auto;">
            <div class="row" style="height: 100%">
                <div class="flex-grid no-responsive-future" style="height: 100%;">
		            <div class="row" style="height: 100%">
		                <div class="cell auto-size bg-white padding20" id="cell-content">
                        <div id="tes">
                            <h1 class="align-center">Upload Foto Kegiatan</h1>
                            <h5 class="align-center">Anda bisa menambahkan dokumentasi kegiatan sekolah yang sudah dilakukan</h5>
                                <hr class="thin bg-grayLighter">
                                    <div>
                                    <a href="#" class="button primary" onclick="showDialog('#dialogpoto')"><span class="mif-plus"></span> Tambah Koleksi Foto</button></a>
                                        <form method="post" id="delmatpel">
                                            <div class="panel">
                                                <div class="heading">
                                                    <span class="icon mif-file-image"></span>
                                                    <span class="title">Koleksi Foto</span>
                                                </div>
                                                <div class="content padding20" >
                                                    <?php foreach ($respto as $respto) {?>
                                                        <div class="image-container bordered handing ani image-format-hd">
                                                            <img id="image" src="<?php echo $respto['poto']; ?>" alt="Gambar anda" style="height: 200px; width:200px;">
                                                        </div>
                                                    <?php } ?>
                                                </div>
                                            </div>
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

<div id="dialogpoto" data-role="dialog" data-type="info" data-overlay="true" data-overlay-color="op-dark" 
                                    class="Dialog padding20" data-close-button="true" data-width="500" data-height="550">
                                        <h3 class="align-center">DAFTAR MATA PELAJARAN</h3>
                                        <hr class="thin bg-grayLighter">
                                        <div class="grid">
                                        <form method="post" action="?page=s_poto_keg" enctype="multipart/form-data">
                                                    
                                            <div class="row padding20">
                                                <div class="cell colspan6">
                                                    Foto
                                                    <br>
                                                    <img id="img" src="../style/images/defaultprofile.png" alt="Gambar anda"  style="height: 200px; width:200px;">
                                                    <br><br>
                                                    Pilih foto anda disini
                                                    <br>
                                                    
                                                        <div class="input-control text">
                                                            <input type="file" style="height: 100%;" name="poto" onchange="readURL(this);" required>
                                                        </div>
                                                        <div class="input-control text">
                                                            Nama Foto
                                                            <input type="text" id="nampo" name="nampo" required>                                                
                                                        </div>
                                                        <br><br>
                                                        <button class="button primary" name="upload">Upload foto</button>
                                                    </div>
                                                    <div class="cell colspan6">
                                                        <div class="input-control text" data-role="input">
                                                            Keterangan
                                                            <br><br>
                                                            <textarea name="ket"></textarea>
                                                        </div>                                                        
                                                        
                                                    </div>
                                                </div>
                                            </div>
                                        
                                        </form>
                                    </div>