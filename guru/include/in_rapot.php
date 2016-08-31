<?php  
	$id_kls = $_GET['kls'];

	$setcl = $DB_connect->prepare("SELECT * FROM studen_ci WHERE id_kls = '$id_kls'");
	$setcl->execute();
	$resper = $setcl->fetchAll(PDO::FETCH_ASSOC);
	$no = 1;
?>

<h1 class="text-light">Rapot</h1>
<h4 class="text-light">Silahkan pilih murid untuk dibuat rapot</h4>
<hr class="thin bg-grayLighter">
<a href="?page=rapot" class="pagination no-border" id="backinpri"><h3><span class="mif-arrow-left"></span></h3></a>

 <table class="datatable" id="tab-class" data-role="datatable">
	<thead>
		<tr>
			<th>No</th>
			<th>Nama Siswa</th>
			<th>Jenis Kelamin</th>
			<th>No Induk</th>
			<th>Action</th>
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
			<td><a href="?page=rapot_stu&kls=<?php echo $id_kls; ?>&id=<?php echo $resper['id_stu']; ?>" class="button primary"><span class="mif-arrow-right"></span> </a><a href="#" class="button warning"><span class="mif-printer"></span></a></td>
		</tr>
	<?php } ?>
	</tbody>
</table>
