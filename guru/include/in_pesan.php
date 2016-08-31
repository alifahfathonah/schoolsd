<?php 
$tipe = $_GET['tipe'];
 	$setcl = $DB_connect->prepare("SELECT * FROM class_ci
 								INNER JOIN teacher_ci ON class_ci.id_guru = teacher_ci.id_guru
 								WHERE teacher_ci.nip = '".$userRow['username']."'");
    $setcl->execute();
    $resper = $setcl->fetch(PDO::FETCH_ASSOC);
$no = 1;
if ($tipe == 'Murid') { ?>

	<h1 class="text-light">Pesan</h1>
	<h4 class="text-light">Silahkan anda buat pesan untuk Orang tua Murid anda</h4>
	<?php if ($userRow['level'] == 'wl_kls') {?>
	<h4 class="text-light"><u>Anda Wali Kelas <?php echo $resper['nm_kls']; ?></u></h4>
	<?php } ?>
	<hr class="thin bg-grayLighter">

	<div>
		<form method="post" action="?page=inbox">
			<button class="button info block-shadow-info text-shadow align-right"><span class="mif-mail"> Inbox</span>
			</button>
		</form>
		<button class="button warning block-shadow-warning text-shadow align-right"><span class="mif-keyboard-return"> Send Message</span></button>
	</div>

	<form method="post" action="?page=s_pesan" enctype="multipart/form-data">
	 <table class="datatable" id="tab-class" data-role="datatable">
		<thead>
			<tr>
				<th>
				<label class="input-control checkbox small-check">
					<input type="checkbox" name="select_all">
				    <span class="check"></span>
				</label>
				</th>
				<th>No</th>
				<th>Nama Siswa</th>
				<th>Jenis Kelamin</th>
				<th>No Induk</th>
			</tr>
		</thead>
		<tbody>
		<?php 
			$setcl = $DB_connect->prepare("SELECT * FROM studen_ci WHERE id_kls = '".$resper['id_kls']."'");
			$setcl->execute();
			$murid = $setcl->fetchAll(PDO::FETCH_ASSOC);
			$no = 1;

			foreach ($murid as $murid) {
			if ($murid['jk'] == 'P') {
				$jk = 'Perempuan';
			}
			else{
				$jk = "Laki - Laki";
			}
			?>
			<tr>
				<td>
					<label class="input-control checkbox small-check">
					<input type="checkbox" name="checkdel[]" class="checkbox_del" value="<?php echo $murid['id_stu']; ?>">
				    <span class="check"></span>
				</label>
				</td>
				<td><?php echo $no++; ?></td>
				<td><?php echo $murid['nam_stu']; ?></td>
				<td><?php echo $jk; ?></td>
				<td><?php echo $murid['nis']; ?></td>
			</tr>
		<?php } ?>
		</tbody>
	</table>

	<input type="text" name="sender" value="<?php echo $resper['id_guru']; ?>" hidden/>

	<br><br>
	<div class="input-control text">
		Judul
		<input type="text" name="title" required/>
	</div>

	<br><br>

	<div class="input-control textarea"
		data-role="input" style="height:20%;width:50%">
		Isi Pesan
		<textarea name="isi" class="editor"></textarea>
	</div>
	<br><br><br><br><br><br><br><br><br><br><br><br>
	
	<div class="input-control text" data-role="input">
		Attachment
	    <input type="file" name="attach">
	</div>
	<br><br>
	<input name="or" value="<?php echo $tipe; ?>" hidden>
	<button class="button primary" name="upload"><span class="mif-envelop mif-ani-pass mif-ani-fast"></span> Kirim Pesan</button>

	</form>

<?php } else { ?>

	<h1 class="text-light">Pesan</h1>
	<h4 class="text-light">Silahkan anda buat pesan untuk guru yang lain</h4>
	<hr class="thin bg-grayLighter">

	<div>
		<form method="post" action="?page=inbox" style="display: inline;">
		<input type="text" name="reciever" value="<?php echo $resper['id_guru']; ?>" hidden/>
			<button class="button info block-shadow-info text-shadow align-right"><span class="mif-mail"> Inbox</span>
			</button>
		</form>
		<button class="button warning block-shadow-warning text-shadow align-right"><span class="mif-keyboard-return"> Send</span></button>
	</div>

	<form method="post" action="?page=s_pesan" enctype="multipart/form-data">
	 <table class="datatable" id="tab-class" data-role="datatable">
		<thead>
			<tr>
				<th>
				<label class="input-control checkbox small-check">
					<input type="checkbox" name="select_all">
				    <span class="check"></span>
				</label>
				</th>
				<th>No</th>
				<th>Nama Guru</th>
				<th>Jenis Kelamin</th>
				<th>No Induk</th>
			</tr>
		</thead>
		<tbody>
		<?php 
			$setcl = $DB_connect->prepare("SELECT * FROM teacher_ci WHERE id_guru != '".$resper['id_guru']."'");
			$setcl->execute();
			$guru = $setcl->fetchAll(PDO::FETCH_ASSOC);
			$no = 1;

			foreach ($guru as $guru) {
			if ($guru['jk'] == 'P') {
				$jk = 'Perempuan';
			}
			else{
				$jk = "Laki - Laki";
			}
			?>
			<tr>
				<td>
					<label class="input-control checkbox small-check">
					<input type="checkbox" name="checkdel[]" class="checkbox_del" value="<?php echo $guru['id_guru']; ?>">
				    <span class="check"></span>
				</label>
				</td>
				<td><?php echo $no++; ?></td>
				<td><?php echo $guru['nama']; ?></td>
				<td><?php echo $jk; ?></td>
				<td><?php echo $guru['nip']; ?></td>
			</tr>
		<?php } ?>
		</tbody>
	</table>

	<br><br>
	<input type="text" name="sender" value="<?php echo $resper['id_guru']; ?>" hidden/>

	<br><br>
	<div class="input-control text">
		Judul
		<input type="text" name="title" required/>
	</div>

	<br><br>

	<div class="input-control textarea"
		data-role="input" style="height:20%;width:50%">
		Isi Pesan
		<textarea name="isi" class="editor"></textarea>
	</div>
	<br><br><br><br><br><br><br><br><br><br><br><br>
	
	<div class="input-control text" data-role="input">
		Attachment
	    <input type="file" name="attach">
	</div>
	<br><br>
	<input name="or" value="<?php echo $tipe; ?>" hidden>
	<button class="button primary" name="upload"><span class="mif-envelop mif-ani-pass mif-ani-fast"></span> Kirim Pesan</button>

	</form>

<?php } ?>