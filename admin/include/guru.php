<?php 
    $setcl = $DB_connect->prepare("SELECT * FROM teacher_ci");
    $setcl->execute();
    $resper = $setcl->fetchall(PDO::FETCH_ASSOC); 
    $no = 1;

    $rows = $DB_connect->query("SELECT count(*) FROM teacher_ci")->fetchColumn();
?>
<body>
<div id="loadpage">
<div class="page-content" >
        <div class="flex-grid no-responsive-future" style="height: 100%;">
            <div class="row" style="height: 100%">
                <div class="flex-grid no-responsive-future" style="height: 100%;">
		            <div class="row" style="height: 100%">
		                <div class="cell auto-size bg-white padding20" id="cell-content">
                        <div id="tes">
                            <h1 class="align-center">Daftar Guru</h1>
                            <h5 class="align-center">Anda bisa mendaftar staff guru yang ada di sekolah</h5>
                                <hr class="thin bg-grayLighter">
                                    <div>
                                   <form id="formdelteach" method="post" action="?page=e_guru">                                   
                                    <a href="#" class="button primary" onclick="showDialog('#dialog')"><span class="mif-plus"></span></a>
                                    <a href="#" class="button danger" id="btn-del-guru"><span class="mif-minus"></span></a>
                                    <button class="button warning" id="btn-edit-tch" name="btn-edit-tch"><span class="mif-pencil"></span></button>   
                                       <table class="datatable" id="tab-class" data-role="datatable" data-dt_scrolly="35%">
                                            <thead>
                                                <tr>
                                                    <th><input type="checkbox" name="select_all"></th>
                                                    <th class="sortable-column">No</th>
                                                    <th class="sortable-column">NIK</th>
                                                    <th class="sortable-column">NUPTK / PEG ID</th>
                                                    <th class="sortable-column">Nama Guru</th>
                                                    <th class="sortable-column">Tanggal Lahir</th>
                                                    <th class="sortable-column">Jenis Kelamin</th>
                                                    <th class="sortable-column">Foto Guru</th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php 
                                                
                                                foreach ($resper as $resper) {                                                
                                             ?>
                                            
                                                <tr>
                                                    <td>
                                                        <input type="checkbox" name="checkdel[]" class="checkbox_del" value="<?php echo $resper['nip'] ?>">
                                                        <?php 
                                                            $setcl = $DB_connect->query("SELECT * FROM reg_teach_ci 
                                                                                         INNER JOIN teacher_ci ON reg_teach_ci.id_guru = teacher_ci.id_guru
                                                                                         WHERE reg_teach_ci.id_guru = '".$resper['id_guru']."'");
                                                            $setcl->execute();
                                                            $showreg = $setcl->fetch(PDO::FETCH_ASSOC);
                                                        ?>
                                                        <input type="text" name="idreg[]" value="<?php echo $showreg['id_reg']; ?>" hidden>
                                                    </td>
                                                    <td><?php echo $no++; ?></td>
                                                    <td><?php echo $resper['nip']; ?></td> 
                                                    <td><?php echo $resper['nuptk']; ?></td>  
                                                    <td><?php echo $resper['nama']; ?></td>
                                                    <td><?php echo $resper['ttl']; ?></td>
                                                    <td><?php echo $resper['jk']; ?></td> 
                                                    <td style="width: 20%;"><img id="blah" src="<?php echo $resper['teach_photo']; ?>" alt="Gambar anda"  style="height: 100px; width:100px;"></td>
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

</body>
<div id="dialog" data-role="dialog" data-type="info" data-overlay="true" data-overlay-color="op-dark" 
                                    class="Dialog padding20" data-close-button="true" data-width="300" data-height="500">
                                        <h3 class="align-center">DAFTAR GURU BARU</h3>
                                        <hr class="thin bg-grayLighter">
                                        <form method="post" id="addteach" action="?page=s_teach" style="width: 368px;"> 
                                        
                                            <div class="input-control text">
                                                Nama Guru
                                                <input type="text" id="nmguru" name="nmguru" required>                                                
                                            </div>
                                        <br><br>
                                            <div class="input-control text" data-role="datepicker" data-format="yyyy-mm-dd">
                                                Tahun Tanggal Lahir
                                                <input type="text" name="ttl" required>                                                
                                            </div>
                                        <br><br>                                               
                                            <div class="input-control text">
                                                NUPTK / PEG ID
                                                <input type="text" id="nuptk" name="nuptk">                                                
                                            </div>
                                        <br><br>
                                            <div class="input-control text">
                                                NIK
                                                <input type="text" id="nip" name="nip" required> 
                                            </div>                                               
                                        <br><br>
                                            <div class="input-control text">
                                                Jenis Kelamin
                                                <select name="jkel">
                                                    <option selected="selected" disabled="true">Pilih Jenis Kelamin</option>
                                                    <option disabled="true">----------------------</option>
                                                    <option>L</option>
                                                    <option>P</option>
                                                </select>                                               
                                            </div>
                                        <br><br>
                                         <button name="btn-sub-guru" id="btn-sub-guru" class="button primary fixed-bottom">Proses</button>
                                         
                                        </form>
                                    </div>