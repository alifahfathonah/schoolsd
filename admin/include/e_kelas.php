<div class="page-content" >
        <div class="flex-grid no-responsive-future" style="height: 100%;">
            <div class="row" style="height: 100%">
                <div class="flex-grid no-responsive-future" style="height: 100%;">
		            <div class="row">
                        <div class="cell auto-size bg-white padding40" id="cell-content">
                        
                            <h1 class="align-center">Edit Kelas</h1>
                            <h5 class="align-center">Anda bisa edit data yang sudah ada</h5>
                                <hr class="thick bg-grayLighter">
                            <div id="tes" style="overflow:true;">
                                <?php 
                                if (!isset($_POST['checkdel'])) {
                                    echo "<script>alert('Anda belum memilih satupun kelas');window.location = '?page=kelas';</script>"; 
                                }
                                    $hitungcek = count($_POST['checkdel']);
                                    for ($i=0; $i < $hitungcek ; $i++) { 
                                        $getcheck = $_POST['checkdel'][$i];

                                        $setcl = $DB_connect->prepare("SELECT class_ci.id_kls,class_ci.nm_kls,class_ci.kd_kls,class_ci.grade_kls,class_ci.cap_class,teacher_ci.nama,class_ci.id_guru
                                                                       FROM class_ci INNER JOIN
                                                                       teacher_ci ON class_ci.id_guru = teacher_ci.id_guru 
                                                                       WHERE id_kls = '$getcheck'");
                                        $setcl->execute();
                                        $resclass = $setcl->fetch(PDO::FETCH_ASSOC);

                                        $setcl = $DB_connect->prepare("SELECT * FROM teacher_ci");
                                        $setcl->execute();
                                        $resteach = $setcl->fetchall(PDO::FETCH_ASSOC);

                                ?>
                                <div class="panel">
                                    <div class="heading">
                                        <span class="title"><?php echo $resclass['nm_kls']; ?></span>
                                    </div>
                                    <div class="content padding20">
                                        <form method="post" id="addeclass" action="?page=se_kelas">
                                        <input value="<?php echo $getcheck; ?>" name="id[]" hidden="true" />
                                            <div class="input-control select">
                                            Silahkan Pilih Grade kelas
                                                <select placeholder="Pilih" name="gradekls[]">
                                                    <option selected="selected" value="<?php echo $resclass['grade_kls']; ?>"><?php echo $resclass['grade_kls']; ?></option>
                                                    <option disabled="true">----------------------</option>                     
                                                    <option value="Kelas I">Kelas I</option>
                                                    <option value="Kelas II">Kelas II</option>
                                                    <option value="Kelas III">Kelas III</option>
                                                    <option value="Kelas IV">Kelas IV</option>
                                                    <option value="Kelas V">Kelas V</option>
                                                    <option value="Kelas VI">Kelas VI</option>
                                                </select>
                                            </div>
                                            <br><br>
                                            <div class="input-control text">
                                                Nama Kelas
                                                <input type="text" id="nmkls" name="nmkls[]" value="<?php echo $resclass['nm_kls']; ?>">
                                            </div>
                                            <br><br>
                                            <div class="input-control text">
                                                Kode Kelas
                                                <input type="text" id="kode" name="kode[]" value="<?php echo $resclass['kd_kls']; ?>">
                                            </div>
                                            <br><br>
                                            <div class="input-control text">
                                                Kapasitas Kelas
                                                <input type="text" id="kapkls" name="kapkls[]" value="<?php echo $resclass['cap_class']; ?>">                       
                                            </div>
                                            <br><br>
                                            <div class="input-control select">
                                                <div class="input-control select" data-role="select">
                                                Wali Kelas
                                                <select name="wlkls[]" hidden>
                                                    <option value="<?php echo $resclass['id_guru']; ?>"><?php echo $resclass['nama'] ?></option>
                                                    <?php foreach ($resteach as $resteach) { ?>
                                                    <option value="<?php echo $resteach['id_guru']; ?>"><?php echo $resteach['nama']; ?></option>
                                                    <?php } ?>
                                                </select>
                                                </div>                     
                                            </div>
                                    </div>
                                </div>
                                
                                <?php 
                                }
                                ?>
                                <br>
                                    <button name="btn-sub" id="btn-sub-eclass" class="button primary">Proses</button>
                                    <a class="button warning" href="?page=kelas">Batal</a>
                                </form>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</div>

