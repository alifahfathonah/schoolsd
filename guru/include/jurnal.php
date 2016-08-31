<?php 
$nowday = date('N', strtotime(date('l'))); 
$now = date('Y-m-d');
$lastmonth = date('Y-m-t'); 

if ($now == $lastmonth) {
    $setcl = $DB_connect->prepare("SELECT * FROM reg_teach_ci 
                                 INNER JOIN teacher_ci ON reg_teach_ci.id_guru = teacher_ci.id_guru
                                 INNER JOIN class_ci ON reg_teach_ci.id_kls = class_ci.id_kls
                                 INNER JOIN matpel_ci ON reg_teach_ci.id_matpel = matpel_ci.id_matpel
                                 WHERE teacher_ci.nip = '".$userRow['username']."'");
    $setcl->execute();
    $resper2 = $setcl->fetchAll(PDO::FETCH_ASSOC);

?>

<h1 class="text-light">Jurnal</h1>
<h4 class="text-light">Silahkan pilih kelas mana yang akan anda tambahkan daftar kehadiran</h4>
<hr class="thin bg-grayLighter">

<div class="cell auto-size bg-white" id="inpribadi">


<div class="cell auto-size bg-white" id="inpribadi">
<?php foreach ($resper2 as $resper2) {?>
<form method="post" action="?page=injurnal" style="display: inline;">
<input type="text" name="kls[]" value="<?php echo $resper2['id_kls']; ?>" hidden>
<input type="text" name="reg[]" value="<?php echo $resper2['id_reg']; ?>" hidden>
<button style="background:transparent; border:none; color:transparent;">
 <div class="tile bg-green fg-white" data-role="tile">
        <div class="tile-content iconic">
            <span class="icon mif-organization"></span>
            <span class="tile-label"><b><?php echo $resper2['nm_kls']; ?></b></span>
            <span><b><?php echo $resper2['grade_kls']; ?></b></span>
        </div>
    </div>
</button>
</form>
<?php } ?>

</div>


<?php
}else{
    $nowday = date('N', strtotime(date('l'))); 
    $setcl2 = $DB_connect->prepare("SELECT reg_teach_ci.id_kls,reg_teach_ci.id_reg,class_ci.nm_kls,class_ci.grade_kls FROM schedule_teach_ci
                                 INNER JOIN reg_teach_ci ON schedule_teach_ci.kls = reg_teach_ci.id_reg
                                     INNER JOIN teacher_ci ON reg_teach_ci.id_guru = teacher_ci.id_guru
                                     INNER JOIN class_ci ON reg_teach_ci.id_kls = class_ci.id_kls
                                     INNER JOIN matpel_ci ON reg_teach_ci.id_matpel = matpel_ci.id_matpel
                                 WHERE teacher_ci.nip = '$nip' AND jad_day = '$nowday'
                                 GROUP BY reg_teach_ci.id_kls,reg_teach_ci.id_reg,class_ci.nm_kls,class_ci.grade_kls");
    $setcl2->execute();
    $resper = $setcl2->fetchAll(PDO::FETCH_ASSOC);
 ?>

<h1 class="text-light">Jurnal</h1>
<h4 class="text-light">Silahkan pilih kelas mana yang akan anda tambahkan daftar kehadiran</h4>
<hr class="thin bg-grayLighter">

<div class="cell auto-size bg-white" id="inpribadi">

<?php foreach ($resper as $resper) {?>

<form method="post" action="?page=injurnal" style="display: inline;">
<input type="text" name="kls[]" value="<?php echo $resper['id_kls']; ?>" hidden>
<input type="text" name="reg[]" value="<?php echo $resper['id_reg']; ?>" hidden>
<button style="background:transparent; border:none; color:transparent;">
 <div class="tile bg-green fg-white" data-role="tile">
        <div class="tile-content iconic">
            <span class="icon mif-organization"></span>
            <span class="tile-label"><b><?php echo $resper['nm_kls']; ?></b></span>
            <span><b><?php echo $resper['grade_kls']; ?></b></span>
        </div>
    </div>
</button>
</form>
<?php } ?>

</div>
<?php } ?>