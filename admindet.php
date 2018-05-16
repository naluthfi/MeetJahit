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
			
		   $('#resi').modal('close');
		   $('#upload').modal('close');
		   $('#rating').modal('close');
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
		$idu=$_COOKIE['id'];
		if($idu==NULL){
			header('location:login.php');
		}
		if(isset($_GET['kd']) && isset($_GET['idp'])&& isset($_GET['r']) && !isset($_GET['b'])){     
			$kd=$_GET['kd'];
			$idp=$_GET['idp'];
			
			$myq="SELECT * FROM order_jahit_".$idp." WHERE kdbooking ='$kd'";
			$myp=mysqli_query($con,$myq);
			while ($his = mysqli_fetch_array ($myp)){
				$idpel=$his['idpelanggan'];
				$tglkirim=$his['tglkirim'];
			}
		
			$quer="SELECT * FROM tb_user WHERE idu='$idp'";
			$pros=mysqli_query($con,$quer);
			while ($dat = mysqli_fetch_array ($pros)){
				$pemail=$dat['email'];
				$pnama=$dat['nama'];
			}
			$query="SELECT * FROM tb_user WHERE idu='$idpel'";
			$proses=mysqli_query($con,$query);
			while ($data = mysqli_fetch_array ($proses)){
				$empel=$data['email'];
				$namapel=$data['nama'];
			}
			
			$q="UPDATE order_jahit_".$idp." SET kirim=3 WHERE kdbooking='$kd'";
			$p=mysqli_query($con,$q);
			if ($p) {
				
				ini_set( 'display_errors', 1 );   
				error_reporting( E_ALL );  
				$from = "fabriquette@dtk15.tk";    
				$to = "$pemail";    
				$subject = "Fabriquette: [Pesanan $kd] Bukti pengiriman Anda telah dikonfirmasi";    
				$message = "Kami telah mengkonfirmasi bukti pengiriman barang untuk pesanan dengan kode $kd.\n\n Lihat history Anda sekarang untuk rincian pesanan lebih lanjut.\nmeetjahit.dtk15.tk/tayhis.php\n\nFabriQuette Support"; 
				$headers = "From:" . $from;    
				mail($to,$subject,$message, $headers); 
				echo "Pesan dikirim ke alamat email $pemail";
				
				ini_set( 'display_errors', 1 );   
				error_reporting( E_ALL );  
				$from = "fabriquette@dtk15.tk";    
				$to = "$empel";    
				$subject = "Fabriquette: [Pesanan $kd] Pesanan Anda telah dikirim";    
				$message = "Pesanan Anda dengan kode $kd telah dikirim oleh $pnama pada tanggal $tglkirim.\n\n Segera lihat history Anda sekarang untuk mengkonfirmasi apabila pesanan sudah sampai di tempat Anda.\n\nmeetjahit.dtk15.tk/history.php.\n\nFabriQuette Support"; 
				$headers = "From:" . $from;    
				mail($to,$subject,$message, $headers); 
				echo "Pesan dikirim ke alamat email $empel";
				
				header('location:adminhis.php');
			
			}
			else {
				echo "<script>Materialize.toast('".$kd." ".$idp." Gagal Konfirmasi', 6000)</script>";
			}
		}
		
		else if(isset($_GET['kd']) && isset($_GET['idp']) && isset($_GET['b']) && !isset($_GET['r'])){     
			$kd=$_GET['kd'];
			$idp=$_GET['idp'];
			
			$myq="SELECT * FROM order_jahit_".$idp." WHERE kdbooking ='$kd'";
			$myp=mysqli_query($con,$myq);
			while ($his = mysqli_fetch_array ($myp)){
				$idpel=$his['idpelanggan'];
			}
		
			$quer="SELECT * FROM tb_user WHERE idu='$idp'";
			$pros=mysqli_query($con,$quer);
			while ($dat = mysqli_fetch_array ($pros)){
				$pemail=$dat['email'];
				$pnama=$dat['nama'];
			}
			$query="SELECT * FROM tb_user WHERE idu='$idpel'";
			$proses=mysqli_query($con,$query);
			while ($data = mysqli_fetch_array ($proses)){
				$empel=$data['email'];
				$namapel=$data['nama'];
			}
			
			$q="UPDATE order_jahit_".$idp." SET bayar=1 WHERE kdbooking='$kd'";
			$p=mysqli_query($con,$q);
			if ($p) {
				
				ini_set( 'display_errors', 1 );   
				error_reporting( E_ALL );  
				$from = "fabriquette@dtk15.tk";    
				$to = "$pemail";    
				$subject = "Fabriquette: [Pesanan $kd] Pelanggan sudah melakukan pembayaran untuk pesanan Anda";    
				$message = "Kami telah mengkonfirmasi bukti pembayaran yang dilakukan oleh pelanggan Anda untuk pemesanan dengan kode $kd.\n\n Segera lihat history Anda sekarang untuk mengkonfirmasi pengerjaan pesanan tersebut.\nmeetjahit.dtk15.tk/tayhis.php\n\nFabriQuette Support"; 
				$headers = "From:" . $from;    
				mail($to,$subject,$message, $headers); 
				echo "Pesan dikirim ke alamat email $pemail";
				
				ini_set( 'display_errors', 1 );   
				error_reporting( E_ALL );  
				$from = "fabriquette@dtk15.tk";    
				$to = "$empel";    
				$subject = "Fabriquette: [Pesanan $kd]Pembayaran Anda telah dikonfirmasi";    
				$message = "Kami telah mengkonfirmasi bukti pembayaran Anda untuk pemesanan dengan kode $kd kepada $pnama.\n\n Untuk rincian pemesanan lebih lanjut, Anda dapat melihat history Anda sekarang di meetjahit.dtk15.tk/history.php.\n\nFabriQuette Support"; 
				$headers = "From:" . $from;    
				mail($to,$subject,$message, $headers); 
				echo "Pesan dikirim ke alamat email $empel";
				
				header('location:adminhis.php');
			
			}
			else {
				echo "<script>Materialize.toast('".$kd." ".$idp." Gagal Konfirmasi', 6000)</script>";
			}
		}
		
		else if (isset($_GET['kd']) && isset($_GET['idp']) && !isset($_GET['b']) && !isset($_GET['r'])){
		$idu=$_COOKIE['id'];
		$idp = $_GET['idp'];
		$kode = $_GET['kd'];
		$myq="SELECT * FROM order_jahit_".$idp." WHERE kdbooking ='$kode' order by tglorder";
		$myp=mysqli_query($con,$myq);
		while ($his = mysqli_fetch_array ($myp)){
			$alamat=$his['alamat'];
			$kain=$his['kain'];
			$desain=$his['desain'];
			$kategori=$his['kategori'];
			$ukuran=$his['ukuran'];
			$jumlah=$his['jumlah'];
			$progress=$his['progress'];
			$kirim=$his['kirim'];
			$date=$his['tglorder'];
			$time=$his['timeorder'];
			$bayar=$his['bayar'];
			$rat=$his['rating'];
			$total=$his['harga'];
			
			$diff = date_diff((date_create($date)),date_create(date("Y-m-d")));
			$days= $diff->format("%a"); //days different from today to the day you ordered
		}
		
		$add_days = 1;
		$due = date('d M Y',strtotime($date) + (24*3600*$add_days));
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
			
			$q="SELECT * FROM order_jahit_".$idp." WHERE bayar='1'";
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

	  
	<!--Modal untuk melihat dan mengkonfirmasi bukti pembayaran-->
	  <div id="upload" class="modal" style="text-align:center">
		<div class="modal-content">
		  <h5>Bukti Pembayaran</h5>
		 
		  <?php
			$files = glob("uploads/".$kode."*.*");
			for ($i=0; $i<count($files); $i++)
			{
				$image = $files[$i];
				$supported_file = array(
					'gif',
					'jpg',
					'jpeg',
					'png'
				);
			 
				$ext = strtolower(pathinfo($image, PATHINFO_EXTENSION));
				if (in_array($ext, $supported_file)) {
					$today = date('Y-m-d');
					$current_file_time = date('Y-m-d H:i:s',fileatime($image));
					if(strtotime($current_file_time)>=strtotime($today)) {
						echo basename($image) . "<br />"; // show only image name if you want to show full path then use this code // echo $image."<br />";
						echo '<img src="' . $image . '" alt="Random image" />' . "<br /><br />";
					}
				} else {
					continue;
				}
			}
			
			
			echo"
					<div class='col l12' style:'color:black'>  
						<a style='margin-top:8px; color:black; background-color:green' href='admindet.php?idp=".$idp."&kd=".$kode."&b=1' class='waves-effect waves-light btn ts'>KONFIRMASI</a>
					</div>
			";
		  ?>
		</div>
		<div class="modal-footer">
		  <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat">Tutup</a>
		</div>
	  </div>
	  
	<!--Modal untuk melihat dan mengkonfirmasi bukti pembayaran-->
	  <div id="resi" class="modal" style="text-align:center">
		<div class="modal-content">
		  <h5>Bukti Pengiriman Barang</h5>
		 
		  <?php
			$files = glob("uploads/R_".$kode."*.*");
			for ($i=0; $i<count($files); $i++)
			{
				$image = $files[$i];
				$supported_file = array(
					'gif',
					'jpg',
					'jpeg',
					'png'
				);
			 
				$ext = strtolower(pathinfo($image, PATHINFO_EXTENSION));
				if (in_array($ext, $supported_file)) {
					$today = date('Y-m-d');
					$current_file_time = date('Y-m-d H:i:s',fileatime($image));
					if(strtotime($current_file_time)>=strtotime($today)) {
						echo basename($image) . "<br />"; // show only image name if you want to show full path then use this code // echo $image."<br />";
						echo '<img src="' . $image . '" alt="Random image" />' . "<br /><br />";
					}
				} else {
					continue;
				}
			}
			
			
			echo"
					<div class='col l12' style:'color:black'>  
						<a style='margin-top:8px; color:black; background-color:green' href='admindet.php?idp=".$idp."&kd=".$kode."&r=1' class='waves-effect waves-light btn ts'>KONFIRMASI</a>
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
				<a id="head" href="adminhis.php" class="col l1" style="padding:20px; margin-top:8px; text-align:center; font-size:16px;">HOME</a>
				<a id="head" href="adminhis.php" class="col l1" style="padding:20px; margin-top:8px; text-align:center; font-size:16px;">HISTORY</a>
				<a id="head" href="profadm.php" class="col l1" style="padding:20px; margin-top:8px; text-align:center; font-size:16px;">PROFILE</a>
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
				<form id='form' class='col l12' action='orpenagain.php?id=".$idp."&kd=".$kode."' method='post' style='background-color:rgba(216, 144, 52, 0.7); padding:24px; font-size:17px;'>	
					<div class='' style='font-size:20px; background-color:rgba(0,0,0,0.4);'>Pesanan anda kepada $pnama dengan Kode $kode</div>
					<div class='row col l12' style='padding:16px; background-color:rgba(0,0,0,0.4);'>
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
							 
					
							
					";
					
					if(($kirim==1)&&($rat>0)){
						$status="Transaksi selesai, anda memberi rating $rat";
						echo"
								<div  style='padding:4px; font-size:20px; color:rgba(0,255,255,1);'>".$status."</div>	</div>
								<div class='col l12 m12 s12' style='text-allign:right; padding-top:20px;'>
								<div class='col l12' style=''>
								
								<div onClick='goBack()' class='waves-effect waves-light btn ts' style='background-color:rgba(255,255,255,0.2); color:white; text-align:right'>Kembali</div>
								<input class='waves-effect waves-light btn ts' style='border:0px white solid;' type='submit' size='6' value='PESAN LAGI'>	
						";
					}
					if(($kirim==1)&&(($rat==NULL)||($rat==0))){
						$status="Transaksi selesai, segera berikan rating!";
						echo"
								<div  style='padding:4px; font-size:20px; color:rgba(0,255,255,1);'>".$status."</div>	</div>
								<div class='col l12 m12 s12' style='text-allign:right; padding-top:20px;'>
								<div class='col l12' style=''>
								
								<div onClick='goBack()' class='waves-effect waves-light btn ts' style='background-color:rgba(255,255,255,0.2); color:white; text-align:right'>Kembali</div>
								<input class='waves-effect waves-light btn ts' style='border:0px white solid;' type='submit' size='6' value='PESAN LAGI'>	
								<a class='waves-effect waves-light btn ts' style='color:white; text-align:right' href='#rating'>Beri Rating</a>
						";
					}
					else if(($bayar==0||$bayar==NULL)&& ($days<=1)){
						$status="Segera lakukan pembayaran sebelum $due $time";
												
						echo"		
							<div  style='padding:4px; font-size:20px; color:rgb(0,255,255); text-align:center;'>
								<div style='text-align:center; margin-bottom: 8px;'>".$status."</div>
								<a class='waves-effect waves-light btn ts' style='background-color: rgba(255,255,255,0.6); color:black ;text-align:right' href='#howtopay'>Cara Pembayaran</a>
							</div> </div>
							<div class='col l12 m12 s12' style='text-allign:right; padding-top:20px;'>
								<div class='col l12' style=''>
									<div onClick='goBack()' class='waves-effect waves-light btn ts' style='background-color:rgba(255,255,255,0.2); color:white; text-align:right'>Kembali</div>
									<input class='waves-effect waves-light btn ts' style='border:0px white solid;' type='submit' size='6' value='PESAN LAGI'>
									<a class='waves-effect waves-light btn ts' style='color:white; text-align:right' href='#upload'>Unggah Bukti Pembayaran</a>
						";
					}
					else if($bayar==2){
						$status="Menunggu konfirmasi admin";
												
						echo"		
							<div  style='padding:4px; font-size:20px; color:rgba(216, 144, 52,1);'>".$status."</div> </div>
							<div class='col l12 m12 s12' style='text-allign:right; padding-top:20px;'>
							<div class='col l12' style=''>
								
								<div onClick='goBack()' class='waves-effect waves-light btn ts' style='background-color:rgba(255,255,255,0.2); color:white; text-align:right'>Kembali</div>
								<a class='waves-effect waves-light btn ts' style='color:white; text-align:right' href='#upload'>Lihat Bukti Pembayaran</a>		
						";
					}
					else if($kirim==2){
						$status="Menunggu konfirmasi resi";
												
						echo"		
							<div  style='padding:4px; font-size:20px; color:rgba(170, 240, 27,1);'>".$status."</div> </div>
							<div class='col l12 m12 s12' style='text-allign:right; padding-top:20px;'>
							<div class='col l12' style=''>
								
								<div onClick='goBack()' class='waves-effect waves-light btn ts' style='background-color:rgba(255,255,255,0.2); color:white; text-align:right'>Kembali</div>
								<a class='waves-effect waves-light btn ts' style='color:white; text-align:right' href='#resi'>Lihat Resi</a>		
						";
					}
					else if(($bayar==1)&&($progress==1)&&($kirim==0)){
						$status="Pesanan anda sedang dikerjakan";
												
						echo"		
							<div  style='padding:4px; font-size:20px; color:rgba(216, 144, 52,1);'>".$status."</div> </div>
							<div class='col l12 m12 s12' style='text-allign:right; padding-top:20px;'>
							<div class='col l12' style=''>
								
								<div onClick='goBack()' class='waves-effect waves-light btn ts' style='background-color:rgba(255,255,255,0.2); color:white; text-align:right'>Kembali</div>
								<input class='waves-effect waves-light btn ts' style='border:0px white solid;' type='submit' size='6' value='PESAN LAGI'>	
						";
					}
					else if(($bayar==1)&&($progress==0)&&($kirim==0)){
						$status="Pesanan anda akan dikerjakan";
												
						echo"		
							<div  style='padding:4px; font-size:20px; color:rgba(0, 255, 255,1);'>".$status."</div> </div>
							<div class='col l12 m12 s12' style='text-allign:right; padding-top:20px;'>
							<div class='col l12' style=''>
								
								<div onClick='goBack()' class='waves-effect waves-light btn ts' style='background-color:rgba(255,255,255,0.2); color:white; text-align:right'>Kembali</div>
								<input class='waves-effect waves-light btn ts' style='border:0px white solid;' type='submit' size='6' value='PESAN LAGI'>
															
						";
					}
					
					else if((($bayar==0)||($bayar==NULL))&& ($days>1)){
						$status="Transaksi dibatalkan";					
						echo"		
							<div  style='padding:4px; font-size:20px; color:rgba(216, 144, 255,1);'>".$status."</div> </div>
							<div class='col l12 m12 s12' style='text-allign:right; padding-top:20px;'>
							<div class='col l12' style=''>
								
								<div onClick='goBack()' class='waves-effect waves-light btn ts' style='background-color:rgba(255,255,255,0.2); color:white; text-align:right'>Kembali</div>
								<input class='waves-effect waves-light btn ts' style='border:0px white solid;' type='submit' size='6' value='PESAN LAGI'>	
						";
					}
					
					echo"
					
					</div>
					</div>
				</form>
				</div>
				";
		}
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

