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
	<!--FUNGSI PHP untuk mengedit, menghapus, dan menambah data-->
	<?php
		include 'connect.php';
		session_start();
		$idu=$_COOKIE['id'];
		if(isset($_POST['kategori']) && isset($_GET['go'])){
			$_SESSION['kat'] =  $_POST['kategori'];
			header("location:cusfilt.php");
		}
	?>


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
	
	<!-- Dropdown Structure -->
	<ul id='dropexit' class='dropdown-content'>
		<li><a href="#!">one</a></li>
		<li><a href="#!">two</a></li>
		<li class="divider"></li>
		<li><a href="#!">three</a></li>
		<li><a href="#!"><i class="material-icons">view_module</i>four</a></li>
		<li><a href="#!"><i class="material-icons">cloud</i>five</a></li>
	</ul>
        
	<!--UI Web-->	

			<div class="row col l12 m12 s12" style="background-color: #351e16; margin-right:80px; margin-left:80px;">
				<div class="col l9 m12 s12" style="text-align:left; font-family: 'Raleway Dots', cursive; color:white; font-size:40px; padding:10px; padding-left:100px;">MEETJAHIT</div>
				<a id="head" href="cus.php" class="col l1" style="padding:20px; margin-top:8px; text-align:center; font-size:16px;">HOME</a>
				<a id="head" href="profile.php" class="col l1" style="padding:20px; margin-top:8px; text-align:center; font-size:16px;">PROFILE</a>
				<a id="head" href="index.php" class="col l1" style="padding:20px; margin-top:8px; text-align:center; font-size:16px;">X</a>
			</div >
		
		
			
		<div class="col l12 m12 s12" style="background-color: rgba(104, 73, 50,0.7); margin-top:-20px; margin-left:80px; margin-right:80px; padding:20px; text-align:center;">
			<div class="col l12 m12 s12" style=" margin-left:80px; opacity:1; font-size: 20px; font-family: 'Raleway'; color:white; text-align:left;">Cari penjahit anda sekarang!
			</div>
			<form class="row col l12" action="cus.php?go=1" method="post" style="margin-right:160px;">
				<div class="col l12" style="margin-left:64px;">
					  
					  <div class="input-field col l3" style="background-color: transparent; color:black;">
						<select class="browser-default" name="kategori" style="font-size:16px;">
						<option>Pilih Kategori</option>
						<option value="0">~Semua Kategori</option>
						<?php
							$cek="SELECT * FROM tb_jenis ORDER by jenis";
							$prs=mysqli_query($con,$cek);
							while ($mhs = mysqli_fetch_array ($prs)){
								echo"<option value='".$mhs['id']."' style='color: black;'>".$mhs['jenis']."</option>";
							}
						?>
						</select>
					  </div>
					  
					  <div class="col l2" style="padding-top:20px;">
						<input class="waves-effect waves-light btn ts" style="" type="submit" size="6" value="FILTER">
					</div>
					
				</div>					 
			</form>
			
			
			
			<div class="col row l12 m12 s12" style="margin-left:64px; margin-right:64px; padding-top:10px;">
				<div id="content"></div>
			</div>
			
			
			<div class="row col l12 m12 s12" style="color:white;">
				<div class="row col l10 m12 s12" style="text-align:center;">
						<div  id="hal" class="col l1" style="text-align:right">	
						</div>
						<div  class="col l1">dari 
						</div>
						<div id="maks" class="col l1" style="text-align:left">
						</div>
					</div>
				<div class="col l2 m12 s12">
					<a  onclick="leftclick()" class="col l3 btn ts modal-trigger" style="margin:2px;"><i class="material-icons">arrow_back</i></a>
					<a  onclick="rightclick()" class="col l3 btn ts modal-trigger" style="margin:2px;"><i class="material-icons">arrow_forward</i></a>
				</div>
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

