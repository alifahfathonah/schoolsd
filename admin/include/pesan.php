<?php 
	$setcl = $DB_connect->prepare("SELECT * FROM pesan_ci WHERE to_dest = 'Admin'");
    $setcl->execute();
    $resper = $setcl->fetchall(PDO::FETCH_ASSOC); 
    $no = 1;

?>
<div id="loadpage">
<div class="page-content" >
        <div class="flex-grid no-responsive-future" style="height: 100%;">
            <div class="row" style="height: 100%">
                <div class="flex-grid no-responsive-future" style="height: 100%;">
		            <div class="row" style="height: 100%">
		                <div class="cell auto-size bg-white padding20" id="cell-content">
                        <div id="tes" style="height: 100%">
                            <h1 class="align-center">Pesan</h1>
                            <h5 class="align-center">Anda bisa mengirim pesan kepada pengunjung</h5>
                                <hr class="thin bg-grayLighter">
                            <div class="grid">
                            <div class="row">
                            	<div class="cell colspan12">
                            	Pesan dari web anda
                            		<table class="datatable" id="tab-class" data-role="datatable" data-dt_scrolly="40%">
                            			<thead>
                            				<tr>
                            					<th>No</th>
                            					<th>Nama</th>
                            					<th>Email</th>
                            					<th>Isi</th>
                            					<th>Action</th>
                            				</tr>
                            			</thead>
                            			<tbody>
                            			<?php foreach ($resper as $resper) { ?>
                            				<tr>
                            					<td><?php echo $no++; ?></td>
                            					<td><?php echo $resper['send']; ?></td>
                            					<td><?php echo $resper['attach']; ?></td>
                            					<td><?php echo $resper['isi']; ?></td>
                            					<td><a href="#" class="button primary" onclick="showDialog('#<?php echo $resper['id_pesan']; ?>')">Balas</a></td>
                            				</tr>
			                            			<div id="<?php echo $resper['id_pesan']; ?>" data-role="dialog" data-type="info" data-overlay="true" data-overlay-color="op-dark" 
			                                    class="Dialog padding20" data-close-button="true" data-width="300" data-height="500">
				                                        <h3 class="align-center">BALAS PESAN</h3>
				                                        <hr class="thin bg-grayLighter">
				                                        <form method="post" action="?page=send_mail" style="width: 368px;">
				                                        <input type="hidden" name="name" value="<?php echo $resper['send']; ?>">
				                                        	<div class="input-control text">
				                                                Kirim Ke
				                                                <input type="text" id="nuptk" name="kirimke" value="<?php echo $resper['attach']; ?>">                                                
				                                            </div>
				                                            <br><br>
				                                            <div class="input-control text">
				                                                Judul
				                                                <input type="text" id="nuptk" name="judul">                                                
				                                            </div>
				                                            <br><br>
				                                            <div class="input-control text">
				                                                Isi
				                                                <textarea name="isi"></textarea>                                                
				                                            </div>
				                                        <br><br><br><br><br><br><br><br>
				                                        <div class="input-control text">
				                                         <button name="btn-sub-exp" class="button primary fixed-bottom">Proses</button>
				                                        </div>
			                                        </form>
			                                    </div>
                            			<?php } ?>
                            			</tbody>
                            		</table>
                            	</div>
                            <div class="cell colspan5">
                           
                            </div>
                            </div>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</div>
</div>
</div>