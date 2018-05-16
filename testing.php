
<?php
	include 'connect.php';
	
	
	//INSERTING DATA INTO tb_penjahit_idu
	$idu=55;
	$tag=rand(1,15);
	//$price=rand(100000,210000); //VERSACE
	$price=rand(55000,85000);
	echo "Hasil acak: $tag, $price<br>";
	$q="SELECT * FROM tb_penjahit_".$idu." WHERE kategori='$tag'";
	$p=mysqli_query($con,$q);
	$ido=mysqli_num_rows($p);

	if($ido==0){
		$insert="INSERT INTO `tb_penjahit_".$idu."` (`kategori`, `tarif`) VALUES ( '".$tag."', '".$price."')";
		//$insert="update `tb_penjahit_".$idu." set tarif='$price' WHERE kategori='$tag'";
		$pros=mysqli_query($con,$insert);
		if($pros){
			echo "<b>Penjahit $idu </b> kategori $tag -- $price <br> BERHASIL MASUK DATABASE! SELAMAT!";
		}
	}
	else {
		echo "<b>Kategori sudah ada</b>";
	}
	
		/*date_default_timezone_set("Asia/Jakarta"); //Setting your location date
	$d=date("Y-m-d"); //get the current date for ord
	$add_days = -12000;
	$date = date('Y-m-d',strtotime($d) + (24*3600*$add_days));
	$uname=array();
	$email=array();
	$pass=array();
	$ttl=array();
	$commail=array();
	$addr=array();
	$jk=0;
	$nama=array("Jessica Natalia","Margareth","Anabell","Bella Swan","Iskandar","Hana Restu","Rito Harap","Udin Bari","Bariq Fabi","Rizqy Handi Janathan");
	$user=array("jessica","margaretha","anabell","bellaswan","iskandar","hanaah","ritoharap","udinbar","bariqfa","qihajan");
	$mail = "@gmail.com";
	$alamat = "Jalan Ngurah Rai, No 81";
	$kecamatan = "Sanur";
	$kota = "Denpasar";
	$provin = "Bali";
	$kdpos = "80228";
	$profesi = 4;
	$i=1;
	$p="password";
	for($i=1; $i<10;$i++){
		$combine="$p".$i."";
		$commail[$i]="".$user[$i]."".$mail."";
		//$comname="$nama ".$i."";
		
		//echo "$combine | $commail<br>";
		
		$uname[$i]=$user[$i];
		$pass[$i]=$combine;
		$email[$i]=$commail[$i];
		$name[$i]=$nama[$i];
		$ttl[$i]=$date;
		$gender[$i]=$jk;
		$addr[$i]=$alamat;
		$kec[$i]=$kecamatan;
		$kab[$i]=$kota;
		$prov[$i]=$provin;
		$pos[$i]=$kdpos;
		$prof[$i]=$profesi;
		
		echo "$uname[$i] | $email[$i] | $pass[$i]| $name[$i] | $ttl[$i] | $gender[$i]| $addr[$i]| $kec[$i]| $kab[$i]| $prov[$i]| $pos[$i]| $prof[$i] <br>";
		
		
	}
	
	for($i=1; $i<10;$i++){
	$quer="INSERT INTO `tb_user` (`username`, `email`, `password`, `nama`, `ttl`, `alamat`, `jeniskelamin`, `kecamatan`, `kabupaten`, `provinsi`, `kodepos`, `profesi`) 
			VALUES (".$uname[$i].", ".$email[$i].", ".$pass[$i].", ".$name[$i].", ".$ttl[$i].", ".$gender[$i].", ".$addr[$i].", ".$kec[$i].",".$kab[$i].",".$prov[$i].",".$pos[$i].",".$prof[$i].");";
		$proses=mysqli_query($con,$quer);
		if($proses){
			echo "BERHASIL";
		}
	}
	*/
	
	//FOR CUSTOMER
	/*	
		$uname="gayanarulita";
		$pass=$uname;
		$email="$uname@gmail.com";
		$name="Gaya Narulita";
		$ttl="1996-04-24";
		$gender=0;
		$addr="Jalan Keputih Gang Makam No. 73";
		$kec="Sukolilo";
		$kab="Surabaya";
		$prov="Jawa Timur";
		$pos="60111";
		$prof=4;
		$quer="INSERT INTO `tb_user` (`username`, `email`, `password`, `nama`, `ttl`, `alamat`, `jeniskelamin`, `kecamatan`, `kabupaten`, `provinsi`, `kodepos`, `profesi`) 
				VALUES ('$uname', '$email', '$pass', '$name', '$ttl', '$addr', '$gender', '$kec', '$kab', '$prov', '$pos', '$prof');";
				$proses=mysqli_query($con,$quer);
				
				if($proses){
					echo "Berhasil $uname";
				}
				
	//FOR TAILOR
		/*$uname="missnyoman";
		$pass=$uname;
		$email="$uname@gmail.com";
		$name="I Nyoman Kartika";
		$ttl="1962-10-22";
		$gender=0;
		$addr="Jalan Senapan No.11";
		$kec="Sanur";
		$kab="Denpasar";
		$prov="Bali";
		$pos="80228";
		$prof=1;
		$quer="INSERT INTO `tb_user` (`username`, `email`, `password`, `nama`, `ttl`, `alamat`, `jeniskelamin`, `kecamatan`, `kabupaten`, `provinsi`, `kodepos`, `profesi`) 
				VALUES ('$uname', '$email', '$pass', '$name', '$ttl', '$addr', '$gender', '$kec', '$kab', '$prov', '$pos', '$prof');";
				$proses=mysqli_query($con,$quer);
				
				if($proses){
				echo "Berhasil insert ke tb_user dengan username $uname<br>";
				
				
					$cek="SELECT * from tb_user where username='$uname' and email='$email'";
					$procek=mysqli_query($con,$cek);
					while ($data= mysqli_fetch_array ($procek)){
							$prof=$data['profesi'];
							$idu=$data['idu'];
					}
					
					if($prof==1){//for tailors
						$create="CREATE TABLE order_jahit_".$idu." (
						  `kdbooking` varchar(20) NOT NULL,
						  `idpelanggan` int(11) DEFAULT NULL,
						  `alamat` varchar(150) DEFAULT NULL,
						  `kategori` smallint(6) NOT NULL,
						  `ukuran` smallint(6) NOT NULL,
						  `bayar` tinyint(1) DEFAULT NULL,
						  `progress` tinyint(1) DEFAULT NULL,
						  `kirim` tinyint(1) DEFAULT NULL,
						  `harga` int(11) DEFAULT NULL,
						  `rating` tinyint(5) DEFAULT NULL,
						  `tglorder` date DEFAULT NULL,
						  `timeorder` time DEFAULT NULL,
						  `tglkirim` date DEFAULT NULL,
						  `jumlah` smallint(6) DEFAULT NULL,
						  `kain` smallint(6) DEFAULT NULL,
						  `desain` varchar(100) DEFAULT NULL
						)";
						
						$proses2=mysqli_query($con,$create);
						
						if($proses2){
							echo "table order_jahit_$idu berhasil dibuat<br>";
							$tb2="
								CREATE TABLE tb_penjahit_".$idu." (
									idp SMALLINT(11) NOT NULL AUTO_INCREMENT,
									kategori TINYINT(4),
									tarif INT(11),
									PRIMARY KEY (idp)
								); 							";
							$proses3=mysqli_query($con,$tb2);
							
							if($proses3){
								echo "Semua table berhasil dibuat";
							}
						}
					}
				}*/
	/*
	
	 function AlphaNumeric($length)
      {
          $chars = "1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz";
          $clen   = strlen( $chars )-1;
          $id  = '';

          for ($i = 0; $i < $length; $i++) {
                  $id .= $chars[mt_rand(0,$clen)];
          }
          return ($id);
      }


 	$link=AlphaNumeric(6); #eg result: Gzt6syUS8M
	$desain="mj.com/".$link."";
	
	//$idu=rand(49,100);
	$idu=rand(32,44);
	//$idu=rand(13,16);
	$kategori=rand(1,15);
	$ukuran=rand(1,6);
	$jumlah=rand(1,5);
	$kain=rand(1,25);
	//$idp=rand(6,12);
	$idp=rand(23,31);
	//$idp=12;
	$rating=rand(3,5);
	
	$qu="SELECT * FROM tb_user WHERE idu ='$idu'";
	$pu=mysqli_query($con,$qu);
	while ($dat= mysqli_fetch_array ($pu)){
		$myalamat=$dat['alamat'];
		$mykec=$dat['kecamatan'];
		$mycity=$dat['kabupaten'];
		$myprov=$dat['provinsi'];
		$mykodepos=$dat['kodepos'];
	}
	
	$alamat="".$myalamat.", ".$mykec.", ".$mycity.", ".$myprov.", ".$mykodepos."";
	
	$quer="SELECT * FROM tb_penjahit_".$idp." WHERE kategori='$kategori'";
	$pros=mysqli_query($con,$quer);
	$kate=mysqli_num_rows($pros);	
	
	
	echo "$desain<br>";
	
	if($kate>0){
		while ($data= mysqli_fetch_array ($pros)){
		$tarif=$data['tarif'];
		}
		$total=$tarif*$jumlah;
		echo "Rp $total <br>user: $idu $alamat | penjahit: $idp | kategori: $kategori <br> Rating: $rating ";
		
		$q="SELECT * FROM order_jahit_".$idp."";
			$p=mysqli_query($con,$q);
			$ido=mysqli_num_rows($p);
			$ido=$ido+1;
			$kd = "J".$idp."-".$ido."";
			
			//date_default_timezone_set("Asia/Jakarta");
			//$date=date("Y-m-d"); //get the current date for order
			//$time=date("H:i:s");
			
			$date="2018-02-01";
			$time="13:12:00";
			$datkir="2018-02-24";
			
			$que="INSERT INTO `order_jahit_".$idp."` (`kdbooking`, `idpelanggan`, `alamat`, `kategori`, `ukuran`, `harga`, `tglorder`, `timeorder`, `jumlah`, `kain`, `desain`,
			 `progress`, `kirim`, `bayar`, `rating`, `tglkirim`) 
			VALUES ('$kd', '$idu', '$alamat', '$kategori', '$ukuran', '$total', '$date', '$time', '$jumlah', '$kain', '$desain',
			1,1,1,'$rating','$datkir');";
			$pro=mysqli_query($con,$que);
			if($pro) {
				$quer="INSERT INTO `tb_history` (`iduser`, `idprofesi`, `kdbooking`) 
				VALUES ('$idu', '$idp', '$kd');";
				$pros=mysqli_query($con,$quer);
				if($pros){
					echo "<br> BERHASIL MASUK DATABASE! SELAMAT!";
				}
			}
			
	}
	else{
		echo "KATEGORI tidak ada<br>user: $idu $alamat | penjahit: $idp | kategori: $kategori";
	}

	*/
	
?>
