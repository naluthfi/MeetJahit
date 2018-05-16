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
	
	<script>
		  $(document).ready(function(){
			// the "href" attribute of the modal trigger must specify the modal ID that wants to be triggered
			$('.modal').modal();

			});
			
		   $('#howtopay').modal('close');
		   $('.modal').modal({
			  dismissible: true, // Modal can be dismissed by clicking outside of the modal
			  opacity: .3, // Opacity of modal background
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
	
	<!--FUNGSI PHP untuk mengedit, menghapus, dan menambah data-->
	
	<?php
		include 'connect.php';
		session_start();
		$idu=$_COOKIE['id'];
		if($idu==NULL){
			header('location:login.php');
		}
		
		$idp = $_SESSION['idp'];
		$alamat = $_SESSION['alamat'];
		$kain = $_SESSION['kain'];
		$ukuran = $_SESSION['ukuran'];
		$kategori = $_SESSION['kategori'];
		$jumlah = $_SESSION['jumlah'];
		$desain = $_SESSION['desain'];
		$kode = $_SESSION['kode'];
		$total = $_SESSION['total'];
		
		date_default_timezone_set("Asia/Jakarta"); //Setting your location date
		$date=date("d M Y"); //get the current date for ord
		$add_days = 1;
		$due = date('d M Y',strtotime($date) + (24*3600*$add_days));
		$time=date("H:i");
		
		if($ukuran==1){
			$size="S";
		}
		else if($ukuran==2){
			$size="M";
		}
		else if($ukuran==3){
			$size="L";
		}
		else if($ukuran==4){
			$size="XL";
		}
		else if($ukuran==5){
			$size="XXL";
		}
		else if($ukuran==6){
			$size="XXXL";
		}
		
				
			$quer="SELECT * FROM tb_user WHERE idu='$idp'";
			$pros=mysqli_query($con,$quer);
			while ($dat = mysqli_fetch_array ($pros)){
				$pava=$dat['avatar'];
				$pemail=$dat['email'];
				$puser=$dat['username'];
				$pnama=$dat['nama'];
				$palamat=$dat['alamat'];
				$pkec=$dat['kecamatan'];
				$pcity=$dat['kabupaten'];
				$pprov=$dat['provinsi'];
				$ppos=$dat['kodepos'];
			}
			
			$q="SELECT * FROM order_jahit_".$idp." WHERE kirim='1'";
			$p=mysqli_query($con,$q);
			$row=mysqli_num_rows($p); //banyaknya data (baris table) di database
			$ppesan=0;
			$rating=0;
			while ($d = mysqli_fetch_array ($p)){
				$jml=$d['jumlah'];
				$r=$d['rating'];
				$date=$d['tglorder'];
				
				$rating=$rating+$r;
				$ppesan=$ppesan+$jml;
				
			}
			
			if($row>0) {$rating=round(($rating/$row),2);} //rerate rating
			else {$rating=0;} //rerate rating
			
			
			//if($pros) 
			//echo "<script>Materialize.toast('Data diperbaharui', 1000)</script>;";
	
	?>
	<!--Modal untuk menampilkan pilihan foto-->
	  <div id="howtopay" class="modal">
		<div class="modal-content">
		  <?php
			include 'connect.php';
			
			echo"
			
			<div class='row col l12' style='font-family:Raleway'>
				<div class='row col l12' style='text-align:center; font-size:18px;'>
					<div class='col l12' style=''>
						SEGERA LAKUKAN PEMBAYARAN SEBELUM
					</div>
					<div class='col l12' style='font-size:20px;'>
						<b>$due $time WIB</b>
					</div>
					<div class='col l12' style='padding-top:32px;'>
						TRANSFER PEMBAYARAN KE NOMOR REKENING
					</div>
					<div class='col l12' style='font-size:18px; padding:4px;'>
						Bank BCA<b> 800 900 800 900</b> a/n MeetJahit
					</div>
					
					<div class='col l12' style='font-size:15px;'>
						atau
					</div>
					<div class='col l12' style='font-size:18px;padding:4px;'>
						Bank BRI <b> 1237 8742 1 0030</b> a/n MeetJahit
					</div>
					<div class='col l12' style='font-size:15px;'>
						atau
					</div>
					<div class='col l12' style='font-size:18px;padding:4px;'>
						Bank BNI <b> 0331 881 331</b> a/n MeetJahit
					</div>
					<div class='col l12' style='font-size:18px; margin-top:16px; background-color:rgba(0,255,255,0.5)'>
						JUMLAH YANG HARUS DIBAYAR
					</div>
					<div class='col l12' style='font-size:24px;color:red; background-color:rgba(0,255,255,0.5)'>
						<b>Rp $total</b>
					</div>
					
				</div>
			</div>
				
			";
			
		  ?>
		</div>
		<div class="modal-footer">
		  <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat">Tutup</a>
		</div>
	  </div>
	<!--UI Web-->	

			<div class="row col l12 m12 s12" style="background-color: #351e16; margin-right:80px; margin-left:80px;">
				<div class="col l8 m12 s12" style="text-align:left; font-family: 'Raleway Dots', cursive; color:white; font-size:40px; padding:10px; padding-left:100px;">MEETJAHIT</div>
				<a id="head" href="cus.php" class="col l1" style="padding:20px; margin-top:8px; text-align:center; font-size:16px;">HOME</a>
				<a id="head" href="history.php" class="col l1" style="padding:20px; margin-top:8px; text-align:center; font-size:16px;">HISTORY</a>
				<a id="head" href="profile.php" class="col l1" style="padding:20px; margin-top:8px; text-align:center; font-size:16px;">PROFILE</a>
				<a id="head" href="index.php" class="col l1" style="padding:20px; margin-top:8px; text-align:center; font-size:16px;">X</a>
			</div >
		
		
			
		<div class="col l12 m12 s12" style="background-color: rgba(104, 73, 50,0.7); margin-top:-20px; margin-left:80px; margin-right:80px; padding:20px; text-align:center;">
		
			<div class="col row l12 m12 s12" style="padding-top:10px; margin-right:16px; color:white; font-size:16px; font-family:'Raleway';">
			<?php	
			echo"
			
			<div class='col row l3 m12 s12' style='padding-left:16px; padding-right:16px; text-align:center;'>
					<div class='col l12 m12 s12' style='background-color:rgba(0, 0, 0,0.6); padding:16px; '>
							<img src='img/tailor/".$pava.".png' width='120' height='120' alt=''/>
							<div>
								<a style='color:#d89034; font-size:16px; font-family:Lora' href='penjahit.php?id=".$idp."'>@$puser</a>
							</div>
							<div style='padding-top:4px; font-size:18px; font-family:Raleway'>".$pnama."</div>
							<div style='padding-top:2px; font-size:14px; font-family:Raleway'>Professional Tailor</div>
							
					</div>
					<div class='col l12 m12 s12' style='background-color:rgba(0, 255, 255,0.6); text-align:left; color:black; padding:8px'>
							<div class='col l6 m6 s6' style='font-size:14px; color:white; padding-top:0px;'>Jumlah order:</div>
							<div class='col l6 m6 s6' style='font-size:14px; color:white;  padding-top:0px;'>Rating:</div>
							<div class='col l6 m6 s6' style='font-size:16px; font-family:Amatic;'>".$ppesan."</div>
							<div class='col l6 m6 s6' style='font-size:16px; font-family:Amatic;'>".$rating." / 5</div>
					</div>
					<div class='col l12 m12 s12' style='background-color:rgba(0, 0, 0,0.6); text-align:left; color:white; padding:16px;'>
						<div style='font-size:13px; color:#d89034;'>Email:</div>
						<div style='font-size:15px; '>".$pemail."</div>
						<div style='font-size:13px; color:#d89034; padding-top:8px;'>Alamat:</div>
						<div style='font-size:15px; '>".$palamat.", ".$pkec.", ".$pcity.", ".$pprov.", ".$ppos."</div>
						
					</div>
					<div class='col l12 m12 s12' style='background-color:rgba(255, 255, 255,0.6); text-align:left; color:black; padding:8px'>
							<div style='text-align:right'>
								<a style='color:black; font-size:15px;' href='penjahit.php?id=".$idp."'>Lihat profil lengkap>></a>
						</div>
					</div>
			</div>
			<div class='col row l9 m12 s12' style='padding-left:16px; padding-right:16px; text-align:center;'>
				<form id='form' class='col l12' action='history.php' method='post' style='background-color:rgba(216, 144, 52, 0.8); padding:16px; font-size:17px;'>	
					<div class='' style='font-size:20px;'>Pesanan anda kepada $pnama berhasil</div>
					<div class='row col l12' style=''>
						<div class='input-field col l6' style='color: white; text-align: left;'>Kode pemesanan
							<div>$kode</div>
						</div>
						<div class='input-field col l6' style='color: white; text-align: left;'>Tanggal pemesanan
							<div>$date $time WIB</div>
						</div>
						<div class='input-field col l6' style='background-color: transparent; color:white; text-align:left;'>Ukuran
							<div>$size</div>
						</div>
						<div class='input-field col l6' style='background-color: transparent; color:white; text-align:left;'>Kategori					
			";
								$cek="SELECT * FROM tb_jenis WHERE id='$kategori'";
								$prs=mysqli_query($con,$cek);
								
								while ($dat = mysqli_fetch_array ($prs)){
									echo"<div>".$dat['jenis']."</div>";
							
								}
								
			echo"
						</div>
						<div class='input-field col l6' style='background-color: transparent; color:white; text-align:left;'>Kain
			";
								$cek="SELECT * FROM tb_kain WHERE idkain ='$kain'";
								$prs=mysqli_query($con,$cek);
								while ($mhs = mysqli_fetch_array ($prs)){
									echo"<div>".$mhs['namakain']."</div>";
								}
								
			echo"
						</div>
						
						<div class='input-field col l6' style='color: white; text-align: left;'>Jumlah
							<div>$jumlah potong</div>
						</div>
						<div class='input-field col l12' style='color: white; text-align: left;'>Link Desain
							<div>$desain</div>
						</div>
						
						
						<div class='input-field col l12' style='color: white; text-align: left;'>Tujuan pengiriman
							<div>$alamat</div>
						</div>
						<div class='input-field col l12' style='color: white; text-align: left;'>Harga total
							<div style='font-size:18px;'>Rp $total</div>
						</div>
							 
					</div>
							
					<div class='' style='font-size:16px; background-color:rgba(0,0,0,0.5); padding:16px; color:rgb(0,255,255);'>Segera lakukan pembayaran sebelum tanggal $due, $time WIB</div>
					<div class='col l12 m12 s12' style='text-allign:right; padding-top:20px;'>
						<div class='col l12' style=''>
							<input class='waves-effect waves-light btn ts' style='border:0px white solid;' type='submit' size='6' value='SELESAI'>
							
						</div>
					</div>
					<div class='col l12' style='text-align:right; margin-top:-38px'>
							<a class='waves-effect waves-light btn ts' style='background-color: rgba(255,255,255,0.5); color:black ;text-align:right' href='#howtopay'>Cara Pembayaran</a>
					</div>
					
					
				</form>
				</div>
				";
			?>
			
			</div>
		
		
		</div>
		
	
	<!--Mengetahui banyak data di database-->	
	<?php
		$queri="SELECT * from tb_user WHERE profesi=1";
		$proses=mysqli_query($con,$queri);
		$row=mysqli_num_rows($proses); //banyaknya data (baris table) di database
		echo "
			<script>
				var row=$row; //banyak data di database
			</script>
		";
	?>	
		
	
	<script type="text/javascript">
	function goBack() {
		window.history.back();
	}
	
	</script>
	
</body>
</html>

