<?php 
    $setcl = $DB_connect->prepare("SELECT * FROM teacher_ci");
    $setcl->execute();
    $resteach = $setcl->fetchall(PDO::FETCH_ASSOC); 
    $no = 1;

    $setcl = $DB_connect->query("SELECT * FROM matpel_ci");
    $setcl->execute();
    $resmatpel = $setcl->fetchall(PDO::FETCH_ASSOC);

    $setcl = $DB_connect->query("SELECT * FROM class_ci ORDER BY grade_kls");
    $setcl->execute();
    $resclass = $setcl->fetchall(PDO::FETCH_ASSOC);

    $setcl = $DB_connect->query("SELECT * FROM reg_teach_ci 
                                 INNER JOIN teacher_ci ON reg_teach_ci.id_guru = teacher_ci.id_guru
                                 INNER JOIN class_ci ON reg_teach_ci.id_kls = class_ci.id_kls
                                 INNER JOIN matpel_ci ON reg_teach_ci.id_matpel = matpel_ci.id_matpel
                                 ORDER BY grade_kls");
    $setcl->execute();
    $showreg = $setcl->fetchall(PDO::FETCH_ASSOC);
?>
<body>
<div id="loadpage">
<div class="page-content" >
        <div class="flex-grid no-responsive-future" style="height: 100%;">
            <div class="row" style="height: 100%">
                <div class="flex-grid no-responsive-future" style="height: 100%;">
		            <div class="row" style="height: 35%; width:100%;">
		                <div class="cell auto-size bg-white padding10" id="cell-content">
                        <div id="tes">
                            <button class="button" id="info_button" onclick="showDialog('#dialogmatpel')"><span class="align-right mif-info"></span></button>
                            <h1 class="align-center">Set Mata Pelajaran Guru</h1>
                            <h5 class="align-center">Anda bisa set guru untuk mengajar apa dan di kelas apa</h5>
                                <hr class="thin bg-grayLighter">                                     
                                     <div class="wizard" id="wizard" >
                                     <form name="regteachmatpel" id="regteachmatpel" method="post">
                                        <div class="steps">
                                            <div class="step" style="overflow:auto;">
                                                <h4 class="align-left">Silahkan pilih guru</h4>
                                                <?php foreach ($resteach as $resteach) { ?>
                                                    <label class="input-control radio">
                                                        <input type="radio" id="guru<?php echo $resteach['id_guru']; ?>" name="guru" value="<?php echo $resteach['id_guru']; ?>" required>
                                                        <span class="check"></span>
                                                        <span class="caption"><?php echo $resteach['nama']; ?></span>                                                                                                                
                                                    </label>
                                                    <div hidden>
                                                        <input type="radio" id="nip<?php echo $resteach['nip']; ?>" name="nip" value="<?php echo $resteach['nip']; ?>">
                                                        <spaclass="check"></span>
                                                        <span class="caption"><?php echo $resteach['nip']; ?></span>
                                                    </div>
                                                    <br>
                                                <?php } ?>
                                            </div>
                                            <div class="step" style="overflow:auto;">
                                                <h4 class="align-left">Silahkan pilih Mata Pelajaran</h4>
                                                <?php foreach ($resmatpel as $resmatpel) {?>
                                                    <label class="input-control radio">
                                                        <input type="radio" name="matpel" value="<?php echo $resmatpel['id_matpel']; ?>" required>
                                                        <span class="check"></span>
                                                        <span class="caption"><?php echo $resmatpel['nam_pel']; ?></span>
                                                    </label>
                                                    <br>
                                                <?php } ?>
                                            </div>
                                            <div class="step" style="overflow:auto;">
                                                <h4 class="align-left">Silahkan pilih Kelas</h4>
                                                <?php foreach ($resclass as $resclass) { ?>
                                                    <label class="input-control checkbox">
                                                        <input type="checkbox" name="kelas[]" value="<?php echo $resclass['id_kls']; ?>">
                                                        <span class="check"></span>
                                                        <span class="caption"><?php echo $resclass['grade_kls']." ".$resclass['nm_kls']; ?></span>
                                                    </label>
                                                    <br>
                                                <?php } ?>                                                
                                            </div>
                                        </div>
                                    </div>
                                    <button class="place-right button primary" name="sub-reg-teach" id="sub-reg-teach"><span class="mif-enter"></span> Proses</button>
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

</body>

<div id="dialogmatpel" data-role="dialog" data-overlay="true" data-overlay-color="op-dark" 
                                    class="Dialog padding20" data-close-button="true" data-width="700" data-height="550">
                                        <h3 class="align-center">DAFTAR REGISTRASI MATA PELAJARAN</h3>
                                        <hr class="thin bg-grayLighter">
                                        <form>
                                            
                                        </form>
                                        <form method="post" action="?page=e_reg_guru"> 
                                        <button class="button warning" id="btn-edit-tch" name="btn-edit-tch"><span class="mif-pencil"> Edit Data</span></button>
                                            <table class="datatable" id="tab-class" data-role="datatable" data-dt_scrolly="50%" data-searching="true" data-paging="false">
                                                <thead>
                                                    <tr>
                                                        <th><input type="checkbox" name="select_all"></th>
                                                        <th>No</th>
                                                        <th>Nama</th>
                                                        <th>Kelas</th>
                                                        <th>Mata Pelajaran</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                <?php foreach ($showreg as $showreg) {?>
                                                    <tr>
                                                        <td><input type="checkbox" name="checkdel[]" class="checkbox_del" value="<?php echo $showreg['id_reg'] ?>"></td>
                                                        <td><?php echo $no++; ?></td>
                                                        <td><?php echo $showreg['nama']; ?></td>
                                                        <td><?php echo $showreg['grade_kls']." - ".$showreg['nm_kls']; ?></td>
                                                        <td><?php echo $showreg['nam_pel']; ?></td>
                                                    </tr>
                                                <?php } ?>
                                                </tbody>
                                            </table>                                       
                                        </form>
                                    </div>