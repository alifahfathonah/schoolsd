<?php 
            $setcl3 = $DB_connect->prepare("SELECT * FROM news_ci");
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
                            <h1 class="align-center">Tambah Berita Baru</h1>
                            <h5 class="align-center">Anda bisa menambahkan berita terbaru untuk di update di web</h5>
                                <hr class="thin bg-grayLighter">
                                    <div>
                                    <a href="#" class="button primary" onclick="showDialog('#dialogpoto')"><span class="mif-plus"></span> Tambah Berita Baru</button></a>
                                        <form method="post" id="delmatpel">
                                            <div class="panel">
                                                <div class="heading">
                                                    <span class="icon mif-file-image"></span>
                                                    <span class="title">List Berita</span>
                                                </div>
                                                <div class="content padding20" >
                                                    <?php foreach ($respto as $respto) {
                                                        $string = strip_tags($respto['content_news']);
                                                        if (strlen($string) > 100) {

                                                            // truncate string
                                                            $stringCut = substr($string, 0, 500);

                                                            // make sure it ends in a word so assassinate doesn't become ass...
                                                            $string2 = substr($stringCut, 0, strrpos($stringCut, ' ')).'... <a href="/this/story">Read More</a>'; 
                                                        }
                                                    ?>
                                                        <div class="image-container image-format-hd">
                                                            <img id="image" src="<?php echo $respto['photo']; ?>" alt="Gambar anda" style="height: 200px; width:200px;">
                                                            <span><?php echo $string2; ?></span>
                                                        </div>
                                                        <br><br><br><br>
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
                                    class="Dialog padding10" data-close-button="true" data-width="700" data-height="550">
                                        <h3 class="align-center">BUAT BERITA BARU</h3>
                                        <hr class="thin bg-grayLighter">
                                        <div class="grid">
                                        <form method="post" action="?page=s_berita" enctype="multipart/form-data">
                                                    
                                            <div class="row padding20">
                                                <div class="cell colspan4">
                                                    Foto
                                                    <br>
                                                    <img id="img" src="../style/images/defaultprofile.png" alt="Gambar anda"  style="height: 200px; width:200px;">
                                                    <br><br>
                                                    Pilih foto Berita disini
                                                    <br>
                                                            <input name="date" value="<?php date_default_timezone_set("Asia/Jakarta"); echo date("Y-m-d h:i:sa"); ?>" hidden>
                                                            <input name="author" value="<?php print($userRow['fullname']); ?>" hidden>
                                                        <div class="input-control text">
                                                            <input type="file" style="height: 100%;" name="poto" onchange="readURL(this);" required>
                                                        </div>
                                                        <div class="input-control text">
                                                            Judul Berita
                                                            <input type="text" id="judul" name="judul" required>                                                
                                                        </div>
                                                        <br><br>
                                                        <button class="button primary" name="upload">Simpan Berita</button>
                                                    </div>
                                                    <div class="cell colspan8">
                                                            Isi Berita
                                                            <br><br>
                                                            <textarea name="isi" class="editor"></textarea>
                                                            
                                                    </div>
                                                </div>
                                            </div>
                                        
                                        </form>
                                    </div>