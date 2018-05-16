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
			
		   $('#upload').modal('close');
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
		
		$today=date("Y-m-d"); //get todays date
		
		if(isset($_GET['kd']) && isset($_GET['k']) && !isset($_GET['p'])&& !isset($_GET['c'])){ //untuk update resi telah diupload     
			$kd=$_GET['kd'];
			
			$q="UPDATE order_jahit_".$idu." SET kirim=2, tglkirim='$today' WHERE kdbooking='$kd'";
			$p=mysqli_query($con,$q);
			if ($p) {header('location:tayhis.php');}
			else {echo "<script>Materialize.toast('".$kd." Gagal Upload', 6000)</script>";}
		}
		
		else if(isset($_GET['kd']) && isset($_GET['c']) && !isset($_GET['p'])&& !isset($_GET['k'])){ //menolak pesanan
			$kd=$_GET['kd'];
			
			$q="UPDATE order_jahit_".$idu." SET bayar=3 WHERE kdbooking='$kd'";
			$p=mysqli_query($con,$q);
			if ($p) {header('location:tayhis.php');}
			else {echo "<script>Materialize.toast('".$kd." Gagal Tolak', 6000)</script>";}
			//echo "<script>Materialize.toast('".$kd." ".$b." Gagal Upload', 6000)</script>";
		}
		
		else if(isset($_GET['kd']) && isset($_GET['p']) && !isset($_GET['k'])&& !isset($_GET['c'])){ //untuk update progress     
			$kd=$_GET['kd'];
			$IDP=$idu;
			
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
			}
			
			$q="UPDATE order_jahit_".$idu." SET progress=1 WHERE kdbooking='$kd'";
			$p=mysqli_query($con,$q);
			if ($p) {
				ini_set( 'display_errors', 1 );   
				error_reporting( E_ALL );  
				$from = "fabriquette@dtk15.tk";    
				$to = "$empel";    
				$subject = "Fabriquette: [Pesanan $kd] Pesanan Anda mulai dikerjakan";    
				$message = "Pesanan Anda dengan kode $kd mulai dikerjakan oleh penjahit, $pnama. Pesanan akan selesai dalam waktu sekitar 2 minggu sampai 1 bulan. \n\n Lihat history Anda untuk rincian pesanan selengkapnya.\n\nmeetjahit.dtk15.tk/history.php.\n\nFabriQuette Support"; 
				$headers = "From:" . $from;    
				mail($to,$subject,$message, $headers); 
				echo "Pesan dikirim ke alamat email $empel";
				header('location:tayhis.php');
			}
			else {echo "<script>Materialize.toast('".$kd." ".$idp." Gagal Upload', 6000)</script>";}
		}
		
		else if (isset($_GET['kd']) && !isset($_GET['p']) && !isset($_GET['k'])&& !isset($_GET['c'])){
		$idu=$_COOKIE['id'];
		$kode = $_GET['kd'];
		$myq="SELECT * FROM order_jahit_".$idu." WHERE kdbooking ='$kode' order by tglorder";
		$myp=mysqli_query($con,$myq);
		while ($his = mysqli_fetch_array ($myp)){
			$idpel=$his['idpelanggan'];
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
		
				
		$quer="SELECT * FROM tb_user WHERE idu='$idu'";
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
			
		$q="SELECT * FROM order_jahit_".$idu." WHERE bayar='1'";
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
		
	?>
	
	<!--Modal untuk upload resi-->
	  <div id="upload" class="modal" style="text-align:center">
		<div class="modal-content">
		  <h5>Unggah resi pengiriman barang</h5>

		<?php
			echo"
			<form action='' method='POST' enctype='multipart/form-data'>
				Select image to upload:
				<input type='file' name='fileToUpload' id='fileToUpload'>
				<input type='submit' value='Upload Image' name='submit'>
			</form>
				
			";
			
			$target_dir = "uploads/";
			$target_file = $target_dir . 'R_' .  $kode . '_'. $_FILES["fileToUpload"]["name"];
			$uploadOk = 1;
			$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
			// Check if image file is a actual image or fake image
			if(isset($_POST["submit"])) {
				$check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
				if($check !== false) {
					echo "File is an image - " . $check["mime"] . ".";
					$uploadOk = 1;
				} else {
					echo "File is not an image.";
					$uploadOk = 0;
				}
			}
			// Check if file already exists
			if (file_exists($target_file)) {
				echo "Sorry, file already exists.";
				$uploadOk = 0;
			}
			// Check file size
			if ($_FILES["fileToUpload"]["size"] > 500000) {
				echo "Sorry, your file is too large.";
				$uploadOk = 0;
			}
			// Allow certain file formats
			if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
			&& $imageFileType != "gif" ) {
				echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
				$uploadOk = 0;
			}
			// Check if $uploadOk is set to 0 by an error
			if ($uploadOk == 0) {
				echo "Sorry, your file was not uploaded.";
			// if everything is ok, try to upload file
			} else {
				if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
					echo "<script>Materialize.toast('Gambar berhasil di upload', 2000)</script>;";
					header("Location: tayhisdet.php?kd=".$kode."&k=1");
				} else {
					echo "Sorry, there was an error uploading your file.";
				}
			}
		
			
		?>
		</div>
		<div class="modal-footer">
		  <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat">Tutup</a>
		</div>
	  </div>
	  
	<!--UI Web-->	

			<div class="row col l12 m12 s12" style="background-color: #351e16; margin-right:80px; margin-left:80px;">
				<div class="col l8 m12 s12" style="text-align:left; font-family: 'Raleway Dots', cursive; color:white; font-size:40px; padding:10px; padding-left:100px;">MEETJAHIT</div>
				<a id="head" href="tay.php" class="col l1" style="padding:20px; margin-top:8px; text-align:center; font-size:16px;">HOME</a>
				<a id="head" href="tayhis.php" class="col l1" style="padding:20px; margin-top:8px; text-align:center; font-size:16px;">HISTORY</a>
				<a id="head" href="penjahit.php" class="col l1" style="padding:20px; margin-top:8px; text-align:center; font-size:16px;">PROFILE</a>
				<a id="head" href="index.php" class="col l1" style="padding:20px; margin-top:8px; text-align:center; font-size:16px;">X</a>
			</div >
		
		
			
		<div class="col l12 m12 s12" style="background-color: rgba(104, 73, 50,0.7); margin-top:-20px; margin-left:80px; margin-right:80px; padding:20px; text-align:center;">
		
			<div class="col row l12 m12 s12" style="padding-top:10px; margin-right:16px; color:white; font-size:16px; font-family:'Raleway';">
			<?php
			
			$qr="SELECT * FROM tb_user WHERE idu = '$idpel'";
			$pr=mysqli_query($con,$qr);
			
			while ($pel = mysqli_fetch_array ($pr)){
				$namapel=$pel['nama'];
			}
			
			echo"
			
			<div class='col row l3 m12 s12' style='padding-left:16px; padding-right:16px; text-align:center;'>
					<div class='col l12 m12 s12' style='background-color:rgba(0, 0, 0,0.6); padding:16px; '>
							<img src='img/tailor/".$pava.".png' width='120' height='120' alt=''/>
							<div>
								<a style='color:#d89034; font-size:16px; font-family:Lora' href='penjahit.php?id=".$idu."'>@$puser</a>
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
								<a style='color:black; font-size:15px;' href='penjahit.php?id=".$idu."'>Lihat profil lengkap>></a>
						</div>
					</div>
			</div>
			<div class='col row l9 m12 s12' style='padding-left:16px; padding-right:16px; text-align:center;'>
				<form id='form' class='col l12' action='orpenagain.php?id=".$idu."&kd=".$kode."' method='post' style='background-color:rgba(216, 144, 52, 0.7); padding:24px; font-size:17px;'>	
					<div class='' style='font-size:20px; background-color:rgba(0,0,0,0.4);'>Pesanan dari $namapel dengan Kode $kode</div>
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
					
					if($kirim==1){
						$status="Transaksi selesai";
						echo"
								<div  style='padding:4px; font-size:20px; color:rgba(0,255,255,1);'>".$status."</div>	</div>
								<div class='col l12 m12 s12' style='text-allign:right; padding-top:20px;'>
								<div class='col l12' style=''>
								
								<div onClick='goBack()' class='waves-effect waves-light btn ts' style='background-color:rgba(255,255,255,0.2); color:white; text-align:right'>Kembali</div>
						";
					}
					else if($kirim==2){
						$status="Menunggu konfirmasi resi";
												
						echo"		
							<div  style='padding:4px; font-size:20px; color:rgb(170, 240, 27); text-align:center;'>
								<div style='text-align:center; margin-bottom: 8px;'>".$status."</div>
							</div> </div>
							<div class='col l12 m12 s12' style='text-allign:right; padding-top:20px;'>
								<div class='col l12' style=''>
									<div onClick='goBack()' class='waves-effect waves-light btn ts' style='background-color:rgba(255,255,255,0.2); color:white; text-align:right'>Kembali</div>								
						";
					}
					else if($kirim==3){
						$status="Menunggu feedback pelanggan";
												
						echo"		
							<div  style='padding:4px; font-size:20px; color:rgb(170, 240, 27); text-align:center;'>
								<div style='text-align:center; margin-bottom: 8px;'>".$status."</div>
							</div> </div>
							<div class='col l12 m12 s12' style='text-allign:right; padding-top:20px;'>
								<div class='col l12' style=''>
									<div onClick='goBack()' class='waves-effect waves-light btn ts' style='background-color:rgba(255,255,255,0.2); color:white; text-align:right'>Kembali</div>								
						";
					}
					else if(($bayar==0||$bayar==NULL||$bayar==2)&& ($days<=1)){
						$status="Sedang menunggu pembayaran";
												
						echo"		
							<div  style='padding:4px; font-size:20px; color:rgb(240,0,95); text-align:center;'>
								<div style='text-align:center; margin-bottom: 8px;'>".$status."</div>
							</div> </div>
							<div class='col l12 m12 s12' style='text-allign:right; padding-top:20px;'>
								<div class='col l12' style=''>
									<div onClick='goBack()' class='waves-effect waves-light btn ts' style='background-color:rgba(255,255,255,0.2); color:white; text-align:right'>Kembali</div>
									<a class='waves-effect waves-light btn ts' style='color:white; text-align:right margin-top:16px;' href='tayhisdet.php?kd=".$kode."&c=1'>Tolak Pesanan</a>									
						";
					}
					else if(($bayar==1)&&($progress==1)&&($kirim==0)){
						$status="Pesanan sedang dikerjakan";
												
						echo"		
							<div  style='padding:4px; font-size:20px; color:rgba(0, 255, 255,1);'>".$status."</div> </div>
							<div class='col l12 m12 s12' style='text-allign:right; padding-top:20px;'>
							<div class='col l12' style=''>
								
								<div onClick='goBack()' class='waves-effect waves-light btn ts' style='background-color:rgba(255,255,255,0.2); color:white; text-align:right'>Kembali</div>
								<a class='waves-effect waves-light btn ts' style='color:white; text-align:right' href='#upload'>Unggah Resi</a>
						";
					}
					else if(($bayar==1)&&($progress==0)&&($kirim==0)){
						$status="Pesanan akan dikerjakan";
												
						echo"		
							<div  style='padding:4px; font-size:20px; color:rgba(0, 255, 255,1);'>".$status."</div> </div>
							<div class='col l12 m12 s12' style='text-allign:right; padding-top:20px;'>
							<div class='col l12' style=''>
								
								<div onClick='goBack()' class='waves-effect waves-light btn ts' style='background-color:rgba(255,255,255,0.2); color:white; text-align:right'>Kembali</div>
								<a class='waves-effect waves-light btn ts' style='color:white; text-align:right' href='tayhisdet.php?kd=".$kode."&p=1'>Mulai Kerjakan</a>
						";
					}
					
					else if((($bayar==0||$bayar==NULL)&& ($days>1))||($bayar==3)){
						$status="Transaksi dibatalkan";					
						echo"		
							<div  style='padding:4px; font-size:20px; color:rgba(216, 144, 255,1);'>".$status."</div> </div>
							<div class='col l12 m12 s12' style='text-allign:right; padding-top:20px;'>
							<div class='col l12' style=''>
								
							<div onClick='goBack()' class='waves-effect waves-light btn ts' style='background-color:rgba(255,255,255,0.2); color:white; text-align:right'>Kembali</div>
							
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
	
	var vup=1;
	var page=0;
	var kpk=1;
	var srt="id"; //penanda pengurutan berdasar nrp
	
	document.getElementById("hal").innerHTML = page+1; //menampilkan angka halaman pertama
	
	var maks;
	var a=0;
	var p=0;
	if(row<=4){ //banyak data kurang dari sama dengan 5
		maks=1; //jumlah halaman maks 1
	}
	else{
		while(row>(a+4)){ //lebih dari 5 baris dan kelipatan 5
			a=a+4; //bertambah kelipatan lima
			p++; //halaman akan bertamah 1
			maks=p+1; //halaman maks sesuai dengan yang mendekati dengan kelipatan 5 ke-(p+1)
		}
	}
	
	document.getElementById("maks").innerHTML = maks; //menunjukkan halaman terakhir
	
	//FUNGSI UNTUK MENAMPILKAN FORM SESUAI DENGAN TOMBOL YANG DIKLIK
	//var loadingdata = function(){
		$(document).ready(function(){
				$("#content").load("cusdata.php?pg="+page);
		});
	//}
	//setInterval(loadingdata, 500);//1000 miliseconds
	
		/*$(document).ready(function(){
				refresh();
		});
		
		function refresh(){
			setTimeout(function(){
				$("#content").load("cusdata.php?pg="+page);
				refresh();
			},1000);
		}*/
	
	function rightclick(){
		page++;
		vup=vup;
		kpk=(page-1)*4;
		if(page*4>=row){ //jika sudah berada di halaman terakhir
			//agar tidak menuju ke halaman berikutnya
			page=kpk/4; //supaya ditahan di halaman terakhir			
		}
		
		if((page*4>row-4)&&(row%4<vup)){ //satu halaman sebelum halaman terakhir dan penanda menunjuk baris ke-x, x<banyak data di halaman terakhir
			vup=row%4; //penanda akan menunjukkan baris terakhir pada halaman terakhir
		}
		document.getElementById("hal").innerHTML = page+1; //memunculkan nomor halaman ke html (di pojok kanan atas)
		$(document).ready(function(){
				$("#content").load("cusdata.php?pg="+page);
		});
		 
		
	}
	
	function leftclick(){
		page--;
		
		if(page<0) page=0; //jika sudah berada di halaman awal maka tidak akan berpindah ke halaman manapun
		document.getElementById("hal").innerHTML = page+1; //memunculkan nomor halaman ke html (di pojok kanan atas)
		$(document).ready(function(){
				$("#content").load("cusdata.php?pg="+page);
		});
	}
	
	
	</script>
	
</body>
</html>

