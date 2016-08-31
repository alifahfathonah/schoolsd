<?php 
 	$setcl = $DB_connect->prepare("SELECT * FROM reg_teach_ci 
                                 INNER JOIN teacher_ci ON reg_teach_ci.id_guru = teacher_ci.id_guru
                                 INNER JOIN class_ci ON reg_teach_ci.id_kls = class_ci.id_kls
                                 INNER JOIN matpel_ci ON reg_teach_ci.id_matpel = matpel_ci.id_matpel
                                 WHERE reg_teach_ci.nip = '$nip'
                                 ORDER BY grade_kls");
    $setcl->execute();
    $resper = $setcl->fetchAll(PDO::FETCH_ASSOC);
?>

<h1 class="text-light">Laporan</h1>
<h4 class="text-light">Silahkan buat rekap laporan nilai anak murid anda</h4>
<hr class="thin bg-grayLighter">

<?php foreach ($resper as $resper) {?>


<button style="background:transparent; border:none; color:transparent;" onclick="showDialog('#dialog<?php echo $resper['id_reg']; ?>')">
 <div class="tile bg-lime fg-white" data-role="tile">
        <div class="tile-content iconic">
            <span class="icon mif-organization"></span>
            <span class="tile-label"><b><?php echo $resper['nm_kls']; ?></b></span>
            <span><b><?php echo $resper['grade_kls']; ?></b></span>
            <span><b><?php echo $resper['nam_pel']; ?></b></span>
        </div>
    </div>
</button>



<div id="dialog<?php echo $resper['id_reg']; ?>" data-role="dialog" data-type="info" data-overlay="true" data-overlay-color="op-dark" 
                                    class="Dialog padding20" data-close-button="true" data-width="250" data-height="270">
                                        <h3 class="align-center">Pilih Laporan<br><?php echo $resper['nm_kls']; ?></h3>
                                        <hr class="thin bg-grayLighter">
                                        <form method="post" action="?page=in_laporan" style="width: 368px;"> 
                                        <input type="text" name="kls[]" value="<?php echo $resper['id_kls']; ?>" hidden>
                                        <input type="text" name="reg[]" value="<?php echo $resper['id_reg']; ?>" hidden>
                                            <div class="input-control text">
                                                Pilih Laporan
                                                <select name="laporan" required>
                                                    <option value="">Silahkan Pilih</option>
                                                    <option disabled="true">--------------------</option>
                                                    <option value="absen">Absensi</option>
                                                    <option value="nilai">Nilai</option>
                                                </select>
                                            </div>
                                        <br><br>
                                        <button name="btn-sub-nampel" id="btn-sub-nampel" class="button primary fixed-bottom">Proses</button>
                                        </form>
                                    </div>
<?php
}
?>
</div>

