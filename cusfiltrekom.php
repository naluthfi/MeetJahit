<?php
	include 'connect.php';
	$idu=$_COOKIE['id'];
	session_start();	
	$kat = $_SESSION['kat'];
	
	$page=$_GET['pg'];
	$b=1;
	
	$awal=$page*4;
	
	$myq="SELECT * from tb_user WHERE idu = '$idu'";
	$myp=mysqli_query($con,$myq);
	while ($data = mysqli_fetch_array ($myp)){
		$mycity=$data['kabupaten'];
	}
	
	$same=0;
	$que="SELECT * from tb_user WHERE (profesi=1 AND kabupaten = '$mycity')";
	$pro=mysqli_query($con,$que);
	$rows=mysqli_num_rows($pro);
	while ($dat = mysqli_fetch_array ($pro)){
		$username=$dat['username'];
		$idp=$dat['idu'];
		if($kat>0){ //kategori tertentu
			$quer="SELECT * FROM tb_penjahit_".$idp." WHERE kategori = ".$kat."";
			$pros=mysqli_query($con,$quer);
			$row=mysqli_num_rows($pros);
			if($row>0){
				$same++; //jumlah penjahit untuk kategori ini di kota yang sama
			}
		}
		else{ //semua kategori
			$same=$rows;
		}
	}
	if($same==0){
	echo"
		<div class='col row l12 m12 s12' style='background-color:rgba(0, 0, 0,0.4); 
				margin-left:64px; margin-right:64px; padding-top:10px; padding:16px;'>
					<div style='color:white; background-color:rgba(216, 144, 52, 0.6); margin-left:16px; margin-right:16px; 
					font-size:18px; padding-top:8px; padding-bottom:8px; font-family:Raleway'>
									Belum ada penjahit di kota Anda untuk kategori ini
					</div>
		";
	}
	else if(($same<=($page*4+4)) && ($same>($page*4))){ //for the next pages (page 2 and so on)
	echo"
		<div class='col row l12 m12 s12' style='background-color:rgba(0, 0, 0,0.4); 
				margin-left:64px; margin-right:64px; padding-top:10px; padding-left:16px; padding-right:16px;'>
					<div style='color:white; background-color: rgba(0,255,255,0.6); margin-left:16px; margin-right:16px; 
					font-size:18px; padding-top:8px; padding-bottom:8px; font-family:Raleway'>
									Penjahit di kota Anda untuk kategori ini
					</div>
		";
	}
	
	else if($b<4){ //for the very first page
		if(($b>$awal) && ($b<=($awal+4))){ //b=1; b>0 && b<=4 -- 4 n 8 -- 8 n 12		
		echo"
		<div class='col row l12 m12 s12' style='background-color:rgba(0, 0, 0,0.4); 
				margin-left:64px; margin-right:64px; padding-top:10px; padding-left:16px; padding-right:16px;'>
					<div style='color:white; background-color: rgba(0,255,255,0.6); margin-left:16px; margin-right:16px; 
					font-size:18px; padding-top:8px; padding-bottom:8px; font-family:Raleway'>
									Penjahit di kota Anda
					</div>
		";
			//}
		}
	}
	
	$queri="SELECT * from tb_user WHERE (profesi=1 AND kabupaten = '$mycity')";
	$proses=mysqli_query($con,$queri);
	while ($data = mysqli_fetch_array ($proses)){
		$username=$data['username'];
		$ava=$data['avatar'];
		$idp=$data['idu'];
		if($kat>0){							
			$quer="SELECT * from tb_penjahit_".$idp." WHERE kategori = ".$kat."";
			$pros=mysqli_query($con,$quer);
			$row=mysqli_num_rows($pros);
			if($row>0){
				if(($b>$awal) && ($b<=($awal+4))){
					echo "		
					<div class='col row l3 m12 s12' style='padding:16px;'>
						<div class='col l12 m12 s12' style='background-color:rgba(255, 255, 255,0.8); padding:16px; border: 1px solid white;'>
								<img src='img/tailor/".$ava.".png' width='90' height='90' alt=''/>
								<div>
									<a style='color:#d89034; font-size:16px;' href='penjahit.php?id=".$data['idu']."'>$username</a>
								</div>
								<div>".$data['nama']."</div>
								<div>  
									<a style='margin-top:8px;' href='orpen.php?id=".$data['idu']."' class='waves-effect waves-light btn ts';'>Order</a>
								</div>
						</div>
					</div>					
					";
				}
				$b++;
			}
			else{
				//Tidak ditemukan penjahit dalam kategori ini
			}
		}
		
		else{
				if(($b>$awal) && ($b<=($awal+4))){
				echo "		
				<div class='col row l3 m12 s12' style='padding:16px;'>
					<div class='col l12 m12 s12' style='background-color:rgba(255, 255, 255,0.8); padding:16px; border: 1px solid white;'>
							<img src='img/tailor/".$ava.".png' width='90' height='90' alt=''/>
							<div>
								<a style='color:#d89034; font-size:16px;' href='penjahit.php?id=".$data['idu']."'>$username</a>
							</div>
							<div>".$data['nama']."</div>
							<div>  
								<a style='margin-top:8px;' href='orpen.php?id=".$data['idu']."' class='waves-effect waves-light btn ts';'>Order</a>
							</div>
					</div>
				</div>					
				";
				}
				$b++;
			}

	}
	echo"</div>";
?>