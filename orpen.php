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
		session_start();
		$idu=$_COOKIE['id'];
		
		if(isset($_GET['id'])&& !isset($_GET['s'])){ //mengedit data
			$idp=$_GET['id'];
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
			
			$q="SELECT * FROM order_jahit_".$idp."";
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
			
			
			//if($pros) 
			//echo "<script>Materialize.toast('Data diperbaharui', 1000)</script>;";
		}
		if(isset($_GET['id']) && isset($_GET['s'])) {        
			$_SESSION['idp']=$_GET['id'];
			$_SESSION['alamat']=$_POST['alamat'];
			$_SESSION['kain']=$_POST['kain'];
			$_SESSION['ukuran']=$_POST['ukuran'];
			$_SESSION['kategori']=$_POST['kategori'];
			$_SESSION['jumlah']=$_POST['jumlah'];
			$_SESSION['desain']=$_POST['desain'];
			
			//echo "<script>Materialize.toast('".$total."', 6000)</script>";
			header('location:orpenpr.php');
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
			
			<div class="row col l12 m12 s12" style="color:white; text-align:left; padding-left:0px;">
				<div class="col l1 m12 s12">
					<a  onclick="goBack()" class="col l12 btn ts modal-trigger" style="background-color:transparent"><i class="material-icons">arrow_back</i></a>
				</div>
				<div class="col l10 m12 s12" style=" margin-left:80px; opacity:1; font-size: 20px; font-family: 'Raleway'; color:white; text-align:center;">Ayo Pesan sekarang!
				</div>
			</div>
			
			
			
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
			</div>";
			
			$myquery="SELECT * FROM tb_user WHERE idu='$idu'";
			$myprocess=mysqli_query($con,$myquery);
			while ($data = mysqli_fetch_array ($myprocess)){
				$myalamat=$data['alamat'];
				$mykec=$data['kecamatan'];
				$mycity=$data['kabupaten'];
				$myprov=$data['provinsi'];
				$mykodepos=$data['kodepos'];
			}
			
			echo"
			<div class='col row l9 m12 s12' style='padding-left:16px; padding-right:16px; text-align:center;'>
				<form id='form' class='col l12' action='orpen.php?id=$idp&s=1' method='post' style='background-color:rgba(216, 144, 52, 0.5); padding:16px;'>	
					<div class='row col l12' style=''>
						<div class='input-field col l12' style='color: white; text-align: left;'>Alamat
							<input placeholder='Alamat' label='alamat' value='".$myalamat.", ".$mykec.", ".$mycity.", ".$myprov.", ".$mykodepos."' name='alamat' type='text' style='background:transparent;' required>
						</div>
						<div class='input-field col l6' style='background-color: transparent; color:white; text-align:left;'>Ukuran
							<select class='browser-default' name='ukuran' style='color:black;'>
								<option>Pilih Ukuran</option>
								<option value='1'>S</option>
								<option value='2'>M</option>
								<option value='3'>L</option>
								<option value='4'>XL</option>
								<option value='5'>XXL</option>
								<option value='6'>XXXL</option>
							</select>
						</div>
						<div class='input-field col l6' style='background-color: transparent; color:white; text-align:left;'>Kategori
							<select class='browser-default' name='kategori' style='color:black;'>
								<option>Pilih Kategori</option>
			";
								$cek="SELECT * FROM tb_penjahit_".$idp."";
								$prs=mysqli_query($con,$cek);
								while ($mhs = mysqli_fetch_array ($prs)){
									$idk=$mhs['kategori'];
									$myq="SELECT * FROM tb_jenis WHERE id='$idk'";
									$myp=mysqli_query($con,$myq);
									while ($dat = mysqli_fetch_array ($myp)){
										echo"<option value='".$idk."' style='color: black;'>".$dat['jenis']."</option>";
									}
									
								}
								
			echo"
							</select>
						</div>
						<div class='input-field col l6' style='background-color: transparent; color:white; text-align:left;'>Kain
							<select class='browser-default' name='kain' style='color:black;'>
								<option>Pilih Kain</option>
			";
								$cek="SELECT * FROM tb_kain ORDER by namakain";
								$prs=mysqli_query($con,$cek);
								while ($mhs = mysqli_fetch_array ($prs)){
									echo"<option value='".$mhs['idkain']."' style='color: black;'>".$mhs['namakain']."</option>";
								}
								
			echo"
							</select>
						</div>
						
						<div class='input-field col l6' style='color: white; text-align: left;'>Jumlah
							<input placeholder='Jumlah' value='' name='jumlah' type='text' style='background:transparent;' required>
						</div>
						<div class='input-field col l12' style='color: white; text-align: left;'>Link Desain
							<input placeholder='Link Desain' value='' name='desain' type='text' style='background:transparent;' required>
						</div>
							 
					</div>
							 
					<div class='col l12 m12 s12' style='text-allign:right; padding-bottom:20px;'>
						<div class='col l12' style=''>
							<input class='waves-effect waves-light btn ts' style='border:0px white solid;' type='submit' size='6' value='Lanjut'>
						</div>
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

