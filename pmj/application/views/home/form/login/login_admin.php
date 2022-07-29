<?php 
error_reporting(0);
 ?><!DOCTYPE html>
<html lang="zxx">
<head>
  <title>Pizza Maker Junior</title>
  <meta charset="UTF-8">
  <meta name="description" content=" Divisima | eCommerce Template">
  <meta name="keywords" content="divisima, eCommerce, creative, html">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- Favicon -->
  <link href="img/favicon.ico" rel="shortcut icon"/>

  <!-- Google Font -->
  <link href="https://fonts.googleapis.com/css?family=Josefin+Sans:300,300i,400,400i,700,700i" rel="stylesheet">


  <!-- Stylesheets -->


  <link rel="stylesheet" href="<?php echo base_url() ?>desain/css/bootstrap.min.css"/>
  <link rel="stylesheet" href="<?php echo base_url() ?>desain/css/font-awesome.min.css"/>
  <link rel="stylesheet" href="<?php echo base_url() ?>desain/css/flaticon.css"/>
  <link rel="stylesheet" href="<?php echo base_url() ?>desain/css/slicknav.min.css"/>
  <link rel="stylesheet" href="<?php echo base_url() ?>desain/css/jquery-ui.min.css"/>
  <link rel="stylesheet" href="<?php echo base_url() ?>desain/css/owl.carousel.min.css"/>
  <link rel="stylesheet" href="<?php echo base_url() ?>desain/css/animate.css"/>
  <link rel="stylesheet" href="<?php echo base_url() ?>desain/css/style.css"/>
  <script src="<?php echo base_url() ?>desain/js/jquery-3.2.1.min.js"></script>


  <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

</head>
<body>
  <!-- Page Preloder -->


  <!-- Header section -->
  <header class="header-section">
    <div class="header-top">
      <div class="container">
        <div class="row">
          <div class="col-lg-6 text-center text-lg-left">
            <!-- logo -->
           <div style="float:left">  
             <a href="./index.html" class="site-logo">
              <img src="<?php echo base_url() ?>file/gambar/logo.png" style="width:60px; margin-right:10px">
            </a>
           </div>
            <div> 
              <h4>Pizza Maket Junior</h4>
              <h5>By Pizza Hut</h5>
            </div>
          </div>
          <div class="col-lg-2">
            
          </div>
          <div class="col-lg-4">
            <div class="user-panel pull-right">
              <div class="up-item">
                <a href="<?php echo base_url() ?>home/beranda/login" class="btn btn-info">Login</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <nav class="main-navbar">
      <div class="container">
        <!-- menu -->
        <ul class="main-menu">
          <li><a href="<?php echo base_url() ?>home/">Home</a></li>
          <li><a href="<?php echo base_url() ?>home/beranda/produk">Produk</a></li>
        
        </ul>
      </div>
    </nav>
  </header>




<section class="contact-section" style="margin-bottom: 20px">
    <div class="container">
      <div class="row">
        <form class="form-horizontal" action="<?php echo base_url() ?>home/beranda/proseslogin_admin" method="post">
<div class="col-md-12">
  <h3 class="box-title">Login </h3>
</div>

<div class="col-md-12">
    <?php echo $this->session->flashdata('pesan') ?>
    <p>Silahkan masukan email dan password untuk melanjutkan</p>
  
    <div class="form-group">  
      <label>Akses</label>
      <select name="level" class="form-control"> 
        <option value="PMJ">PMJ</option>
        <option value="Admin">Admin</option>
      </select>
    </div>
    <div class="form-group">  
      <label>Username</label>
      <input type="text" name="username" class="form-control"> 
    </div>
    <div class="form-group">  
      <label>Password</label>
      <input type="password" name="password" class="form-control"> 
    </div>
        
    <div class="form-group">  
      <input type="submit" value="Login" class="btn btn-info"> 
    </div>
      <!-- <a href="?a=pelanggan" class="btn btn-info">Kembali</a> -->
  </div>
        <div class="clearfix"> </div>
    </form>

      

      


      </div>
    </div>

  </section>




  <section class="footer-section">
    <div class="container">
      
      <div class="row">
        <div class="col-lg-6 col-sm-6">
          <div class="footer-widget about-widget">
            <h2>Pizza Hut </h2>
            
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3989.2778625196415!2d100.35688471475363!3d-0.9430763993120409!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2fd4b936d68894b7%3A0x7a21db1196782a3a!2sPizza%20Hut%20Restoran!5e0!3m2!1sid!2sid!4v1655865377960!5m2!1sid!2sid" width="100%" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
          </div>
        </div>
        <div class="col-lg-3 col-sm-6">
          <div class="footer-widget about-widget">
            <h2>Tentang Kami</h2>
            <ul class="check">
                                    <li><a href="#">Alamat : <p>Jl. Jend. A Yani No.21, Kp. Jao, Kec. Padang Bar., Kota Padang, Sumatera Barat 25114</p></a></li>
                                    <li><a href="#">Telp : 08113249092</a></li>                                
                                    <!-- <li><a href="#">Email : diskominfo@sumbarprov.go.id</a></li>                                     -->
                        </ul>

          </div>
        </div>
        <div class="col-lg-3 col-sm-6">
          <!-- <div class="footer-widget about-widget">
            <h2>Site Link</h2>
            <ul class="check">
                                    <li><a target="_blank" href="http://sumbarprov.go.id/">Sumbarprov</a></li>
                                    <li><a target="_blank" href="http://newsimaya.sumbarprov.go.id/">Simaya Sumbar</a></li>
                                    <li><a target="_blank" href="http://egov.sumbarprov.go.id/">Portal E-Government</a></li>
                                    <li><a target="_blank" href="#">Kominfo</a></li>                                    
                                    <li><a target="_blank" href="http://egov.sumbarprov.go.id/">PPID</a></li>                                    
                                </ul>
          </div> -->
        </div>
        
      </div>
    </div>
    <div class="social-links-warp">
      <div class="container">
<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --> 
<p class="text-white text-center mt-5">Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="fa fa-heart-o" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a></p>
<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->

      </div>
    </div>
  </section>
  <!-- Footer section end -->



  <!--====== Javascripts & Jquery ======-->
  <script src="<?php echo base_url() ?>desain/js/jquery-3.2.1.min.js"></script>
  <script src="<?php echo base_url() ?>desain/js/bootstrap.min.js"></script>
  <script src="<?php echo base_url() ?>desain/js/jquery.slicknav.min.js"></script>
  <script src="<?php echo base_url() ?>desain/js/owl.carousel.min.js"></script>
  <script src="<?php echo base_url() ?>desain/js/jquery.nicescroll.min.js"></script>
  <script src="<?php echo base_url() ?>desain/js/jquery.zoom.min.js"></script>
  <script src="<?php echo base_url() ?>desain/js/jquery-ui.min.js"></script>
  <script src="<?php echo base_url() ?>desain/js/main.js"></script>




  </body>
</html>
