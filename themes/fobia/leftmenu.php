<!--start sidebar -->
<aside class="sidebar-wrapper" data-simplebar="true">
      <div class="sidebar-header">
        <div>
          <img src="../themes/fobia/assets/images/logo-icon-2.png" class="logo-icon" alt="logo icon">
        </div>
        <div>
          <h4 class="logo-text">Sistem Informasi</h4>
        </div>
      </div>
      <!--navigation-->
      <ul class="metismenu" id="menu">        
        <li class="menu-label">Main Menu</li>
        <li>
            <a href="index.php">
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
    <!--end sidebar -->