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

    <section class="page-section cta">
      <div class="container">
        <div class="col-xl-9 col-lg-10 mx-auto">
          <div class="bg-faded p-5 rounded">
          <h2>MEETJAHIT SIGN UP</h2>
          <p>Fill this form to get a new MeetJahit account:</p>
            <form>
              <div class="form-group">
                <label for="fname">Full Name</label>
                <input type="text" class="form-control" id="fname">
              </div>
              <div class="form-group">
                <label for="gender">Select Your Gender</label>
                <select class="form-control" id="gender">
                  <option>Male</option>
                  <option>Female</option>
                </select>
              </div>
              <div class="form-group">
                <label for="email">Email</label>
                <input type="text" class="form-control" id="email">
              </div>
              <div class="form-group">
                <label for="usr">Username</label>
                <input type="text" class="form-control" id="usr">
              </div>
              <div class="form-group">
                <label for="pwd">Password</label>
                <input type="password" class="form-control" id="pwd">
              </div>
              <div class="form-group">
                <label for="repwd">Re-type Your Password</label>
                <input type="password" class="form-control" id="repwd">
              </div>
              <div class="form-group">
                <label for="ttl">Birth Date</label>
                <input type="date" class="form-control" id="ttl">
              </div>
                <div class="form-group">
                  <label for="addr">Address</label>
                  <textarea class="form-control" id="addr"> </textarea>
                </div>
              <div class="form-group">
                <label for="kec">Sub-District</label>
                <input type="text" class="form-control" id="kec">
              </div>
              <div class="form-group">
                <label for="kab">City</label>
                <input type="text" class="form-control" id="kab">
              </div>
              <div class="form-group">
                <label for="prov">Province</label>
                <input type="text" class="form-control" id="prov">
              </div>
              <div class="form-group">
                <label for="kodepos">Post Code</label>
                <input type="text" class="form-control" id="kodepos">
              </div>
              <div class="form-group">
                <label for="prof">Select Your Account For</label>
                <select class="form-control" id="prof">
                  <option>Fashion Designer</option>
                  <option>Textile Supplier</option>
                  <option>Tailor</option>
                  <option>Customer</option>
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