<?php 
include_once '../config/db_config.php';
$user = new user($DB_connect);
class user
{
	private $db;

	function __construct($DB_connect)
	{
		$this->db = $DB_connect;
	}	

	public function login($uname,$upassword,$umail)
	{
		try 
		{
			$stmt = $this->db->prepare("SELECT * FROM user_school WHERE username=:uname OR email=:umail LIMIT 1");
			$stmt->execute(array(':uname'=>$uname, ':umail'=>$umail));
			$userRow=$stmt->fetch(PDO::FETCH_ASSOC);			
			if($stmt->rowCount() > 0)
			{
				if(password_verify($upassword, $userRow['password']))
				{
					$_SESSION['user_session'] = $userRow['iduser'];
					$_SESSION['level'] = $userRow['iduser'];
					return true;
				}
				else
				{
					return false;
				}
			}

		} 
		catch (PDOException $e) 
		{	
			echo $e->getMessage();
		}
	}
public function is_loggedin()
	{
		if(isset($_SESSION['user_session']))
		{
			return true;
		}
	}
public function checkinlvl()
	{
		if(isset($_SESSION['level']))
		{
			return true;
		}
	}

	public function cekSession(){

		try
		{
			if(isset($_SESSION['id']) && $_SESSION['level'] == "Admin" )
			{
				print 'Selamat, Anda berhasil login sebagai superuser <br/>';
				print '<a href="index.php?logout">Logout</a>';
				return true;
			} 
			else if(isset($_SESSION['id']) && $_SESSION['level'] == "Guru" )
			{
				print 'Selamat, Anda berhasil login sebagai admin <br/>';
				print '<a href="index.php?logout">Logout</a>';
				return true;
			} 
			else
			{
				return false;
			}
		}
		catch (PDOException $e) 
		{
			echo $e->getMessage();
		}
	}

	public function redirect($url)
	{
		header("Location: $url");
	}

	public function getuser($uname)
	{
		try{
		$setcl = $this->db->prepare("SELECT * FROM user_school WHERE username=:uname");
        $setcl->execute(array(':uname'=>$uname));

        return $setcl;
    	}
    	catch (PDOException $e) 
		{
			echo $e->getMessage();
		}
	
	}

	public function regUser($uname,$fullname,$upass2,$umail,$ulevel,$target_file)
	{
		try 
		{
			$new_pass = password_hash($upass2, PASSWORD_DEFAULT);			

			$setcl = $this->db->prepare("INSERT INTO user_school(username,fullname,password,email,level,gambar_p) VALUES(:uname,:fullname,:upass2,:umail,:ulevel,:ugambar)");
			$setcl->bindparam(":uname", $uname);
			$setcl->bindparam(":fullname", $fullname);
			$setcl->bindparam(":upass2", $new_pass);
			$setcl->bindparam(":umail", $umail);
			$setcl->bindparam(":ulevel", $ulevel);
			$setcl->bindparam(":ugambar", $target_file);

			

			$setcl->execute();

			return $setcl;
		}
		catch (PDOException $e) 
		{
			echo $e->getMessage();
		}
	}
	
	public function logout()
	{
		session_destroy();
		unset($_SESSION['user_session']);
		return true;
	}
} ?>
