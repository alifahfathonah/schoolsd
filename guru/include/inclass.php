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

<h1 class="text-light">Info</h1>
<h4 class="text-light">Silahkan pilih info yang anda ingin lihat</h4>
<hr class="thin bg-grayLighter">

<div class="cell auto-size bg-white" id="inpribadi">
<a href="?page=info" class="pagination no-border" id="backinpri"><h3><span class="mif-arrow-left"></span></h3></a>

<?php foreach ($resper as $resper) {?>
<form method="post" action="?page=stu_class" style="display: inline;">
<input type="hidden" name="kls[]" value="<?php echo $resper['id_kls']; ?>">
<input type="hidden" name="reg[]" value="<?php echo $resper['id_reg']; ?>">
<button style="background:transparent; border:none; color:transparent;">
 <div class="tile bg-indigo fg-white" data-role="tile">
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