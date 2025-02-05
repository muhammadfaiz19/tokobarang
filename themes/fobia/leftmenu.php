<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sistem Informasi Toko Barang</title>
  <style>
    /* CSS untuk memperbesar logo */
    .logo-icon {
      width: 40px !important;  /* Lebar logo yang lebih besar, pastikan diterapkan */
      height: auto !important;  /* Tinggi logo akan disesuaikan otomatis */
    }

    /* CSS untuk memperbesar teks logo */
    .logo-text {
      font-size: 17px !important; /* Ukuran font teks logo */
      font-weight: bold; /* Menambah ketebalan font */
      color: #333; /* Warna teks */
    }

    /* Optional: Membuat tampilan lebih responsif */
    @media (max-width: 768px) {
      .logo-icon {
        width: 120px !important; /* Lebar logo lebih kecil untuk layar lebih kecil */
      }

      .logo-text {
        font-size: 20px !important; /* Ukuran font lebih kecil untuk tampilan mobile */
      }
    }
  </style>
</head>
<body>

  <aside class="sidebar-wrapper" data-simplebar="true">
    <div class="sidebar-header">
      <div>
        <img src="../themes/fobia/assets/images/tokobarang2.png" class="logo-icon" alt="logo icon">
      </div>
      <div>
        <h4 class="logo-text">Sistem Informasi Toko Barang</h4>
      </div>
    </div>
    <!--navigation-->
    <ul class="metismenu" id="menu">        
      <li class="menu-label">Main Menu</li>
      <li>
        <a href="../../../tokobarang/dashboard/index.php">
          <div class="parent-icon">
            <i class="lni lni-display-alt"></i>
          </div>
          <div class="menu-title">Dashboard</div>
        </a>
      </li>
      <?php
        $a = Menulist();
        foreach ($a as $item) {   
      ?>
      <li>
        <a href="../<?php echo strtolower($item); ?>">
          <div class="parent-icon">
            <ion-icon name="document-text-outline"></ion-icon>
          </div>
          <div class="menu-title">Data <?php echo $item; ?></div>
        </a>
      </li>
      <?php } ?>
      <li>
        <a href="../logout.php">
          <div class="parent-icon">
            <ion-icon name="document-text-outline"></ion-icon>
          </div>
          <div class="menu-title">Log Out</div>
        </a>
      </li>
    </ul>
    <!--end navigation-->
  </aside>
  
</body>
</html>
