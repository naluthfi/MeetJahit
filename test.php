
<?php
	include 'connect.php';
	
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
	
	//CREATEING CUSTOMER ACCOUNTS
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
	  function Alphabet($length)
      {
          $chars = "abcdefghijklmnopqrstuvwxyz";
          $clen   = strlen( $chars )-1;
          $id  = '';

          for ($i = 0; $i < $length; $i++) {
                  $id .= $chars[mt_rand(0,$clen)];
          }
          return ($id);
      }
		
		$num=rand(1,100);
		$ava=rand(1,8);
		$gen=rand(0,1);
		$no=rand(1,100);
		$th=rand(1960,2000);
		$bln=rand(1,12);
		$tgl=rand(1,29);

		$jln=AlphaNumeric(8); #eg result: Gzt6syUS8M
		$uname=Alphabet(10); #eg result: xxsadwvdsa
		//$uname="gayanarulita";
		$pass=$uname;
		$email="$uname@gmail.com";
		$name="$uname";
		$ttl="".$th."-".$bln."-".$tgl."";
		$gender="".$gen."";
		$addr="Jalan ".$jln." No. ".$no."";
		$kec="Patrang";
		$kab="Jember";
		$prov="Jawa Tengah";
		$pos="68111";
		$prof=4;
		$quer="INSERT INTO `tb_user` (`username`, `email`, `password`, `nama`, `ttl`, `alamat`, `jeniskelamin`, `kecamatan`, `kabupaten`, `provinsi`, `kodepos`, `profesi`,`avatar`) 
				VALUES ('$uname', '$email', '$pass', '$name', '$ttl', '$addr', '$gender', '$kec', '$kab', '$prov', '$pos', '$prof', '$ava');";
				$proses=mysqli_query($con,$quer);
				
				if($proses){
					echo "Berhasil $uname";
				}
				
	//CREATING TABLE FOR TAILORS
	/*				
					$idu=55;
					$cek="SELECT * from tb_user where idu='$idu'";
					
					$procek=mysqli_query($con,$cek);
					while ($data= mysqli_fetch_array ($procek)){
							$prof=$data['profesi'];
							//$idu=$data['idu'];
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
				//}*/
	
	
	
	//INSERTING DATA FOR ORDERS
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


 	$link=AlphaNumeric(8); #eg result: Gzt6syUS8M
	$desain="mj.com/".$link."";
	
	$idu=rand(56,1000); //pelanggan
	//$idu=rand(32,44);
	//$idu=rand(13,16);
	$kategori=rand(1,15);
	//$kategori=12;
	$ukuran=rand(1,6);
	$jumlah=rand(1,3);
	$kain=rand(1,25);
	$jam=rand(0,23);
	$sec=rand(0,59);
	
	$idp=rand(1,55); //penjahit
	//$idp=rand(17,20);
	//$idp=rand(23,31);
	//$idp=2;
	
	//$rating=rand(1,5);
	$rating=5;
	$date="2018-05-14";
	$time="".$jam.":".$sec.":00";
	$datkir="2018-05-19";
	$qu="SELECT * FROM tb_user WHERE idu ='$idu'";
	$pu=mysqli_query($con,$qu);
	while ($dat= mysqli_fetch_array ($pu)){
		$myalamat=$dat['alamat'];
		$mykec=$dat['kecamatan'];
		$mycity=$dat['kabupaten'];
		$myprov=$dat['provinsi'];
		$mykodepos=$dat['kodepos'];
		$uprof=$dat['profesi'];
	}
	
	$alamat="".$myalamat.", ".$mykec.", ".$mycity.", ".$myprov.", ".$mykodepos."";
	
	$quer="SELECT * FROM tb_penjahit_".$idp." WHERE kategori='$kategori'";
	$pros=mysqli_query($con,$quer);
	$kate=mysqli_num_rows($pros);	
	
	
	echo "$desain | $date, $time WIB<br>";
	
	if(($kate>0)&&($uprof==4)){
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
	
	//MENCARI TAHU BANYAK DATA
	/*
	$queri="SELECT * from tb_user WHERE profesi=1";
		$proses=mysqli_query($con,$queri);
		$kat=1; $jml=0;
		if($kat==0){
			$row=mysqli_num_rows($proses); //banyaknya data (baris table) di database
			echo "
				$row
			";
		}
		else{
			while ($data = mysqli_fetch_array ($proses)){
				$idp=$data['idu'];			
				$quer="SELECT * from tb_penjahit_".$idp." WHERE kategori = ".$kat."";
				$pros=mysqli_query($con,$quer);
				$row=mysqli_num_rows($pros);
				if ($row>0){
					$jml=$jml+$row;
				}
				echo "
					$row
				";
			}
		}
		echo"<br> JUMLAH : $jml";
	
/*
	*/
	
?>
