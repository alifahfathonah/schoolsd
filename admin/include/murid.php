<body>
<?php 
    $setcl = $DB_connect->prepare("SELECT * FROM studen_ci 
                                   INNER JOIN class_ci ON studen_ci.id_kls = class_ci.id_kls");
    $setcl->execute();
    $resper = $setcl->fetchall(PDO::FETCH_ASSOC); 
    $no = 1;

    $setcl = $DB_connect->prepare("SELECT * FROM class_ci ORDER BY grade_kls");
    $setcl->execute();
    $resteach = $setcl->fetchall(PDO::FETCH_ASSOC);

    $rows = $DB_connect->query("SELECT count(*) FROM class_ci")->fetchColumn();
?>
<div id="loadpage">
<div class="page-content" >
        <div class="flex-grid no-responsive-future" style="height: 100%;">
            <div class="row" style="height: 100%">
                <div class="flex-grid no-responsive-future" style="height: 100%;">
		            <div class="row" style="height: 100%">
		                <div class="cell auto-size bg-white padding20" id="cell-content" style="height: 100%; width: 100%;">
                        <div id="tes" style="height: 100%;">
                        <div class="align-right"><button class="button info" onclick="showDialog('#dialoginfo')">Upload Excel</button></div>
                            <h1 class="align-center">Daftar Murid Baru</h1>
                            <h5 class="align-center">Anda bisa mendaftar banyaknya kelas di tiap tingkatan kelas</h5>
                                <hr class="thin bg-grayLighter">                                    
                                    <form id="formdel" action="?page=e_kelas" method="post">
                                    <a href="#" class="button primary" onclick="showDialog('#dialog')"><span class="mif-plus"></span></a>
                                    <a href="#" class="button danger" id="btn-del"><span class="mif-minus"></span></a>
                                    <button class="button warning" id="btn-edit" name="btn-edit"><span class="mif-pencil"></span></button>
                                        <table class="datatable" id="tab-class" data-role="datatable" data-dt_scrolly="35%">
                                            <thead>
                                                <tr>
                                                    <th><input type="checkbox" name="select_all"></th>
                                                    <th class="sortable-column">No</th>
                                                    <th class="sortable-column">NIS</th>
                                                    <th class="sortable-column">NISN</th>
                                                    <th class="sortable-column">Nama</th>
                                                    <th class="sortable-column">Jenis Kelamin</th>
                                                    <th class="sortable-column">Tahun Tanggal Lahir</th>
                                                    <th class="sortable-column">Kelas</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php 
                                                
                                                foreach ($resper as $resper) {                                                
                                             ?>
                                                <tr>
                                                    <td><input type="checkbox" name="checkdel[]" id="checkdel" class="checkbox_del" value="<?php echo $resper['id_kls'] ?>"></td>
                                                    <td><?php echo $no++; ?></td>
                                                    <td><?php echo $resper['nis']; ?></td> 
                                                    <td><?php echo $resper['nisn']; ?></td>
                                                    <td><?php echo $resper['nam_stu']; ?></td>  
                                                    <td><?php echo $resper['jk']; ?></td>  
                                                    <td><?php echo $resper['tgl_lhr']; ?></td>  
                                                    <td><?php echo $resper['nm_kls']; ?></td>                                                 
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

        
          <div id="dialog" data-role="dialog" data-type="info" data-overlay="true" data-overlay-color="op-dark" 
                                    class="Dialog padding20" data-close-button="true" data-width="300" data-height="550">
                                        <h3 class="align-center">DAFTAR KELAS BARU</h3>
                                        <hr class="thin bg-grayLighter">
                                        <form method="post" id="addstudent" action="?page=s_murid">
                                            <div class="input-control text">
                                                Nama Murid
                                                <input type="text" id="nmmrd" name="nmmrd">
                                            </div>
                                            <br><br>
                                            <div class="input-control text">
                                                NIS
                                                <input type="text" id="nis" name="nis">                       
                                            </div>
                                            <br><br>
                                            <div class="input-control text">
                                                NISN
                                                <input type="text" id="nisn" name="nisn">                       
                                            </div>
                                            <br><br>
                                            <div class="input-control text" data-role="datepicker" data-format="yyyy-mm-dd">
                                                Tahun Tanggal Lahir
                                                <input type="text" name="ttl" required>                                                
                                            </div>
                                            <br><br>
                                            <div class="input-control text">
                                                Jenis Kelamin
                                                <select name="jkel">
                                                    <option value="L">Laki - Laki</option>
                                                    <option value="P">Perempuan</option>
                                                </select>                 
                                            </div>
                                            <br><br>
                                            <div class="input-control select">
                                                <div class="input-control select" data-role="select">
                                                Kelas
                                                <select name="kls" hidden>
                                                    <?php foreach ($resteach as $resteach) { ?>
                                                    <option value="<?php echo $resteach['id_kls']; ?>"><?php echo $resteach['grade_kls']." ".$resteach['nm_kls']; ?></option>
                                                    <?php } ?>
                                                </select>
                                                </div>                     
                                            </div>
                                            <br><br>
                                                <button name="btn-sub" class="button primary">Proses</button>
                                        </form>
                                    </div>
                                    
<div id="dialoginfo" data-role="dialog" data-type="info" data-overlay="true" data-overlay-color="op-dark" 
                                    class="Dialog padding20" data-close-button="true" data-width="480" data-height="500">
                                        <h3 class="align-center">UPLOAD EXCEL</h3>
                                        <h5>Download templete berikut dan isi sesuai</h5>
                                        <hr class="thin bg-grayLighter">
                                        
                                        <form method="post" action="?page=s_user">
                                        Upload
                                        <br>
                                            <div class="input-control">
                                                <textarea class="editor" name="list"></textarea>
                                            </div>
                                            <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
                                            <div class="input-control">
                                                <button name="import" class="button primary">Proses</button>
                                            </div>
                                        </form>
                                    </div>
                                    

</body>
