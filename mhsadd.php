<?php
	include 'connect.php';
	//$vup=$_GET['mark'];
	//$page=$_GET['pg'];
	//$b=1;
	
	//$awal=$page*4;
	//$vup=$awal+$vup;
	
	$queri="SELECT * from tb_user WHERE profesi=1";

	$proses=mysqli_query($con,$queri);
	while ($data = mysqli_fetch_array ($proses)){
		//if(($b>$awal) && ($b<=($awal+4))){
			$username=$data['username'];		
			echo "
							<div class='col row l12 m12 s12' style='margin-left:80px; margin-right:80px; padding-top:1                                   0px;'>
										<div class='col row l3 m12 s12' style='padding:16px;'>
										<div class='col l12 m12 s12' style='background-color:rgba(255, 255, 255,0.6); padding:16px;'>
											<img src='img/desainer/ex-desainer.jpg' width='120' height='120' alt=''/>
											<div>
												<a style='color:#d89034; font-size:16px;' href='order.php?id=".$data['idu']."'>$username</a>
											</div>
											<div>".$data['nama']."</div>
											<div>  
												<a style='margin-top:8px;' href='order.php?id=".$data['idu']."' class='waves-effect waves-light btn ts';'>Order</a>
											</div>
										</div>
										</div>
										</div>
									
			";
		//}
		//$b++;
	}
	
?>