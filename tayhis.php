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
	
	<!--FUNGSI PHP untuk mengedit, menghapus, dan menambah data-->
	
	<?php
		include 'connect.php';
		
		$idu=$_COOKIE['id'];
		if($idu==NULL){
			header('location:login.php');
		}
		
		if(isset($_GET['kd']) && isset($_GET['idp'])&& isset($_GET['b'])){            
			$kd=$_GET['kd'];
			$idp=$_GET['idp'];
			
			$query="UPDATE order_jahit_".$idp." SET bayar=0 WHERE kdbooking='$kd'";
			$process = mysqli_query($con,$query);
			//echo "<script>Materialize.toast('".$total."', 6000)</script>";
			if ($process) {
				header('location:history.php');
				
			}
			else
			{
				echo "<script>Materialize.toast('".$kd." Gagal', 6000)</script>";
			}
		}
	?>
	
	<!--UI Web-->	

			<div class="row col l12 m12 s12" style="background-color: #351e16; margin-right:80px; margin-left:80px;">
				<div class="col l8 m12 s12" style="text-align:left; font-family: 'Raleway Dots', cursive; color:white; font-size:40px; padding:10px; padding-left:100px;">MEETJAHIT</div>
				<a id="head" href="tay.php" class="col l1" style="padding:20px; margin-top:8px; text-align:center; font-size:16px;">HOME</a>
				<a id="head" href="tayhis.php" class="col l1" style="padding:20px; margin-top:8px; text-align:center; font-size:16px;">HISTORY</a>
				<a id="head" href="proftay.php" class="col l1" style="padding:20px; margin-top:8px; text-align:center; font-size:16px;">PROFILE</a>
				<a id="head" href="index.php" class="col l1" style="padding:20px; margin-top:8px; text-align:center; font-size:16px;">X</a>
			</div >

			
		<div class="col l12 m12 s12" style="background-color: rgba(104, 73, 50,0.7); margin-top:-20px; margin-left:80px; margin-right:80px; text-align:center; padding:40px;">
		
			<div class="col row l12 m12 s12" style="background-color: rgba(255, 255, 255,0.5); padding:16px;  color:white; font-size:16px; font-family:Raleway">
			<?php
			
		
			$myq="SELECT * FROM order_jahit_".$idu." order by tglorder DESC";
			$myp=mysqli_query($con,$myq);
			while ($his = mysqli_fetch_array ($myp)){
					$kd=$his['kdbooking'];
					$idp=$his['idpelanggan'];
					$alamat=$his['alamat'];
					$kain=$his['kain'];
					$desain=$his['desain'];
					$kategori=$his['kategori'];
					$ukuran=$his['ukuran'];
					$jumlah=$his['jumlah'];
					$progress=$his['progress'];
					$kirim=$his['kirim'];
					$dater=$his['tglorder'];
					$timer=$his['timeorder'];
					
					$diff = date_diff((date_create($dater)),date_create(date("Y-m-d")));
					$days= $diff->format("%a"); //days different from today to the day you ordered
					
					echo"
						<div class='col l6 m12 s12' style='padding:16px;'>
							<div class='col l12 m12 s12' style='background-color:rgba(0, 0, 0,0.8); padding:16px;'>
							<div style='background-color:#d89034; padding:4px; font-size:20px;>
								<a href='#order' style='padding-top:4px; '>Kode Pemesanan: ".$kd."</a>
							</div>
						";
								$q="SELECT * FROM tb_user WHERE idu = '$idp'";
								$p=mysqli_query($con,$q);
								while ($user = mysqli_fetch_array ($p)){
									echo"<div style='padding-top:4px; font-size:16px;'>Pesanan dari: ".$user['nama']."</div>";	
								}							
						echo"
								<div style='padding-top:4px; font-size:15px;'>Tanggal order: $dater, $timer WIB</div>	
							";
					
					if($his['kirim']==1){
						$status="Transaksi selesai";
						echo"
								<div  class='col l6 m12 s12'  style='padding:4px; font-size:16px; color:rgba(9,242,44,1);'>".$status."</div>	
						";
					}
					else if($his['kirim']==2){
						$status="Menunggu konfirmasi resi";
						echo"
								<div  class='col l6 m12 s12'  style='padding:4px; font-size:16px; color:rgba(170, 240, 27,1)'>".$status."</div>	
						";
					}
					else if($his['kirim']==3){
						$status="Menunggu feedback pelanggan";
						echo"
								<div  class='col l6 m12 s12'  style='padding:4px; font-size:16px; color:rgba(170, 240, 27,1)'>".$status."</div>	
						";
					}
					else if(($his['bayar']==0||$his['bayar']==NULL||$his['bayar']==2)&& ($days<=1)){
						$status="Sedang menunggu pembayaran";
												
						echo"		
								<div class='col l6 m12 s12'  style='padding:4px; font-size:16px; color:rgb(255, 53, 133);'>".$status."</div>									
						";
					}
					
					else if((($his['bayar']==0||$his['bayar']==NULL)&& ($days>1))||($his['bayar']==3)){
						$status="Transaksi dibatalkan";					
						echo"		
							<div class='col l6 m12 s12'  style='padding:4px; font-size:16px; color:rgba(216, 144, 255,1);'>".$status."</div>
						";
					}
					else if(($his['bayar']==1)&&($his['progress']==0)&&($his['kirim']==0)){
						$status="Pesanan akan dikerjakan";
												
						echo"		
							<div class='col l6 m12 s12'  style='padding:4px; font-size:16px; color:rgba(216, 144, 52,1);'>".$status."</div>
						";
						
					}
					else if(($his['bayar']==1)&&($his['progress']==1)&&($his['kirim']==0)){
						$status="Pesanan sedang dikerjakan";
												
						echo"		
							<div class='col l6 m12 s12'  style='padding:4px; font-size:16px; color:rgba(218, 249, 39,1);'>".$status."</div>
						";
					}
					
					echo"
						
						<a href='tayhisdet.php?kd=".$kd."' style='padding-top:8px; font-size:18px; color:rgba(0,255,255,1)' text-align:right;>Lihat rincian>>></a>
						</div>
						</div>
					";
			}
			
			
			?>
			
			</div>
			</div>
		
	
	<!--Modal untuk menampilkan rincinan pemesanan-->
	  <div id="order" class="modal" style="text-align:left; font-family:Amatic; font-size:18px;">
		<div class="modal-content">
		  <?php
			include 'connect.php';
			
			echo"
				<div style='padding:4px;'>Kode Pemesanan: $kd</div>
				<div style='padding:4px;'>Tanngal pemesanan: $dater $timer WIB</div>
				<div style='padding:4px;'>Alamat pengiriman: $alamat</div>
				<div style='padding:4px;'>Kategori: $kategori</div>
				<div style='padding:4px;'>Kain: $kain</div>
				<div style='padding:4px;'>Ukuran: $ukuran</div>
				<div style='padding:4px;'>Jumlah: $jumlah</div>
				<div style='padding:4px;'>Desain: $desain</div>
			";
			
				if($his['kirim']==1){
					$status="Transaksi selesai";
					echo"
						<div  style='padding:4px; color:rgba(0,255,255,1);'>".$status."</div>	
					";
				}
				else if($his['bayar']==0||$his['bayar']==NULL){
					$status="Sedang menunggu pembayaran";							
					echo"
						<div style='text-align:right; font-family:Raleway; margin-top: 16px;'>
						<a href='history.php?kd=".$kd."&idp=".$idp."&b=1' style='padding:8px; color:white; background-color:rgb(240,0,95);'>UNGGAH BUKTI PEMBAYARAN</a>	
						</div>
					";
				}
				else if(($his['bayar']==1)&&($his['kirim']==0)){
					$status="Pesanan dalam proses";							
					echo"		
						<div class='col l6 m12 s12'  style='padding:4px; color:rgba(216, 144, 52,1);'>".$status."</div>
					";
				}
					
			
		  ?>
		</div>
		<div class="modal-footer">
		  <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat">Tutup</a>
		</div>
	  </div>	
	
	<script type="text/javascript">
		function goBack() {
			window.history.back();
		}
	</script>
	
</body>
</html>

