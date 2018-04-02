<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
        <link rel="stylesheet" href="form.css" >

    <title>MeetJahit - Store</title>

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom fonts for this template -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Lora:400,400i,700,700i" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/business-casual.min.css" rel="stylesheet">

  </head>

  <body>
	
	
	
    <h1 class="site-heading text-center text-white d-none d-lg-block">
      <span class="site-heading-upper text-primary mb-3">An Online Marketplace for Fashion Designers, Textile Suppliers, and Tailors in Indonesia</span>
      <span class="site-heading-lower">MeetJahit</span>
    </h1>

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark py-lg-4" id="mainNav">
      <div class="container">
        <a class="navbar-brand text-uppercase text-expanded font-weight-bold d-lg-none" href="#">Start Bootstrap</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav mx-auto">
            <li class="nav-item px-lg-4">
              <a class="nav-link text-uppercase text-expanded" href="index.php">Home
                <span class="sr-only">(current)</span>
              </a>
            </li>
            <li class="nav-item px-lg-4">
              <a class="nav-link text-uppercase text-expanded" href="order.php">Order</a>
            </li>
            <li class="nav-item px-lg-4">
              <a class="nav-link text-uppercase text-expanded" href="about.php">About</a>
            </li>
            <li class="nav-item px-lg-4">
              <a class="nav-link text-uppercase text-expanded" href="stakeholder.php">Stakeholder</a>
            </li>
            <li class="nav-item px-lg-4">
              <a class="nav-link text-uppercase text-expanded" href="login.php">Login</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <section id="form" class="page-section cta">
	<?php
		include 'connect.php';
		//$hex= dechex(45);
		//echo "$hex";
		//if(isset($_GET['a'])){
		if(isset($_POST['name'])&&isset($_POST['gender'])&&isset($_POST['email'])&&isset($_POST['username'])&&isset($_POST['pass'])&&isset($_POST['repass'])&&isset($_POST['ttl'])&&isset($_POST['addr'])&&isset($_POST['kec'])&&isset($_POST['kab'])&&isset($_POST['prov'])&&isset($_POST['pos'])&&isset($_POST['prof'])){
			
			$name=htmlentities(strip_tags(trim($_POST['name'])));
			$gender=$_POST['gender'];
			$email=$_POST['email'];
			$uname=$_POST['username'];
			$pass=$_POST['pass'];
			$repass=$_POST['repass'];
			$ttl=$_POST['ttl'];
			$addr=$_POST['addr'];
			$kec=$_POST['kec'];
			$kab=$_POST['kab'];
			$prov=$_POST['prov'];
			$pos=$_POST['pos'];
			$prof=$_POST['prof'];
			
			if($pass==$repass){
				$quer="INSERT INTO `tb_user` (`username`, `email`, `password`, `nama`, `ttl`, `alamat`, `jeniskelamin`, `kecamatan`, `kabupaten`, `provinsi`, `kodepos`, `profesi`) 
				VALUES ('$uname', '$email', '$pass', '$name', '$ttl', '$addr', '$gender', '$kec', '$kab', '$prov', '$pos', '$prof');";
				$proses=mysqli_query($con,$quer);
				
				if($proses){
					$cek="SELECT * from tb_user where username='$uname' and email='$email'";
					$procek=mysqli_query($con,$cek);
					while ($data= mysqli_fetch_array ($procek)){
							$prof=$data['profesi'];
							$idu=$data['idu'];
					}
					
					if($prof==3){//for tailors
						$create="CREATE TABLE order_jahit_".$idu." (
						  `kdbooking` varchar(20) NOT NULL,
						  `idpelanggan` int(11),
						  `alamat` varchar(150),
						  `leher` smallint(6),
						  `bahu` smallint(6),
						  `kerung` smallint(6),
						  `lengan` smallint(6),
						  `ltangan` smallint(6),
						  `ptangan` smallint(6),
						  `pbadan` smallint(6),
						  `dada` smallint(6),
						  `pinggang` smallint(6),
						  `pinggul` smallint(6),
						  `lingkar` smallint(6),
						  `pbaju` smallint(6),
						  `bayar` tinyint(1),
						  `progress` tinyint(1),
						  `kirim` tinyint(1),
						  `harga` int(11),
						  `rating` tinyint(5),
						  `tglorder` date,
						  `tglkirim` date,
						  `jumlah` smallint(6),
						  `kain` smallint(6),
						  `desain` varchar(100)
						)";
						$proses2=mysqli_query($con,$create);
						
						if($proses2){
							$tb2="CREATE TABLE tb_penjahit_".$idu." (
							  `idp` int(11) NOT NULL,
							  `gender` tinyint(2),
							  `kategori` tinyint(4),
							  `tarif` int(11)
							)";
							$proses3=mysqli_query($con,$tb2);
							
							if($proses3){
								header("location:hometailor.php#");
							}
						}
					}
					
					setcookie(id,$idu);
				}
			}
				
			else{	
				echo "
					<div class='alert alert-danger'>
						<strong>Password tidak cocok!</strong> Username atau password salah
					</div>";
				//header("location:signup.php#form");
			}
		}						
	?>
      <div class="container">
        <div class="col-xl-9 col-lg-10 mx-auto">
          <div class="bg-faded p-5 rounded">
          <h2>MEETJAHIT SIGN UP</h2>
          <p>Fill this form to get a new MeetJahit account:</p>
            <form action="" method="post">
              <div class="form-group">
                <label for="fname">Full Name</label>
                <input name="name" type="text" class="form-control" id="fname" required>
              </div>
              <div class="form-group">
                <label for="gender">Select Your Gender</label>
                <select name="gender" class="form-control" id="gender">
                  <option value="1">Male</option>
                  <option value="0">Female</option>
                </select>
              </div>
              <div class="form-group">
                <label for="email">Email</label>
                <input name="email" type="text" class="form-control" id="email" required>
              </div>
              <div class="form-group">
                <label for="usr">Username</label>
                <input name="username" type="text" class="form-control" id="usr" required>
              </div>
              <div class="form-group">
                <label for="pwd">Password</label>
                <input name="pass" type="password" class="form-control" id="pwd" required>
              </div>
              <div class="form-group">
                <label for="repwd">Re-type Your Password</label>
                <input name="repass" type="password" class="form-control" id="repwd" required>
              </div>
              <div class="form-group">
                <label for="ttl">Birth Date</label>
                <input name="ttl" type="date" class="form-control" id="ttl" required>
              </div>
                <div class="form-group">
                  <label for="addr">Address</label>
                  <textarea name="addr" class="form-control" id="addr"> </textarea>
                </div>
              <div class="form-group">
                <label for="kec">Sub-District</label>
                <input name="kec" type="text" class="form-control" id="kec" required>
              </div>
              <div class="form-group">
                <label for="kab">City</label>
                <input name="kab" type="text" class="form-control" id="kab" required>
              </div>
              <div class="form-group">
                <label for="prov">Province</label>
                <input name="prov" type="text" class="form-control" id="prov" required>
              </div>
              <div class="form-group">
                <label for="kodepos">Post Code</label>
                <input name="pos" type="text" class="form-control" id="kodepos" required>
              </div>
              <div class="form-group">
                <label for="prof">Select Your Account For</label>
                <select name="prof" class="form-control" id="prof">
                  <option value="1">Fashion Designer</option>
                  <option value="2">Textile Supplier</option>
                  <option value="3">Tailor</option>
                  <option value="4">Customer</option>
                </select>
              </div>
              <div class="submit">
                <button type="submit" class="button-blue">SIGN UP</button>
              </div>
            </form>
        </div>
        </div>
      </div>
    </section>
	
    <footer class="footer text-faded text-center py-5">
      <div class="container">
        <p class="m-0 small">Copyright &copy; MeetJahit 2018</p>
      </div>
    </footer>

  </body>

</html>