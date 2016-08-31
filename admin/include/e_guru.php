<div class="page-content" >
        <div class="flex-grid no-responsive-future" style="height: 100%;">
            <div class="row" style="height: 100%">
                <div class="flex-grid no-responsive-future" style="height: 100%;">
		            <div class="row">
                        <div class="cell auto-size bg-white padding40" id="cell-content">
                        
                            <h1 class="align-center">Edit Guru</h1>
                            <h5 class="align-center">Anda bisa edit data yang sudah ada</h5>
                                <hr class="thick bg-grayLighter">
                            <div id="tes" style="overflow:true;">
                                <?php 
                                if (!isset($_POST['checkdel'])) {
                                    echo "<script>alert('Anda belum memilih satupun guru');window.location = '?page=guru';</script>"; 
                                }
                                    $hitungcek = count($_POST['checkdel']);
                                    for ($i=0; $i < $hitungcek ; $i++) { 
                                        $getcheck = $_POST['checkdel'][$i];

                                        $setcl = $DB_connect->prepare("SELECT * FROM teacher_ci 
                                                                       WHERE nip = '$getcheck'");
                                        $setcl->execute();
                                        $resteach = $setcl->fetch(PDO::FETCH_ASSOC);

                                ?>
                                <div class="panel">
                                    <div class="heading">
                                        <span class="title"><?php echo $resteach['nama']; ?></span>
                                    </div>
                                    <div class="content padding20">
                                        <form method="post" id="addeteach" action="?page=se_teach">
                                        <input value="<?php echo $getcheck; ?>" name="id[]" hidden="true" />
                                         <input type="hidden" name="img[]" value="<?php echo $resteach['teach_photo']; ?>">
                                            <div class="input-control text">
                                                Nama Guru
                                                <input type="text" id="nmguru" name="nmguru[]" value="<?php echo $resteach['nama']; ?>" required>                                                
                                            </div>
                                        <br><br>
                                            <div class="input-control text" data-role="datepicker" data-format="yyyy-mm-dd">
                                                Tahun Tanggal Lahir
                                                <input type="text" name="ttl[]" value="<?php echo $resteach['ttl']; ?>" required>                                                
                                            </div>
                                        <br><br>                                               
                                            <div class="input-control text">
                                                NUPTK / PEG ID
                                                <input type="text" id="nuptk" name="nuptk[]" value="<?php echo $resteach['nuptk']; ?>">                                                
                                            </div>
                                        <br><br>
                                            <div class="input-control text">
                                                NIK
                                                <input type="text" id="nip" name="nip[]" value="<?php echo $resteach['nip']; ?>" required> 
                                            </div>                                               
                                        <br><br>
                                            <div class="input-control text">
                                                Jenis Kelamin
                                                <select name="jkel[]">
                                                    <option selected="selected"><?php echo $resteach['jk']; ?></option>
                                                    <option disabled="true">----------------------</option>
                                                    <option>L</option>
                                                    <option>P</option>
                                                </select>                                               
                                            </div>
                                        
                                    </div>
                                </div>
                                
                                <?php 
                                }
                                ?>
                                <br>
                                    <button name="btn-sub-eteach" id="btn-sub-eteach" class="button primary">Proses</button>
                                    <a class="button warning" href="?page=guru">Batal</a>
                                </form>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</div>
