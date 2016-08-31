<?php 
include_once '../config/db_config.php';
$syscl = new syscl($DB_connect);
class syscl
{
	private $db;

	function __construct($DB_connect)
	{
		$this->db = $DB_connect;
	}

	public function addnampel($nampel,$kode)
	{
		try
		{
			$vardiv = "PEL";
			$todaydiv = date("ymd");
			$randdiv = strtoupper(substr(uniqid(sha1(time())),0,4));
			$id_pel= $vardiv. $todaydiv .$randdiv;
			
			$setcl = $this->db->prepare("INSERT INTO matpel_ci(id_matpel,kode_matpel,nam_pel) VALUES (:id_pel,:kode,:nampel)");
			$setcl->bindparam(":id_pel",$id_pel);
			$setcl->bindparam(":nampel",$nampel);
			$setcl->bindparam(":kode",$kode);
			$setcl
			->execute();
			return true;
		}
		catch (PDOException $e)
		{
			echo $e->getMessage();
			return false;
		}
	}

	public function addcls($kode,$grade,$nmkls,$kapkls,$wlkls,$nip)
	{
		try
		{
			$vardiv = "CLS";
			$todaydiv = date("ymd");
			$randdiv = strtoupper(substr(uniqid(sha1(time())),0,4));
			$id_kls= $vardiv. $todaydiv .$randdiv;
			
			$setcl = $this->db->prepare("BEGIN;
										 INSERT INTO class_ci(id_kls,kd_kls,nm_kls,grade_kls,cap_class,id_guru) VALUES (:id_kls,:kode,:nmkls,:grade,:kapkls,:wlkls);
										 UPDATE user_school SET level = 'wl_kls' WHERE username = :nip;
										 COMMIT;");
			$setcl->bindparam(":id_kls",$id_kls);
			$setcl->bindparam(":kode",$kode);
			$setcl->bindparam(":nmkls",$nmkls);
			$setcl->bindparam(":grade",$grade);
			$setcl->bindparam(":kapkls",$kapkls);
			$setcl->bindparam(":wlkls",$wlkls);
			$setcl->bindparam(":nip",$nip);
			$setcl->execute();
			return true;
		}
		catch (PDOException $e)
		{
			echo $e->getMessage();
			return false;
		}
	}


	public function addtch($nmguru,$nuptk,$nip,$jkel,$ttl)
	{
		try
		{
			$vardiv1 = "TCH";
			$todaydiv1 = date("ymd");
			$randdiv1 = strtoupper(substr(uniqid(sha1(time())),0,4));
			$id_tch= $vardiv1. $todaydiv1 .$randdiv1;

			$vardiv2 = "BIO-TCH";
			$todaydiv2 = date("ymd");
			$randdiv2 = strtoupper(substr(uniqid(sha1(time())),0,4));
			$id_bio= $vardiv2. $todaydiv2 .$randdiv2;

			$vardiv3 = "REG-TCH-PEL";
            $todaydiv3 = date("ymd");
            $randdiv3 = strtoupper(substr(uniqid(sha1(time())),0,4));
            $id_reg_tch= $vardiv3. $todaydiv3 .$randdiv3;
			
			$uteach = "../style/images/defaultprofile.png";

			$pass = password_hash($ttl, PASSWORD_DEFAULT);

			$guru = "Guru";

			$setcl = $this->db->prepare("BEGIN;
										INSERT INTO teacher_ci(id_guru,nip,nuptk,nama,ttl,jk,teach_photo,id_bio) VALUES (:id_guru,:nip,:nuptk,:nama,:ttl,:jk,:teach_photo,:id_bio);
										INSERT INTO user_school(iduser,username,fullname,password,email,level,gambar_p) VALUES (:id_bio,:nip,:nama,:pass,:id_bio,:guru,:teach_photo);
										INSERT INTO bio_teach_ci(id_bio,nip,nuptk,nama,ttl,alamat,jk,agama,status_k,telp,teach_photo) VALUES (:id_bio,:nip,:nuptk,:nama,:ttl,:null,:jk,:null,:null,:null,:teach_photo);
										COMMIT;");
			$setcl->bindparam(":id_guru",$id_tch);
			$setcl->bindparam(":id_bio",$id_bio);
			$setcl->bindparam(":id_exp",$id_exp);
			$setcl->bindparam(":nip",$nip);
			$setcl->bindparam(":id_reg_tch",$id_reg_tch);
			$setcl->bindparam(":nuptk",$nuptk);
			$setcl->bindparam(":nama",$nmguru);
			$setcl->bindparam(":ttl",$ttl);
			$setcl->bindparam(":pass",$pass);
			$setcl->bindparam(":jk",$jkel);
			$setcl->bindparam(":guru",$guru);
			$setcl->bindparam(":teach_photo",$uteach);
			$setcl->bindValue(':null', null, PDO::PARAM_NULL);
			$setcl->execute();
			return true;
		}
		catch (PDOException $e)
		{
			echo $e->getMessage();
			return false;
		}
	}

	public function uppotkeg($nampo,$target_file,$ket)
	{
		try
		{			
			$vardiv3 = "ACT-PHT";
            $todaydiv3 = date("ymd");
            $randdiv3 = strtoupper(substr(uniqid(sha1(time())),0,4));
            $id_act= $vardiv3. $todaydiv3 .$randdiv3;

			$setcl = $this->db->prepare("INSERT INTO konten_web_act_photo(id_act,poto,nampoto,ket) VALUES(:id_act,:poto,:nampo,:ket)");
			$setcl->bindparam(":id_act",$id_act);
			$setcl->bindparam(":poto",$target_file);
			$setcl->bindparam(":nampo",$nampo);
			$setcl->bindparam(":ket",$ket);
			$setcl->execute();
			return true;
		}
		catch (PDOException $e)
		{
			echo $e->getMessage();
			return false;
		}
	}

	public function addnews($judul,$isi,$date,$target_file,$author)
	{
		try
		{			
			$vardiv3 = "NWS";
            $todaydiv3 = date("ymd");
            $randdiv3 = strtoupper(substr(uniqid(sha1(time())),0,4));
            $id_nws= $vardiv3. $todaydiv3 .$randdiv3;
            $tipe = 1;

			$setcl = $this->db->prepare("INSERT INTO news_ci(id_news,title,content_news,photo,date_create,author,tipe) VALUES(:id_nws,:judul,:isi,:poto,:date_nws,:author,:tipe)");
			$setcl->bindparam(":id_nws",$id_nws);
			$setcl->bindparam(":judul",$judul);
			$setcl->bindparam(":isi",$isi);
			$setcl->bindparam(":date_nws",$date);
			$setcl->bindparam(":poto",$target_file);
			$setcl->bindparam(":author",$author);
			$setcl->bindparam(":tipe",$tipe);
			$setcl->execute();
			return true;
		}
		catch (PDOException $e)
		{
			echo $e->getMessage();
			return false;
		}
	}

	public function sabsen($id_abs,$reg,$student,$radio,$tgl,$materi)
	{
		try
		{			
			

			$setcl = $this->db->prepare("INSERT INTO stu_absen_ci(id_absen,id_reg,id_stu,kd_absen,tgl_input,materi) VALUES(:id_abs,:reg,:student,:radio,:tgl,:materi)");
			$setcl->bindparam(":id_abs",$id_abs);
			$setcl->bindparam(":reg",$reg);
			$setcl->bindparam(":student",$student);
			$setcl->bindparam(":radio",$radio);
			$setcl->bindparam(":tgl",$tgl);
			$setcl->bindparam(":materi",$materi);
			$setcl->execute();
			return true;
		}
		catch (PDOException $e)
		{
			echo $e->getMessage();
			return false;
		}
	}

	public function addmsg($id_msg,$title,$isi,$sender,$to_dest,$attach)
	{
		try
		{			
			

			$setcl = $this->db->prepare("INSERT INTO pesan_ci(id_pesan,title,isi,send,to_dest,attach) VALUES(:id_msg,:title,:isi,:sender,:to_dest,:attach)");
			$setcl->bindparam(":id_msg",$id_msg);
			$setcl->bindparam(":to_dest",$to_dest);
			$setcl->bindparam(":title",$title);
			$setcl->bindparam(":isi",$isi);
			$setcl->bindparam(":sender",$sender);
			$setcl->bindparam(":attach",$attach);
			$setcl->execute();
			return true;
		}
		catch (PDOException $e)
		{
			echo $e->getMessage();
			return false;
		}
	}

	public function snilai($id_nil,$reg,$student,$absen,$kkm,$nilai,$tipe,$ket)
	{
		try
		{			
			

			$setcl = $this->db->prepare("INSERT INTO stu_nilai_ci(id_nilai_stu,id_reg,id_stu,id_absen,kkm,nilai_aktual,tipe_nilai,ket) VALUES(:id_nil,:reg,:student,:absen,:kkm,:nilai,:tipe,:ket)");
			$setcl->bindparam(":id_nil",$id_nil);
			$setcl->bindparam(":reg",$reg);
			$setcl->bindparam(":student",$student);
			$setcl->bindparam(":absen",$absen);
			$setcl->bindparam(":kkm",$kkm);
			$setcl->bindparam(":nilai",$nilai);
			$setcl->bindparam(":tipe",$tipe);
			$setcl->bindparam(":ket",$ket);
			$setcl->execute();
			return true;
		}
		catch (PDOException $e)
		{
			echo $e->getMessage();
			return false;
		}
	}

	public function ssikap($id_skp,$aspek,$nis,$nilai,$ket)
	{
		try
		{			
			

			$setcl = $this->db->prepare("INSERT INTO stu_nilai_sikap_ci(id_sikap,id_stu,aspek,nilai,catatan) VALUES(:id_skp,:nis,:aspek,:nilai,:ket)");
			$setcl->bindparam(":id_skp",$id_skp);
			$setcl->bindparam(":aspek",$aspek);
			$setcl->bindparam(":nis",$nis);
			$setcl->bindparam(":nilai",$nilai);
			$setcl->bindparam(":ket",$ket);
			$setcl->execute();
			return true;
		}
		catch (PDOException $e)
		{
			echo $e->getMessage();
			return false;
		}
	}

	public function adduserlist($nis,$nama,$pass)
	{
		try
		{			
			
			$pass2 = password_hash($pass, PASSWORD_DEFAULT);
			$lvl = 'Ortu';
			$ustu = "../style/images/defaultprofile.png";

			$setcl = $this->db->prepare("INSERT INTO user_school(username,fullname,password,level,gambar_p) VALUES(:nis,:nama,:pass,:lvl,:ustu)");
			$setcl->bindparam(":nis",$nis);
			$setcl->bindparam(":nama",$nama);
			$setcl->bindparam(":pass",$pass2);
			$setcl->bindparam(":lvl",$lvl);
			$setcl->bindparam(":ustu",$ustu);
			$setcl->execute();
			return true;
		}
		catch (PDOException $e)
		{
			echo $e->getMessage();
			return false;
		}
	}

	public function addregpelteach($nmguru,$id_reg_tch)
	{
		try
		{
			$setcl = $this->db->prepare("INSERT INTO reg_teach_ci (id_reg,id_guru) VALUES(:id_reg_tch,:nmguru)");
			$setcl->bindparam(":id_reg_tch",$id_reg_tch);
			$setcl->bindparam(":nmguru",$nmguru);
			$setcl->execute();
		return true;
		}
		catch (PDOException $e)
		{
			echo $e->getMessage();
			return false;
		}
	}

	public function addstu($nmmrd,$nis,$nisn,$jk,$kls,$ttl)
	{
		try
		{
			$vardiv1 = "STU";
			$todaydiv1 = date("ymd");
			$randdiv1 = strtoupper(substr(uniqid(sha1(time())),0,4));
			$id_stu= $vardiv1. $todaydiv1 .$randdiv1;

			$vardiv2 = "BIO-STU";
			$todaydiv2 = date("ymd");
			$randdiv2 = strtoupper(substr(uniqid(sha1(time())),0,4));
			$id_bio= $vardiv2. $todaydiv2 .$randdiv2;

			$ustu = "../style/images/defaultprofile.png";

			$pass = password_hash($ttl, PASSWORD_DEFAULT);

			$ortu = "Ortu";

			$setcl = $this->db->prepare("BEGIN;
										INSERT INTO studen_ci(id_stu,nis,nisn,nam_stu,jk,tgl_lhr,id_kls,id_bio_stu) VALUES (:id_stu,:nis,:nisn,:nmmrd,:jk,:ttl,:kls,:id_bio);
										INSERT INTO user_school(iduser,username,fullname,password,email,level,gambar_p) VALUES (:id_bio,:nis,:nmmrd,:pass,:id_bio,:ortu,:student_photo);
										INSERT INTO bio_studen_ci(id_stu_bio,stu_photo) VALUES (:id_bio,:student_photo);
										COMMIT;");
			$setcl->bindparam(":id_stu",$id_stu);
			$setcl->bindparam(":id_bio",$id_bio);
			$setcl->bindparam(":nmmrd",$nmmrd);
			$setcl->bindparam(":nis",$nis);
			$setcl->bindparam(":pass",$pass);
			$setcl->bindparam(":nisn",$nisn);
			$setcl->bindparam(":jk",$jk);
			$setcl->bindparam(":kls",$kls);
			$setcl->bindparam(":ttl",$ttl);
			$setcl->bindparam(":jk",$jk);
			$setcl->bindparam(":ortu",$ortu);
			$setcl->bindparam(":student_photo",$ustu);
			#$setcl->bindValue(':null', null, PDO::PARAM_NULL);
			$setcl->execute();
			return true;
		}
		catch (PDOException $e)
		{
			echo $e->getMessage();
			return false;
		}
	}

	public function s_porto1($judul,$upload,$isi)
	{
		try
		{
			$vardiv4 = "PORTO";
			$todaydiv4 = date("ymd");
			$randdiv4 = strtoupper(substr(uniqid(sha1(time())),0,4));
			$idporto= $vardiv4. $todaydiv4 .$randdiv4;

			$ket = 1;

			$setcl = $this->db->prepare("INSERT INTO porto_ci (id_porto,judul,isi,photo,ket) VALUES (:idporto,:judul,:isi,:upload,:ket)");
			$setcl->bindparam(":idporto",$idporto);
			$setcl->bindparam(":judul",$judul);
			$setcl->bindparam(":upload",$upload);
			$setcl->bindparam(":isi",$isi);
			$setcl->bindparam(":ket",$ket);
			
			$setcl->execute();
		return true;
		}
		catch (PDOException $e)
		{
			echo $e->getMessage();
			return false;
		}
	}

	public function s_porto2($judul,$upload,$isi)
	{
		try
		{
			$vardiv4 = "PORTO";
			$todaydiv4 = date("ymd");
			$randdiv4 = strtoupper(substr(uniqid(sha1(time())),0,4));
			$idporto= $vardiv4. $todaydiv4 .$randdiv4;

			$ket = 2;

			$setcl = $this->db->prepare("INSERT INTO porto_ci (id_porto,judul,isi,photo,ket) VALUES (:idporto,:judul,:isi,:upload,:ket)");
			$setcl->bindparam(":idporto",$idporto);
			$setcl->bindparam(":judul",$judul);
			$setcl->bindparam(":upload",$upload);
			$setcl->bindparam(":isi",$isi);
			$setcl->bindparam(":ket",$ket);
			
			$setcl->execute();
		return true;
		}
		catch (PDOException $e)
		{
			echo $e->getMessage();
			return false;
		}
	}

	public function inexp($nip,$namins,$tglawal,$tglakhir,$lpos,$alasan)
	{
		try
		{
			$vardiv4 = "EXP-TCH";
			$todaydiv4 = date("ymd");
			$randdiv4 = strtoupper(substr(uniqid(sha1(time())),0,4));
			$id_exp= $vardiv4. $todaydiv4 .$randdiv4;

			$setcl = $this->db->prepare("INSERT INTO exper_teach_ci (id_exp,exp_work_plc,exp_work_year_f,exp_work_year_e,exp_last_grade,exp_out_cause,nip) VALUES (:id_exp,:namins,:tglawal,:tglakhir,:lpos,:alasan,:nip)");
			$setcl->bindparam(":nip",$nip);
			$setcl->bindparam(":id_exp",$id_exp);
			$setcl->bindparam(":namins",$namins);
			$setcl->bindparam(":tglawal",$tglawal);
			$setcl->bindparam(":tglakhir",$tglakhir);
			$setcl->bindparam(":lpos",$lpos);
			$setcl->bindparam(":alasan",$alasan);
			
			$setcl->execute();
		return true;
		}
		catch (PDOException $e)
		{
			echo $e->getMessage();
			return false;
		}
	}

	public function inedu($nip,$namins,$tglawal,$tglakhir,$grade,$jurusan,$ipk)
	{
		try
		{
			$vardiv4 = "EDU-TCH";
			$todaydiv4 = date("ymd");
			$randdiv4 = strtoupper(substr(uniqid(sha1(time())),0,4));
			$id_edu= $vardiv4. $todaydiv4 .$randdiv4;

			$setcl = $this->db->prepare("INSERT INTO edu_teach_ci (id_edu,edu_plc,edu_start,edu_end,edu_type,edu_major,edu_cgpa,nip) VALUES (:id_edu,:namins,:tglawal,:tglakhir,:grade,:jurusan,:ipk,:nip)");
			$setcl->bindparam(":nip",$nip);
			$setcl->bindparam(":id_edu",$id_edu);
			$setcl->bindparam(":namins",$namins);
			$setcl->bindparam(":tglawal",$tglawal);
			$setcl->bindparam(":tglakhir",$tglakhir);
			$setcl->bindparam(":grade",$grade);
			$setcl->bindparam(":jurusan",$jurusan);
			$setcl->bindparam(":ipk",$ipk);
			
			$setcl->execute();
		return true;
		}
		catch (PDOException $e)
		{
			echo $e->getMessage();
			return false;
		}
	}

	public function addregteach($id,$guru,$matpel,$kelas,$nip)
	{
		try
		{
			$setcl = $this->db->prepare("INSERT INTO reg_teach_ci(id_reg,id_guru,nip,id_matpel,id_kls) VALUES(:id_reg,:id_guru,:nip,:id_matpel,:id_kls)");
			$setcl->bindparam(":id_reg",$id);
			$setcl->bindparam(":id_guru",$guru);
			$setcl->bindparam(":nip",$nip);
			$setcl->bindparam(":id_matpel",$matpel);
			$setcl->bindparam(":id_kls",$kelas);
			
			
			$setcl->execute();
		return true;
		}
		catch (PDOException $e)
		{
			echo $e->getMessage();
			return false;
		}
	}

	public function addjad($id_sch,$time,$tglf,$tgle,$day,$now,$int,$colkls,$kls,$tipe,$ket)
	{
		try
		{
			

			$setcl = $this->db->prepare("INSERT INTO schedule_teach_ci (id_jadwal,jam,jad_start,jad_end,jad_day,tgl_input,interfal,id_kls,kls,tipe_jadwal,ket) VALUES(:id_sch,:time,:tglf,:tgle,:day,:now,:inte,:colkls,:kls1,:tipe,:ket)");
			$setcl->bindparam(":id_sch",$id_sch);
			$setcl->bindparam(":time",$time);
			$setcl->bindparam(":tglf",$tglf);
			$setcl->bindparam(":tgle",$tgle);
			$setcl->bindparam(":day",$day);
			$setcl->bindparam(":now",$now);
			$setcl->bindparam(":inte",$int);
			$setcl->bindparam(":colkls",$colkls);
			$setcl->bindparam(":kls1",$kls);
			$setcl->bindparam(":tipe",$tipe);
			$setcl->bindparam(":ket",$ket);
			$setcl->execute();
		return true;
		}
		catch (PDOException $e)
		{
			echo $e->getMessage();
			return false;
		}
	}
//THIS IS DELETE CLASS

	public function delcls($cid)
	{
		try {
			$setcl = $this->db->prepare("DELETE from class_ci WHERE id_kls=:id_kls");
			$setcl->bindparam(":id_kls",$cid);
			$setcl->execute();

			return $setcl;
		} 
		catch (PDOException $e) {
			echo $e->getMessage();
		}
	}

	public function delmatpel($nid)
	{
		try {
			$setcl = $this->db->prepare("BEGIN;
										 DELETE from matpel_ci WHERE id_matpel=:id_matpel;
										 DELETE from reg_teach_ci WHERE id_matpel=:id_matpel;
										 COMMIT;");
			$setcl->bindparam(":id_matpel",$nid);
			$setcl->execute();

			return $setcl;
		} 
		catch (PDOException $e) {
			echo $e->getMessage();
		}
	}


	public function deltch($tid,$idreg)
	{
		try {
			$setcl = $this->db->prepare("BEGIN;
										 DELETE from teacher_ci WHERE nip=:id_guru;
										 DELETE from reg_teach_ci WHERE nip=:id_guru;
										 DELETE from user_school WHERE username=:id_guru;
										 DELETE from bio_teach_ci WHERE nip=:id_guru;
										 DELETE from exper_teach_ci WHERE nip =:id_guru;
										 DELETE from schedule_teach_ci WHERE kls =:idreg;
										 COMMIT;");
			$setcl->bindparam(":id_guru",$tid);
			$setcl->bindparam(":idreg",$idreg);
			$setcl->execute();

			return $setcl;
		} 
		catch (PDOException $e) {
			echo $e->getMessage();
		}
	}


	public function addecls($id,$kode,$grade,$nmkls,$kapkls,$wlkls)
	{
		try
		{			
			$setcl = $this->db->prepare("UPDATE class_ci SET  kd_kls=:kode , nm_kls=:nmkls , grade_kls = :grade , cap_class = :kapkls , id_guru = :wlkls WHERE id_kls = :id_kls");
			$setcl->bindparam(":id_kls",$id);
			$setcl->bindparam(":kode",$kode);
			$setcl->bindparam(":nmkls",$nmkls);
			$setcl->bindparam(":grade",$grade);
			$setcl->bindparam(":kapkls",$kapkls);
			$setcl->bindparam(":wlkls",$wlkls);
			$setcl->execute();
			return true;
		}
		catch (PDOException $e)
		{
			echo $e->getMessage();
			return false;
		}
	}

	

	public function addetch($id,$nmguru,$nuptk,$nip,$jkel,$ttl,$img)
	{
		try
		{			
			$pass = password_hash($ttl, PASSWORD_DEFAULT);
			$setcl = $this->db->prepare("BEGIN;
										 UPDATE teacher_ci SET nip = :nip ,nuptk = :nuptk ,nama = :nmguru , ttl = :ttl , jk = :jkel , teach_photo = :img WHERE nip = :id;
										 UPDATE user_school SET username = :nip, fullname = :nmguru, password = :pass WHERE username = :id;
										 UPDATE bio_teach_ci SET nip = :nip , nuptk = :nuptk , nama = :nmguru , ttl = :ttl, jk = :jkel WHERE nip = :id;
										 COMMIT;");
			$setcl->bindparam(":id",$id);
			$setcl->bindparam(":pass",$pass);
			$setcl->bindparam(":nmguru",$nmguru);
			$setcl->bindparam(":nuptk",$nuptk);
			$setcl->bindparam(":nip",$nip);
			$setcl->bindparam(":jkel",$jkel);
			$setcl->bindparam(":ttl",$ttl);
			$setcl->bindparam(":img",$img);
			$setcl->execute();
			return true;
		}
		catch (PDOException $e)
		{
			echo $e->getMessage();
			return false;
		}
	}

	public function upbio($nip,$alamat,$agama,$hp,$nikah)
	{
		try
		{
			$setcl = $this->db->prepare("UPDATE bio_teach_ci SET alamat=:alamat, agama=:agama, status_k=:nikah, telp=:hp WHERE nip=:nip");
			$setcl->bindparam(":nip",$nip);
			$setcl->bindparam(":alamat",$alamat);
			$setcl->bindparam(":agama",$agama);
			$setcl->bindparam(":hp",$hp);
			$setcl->bindparam(":nikah",$nikah);
			$setcl->execute();
		return true;
		}
		catch (PDOException $e)
		{
			echo $e->getMessage();
			return false;
		}
	}

	public function upbiostu($temp_lhr,$agama,$kwrg,$anakke,$jumsau,$bahasa,$statanak,$alamat,$telp,$tgldg,$jarak,$trans,$goldrh,$disease,$tinggi,$berat,$id)
	{
		try
		{
			$setcl = $this->db->prepare("UPDATE bio_studen_ci SET 
										 tmp_lahir = :temp_lhr,
										 agama = :agama,
										 kwrga = :kwrg,
										 anak_ke = :anakke,
										 sdr_anak = :jumsau,
										 bhs = :bahasa,
										 stat_anak = :statanak,
										 alamat = :alamat,
										 telp = :telp,
										 stay_with = :tgldg,
										 jrk_sklh = :jarak,
										 transport = :trans,
										 gol_drh = :goldrh,
										 disease = :disease,
										 tinggi = :tinggi,
										 berat = :berat
										 WHERE id_stu_bio=:id");
			
			$setcl->bindparam(":temp_lhr",$temp_lhr);
			$setcl->bindparam(":agama",$agama);
			$setcl->bindparam(":kwrg",$kwrg);
			$setcl->bindparam(":anakke",$anakke);
			$setcl->bindparam(":jumsau",$jumsau);
			$setcl->bindparam(":bahasa",$bahasa);
			$setcl->bindparam(":statanak",$statanak);
			$setcl->bindparam(":alamat",$alamat);
			$setcl->bindparam(":telp",$telp);
			$setcl->bindparam(":tgldg",$tgldg);
			$setcl->bindparam(":jarak",$jarak);
			$setcl->bindparam(":trans",$trans);
			$setcl->bindparam(":goldrh",$goldrh);
			$setcl->bindparam(":disease",$disease);
			$setcl->bindparam(":tinggi",$tinggi);
			$setcl->bindparam(":berat",$berat);
			$setcl->bindparam(":id",$id);
			$setcl->execute();
		return true;
		}
		catch (PDOException $e)
		{
			echo $e->getMessage();
			return false;
		}
	}

	public function upoto($nip,$target_file)
	{
		try
		{
			$setcl = $this->db->prepare("BEGIN;
									     UPDATE bio_teach_ci SET teach_photo=:poto WHERE nip=:nip;
									     UPDATE teacher_ci SET teach_photo=:poto WHERE nip=:nip;
									     UPDATE user_school SET gambar_p=:poto WHERE username=:nip;
									     COMMIT;");
			$setcl->bindparam(":nip",$nip);
			$setcl->bindparam(":poto",$target_file);
			
			$setcl->execute();
		return true;
		}
		catch (PDOException $e)
		{
			echo $e->getMessage();
			return false;
		}
	}

	public function upoto2($id,$nis,$target_file)
	{
		try
		{
			$setcl = $this->db->prepare("BEGIN;
									     UPDATE bio_studen_ci SET stu_photo=:poto WHERE id_stu_bio=:id;
									     UPDATE user_school SET gambar_p=:poto WHERE username=:nis;
									     COMMIT;");
			$setcl->bindparam(":id",$id);
			$setcl->bindparam(":nis",$nis);
			$setcl->bindparam(":poto",$target_file);
			
			$setcl->execute();
		return true;
		}
		catch (PDOException $e)
		{
			echo $e->getMessage();
			return false;
		}
	}

	public function upregteach($id,$kls,$matpel)
	{
		try
		{
			$setcl = $this->db->prepare("UPDATE reg_teach_ci SET id_matpel = :id_matpel, id_kls = :id_kls WHERE id_reg = :id");
			$setcl->bindparam(":id_matpel", $matpel);
			$setcl->bindparam(":id_kls",$kls);
			$setcl->bindparam(":id",$id);

			$setcl->execute();
		return true;
		}
		catch (PDOException $e)
		{
			echo $e->getMessage();
			return false;
		}
	}
}
 ?>