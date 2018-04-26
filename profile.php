<!DOCTYPE html>
<html lang="en">
<head>
	<title>MeetJahit</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" href="images/favicon.ico">
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!--Import materialize.css-->
    <link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>
	<link href="https://fonts.googleapis.com/css?family=Raleway:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Lora:400,400i,700,700i" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Amatic+SC" rel="stylesheet"> 
	<link href="https://fonts.googleapis.com/css?family=Raleway+Dots" rel="stylesheet"> 
</head>

<body background="img/bg.jpg" style="background-size:cover; opacity:1">
	<!--Import jQuery before materialize.js-->
	<script type="text/javascript" src="js/jquery-3.2.1.min.js"></script>
    <script type="text/javascript" src="js/materialize.min.js"></script>
	<script>
		  $(document).ready(function(){
			// the "href" attribute of the modal trigger must specify the modal ID that wants to be triggered
			$('.modal').modal();

			});
			
		   $('#photo').modal('close');
		   $('.modal').modal({
			  dismissible: true, // Modal can be dismissed by clicking outside of the modal
			  opacity: .5, // Opacity of modal background
			  inDuration: 300, // Transition in duration
			  outDuration: 200, // Transition out duration
			  startingTop: '4%', // Starting top style attribute
			  endingTop: '4%', // Ending top style attribute
			  ready: function(modal, trigger) { // Callback for Modal open. Modal and trigger parameters available.
				alert("Ready");
				console.log(modal, trigger);
			  },
			  complete: function() { alert('Closed'); } // Callback for Modal close			
			}
			
		  );
	</script>
	
	<!--Style untuk tampilan-->
	<style>
		.ts{
			background:#351e16;
			color:white;
		}
		.ts:hover {
			background-color:#351e16;
			color:#d89034;
		}
		#head{
			background-color:#351e16;
			color:white;
		}
		#head:hover{
			color:#d89034;
		}
		#thead{
			background-color:#351e16;
			color:white;
		}
		#thead:hover{
			background-color:#351e16;
			color:#d89034;
		}
		#vdata div{
			background-color: #236B8E; 
			padding: 5px;
		}
		#xdata:hover{
			color:#d89034;
		}
	</style>
	
	<!--FUNGSI PHP untuk mengedit, menghapus, dan menambah data-->
	<?php
		include 'connect.php';
		session_start();
		$idu=$_COOKIE['id'];
		if(isset($_GET['e'])){ //mengedit data
			$nama=$_POST['nama'];
			$username=$_POST['username'];
			$pass=$_POST['password'];
			$email=$_POST['email'];
			
			$queri="UPDATE tb_user set nama='$nama', username='$username', email='$email', password ='$pass' WHERE idu='$idu'";
			$proses=mysqli_query($con,$queri);
			if($proses) header('location:profile.php');
			//echo "<script>Materialize.toast('Data diperbaharui', 1000)</script>;";
		}
		else if(isset($_GET['ava'])){ //mengedit data
			$ava=$_GET['ava'];
			$quer="UPDATE tb_user SET avatar='$ava' WHERE idu='$idu'";
			$pros=mysqli_query($con,$quer);
			if($pros) header('location:profile.php');
			//echo "<script>Materialize.toast('Data diperbaharui', 1000)</script>;";
		}
	?>


	<!--Modal untuk menampilkan pilihan foto-->
	  <div id="photo" class="modal">
		<div class="modal-content">
		  <h5>Pilih Avatar</h5>
		  <?php
			include 'connect.php';
			$i=1;
			for($i=1;$i<9;$i++){
			echo"
			<div class='row col l12'>
				<div class='row col l12' style='text-align:center;'>
					<div class='col l12' style=''>
						<img src='img/tailor/".$i.".png' width='100' height='100' alt=''/>
					</div>
					<div class='col l12'>  
						<a style='margin-top:8px;' href='profile.php?ava=".$i."' class='waves-effect waves-light btn ts';'>Pilih</a>
					</div>
				</div>
			</div>
				
			";
			}
		  ?>
		</div>
		<div class="modal-footer">
		  <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat">Tutup</a>
		</div>
	  </div>
        
	<!--UI Web-->	

			<div class="row col l12 m12 s12" style="background-color: #351e16; margin-right:80px; margin-left:80px;">
				<div class="col l9 m12 s12" style="text-align:left; font-family: 'Raleway Dots', cursive; color:white; font-size:40px; padding:10px; padding-left:100px;">MEETJAHIT</div>
				<a id="head" href="cus.php" class="col l1" style="padding:20px; margin-top:8px; text-align:center; font-size:16px;">HOME</a>
				<a id="head" href="profile.php" class="col l1" style="padding:20px; margin-top:8px; text-align:center; font-size:16px;">PROFILE</a>
				<a id="head" href="index.php" class="col l1" style="padding:20px; margin-top:8px; text-align:center; font-size:16px;">X</a>
			</div >
		
		
			
		<div class="col l12 m12 s12" style="background-color: rgba(104, 73, 50,0.7); margin-top:-20px; margin-left:80px; margin-right:80px; padding:20px; text-align:center;">
			<div class="col l12 m12 s12" style=" margin-left:160px; opacity:1; font-size: 24px; font-family: 'Raleway'; color:white; text-align:left;">PROFIL ANDA</div>
			<?php
			//padding-left:488px; padding-right:360px; 
			include 'connect.php';
			$idu=$_COOKIE['id'];
			$que="SELECT * FROM tb_user WHERE idu='".$idu."'";
			$procc=mysqli_query($con,$que);
			while ($dat = mysqli_fetch_array ($procc)){
				$ava=$dat['avatar'];
				echo"
				<form id='form' class='row col l12' action='profile.php?e=1' method='post' 
				style='background-color:rgba(216, 144, 52, 0.6); margin-left:160px; margin-right:160px; padding:40px;'>
						<div style='padding-left:360px; padding-right:360px;'>
							<div class='row col l12' style='text-align:center;  background-color:transparent; padding-top:16px; border:0px white solid;'>
								<div class='row col l12' style='text-align:center;'>
									<img src='img/tailor/".$ava.".png' width='120' height='120' alt=''/>
								</div>
								<div class='row col l12' style='text-align:center; margin-top:-48px; padding-left:88px; padding-right:24px;'>
									<a  href='#photo' class='col l12 btn ts modal-trigger' style='border:1px white solid; background-color:rgba(255,255,255,0.5);'><i class='material-icons'>photo_camera</i></a>
								</div>
							</div>
						</div>
						<div class='row col l12' style=''>
							  <div class='input-field col l12' style='color: white; text-align: left;'>Username
								<input placeholder='Username' label='username' value='".$dat['username']."' name='username' type='text' style='background:transparent;' required>
							  </div>
							  <div class='input-field col l12' style='color: white; text-align: left;'>Nama
								<input placeholder='Nama' value='".$dat['nama']."' name='nama' type='text' style='background:transparent;' required>
							  </div>
							  <div class='input-field col l12' style='color: white; text-align: left;'>Email
								<input placeholder='Email' value='".$dat['email']."' name='email' type='text' style='background:transparent;' required>
							  </div>
							  <div class='input-field col l12' style='color: white; text-align: left;'>Kata sandi
								<input placeholder='Password' value='".$dat['password']."' name='password' type='password' style='background:transparent;' required>
							  </div>
							 
						</div>
							 
						<div class='row col l12 m12 s12' style='text-allign:left;'>
							
							<div class='col l12' style=''>
								<input class='waves-effect waves-light btn ts' style='border:1px white solid;' type='submit' size='6' value='Simpan'>
							</div>
							
							
						</div>
						
				</form>
				";
			}
			
			?>
			
		
		</div>
		

</body>
</html>

