<?php 
$id_kls = $_POST['kls'][0];
$reg = $_POST['reg'][0];


$setcl = $DB_connect->prepare("SELECT * FROM studen_ci WHERE id_kls = '$id_kls'");
$setcl->execute();
$resper = $setcl->fetchAll(PDO::FETCH_ASSOC);
$no = 1;

$setcl2 = $DB_connect->prepare("SELECT * FROM reg_teach_ci 
                                 INNER JOIN teacher_ci ON reg_teach_ci.id_guru = teacher_ci.id_guru
                                 INNER JOIN class_ci ON reg_teach_ci.id_kls = class_ci.id_kls
                                 INNER JOIN matpel_ci ON reg_teach_ci.id_matpel = matpel_ci.id_matpel
                                 WHERE id_reg = '$reg'");
$setcl2->execute();
$resper2 = $setcl2->fetch(PDO::FETCH_ASSOC);
 ?>

<h1 class="text-light">Info <?php echo $resper2['grade_kls']." ".$resper2['nm_kls']; ?></h1>
<h4 class="text-light">Ini adalah list murid anda di <?php echo $resper2['grade_kls']." ".$resper2['nm_kls']; ?></h4>
<hr class="thin bg-grayLighter">
<div class="cell auto-size bg-white" id="inpribadi">
<a href="?page=inclass" class="pagination no-border" id="backinpri"><h3><span class="mif-arrow-left"></span></h3></a>

 <table class="datatable" id="tab-class" data-role="datatable" data-dt_scrolly="30%">
	<thead>
		<tr>
			<th>No</th>
			<th>Nama Siswa</th>
			<th>Jenis Kelamin</th>
			<th>No Induk</th>
		</tr>
	</thead>
	<tbody>
	<?php foreach ($resper as $resper) {
		if ($resper['jk'] == 'P') {
			$jk = 'Perempuan';
		}
		else{
			$jk = "Laki - Laki";
		}
		?>
		<tr>
			<td><?php echo $no++; ?></td>
			<td><?php echo $resper['nam_stu']; ?></td>
			<td><?php echo $jk; ?></td>
			<td><?php echo $resper['nis']; ?></td>
		</tr>
	<?php } ?>
	</tbody>
</table>
