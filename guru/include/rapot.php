<?php 

$setcl = $DB_connect->prepare("SELECT * FROM class_ci 
							   INNER JOIN teacher_ci ON class_ci.id_guru = teacher_ci.id_guru 
							   WHERE teacher_ci.nip = '".$userRow['username']."'");
$setcl->execute();
$kelas = $setcl->fetchAll(PDO::FETCH_ASSOC);

?>

<h1 class="text-light">Rapot</h1>
<h4 class="text-light">Silahkan buat Rapot untuk kelas anda</h4>
<hr class="thin bg-grayLighter">

<?php foreach ($kelas as $kelas) { 
?>

<a href="?page=in_rapot&kls=<?php echo $kelas['id_kls']; ?>">
 <div class="tile bg-green fg-white" data-role="tile">
        <div class="tile-content iconic">
            <span class="icon mif-organization"></span>
            <span class="tile-label"><b><?php echo $kelas['nm_kls']; ?></b></span>
            <span><b><?php echo $kelas['grade_kls']; ?></b></span>
        </div>
    </div>
</a>

<?php } ?>