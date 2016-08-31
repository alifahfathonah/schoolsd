<?php 
 $setcl = $DB_connect->prepare("SELECT * FROM class_ci
 								INNER JOIN teacher_ci ON class_ci.id_guru = teacher_ci.id_guru
 								WHERE teacher_ci.nip = '".$userRow['username']."'");
    $setcl->execute();
    $resper = $setcl->fetch(PDO::FETCH_ASSOC);
$no = 1;
?>

<h1 class="text-light">Pesan</h1>
<h4 class="text-light">Silahkan anda buat pesan untuk Orang tua Murid anda</h4>
<?php if ($userRow['level'] == 'wl_kls') {?>
<h4 class="text-light"><u>Anda Wali Kelas <?php echo $resper['nm_kls']; ?></u></h4>
<?php } ?>
<hr class="thin bg-grayLighter">

<form method="get" action="" style="display: inline;">
<input name="page" value="in_pesan" hidden>
<input type="text" name="tipe" value="Guru" hidden>
<button style="background:transparent; border:none; color:transparent;">
 <div class="tile bg-green fg-white" data-role="tile">
        <div class="tile-content iconic">
            <span class="icon mif-organization"></span>
            <span class="tile-label"><b>Guru</b></span>
        </div>
    </div>
</button>
</form>

<form method="get" action="" style="display: inline;">
<input name="page" value="in_pesan" hidden>
<input type="text" name="tipe" value="Murid" hidden>
<button style="background:transparent; border:none; color:transparent;">
 <div class="tile bg-lightblue fg-white" data-role="tile">
        <div class="tile-content iconic">
            <span class="icon mif-school"></span>
            <span class="tile-label"><b>Murid</b></span>
        </div>
    </div>
</button>
</form>