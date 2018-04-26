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
		$kat = $_SESSION['kat'];
		$kota = $_SESSION['kota'];
		if(isset($_POST['kategori']) && isset($_POST['kota']) && isset($_GET['go'])){
			$_SESSION['kat'] =  $_POST['kategori'];
			$_SESSION['kota'] =  $_POST['kota'];
			header("location:cusfilter.php");
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
				<a id="head" href="mhs.php" class="col l1" style="padding:20px; margin-top:8px; text-align:center; font-size:16px;">HOME</a>
				<a id="head" href="profile.php" class="col l1" style="padding:20px; margin-top:8px; text-align:center; font-size:16px;">PROFILE</a>
				<a id="head" href="index.php" class="col l1" style="padding:20px; margin-top:8px; text-align:center; font-size:16px;">X</a>
			</div >
		
		
			
		<div class="col l12 m12 s12" style="background-color: rgba(104, 73, 50,0.7); margin-top:-20px; margin-left:80px; margin-right:80px; padding:20px; text-align:center;">
			<div class="col l12 m12 s12" style=" margin-left:80px; opacity:1; font-size: 20px; font-family: 'Raleway'; color:white; text-align:left;">Cari penjahit anda sekarang!</div>
			<form class="row col l12" action="cusfilter.php?go=1" method="post" style="margin-right:160px;">
				<div class="col l12" style="margin-left:80px;">
					  
					  <div class="input-field col l3" style="background-color: transparent; color:black;">
						<select class="browser-default" name="kategori" style="font-size:16px;">
						<option value="<?php echo $kat;?>" style="color: black;"> 
							<?php
								if($kat>0){
								$cari="SELECT * from tb_jenis WHERE id = '$kat'";
								$procari=mysqli_query($con,$cari);
								while ($mhs = mysqli_fetch_array ($procari)){
									echo"".$mhs['jenis']."";
								}
								}
								else{
									echo"~Semua Kategori";
								}
							?>
						</option>
						<?php
							$cek="SELECT * FROM tb_jenis ORDER by jenis";
							$prs=mysqli_query($con,$cek);
							while ($mhs = mysqli_fetch_array ($prs)){
								echo"<option value='".$mhs['id']."' style='color: black;'>".$mhs['jenis']."</option>";
							}
							echo"<option value='0' style='color: black;'>~Semua Kategori</option>";
						?>
						</select>
					  </div>
					  
					  <div class="input-field col l3" style="background-color: transparent; color:black;">
						<select class="browser-default" name="kota" style="font-size:16px;">
						<option value="<?php echo $kota; ?>">
							<?php
								if($kota!='0'){
								$cari="SELECT DISTINCT kabupaten FROM tb_user WHERE kabupaten = '$kota'";
								$procari=mysqli_query($con,$cari);
								while ($mhs = mysqli_fetch_array ($procari)){
									echo"".$mhs['kabupaten']."";
								}
								}
								else{
									echo"~Semua Kategori";
								}
							?>
						</option>
						<?php
							$cek="SELECT DISTINCT kabupaten FROM tb_user";
							$prs=mysqli_query($con,$cek);
							while ($mhs = mysqli_fetch_array ($prs)){
								echo"<option value='".$mhs['kabupaten']."' style='color: black;'>".$mhs['kabupaten']."</option>";
							}
						?>
						</select>
					  </div>
					  			
					  
					  <div class="col l2" style="padding-top:20px;">
						<input class="waves-effect waves-light btn ts" style="" type="submit" size="6" value="FILTER">
					</div>
					
				</div>					 
			</form>
		
			<div class="col l12 m12 s12" style="margin-left:80px; margin-right:80px; padding-top:10px;">
				<div id="data"></div>
				
			</div>
			
			
			<div class="col row l12 m12 s12" style="margin-left:80px; margin-right:80px; padding-top:10px;">
				<?php
									include 'connect.php';
									$idu=$_COOKIE['id'];
									
									$queri="SELECT * from tb_user WHERE profesi=1 order by idu";

									$proses=mysqli_query($con,$queri);
									while ($data = mysqli_fetch_array ($proses)){
										$username=$data['username'];		
										$idp=$data['idu'];
										
										if($kat>0){
											
										$quer="SELECT * from tb_penjahit_".$idp." WHERE kategori = ".$kat."";
										$pros=mysqli_query($con,$quer);
										$row=mysqli_num_rows($pros);
										if($row>0){
										echo "
										<div class='col row l3 m12 s12' style='padding:16px;'>
										<div class='col l12 m12 s12' style='background-color:rgba(255, 255, 255,0.6); padding:16px;'>
											<img src='img/desainer/ex-desainer.jpg' width='120' height='120' alt=''/>
											<div>
												<a style='color:#d89034; font-size:16px;' href='order.php?id=".$data['idu']."'>$username</a>
											</div>
											<div>".$data['nama']."</div>
											<div>  
												<a style='margin-top:8px; ' href='order.php?id=".$data['idu']."' class='waves-effect waves-light btn ts';'>Order</a>
											</div>
										</div>
										</div>
									
										";
										}
										}
										else{
											echo "
										<div class='col row l3 m12 s12' style='padding:16px;'>
										<div class='col l12 m12 s12' style='background-color:rgba(255, 255, 255,0.6); padding:16px;'>
											<img src='img/desainer/ex-desainer.jpg' width='120' height='120' alt=''/>
											<div>
												<a style='color:#d89034; font-size:16px;' href='order.php?id=".$data['idu']."'>$username</a>
											</div>
											<div>".$data['nama']."</div>
											<div>  
												<a style='margin-top:8px; ' href='order.php?id=".$data['idu']."' class='waves-effect waves-light btn ts';'>Order</a>
											</div>
										</div>
										</div>
									
										";
										}
									}						
				
										
									
					?>
				
			</div>
		
		</div>
		
	
	<!--Mengetahui banyak data di database-->	
	<?php
		/*include 'connect.php';
		$queri="SELECT * from tb_mhs WHERE flag=0;";
		$proses=mysqli_query($con,$queri);
		$row=mysqli_num_rows($proses); //banyaknya data (baris table) di database
		echo "
			<script>
				var row=$row; //banyak data di database
			</script>
		";*/
	?>	
		
	
	<script>
	
	var vup=1;
	var page=0;
	var kpk=1;
	var srt="id"; //penanda pengurutan berdasar nrp
	
	document.getElementById("hal").innerHTML = page+1; //menampilkan angka halaman pertama
	
	var maks;
	var a=0;
	var p=0;
	if(row<=5){ //banyak data kurang dari sama dengan 5
		maks=1; //jumlah halaman maks 1
	}
	else{
	while(row>(a+5)){ //lebih dari 5 baris dan kelipatan 5
		a=a+5; //bertambah kelipatan lima
		p++; //halaman akan bertamah 1
		maks=p+1; //halaman maks sesuai dengan yang mendekati dengan kelipatan 5 ke-(p+1)
	}
	}
	
	document.getElementById("maks").innerHTML = maks; //menunjukkan halaman terakhir
	
	//FUNGSI UNTUK MENAMPILKAN FORM SESUAI DENGAN TOMBOL YANG DIKLIK
	function edit(){ //edit
		$('#edit').show();
		$(document).ready(function(){
				$("#edit").load("mhsedit.php?sort="+srt+"&mark="+vup+"&pg="+page); //membuka form edit dan menyalin datanya sesuai penanda ke form edit
		});
		$('#add').hide();
		$('#minus').hide();
		$('#deleteall').hide();
	}
	
	function add(){ //tambah
		$('#add').show();
		$(document).ready(function(){
				$("#add").load("mhsadd.php?"); //membuka tambah.php untuk menampilkan form kosong
		});
		$('#edit').hide();
		$('#minus').hide();
		$('#deleteall').hide();
	}
	
	function minus(){ //hapus
		$('#minus').show();
		$(document).ready(function(){
				$("#minus").load("mhsdelete.php?sort="+srt+"&mark="+vup+"&pg="+page); //membuka minus.php untuk menampilkan form kosong
		});
		$('#add').hide();
		$('#edit').hide();
		$('#deleteall').hide();
	}
	function deleteall(){ //hapus semua
		$('#deleteall').show();
		$(document).ready(function(){
				$("#deleteall").load("deleteall.php"); //membuka delete.php untuk menghapus seluruh data pada table
		});
		$('#edit').hide();
		$('#minus').hide();
		$('#add').hide();
	}
	
	//FUNGSI untuk arrows
	function upclick(){
		vup--; //penanda menuju ke baris sebelumnya
		if(vup<1) { //jika sudah berada pada baris pertama
			vup=5; //kembali ke halaman sebelumnya akan menandai baris kelima
			page--;//menuju ke halaman sebelumnya
			if(page<0) //jika nilai page berkurang padahal sudah berada di halaman awal
			{
				page=0; //page tetap 0 tidak akan berpindah ke halaman manapun
				vup=1; //vup tetap 1 tidak akan menandai baris lain
			}
		}
		document.getElementById("hal").innerHTML = page+1; //memunculkan nomor halaman ke html (di pojok kanan atas)
		$(document).ready(function(){
				$("#data").load("mhsdata.php?sort="+srt+"&mark="+vup+"&pg="+page); //header nama diklik akan membuka data yang mengurutkan berdasar nama
		});
	}
	
	function downclick(){
		vup++; //penanda menuju ke baris berikutnya
		if((page*5+vup)>row){ //jika nilai penanda sudah melebihi jumlah data yang ada di halaman terakhir
			vup=row-page*5; //penanda ditahan pada baris terakhir untuk halaman terakhir
		}
		if(vup>5){ //setelah baris ke-lima kembali ke baris pertama
			vup=1; //penanda menuju ke baris pertama
			page++; //menuju ke halaman selanjutnya
		}
		document.getElementById("hal").innerHTML = page+1; //memunculkan nomor halaman ke html (di pojok kanan atas)
		$(document).ready(function()
			{
				$("#data").load("mhsdata.php?sort="+srt+"&mark="+vup+"&pg="+page); //header nama diklik akan membuka data yang mengurutkan berdasar nama
		});
		
	}
	
	function rightclick(){
		page++;
		vup=vup;
		kpk=(page-1)*5;
		if(page*5>=row){ //jika sudah berada di halaman terakhir
			//agar tidak menuju ke halaman berikutnya
			page=kpk/5; //supaya ditahan di halaman terakhir			
		}
		
		if((page*5>row-5)&&(row%5<vup)){ //satu halaman sebelum halaman terakhir dan penanda menunjuk baris ke-x, x<banyak data di halaman terakhir
			vup=row%5; //penanda akan menunjukkan baris terakhir pada halaman terakhir
		}
		document.getElementById("hal").innerHTML = page+1; //memunculkan nomor halaman ke html (di pojok kanan atas)
		
		$(document).ready(function()
			{
				$("#data").load("mhsdata.php?sort="+srt+"&mark="+vup+"&pg="+page); //header nama diklik akan membuka data yang mengurutkan berdasar nama
		});
	}
	
	function leftclick(){
		page--;
		
		if(page<0) page=0; //jika sudah berada di halaman awal maka tidak akan berpindah ke halaman manapun
		document.getElementById("hal").innerHTML = page+1; //memunculkan nomor halaman ke html (di pojok kanan atas)
		$(document).ready(function()
			{
				$("#data").load("mhsdata.php?sort="+srt+"&mark="+vup+"&pg="+page); //header nama diklik akan membuka data yang mengurutkan berdasar nama
		});
	}

	//FUNGSI UNTUK MEMBUKA DATA SESUAI DENGAN HEADER TABLE YANG DIKLIK
	//var loadingdata = function(){
		$(document).ready(function()
		{
				$("#data").load("mhsdata.php?sort="+srt+"&mark="+vup+"&pg="+page); //membuka data.php untuk isi table
		});
		 
		function sortname()
		{
			$(document).ready(function()
			{	srt="nm"
				$("#data").load("mhsdata.php?sort="+srt+"&mark="+vup+"&pg="+page); //header nama diklik akan membuka data yang mengurutkan berdasar nama
			});
		}
		function sortid()
		{
			$(document).ready(function()
			{srt="id";
				$("#data").load("mhsdata.php?sort="+srt+"&mark="+vup+"&pg="+page); //header email diklik akan membuka data yang mengurutkan berdasar email
			});
		}
		function sortdate()
		{
			$(document).ready(function()
			{
				srt="dt";
				$("#data").load("mhsdata.php?sort="+srt+"&mark="+vup+"&pg="+page); //header alamat diklik akan membuka data yang mengurutkan berdasar alamat
			});
		}
		function sortvoice()
		{
			$(document).ready(function()
			{
				srt="vc";
				$("#data").load("mhsdata.php?sort="+srt+"&mark="+vup+"&pg="+page); //header nope diklik akan membuka data yang mengurutkan berdasar nope
			});
		}
		function sortprof()
		{
			$(document).ready(function()
			{
				srt="pf";
				$("#data").load("mhsdata.php?sort="+srt+"&mark="+vup+"&pg="+page); //header nope diklik akan membuka data yang mengurutkan berdasar nope
			});
		}
	//}
	//setInterval(loadingdata, 2000);//1000 miliseconds
	</script>
	
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.4.4/jquery.min.js"></script>
    <script src="jquery.jkey.js"></script>
    <script>
	//FUNGSI UNTUK KEYBOARD
	  //LEFT
      $(document).jkey('left, pgup',function(){
        leftclick();
      });
	  //RIGHT
      $(document).jkey('right, pgdn',function(){
        rightclick();
      });
	  //ATAS
      $(document).jkey('up',function(){
        upclick();
      });
	  
	  //BAWAH
      $(document).jkey('down',function(){
        downclick();
      });
	  //DELETE
      $(document).jkey('delete',function(){
        minus();
      });
	  //insert
      $(document).jkey('insert',function(){
        add();
      });
      
    </script>
</body>
</html>

