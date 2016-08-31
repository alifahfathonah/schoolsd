<script type="text/javascript">
$(function() {
        var ajax_load = "<div class='row'><legend><span class='text-primary'>Harap Tunggu....</span></legend></div>";
        var loadUrl = "/app/include/kelas/d_kelas.php";
        
        $('form#addclass').on('submit', function(e) {
                if (confirm('Apakah anda Yakin')) {
                    $.post('index.php?page=s_kelas', $(this).serialize(), function (data) {
                    alert('Data Kelas Sukses Disimpan !');
                    $("#loadpage").html(ajax_load).load(loadUrl);
                    // This is executed when the call to mail.php was succesful.
                    // 'data' contains the response from the request
                    }).error(function() {
                    alert('Mohon maaf ada kesalahan')
                    // This is executed when the call to mail.php failed.
                    });
                } else {
                    alert('Anda memilih cancel data tidak jadi disimpan');
                }
                
                e.preventDefault();
        });
    });
</script>
<div id="tes">
		<h1 class="align-center">Daftar Kelas</h1>
		<h5 class="align-center">Anda bisa mendaftar banyaknya kelas di tiap tingkatan kelas</h5>
			<hr class="thin bg-grayLighter">
				<div>
				<button class="button primary" onclick="showDialog('#dialog')"><span class="mif-plus"></span> Tambah Baru</button>
				<button class="button danger"><span class="mif-minus"></span> Hapus Data</button>
					<table class="datatable" data-role="datatable">
						<thead>
					        <tr>
					            <th class="sortable-column">No</th>
					            <th class="sortable-column">Grade Kelas</th>
					            <th class="sortable-column">Nama Kelas</th>
					            <th class="sortable-column">Wali Kelas</th>
					        </tr>
			    		</thead>
			    		<tbody>
			    			<tr>
			    				<td></td>
			    				<td></td>
			    				<td></td>
			    				<td></td>
			    			</tr>
			    		</tbody>
					</table>	
				</div>
				<div id="dialog" data-role="dialog" data-overlay="true" data-overlay-color="op-dark" 
				class="Dialog padding20" data-close-button="true" data-width="300" data-height="400">
				    <h3 class="align-center">DAFTAR KELAS BARU</h3>
				    <hr class="thin bg-grayLighter">
				    <form id="addclass">
					    <div class="input-control select">
				        Silahkan Pilih Grade kelas
					        <select placeholder="Pilih" name="gradekls">
					        	<option selected="selected" disabled="true">Pilih Grade Kelas</option>
					        	<option disabled="true">----------------------</option>			        	
					            <option>Kelas I</option>
					            <option>Kelas II</option>
					            <option>Kelas III</option>
					            <option>Kelas IV</option>
					            <option>Kelas V</option>
					            <option>Kelas VI</option>
					        </select>
					    </div>
					    <br><br>
					    <div class="input-control text">
						    Nama Kelas
						    <input type="text" id="nmkls" name="nmkls">
						</div>
						<br><br>
						<div class="input-control text">
						    Kapasitas Kelas
						    <input type="text" id="kapkls" name="kapkls">					    
						</div>
						<br><br>
						<div class="input-control text">
						   	Wali Kelas
						    <input type="text" id="wlkls" name="wlkls">					    
						</div>
						<br><br>
							<button type="submit" id="subclass" class="button primary" id="subclass">Proses</button>
					</form>
				</div>
				</div>