<body>
<?php 
    $setcl = $DB_connect->prepare("SELECT class_ci.id_kls,class_ci.nm_kls,class_ci.kd_kls,class_ci.grade_kls,class_ci.cap_class,teacher_ci.nama 
                                   FROM class_ci INNER JOIN teacher_ci ON class_ci.id_guru = teacher_ci.id_guru
                                   ORDER BY grade_kls");
    $setcl->execute();
    $resper = $setcl->fetchall(PDO::FETCH_ASSOC); 
    $no = 1;

    $setcl = $DB_connect->prepare("SELECT * FROM teacher_ci");
    $setcl->execute();
    $resteach = $setcl->fetchall(PDO::FETCH_ASSOC);

    $rows = $DB_connect->query("SELECT count(*) FROM class_ci")->fetchColumn();
?>
<div id="loadpage">
<div class="page-content" >
        <div class="flex-grid no-responsive-future" style="height: 100%;">
            <div class="row" style="height: 100%">
                <div class="cell size-x200" id="cell-sidebar" style="background-color: #71b1d1; height: 100%">
                    <ul class="sidebar">
                        <li class="active"><a href="#" id="daf">
                            <span class="mif-apps icon"></span>
                            <span class="title">Daftar Kelas</span>
                            <span class="counter"><?php echo $rows; ?> Record</span>
                        </a></li>
                       
                    </ul>
                </div>

	           <div class="flex-grid no-responsive-future" style="height: 100%;">
		            <div class="row" style="height: 100%">
		                <div class="cell auto-size bg-white padding20" id="cell-content" style="height: 100%; width: 100%;">
                        <div id="tes" style="height: 100%;">
                            <h1 class="align-center">Daftar Kelas</h1>
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
                                                    <th class="sortable-column">Kode Kelas</th>
                                                    <th class="sortable-column">Grade Kelas</th>
                                                    <th class="sortable-column">Nama Kelas</th>
                                                    <th class="sortable-column">Kapasitas</th>
                                                    <th class="sortable-column">Wali Kelas</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php 
                                                
                                                foreach ($resper as $resper) {                                                
                                             ?>
                                                <tr>
                                                    <td><input type="checkbox" name="checkdel[]" id="checkdel" class="checkbox_del" value="<?php echo $resper['id_kls'] ?>"></td>
                                                    <td><?php echo $no++; ?></td>
                                                    <td><?php echo $resper['kd_kls']; ?></td>
                                                    <td><?php echo $resper['grade_kls']; ?></td> 
                                                    <td><?php echo $resper['nm_kls']; ?></td>  
                                                    <td><?php echo $resper['cap_class']; ?></td>  
                                                    <td><?php echo $resper['nama']; ?></td>                                                   
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
                                    class="Dialog padding20" data-close-button="true" data-width="300" data-height="500">
                                        <h3 class="align-center">DAFTAR KELAS BARU</h3>
                                        <hr class="thin bg-grayLighter">
                                        <form method="post" id="addclass2" action="?page=s_class">
                                            <div class="input-control select">
                                            Silahkan Pilih Grade kelas
                                                <select placeholder="Pilih" name="gradekls">
                                                    <option selected="selected" disabled="true">Pilih Grade Kelas</option>
                                                    <option disabled="true">----------------------</option>                     
                                                    <option value="Kelas I">Kelas I</option>
                                                    <option value="Kelas II">Kelas II</option>
                                                    <option value="Kelas III">Kelas III</option>
                                                    <option value="Kelas IV">Kelas IV</option>
                                                    <option value="Kelas V">Kelas V</option>
                                                    <option value="Kelas VI">Kelas VI</option>
                                                </select>
                                            </div>
                                            <br><br>
                                            <div class="input-control text">
                                                Nama Kelas
                                                <input type="text" id="nmkls" name="nmkls">
                                            </div>
                                            <br><br>
                                            <div class="input-control text">
                                                Kode Kelas
                                                <input type="text" id="kode" name="kode">
                                            </div>
                                            <br><br>
                                            <div class="input-control text">
                                                Kapasitas Kelas
                                                <input type="text" id="kapkls" name="kapkls">                       
                                            </div>
                                            <br><br>
                                            <div class="input-control select">
                                                <div class="input-control select" data-role="select">
                                                Wali Kelas
                                                <select name="wlkls" hidden required>
                                                    <?php foreach ($resteach as $resteach) { ?>
                                                    <option value="<?php echo $resteach['id_guru']; ?>"><?php echo $resteach['nama']; ?></option>
                                                    <?php } ?>
                                                </select>
                                                </div>                     
                                            </div>
                                            <br><br>
                                                <button name="btn-sub2" class="button primary">Proses</button>
                                        </form>
                                    </div>





</body>
