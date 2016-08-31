<!--
Author: W3layouts
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<?php
ob_start();
?>
<!DOCTYPE HTML>
<html>
	<head>
		<title>SDIT Citra Insani</title>
		<link href="../style/css/bootstrap.css" rel='stylesheet' type='text/css' />
		<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
		<script src="../style/js/jquery.min.js"></script>
		<script src="../style/js/bootstrap.min.js"></script>
		 <!-- Custom Theme files -->
		 <!---- animated-css ---->
		<link href="../style/css/animate.css" rel="stylesheet" type="text/css" media="all">
		<script src="../style/js/wow.min.js"></script>
		<script>
		 new WOW().init();
		</script>
		<!---- animated-css ---->
		  <!---- start-smoth-scrolling---->
		<link rel="stylesheet" type="text/css" href="../style/css/styleslide.css" />
		<script src="../style/js/modernizr.custom.63321.js"></script>
		<script type="text/javascript" src="../style/js/move-top.js"></script>
		<script type="text/javascript" src="../style/js/easing.js"></script>
		<script type="text/javascript" src="../style/js/jquery.bxslider.js"></script>
		<link href="../style/css/jquery.bxslider.css" rel="stylesheet" type="text/css" media="all">
		<script type="text/javascript">
			jQuery(document).ready(function($) {
				$(".scroll").click(function(event){		
					event.preventDefault();
					$('html,body').animate({scrollTop:$(this.hash).offset().top},1000);
				});
			});
		</script>

		 <!---- start-smoth-scrolling---->
		<link href="../style/css/style.css" rel='stylesheet' type='text/css' />

   		 <!-- Custom Theme files -->
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
		</script>
		<!----webfonts--->
		<link href='http://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
		<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700,800' rel='stylesheet' type='text/css'>
		<!---//webfonts--->
		<!----start-top-nav-script---->
		<script>
			$(function() {
				var pull 		= $('#pull');
					menu 		= $('nav ul');
					menuHeight	= menu.height();
				$(pull).on('click', function(e) {
					e.preventDefault();
					menu.slideToggle();
				});
				$(window).resize(function(){
	        		var w = $(window).width();
	        		if(w > 320 && menu.is(':hidden')) {
	        			menu.removeAttr('style');
	        		}
	    		});
			});
		</script>
		<script type="text/javascript">
				$(document).ready(function(){
				  $('.slider1').bxSlider({
				    slideWidth: 450,
				    minSlides: 1,
				    maxSlides: 4,
				    slideMargin: 10,
				    auto: true,
  					autoControls: true
				  });
				});
				$(document).ready(function(){
				  $('.slider2').bxSlider({
				    slideWidth: 1400,
				    minSlides: 1,
				    maxSlides: 1,
				    slideMargin: 10,
				    auto: false,
  					autoControls: true
				  });
				});
			</script>

		<script type="text/javascript">
									$(document).ready(function() {
										/*
										var defaults = {
								  			containerID: 'toTop', // fading element id
											containerHoverID: 'toTopHover', // fading element hover id
											scrollSpeed: 1200,
											easingType: 'linear' 
								 		};
										*/
										
										$().UItoTop({ easingType: 'easeOutQuart' });
										
									});
								</script>
		<!----//End-top-nav-script---->
	</head>
	<body>
		<!----- start-header---->
			<div class="bg">
			<div id="home" class="header wow bounceInDown" data-wow-delay="0.4s">
					<div class="top-header">
						<div class="container">
						<div class="logo">
							<a href="#"><img src="../style/images/logo.jpg" title="dreams" /></a>
						</div>
						<!----start-top-nav---->
						 <nav class="top-nav">
							<ul class="top-nav">
								<li><a href="#home" class="scroll">Home</a></li>
								<li><a href="#port" class="scroll">Portfolio</a></li>
								<li><a href="#team" class="scroll">Team</a></li>
								<li><a href="#contact" class="scroll">Contact</a></li>

								<?php 
								include_once '../lib/cl.user.php';
								if($user->is_loggedin()!="")
								{
									$user_id = $_SESSION['user_session'];
									$stmt = $DB_connect->prepare("SELECT * FROM user_school WHERE iduser=:user_id");
									$stmt->execute(array(":user_id"=>$user_id));
									$userRow=$stmt->fetch(PDO::FETCH_ASSOC);
										if ($userRow['level']=='Admin' || $userRow['level']=='Guru' || $userRow['level']=='wl_kls' || $userRow['level'] == 'Ortu') {
								?>
								<li><a href="#services" class="scroll">Panel</a></li>
								<?php }}
								else{
								 ?>
								 <li><a href="#services" class="scroll">Login</a></li>
								 <?php 
								 	}
								 
								  ?>
							</ul>
							<a href="#" id="pull"><img src="../style/images/menu-icon.png" title="menu" /></a>
						</nav>
						<div class="clearfix"> </div>
					</div>
				</div>
			<!----- //End-header---->
			<!---- banner ---->
			<div class="banner wow fadeIn" data-wow-delay="0.5s">
				<div class="container">
					<div class="banner-info text-center">
						<h1>Selamat datang</h1><br />
						<span> </span>
						<p>di Web SDIT Citra Insani</p>
						<p>Silahkan akses informasi pilihan anda dibawah</p>
					</div>
				</div>
			</div>
		</div>
		</div>
		</div><!-- /container -->
		
		<script type="text/javascript" src="../style/js/jquery.stackslider.js"></script>
		<script type="text/javascript">
			
			$( function() {
				
				$( '#st-stack' ).stackslider();

			});

		</script>

		<?php 
			 $setcl3 = $DB_connect->prepare("SELECT * FROM konten_web_act_photo");
		    $setcl3->execute();
		    $respto = $setcl3->fetchAll(PDO::FETCH_ASSOC);
		 ?>
		<div id="slide" class="services">
			<div class="service-head text-center">
							<h2>Koleksi Foto Kegiatan</h2>
							<span> </span>
			</div>
			<div class="container">
			<section class="main">
				<ul id="st-stack" class="st-stack-raw">
				<?php foreach ($respto as $respto) {?>
					<li><div class="st-item fancybox"><img src="<?php echo $respto['poto']; ?>" style="height: 350px; width:250px;"/></div><div class="st-title"><h2><?php echo $respto['nampoto']; ?></h2><h3><?php echo $respto['ket']; ?></h3></div></li>
				<?php } ?>
				</ul>
				<p>Tip: to see a continuous flow, keep your mouse pressed on the navigation arrows.</p>
			</section>
			</div>
		</div>	
			<!-- services -->
			
					<!-- services-grids -->
					<?php 
					include_once '../lib/cl.user.php';
					if($user->is_loggedin()!="")
					{
						$user_id = $_SESSION['user_session'];
						$stmt = $DB_connect->prepare("SELECT * FROM user_school WHERE iduser=:user_id");
						$stmt->execute(array(":user_id"=>$user_id));
						$userRow=$stmt->fetch(PDO::FETCH_ASSOC);
							if ($userRow['level']=='Admin') {
					?>
							<div id="services" class="services">
							<div class="container">
								<div class="service-head text-center">
									<h2>Welcome <?php echo $userRow['username']; ?></h2>
									<span> </span>
								</div>
								<div class="services-grids text-center">
										<a href="../admin"><div class="service-grid wow bounceIn" data-wow-delay="0.4s">
											<span class="service-icon1"> </span>
											<h3><a href="../admin">Masuk Panel Admin</a></h3>
											<p>Pilih untuk masuk ke panel admin</p>
										</a>
									</div>
							</div>
							</div>
					<?php     
							}
							elseif ($userRow['level']=='Guru' || $userRow['level']=='wl_kls')
							{
					?>
							<div id="services" class="services">
							<div class="container">
								<div class="service-head text-center">
									<h2>Welcome <?php echo $userRow['fullname']; ?></h2>
									<span> </span>
								</div>
								<div class="services-grids text-center">
										<a href="../guru"><div class="service-grid wow bounceIn" data-wow-delay="0.4s">
											<span class="service-icon1"> </span>
											<h3><a href="../guru">Masuk Panel Guru</a></h3>
											<p>Pilih untuk masuk ke panel Guru</p>
										</a>
									</div>
							</div>
							</div>

					<?php     
							}
							elseif ($userRow['level']=='Ortu')
							{
					?>
							<div id="services" class="services">
							<div class="container">
								<div class="service-head text-center">
									<h2>Welcome Orang Tua <?php echo $userRow['fullname']; ?></h2>
									<span> </span>
								</div>
								<div class="services-grids text-center">
										<a href="../orang-tua"><div class="service-grid wow bounceIn" data-wow-delay="0.4s">
											<span class="service-icon1"> </span>
											<h3><a href="../orang-tua">Masuk Panel Orang Tua</a></h3>
											<p>Pilih untuk masuk ke panel Orang Tua</p>
										</a>
									</div>
							</div>
							</div>
					<?php 
							}
						}
					else{
					?>
					<div id="services" class="services">
					<div class="container">
						<div class="service-head text-center">
							<h2>Login</h2>
							<span> </span>
						</div>
						<div class="services-grids text-center">
							<div class="col-md-12">
								<a href="../login"><div class="service-grid wow bounceIn" data-wow-delay="0.4s">
									<span class="service-icon1"> </span>
									<h3><a href="../login">Login</a></h3>
									<p>Silahkan Login disini</p>
								</div></a>
							</div>							
							<div class="clearfix"> </div>
						</div>
						<?php 
							}

						 ?>
					<!-- services-grids -->
				</div>
			</div>
			<!-- services -->
			<div class="clearfix"> </div>
			<!-- Other Expertise -->

			<?php 
				$setcl3 = $DB_connect->prepare("SELECT * FROM porto_ci WHERE ket = 1");
			    $setcl3->execute();
			    $respor1 = $setcl3->fetchAll(PDO::FETCH_ASSOC);
		 	?>
		 	<div class="slider2">
		 	<?php foreach ($respor1 as $respor1) { ?>
			<div id="port" class="expertise">
				<div class="expertice-grids">
				
					<div class="col-md-7 expertice-left-grid wow fadeInLeft" data-wow-delay="0.4s">
						<div class="expertise-head">
							<h3><?php echo $respor1['judul']; ?></h3>
						</div>
						<div class="expertise-left-inner-grids">
									<p><?php echo $respor1['isi']; ?></p>
								
						</div>
						
					</div>
					<div class="col-md-5 expertice-right-grid wow fadeInRight" data-wow-delay="0.4s">
						<img src="<?php echo $respor1['photo']; ?>" style="height:680px;">
					</div>
					<div class="clearfix"> </div> 
				</div>
				
			</div>
			<?php } ?>
			</div>
			<!--- Other Expertise ---->
			<!--- portfolio ---->
			<?php 
				$setcl3 = $DB_connect->prepare("SELECT * FROM porto_ci WHERE ket = 2");
			    $setcl3->execute();
			    $respor1 = $setcl3->fetchAll(PDO::FETCH_ASSOC);
		 	?>
		 	<div class="portfolio slider2">
		 	<?php foreach ($respor1 as $respor1) { ?>
			<div id="port" class="expertise">
				<div class="expertice-grids">
				
					<div class="col-md-7 expertice-left-grid wow fadeInLeft" data-wow-delay="0.4s">
						<div class="expertise-head">
							<h3><?php echo $respor1['judul']; ?></h3>
						</div>
						<div class="expertise-left-inner-grids">
									<p><?php echo $respor1['isi']; ?></p>
								
						</div>
						
					</div>
					<div class="col-md-5 expertice-right-grid wow fadeInRight" data-wow-delay="0.4s">
						<img src="<?php echo $respor1['photo']; ?>" style="height:680px;">
					</div>
					<div class="clearfix"> </div> 
				</div>
				
			</div>
			<?php } ?>
			</div>
			<div class="portfolio">
				<div class="portfolio-top">
					<div class="col-md-8">
						<div class="portfolio-top-left wow fadeInLeft" data-wow-delay="0.4s">
							<h3>Portfolio</h3>
							<p>Proin iaculis purus consequat sem cure digni ssim. Donec porttitora entum suscipit aenean rhoncus posuere odio in tincidunt. Proin iaculis purus consequat sem cure digni ssim. Donec porttitora entum suscipit.</p>
							<p>Iaculis purus consequat sem cure digni ssim. Donec porttitora entum suscipit aenean rhoncus posuere odio in tincidunt. Proin iaculis purus consequat.</p>
							<div class="portfolio-top-left-grids">
								<div class="portfolio-top-left-grid">
									<div class="portfolio-top-left-grid-left">
										<span class="p-icon1"> </span>
									</div>
									<div class="portfolio-top-left-grid-right">
										<h5>Sail Away Your Worries</h5>
										<p>Proin iaculis purus consequat sem cure digni ssim. Donec porttitora entum suscipit aenean rhoncus posuere odio in tincidunt. </p>
									</div>
									<div class="clearfix"> </div>
								</div>
								<div class="portfolio-top-left-grid">
									<div class="portfolio-top-left-grid-left">
										<span class="p-icon2"> </span>
									</div>
									<div class="portfolio-top-left-grid-right">
										<h5>All-star support team</h5>
										<p>Proin iaculis purus consequat sem cure digni ssim. Donec porttitora entum suscipit aenean rhoncus posuere odio in tincidunt. </p>
									</div>
									<div class="clearfix"> </div>
								</div>
								<div class="portfolio-top-left-grid">
									<div class="portfolio-top-left-grid-left">
										<span class="p-icon3"> </span>
									</div>
									<div class="portfolio-top-left-grid-right">
										<h5>fully Integrated service</h5>
										<p>Proin iaculis purus consequat sem cure digni ssim. Donec porttitora entum suscipit aenean rhoncus posuere odio in tincidunt. </p>
									</div>
									<div class="clearfix"> </div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-4 portfolio-top-right-inner wow fadeInRight" data-wow-delay="0.4s">
						<div class="portfolio-top-right">
							
						</div>
					</div>
					<div class="clearfix"> </div>
					<!---- portfolio-works ---->
					<?php 
			            $setcl3 = $DB_connect->prepare("SELECT * FROM news_ci WHERE tipe = '1' ORDER BY date_create");
			            $setcl3->execute();
			            $resnews = $setcl3->fetchAll(PDO::FETCH_ASSOC);
			         ?>
					<div class="portfolio-works">
							<div class="service-head text-center">
									<h2>Berita</h2>
									<span> </span>
								</div>
					<?php foreach ($resnews as $resnews) {
						$string = strip_tags($resnews['content_news']);
                        if (strlen($string) > 100) {

                            // truncate string
                            $stringCut = substr($string, 0, 100);

                            // make sure it ends in a word so assassinate doesn't become ass...
                            $string2 = substr($stringCut, 0, strrpos($stringCut, ' ')).'... <a href="#" data-toggle="modal" data-target="#myModal'.$resnews['id_news'].'">Read More</a>'; 
                        }
					?>
						<div class="col-md-4 portfolio-work-grid wow bounceIn" data-wow-delay="0.4s">
							<div class="portfolio-work-grid-pic">
								<img src="<?php echo $resnews['photo']; ?>" title="name" style="height:450px;width:450px;"/>
							</div>
							<div class="portfolio-work-grid-caption">
								<h4><?php echo $resnews['title']; ?></h4>
								<p><?php echo $string2; ?></p>
							</div>
						</div>

						<div id="myModal<?php echo $resnews['id_news']; ?>" class="modal fade" role="dialog">
						  	<div class="modal-dialog">

						    <!-- Modal content-->
						    <div class="modal-content">
						      	<div class="modal-header">
						        	<button type="button" class="close" data-dismiss="modal">&times;</button>
						        	<h1 class="modal-title"><?php echo $resnews['title']; ?></h1>
						      	</div>
						      	<div class="modal-body">
						      		<img src="<?php echo $resnews['photo']; ?>" title="name" style="height:500px;width:500px;"/>
						      		<div class="service-head text-center">
						      			<span> </span>
						      		</div>
						      		<br>
						        	<p><?php echo $resnews['content_news']; ?></p>
						        	<br>
						        	<p>Author : <?php echo $resnews['author']; ?></p>
						      	</div>
						      	<div class="modal-footer">
						        	<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						      	</div>
						    </div>

						  </div>
						</div>
					<?php } ?>
						
						<div class="clearfix"> </div>
					</div>
					<!---- portfolio-works ---->
				</div>
			</div>
			<!--- portfolio ---->
			<!---- about ---->
			
			<!-- team -->

			<?php 
			    $setcl = $DB_connect->prepare("SELECT * FROM teacher_ci");
			    $setcl->execute();
			    $resteacher = $setcl->fetchall(PDO::FETCH_ASSOC); 
			    
			?>
			
			<div id="team" class="team-members">
					<div class="wrap"> 
						<div class="tm-head">
							<h3>Pengajar Sekolah Kami</h3>
							<p>Proin iaculis purus consequat sem cure.</p>
						</div>
						
						<div class="tm-head-grids slider1">	
						<?php foreach ($resteacher as $resteacher) {?>					
							<div class="slide tm-head-grid wow fadeInLeft" data-wow-delay="0.4s">
								<img src="<?php echo $resteacher['teach_photo']; ?>" alt="" style="height: 150px; width:150px; right:0;">
								<h4><?php echo $resteacher['nama'] ?></h4>
								<h5>Guru</h5>
								<ul class="top-social-icons">
									<li><a class="twitter" href="#"> </a></li>
									<li><a class="facebook" href="#"> </a></li>
									<li><a class="pin" href="#"> </a></li>
									<div class="clear"> </div>
								</ul>
							</div>	
							<div class="clearfix"> </div>
						<?php } ?>						
							
							 
						</div>
						
						<p class="team-info">Proin iaculis purus consequat sem cure  digni ssim donec porttitora entum suscipit aenean rhoncus posuere odio in tincidunt proin iaculis.</p>
					</div>
				</div>
			<!-- team -->
			<!-- contact -->
			<div id="contact" class="contact">
				<div class="container">
				<div class="contact-grids">
					<div class="col-md-7">
						<div class="contact-left wow fadeInRight" data-wow-delay="0.4s">
							<h3>Contact Us</h3>
							<label>Don't be shy, drop us an email and say hello! We are a really nice bunch of people :)</label>
							<div class="contact-left-grids">
								<div class="col-md-6">
									<div class="contact-left-grid">
										<p><span class="c-mobi"> </span>(021) 2928-2917</p>
										<p><span class="c-twitter"> </span><a href="#">@sdit.insani</a></p>
									</div>
								</div>
								<div class="col-md-6">
									<div class="contact-right-grid">
										<p><span class="c-msg"> </span><a href="mailto:info@sditcitrainsani.sch.id">info@sditcitrainsani.sch.id</a></p>
										<p><span class="c-face"> </span><a href="http://www.facebook.com/sdit.insani">/sdit.insani</a></p>
									</div>
								</div>
								<div class="clearfix"> </div>
							</div>
						</div>
					</div>
					<div class="col-md-4">
						<div class="contact-right wow fadeInLeft" data-wow-delay="0.4s">
							<form method="post">
								<input type="text" class="text" value="Name..." name="name" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Name...';}">
								<input type="text" class="text" value="Title..." name="title" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Title...';}">
					 			<input type="text" class="text" value="Email..." name="email" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Email...';}">
					 	 		<textarea value="Message:" onfocus="this.value = '';" name="isi" onblur="if (this.value == '') {this.value = 'Message';}">Message..</textarea>
								<input class="wow shake" data-wow-delay="0.3s" type="submit" name="submit" value="Send Message" />
							</form>
						</div>
					</div>
					<div class="clearfix"> </div>
				</div>
				<!--- copy-right ---->
				<div class="copy-right text-center">
					<p>SDIT Citra Insani@2016</a></p>
					
									<a href="#" id="toTop" style="display: block;"> <span id="toTopHover" style="opacity: 1;"> </span></a>
				</div>
				<!--- copy-right ---->
			</div>
			</div>
			<!---- contact -->
		</div>
	</body>	
</html>

<?php 
if (isset($_POST['submit'])) {
include '../lib/adm_cl.php';
    
	$sender = $_POST['name'];
	$title = $_POST['title'];
	$isi = $_POST['isi'];
	$to_dest = 'Admin';
	$attach = $_POST['email'];

				$vardiv3 = "MSG";
	            $todaydiv3 = date("ymd");
	            $randdiv3 = strtoupper(substr(uniqid(sha1(time())),0,4));
	            $id_msg= $vardiv3. $todaydiv3 .$randdiv3.$key;

	$syscl->addmsg($id_msg,$title,$isi,$sender,$to_dest,$attach);
	echo"<script>alert('Berhasil Dikirim')</script>";
}
?>
