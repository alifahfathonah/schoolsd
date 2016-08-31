<?php 
    $setcl = $DB_connect->prepare("SELECT * FROM matpel_ci");
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
                        <div id="tes">
                            <h1 class="align-center">Daftar Mata Pelajaran</h1>
                            <h5 class="align-center">Anda bisa mendaftarkan Mata pelajaran di sekolah</h5>
                                <hr class="thin bg-grayLighter">
                                    <div>
                                    <form method="post" id="delmatpel">
                                    <a href="#" class="button primary" onclick="showDialog('#dialogmatpel')"><span class="mif-plus"></span> Tambah Baru</button></a>
                                    <button class="button danger" id="btn-del-matpel"><span class="mif-minus"></span> Hapus Data</button>
                                        <table class="datatable" id="tab-class" data-role="datatable" data-dt_scrolly="40%">
                                            <thead>
                                                <tr>
                                                    <th><input type="checkbox" name="select_all"></th>
                                                    <th class="sortable-column" style="width:10%">No</th>
                                                    <th class="sortable-column">Kode Pelajaran</th>
                                                    <th class="sortable-column">Mata Pelajaran</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php 
                                                
                                                foreach ($resper as $resper) {                                                
                                             ?>
                                                <tr>
                                                    <td><input type="checkbox" name="checkdel[]" class="checkbox_del" value="<?php echo $resper['id_matpel'] ?>"></td>
                                                    <td><?php echo $no++; ?></td>
                                                    <td><?php echo $resper['kode_matpel']; ?></td>
                                                    <td><?php echo $resper['nam_pel']; ?></td>                                                 
                                                </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                        </form>    
                                    </div>
                            </div>
		                </div>
		            </div>
		        </div>
        </div>
        </div>
        </div>
        </div>

<div id="dialogmatpel" data-role="dialog" data-type="info" data-overlay="true" data-overlay-color="op-dark" 
                                    class="Dialog padding20" data-close-button="true" data-width="300" data-height="300">
                                        <h3 class="align-center">DAFTAR MATA PELAJARAN</h3>
                                        <hr class="thin bg-grayLighter">
                                        <form method="post" id="addnampel" action="?page=s_matpel" style="width: 368px;"> 
                                        
                                            <div class="input-control text">
                                                Nama Pelajaran
                                                <input type="text" id="nampel" name="nampel" required>                                                
                                            </div>
                                        <br><br>
                                        <div class="input-control text">
                                                Kode Pelajaran
                                                <input type="text" id="kode" name="kode" required>                                                
                                            </div>
                                        <br><br>
                                         <button name="btn-sub-nampel" id="btn-sub-nampel" class="button primary fixed-bottom">Proses</button>
                                         
                                        </form>
                                    </div>