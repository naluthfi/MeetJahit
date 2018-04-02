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
            <li class="nav-item active px-lg-4">
              <a class="nav-link text-uppercase text-expanded" href="login.php">Login</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <section id="form" class="page-section cta">
      <div  class="container">
        <div class="col-xl-9 col-lg-10 mx-auto">
		
          <div class="bg-faded p-5 rounded">
          <h2>MEETJAHIT LOGIN</h2>
          <p>Type your username and password:</p>
            <form  action="login.php#form" method="post">
              <div class="form-group">
                <label for="usr">Username or Email</label>
                <input name="username" type="text" class="form-control" id="usr">
              </div>
              <div class="form-group">
                <label for="pwd">Password</label>
                <input name="pass" type="password" class="form-control" id="pwd">
              </div>
              <p>Don't have MeetJahit account? <a href="signup.php"> click here </a> </p>

              <div class="submit">
                <button type="submit" class="button-blue">LOGIN</button>
              </div>
				<?php
				include 'connect.php';
				if(isset($_POST['username'])&&isset($_POST['pass'])){
					$idu=$_POST['username'];
					$pas=$_POST['pass'];
					
					$quer="SELECT * FROM tb_user WHERE (username='".$idu."' OR email='".$idu."') and password='".$pas."' ";
					$proses=mysqli_query($con,$quer);
					$row=mysqli_num_rows($proses);
					if($row==0){
						
							echo "
							<div class='alert alert-danger'>
							<strong>Login Gagal!</strong> Username atau password salah
							</div>";
							//header("location:login.php#form");
					}
					else{
						setcookie(id,$idu);
						while ($data= mysqli_fetch_array ($proses)){
							$prof=$data['profesi'];
						
						
							
						if($prof==1){
							header("location:hometailor.php#");
						}	
						if($prof==2){
							header("location:homedesigner.php#");
						}	
						if($prof==3){
							header("location:homesupplier.php#");
						}	
						if($prof==4){
							header("location:homecustomer.php#");
						}
						else header("location:index.php#");
						}
					}
				}					
				
			?>
	
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