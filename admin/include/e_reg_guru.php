<div class="page-content" >
        <div class="flex-grid no-responsive-future" style="height: 100%;">
            <div class="row" style="height: 100%">
                <div class="flex-grid no-responsive-future" style="height: 100%;">
		            <div class="row">
                        <div class="cell auto-size bg-white padding40" id="cell-content">
                        
                            <h1 class="align-center">Edit Daftar Pelajaran</h1>
                            <h5 class="align-center">Anda bisa edit data yang sudah ada</h5>
                                <hr class="thick bg-grayLighter">
                            <div id="tes" style="overflow:true;">
                                <?php 
                                if (!isset($_POST['checkdel'])) {
                                    echo "<script>alert('Anda belum memilih satupun guru');window.location = '?page=reg_guru';</script>"; 
                                }
                                    $hitungcek = count($_POST['checkdel']);
                                    for ($i=0; $i < $hitungcek ; $i++) { 
                                        $getcheck = $_POST['checkdel'][$i];

                                        $setcl = $DB_connect->prepare("SELECT * FROM reg_teach_ci 
                                                                       INNER JOIN teacher_ci ON reg_teach_ci.id_guru = teacher_ci.id_guru
                                                                       INNER JOIN class_ci ON reg_teach_ci.id_kls = class_ci.id_kls
                                                                       INNER JOIN matpel_ci ON reg_teach_ci.id_matpel = matpel_ci.id_matpel 
                                                                       WHERE id_reg = '$getcheck'");
                                        $setcl->execute();
                                        $resclass = $setcl->fetch(PDO::FETCH_ASSOC);

                                        $setcl2 = $DB_connect->prepare("SELECT * FROM class_ci");
                                        $setcl2->execute();
                                        $resclassall = $setcl2->fetchAll(PDO::FETCH_ASSOC);

                                        $setcl3 = $DB_connect->prepare("SELECT * FROM matpel_ci");
                                        $setcl3->execute();
                                        $resmatpelall = $setcl3->fetchAll(PDO::FETCH_ASSOC);

                                ?>
                                <div class="panel">
                                    <div class="heading">
                                        <span class="title"><?php echo $resclass['nama']; ?></span>
                                    </div>
                                    <div class="content padding20">
                                        <form method="post" id="editregguru" action="?page=se_reg_guru">
                                        <input value="<?php echo $getcheck; ?>" name="id[]" hidden="true" />
                                            <div class="input-control select">
                                                Pilih Kelas
                                                <select placeholder="Pilih" name="gradekls[]">
                                                    <option selected="selected" value="<?php echo $resclass['id_kls']; ?>"><?php echo $resclass['nm_kls']; ?></option>
                                                    <option disabled="true">----------------------</option> 
                                                <?php foreach ($resclassall as $resclassall) {?>                    
                                                    <option value="<?php echo $resclassall['id_kls']; ?>"><?php echo $resclassall['nm_kls']; ?></option>
                                                <?php } ?>
                                                </select>
                                            </div>
                                            <br><br>
                                            <div class="input-control text">
                                                Pilih Mata Pelajaran
                                                <select placeholder="Pilih" name="matpel[]">
                                                    <option selected="selected" value="<?php echo $resclass['id_matpel']; ?>"><?php echo $resclass['nam_pel']; ?></option>
                                                    <option disabled="true">----------------------</option> 
                                                <?php foreach ($resmatpelall as $resmatpelall) {?>                    
                                                    <option value="<?php echo $resmatpelall['id_matpel']; ?>"><?php echo $resmatpelall['nam_pel']; ?></option>
                                                <?php } ?>
                                                </select>
                                            </div>
                                           
                                            <br><br>
                                           
                                    </div>
                                </div>
                                
                                <?php 
                                }
                                ?>
                                <br>
                                    <button name="btn-sub-ereguru" id="btn-sub-ereguru" class="button primary">Proses</button>
                                    <a class="button warning" href="?page=reg_guru">Batal</a>
                                </form>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</div>

