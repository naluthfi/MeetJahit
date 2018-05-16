<html>
<head>
 <script src = "js/jquery-3.3.1.min.js"></script>
</head>


<body>
<?php
	include 'connect.php';
	$idu=$_COOKIE['id'];
	session_start();	
	$kat = $_SESSION['kat'];
	
	$page=$_GET['pg'];
	$b=1;
	
	$awal=$page*8;
	
	$myq="SELECT * from tb_user WHERE idu = '$idu'";
	$myp=mysqli_query($con,$myq);
	while ($data = mysqli_fetch_array ($myp)){
		$mycity=$data['kabupaten'];
	}
	
	//$queri="SELECT * from tb_user WHERE kabupaten = '$mycity'";
	$queri="SELECT * from tb_user WHERE profesi=1";

	$proses=mysqli_query($con,$queri);
	while ($data = mysqli_fetch_array ($proses)){
			$username=$data['username'];
			$ava=$data['avatar'];
			$idp=$data['idu'];
			if($kat==0){
				if(($b>$awal) && ($b<=($awal+8))){
				echo "		
				<div class='col row l3 m12 s12' style='padding:16px;'>
					<div class='col l12 m12 s12' style='background-color:rgba(255, 255, 255,0.7); padding:16px; border: 1px solid white;'>
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
				$quer="SELECT * from tb_penjahit_".$idp." WHERE kategori='$kat'";
				$pros=mysqli_query($con,$quer);
				$row=mysqli_num_rows($pros);
				if($row>0){
					while ($dat = mysqli_fetch_array ($pros)){
						if(($b>$awal) && ($b<=($awal+8))){
							echo "		
							<div class='col row l3 m12 s12' style='padding:16px;'>
								<div class='col l12 m12 s12' style='background-color:rgba(255, 255, 255,0.7); padding:16px; border: 1px solid white;'>
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
			}
		
	}
	
?>

</body>