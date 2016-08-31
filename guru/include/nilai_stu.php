<?php 
    $nowday = date('N', strtotime(date('l'))); 
    $setcl = $DB_connect->prepare("SELECT reg_teach_ci.id_kls,reg_teach_ci.id_reg,class_ci.nm_kls,class_ci.grade_kls,matpel_ci.nam_pel FROM schedule_teach_ci
                                 INNER JOIN reg_teach_ci ON schedule_teach_ci.kls = reg_teach_ci.id_reg
                                     INNER JOIN teacher_ci ON reg_teach_ci.id_guru = teacher_ci.id_guru
                                     INNER JOIN class_ci ON reg_teach_ci.id_kls = class_ci.id_kls
                                     INNER JOIN matpel_ci ON reg_teach_ci.id_matpel = matpel_ci.id_matpel
                                 WHERE teacher_ci.nip = '$nip' AND jad_day = '$nowday'
                                 GROUP BY reg_teach_ci.id_kls,reg_teach_ci.id_reg,class_ci.nm_kls,class_ci.grade_kls,matpel_ci.nam_pel");
    $setcl->execute();
    $resper = $setcl->fetchAll(PDO::FETCH_ASSOC);

    $setcl = $DB_connect->prepare("SELECT reg_teach_ci.id_kls,reg_teach_ci.id_reg,class_ci.nm_kls,class_ci.grade_kls,matpel_ci.nam_pel FROM schedule_teach_ci
                                 INNER JOIN reg_teach_ci ON schedule_teach_ci.kls = reg_teach_ci.id_reg
                                     INNER JOIN teacher_ci ON reg_teach_ci.id_guru = teacher_ci.id_guru
                                     INNER JOIN class_ci ON reg_teach_ci.id_kls = class_ci.id_kls
                                     INNER JOIN matpel_ci ON reg_teach_ci.id_matpel = matpel_ci.id_matpel
                                 WHERE teacher_ci.nip = '$nip' AND jad_day = '$nowday'
                                 GROUP BY reg_teach_ci.id_kls,reg_teach_ci.id_reg,class_ci.nm_kls,class_ci.grade_kls,matpel_ci.nam_pel");
    $setcl->execute();
    $resper2 = $setcl->fetchAll(PDO::FETCH_ASSOC);
 ?>

<h1 class="text-light">Nilai</h1>
<h4 class="text-light">Silahkan pilih kelas yang akan anda tambah nilainya</h4>
<hr class="thin bg-grayLighter">

<div class="cell auto-size bg-white" id="inpribadi">

<?php foreach ($resper as $resper) {?>


<button style="background:transparent; border:none; color:transparent;" onclick="showDialog('#dialog<?php echo $resper['id_reg']; ?>')">
 <div class="tile bg-blue fg-white" data-role="tile">
        <div class="tile-content iconic">
            <span class="icon mif-organization"></span>
            <span class="tile-label"><b><?php echo $resper['nm_kls']; ?></b></span>
            <span><b><?php echo $resper['grade_kls']; ?></b></span>
            <span><b><?php echo $resper['nam_pel']; ?></b></span>
        </div>
    </div>
</button>


<?php
$setcl3 = $DB_connect->prepare("SELECT materi,tgl_input FROM stu_absen_ci WHERE id_reg = '".$resper['id_reg']."' GROUP BY materi,tgl_input ORDER BY tgl_input");
$setcl3->execute();
$resper3 = $setcl3->fetchAll(PDO::FETCH_ASSOC);


?>

<div id="dialog<?php echo $resper['id_reg']; ?>" data-role="dialog" data-type="info" data-overlay="true" data-overlay-color="op-dark" 
                                    class="Dialog padding20" data-close-button="true" data-width="300" data-height="300">
                                        <h3 class="align-center">Pilih materi untuk kelas <?php echo $resper['nm_kls']; ?></h3>
                                        <hr class="thin bg-grayLighter">
                                        <form method="post" action="?page=in_nilai_stu" style="width: 368px;"> 
                                        <input type="text" name="kls[]" value="<?php echo $resper['id_kls']; ?>" hidden>
                                        <input type="text" name="reg[]" value="<?php echo $resper['id_reg']; ?>" hidden>
                                            <div class="input-control text">
                                                Pilih Materi
                                                <select name="materi">
                                                    <option value="">Silahkan Pilih</option>
                                                    <option disabled="true">--------------------</option>
                                                <?php foreach ($resper3 as $resper3) {
                                                    $date = date("d M Y", strtotime($resper3['tgl_input']));
                                                ?>
                                                    <option value="<?php echo $resper3['materi']; ?>"><?php echo $resper3['materi']; ?> (<?php echo $date;?>)</option>
                                                <?php } ?>
                                                </select>
                                            </div>
                                            <br><br>
                                            <div class="input-control text">
                                                Pilih Tipe Nilai
                                                <select name="tipe" id="tipe" required>
                                                    <option value="">Silahkan Pilih</option>
                                                    <option disabled="true">--------------------</option>
                                                    <option value="1">Nilai Ulangan</option>
                                                    <option value="2">Nilai Non-Test</option>
                                                    <option value="3">UTS</option>
                                                    <option value="4">UAS</option>
                                                </select>
                                            </div>
                                        
                                        <br><br>
                                         <button class="button primary fixed-bottom">Proses</button>
                                         </form>

                                    </div>
<?php } ?>
</div>
