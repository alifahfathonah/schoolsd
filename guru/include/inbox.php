<?php 
	$reciever = $_POST['reciever'];
 	$setcl = $DB_connect->prepare("SELECT * FROM class_ci
 								INNER JOIN teacher_ci ON class_ci.id_guru = teacher_ci.id_guru
 								WHERE teacher_ci.nip = '".$userRow['username']."'");
    $setcl->execute();
    $resper = $setcl->fetch(PDO::FETCH_ASSOC);

 	$setcl = $DB_connect->prepare("SELECT * FROM pesan_ci 
 								   INNER JOIN teacher_ci ON pesan_ci.send = teacher_ci.id_guru
 								   WHERE to_dest = '$reciever'");
    $setcl->execute();
    $pesan = $setcl->fetchAll(PDO::FETCH_ASSOC);
	$no = 1;
?>
	<h1 class="text-light">Pesan</h1>
	<h4 class="text-light">Silahkan anda buat pesan untuk Orang tua Murid anda</h4>
	<?php if ($userRow['level'] == 'wl_kls') {?>
	<h4 class="text-light"><u>Anda Wali Kelas <?php echo $resper['nm_kls']; ?></u></h4>
	<?php } ?>
	<hr class="thin bg-grayLighter">

	<table class="datatable" id="tab-class" data-role="datatable">
		<thead>
			<tr>
				<th>No</th>
				<th>Dari</th>
				<th>Judul</th>
				<th>Isi</th>
				<th>Attachment</th>
				<th>Balas</th>
			</tr>
		</thead>
		<tbody>
		<?php foreach ($pesan as $pesan) { ?>
			<tr>
				<td><?php echo $no++; ?></td>
				<td><?php echo $pesan['nama']; ?></td>
				<td><?php echo $pesan['title']; ?></td>
				<td><?php echo $pesan['isi']; ?></td>
				<td><?php echo $pesan['attach']; ?></td>
				<td><a href="#" class="button info block-shadow-info text-shadow align-right" onclick="showDialog('#dialog<?php echo $pesan['id_pesan']; ?>')"><span class="mif-keyboard-return"> Balas</span></a></td>
			</tr>
								<div id="dialog<?php echo $pesan['id_pesan']; ?>" data-role="dialog" data-type="info" data-overlay="true" data-overlay-color="op-dark" 
                                    class="Dialog padding20" data-close-button="true" data-width="250" data-height="270">
                                        <h3 class="align-center">Balas Pesan</h3>
                                        <hr class="thin bg-grayLighter">
                                        <form method="post" action="?page=in_laporan" style="width: 368px;">  
                                        <div class="input-control text">
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
                                    	</div>
                                    	</form>
                                </div>
		<?php } ?>
		</tbody>
	</table>

