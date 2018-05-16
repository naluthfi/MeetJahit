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
			
		   $('#editlist').modal('close');
		   $('#hapuslist').modal('close');
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
	<!--FUNGSI PHP untuk mengedit, menghapus, dan menambah data-->
	<?php
		include 'connect.php';
		session_start();
		$idu=$_COOKIE['id'];
		if($idu==NULL){
			header('location:login.php');
		}
		if(isset($_GET['el']) && !isset($_GET['d'])){
			$kat =  $_POST['kategori'];
			$tarif =  $_POST['tarif'];
			
			$qq="SELECT * FROM tb_penjahit_".$idu." WHERE kategori='$kat'";
			$pp=mysqli_query($con,$qq);
			$row=mysqli_num_rows($pp);
			if($row==0){
				$que="INSERT INTO tb_penjahit_".$idu." (kategori,tarif) VALUES ('$kat','$tarif')";
				$pro=mysqli_query($con,$que);
				
				if($pro){
					header("location:tay.php");
				}
				else{
					echo "<script>Materialize.toast('GAGAL', 2000)</script>";
				}
				//echo "<script>Materialize.toast('BELUM ADA $kat $tarif', 2000)</script>";
			}
			else{
				$que="UPDATE tb_penjahit_".$idu." SET tarif='$tarif' WHERE kategori='$kat'";
				$pro=mysqli_query($con,$que);
				
				if($pro){
					header("location:tay.php");
				}
				else{
					echo "<script>Materialize.toast('GAGAL', 2000)</script>";
				}
			}
		}
		if(isset($_GET['d']) && !isset($_GET['el'])){
			$kat =  $_GET['d'];
			
			$que="DELETE FROM tb_penjahit_".$idu." WHERE kategori='$kat'";
			$pro=mysqli_query($con,$que);
			
			if($pro){
				header("location:tay.php");
			}
			else{
				echo "<script>Materialize.toast('GAGAL', 2000)</script>";
			}
			
		}
		
		$idp=$idu;
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
			$rating=$rating+$r;
			$ppesan=$ppesan+$jml;
		}
		
		if($row>0) {$rating=round(($rating/$row),2);} //rerate rating
		else {$rating=0;} //rerate rating
		
		
		//NEW ORDERS
		$nq="SELECT * FROM order_jahit_".$idp." WHERE (bayar=0 OR bayar=2)";
		$np=mysqli_query($con,$nq);
		$nrow=mysqli_num_rows($np); //banyaknya data (baris table) di database
		
		//PESANAN SELESAI
		$fq="SELECT * FROM order_jahit_".$idp." WHERE kirim='1'";
		$fp=mysqli_query($con,$fq);
		$frow=mysqli_num_rows($fp); //banyaknya data (baris table) di database
		
		//PESANAN SEDANG DIKERJAKAN
		$pq="SELECT * FROM order_jahit_".$idp." WHERE (progress=1 AND (kirim=0 or kirim is null))";
		$pp=mysqli_query($con,$pq);
		$prow=mysqli_num_rows($pp); //banyaknya data (baris table) di database
		
		//PESANAN AKAN DIKERJAKAN
		$sq="SELECT * FROM order_jahit_".$idp." WHERE bayar=1 and (progress is null or progress=0)";
		$sp=mysqli_query($con,$sq);
		$srow=mysqli_num_rows($sp); //banyaknya data (baris table) di database
		
	?>
        
	
	<!--Modal untuk menampilkan pilihan foto-->
	  <div id="editlist" class="modal">
		<div class="modal-content">
		  <h5>Edit List Jasa</h5>
		  <form class="col l12" action="tay.php?el=1" method="post" style="">
				<div class="col l12" style="">
		  <?php
			include 'connect.php';

			echo"
				<div class='input-field col l12' style='background-color: transparent; color:black;'>
					<select class='browser-default' name='kategori' style='font-size:16px;'>
						<option>Pilih Kategori</option>";
							
						$cek='SELECT * FROM tb_jenis ORDER by jenis';
						$prs=mysqli_query($con,$cek);
						while ($mhs = mysqli_fetch_array ($prs)){
							$idkat=$mhs['id'];
							$nmkat=$mhs['jenis'];
							echo"<option value='$idkat' style='color: black;'>$nmkat</option>";
						}
					
			echo"
					</select>
				</div>
				<div class='input-field col l12' style='color: black; text-align: left;'>Tarif
					<input placeholder='Tarif' value='' name='tarif' type='text' style='background:transparent;' required>
				</div>
			";
			
		  ?>
				<div class="col l2" style="padding-top:20px;">
						<input class="waves-effect waves-light btn ts" style="" type="submit" size="6" value="Simpan">
				</div>
		  </div>
		  </form>
		
		</div>
		<div class="modal-footer">
		  <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat">Tutup</a>
		</div>
	  </div>
	  
	<!--Modal untuk menampilkan pilihan foto-->
	  <div id="hapuslist" class="modal">
		<div class="modal-content">
		  <h5>Pilih Kategori yang ingin dihapus</h5>
		  <?php
			include 'connect.php';
			$qq="SELECT * FROM tb_penjahit_".$idu."";
			$ppenj=mysqli_query($con,$qq);
			while ($d = mysqli_fetch_array ($ppenj)){
				$idkat=$d['kategori'];
							
				$cek="SELECT * FROM tb_jenis WHERE id='$idkat'";
				$prs=mysqli_query($con,$cek);
				while ($mhs = mysqli_fetch_array ($prs)){
					$nmkat=$mhs['jenis'];
				}			
				
				echo"
					<div class='col l12' style='margin-top:8px;'>
						<a style='color:orange; font-family:Lora ' href='tay.php?d=".$idkat."'>$nmkat</a>
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
				<div class="col l8 m12 s12" style="text-align:left; font-family: 'Raleway Dots', cursive; color:white; font-size:40px; padding:10px; padding-left:100px;">MEETJAHIT</div>
				<a id="head" href="tay.php" class="col l1" style="padding:20px; margin-top:8px; text-align:center; font-size:16px;">HOME</a>
				<a id="head" href="tayhis.php" class="col l1" style="padding:20px; margin-top:8px; text-align:center; font-size:16px;">HISTORY</a>
				<a id="head" href="proftay.php" class="col l1" style="padding:20px; margin-top:8px; text-align:center; font-size:16px;">PROFILE</a>
				<a id="head" href="index.php" class="col l1" style="padding:20px; margin-top:8px; text-align:center; font-size:16px;">X</a>
			</div >
		
		
			
		<div class="col l12 m12 s12" style="background-color: rgba(104, 73, 50,0.9); margin-top:-20px; margin-left:80px; margin-right:80px; padding:20px; text-align:center;">
			<div class="col l12 m12 s12" style=" margin-left:80px; opacity:1; font-size: 24px; font-family: 'Raleway'; color:white; text-align:left;">Selamat datang, <?php echo "$pnama";?>!
			</div>
			<div class="col l12 m12 s12" style=" margin-left:80px; opacity:1; font-size: 20px; font-family: 'Raleway'; color:white; text-align:left;">Ada <?php echo "$nrow";?> pesanan baru,
			<a style="color:rgb(0,255,255);" href="tayhis.php">Klik di sini</a></div>
			
			<div class="col row l12 m12 s12" style="background-color:rgba(255, 255, 255,0.5); text-align:left; 
			margin-left:64px; margin-right:64px; margin-top:20px; padding:16px; font-size:17px">
				
				<div class="col l4 m12 s12" style="background-color:rgba(255, 255, 255,0); text-align:left; 
				padding:16px; font-size:17px; margin-right: 16px; margin-right:-84px; padding-right:-56px;">
				
					<div class="col l12" style="font-size:19px; padding-bottom:20px;">
						STATUS ORDER
					</div>
					<div class="col row l12" style="font-size:17px;">
						<div class="col l1" style="color:green;">
							<i class="material-icons">check_box</i>
						</div>
						
						<div class="col l11" style="">
							Transaksi selesai: <?php echo "$frow";?>
						</div>
					</div>
					<div class="row col  l12" style="font-size:17px;">
						<div class="col l1" style="color:orange;">
							<i class="material-icons">check_box</i>
						</div>
						<div class="col l11" style="">
							Sedang dikerjakan: <?php echo "$prow";?>
						</div>
					</div>
					<div class="row col  l12" style="font-size:17px;">
						<div class="col l1" style="color:rgb(90,230,245);">
							<i class="material-icons">check_box</i>
						</div>
						<div class="col l11" style="">
							Akan dikerjakan: <?php echo "$srow";?>
						</div>
					</div>
					<div class="row col  l12" style="font-size:17px;">
						<div class="col l1" style="color:magenta;">
							<i class="material-icons">check_box</i>
						</div>
						<div class="col l11" style="">
							Pesanan baru: <?php echo "$nrow";?>
						</div>
					</div>
					
				</div>
				
				<div class="col l2 m12 s12" style="background-color:rgba(0, 0, 0,0.6); text-align:left; padding:10px; margin-right:48px;">
					<div class="col l12" style="background-color:rgba(0, 255, 255,0.7); text-align:left; padding:8px;">
						<div class="col l12" style="font-size:18px; padding-bottom:10px;color:white">
							Rating
						</div>
						<div class="col l12" style="font-size:32px;color:white;padding-bottom:20px;">
							<?php echo"$rating ";?>/ 5
						</div>
					</div>
					<div class="col l12" style="background-color:rgba(216, 144, 52,0.7); text-align:left; padding:8px; margin-top:10px;">
						<div class="col l12" style="font-size:18px; padding-bottom:10px;color:white">
							Total pesanan
						</div>
						<div class="col l12" style="font-size:20px; color:white; ">
							<?php echo"$frow ";?> transaksi
						</div>
						<div class="col l12" style="font-size:18px; color:white; padding-bottom:8px;">
							<?php echo"( $ppesan ";?> potong )
						</div>
					</div>
				
					
				</div>
				
				<div class="col l6 m12 s12" style="background-color:rgba(0, 0, 0,0.7); text-align:left; color:white; 
				padding:16px; font-size:17px; margin-right: 16px;">
				
					<div class="col l12" style="font-size:19px;">
						LIST JASA SAYA
					</div>
					
					<div class="col row l12" style="font-size:17px; margin-top:20px; margin-left:-20px;margin-right:-20px; ">
					<?php
						$qkat="SELECT * FROM tb_penjahit_".$idp."";
						$pkat=mysqli_query($con,$qkat);
						while ($d = mysqli_fetch_array ($pkat)){
							$idkat=$d['kategori'];
							$tarif=$d['tarif'];
							$nqkat="SELECT * FROM tb_jenis WHERE id ='$idkat'";
							$npkat=mysqli_query($con,$nqkat);
							while ($nd = mysqli_fetch_array ($npkat)){
								$kat=$nd['jenis'];
						echo"
						<div class='col row l4' style='font-size:16px; margin-top:-16px;'>
							<div class='col l1' style='color:rgb(245,70,120);'>
								<i class='material-icons'>check_box</i>
							</div>
							
							<div class='col l10' style=''>
								$kat
							</div>
							<div class='col l10' style=''>
								Rp $tarif
							</div>
						</div>
						";
							}
						}
					?>
					
					</div>
					
					<div class="col l12" style="font-size:18px; text-align:right;">
						<a style="color:rgb(0,200,200);" href="#editlist">Edit List Jasa</a>
						<a style="color:rgb(240,50,50);" href="#hapuslist">Hapus List Jasa</a>
					</div>
					
				</div>
				
			</div>
			
			<div class="col l12 m12 s12" style="background-color:rgba(255, 255, 255,0.5); text-align:left; 
			margin-left:64px; margin-right:64px; padding:16px; font-size:17px">
				<div class="col l12 m12 s12" style="text-align:left; padding:16px; font-size:18px">RECENT ORDERS <?php echo"$prow"?> </div>
				<?php
				if($prow==0){
					echo"
						<div class='col l12 m12 s12' style='text-align:left; padding:16px;'>Tidak ada pesanan yang sedang dikerjakan
						</div>
						";
				}
				else{
					while ($d = mysqli_fetch_array ($pp)){
							$idpel=$d['idpelanggan'];
							$kd=$d['kdbooking'];
							$kategori=$d['kategori'];
							$ukuran=$d['ukuran'];
							$kain=$d['kain'];
							
							$qr="SELECT * FROM tb_user WHERE idu ='$idpel'";
							$pr=mysqli_query($con,$qr);
							while ($nd = mysqli_fetch_array ($pr)){
								$nama=$nd['nama'];
								$ava=$nd['avatar'];
									
							echo"
							<div class='row col l12' style='font-size:17px; padding:16px; background-color:rgba(255, 255, 255,0.9);'>
								
								<div class='col l1' style=''>
									<img src='img/tailor/".$ava.".png' width='64' height='64' alt=''/>
								</div>
								<div class='col l2' style='margin-top:20px;'>
									$nama
								</div>";
							}
							
							$nqkat="SELECT * FROM tb_jenis WHERE id ='$kategori'";
							$npkat=mysqli_query($con,$nqkat);
							while ($nd = mysqli_fetch_array ($npkat)){
								$namakat=$nd['jenis'];
							}	
							$qkain="SELECT * FROM tb_kain WHERE idkain ='$kain'";
							$pkain=mysqli_query($con,$qkain);
							while ($dkain = mysqli_fetch_array ($pkain)){
								$namakain=$dkain['namakain'];
							}
							$qukuran="SELECT * FROM tb_ukuran WHERE id ='$ukuran'";
							$pukuran=mysqli_query($con,$qukuran);
							while ($dukuran = mysqli_fetch_array ($pukuran)){
								$size=$dukuran['ukuran'];
							}
							
							
								
							echo"
								<div class='col l1' style='margin-top:20px;'>
									<a style='color:#d89034; font-family:Lora' href='tayhisdet.php?kd=".$kd."'>$kd</a>
								</div>
								<div class='col l4' style='margin-top:20px;'>
									$namakat, $namakain, $size
								</div>
								<div class='col l3' style='margin-top:20px;'>
									Pesanan sedang dikerjakan
								</div>
							</div>
							";
						}
					}
				?>
				
			</div>
			
		</div>

	
	<script type="text/javascript">
	
	
	
	</script>
	
</body>
</html>

