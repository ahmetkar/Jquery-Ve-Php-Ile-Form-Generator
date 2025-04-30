<?php

if(count(get_included_files()) ==1){
  http_response_code(404);
  include('404.php');
  exit;
}

?>
<!doctype html>
<html data-bs-theme="light">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.115.4">
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script> 
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/sidebars.js"></script>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.3/examples/sidebars/">   

    <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@docsearch/css@3">
    <link href="https://getbootstrap.com/docs/5.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="css/sidebars.css" rel="stylesheet">
    
    <meta name="theme-color" content="#712cf9">
  </head>

<body>
<div style="width:100%" class="row gx-3">  

<div class="col-2">
<div class="flex-shrink-0 p-4">
	
    <a class="d-flex align-items-center pb-4 mb-4 link-body-emphasis  text-decoration-none border-bottom">
        <span class="fs-6 fw-semibold"><?php echo $_SESSION["adsoyad"]." olarak giriş yaptınız."; ?></span>
    </a>
    <ul class="list-unstyled ps-0">
    <li class="mb-1">  
          <button onclick="window.location.href='index.php';" class="btn btn-toggle d-inline-flex align-items-center rounded border-0" data-bs-toggle="collapse" data-bs-target="#home-collapse" aria-expanded="true">
          Anasayfa
        </button>
    </li>
     
     
       
      <li class="mb-1">
        <button class="btn btn-toggle d-inline-flex align-items-center rounded border-0" data-bs-toggle="collapse" data-bs-target="#orders-collapse" aria-expanded="true">
          Formlar
        </button>
        <div class="collapse show" id="orders-collapse" style="">
          <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
            <?php if($yonetici_kontrol || $akademisyen_kontrol){  ?>  
            <li><a href="formlar.php" class="link-body-emphasis d-inline-flex text-decoration-none rounded">Formlar</a></li>
            
            <li><a href="formturuekle.php" class="link-body-emphasis d-inline-flex text-decoration-none rounded">Form Türü Ekle</a></li> 
           
            <?php }else { ?>
            
        <li class="mb-1">
      
          <li><a href="formlar.php" class="link-body-emphasis d-inline-flex text-decoration-none rounded">Form gönder</a></li>
      

            <li><a href="gonderdiklerim.php" class="link-body-emphasis d-inline-flex text-decoration-none rounded">Gönderdiğim Formlar</a></li>
            <?php } ?>  
            
        </li>
      </ul>
    </div>
      </li>
      <li class="border-top my-3"></li>
      <li class="mb-1">
        <button class="btn btn-toggle d-inline-flex align-items-center rounded border-0" data-bs-toggle="collapse" data-bs-target="#account-collapse" aria-expanded="true">
          Hesap
        </button>
        <div class="collapse show" id="account-collapse" style="">
          <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
           
            <li><a href="cikisyap.php" class="link-body-emphasis d-inline-flex text-decoration-none rounded">Çıkış Yap</a></li>
          </ul>
        </div>
      </li>
      
    </ul>
	</div>

	</div>
 
    
<div style="background-color:#e5e5e5;" class="col-10">
      <div class="container p-3">
    
<div class="card">
<div class="container ms-1 mt-3">



