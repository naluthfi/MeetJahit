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
		//$idu=$_COOKIE['id'];
		/*if($idu==NULL){
			header('location:login.php');
		}*/
		
		$jus=0;$jum=0;$jul=0;$juxl=0;$juxxl=0;$juxxxl=0;
		$jpesan=0; $allincome=0;
		$porders=0; $sorders=0; $norders=0; $allorders=0;
		$jfrow=0;$jsrow=0;$jprow=0;$jnrow=0;$jarow=0;$jbrow=0;$japot=0;$jrating=0;
		$jrow=0;
		$jseragam=0; $jkaospria=0; $jatpria=0; $jformpria=0; $jmuspria=0; 
		$jcpria=0; $jjaket=0; $jmw=0; $jcw=0; $jatw=0;
		$janak=0; $jkebaya=0; $jfw=0; $jrok=0; $jkaoswan=0; 
		$porders=0;$borders=0;
		$rrate=0; $lrate=5; //lowest and biggest rating
		$toporder=0; $topcont=0; //top order and contributions
		$quer="SELECT * FROM tb_user WHERE profesi=1";
		$pros=mysqli_query($con,$quer);
		while ($dat = mysqli_fetch_array ($pros)){
			$idp=$dat['idu'];
			$pava=$dat['avatar'];
			$pemail=$dat['email'];
			$puser=$dat['username'];
			$pnama=$dat['nama'];
			$palamat=$dat['alamat'];
			$pkec=$dat['kecamatan'];
			$pcity=$dat['kabupaten'];
			$pprov=$dat['provinsi'];
			$ppos=$dat['kodepos'];
		
			$lorat=0;
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
				
			$jrating=$jrating+$rating;
			$jpesan=$jpesan+$ppesan;
			$jrow=$jrow+$row;
			
			$lorat=$lorat+$rating;
			$lorate=round(($lorat/$row),2);
			//$avrate=$jrating/$jpesan;
			
			$avrate=round(($jrating/$jrow),2);
			if($rrate<=$lorate){
				$rrate=$lorate;
				$idtop=$idp;
				$nmtop=$pnama;
				$avatop=$pava;
			}
			if($lrate>=$lorate){
				$lrate=$lorate;
				$idlow=$idp;
				$nmlow=$pnama;
				$avalow=$pava;
			}
			
			//NEW ORDERS
			$nq="SELECT * FROM order_jahit_".$idp." WHERE (bayar=0 OR bayar=2)";
			$np=mysqli_query($con,$nq);
			$nrow=mysqli_num_rows($np); //banyaknya data (baris table) di database
			while ($nd = mysqli_fetch_array ($np)){
				$pjml=$nd['jumlah'];
				$norders=$norders+$pjml;
			}
			
			//PESANAN SELESAI
			$fq="SELECT * FROM order_jahit_".$idp." WHERE kirim='1'";
			$fp=mysqli_query($con,$fq);
			$frow=mysqli_num_rows($fp); //banyaknya data (baris table) di database
			
			//PESANAN SEDANG DIKERJAKAN
			$pq="SELECT * FROM order_jahit_".$idp." WHERE (progress=1 AND (kirim=0 or kirim is null))";
			$pp=mysqli_query($con,$pq);
			$prow=mysqli_num_rows($pp); //banyaknya data (baris table) di database
			while ($pd = mysqli_fetch_array ($pp)){
				$pjml=$pd['jumlah'];
				$porders=$porders+$pjml;
			}
			
			//PESANAN AKAN DIKERJAKAN
			$sq="SELECT * FROM order_jahit_".$idp." WHERE bayar=1 and (progress is null or progress=0)";
			$sp=mysqli_query($con,$sq);
			$srow=mysqli_num_rows($sp); //banyaknya data (baris table) di database
			while ($sd = mysqli_fetch_array ($sp)){
				$pjml=$sd['jumlah'];
				$sorders=$sorders+$pjml;
			}
						
			//SELURUH PESANAN
			$aor=0;
			$aq="SELECT * FROM order_jahit_".$idp."";
			$ap=mysqli_query($con,$aq);
			$arow=mysqli_num_rows($ap); //banyaknya data (baris table) di database
			while ($ad = mysqli_fetch_array ($ap)){
				$ajml=$ad['jumlah'];
				$income=$ad['harga'];
				$allorders=$allorders+$ajml; //jumlah potong seluruh pesanan
				$aor=$aor+$ajml; //jumlah potong seluruh pesanan
				$japot=$japot+$ajml; //jumlah potong seluruh pesanan
				$allincome=$allincome+$income; //jumlah potong seluruh pesanan
			}
			
			$jfrow=$jfrow+$frow;
			$jsrow=$jsrow+$srow;
			$jprow=$jprow+$prow;
			$jnrow=$jnrow+$nrow;
			$jarow=$jarow+$arow; //seluruh pesanan
			
			
			if($toporder<$arow){ //top orders (transaksi)
				$toporder=$arow;
				$idto=$idp;
				$nmto=$pnama;
				$avato=$pava;
			}
			if($topcont<$aor){ //top contributions (potong)
				$topcont=$aor;
				$idtc=$idp;
				$nmtc=$pnama;
				$avatc=$pava;
			}
			
			$jbrow=$jarow-($jfrow+$jsrow+$jprow+$jnrow); //pesanan batal
			$borders=$allorders-($sorders+$porders+$norders+$jpesan); //jumlah potong pesanan batal
			
			//PESANAN BERDASAR KATEGORI
			$qjen="SELECT * FROM tb_jenis";
			$pjen=mysqli_query($con,$qjen);
			while ($djen = mysqli_fetch_array ($pjen)){
				$idkat=$djen['id'];
				//$idkat=12;
				$oq="SELECT * FROM order_jahit_".$idp." WHERE kategori='$idkat'";
				$op=mysqli_query($con,$oq);
				$or=mysqli_num_rows($op); //banyaknya data (baris table) di database
				while ($ad = mysqli_fetch_array ($ap)){
					$kjml=$djen['id'];
				}
				if($idkat==1) {
					$jseragam=$jseragam+$or;
				}
				else if ($idkat==2) $jkaospria=$jkaospria+$or;
				else if ($idkat==3) $jatpria=$jatpria+$or;
				else if ($idkat==4) $jcpria=$jcpria+$or;
				else if ($idkat==5) $jmuspria=$jmuspria+$or;
				else if ($idkat==6) $jformpria=$jformpria+$or;
				else if ($idkat==7) $jkaoswan=$jkaoswan+$or;
				else if ($idkat==8) $jatw=$jatw+$or;
				else if ($idkat==9) $jrok=$jrok+$or;
				else if ($idkat==10) $jcw=$jcw+$or;
				else if ($idkat==11) $jmw=$jmw+$or;
				else if ($idkat==12) $jkebaya=$jkebaya+$or;
				else if ($idkat==14) $janak=$janak+$or;
				else if ($idkat==13) $jfw=$jfw+$or;
				else $jjaket=$jjaket+$or;
				
			}
			
			//PESANAN BERDASAR UKURAN
			$uq="SELECT * FROM tb_ukuran";
			$up=mysqli_query($con,$uq);
			while ($ud = mysqli_fetch_array ($up)){
				$iduk=$ud['id'];
				//$idkat=12;
				$oq="SELECT * FROM order_jahit_".$idp." WHERE ukuran='$iduk'";
				$op=mysqli_query($con,$oq);
				$or=mysqli_num_rows($op); //banyaknya data (baris table) di database
				while ($ad = mysqli_fetch_array ($ap)){
					$kjml=$djen['id'];
				}
				if($iduk==1) $jus=$jus+$or;
				else if ($iduk==2) $jum=$jum+$or;
				else if ($iduk==3) $jul=$jul+$or;
				else if ($iduk==4) $juxl=$juxl+$or;
				else if ($iduk==5) $juxxl=$juxxl+$or;
				else $juxxxl=$juxxxl+$or;
				
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
		
		
			
		<div class="col l12 m12 s12" style="background-color: rgba(104, 73, 50,0.9); margin-top:-20px; margin-left:80px; margin-right:80px; padding:20px; text-align:center;">
			
			<div class="col row l2 m12 s12" style="background-color:rgba(255, 255, 255,0); text-align:left;  padding:16px; font-size:17px;">
				
				<div class="col row l2 m12 s12" style="background-color:rgba(0, 0, 0,0.7); text-align:left; padding:10px; margin-right:16px; margin-left:24px;">
					<div class="col l12" style="background-color:rgba(0, 255, 255,0.7); text-align:left; padding:8px; padding-bottom:40px; padding-top:24px;">
						<div class="col l12" style="font-size:18px; color:white">
							Average Rating
						</div>
						<div class="col l12" style="font-size:32px;color:white;">
							<?php echo"$avrate ";?>/ 5
						</div>
					</div>
					<div class="col l12" style="background-color:rgba(0, 245, 255,0.7); text-align:left; padding-top:8px; padding-left:8px; padding-right:8px; margin-top:10px;">
						<div class="col l12" style="font-size:18px;color:white">
							Top Rating
						</div>
						<div class="col l12" style="font-size:32px; color:white; ">
							<?php echo"$rrate ";?> / 5
						</div>
						<div class="col row l12" style="text-align:center; background-color:rgba(255,255,255,0); margin-top:8px; padding:4px;">
							<div class="col l2" style="">
							<?php echo"<img src='img/tailor/".$avatop.".png' width='32' height='32' alt=''/>";?>
							</div>
							<div class="col l10" style="font-size:16px; color:black; margin-top:4px;">
							<?php echo" <a href='orpen.php?id=".$idtop."' style='text-align:center; color:rgb(255,255,50); font-size:17px;'> $nmtop ";?></a>
							</div>
						</div>
					</div>
					<div class="col l12" style="background-color:rgba(0, 245, 245,0.7); text-align:left; padding-top:8px; padding-left:8px; padding-right:8px; margin-top:10px;">
						<div class="col l12" style="font-size:18px;color:white">
							Lowest Rating
						</div>
						<div class="col l12" style="font-size:32px; color:white; ">
							<?php echo"$lrate ";?> / 5
						</div>
						<div class="col row l12" style="text-align:center; background-color:rgba(255,255,255,0); margin-top:8px; padding:4px;">
							<div class="col l2" style="">
							<?php echo"<img src='img/tailor/".$avalow.".png' width='32' height='32' alt=''/>";?>
							</div>
							<div class="col l10" style="font-size:16px; color:black; margin-top:4px;">
							<?php echo" <a href='orpen.php?id=".$idlow."' style='text-align:center;color:rgb(255,255,50); font-size:17px;'> $nmlow ";?></a>
							</div>
						</div>
					</div>
				</div>
				
				
			
				<div class="col l3 m12 s12" style="background-color:rgba(0, 0, 0,0); text-align:left; color:white; padding:0px; font-size:15px; margin-right: 16px;">
				<div class="col l12 m12 s12" style="background-color:rgba(0, 0, 0,0.7); text-align:left; color:white; padding:10px; font-size:15px; margin-right: 16px;">
					
					<div class="col l12" style="font-size:19px; text-align:center;">
						WOMENS CLOTHES
					</div>
					<div class="col l12" style="background-color:rgba(200, 70, 50,0.7); text-align:left; padding:8px; margin-top:10px;">
						<div class="col l12" style="color:white">
							Kaos Wanita: <?php echo"$jkaoswan";?> transaksi
						</div>
					</div>
					<div class="col l12" style="background-color:rgba(200, 80, 60,0.7); text-align:left; padding:8px; margin-top:10px;">
						<div class="col l12" style="color:white">
							Atasan Wanita: <?php echo"$jatw";?> transaksi
						</div>
					</div>
					<div class="col l12" style="background-color:rgba(200, 90, 70,0.7); text-align:left; padding:8px; margin-top:10px;">
						<div class="col l12" style="color:white">
							Celana Wanita: <?php echo"$jcw";?> transaksi
						</div>
					</div>
					<div class="col l12" style="background-color:rgba(200, 90, 70,0.7); text-align:left; padding:8px; margin-top:10px;">
						<div class="col l12" style="color:white">
							Rok Wanita: <?php echo"$jrok";?> transaksi
						</div>
					</div>
					<div class="col l12" style="background-color:rgba(200, 100, 80,0.7); text-align:left; padding:8px; margin-top:10px;">
						<div class="col l12" style="color:white">
							Pakaian Muslim Wanita: <?php echo"$jmw";?> transaksi
						</div>
					</div>
					<div class="col l12" style="background-color:rgba(200, 110, 90,0.7); text-align:left; padding:8px; margin-top:10px;">
						<div class="col l12" style="color:white">
							Pakaian Formal Wanita: <?php echo"$jfw";?> transaksi
						</div>
					</div>
					<div class="col l12" style="background-color:rgba(200, 120, 100,0.7); text-align:left; padding:8px; margin-top:10px;">
						<div class="col l12" style="color:white">
							Kebaya: <?php echo"$jkebaya";?> transaksi
						</div>
					</div>
					</div>
					<div class="col l12 m12 s12" style="background-color:rgba(0, 0, 0,0.7); text-align:left; color:white; padding:10px; margin-top:10px; margin-right: 16px;">
					<div class="col l12" style="font-size:19px; text-align:center;">
						ALL INCOME
					</div>
					<div class="col l12" style="background-color:rgba(255, 255, 255,0.8); text-align:center; font-size:24px; padding:4px; margin-top:4px; color:green;">
							Rp <?php $currency = number_format($allincome,2,',','.'); echo $currency?>
					</div>
					</div>
					
				</div>
				
				
				<div class="col l3 m12 s12" style="background-color:rgba(0, 0, 0,0); text-align:left; color:white; padding:0px; font-size:15px; margin-right: 16px;">
				<div class="col l12 m12 s12" style="background-color:rgba(0, 0, 0,0.7); text-align:left; color:white; padding:10px; font-size:15px; margin-right: 16px;">
					<div class="col l12" style="font-size:19px; text-align:center;">
						MENS CLOTHES
					</div>
					<div class="col l12" style="background-color:rgba(60, 80, 200,0.7); text-align:left; padding:8px; margin-top:10px;">
						<div class="col l12" style="color:white">
							Kaos Pria: <?php echo"$jkaospria";?> transaksi
						</div>
					</div>
					<div class="col l12" style="background-color:rgba(70, 90, 200,0.7); text-align:left; padding:8px; margin-top:10px;">
						<div class="col l12" style="color:white">
							Atasan Pria: <?php echo"$jatpria";?> transaksi
						</div>
					</div>
					<div class="col l12" style="background-color:rgba(80, 90, 200,0.7); text-align:left; padding:8px; margin-top:10px;">
						<div class="col l12" style="color:white">
							Celana Pria: <?php echo"$jcpria";?> transaksi
						</div>
					</div>
					<div class="col l12" style="background-color:rgba(90, 100, 200,0.7); text-align:left; padding:8px; margin-top:10px;">
						<div class="col l12" style="color:white">
							Pakaian Muslim Pria: <?php echo"$jmuspria";?> transaksi
						</div>
					</div>
					<div class="col l12" style="background-color:rgba(100, 110, 200,0.7); text-align:left; padding:8px; margin-top:10px;">
						<div class="col l12" style="color:white">
							Pakaian Formal Pria: <?php echo"$jformpria";?> transaksi
						</div>
					</div>
					</div>
				<div class="col l12 m12 s12" style="background-color:rgba(0, 0, 0,0.7); text-align:left; color:white; padding-left:10px; padding-right:10px; padding-top:8px; font-size:15px; margin-right: 16px; margin-top:24px;">
					<div class="col l12" style="font-size:19px; text-align:center; margin-top:0px;">
						ORDERS BY SIZE
					</div>
					<div class="col row l12" style="background-color:rgba(60, 80, 200,0); text-align:left; padding:0px; margin-top:0px;">
					<div class="col l6" style="background-color:rgba(200, 80, 200,0.7); text-align:left; padding:2px; margin-top:14px;">
						<div class="col l12" style="color:white">
							S: <?php echo"$jus";?> transaksi
						</div>
					</div>
					<div class="col l6" style="background-color:rgba(200, 80, 200,0.7); text-align:left; padding:2px; margin-top:14px;">
						<div class="col l12" style="color:white">
							M: <?php echo"$jum";?> transaksi
						</div>
					</div>
					<div class="col l6" style="background-color:rgba(200, 80, 200,0.7); text-align:left; padding:2px; margin-top:14px;">
						<div class="col l12" style="color:white">
							L: <?php echo"$jul";?> transaksi
						</div>
					</div>
					<div class="col l6" style="background-color:rgba(200, 80, 200,0.7); text-align:left; padding:2px; margin-top:14px;">
						<div class="col l12" style="color:white">
							XL: <?php echo"$juxl";?> transaksi
						</div>
					</div>
					<div class="col l6" style="background-color:rgba(200, 80, 200,0.7); text-align:left; padding:2px; margin-top:14px;">
						<div class="col l12" style="color:white">
							XXL: <?php echo"$juxxl";?> transaksi
						</div>
					</div>
					<div class="col l6" style="background-color:rgba(200, 80, 200,0.7); text-align:left; padding:2px; margin-top:14px;">
						<div class="col l12" style="color:white">
							XXXL: <?php echo"$juxxxl";?> transaksi
						</div>
					</div>
					</div>
					
				</div>
				</div>
				
				<div class="col l3 m12 s12" style="background-color:rgba(0, 0, 0,0.7); text-align:left; color:white; padding:10px; font-size:15px; margin-right: 16px;">
				
					<div class="col l12" style="font-size:19px; text-align:center;">
						ALL GENDERS
					</div>
					
					<div class="col l12" style="background-color:rgba(230, 230, 40,0.7); text-align:left; padding:8px; margin-top:10px;">
						<div class="col l12" style="color:white">
							Seragam: <?php echo"$jseragam";?> transaksi
						</div>
					</div>
					<div class="col l12" style="background-color:rgba(220, 220, 50,0.7); text-align:left; padding:8px; margin-top:10px;">
						<div class="col l12" style="color:white">
							Jaket / Sweater: <?php echo"$jjaket";?> transaksi
						</div>
					</div>
					<div class="col l12" style="background-color:rgba(210, 210, 60,0.7); text-align:left; padding:8px; margin-top:10px;">
						<div class="col l12" style="color:white">
							Pakaian Anak: <?php echo"$janak";?> transaksi
						</div>
					</div>
				</div>
				
				<div class="col l3 m12 s12" style="background-color:rgba(0, 0, 0,0.6); text-align:left; color:white; padding:10px; font-size:22px; margin-right: 16px; margin-top:10px;">
				<div class="col l12 m12 s12" style="background-color:rgba(0, 100, 0,0.7); text-align:left; color:white; padding:10px; font-size:21px; margin-right: 16px;">
				
					<div class="col l12" style="font-size:19px; text-align:left;">
						Top Orders
					</div>
					
					<div class="col l12" style="background-color:rgba(230, 230, 230,0); text-align:left;">
							<?php echo"$toporder";?> transaksi
					</div>
					<div class="col l12" style="background-color:rgba(255, 255, 255,0.8); text-align:left; padding:2px; margin-top:0px;">
						<div class="col l2" style=" margin-top:4px;">
							<?php echo"<img src='img/tailor/".$avato.".png' width='32' height='32' alt=''/>";?>
							</div>
							<div class="col l10" style="font-size:16px; color:black; margin-top:6px;">
							<?php echo" <a href='orpen.php?id=".$idto."' style='text-align:center;color:rgb(60,190,15); font-size:17px;'> $nmto";?></a>
							</div>
					</div>
				</div>
				<div class="col l12 m12 s12" style="background-color:rgba(100, 100, 0,0.7); text-align:left; color:white; padding:10px; font-size:21px; margin-right: 16px; margin-top:10px;">
				
					<div class="col l12" style="font-size:19px; text-align:left;">
						Top Production
					</div>
					
					<div class="col l12" style="background-color:rgba(230, 230, 230,0); text-align:left;">
							<?php echo"$topcont";?> potong
					</div>
					<div class="col l12" style="background-color:rgba(255, 255, 255,0.8); text-align:left; padding:2px; margin-top:0px;">
						<div class="col l2" style=" margin-top:4px;">
							<?php echo"<img src='img/tailor/".$avatc.".png' width='32' height='32' alt=''/>";?>
							</div>
							<div class="col l10" style="font-size:16px; color:black; margin-top:6px;">
							<?php echo" <a href='orpen.php?id=".$idtc."' style='text-align:center;color:rgb(60,190,15); font-size:17px;'> $nmtc ";?></a>
							</div>
					</div>
				</div>
				</div>
				
				
				<div class="col l12 m12 s12" style="background-color:rgba(0, 0, 0,0.6); text-align:center; padding:10px; margin-top:24px; padding-left:0px;">
				
					<div class="col l2" style="background-color:rgba(30, 30, 230,0.7); text-align:left; padding:8px;">
						<div class="col l12" style="font-size:18px;color:white">
							Total pesanan
						</div>
						<div class="col l12" style="font-size:20px; color:white; ">
							<?php echo"$jarow ";?> transaksi
						</div>
						<div class="col l12" style="font-size:18px; color:white; padding-bottom:8px;">
							<?php echo"($japot ";?> potong)
						</div>
					</div>
					<div class="col l2" style="background-color:rgba(100, 230, 70,0.7); text-align:left; padding:8px;">
						<div class="col l12" style="font-size:18px;color:white">
							Transaksi selesai
						</div>
						<div class="col l12" style="font-size:20px; color:white; ">
							<?php echo"$jfrow ";?> transaksi
						</div>
						<div class="col l12" style="font-size:18px; color:white; padding-bottom:8px;">
							<?php echo"($jpesan ";?> potong)
						</div>
					</div>
					
					<div class="col l2" style="background-color:rgba(200, 30, 30,0.7); text-align:left; padding:8px; margin-left:0px;">
						<div class="col l12" style="font-size:18px;color:white">
							Transaksi Batal
						</div>
						<div class="col l12" style="font-size:20px; color:white; ">
							<?php echo"$jbrow ";?> transaksi
						</div>
						<div class="col l12" style="font-size:18px; color:white; padding-bottom:8px;">
							<?php echo"($borders ";?> potong)
						</div>
					</div>
					
					<div class="col l2" style="background-color:rgba(240, 150, 52,0.7); text-align:left; padding:8px; margin-left:0px;">
						<div class="col l12" style="font-size:18px;color:white">
							Sedang dikerjakan
						</div>
						<div class="col l12" style="font-size:20px; color:white; ">
							<?php echo"$jprow ";?> transaksi
						</div>
						<div class="col l12" style="font-size:18px; color:white; padding-bottom:8px;">
							<?php echo"($porders ";?> potong)
						</div>
					</div>
					<div class="col l2" style="background-color:rgba(233, 233, 10,0.7); text-align:left; padding:8px; margin-left:0px;">
						<div class="col l12" style="font-size:18px;color:white">
							Akan dikerjakan
						</div>
						<div class="col l12" style="font-size:20px; color:white; ">
							<?php echo"$jsrow ";?> transaksi
						</div>
						<div class="col l12" style="font-size:18px; color:white; padding-bottom:8px;">
							<?php echo"($sorders ";?> potong)
						</div>
					</div>
					<div class="col l2" style="background-color:rgba(200, 30, 200,0.7); text-align:left; padding:8px; margin-left:0px;">
						<div class="col l12" style="font-size:18px;color:white">
							Pesanan Baru
						</div>
						<div class="col l12" style="font-size:20px; color:white; ">
							<?php echo"$jnrow ";?> transaksi
						</div>
						<div class="col l12" style="font-size:18px; color:white; padding-bottom:8px;">
							<?php echo"($norders ";?> potong)
						</div>
					</div>
				</div>
				
			</div>
		
			
		</div>

	
	<script type="text/javascript">
	
	
	
	</script>
	
</body>
</html>

